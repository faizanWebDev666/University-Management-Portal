<?php

namespace App\Http\Controllers;

use App\Models\StudentsRegistration;
use Illuminate\Http\Request;

class AdminStudentController extends Controller
{
    public function show($id) {
    $student = StudentsRegistration::findOrFail($id);
    return view('backend.view-students', compact('student'));
}

public function edit($id) {
    $student = StudentsRegistration::findOrFail($id);
    return view('backend.edit-students', compact('student'));
}

public function update(Request $request, $id) {
    $student = StudentsRegistration::findOrFail($id);
    $student->update($request->all());
    return redirect()->route('display.students')->with('success', 'Student updated successfully');
}

public function destroy($id) {
    StudentsRegistration::destroy($id);
    return redirect()->route('display.students')->with('success', 'Student deleted successfully');
}

}
