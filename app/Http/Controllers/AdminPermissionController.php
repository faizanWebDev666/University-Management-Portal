<?php

namespace App\Http\Controllers;

use App\Models\ProfessorPermission;
use App\Models\User;
use Illuminate\Http\Request;

class AdminPermissionController extends Controller
{
    public function index()
    {
        $professors = User::where('type', 'professor')->orderBy('name')->get();
        $permissions = ProfessorPermission::pluck('can_edit_marked_attendance', 'professor_id');

        return view('backend.permissions', compact('professors', 'permissions'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'permissions' => 'nullable|array',
        ]);

        $permissionInput = $request->input('permissions', []);
        $professorIds = User::where('type', 'professor')->pluck('id');

        foreach ($professorIds as $professorId) {
            $canEditMarkedAttendance = (int) ($permissionInput[$professorId] ?? 0) === 1;

            ProfessorPermission::updateOrCreate(
                ['professor_id' => $professorId],
                ['can_edit_marked_attendance' => $canEditMarkedAttendance]
            );
        }

        return redirect()->back()->with('success', 'Professor permissions updated successfully.');
    }
}
