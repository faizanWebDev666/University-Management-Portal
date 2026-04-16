<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Models\Assignment;
use App\Models\AssignmentSubmission;
use App\Models\OfferCourse;
use App\Models\OfferCourses;
use App\Models\StudentsRegistration;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AssignmentController extends Controller
{
//  public function UploadAssignments()
// {
//    $userId = session('id');
//     dd($userId);

//     // Get all offer_courses rows for this professor
//     $offers = OfferCourses::with(['course', 'class'])
//                 ->where('professor_id', $userId)
//                 ->get();

//     // Group courses by class
//     $classCourseMap = [];

//     foreach ($offers as $offer) {
//         $classId = $offer->class->id;
//         $className = $offer->class->name;
//         $course = $offer->course;

//         if (!isset($classCourseMap[$classId])) {
//             $classCourseMap[$classId] = [
//                 'class_name' => $className,
//                 'courses' => [],
//             ];
//         }

//         $classCourseMap[$classId]['courses'][] = [
//             'id' => $course->id,
//             'name' => $course->name,
//         ];
//     }

//     return view('faculity_dashboard.UploadAssignments', compact('classCourseMap'));
// }

public function UploadAssignments(Request $request)
{
    $professorId = Session::get('id'); // assuming professor is logged in via session
// dd(Session::get('id'));

    $offerCourses = OfferCourse::with(['course', 'class'])
                    ->where('professor_id', $professorId)
                    ->get();
// dd($offerCourses);
    return view('faculity_dashboard.UploadAssignments', compact('offerCourses'));
}

 public function store(Request $request)
{
    $teacherId = session('id');

    if (!$teacherId) {
        return back()->withErrors('You must be logged in as a professor to upload assignments.');
    }
    $request->validate([
        'assignment_title' => 'required|string|max:255',
        'assignment_file' => 'required|file|mimes:pdf,doc,docx|max:2048',
        'deadline' => 'required|date',
        'course_id' => 'required|exists:courses,id',
        'class_id' => 'required|exists:classes,id',
        'total_marks' => 'required|integer|min:1|max:1000',
    ]);
    $filePath = $request->file('assignment_file')->store('assignments', 'public');
    Assignment::create([
        'assignment_title' => $request->assignment_title,
        'assignment_file' => $filePath,
        'deadline' => $request->deadline,
        'teacher_id' => $teacherId,
        'course_id' => $request->course_id,
        'class_id' => $request->class_id,
        'total_marks' => $request->total_marks,
    ]);
    return redirect()->back()->with('success', 'Assignment uploaded successfully.');
}



public function studentAssignments()
{
    $studentId = session('id');

    if (!$studentId) {
        return redirect('/login')->with('error', 'Please login first.');
    }

    $student = User::with('registeredCourses')->find($studentId);

    if (!$student) {
        return redirect('/login')->with('error', 'Student not found.');
    }

    $courseIds = $student->registeredCourses->pluck('course_id');

  $assignments = Assignment::with('course') // eager load course details
    ->whereIn('course_id', $courseIds)
    ->where('deadline', '>', Carbon::now())
    ->latest()
    ->get();


    $submissions = AssignmentSubmission::where('student_id', $studentId)
        ->get()
        ->keyBy('assignment_id');

    return view('StudentsAssignments', compact('assignments', 'submissions'));
}


public function Assignmentsubmission(Request $request, $assignmentId)
{
    $assignment = Assignment::findOrFail($assignmentId);

    $request->validate([
        'submission_file' => 'required|file|mimes:pdf,doc,docx|max:2048',
    ]);

    $studentId = session('id'); // you must set this at login
    if (!$studentId) {
        return back()->withErrors('You must be logged in as a student to submit.');
    }

    if (Carbon::parse($assignment->deadline)->isPast()) {
        return back()->withErrors('Submission deadline has passed for this assignment.');
    }

    $alreadySubmitted = AssignmentSubmission::where('assignment_id', $assignmentId)
        ->where('student_id', $studentId)
        ->exists();

    if ($alreadySubmitted) {
        return back()->withErrors('You have already submitted this assignment.');
    }

    $filePath = $request->file('submission_file')->store('submissions', 'public');

    AssignmentSubmission::create([
        'assignment_id' => $assignmentId,
        'student_id' => $studentId,
        'file_path' => $filePath,
        'submitted_at' => now(),
    ]);

    return back()->with('success', 'Assignment submitted successfully.');
}

public function viewSubmissions($assignmentId)
{
    $teacherId = session('id');
    $assignment = Assignment::with('course')
        ->where('teacher_id', $teacherId)
        ->findOrFail($assignmentId);

    $students = StudentsRegistration::where('class_id', $assignment->class_id)
        ->with('user')
        ->get();

    $submissions = AssignmentSubmission::where('assignment_id', $assignment->id)
        ->get()
        ->keyBy('student_id');

    return view('faculity_dashboard.viewAssignmentSubmissions', compact('assignment', 'students', 'submissions'));
}

public function storeMarks(Request $request, $assignmentId)
{
    $teacherId = session('id');
    $assignment = Assignment::where('teacher_id', $teacherId)->findOrFail($assignmentId);

    $request->validate([
        'student_marks' => 'nullable|array',
        'student_marks.*' => 'nullable|numeric|min:0|max:' . (float) $assignment->total_marks,
    ]);

    $allowedStudentIds = StudentsRegistration::where('class_id', $assignment->class_id)
        ->whereNotNull('user_id')
        ->pluck('user_id')
        ->toArray();

    $studentMarks = $request->input('student_marks', []);
    foreach ($studentMarks as $studentId => $mark) {
        if (!in_array((int) $studentId, $allowedStudentIds, true)) {
            continue;
        }

        if ($mark === null || $mark === '') {
            continue;
        }

        $existingSubmission = AssignmentSubmission::where('assignment_id', $assignment->id)
            ->where('student_id', $studentId)
            ->first();

        if ($existingSubmission) {
            $existingSubmission->update(['marks' => $mark]);
            continue;
        }

        AssignmentSubmission::create([
            'assignment_id' => $assignment->id,
            'student_id' => $studentId,
            'file_path' => 'NO_SUBMISSION',
            'marks' => $mark,
            'submitted_at' => null,
        ]);
    }

    return back()->with('success', 'Assignment marks saved successfully.');
}

public function updateMeta(Request $request, $assignmentId)
{
    $teacherId = session('id');
    $assignment = Assignment::where('teacher_id', $teacherId)->findOrFail($assignmentId);

    $validated = $request->validate([
        'deadline' => 'required|date',
        'total_marks' => 'required|integer|min:1|max:1000',
    ]);

    $existingDeadline = Carbon::parse($assignment->deadline)->startOfDay();
    $newDeadline = Carbon::parse($validated['deadline'])->startOfDay();

    if ($newDeadline->lt($existingDeadline)) {
        return back()->withErrors('New assignment deadline must be the same or later than the current deadline.');
    }

    $assignment->update([
        'deadline' => $validated['deadline'],
        'total_marks' => $validated['total_marks'],
    ]);

    return back()->with('success', 'Assignment timeline and marks updated successfully.');
}

}
