<?php

namespace App\Http\Controllers;

use App\Models\OfferCourse;
use App\Models\Quiz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class QuizzesController extends Controller
{
  public function uploadStudentAnswer(Request $request, Quiz $quiz)
{
    $studentId = session('id');

    $alreadySubmitted = DB::table('student_quiz_submissions')
        ->where('quiz_id', $quiz->id)
        ->where('student_id', $studentId)
        ->exists();

    if ($alreadySubmitted) {
        return back()->with('error', 'You have already submitted this quiz.');
    }

    $deadline = \Carbon\Carbon::parse($quiz->deadline . ' ' . $quiz->deadline_time);
    if (now()->gt($deadline)) {
        return back()->with('error', 'The deadline for this quiz has passed.');
    }

    if ($quiz->quiz_type === 'file') {
        $request->validate([
            'answer_file' => 'required|file|mimes:pdf|max:10240'
        ]);

        $filePath = $request->file('answer_file')->store('student_answers', 'public');

        DB::table('student_quiz_submissions')->insert([
            'quiz_id' => $quiz->id,
            'student_id' => $studentId,
            'answer_file' => $filePath,
            'submitted_at' => now(),
        ]);
    } elseif ($quiz->quiz_type === 'mcq') {
        $request->validate([
            'answers' => 'required|string'
        ]);

        DB::table('student_quiz_submissions')->insert([
            'quiz_id' => $quiz->id,
            'student_id' => $studentId,
            'mcq_answers' => $request->input('answers'),
            'submitted_at' => now(),
        ]);
    }

    return back()->with('success', 'Your answer was submitted successfully.');
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
    [$courseId, $classId] = explode('|', $request->course_class);

    $validated = $request->validate([
        'quiz_title' => 'required|string|max:255',
        'quiz_type' => 'required|in:file,mcq,written',
        'deadline' => 'required|date|after_or_equal:today',
        'deadline_time' => 'required|date_format:H:i',
    ]);

    $data = [
        'course_id' => $courseId,
        'class_id' => $classId,
        'quiz_title' => $validated['quiz_title'],
        'quiz_type' => $validated['quiz_type'],
        'deadline' => $validated['deadline'],
        'deadline_time' => $validated['deadline_time'],
    ];

    if ($validated['quiz_type'] === 'file') {
        $request->validate([
            'quiz_file' => 'required|file|mimes:pdf,doc,docx|max:10240',
        ]);
        $filePath = $request->file('quiz_file')->store('quizzes', 'public');
        $data['quiz_file'] = $filePath;
    }
    elseif ($validated['quiz_type'] === 'mcq') {
        $request->validate([
            'quiz_data' => 'required|json',
        ]);
        $data['quiz_data'] = $request->input('quiz_data');
    }
    elseif ($validated['quiz_type'] === 'written') {
        $request->validate([
            'written_questions' => 'required|string',
        ]);
        $data['written_questions'] = $request->input('written_questions');
    }

    Quiz::create($data);

    return redirect()->back()->with('success', 'Quiz uploaded successfully.');
}
public function showQuizzes()
{
    $studentId = session('id'); // Use session ID for student
    $quizzes = Quiz::with(['course', 'class'])->latest()->get();

    foreach ($quizzes as $quiz) {
        // Check if already submitted
        $quiz->already_submitted = DB::table('student_quiz_submissions')
            ->where('quiz_id', $quiz->id)
            ->where('student_id', $studentId)
            ->exists();

        // Check if deadline is over
        $quiz->is_deadline_over = now()->gt(
            \Carbon\Carbon::parse($quiz->deadline . ' ' . $quiz->deadline_time)
        );
    }

    return view('Students_Quizzes_Display', compact('quizzes'));
}

}
