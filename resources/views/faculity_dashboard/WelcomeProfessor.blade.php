<x-faculityheader />
<h2 class="main-title">Faculty Dashboard</h2>

<div class="row g-4">
    <!-- Icon 1: Attendance -->
    @foreach($offeredCourses as $course)
    @if($course->id)
    <div class="col-md-3 col-sm-6">
        <a href="{{ route('Students_Attendence', ['offeredCourseId' => $course->id]) }}" class="text-decoration-none text-dark">
            <div class="dash-card-one bg-white border-30 text-center p-4 shadow rounded-circle">
                <img src="{{ asset('backend_faculity/images/icon/check.png') }}" alt="Attendance" class="mb-2" style="width: 60px;">
                <div class="fw-bold">Attendance - {{ $course->course_code ?? 'Course' }}</div>
            </div>
        </a>
    </div>
    @endif
@endforeach


    <!-- Icon 2: Assignments -->
    <div class="col-md-3 col-sm-6">
        <a href="{{ route('Upload.assignments') }}" class="text-decoration-none text-dark">
            <div class="dash-card-one bg-white border-30 text-center p-4 shadow rounded-circle">
                <img src="{{ asset('backend_faculity\images\icon\delegating.png') }}" alt="Assignments" class="mb-2" style="width: 60px;">
                <div class="fw-bold">Assignments</div>
            </div>
        </a>
    </div>

    <!-- Icon 3: Quizzes -->
    <div class="col-md-3 col-sm-6">
        <a href="#" class="text-decoration-none text-dark">
            <div class="dash-card-one bg-white border-30 text-center p-4 shadow rounded-circle">
                <img src="{{ asset('backend_faculity\images\icon\quiz.png') }}" alt="Quizzes" class="mb-2" style="width: 60px;">
                <div class="fw-bold">Quizzes</div>
            </div>
        </a>
    </div>

    <!-- Icon 4: Grades -->
    <div class="col-md-3 col-sm-6">
        <a href="#" class="text-decoration-none text-dark">
            <div class="dash-card-one bg-white border-30 text-center p-4 shadow rounded-circle">
                <img src="{{ asset('backend_faculity/images/icon/exam.png') }}
" alt="Grades" class="mb-2" style="width: 60px;">
                <div class="fw-bold">Grades</div>
            </div>
        </a>
    </div>

    <!-- Icon 5: Timetable -->
    <div class="col-md-3 col-sm-6">
        <a href="{{ route('postedAssignments') }}" class="text-decoration-none text-dark">
            <div class="dash-card-one bg-white border-30 text-center p-4 shadow rounded-circle">
                <img src="{{ asset('backend_faculity/images/icon/announcement.png') }}" alt="Timetable" class="mb-2" style="width: 60px;">
                <div class="fw-bold">Posted Assignments</div>
            </div>
        </a>
    </div>

    
<!-- Keep your existing modal and scroll button -->
<button class="scroll-top">
    <i class="bi bi-arrow-up-short"></i>
</button>

<x-faculityfooter />
