<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Models\Assignment;
use App\Models\AssignmentSubmission;
use App\Models\OfferCourse;
use App\Models\OfferCourses;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        'course_class' => ['required', 'string', 'regex:/^\d+\|\\d+$/'],
         'total_marks' => 'required|integer|min:1|max:1000',
    ]);
    [$courseId, $classId] = explode('|', $request->course_class);
    $filePath = $request->file('assignment_file')->store('assignments', 'public');
    Assignment::create([
        'assignment_title' => $request->assignment_title,
        'assignment_file' => $filePath,
        'deadline' => $request->deadline,
        'teacher_id' => $teacherId,
        'course_id' => $courseId,
        'class_id' => $classId,
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

    $assignments = Assignment::whereIn('course_id', $courseIds)
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
    $request->validate([
        'submission_file' => 'required|file|mimes:pdf,doc,docx|max:2048',
    ]);

    $studentId = session('id'); // you must set this at login
    if (!$studentId) {
        return back()->withErrors('You must be logged in as a student to submit.');
    }

    $filePath = $request->file('submission_file')->store('submissions', 'public');

    AssignmentSubmission::create([
        'assignment_id' => $assignmentId,
        'student_id' => $studentId,
        'file_path' => $filePath,
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

    return view('faculity_dashboard.viewAssignmentsSubmissions', compact('assignment'));
}

}
