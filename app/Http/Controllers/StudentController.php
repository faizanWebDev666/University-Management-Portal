<?php

namespace App\Http\Controllers;

use App\Models\StudentCourseRegistration;
use App\Models\Attendance;
use App\Models\Assignment;
use App\Models\Quiz;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function courseDetails($course_id)
    {
        $studentId = session('id');
        
        // Find the registration to ensure the student is enrolled in this course
        $registration = StudentCourseRegistration::with(['course', 'professor', 'class'])
            ->where('id', $course_id)
            ->where('student_id', $studentId)
            ->firstOrFail();

        $offeredCourseId = $registration->offered_course_id;

        // Fetch attendance for this specific course and student
        $attendances = Attendance::where('student_registration_id', function($query) use ($studentId) {
                $query->select('id')
                    ->from('students_registrations')
                    ->where('user_id', $studentId)
                    ->limit(1);
            })
            ->where('offer_course_id', $offeredCourseId)
            ->get();

        // Fetch assignments for this course and class
        $assignments = Assignment::where('course_id', $registration->course_id)
            ->where('class_id', $registration->class_id)
            ->with(['submissions' => function($query) use ($studentId) {
                $query->where('student_id', $studentId);
            }])
            ->get();

        // Fetch quizzes for this course and class
        $quizzes = Quiz::where('course_id', $registration->course_id)
            ->where('class_id', $registration->class_id)
            ->with(['submissions' => function($query) use ($studentId) {
                $query->where('student_id', $studentId);
            }])
            ->get();

        return view('Course-details', compact('registration', 'attendances', 'assignments', 'quizzes'));
    }
}
