<?php

namespace App\Http\Controllers;

use App\Models\LeaveRequest;
use Illuminate\Http\Request;

class leaveController extends Controller
{

    public function adminViewLeaves()
{
    $leaveRequests = LeaveRequest::with('faculty')->latest()->get();

    return view('backend.leave-applications',compact('leaveRequests'));
}

    public function show()
{
    $facultyId = session('id');
    $leaveRequests = LeaveRequest::where('faculty_id', $facultyId)->orderByDesc('created_at')->get();

    return view('faculity_dashboard.view-leave_requests', compact('leaveRequests'));
}

public function destroy($id)
{
    $leave = LeaveRequest::findOrFail($id);
    $leave->delete();

    return back()->with('success', 'Leave request deleted successfully.');
}
public function edit($id)
{
    $leave = LeaveRequest::findOrFail($id);
    return view('faculity_dashboard.edit-leave-request', compact('leave'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'leave_type' => 'required|string',
        'from_date' => 'required|date',
        'to_date' => 'required|date|after_or_equal:from_date',
        'reason' => 'required|string|max:1000',
    ]);

    $leave = LeaveRequest::findOrFail($id);
    $leave->leave_type = $request->leave_type;
    $leave->from_date = $request->from_date;
    $leave->to_date = $request->to_date;
    $leave->reason = $request->reason;
    $leave->save();

    return redirect()->route('faculty.leave.index')->with('success', 'Leave request updated successfully.');
}
public function updateStatus(Request $request, $id)
{
    $request->validate(['status' => 'required|in:Pending,Approved,Rejected']);
    
    $leave = LeaveRequest::findOrFail($id);
    $leave->status = $request->status;
    $leave->save();

    return back()->with('success', 'Leave status updated.');
}

}
