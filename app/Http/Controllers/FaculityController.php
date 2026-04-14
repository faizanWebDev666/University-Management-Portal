<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\User;
use App\Models\Attendance;
use App\Models\LeaveRequest;
use App\Models\OfferCourse;
use App\Models\StudentsRegistration;
use Illuminate\Http\Request;
use App\Models\StudentCourseRegistration;
use Illuminate\Support\Facades\Hash;
class FaculityController extends Controller
{
public function index()
{
    $userId = session('id'); 

    $professor = User::where('id', $userId)
        ->with(['offeredCourses.course', 'offeredCourses.class'])
        ->where('type', 'professor')
        ->first();
   
    return view('faculity_dashboard.index', compact('professor'));
}
public function leave()
{

    return view('faculity_dashboard.leave-request');
}
public function store(Request $request)
{
    $request->validate([
        'leave_type' => 'required|string',
        'from_date' => 'required|date|after_or_equal:today',
        'to_date' => 'required|date|after_or_equal:from_date',
        'reason' => 'required|string|min:10',
    ]);

    LeaveRequest::create([
'faculty_id' => session('id'),
        'leave_type' => $request->leave_type,
        'from_date' => $request->from_date,
        'to_date' => $request->to_date,
        'reason' => $request->reason,
        'status' => 'Pending',
    ]);

    return redirect()->back()->with('success', 'Leave request submitted successfully.');
}
public function Students_Attendence(Request $request)
{
    $userId = session('id');
    $offeredCourses = OfferCourse::where('professor_id', $userId)->with(['course', 'class'])->get();
    $offeredCourseId = $request->offered_course_id;
    $registeredStudents = collect();

    if ($offeredCourseId) {
        $registeredStudents = StudentCourseRegistration::with([
            'student.registration',
            'offeredCourse.class',
        ])
        ->where('offered_course_id', $offeredCourseId)
        ->get();

        foreach ($registeredStudents as $row) {
            $registrationId = $row->student->registration->id ?? null;
            if ($registrationId) {
                // Get attendances directly from DB to avoid collection filtering issues
                $courseAttendances = Attendance::where('student_registration_id', $registrationId)
                    ->where('offer_course_id', $offeredCourseId)
                    ->get();
                
                $total = $courseAttendances->count();
                $present = $courseAttendances->where('status', 'present')->count();
                $row->attendance_percentage = $total > 0 ? round(($present / $total) * 100, 2) : 0;
            } else {
                $row->attendance_percentage = 0;
            }
            $row->is_registered = true; // Since they are in the StudentCourseRegistration table
        }
    }

    return view('faculity_dashboard.Students_Attendence', compact('offeredCourses', 'registeredStudents', 'offeredCourseId'));
}
    public function WelcomeProfessor()
    {
        $userId = session('id'); 
       $offeredCourses = OfferCourse::where('professor_id', session('id'))->get();
        return view('faculity_dashboard.WelcomeProfessor', compact('offeredCourses'));
    }

    
   public function showquiz($quizId)
{
    $professorId = session('id'); // teacher id from session

    // Get quiz and related submissions with student info
    $quiz = Quiz::where('id', $quizId)
        ->where('teacher_id', $professorId)
        ->with(['submissions.student']) // eager load submissions and students
        ->firstOrFail();

    return view('faculity_dashboard.SubmittedQuizzes', compact('quiz'));
}

public function courseDetails($uuid)
{
    $userId = session('id');
    
    // Fetch the course by UUID
    $course = \App\Models\Course::where('uuid', $uuid)->firstOrFail();
    
    // Fetch the offered course with relationships
    $offeredCourse = OfferCourse::where('course_id', $course->id)
        ->where('professor_id', $userId)
        ->with(['course', 'class', 'professor'])
        ->firstOrFail();
    
    // Get all registered students for this course
    $registeredStudents = StudentCourseRegistration::with([
        'student.registration',
        'offeredCourse.course'
    ])
    ->where('offered_course_id', $offeredCourse->id)
    ->get();
    
    // Get assignments for this course using course_id and teacher_id
    $assignments = \App\Models\Assignment::where('course_id', $course->id)
        ->where('teacher_id', $userId)
        ->with('submissions')
        ->get();
    
    // Get quizzes for this course using course_id and teacher_id
    $quizzes = Quiz::where('course_id', $course->id)
        ->where('teacher_id', $userId)
        ->get();

    return view('faculity_dashboard.course-details', compact('offeredCourse', 'registeredStudents', 'assignments', 'quizzes'));
}

public function changePassword()
{
    return view('faculity_dashboard.professorchangepassword');
}
   public function updatePassword(Request $request)
    {
        // Validate the inputs
        $request->validate([
            'current_password' => 'required|string',
            'new_password' => 'required|string|min:8|confirmed', // requires new_password_confirmation
        ]);

        // Get user ID from session
        $userId = $request->session()->get('id');
        $userType = $request->session()->get('type');

        if (!$userId || $userType !== 'professor') {
            return redirect()->back()->with('error', 'You are not logged in or not authorized.');
        }

        // Get the user
        $user = User::find($userId);
        if (!$user) {
            return redirect()->back()->with('error', 'User not found.');
        }

        // Check previous password
        if ($request->current_password !== $user->password) { // Direct comparison like your login
            return redirect()->back()->with('error', 'Previous password is incorrect.');
        }

        // Update password
        $user->password = $request->new_password; // Keep consistent with your login logic
        $user->save();

        return redirect()->back()->with('success', 'Password updated successfully.');
    }

}
