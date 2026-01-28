<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HostelRequest;
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
}
