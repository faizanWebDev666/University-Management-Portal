<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use App\Models\Course;
use App\Models\StudentsRegistration;
use App\Models\TeacherRegistration;
use App\Models\Task;
use App\Models\User;
use App\Models\Department;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $students = StudentsRegistration::count();
        $courses = Course::count();
        $professors = TeacherRegistration::count();
        return view('backend.index', compact('students', 'courses', 'professors'));
    }
     public function department()
    {
        return redirect()->route('departments.index');
    }
    
     public function signup()
    {

        return view('backend.register');
    }
     public function signin()
    {

        return view('backend.login');
    }
public function display_professors()
    {
         $teachers = TeacherRegistration::all();
        return view('backend.professors',compact('teachers'));
    }
    public function display_students()
    {
         $students = StudentsRegistration::paginate(10);
        return view('backend.students',compact('students'));
    }

 public function Courses()
    {
         $courses = Course::paginate(10);
        return view('backend.Courses',compact('courses'));
    }
     public function users()
    {
         $users = User::paginate(10);
        return view('backend.users', compact('users'));
    }
    public function Classes()
    {
        $classes = Classes::paginate(10);
        return view('backend.Classes',compact('classes'));

    }
    
    public function taskboard()
    {
        $tasks = Task::with('creator')->orderBy('created_at', 'desc')->get();
        $departments = Department::all();
        return view('backend.taskboard', compact('tasks', 'departments'));
    }
    
    public function storeTask(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'department' => 'required|string',
            'priority' => 'required|string|in:Low,Medium,High,Urgent',
            'due_date' => 'required|date|after:today',
            'file' => 'nullable|file|max:10240' // Max 10MB
        ]);
        
        $filePath = null;
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('tasks', $fileName, 'public');
        }

        // Create the task
        $task = Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'department' => $request->department,
            'priority' => $request->priority,
            'due_date' => $request->due_date,
            'file_path' => $filePath,
            'created_by' => session('id')
        ]);
        
        return redirect()->route('admin.taskboard')->with('success', 'Task created successfully!');
    }
    
    public function shareFile(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'department' => 'required|string',
            'type' => 'required|string|in:File,Information,Notice,Announcement',
            'files.*' => 'nullable|file|max:10240' // Max 10MB per file
        ]);
        
        // For now, we'll just redirect back with success message
        // In a real implementation, you would save to database and handle file uploads
        return redirect()->route('admin.taskboard')->with('success', 'File/Information shared successfully!');
    }
    
    public function updateTaskStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string|in:Pending,In Progress,Completed,Overdue'
        ]);
        
        $task = Task::findOrFail($id);
        $task->status = $request->status;
        $task->save();
        
        return redirect()->back()->with('success', 'Task status updated to ' . $request->status . ' successfully!');
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
        $newUser->type = 'admin'; // Normalize to lowercase
        $newUser->save();
    
        // Set session so the user is logged in immediately
        session()->put('id', $newUser->id);
        session()->put('type', $newUser->type);
        session()->put('name', $newUser->name);
    
        return redirect()->route('Admin.Dashboard')->with('success', 'Registration successful! Welcome to the Admin Dashboard.');
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
                return redirect()->route('Admin.signin')->with('error', 'Your account has been blocked.');
            }
    
            session()->put('id', $user->id);
            session()->put('type', strtolower($user->type)); // Normalize session type
            session()->put('name', $user->name);
    
            if (strtolower($user->type) === 'admin') {
                return redirect()->route('Admin.Dashboard');
            }
            elseif (strtolower($user->type) === 'finance') {
                return redirect('/faculityAdmin');
            }
            elseif (strtolower($user->type) === 'professor') {
                return redirect('/faculityAdmin');
            }
        }
    
        return redirect()->route('Admin.signin')->withInput()->with('error', 'Email or password is incorrect');
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
