<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\OfferCourse;
use App\Models\OfferCourses;
use App\Models\StudentCourseRegistration;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentsController extends Controller
{
  public function Students_Dashboard()
{
    $studentId = session('id'); 

    if (!$studentId) {
        return redirect('/')->with('error', 'Please login first.');
    }

    $student = User::find($studentId);

    if (!$student) {
        return redirect('/')->with('error', 'Invalid user session.');
    }

    $courses = $student->registeredCourses()->with(['course', 'class', 'professor'])->get();

    $attendancePercentages = [];

    foreach ($courses as $course) {
        $total = Attendance::where('student_registration_id', $studentId)
            ->where('offer_course_id', $course->id)
            ->count();

        $present = Attendance::where('student_registration_id', $studentId)
            ->where('offer_course_id', $course->id)
            ->where('status', 'present')
            ->count();

        $percentage = $total > 0 ? round(($present / $total) * 100) : 0;

        $attendancePercentages[$course->id] = $percentage;
    }

    return view('Students_Dashboard', compact('courses', 'attendancePercentages'));
}

public function Students_Offer_Courses_Display()
{
    $studentId = session('id');
    $student = User::with('class')->find($studentId);
    if (!$student || $student->type !== 'student') {
        abort(403, 'Unauthorized');
    }
    $classId = $student->class->id ?? null;

    if (!$classId) {
        return view('Students_Offer_Courses_Display', [
            'offeredCourses' => collect(),
            'message' => 'No class assigned to the student.'
        ]);
    }

    $offeredCourses = OfferCourse::with(['course', 'professor', 'class'])
        ->where('class_id', $classId)
        ->get();

    return view('Students_Offer_Courses_Display', compact('offeredCourses'));
}


public function registerCourse(Request $request)
{
    $studentId = session('id');
    $offeredCourseId = $request->input('offered_course_id');

    $registration = StudentCourseRegistration::where('student_id', $studentId)
                    ->where('offered_course_id', $offeredCourseId)
                    ->first();

    if ($registration) {
        $registration->status = $registration->status === 'registered' ? 'pending' : 'registered';
        $registration->save();
    } else {
        StudentCourseRegistration::create([
            'student_id' => $studentId,
            'offered_course_id' => $offeredCourseId,
            'status' => 'registered' // or 'pending' if desired
        ]);
    }

    return redirect()->back()->with('success', 'Status updated.');
}
}
