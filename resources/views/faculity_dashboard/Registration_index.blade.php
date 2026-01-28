<x-registrationheader />

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="main-title text-dark fw-bold">Registration Dashboard</h2>
    <!-- User Profile Dropdown -->
    <div class="user-data d-flex align-items-center">
        <div class="user-avatar position-relative rounded-circle me-2">
            <img src="{{ asset('frontend/images/Person.png') }}" alt="User Avatar" 
                class="lazy-img rounded-circle" 
                style="width:45px; height:45px; object-fit:cover; border: 2px solid #2F4F4F;">
            <span class="position-absolute bottom-0 end-0 translate-middle p-1 bg-success border border-light rounded-circle"></span>
        </div>
        <div class="dropdown">
            <button class="btn btn-outline-primary rounded-pill dropdown-toggle fw-semibold px-3" 
                type="button" id="profile-dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                {{ session('name', 'Guest') }}
            </button>
            <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="profile-dropdown">
                <li>
                    <a class="dropdown-item d-flex align-items-center" href="{{ route('Registration.profile') }}">
                        <i class="bi bi-person-circle me-2 text-primary"></i> Profile
                    </a>
                </li>
                <li>
                    <a class="dropdown-item d-flex align-items-center text-danger" href="{{ route('logout') }}">
                        <i class="bi bi-box-arrow-right me-2"></i> Logout
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>

<div class="row g-4">
    <!-- Students Card -->
    <div class="col-lg-3 col-md-6">
        <div class="card shadow-sm border-0 rounded-4 p-3 text-center bg-white">
            <div class="card-body">
              <div class="icon mb-3">
    <i class="bi bi-people-fill fs-1" style="color: #3f634d;"></i>
</div>

                <h4 class="mb-1 fw-bold text-dark">{{ $totalStudents }}</h4>
                <p class="text-muted mb-2">Registered Students</p>
                <a href="visitor-url.html" class="btn btn-sm btn-primary">View Details</a>
            </div>
        </div>
    </div>

    <!-- Teachers Card -->
    <div class="col-lg-3 col-md-6">
        <div class="card shadow-sm border-0 rounded-4 p-3 text-center bg-white">
            <div class="card-body">
                <div class="icon mb-3">
                    <i class="bi bi-person-badge-fill fs-1" style="color: #3f634d;"></i>
                </div>
                <h4 class="mb-1 fw-bold text-dark">{{ $totalTeachers }}</h4>
                <p class="text-muted mb-2">Registered Teachers</p>
                <a href="shortlisted-url.html" class="btn btn-sm btn-primary">View Details</a>
            </div>
        </div>
    </div>

    <!-- Classes Card -->
    <div class="col-lg-3 col-md-6">
        <div class="card shadow-sm border-0 rounded-4 p-3 text-center bg-white">
            <div class="card-body">
                <div class="icon mb-3">
                    <i class="bi bi-building fs-1" style="color: #3f634d;"></i>
                </div>
                <h4 class="mb-1 fw-bold text-dark">{{ $totalClasses }}</h4>
                <p class="text-muted mb-2">Registered Classes</p>
                <a href="views-url.html" class="btn btn-sm btn-primary">View Details</a>
            </div>
        </div>
    </div>

    <!-- Courses Card -->
    <div class="col-lg-3 col-md-6">
        <div class="card shadow-sm border-0 rounded-4 p-3 text-center bg-white">
            <div class="card-body">
                <div class="icon mb-3">
                    <i class="bi bi-journal-bookmark-fill fs-1 " style="color: #3f634d;"></i>
                </div>
                <h4 class="mb-1 fw-bold text-dark">{{ $totalCourses }}</h4>
                <p class="text-muted mb-2">Registered Courses</p>
                <a href="applied-job-url.html" class="btn btn-sm btn-primary">View Details</a>
            </div>
        </div>
    </div>
</div>

<!-- Course Allocation Table -->
<div class="row d-flex pt-50 lg-pt-10">
    <div class="col-xl-12 col-lg-6 d-flex flex-column">
        <div class="user-activity-chart bg-white border-20 mt-30 h-100 p-4 shadow-sm">
            <h4 class="dash-title-two text-dark">Course Allocation</h4>
            <div class="table-responsive mt-4">
                <table class="table table-bordered text-center align-middle">
                    <thead style="background-color:#3f634d; color:white;">
                        <tr>
                            <th>#</th>
                            <th>Course Name</th>
                            <th>Professor Name</th>
                            <th>Batch Name</th>
                            <th>Year</th>
                            <th>Degree</th>
                            <th>Department</th>
                            <th>Section</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($allocations as $index => $allocation)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $allocation->course->course_name ?? 'N/A' }}</td>
                                <td>{{ $allocation->professor->name ?? 'N/A' }}</td>
                                <td>{{ $allocation->class->semester ?? '' }}</td>
                                <td>{{ $allocation->class->year ?? '' }}</td>
                                <td>{{ $allocation->class->degree_program ?? '' }}</td>
                                <td>{{ $allocation->class->department ?? '' }}</td>
                                <td>{{ $allocation->class->section ?? '' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8">No course allocations found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<x-registrationfooter />

<style>
    body {
        background-color: #F4F8F5;
        color: #333;
    }
    .main-title {
        color: #3f634d;
    }
    .btn-primary {
        background-color: #3f634d;
        border-color: #3f634d;
    }
    .btn-primary:hover {
        background-color: #1e3e28;
        border-color: #1e3e28;
    }
    .user-avatar img {
        border: 2px solid #3f634d;
    }
    .btn-outline-primary:hover {
    background-color: #3f634d !important; /* Bootstrap green */
    color: #fff !important;
    border-color: #3f634d !important;
}

</style>
