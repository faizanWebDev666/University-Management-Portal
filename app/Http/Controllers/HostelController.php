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
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:Boys,Girls',
            'capacity' => 'required|integer|min:1',
            'address' => 'nullable|string',
            'description' => 'nullable|string',
        ]);

        Hostel::create($validated);

        return back()->with('success', 'Hostel added successfully!');
    }

    // Optional: list all hostels
    public function index()
    {
        $hostels = Hostel::latest()->get();
        return view('hostel.index', compact('hostels'));
    }
}
