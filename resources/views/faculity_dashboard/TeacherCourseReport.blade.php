<x-registrationheader />

<div class="registration-dashboard" style="background-color: #f0f2f5; min-height: 100vh; padding: 28px 28px 40px;">
    <div class="container-fluid">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3 mb-4">
            <div>
                <h2 class="main-title mb-2">Teacher Course Report</h2>
                <p class="text-muted mb-0">Review how many courses each teacher is assigned and the course names they teach.</p>
            </div>
            <div class="user-data d-flex align-items-center gap-3">
                <div class="user-avatar position-relative rounded-circle">
                    <img src="{{ asset('frontend/images/Person.png') }}" alt="User Avatar" 
                        class="lazy-img rounded-circle" 
                        style="width:52px; height:52px; object-fit:cover;">
                    <span class="position-absolute bottom-0 end-0 translate-middle p-1 bg-success border border-white rounded-circle"></span>
                </div>
                <div class="dropdown profile-dropdown">
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

        <div class="row g-4 mb-5">
            <div class="col-lg-4 col-md-6">
                <div class="registration-card rounded-4 p-4 text-center h-100">
                    <div class="icon mb-3" style="background: rgba(13, 110, 253, 0.1);">
                        <i class="bi bi-people-fill fs-1" style="color: #0d6efd;"></i>
                    </div>
                    <h4 class="mb-1 fw-bold text-dark">{{ $teachers->count() }}</h4>
                    <p class="text-muted mb-3">Teachers with assigned courses</p>
                    <a href="{{ url('Registration_index') }}" class="btn btn-sm btn-registration px-4">Back to Dashboard</a>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="registration-card rounded-4 p-4 text-center h-100">
                    <div class="icon mb-3" style="background: rgba(255, 193, 7, 0.1);">
                        <i class="bi bi-journal-bookmark-fill fs-1" style="color: #ffc107;"></i>
                    </div>
                    <h4 class="mb-1 fw-bold text-dark">{{ $teachers->sum('offered_courses_count') }}</h4>
                    <p class="text-muted mb-3">Total offered course assignments</p>
                    <a href="{{ URL::to('OfferCoursesToClasses') }}" class="btn btn-sm btn-registration px-4">Manage Allocations</a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="table-card rounded-4 shadow-sm p-4 bg-white">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div>
                            <h4 class="mb-0 text-dark">Assigned Teachers</h4>
                            <p class="text-muted mb-0">Each row shows a teacher, the number of courses they teach, and the course names.</p>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered text-center align-middle mb-0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Teacher</th>
                                    <th>Assigned Courses</th>
                                    <th>Details</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($teachers as $index => $teacher)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td class="text-start">
                                            <div class="fw-semibold">{{ $teacher->full_name }}</div>
                                            <div class="text-muted small">{{ $teacher->email }}</div>
                                        </td>
                                        <td>{{ $teacher->offered_courses_count }}</td>
                                        <td class="text-start">
                                            @php
                                                $courseNames = $teacher->offeredCourses->pluck('course.course_name')
                                                    ->filter()
                                                    ->unique()
                                                    ->values();
                                            @endphp
                                            @if ($courseNames->isEmpty())
                                                <span class="text-muted">No assigned courses</span>
                                            @else
                                                <div class="d-flex flex-wrap gap-2 justify-content-start">
                                                    @foreach ($courseNames as $courseName)
                                                        <span class="badge bg-primary text-white">{{ $courseName }}</span>
                                                    @endforeach
                                                </div>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-muted py-4">No teachers have assigned courses yet.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<x-registrationfooter />

<style>
    body {
        background-color: #f0f2f5;
        color: #1a1a1a;
    }

    .registration-dashboard {
        background-color: #f0f2f5;
    }

    .main-title {
        color: #1a1a1a;
        font-size: 2rem;
        font-weight: 700;
    }

    .registration-card {
        background: #ffffff;
        border: 1px solid rgba(0, 0, 0, 0.06);
        box-shadow: 0 18px 45px rgba(22, 28, 37, 0.08);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .registration-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 22px 55px rgba(22, 28, 37, 0.12);
    }

    .registration-card .icon {
        width: 72px;
        height: 72px;
        margin: 0 auto 1rem;
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .btn-registration {
        background: linear-gradient(135deg, #0066cc, #0052a3);
        border: none;
        color: #ffffff;
    }

    .btn-registration:hover {
        background: linear-gradient(135deg, #0052a3, #004494);
        color: #ffffff;
    }

    .profile-dropdown .dropdown-menu {
        min-width: 220px;
        border-radius: 14px;
        border: 1px solid rgba(0, 0, 0, 0.08);
        box-shadow: 0 22px 45px rgba(22, 28, 37, 0.08);
    }

    .table-card {
        background: #ffffff;
        border: 1px solid rgba(0, 0, 0, 0.06);
    }

    .table thead th {
        background-color: #0066cc;
        color: #ffffff;
        border: none;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.03em;
    }

    .table tbody tr:nth-child(odd) {
        background-color: #f8fbff;
    }

    .table tbody tr td {
        color: #333333;
    }

    .user-avatar img {
        border: 2px solid #0066cc;
    }

    .btn-outline-primary {
        color: #0066cc;
        border-color: #0066cc;
    }

    .btn-outline-primary:hover {
        background-color: #0066cc !important;
        color: #fff !important;
        border-color: #0066cc !important;
    }

    .badge {
        font-size: 0.82rem;
        padding: 0.55rem 0.8rem;
        border-radius: 12px;
    }

    @media (max-width: 767px) {
        .registration-dashboard {
            padding: 20px 16px 30px;
        }
    }
</style>
