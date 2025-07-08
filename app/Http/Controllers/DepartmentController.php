<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DepartmentController extends Controller
{
  
    // 1. Show All Unique Departments (from multiple tables)
    public function index()
    {
        $classDepartments = DB::table('classes')->pluck('department')->toArray();
        $studentDepartments = DB::table('students_registrations')->pluck('department')->toArray();

        $departments = collect(array_merge($classDepartments, $studentDepartments))
            ->unique()
            ->sort()
            ->values();

        return view('admin.departments.index', compact('departments'));
    }

    // 2. Show Department Details
    public function show($name)
    {
        $classes = DB::table('classes')->where('department', $name)->get();
        $students = DB::table('students_registrations')->where('department', $name)->get();
        $teachers = DB::table('teacher_registrations')->where('department_id', $name)->get(); // You may need to map ID to name

        return view('backend.show-departments', compact('name', 'classes', 'students', 'teachers'));
    }

    // 3. Edit Department Name
    public function edit($name)
    {
        return view('admin.departments.edit', compact('name'));
    }

    // 4. Update Department Name Across Tables
    public function update(Request $request, $oldName)
    {
        $request->validate(['new_name' => 'required|string|max:255']);

        $newName = $request->input('new_name');

        // Update in both tables
        DB::table('classes')->where('department', $oldName)->update(['department' => $newName]);
        DB::table('students_registrations')->where('department', $oldName)->update(['department' => $newName]);

        // If teacher_registrations uses department_id, you'd need a mapping to update it here

        return redirect()->route('departments.index')->with('success', 'Department name updated successfully.');
    }

    // 5. Delete Department (dangerous operation)
    public function destroy($name)
    {
        DB::table('classes')->where('department', $name)->delete();
        DB::table('students_registrations')->where('department', $name)->delete();

        // Only delete from teachers if your app logic allows this
        DB::table('teacher_registrations')->where('department_id', $name)->delete();

        return redirect()->route('departments.index')->with('success', 'Department deleted.');
    }
}


