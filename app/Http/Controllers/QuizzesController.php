<?php

namespace App\Http\Controllers;

use App\Models\OfferCourse;
use App\Models\Quiz;
use App\Models\StudentCourseRegistration;
use App\Models\StudentQuizSubmission;
use App\Models\StudentsRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Carbon\Carbon;

class QuizzesController extends Controller
{
    public function uploadStudentAnswer(Request $request, Quiz $quiz)
    {
        $studentId = session('id');
        if (!$studentId) {
            return back()->with('error', 'Please login first.');
        }

        $alreadySubmitted = StudentQuizSubmission::where('quiz_id', $quiz->id)
            ->where('student_id', $studentId)
            ->exists();

        if ($alreadySubmitted) {
            return back()->with('error', 'You have already submitted this quiz.');
        }

        $deadline = \Carbon\Carbon::parse($quiz->deadline . ' ' . $quiz->deadline_time);
        if (now()->gt($deadline)) {
            return back()->with('error', 'The deadline for this quiz has passed.');
        }

        $submissionData = [
            'quiz_id' => $quiz->id,
            'student_id' => $studentId,
            'submitted_at' => now(),
        ];

        if ($quiz->quiz_type === 'file') {
            $request->validate([
                'answer_file' => 'required|file|mimes:pdf,doc,docx|max:10240',
            ]);
            $submissionData['answer_file'] = $request->file('answer_file')->store('student_answers', 'public');
        } elseif ($quiz->quiz_type === 'mcq') {
            $request->validate([
                'answers' => 'required|string',
            ]);
            $submissionData['mcq_answers'] = $request->input('answers');
        } elseif ($quiz->quiz_type === 'written') {
            $request->validate([
                'written_answer' => 'required|string|min:5',
            ]);
            $submissionData['written_answer'] = $request->input('written_answer');
        }

        StudentQuizSubmission::create($submissionData);

        return back()->with('success', 'Your answer was submitted successfully.');
    }

    public function viewSubmissions($quizId)
    {
        $professorId = session('id');
        $quiz = Quiz::with('course')
            ->where('teacher_id', $professorId)
            ->findOrFail($quizId);

        $students = StudentsRegistration::where('class_id', $quiz->class_id)
            ->with('user')
            ->get();

        $submissions = StudentQuizSubmission::where('quiz_id', $quiz->id)
            ->get()
            ->keyBy('student_id');

        return view('faculity_dashboard.viewQuizSubmissions', compact('quiz', 'students', 'submissions'));
    }

    public function storeMarks(Request $request, $quizId)
    {
        $professorId = session('id');
        $quiz = Quiz::where('teacher_id', $professorId)->findOrFail($quizId);

        $request->validate([
            'student_marks' => 'nullable|array',
            'student_marks.*' => 'nullable|numeric|min:0',
        ]);

        $allowedStudentIds = StudentsRegistration::where('class_id', $quiz->class_id)
            ->whereNotNull('user_id')
            ->pluck('user_id')
            ->toArray();

        $marks = $request->input('student_marks', []);
        foreach ($marks as $studentId => $mark) {
            if (!in_array((int) $studentId, $allowedStudentIds, true)) {
                continue;
            }

            if ($mark === null || $mark === '') {
                continue;
            }

            StudentQuizSubmission::updateOrCreate(
                ['quiz_id' => $quiz->id, 'student_id' => $studentId],
                ['marks' => $mark]
            );
        }

        return back()->with('success', 'Quiz marks saved successfully.');
    }

    public function updateTimeline(Request $request, $quizId)
    {
        $teacherId = session('id');
        $quiz = Quiz::where('teacher_id', $teacherId)->findOrFail($quizId);

        $validated = $request->validate([
            'deadline' => 'required|date',
            'deadline_time' => 'required|date_format:H:i',
        ]);

        $oldDateTime = Carbon::parse($quiz->deadline . ' ' . $quiz->deadline_time);
        $newDateTime = Carbon::parse($validated['deadline'] . ' ' . $validated['deadline_time']);

        if ($newDateTime->lt($oldDateTime)) {
            return back()->withErrors('New quiz deadline must be the same or later than the current deadline.');
        }

        $quiz->update([
            'deadline' => $validated['deadline'],
            'deadline_time' => $validated['deadline_time'],
        ]);

        return back()->with('success', 'Quiz timeline updated successfully.');
    }

   public function UploadQuizzes()
{
    $professorId = Session::get('id'); 
    $offerCourses = OfferCourse::with(['course', 'class'])
                    ->where('professor_id', $professorId)
                    ->get();

    return view('faculity_dashboard.UploadQuizzes', compact('offerCourses'));
}
    public function store(Request $request)
    {
        $teacherId = session('id');
        if (!$teacherId) {
            return back()->with('error', 'Please login first.');
        }

        $validated = $request->validate([
            'quiz_title' => 'required|string|max:255',
            'quiz_type' => 'required|in:file,mcq,written',
            'deadline' => 'required|date|after_or_equal:today',
            'deadline_time' => 'required|date_format:H:i',
            'course_id' => [
                'required',
                Rule::exists('offer_courses', 'course_id')->where(function ($query) use ($teacherId) {
                    $query->where('professor_id', $teacherId);
                }),
            ],
            'class_id' => [
                'required',
                Rule::exists('offer_courses', 'class_id')->where(function ($query) use ($teacherId) {
                    $query->where('professor_id', $teacherId);
                }),
            ],
        ]);

        $offeredCourse = OfferCourse::where('professor_id', $teacherId)
            ->where('course_id', $validated['course_id'])
            ->where('class_id', $validated['class_id'])
            ->first();

        if (!$offeredCourse) {
            return back()->with('error', 'Invalid course/class selection for this professor.');
        }

        $data = [
            'course_id' => $validated['course_id'],
            'class_id' => $validated['class_id'],
            'quiz_title' => $validated['quiz_title'],
            'quiz_type' => $validated['quiz_type'],
            'deadline' => $validated['deadline'],
            'deadline_time' => $validated['deadline_time'],
            'teacher_id' => $teacherId,
        ];

        if ($validated['quiz_type'] === 'file') {
            $request->validate([
                'quiz_file' => 'required|file|mimes:pdf,doc,docx|max:10240',
            ]);
            $data['quiz_file'] = $request->file('quiz_file')->store('quizzes', 'public');
        } elseif ($validated['quiz_type'] === 'mcq') {
            $request->validate([
                'quiz_data' => 'required|json',
            ]);
            $decodedQuizData = json_decode($request->input('quiz_data'), true);
            if (!is_array($decodedQuizData) || count($decodedQuizData) === 0) {
                return back()->withInput()->with('error', 'Please add at least one MCQ question.');
            }

            foreach ($decodedQuizData as $question) {
                if (
                    !isset($question['question'], $question['options'], $question['correct_option']) ||
                    !is_array($question['options']) ||
                    count($question['options']) !== 4
                ) {
                    return back()->withInput()->with('error', 'Invalid MCQ format. Each question needs 4 options and a correct answer.');
                }
            }

            $data['quiz_data'] = json_encode($decodedQuizData);
        } elseif ($validated['quiz_type'] === 'written') {
            $request->validate([
                'written_questions' => 'required|string|min:5',
            ]);
            $data['written_questions'] = $request->input('written_questions');
        }

        Quiz::create($data);

        return redirect()->back()->with('success', 'Quiz created successfully.');
    }

    public function showQuizzes()
    {
        $studentId = session('id');
        if (!$studentId) {
            return redirect()->route('home')->with('error', 'Please login first.');
        }

        $quizzes = Quiz::with(['course', 'class'])
            ->whereExists(function ($query) use ($studentId) {
                $query->selectRaw(1)
                    ->from('student_course_registrations as scr')
                    ->join('offer_courses as oc', 'oc.id', '=', 'scr.offered_course_id')
                    ->whereColumn('oc.course_id', 'quizzes.course_id')
                    ->whereColumn('oc.class_id', 'quizzes.class_id')
                    ->where('scr.student_id', $studentId);
            })
            ->latest()
            ->get();

        foreach ($quizzes as $quiz) {
            $quiz->already_submitted = StudentQuizSubmission::where('quiz_id', $quiz->id)
                ->where('student_id', $studentId)
                ->exists();

            $quiz->is_deadline_over = now()->gt(
                \Carbon\Carbon::parse($quiz->deadline . ' ' . $quiz->deadline_time)
            );
        }

        return view('Students_Quizzes_Display', compact('quizzes'));
    }

}
