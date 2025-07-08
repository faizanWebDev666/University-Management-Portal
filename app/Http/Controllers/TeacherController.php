<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\AssignmentSubmission;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function viewSubmissions($id) {
    $assignment = Assignment::with('submissions.student')->findOrFail($id);
    return view('faculity_dashboard.viewAssignmentsSubmissions', compact('assignment'));
}
public function allAssignments()
{
    $teacherId = session('id');
    $assignments = Assignment::with(['class', 'course'])
                    ->where('teacher_id', $teacherId)
                    ->get();

    return view('faculity_dashboard.assignmentList', compact('assignments'));
}

public function grade(Request $request, $id)
{
    $request->validate([
        'marks' => 'required|integer|min:0',
    ]);

    $submission = AssignmentSubmission::findOrFail($id);
    $submission->marks = $request->marks;
    $submission->save();

    return back()->with('success', 'Marks submitted successfully.');
}

}
