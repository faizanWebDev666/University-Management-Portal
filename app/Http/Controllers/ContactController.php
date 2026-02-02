<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function contact()
    {
        return view('contact');
    }
public function store(Request $request)
{
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'lastname' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'phone' => 'nullable|string|max:20',
        'department' => 'required|string|max:255',
        'message' => 'required|string',
    ]);

    Contact::create($validatedData);

    return response()->json([
        'message' => 'Your message has been sent successfully!'
    ]);
}


}
