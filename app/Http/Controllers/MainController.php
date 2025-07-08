<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class MainController extends Controller
{
    public function index()
    {
        return view('index');
    } 

    public function registerUser(Request $data)
    {
        $data->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',

            'password' => [
                'required', 'string', 'min:8',
                'regex:/[A-Z]/', 'regex:/[a-z]/',
                'regex:/[0-9]/', 'regex:/[@$!%*?&#]/'

            ],
            'g-recaptcha-response' => 'required|captcha',
        ]);
    
    
        $newUser = new User();
        $newUser->name = $data->input('name');
        $newUser->email = $data->input('email');
        $newUser->password = $data->input('password');
        $newUser->type = 'customer';
        $newUser->save();
    
        // Mail::to($newUser->email)->send(new Verifyemail($newUser));
    
        return redirect('signin')->with('success', 'Registration successful! Please verify your email.');
    }
    
    public function loginUser(Request $data)
    {
        $data->validate([
            'email' => 'required|email',
            'password' => 'required',
            'g-recaptcha-response' => 'required|captcha', 
        ]);
    
        $user = User::where('email', $data->input('email'))->first();
    
        if ($user && $data->input('password') === $user->password) {
            if ($user->status === "Blocked") {
                return redirect('signin')->with('error', 'Your account has been blocked.');
            }
    
            session()->put('id', $user->id);
            session()->put('type', $user->type);
    
            if ($user->type === 'student') {
return redirect()->route('Students.dashboard');
            } elseif ($user->type === 'professor') {
                return redirect('/faculityAdmin');
            }
        }
    
        return redirect('/')->with('error', 'Email or password is incorrect');
    }
    public function logout()
{
    // If using Laravel authentication:
    // Auth::logout();

    // Clear all session data
    session()->flush();

    // Regenerate session ID to prevent session fixation
    session()->regenerate();

    return redirect('/')->with('success', 'You have been successfully logged out.');
}

}
