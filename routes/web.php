<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminCourseController;
use App\Http\Controllers\AdminleaveRequestsController;
use App\Http\Controllers\AdminProfessorController;
use App\Http\Controllers\AdminStudentController;
use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\CourseAllocationController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\FaculityController;
use App\Http\Controllers\leaveController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\ProfessorCourseController;
use App\Http\Controllers\QuizzesController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\SettingsConroller;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\StudentsController;
use App\Http\Controllers\TeacherController;
use Illuminate\Support\Facades\Route;


//Route::get('/', [::class, '']);


//Admin Routes
Route::get('admin/settings', [SettingsConroller::class, 'settings'])->name('admin.settings');
Route::prefix('department')->group(function () {
    Route::get('/', [DepartmentController::class, 'index']);
    Route::get('/create', [DepartmentController::class, 'create']);
    Route::post('/', [DepartmentController::class, 'store']);
    Route::get('/{name}', [DepartmentController::class, 'show']);
    Route::get('/{name}/edit', [DepartmentController::class, 'edit']);
    Route::put('/{name}', [DepartmentController::class, 'update']);
    Route::delete('/{name}', [DepartmentController::class, 'destroy']);

   
});

Route::get('/admin/leaves/{id}/edit', [AdminleaveRequestsController::class, 'edit'])->name('leaves.edit');
Route::put('/admin/leaves/{id}', [AdminleaveRequestsController::class, 'update'])->name('leaves.update');
Route::delete('/admin/leaves/{id}', [AdminleaveRequestsController::class, 'destroy'])->name('leaves.destroy');

use App\Http\Controllers\CourseController;
Route::get('admin/applications', [leaveController::class, 'adminViewLeaves'])->name('admin.viewLeaves');

Route::get('/courses/{id}', [AdminCourseController::class, 'show'])->name('courses.show');
Route::get('/courses/{id}/edit', [AdminCourseController::class, 'edit'])->name('courses.edit');
Route::post('/courses/{id}', [AdminCourseController::class, 'update'])->name('courses.update');
Route::delete('/courses/{id}', [AdminCourseController::class, 'destroy'])->name('courses.destroy');

Route::get('/faculty/leave', [leaveController::class, 'show'])->name('faculty.leave.index');
Route::get('/faculty/leave/{id}/edit', [LeaveController::class, 'edit'])->name('faculty.leave.edit');
Route::put('/faculty/leave/{id}', [LeaveController::class, 'update'])->name('faculty.leave.update');
Route::delete('/faculty/leave/{id}', [LeaveController::class, 'destroy'])->name('faculty.leave.destroy');
Route::patch('/faculty/leave/{id}/status', [LeaveController::class, 'updateStatus'])->name('faculty.leave.updateStatus');


Route::get('/admin/teachers/view/{id}', [AdminProfessorController::class, 'show'])->name('admin.teachers.show');
Route::get('/admin/teachers/edit/{id}', [AdminProfessorController::class, 'edit'])->name('admin.teachers.edit');
Route::post('/admin/teachers/update/{id}', [AdminProfessorController::class, 'update'])->name('admin.teachers.update');
Route::post('/admin/teachers/delete/{id}', [AdminProfessorController::class, 'destroy'])->name('admin.teachers.destroy');
Route::get('/admin/students/{id}', [AdminStudentController::class, 'show'])->name('students.show');
Route::get('/admin/students/{id}/edit', [AdminStudentController::class, 'edit'])->name('students.edit');
Route::put('/admin/students/{id}', [AdminStudentController::class, 'update'])->name('students.update');
Route::delete('/admin/students/{id}', [AdminStudentController::class, 'destroy'])->name('students.destroy');
Route::get('admin/students', [AdminController::class, 'department'])->name('admin.department');

Route::get('admin/auth/signup', [AdminController::class, 'signup'])->name('Admin.signup');
Route::get('admin/auth/signin', [AdminController::class, 'signin'])->name('Admin.signin');
Route::post('Register/admin', [AdminController::class, 'registerUser'])->name('Admin.signup.submit');
Route::post('Login/Admin', [AdminController::class, 'loginUser'])->name('Admin.signin.submit');
Route::get('admin/dashboard', [AdminController::class, 'index'])
    ->middleware('adminauth')
    ->name('Admin.Dashboard');
Route::get('admin/faculity/prof', [AdminController::class, 'display_professors'])->name('display.professors');
Route::get('admin/Students', [AdminController::class, 'display_students'])->name('display.students');
Route::get('admin/Courses', [AdminController::class, 'Courses'])->name('display.Courses');


//students Routes:
Route::get('Students_Dashboard', [StudentsController::class, 'Students_Dashboard'])->name('Students.dashboard');
Route::get('Students_Offer_Courses_Display', [StudentsController::class, 'Students_Offer_Courses_Display'])->name('Student.offerCourses');
Route::post('/register-offerCourses', [StudentsController::class, 'registerCourse'])->name('course.register');
Route::get('/student/assignments', [AssignmentController::class, 'studentAssignments'])->name('assignments.student');
Route::post('/student/submit-assignment/{assignment}', [AssignmentController::class, 'Assignmentsubmission'])->name('assignment.submit');
Route::get('/logout', [MainController::class, 'logout'])->name('logout');
Route::get('/faculty/quizzes', [QuizzesController::class, 'showQuizzes'])->name('quizzes.list');
Route::post('/student/upload-answer/{quiz}', [QuizzesController::class, 'uploadStudentAnswer'])->name('student.uploadAnswer');
Route::get('/student/course/{course_id}', [StudentController::class, 'courseDetails'])->name('student.course.details');


Route::get('/', [MainController::class, 'index']);
Route::post('registerUser', [MainController::class, 'registerUser'])->name('registerUser');
Route::post('loginUser', [MainController::class, 'loginUser'])->name('loginUser');

//Teachers Routes
Route::get('faculityAdmin', [FaculityController::class, 'index'])->name('faculity.dashboard');
Route::get('/faculty/attendance', [FaculityController::class, 'Students_Attendence'])->name('Students_Attendence');
Route::get('WelcomeProfessor', [FaculityController::class, 'WelcomeProfessor'])->name('WelcomeProfessor');
Route::get('UploadAssignments', [AssignmentController::class, 'UploadAssignments'])->name('Upload.assignments');
Route::get('UploadQuizzes', [QuizzesController::class, 'UploadQuizzes'])->name('Upload.Quizzes');
Route::post('/UploadQuizzes', [QuizzesController::class, 'store'])->name('quizzes.store');
Route::get('faculity/leave-request', [FaculityController::class, 'leave'])->name('teacher.leave');
Route::post('/faculty/leave-request', [FaculityController::class, 'store'])->name('faculty.leave.store');

Route::post('/faculty/assignments/upload', [AssignmentController::class, 'store'])->name('assignments.store');
Route::get('PostedAssignments', [AssignmentController::class, 'PostedAssignments'])->name('postedAssignments');
Route::get('/teacher/assignment/{id}/submissions', [AssignmentController::class, 'viewSubmissions'])->name('teacher.viewSubmissions');
Route::post('/submit-attendance', [AttendanceController::class, 'store'])->name('attendance.submit');
Route::get('/teacher/assignments/{id}/submissions', [TeacherController::class, 'viewSubmissions'])->name('view.assignments');
Route::get('/teacher/assignments', [TeacherController::class, 'allAssignments'])->name('teacher.assignments.list');
Route::post('/submissions/{id}/grade', [TeacherController::class, 'grade'])->name('submissions.grade');


//Registration Branch
Route::get('OfferCoursesToClasses', [RegistrationController::class, 'OfferCoursesToClasses']);
Route::get('Registration_index', [RegistrationController::class, 'Registration_index']);
Route::get('RegisterStudents', [RegistrationController::class, 'RegisterStudents']);
Route::get('RegisterTeachers', [RegistrationController::class, 'RegisterTeachers']);
Route::post('/register-student', [RegistrationController::class, 'storeStudent'])->name('student.store');
Route::post('/register-teacher', [RegistrationController::class, 'storeTeacher'])->name('register.teacher');
Route::get('AllocateCoursesToProfessorsForm', [ProfessorCourseController::class, 'AllocateCoursesToProfessorsForm']);
Route::post('AllocateCoursesToProfessors', [ProfessorCourseController::class, 'AllocateCoursesToProfessors'])->name('professor.courses.store');
Route::get('NewCourseRegistration', [RegistrationController::class, 'NewCourseRegistration']);
Route::post('/course/store', [RegistrationController::class, 'storeCourses'])->name('course.store');
Route::post('professor-courses', [RegistrationController::class, 'storeProfessorsCourses'])->name('professorCourses');
Route::get('RegisterNewClasses', [RegistrationController::class, 'RegisterNewClasses']);
Route::post('registerclasses', [RegistrationController::class, 'storeClasses'])->name('registerNewclasses');
Route::post('allocate', [CourseAllocationController::class, 'store'])->name('courses.allocate');
Route::get('/accounts/delete', [RegistrationController::class, 'delete'])->name('delete.accounts');
