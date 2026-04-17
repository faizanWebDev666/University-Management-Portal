<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DepartmentController extends Controller
{
  
    // 1. Show All Departments
    public function index()
    {
        $departments = Department::all();
        return view('backend.departments', compact('departments'));
    }

    // 2. Show Create Form
    public function create()
    {
        return view('backend.create-department');
    }

    // 3. Store New Department
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:departments,name',
            'code' => 'required|string|max:50|unique:departments,code',
        ]);

        Department::create([
            'name' => $request->name,
            'code' => $request->code,
        ]);

        return redirect('/department')->with('success', 'Department created successfully.');
    }

    // 4. Show Department Details
    public function show($name)
    {
        // Get department by name or code
        $department = Department::where('name', $name)->orWhere('code', $name)->firstOrFail();

        $classes = DB::table('classes')->where('department', $department->name)->get();
        $students = DB::table('students_registrations')->where('department', $department->name)->get();
        $teachers = DB::table('teacher_registrations')->where('department_id', $department->id)->get();

        return view('backend.show-departments', compact('department', 'classes', 'students', 'teachers'));
    }


    // 5. Edit Department
    public function edit($name)
    {
        $department = Department::where('name', $name)->orWhere('code', $name)->firstOrFail();
        return view('backend.edit-department', compact('department'));
    }

    // 6. Update Department
    public function update(Request $request, $id)
    {
        $department = Department::findOrFail($id);
        $oldName = $department->name;

        $request->validate([
            'name' => 'required|string|max:255|unique:departments,name,' . $id,
            'code' => 'required|string|max:50|unique:departments,code,' . $id,
        ]);

        $department->update([
            'name' => $request->name,
            'code' => $request->code,
        ]);

        // Update name in related tables if necessary
        DB::table('classes')->where('department', $oldName)->update(['department' => $request->name]);
        DB::table('students_registrations')->where('department', $oldName)->update(['department' => $request->name]);

        return redirect('/department')->with('success', 'Department updated successfully.');
    }

    // 7. Delete Department
    public function destroy($id)
    {
        $department = Department::findOrFail($id);
        $name = $department->name;

        $department->delete();

        // Optional: decide if you want to delete related data or just set them to null/another dept
        // For now, following original logic (mostly)
        DB::table('classes')->where('department', $name)->delete();
        DB::table('students_registrations')->where('department', $name)->delete();

        return redirect('/department')->with('success', 'Department deleted.');
    }
}


