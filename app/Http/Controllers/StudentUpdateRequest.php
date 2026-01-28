<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\models\StudentUpdate;
class StudentUpdateRequest extends Controller
{
     // Registration Branch sends request
    public function sendRequest()
    {
        $userId = session('id'); // Registration Branch user ID
        if (!$userId) {
            return response()->json(['message' => 'Please login first'], 401);
        }

        $exists = StudentUpdate::where('branch_user_id', $userId)
            ->where('status', 'pending')
            ->exists();

        if ($exists) {
            return response()->json(['message' => 'Your request is already pending.']);
        }

        StudentUpdate::create([
            'branch_user_id' => $userId,
            'status' => 'pending',
        ]);

        return response()->json(['message' => 'Request sent to admin successfully.']);
    }

    // Admin approves
    public function approve($id)
    {
        $req = StudentUpdate::findOrFail($id);
        $req->update(['status' => 'approved']);
        return back()->with('success', 'Permission granted.');
    }

    // Admin rejects
    public function reject($id)
    {
        $req = StudentUpdate::findOrFail($id);
        $req->update(['status' => 'rejected']);
        return back()->with('success', 'Request rejected.');
    }
}
