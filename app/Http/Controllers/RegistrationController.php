<?php

namespace App\Http\Controllers;
use App\Models\Classes;
    use App\Models\Course;
    use App\Models\StudentImage;
    use App\Models\StudentsRegistration;
    use App\Models\TeacherImage;
    use App\Models\TeacherRegistration;
    use App\Models\User;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\DB;
    use Illuminate\Support\Facades\Hash;
    use Illuminate\Support\Facades\Mail;
    use Illuminate\Support\Str;

class RegistrationController extends Controller
{
    public function Registration_index()
    {
        return view('faculity_dashboard.Registration_index');
    }

      public function delete()
    {
        return view('faculity_dashboard.Delete-Account');
    }
  
    public function OfferCoursesToClasses()
{
    $professors = User::where('type', 'professor')->get(); // Correct
    $courses = Course::all();
    $classes = Classes::orderBy('year', 'desc')->orderBy('semester')->get();

    return view('faculity_dashboard.OfferCoursesToClasses', compact('professors', 'courses', 'classes'));
}

    
    public function RegisterTeachers()
    {
        return view('faculity_dashboard.RegisterTeachers');
    } 
    public function RegisterStudents()
    {
        $classes = Classes::all(); // fetch all classes from DB
        return view('faculity_dashboard.RegisterStudents', compact('classes'));
    }

    public function NewCourseRegistration()
    {
        return view('faculity_dashboard.NewCourseRegistration');
    } 
    public function RegisterNewClasses()
    {
        return view('faculity_dashboard.RegisterNewClasses');
    } 
    
    public function storeClasses(Request $request)
    {
        $request->validate([
            'semester' => 'required|in:Fall,Spring',
            'year' => 'required|integer',
            'section' => 'required|in:A,B,C,D,E',
            'department' => 'required|string',
            'degree_program' => 'required|in:BS,MS,PhD',
        ]);

        $class = new Classes();
        $class->semester = $request->semester;
        $class->year = $request->year;
        $class->section = $request->section;
        $class->department = $request->department;
        $class->degree_program = $request->degree_program;

        $class->save();

        return redirect()->back()->with('success', 'Courses allocated successfully');
    }
    
   
    public function storeCourses(Request $request)
    {
       
            $validated = $request->validate([
                'course_name' => 'required|string|max:255',
                'course_code' => 'required|string|max:100',
                'credit_hours' => 'required|string',
                'description' => 'required|string',
            ]);
        
            Course::create($validated);
        return redirect()->back()->with('success', 'Course registered successfully!');
    }
    public function AllocateCoursesToProfessors(Request $request)
    {
        $validated = $request->validate([
            'professor_id' => 'required|exists:users,id',
            'course_ids' => 'required|array', 
        ]);
        $professor = User::find($validated['professor_id']);
        $professor->courses()->sync($validated['course_ids']);
        return redirect()->route('professors.index')->with('success', 'Courses allocated to the professor successfully!');
    }

public function storeStudent(Request $request)
{
    $validatedData = $request->validate([
        'full_name' => 'required|string|max:255',
        'email' => 'required|email|unique:students_registrations,email|unique:users,email',
        'phone_number' => 'required|string|max:15',
        'cnic' => 'required|string|max:15',
        'department' => 'required|string',
        'roll_no' => 'required|string|max:3',
        'degree_program' => 'required|string',
        'password' => 'required|string|min:6',
        'address' => 'required|string',
        'country' => 'required|string',
        'city' => 'required|string',
        'state_province' => 'required|string',
        'student_image' => 'nullable|image|mimes:jpg,png|max:2048',
        'class_id' => 'required|exists:classes,id',
    ]);

    // Handle image upload
    $imagePath = null;
    if ($request->hasFile('student_image')) {
        $image = $request->file('student_image');
        $imageName = Str::uuid() . '.' . $image->getClientOriginalExtension();
        $imagePath = $image->storeAs('student_images', $imageName, 'public');
    }

    DB::transaction(function () use ($validatedData, $imagePath) {
        // Create user
        $user = new User();
        $user->name = $validatedData['full_name'];
        $user->email = $validatedData['email'];
        $user->password = $validatedData['password']; // 🔐 secure hashing
        $user->type = 'student';
        $user->active_status = 1;
        $user->class_id = $validatedData['class_id'];
        $user->save();

        // Create student
        $student = new StudentsRegistration();
        $student->full_name = $validatedData['full_name'];
        $student->email = $validatedData['email'];
        $student->phone_number = $validatedData['phone_number'];
        $student->cnic = $validatedData['cnic'];
        $student->department = $validatedData['department'];
        $student->roll_no = $validatedData['roll_no'];
        $student->degree_program = $validatedData['degree_program'];
        $student->password = $validatedData['password']; // 🔐 secure hashing
        $student->address = $validatedData['address'];
        $student->country = $validatedData['country'];
        $student->city = $validatedData['city'];
        $student->state_province = $validatedData['state_province'];
        $student->class_id = $validatedData['class_id'];
        $student->user_id = $user->id;
        $student->save();

        // Save image in separate table
        if ($imagePath) {
            $image = new StudentImage();
            $image->student_id = $student->id;
            $image->image_path = $imagePath;
            $image->save();
        }
    });

    return redirect()->back()->with('success', 'Student Registered Successfully!');
}

   
public function storeTeacher(Request $request)
{
    $validated = $request->validate([
        'full_name' => 'required|string|max:255',
        'father_name' => 'required|string|max:255',
        'cnic' => 'required|string|max:15',
        'dob' => 'required|date',
        'gender' => 'required|string',
        'email' => 'required|email|unique:teacher_registrations,email|unique:users,email',
        'phone' => 'required|string|max:15',
        'salary_type' => 'required|string',
        'salary' => 'required|numeric',
        'qualification' => 'required|string',
        'specialization' => 'required|string',
        'department_id' => 'required|integer',
        'designation' => 'required|string',
        'joining_date' => 'required|date',
        'username' => 'required|string|unique:teacher_registrations,username',
        'password' => 'required|string|min:6',
        'role' => 'required|string',
        'resume' => 'nullable|mimes:pdf,doc,docx|max:2048',
        'teacher_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        'address' => 'required|string',
        'country' => 'required|string',
        'city' => 'required|string',
        'state' => 'required|string',
    ]);

    $resumePath = null;
    if ($request->hasFile('resume')) {
        $file = $request->file('resume');
        $resumeName = Str::uuid() . '.' . $file->getClientOriginalExtension();
        $resumePath = $file->storeAs('teacher_resumes', $resumeName, 'public');
    }

    $imagePath = null;
    if ($request->hasFile('teacher_image')) {
        $imageFile = $request->file('teacher_image');
        $imageName = Str::uuid() . '.' . $imageFile->getClientOriginalExtension();
        $imagePath = $imageFile->storeAs('teacher_images', $imageName, 'public');
    }

    DB::transaction(function () use ($validated, $resumePath, $imagePath) {
        // Save teacher
        $teacher = TeacherRegistration::create([
            'full_name' => $validated['full_name'],
            'father_name' => $validated['father_name'],
            'cnic' => $validated['cnic'],
            'dob' => $validated['dob'],
            'gender' => $validated['gender'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'salary_type' => $validated['salary_type'],
            'salary' => $validated['salary'],
            'qualification' => $validated['qualification'],
            'specialization' => $validated['specialization'],
            'department_id' => $validated['department_id'],
            'designation' => $validated['designation'],
            'joining_date' => $validated['joining_date'],
            'username' => $validated['username'],
            'password' => $validated['password'],
            'role' => $validated['role'],
            'resume' => $resumePath,
            'address' => $validated['address'],
            'country' => $validated['country'],
            'city' => $validated['city'],
            'state' => $validated['state'],
        ]);

        // Save teacher image if uploaded
        if ($imagePath) {
            TeacherImage::create([
                'Teacher_id' => $teacher->id,
                'image_path' => $imagePath,
            ]);
        }

        // Save user (professor)
        User::create([
            'name' => $validated['full_name'],
            'email' => $validated['email'],
            'password' => $validated['password'], // You can hash if needed
            'type' => 'professor',
            'active_status' => 1,
        ]);
    });

    // Email
    $details = [
        'user_name' => $validated['full_name'],
        'email' => $validated['email'],
        'password' => $request->password,
    ];

    try {
        Mail::send('Mail.TeacherRegistrationMail', ['details' => $details], function ($message) use ($validated) {
            $message->to($validated['email']);
            $message->subject('Welcome to Online Portal - Login Details');
        });
    } catch (\Exception $e) {
        dd('Mail Sending Failed: ' . $e->getMessage());
    }

    return redirect()->back()->with('success', 'Professor registered successfully!');
}
 

    
    public function storeProfessorsCourses(Request $request)
    {
        // Validate form inputs
        {
            // Validate inputs
            $request->validate([
                'professor_id' => 'required|exists:users,id',
                'course_ids' => 'required|array',
                'course_ids.*' => 'exists:courses,id',
            ]);
    
            $professor = User::findOrFail($request->professor_id);
    
            // Get existing assigned course IDs
            $existingCourseIds = $professor->courses()->pluck('course_id')->toArray();
    
            // New selected course IDs
            $selectedCourseIds = $request->course_ids;
    
            // Find truly new courses that are NOT already assigned
            $newCourseIds = array_diff($selectedCourseIds, $existingCourseIds);
    
            // Now, calculate total after adding only new ones
            $totalAfterAllocation = count($existingCourseIds) + count($newCourseIds);
    
            if ($totalAfterAllocation > 4) {
                return redirect()->back()->with('error', 'A professor cannot have more than 4 courses assigned.');
            }
    
            // Attach new courses (only new ones)
            $professor->courses()->syncWithoutDetaching($newCourseIds);
    
            return redirect()->back()->with('success', 'Courses allocated to Professor successfully!');
        }

}
    
}