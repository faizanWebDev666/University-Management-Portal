<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\User;
use App\Models\Attendance;
use App\Models\LeaveRequest;
use App\Models\OfferCourse;
use App\Models\ProfessorPermission;
use App\Models\StudentsRegistration;
use Illuminate\Http\Request;
use App\Models\StudentCourseRegistration;
use Illuminate\Support\Facades\Hash;
use App\Models\TeacherRegistration;
use App\Models\TeacherImage;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
class FaculityController extends Controller
{
public function profile()
{
    $userId = session('id');
    $user = User::findOrFail($userId);
    
    $professor = TeacherRegistration::where('email', $user->email)->with('image')->first();
    
    if (!$professor) {
        return redirect()->back()->with('error', 'Professor profile not found.');
    }
    
    return view('faculity_dashboard.profile', compact('professor', 'user'));
}

public function updateProfile(Request $request)
{
    $userId = session('id');
    $user = User::findOrFail($userId);
    $professor = TeacherRegistration::where('email', $user->email)->firstOrFail();

    $request->validate([
        'full_name' => 'required|string|max:255',
        'phone' => 'required|string|max:15',
        'address' => 'required|string',
        'city' => 'required|string',
        'country' => 'required|string',
        'teacher_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        'resume' => 'nullable|mimes:pdf,doc,docx|max:2048',
    ]);

    DB::transaction(function () use ($request, $user, $professor) {
        // Update Teacher Registration
        $professor->update([
            'full_name' => $request->full_name,
            'phone' => $request->phone,
            'address' => $request->address,
            'city' => $request->city,
            'country' => $request->country,
        ]);

        // Update User name
        $user->update(['name' => $request->full_name]);

        // Handle Image Upload
        if ($request->hasFile('teacher_image')) {
            $imageFile = $request->file('teacher_image');
            $imageName = Str::uuid() . '.' . $imageFile->getClientOriginalExtension();
            $imagePath = $imageFile->storeAs('teacher_images', $imageName, 'public');

            // Delete old image if exists
            $oldImage = TeacherImage::where('Teacher_id', $professor->id)->first();
            if ($oldImage) {
                Storage::disk('public')->delete($oldImage->image_path);
                $oldImage->update(['image_path' => $imagePath]);
            } else {
                TeacherImage::create([
                    'Teacher_id' => $professor->id,
                    'image_path' => $imagePath,
                ]);
            }
        }

        // Handle Resume Upload
        if ($request->hasFile('resume')) {
            // Delete old resume if exists
            if ($professor->resume) {
                Storage::disk('public')->delete($professor->resume);
            }

            $file = $request->file('resume');
            $resumeName = Str::uuid() . '.' . $file->getClientOriginalExtension();
            $resumePath = $file->storeAs('teacher_resumes', $resumeName, 'public');
            
            $professor->update(['resume' => $resumePath]);
        }
    });

    return redirect()->back()->with('success', 'Profile updated successfully!');
}

public function index()
{
    $userId = session('id'); 
    $user = User::findOrFail($userId);

    $professor = User::where('id', $userId)
        ->with(['offeredCourses.course', 'offeredCourses.class'])
        ->where('type', 'professor')
        ->first();
    
    $teacherReg = TeacherRegistration::where('email', $user->email)->with('image')->first();
   
    return view('faculity_dashboard.index', compact('professor', 'teacherReg'));
}
public function leave()
{

    return view('faculity_dashboard.leave-request');
}
public function store(Request $request)
{
    $request->validate([
        'leave_type' => 'required|string',
        'from_date' => 'required|date|after_or_equal:today',
        'to_date' => 'required|date|after_or_equal:from_date',
        'reason' => 'required|string|min:10',
    ]);

    LeaveRequest::create([
'faculty_id' => session('id'),
        'leave_type' => $request->leave_type,
        'from_date' => $request->from_date,
        'to_date' => $request->to_date,
        'reason' => $request->reason,
        'status' => 'Pending',
    ]);

    return redirect()->back()->with('success', 'Leave request submitted successfully.');
}

    public function WelcomeProfessor()
    {
        $userId = session('id'); 
       $offeredCourses = OfferCourse::where('professor_id', session('id'))->get();
        return view('faculity_dashboard.WelcomeProfessor', compact('offeredCourses'));
    }

    
   public function showquiz($quizId)
{
    $professorId = session('id'); // teacher id from session

    // Get quiz and related submissions with student info
    $quiz = Quiz::where('id', $quizId)
        ->where('teacher_id', $professorId)
        ->with(['submissions.student']) // eager load submissions and students
        ->firstOrFail();

    return view('faculity_dashboard.SubmittedQuizzes', compact('quiz'));
}

    public function courseDetails($uuid)
    {
        $userId = session('id');
        
        // Fetch the course by UUID
        $course = \App\Models\Course::where('uuid', $uuid)->firstOrFail();
        
        // Fetch the offered course with relationships
        $offeredCourse = OfferCourse::where('course_id', $course->id)
            ->where('professor_id', $userId)
            ->with(['course', 'class', 'professor'])
            ->firstOrFail();
        
        // Get all students in the class for this course, regardless of registration
        $registeredStudents = StudentsRegistration::where('class_id', $offeredCourse->class_id)
            ->with('user')
            ->get();

        // Pre-fetch all attendance sessions for this course to avoid N+1 inside student loop
        $allCourseAttendanceSessions = Attendance::where('offer_course_id', $offeredCourse->id)->get();
        $canEditMarkedAttendance = ProfessorPermission::where('professor_id', $userId)
            ->where('can_edit_marked_attendance', true)
            ->exists();

        foreach ($registeredStudents as $student) {
            // Calculate attendance percentage for this student from all sessions
            $presentCount = 0;
            $totalCount = $allCourseAttendanceSessions->count();

            foreach ($allCourseAttendanceSessions as $session) {
                $status = $session->getStatusForStudent($student->id);
                if ($status === 'present') {
                    $presentCount++;
                }
            }
            
            $student->attendance_percentage = $totalCount > 0 ? round(($presentCount / $totalCount) * 100, 2) : 0;

             // Mock the structure expected by the view for compatibility
             if (!$student->user) {
                 // Create a temporary object if User record doesn't exist yet
                 $student->student = (object)[
                     'name' => $student->full_name,
                     'email' => $student->email,
                     'registration' => $student
                 ];
             } else {
                 $student->student = $student->user;
                 $student->student->registration = $student;
             }
         }
        
        // Get assignments for this course using course_id and teacher_id
        $assignments = \App\Models\Assignment::where('course_id', $course->id)
            ->where('teacher_id', $userId)
            ->with('submissions')
            ->get();
        
        // Get quizzes for this course using course_id and teacher_id
        $quizzes = Quiz::where('course_id', $course->id)
            ->where('teacher_id', $userId)
            ->get();

        return view('faculity_dashboard.course-details', compact('offeredCourse', 'registeredStudents', 'assignments', 'quizzes', 'allCourseAttendanceSessions', 'canEditMarkedAttendance'));
    }

public function changePassword()
{
    return view('faculity_dashboard.professorchangepassword');
}
   public function updatePassword(Request $request)
    {
        // Validate the inputs
        $request->validate([
            'current_password' => 'required|string',
            'new_password' => 'required|string|min:8|confirmed', // requires new_password_confirmation
        ]);

        // Get user ID from session
        $userId = $request->session()->get('id');
        $userType = $request->session()->get('type');

        if (!$userId || $userType !== 'professor') {
            return redirect()->back()->with('error', 'You are not logged in or not authorized.');
        }

        // Get the user
        $user = User::find($userId);
        if (!$user) {
            return redirect()->back()->with('error', 'User not found.');
        }

        // Check previous password
        if ($request->current_password !== $user->password) { // Direct comparison like your login
            return redirect()->back()->with('error', 'Previous password is incorrect.');
        }

        // Update password
        $user->password = $request->new_password; // Keep consistent with your login logic
        $user->save();

        return redirect()->back()->with('success', 'Password updated successfully.');
    }

}
