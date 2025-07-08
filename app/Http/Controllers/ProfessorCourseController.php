<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;

class ProfessorCourseController extends Controller
{
    public function AllocateCoursesToProfessors(Request $request)
    {
        // Validate form input
        $request->validate([
            'professor_id' => 'required|exists:users,id',
            'course_ids' => 'required|array',
            'course_ids.*' => 'exists:courses,id',
        ]);

        // Find the professor
        $professor = User::findOrFail($request->professor_id);

        // Attach selected courses to professor
        $professor->courses()->syncWithoutDetaching($request->course_ids);

        return redirect()->back()->with('success', 'Courses allocated successfully.');
    }
    public function AllocateCoursesToProfessorsForm()
    {
        // Get all professors and courses
        $professors = User::where('type', 'professor')->get();
        $courses = Course::all(); 
        $classes = Classes::orderBy('year', 'desc')->orderBy('semester')->get();

        return view('faculity_dashboard.AllocateCoursesToProfessorsForm', compact('professors', 'courses','classes'));
    }

}
