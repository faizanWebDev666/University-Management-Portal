<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HostelRequest;
use App\Models\Hostel;
use App\Models\Room;
use App\Models\RoomAllocation;
use Illuminate\Support\Facades\Session;

class HostelRequestController extends Controller
{
    // Show form
  public function create()
    {
        return view('student_hostel_request');
    }

    // Store request
    public function store(Request $request)
    {
        // Validate input
        $validated = $request->validate([
            'hostel_type' => 'required|string',
            'room_type' => 'required|string',
            'duration' => 'required|integer|in:1,2',
            'semester' => 'required|string',
            'emergency_name' => 'required|string',
            'emergency_number' => 'required|string',
            'medical_info' => 'nullable|string',
            'address' => 'required|string',
            'reason' => 'required|string',
        ]);

        // Prevent duplicate request
        $student_id = Session::get('id'); // or auth()->id() if using auth
        if (HostelRequest::where('student_id', $student_id)->exists()) {
            return back()->with('error', 'You already submitted a hostel request.');
        }

        // Create request
        HostelRequest::create([
            'student_id' => $student_id,
            'hostel_type' => $validated['hostel_type'],
            'room_type' => $validated['room_type'],
            'duration' => $validated['duration'],
            'semester' => $validated['semester'],
            'emergency_name' => $validated['emergency_name'],
            'emergency_number' => $validated['emergency_number'],
            'medical_info' => $validated['medical_info'] ?? 'N/A',
            'address' => $validated['address'],
            'reason' => $validated['reason'],
        ]);

        return back()->with('success', 'Hostel request submitted successfully!');
    }

    public function index()
    {
        return view('Hostal_Dashboard.index');
    }
    
    public function hostalrequest()
    {
       $hostelRequests = HostelRequest::with('student')->latest()->get();
        return view('Hostal_Dashboard.Students_requests', compact('hostelRequests'));
    }

    // Show room allocation page
    public function showAllocationPage()
    {
        $pendingRequests = HostelRequest::with('student')
            ->where('status', 'pending')
            ->latest()
            ->get();

        $hostels = Hostel::with('rooms')->get();
        $allocations = RoomAllocation::with(['student', 'room', 'hostelRequest'])->get();

        return view('Hostal_Dashboard.allocateRooms', compact('pendingRequests', 'hostels', 'allocations'));
    }

    // Allocate bed to student
    public function allocateRoom(Request $request)
    {
        $validated = $request->validate([
            'hostel_request_id' => 'required|exists:hostel_requests,id',
            'room_id' => 'required|exists:rooms,id',
            'bed_number' => 'required|integer|min:1',
            'notes' => 'nullable|string'
        ]);

        $hostelRequest = HostelRequest::findOrFail($validated['hostel_request_id']);
        $room = Room::findOrFail($validated['room_id']);

        // Validate bed number is within room's bed count
        if ($validated['bed_number'] > $room->beds) {
            return back()->with('error', 'Invalid bed number for this room!');
        }

        // Check if bed is already occupied
        $existingAllocation = RoomAllocation::where('room_id', $validated['room_id'])
            ->where('bed_number', $validated['bed_number'])
            ->where('status', 'allocated')
            ->first();

        if ($existingAllocation) {
            return back()->with('error', 'This bed is already occupied!');
        }

        // Check if student already allocated
        $studentAllocation = RoomAllocation::where('student_id', $hostelRequest->student_id)
            ->where('status', 'allocated')
            ->first();

        if ($studentAllocation) {
            return back()->with('error', 'This student already has a bed allocated!');
        }

        // Create allocation
        RoomAllocation::create([
            'hostel_request_id' => $validated['hostel_request_id'],
            'room_id' => $validated['room_id'],
            'student_id' => $hostelRequest->student_id,
            'bed_number' => $validated['bed_number'],
            'status' => 'allocated',
            'allocated_at' => now(),
            'notes' => $validated['notes'] ?? null
        ]);

        // Update hostel request status
        $hostelRequest->update(['status' => 'approved']);

        return back()->with('success', 'Bed allocated successfully!');
    }

    // Remove allocation
    public function removeAllocation($id)
    {
        $allocation = RoomAllocation::findOrFail($id);
        
        $allocation->update([
            'status' => 'vacated',
            'vacated_at' => now()
        ]);

        // Revert hostel request status to pending
        $allocation->hostelRequest->update(['status' => 'pending']);

        return back()->with('success', 'Allocation removed and student marked as vacated!');
    }
}

