<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hostel;

class HostelController extends Controller
{
    // Show form to add hostel
    public function create()
    {
        return view('Hostal_Dashboard.addHostel'); // create.blade.php
    }

    // Store new hostel
public function store(Request $request)
{
    // Validate hostel basic info
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'type' => 'required|in:Boys,Girls',
        'address' => 'nullable|string',
        'description' => 'nullable|string',
    ]);

    // Create the hostel
    $hostel = Hostel::create($validated);

    // Save hostel-wide facilities if any
    $facilities = $request->input('facilities', []);
    if ($facilities) {
        $hostel->facilities = json_encode($facilities);
        $hostel->save();
    }

    // Save rooms if any
    $rooms = $request->input('rooms', []);
    if (!empty($rooms)) {
        foreach ($rooms as $roomName => $roomData) {
            // Normalize checkbox: if not set, set to 0, if set, set to 1
            $roomData['attached_bathroom'] = isset($roomData['attached_bathroom']) ? 1 : 0;

            // Validate room data
            $roomValidated = validator($roomData, [
                'persons' => 'required|integer|min:1',
                'beds' => 'required|integer|min:1',
                'washrooms' => 'required|integer|min:0',
                'type' => 'required|in:AC,Non-AC',
                'attached_bathroom' => 'required|boolean', // now always exists
            ])->validate();

            // Create room record
            $hostel->rooms()->create([
                'name' => $roomName,
                'persons' => $roomValidated['persons'],
                'beds' => $roomValidated['beds'],
                'washrooms' => $roomValidated['washrooms'],
                'type' => $roomValidated['type'],
                'attached_bathroom' => $roomValidated['attached_bathroom'],
            ]);
        }
    }

    return back()->with('success', 'Hostel added successfully with rooms!');
}



    // Show all available hostels with rooms
    public function show()
    {
        $hostels = Hostel::with('rooms')->latest()->get();
        return view('Hostal_Dashboard.availableHostels', compact('hostels'));
    }
}
