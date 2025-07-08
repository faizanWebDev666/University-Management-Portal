<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class AdminCourseController extends Controller
{
    public function show($id)
{
    $course = Course::findOrFail($id);
    return view('backend.view-courses', compact('course'));
}

public function edit($id)
{
    $course = Course::findOrFail($id);
    return view('backend.edit-courses', compact('course'));
}

public function update(Request $request, $id)
{
    $course = Course::findOrFail($id);
    $course->update($request->all());
    return redirect()->route('display.Courses')->with('success', 'Course updated successfully.');
}

public function destroy($id)
{
    $course = Course::findOrFail($id);
    $course->delete();
    return redirect()->route('display.Courses')->with('success', 'Course deleted.');
}

}
