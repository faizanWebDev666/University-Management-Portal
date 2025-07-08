<?php

namespace App\Http\Controllers;

use App\Models\OfferCourse;
use App\Models\User;
use Illuminate\Http\Request;

class CourseAllocationController extends Controller
{
public function store(Request $request)
{
    $request->validate([
        'professor_id' => 'required|exists:users,id',
        'course_ids' => 'required|array',
        'course_ids.*' => 'exists:courses,id',
        'class_id' => 'required|exists:classes,id',
    ]);

    // 1. Check total courses already assigned to the professor
    $existingCount = OfferCourse::where('professor_id', $request->professor_id)->count();
    $newCount = count($request->course_ids);

    if ($existingCount + $newCount > 4) {
        return redirect()->back()->with('error', 'Professor cannot be assigned more than 4 courses.');
    }

    foreach ($request->course_ids as $course_id) {
        // 2. Check if this course is already allocated to this class
        $alreadyExists = OfferCourse::where('course_id', $course_id)
            ->where('class_id', $request->class_id)
            ->exists();

        if ($alreadyExists) {
            return redirect()->back()->with('error', 'Course ID ' . $course_id . ' is already allocated to this class.');
        }

        // Create the offered course
        $offeredCourse = OfferCourse::create([
            'course_id' => $course_id,
            'class_id' => $request->class_id,
            'professor_id' => $request->professor_id,
        ]);

        // Attach all students of the class to the course
        $students = User::where('type', 'student')
                        ->where('class_id', $request->class_id)
                        ->get();

        foreach ($students as $student) {
            $student->offerCourses()->syncWithoutDetaching([$offeredCourse->id]);
        }
    }

    return redirect()->back()->with('success', 'Courses allocated to class and students successfully!');
}
}
