<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\LeaveRequest;
use App\Models\OfferCourse;
use App\Models\OfferCourses;
use App\Models\StudentCourseRegistration;
use App\Models\User;
use Illuminate\Http\Request;

class FaculityController extends Controller
{
public function index()
{
    $userId = session('id'); // or Auth::id()

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

    // Example saving logic
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
    $registeredStudents = collect(); // Default empty

    if ($offeredCourseId) {
        // Fetch students and their attendances for the selected offered course
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

        // Calculate attendance percentage
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
        $userId = session('id'); // or Auth::id() if using Auth
       $offeredCourses = OfferCourse::where('professor_id', session('id'))->get();
        return view('faculity_dashboard.WelcomeProfessor', compact('offeredCourses'));
    }
}
