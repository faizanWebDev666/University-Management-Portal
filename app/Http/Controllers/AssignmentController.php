<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Models\Assignment;
use App\Models\AssignmentSubmission;
use App\Models\OfferCourse;
use App\Models\OfferCourses;
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
public function PostedAssignments()
{
    $teacherId = session('id'); // or Auth::id() if you're using Auth

    $assignments = Assignment::where('teacher_id', $teacherId)->get();

    return view('faculity_dashboard.PostedAssignments', compact('assignments'));
}
public function viewSubmissions($assignmentId)
{
    $assignment = Assignment::with('submissions.student')->findOrFail($assignmentId);
    return view('faculity_dashboard.viewAssignmentSubmissions', compact('assignment'));
}

public function storeMarks(Request $request, $assignmentId)
{
    $teacherId = session('id');
    $assignment = Assignment::where('teacher_id', $teacherId)->findOrFail($assignmentId);

    $request->validate([
        'marks.*' => 'nullable|integer|min:0',
    ]);

    foreach ($request->marks as $submissionId => $mark) {
        if ($mark !== null && (int) $mark > (int) $assignment->total_marks) {
            return back()->withErrors("Marks cannot exceed total marks ({$assignment->total_marks}).");
        }

        AssignmentSubmission::where('id', $submissionId)
            ->where('assignment_id', $assignment->id)
            ->update(['marks' => $mark]);
    }

    return back()->with('success', 'Marks updated successfully.');
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
