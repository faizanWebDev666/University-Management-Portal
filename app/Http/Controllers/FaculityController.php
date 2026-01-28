<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\User;
use App\Models\LeaveRequest;
use App\Models\OfferCourse;
use Illuminate\Http\Request;
use App\Models\StudentCourseRegistration;
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
    $offeredCourses = OfferCourse::with(['course', 'class'])->get();
    $offeredCourseId = $request->input('offered_course_id');
    $registeredStudents = collect();

    if ($offeredCourseId) {
        $registeredStudents = StudentCourseRegistration::with([
            'student.registration',
            'offeredCourse.course',
            'offeredCourse.class',
            'attendances' => function ($query) use ($offeredCourseId) {
                $query->where('offer_course_id', $offeredCourseId);
            }
        ])
        ->where('offered_course_id', $offeredCourseId)
        ->get();

        foreach ($registeredStudents as $reg) {
            $total = $reg->attendances->count();
            $present = $reg->attendances->where('status', 'present')->count();

            $reg->attendance_percentage = $total > 0 ? round(($present / $total) * 100, 2) : 0;
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
}
