<?php

namespace App\Http\Controllers;

use App\Models\TeacherRegistration;
use Illuminate\Http\Request;

class AdminProfessorController extends Controller
{
    public function show($id) {
    $teacher = TeacherRegistration::findOrFail($id);
    return view('backend.view-professor', compact('teacher'));
}
public function edit($id) {
    $teacher = TeacherRegistration::findOrFail($id);
    return view('backend.edit-teachers', compact('teacher'));
}
public function update(Request $request, $id) {
    $teacher = TeacherRegistration::findOrFail($id);
    $teacher->update($request->all());
    return redirect()->route('display.professors')->with('success', 'Updated successfully');
}
public function destroy($id) {
    $teacher = TeacherRegistration::findOrFail($id);
    $teacher->delete();
    return redirect()->route('display.professors')->with('success', 'Teacher deleted successfully');
}

}
