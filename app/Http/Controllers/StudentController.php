<?php

namespace App\Http\Controllers;

use App\Models\StudentCourseRegistration;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function courseDetails($course_id)
{
    $course = StudentCourseRegistration::with('course', 'professor', 'class')->findOrFail($course_id);
    return view('Course-details', compact('course'));
}

}
