<x-faculityheader />

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="main-title text-dark fw-bold">My Courses</h2>
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

<!-- Courses Grid -->
<div class="row g-4">
    @if (!empty($professor->offeredCourses) && count($professor->offeredCourses) > 0)
        @foreach ($professor->offeredCourses as $offered)
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="card shadow-sm border-0 rounded-4 text-center bg-white course-card">
                    <div class="card-body d-flex flex-column justify-content-between">
                        <div>
                            <div class="icon mb-3">
                                <i class="bi bi-journal-bookmark-fill fs-1" style="color:#3f634d;"></i>
                            </div>
                            <h5 class="fw-bold text-dark mb-2 text-truncate" title="{{ $offered->course->course_name }}">
                                {{ $offered->course->course_name }}
                            </h5>
                            <p class="text-muted mb-1">By {{ $professor->name }}</p>
                            <p class="small text-muted mb-3">
                                @if ($offered->class)
                                    {{ strtoupper(substr($offered->class->semester, 0, 2)) }}{{ substr($offered->class->year, -2) }}-
                                    {{ strtoupper(substr($offered->class->degree_program, 0, 1)) }}{{ strtoupper($offered->class->department) }}-
                                    {{ strtoupper($offered->class->section) }}
                                @else
                                    No Class Assigned
                                @endif
                            </p>
                        </div>
                        <a href="{{ route('faculty.course.details', $offered->course->uuid) }}" class="btn btn-sm btn-primary w-100 mt-auto">
                            <i class="bi bi-eye me-1"></i> View Details
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    @else
        <div class="col-12 text-center">
            <div class="alert alert-info">No assigned courses.</div>
        </div>
    @endif
</div>

<x-faculityfooter />

<style>
    body {
        background-color: #F4F8F5;
    }
    .course-card {
        height: 260px; /* fixed height for equal sizing */
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .course-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
    }
    .btn-primary {
        background-color: #3f634d;
        border-color: #3f634d;
    }
    .btn-primary:hover {
        background-color: #1e3e28;
        border-color: #1e3e28;
    }
</style>
