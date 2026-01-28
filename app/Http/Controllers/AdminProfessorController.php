<?php

namespace App\Http\Controllers;

use App\Models\TeacherImage;
use App\Models\TeacherRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
class AdminProfessorController extends Controller
{
public function show($id)
{
    $teacher = TeacherRegistration::with('images')->findOrFail($id);
    return view('backend.view-professor', compact('teacher'));
}

public function edit($id)
{
    $teacher = TeacherRegistration::with('images')->findOrFail($id);
    return view('backend.edit-teachers', compact('teacher'));
}



public function update(Request $request, $id)
{
    DB::transaction(function () use ($request, $id) {

        $teacher = TeacherRegistration::with('images')->findOrFail($id);

        // ✅ Validate fields
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'father_name' => 'required|string|max:255',
            'cnic' => 'required|string|max:20',
            'dob' => 'required|date',
            'gender' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
            'salary_type' => 'required|string',
            'salary' => 'required|numeric',
            'qualification' => 'nullable|string',
            'specialization' => 'nullable|string',
            'department_id' => 'required|integer',
            'designation' => 'required|string',
            'joining_date' => 'required|date',
            'username' => 'required|string',
            'role' => 'required|string',
            'address' => 'nullable|string',
            'country' => 'nullable|string',
            'city' => 'nullable|string',
            'state' => 'nullable|string',
            'teacher_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // 🔹 Store old name to detect change
        $oldName = $teacher->full_name;

        // ✅ Update teacher table
        $teacher->update($validated);

        // ✅ Sync ONLY name to users table if name changed
        if ($oldName !== $request->full_name) {
            DB::table('users')
                ->where('email', $teacher->email)   // OR ->where('id', $teacher->user_id)
                ->where('type', 'professor')
                ->update([
                    'name' => $request->full_name
                ]);
        }

        // ✅ Handle teacher image
        if ($request->hasFile('teacher_image')) {
            $imageName = Str::uuid() . '.' . $request->file('teacher_image')->getClientOriginalExtension();
            $imagePath = $request->file('teacher_image')->storeAs('teacher_images', $imageName, 'public');

            if ($teacher->images->first()) {
                Storage::disk('public')->delete($teacher->images->first()->image_path);
                $teacher->images->first()->update([
                    'image_path' => $imagePath,
                ]);
            } else {
                TeacherImage::create([
                    'Teacher_id' => $teacher->id,
                    'image_path' => $imagePath,
                ]);
            }
        }
    });

    return redirect()
        ->route('display.professors')
        ->with('success', 'Teacher updated successfully.');
}

public function destroy($id) {
    $teacher = TeacherRegistration::findOrFail($id);
    $teacher->delete();
    return redirect()->route('display.professors')->with('success', 'Teacher deleted successfully');
}

}
