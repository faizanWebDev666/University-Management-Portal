<?php

namespace App\Http\Controllers;

use App\Models\LeaveRequest;
use Illuminate\Http\Request;

class AdminleaveRequestsController extends Controller
{
    public function edit($id)
{
    $leave = LeaveRequest::findOrFail($id);
    return view('backend.edit-requests', compact('leave'));
}
public function destroy($id)
{
    $leave = LeaveRequest::findOrFail($id);
    $leave->delete();

    return back()->with('success', 'Leave request deleted successfully.');
}
public function update(Request $request, $id)
{
    $leave = LeaveRequest::findOrFail($id);

    $validated = $request->validate([
        'from_date'        => 'required|date',
        'to_date'          => 'required|date|after_or_equal:from_date',
        'status'           => 'required|in:Pending,Approved,Rejected,Accepted With Modifications',
        'rejection_reason' => 'nullable|string|max:500',
    ]);

    $leave->from_date = $validated['from_date'];
    $leave->to_date = $validated['to_date'];
    $leave->status = $validated['status'];

    // Only set rejection_reason if status is Rejected or Accepted With Modifications
    if (in_array($validated['status'], ['Rejected', 'Accepted With Modifications'])) {
        $leave->rejection_reason = $validated['rejection_reason'];
    } else {
        $leave->rejection_reason = null;
    }

    $leave->save();

    return redirect()->route('admin.viewLeaves')->with('success', 'Leave request updated successfully.');
}



}
