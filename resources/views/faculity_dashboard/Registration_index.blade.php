<x-registrationheader />
<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="registration-dashboard" style="background-color: #f8fafc; min-height: 100vh; padding: 2rem;">
    <div class="container-fluid">
        <!-- Header Section -->
        <div class="row align-items-center mb-5">
            <div class="col-lg-8">
                <div class="d-flex align-items-center gap-3 mb-2">
                    <div class="brand-accent"></div>
                    <h2 class="main-title mb-0">Registration Portal</h2>
                </div>
                <p class="text-muted fs-5 mb-0">Comprehensive management of university academic infrastructure and enrollment.</p>
            </div>

            <div class="col-lg-4 text-lg-end mt-4 mt-lg-0">
                <div class="d-inline-flex align-items-center p-2 bg-white rounded-pill shadow-sm border">
                    <div class="profile-img-container me-3">
                        <img src="{{ asset('frontend/images/Person.png') }}" alt="Profile" class="rounded-circle shadow-sm">
                        <span class="status-dot"></span>
                    </div>
                    <div class="text-start me-3 d-none d-sm-block">
                        <h6 class="mb-0 fw-bold">{{ session('name', 'Guest') }}</h6>
                        <small class="text-muted">Administrator</small>
                    </div>
                    <div class="dropdown">
                        <button class="btn btn-icon-only rounded-circle border-0 bg-light" type="button" data-bs-toggle="dropdown">
                            <i class="bi bi-three-dots-vertical"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0 rounded-3">
                            <li><a class="dropdown-item py-2" href="{{ route('Registration.profile') }}"><i class="bi bi-person me-2"></i> Profile</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item py-2 text-danger" href="{{ route('logout') }}"><i class="bi bi-box-arrow-right me-2"></i> Logout</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistics Grid -->
        <div class="row g-4 mb-5">
            <div class="col-xl-3 col-md-6">
                <div class="modern-stat-card card-students">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div class="stat-icon-box">
                                <i class="bi bi-people"></i>
                            </div>
                            <span class="trend-indicator pos">+12%</span>
                        </div>
                        <h3 class="stat-value">{{ number_format($totalStudents) }}</h3>
                        <p class="stat-label">Total Students</p>
                        <div class="progress-container">
                            <div class="progress-bar" style="width: 75%"></div>
                        </div>
                        <a href="{{ url('RegisterStudents') }}" class="card-action-link mt-4">
                            Manage Students <i class="bi bi-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="modern-stat-card card-teachers">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div class="stat-icon-box">
                                <i class="bi bi-mortarboard"></i>
                            </div>
                            <span class="trend-indicator pos">+5%</span>
                        </div>
                        <h3 class="stat-value">{{ number_format($totalTeachers) }}</h3>
                        <p class="stat-label">Faculty Members</p>
                        <div class="progress-container">
                            <div class="progress-bar" style="width: 60%"></div>
                        </div>
                        <a href="{{ url('RegisterTeachers') }}" class="card-action-link mt-4">
                            Manage Faculty <i class="bi bi-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="modern-stat-card card-classes">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div class="stat-icon-box">
                                <i class="bi bi-building"></i>
                            </div>
                            <span class="trend-indicator neg">-2%</span>
                        </div>
                        <h3 class="stat-value">{{ number_format($totalClasses) }}</h3>
                        <p class="stat-label">Academic Classes</p>
                        <div class="progress-container">
                            <div class="progress-bar" style="width: 85%"></div>
                        </div>
                        <a href="{{ url('RegisterNewClasses') }}" class="card-action-link mt-4">
                            Manage Classes <i class="bi bi-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="modern-stat-card card-courses">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div class="stat-icon-box">
                                <i class="bi bi-journal-text"></i>
                            </div>
                            <span class="trend-indicator pos">+8%</span>
                        </div>
                        <h3 class="stat-value">{{ number_format($totalCourses) }}</h3>
                        <p class="stat-label">Offered Courses</p>
                        <div class="progress-container">
                            <div class="progress-bar" style="width: 92%"></div>
                        </div>
                        <a href="{{ url('NewCourseRegistration') }}" class="card-action-link mt-4">
                            Manage Courses <i class="bi bi-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Course Allocation Table Section -->
        <div class="row">
            <div class="col-12">
                <div class="table-container shadow-sm border-0">
                    <div class="table-header p-4 border-bottom bg-white rounded-top-4">
                        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-3">
                            <div>
                                <h4 class="mb-1 fw-bold text-dark">Course Allocations</h4>
                                <p class="text-muted small mb-0">Current assignments of professors to classes and courses.</p>
                            </div>
                            <div class="d-flex gap-2">
                                <button class="btn btn-light border btn-sm rounded-pill px-3">
                                    <i class="bi bi-download me-1"></i> Export
                                </button>
                                <a href="{{ URL::to('OfferCoursesToClasses') }}" class="btn btn-primary-pgu btn-sm rounded-pill px-4 shadow-sm">
                                    <i class="bi bi-plus-lg me-1"></i> New Allocation
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive bg-white rounded-bottom-4">
                        <table class="table table-hover align-middle mb-0 custom-pgu-table">
                            <thead>
                                <tr>
                                    <th class="ps-4">#</th>
                                    <th>Course</th>
                                    <th>Professor</th>
                                    <th>Batch/Semester</th>
                                    <th>Department</th>
                                    <th>Status</th>
                                    <th class="pe-4 text-end">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($allocations as $index => $allocation)
                                    <tr>
                                        <td class="ps-4 text-muted small">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</td>
                                        <td>
                                            <div class="fw-bold text-dark">{{ $allocation->course->course_name ?? 'N/A' }}</div>
                                            <div class="text-muted x-small">{{ $allocation->course->course_code ?? '' }}</div>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-sm me-2 rounded-circle bg-light d-flex align-items-center justify-content-center text-primary fw-bold">
                                                    {{ substr($allocation->professor->name ?? '?', 0, 1) }}
                                                </div>
                                                <span class="fw-medium">{{ $allocation->professor->name ?? 'N/A' }}</span>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="badge bg-light text-dark border fw-normal px-3 py-2 rounded-pill">
                                                {{ $allocation->class->semester ?? '' }} {{ $allocation->class->year ?? '' }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="text-dark fw-medium">{{ $allocation->class->department ?? '' }}</div>
                                            <div class="text-muted small">{{ $allocation->class->degree_program ?? '' }} - Sec {{ $allocation->class->section ?? '' }}</div>
                                        </td>
                                        <td>
                                            <span class="status-badge active">Active</span>
                                        </td>
                                        <td class="pe-4 text-end">
                                            <button class="btn btn-icon-only rounded-circle border-0 bg-transparent text-muted">
                                                <i class="bi bi-pencil-square"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center py-5">
                                            <div class="py-4">
                                                <i class="bi bi-inbox fs-1 text-muted opacity-25 d-block mb-3"></i>
                                                <p class="text-muted mb-0">No course allocations found in the system.</p>
                                            </div>
                                        </td>
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
    /* Color Palette derived from site identity */
    :root {
        --pgu-primary: #f35d85; /* Blush theme from body class */
        --pgu-primary-dark: #d64a6d;
        --pgu-secondary: #188ccc; /* Cyan/Blue from UI elements */
        --pgu-success: #10b981;
        --pgu-warning: #f59e0b;
        --pgu-danger: #ef4444;
        --pgu-bg: #f8fafc;
        --pgu-text-dark: #1e293b;
        --pgu-text-muted: #64748b;
        --pgu-card-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.04), 0 8px 10px -6px rgba(0, 0, 0, 0.04);
    }

    body {
        font-family: 'Inter', 'Muli', sans-serif;
        background-color: var(--pgu-bg);
        color: var(--pgu-text-dark);
    }

    .brand-accent {
        width: 8px;
        height: 32px;
        background: var(--pgu-primary);
        border-radius: 4px;
    }

    .main-title {
        font-weight: 800;
        letter-spacing: -0.02em;
        color: #0f172a;
    }

    /* Modern Profile Section */
    .profile-img-container {
        position: relative;
        width: 44px;
        height: 44px;
    }
    .profile-img-container img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border: 2px solid #fff;
    }
    .status-dot {
        position: absolute;
        bottom: 2px;
        right: 2px;
        width: 10px;
        height: 10px;
        background: var(--pgu-success);
        border: 2px solid #fff;
        border-radius: 50%;
    }

    /* Modern Stat Cards */
    .modern-stat-card {
        background: #fff;
        border-radius: 20px;
        border: 1px solid rgba(0,0,0,0.04);
        box-shadow: var(--pgu-card-shadow);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
    }
    .modern-stat-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }
    .modern-stat-card::after {
        content: '';
        position: absolute;
        top: 0;
        right: 0;
        width: 100px;
        height: 100px;
        background: radial-gradient(circle, rgba(0,0,0,0.02) 0%, transparent 70%);
        border-radius: 50%;
        margin-top: -30px;
        margin-right: -30px;
    }

    .stat-icon-box {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
    }

    .stat-value {
        font-size: 2.25rem;
        font-weight: 800;
        margin-bottom: 0.25rem;
        color: #0f172a;
    }
    .stat-label {
        font-size: 0.875rem;
        color: var(--pgu-text-muted);
        font-weight: 500;
        margin-bottom: 1.25rem;
    }

    .trend-indicator {
        font-size: 0.75rem;
        font-weight: 700;
        padding: 4px 10px;
        border-radius: 20px;
    }
    .trend-indicator.pos { background: rgba(16, 185, 129, 0.1); color: #059669; }
    .trend-indicator.neg { background: rgba(239, 68, 68, 0.1); color: #dc2626; }

    .progress-container {
        height: 6px;
        background: #f1f5f9;
        border-radius: 10px;
        overflow: hidden;
    }
    .progress-bar {
        height: 100%;
        border-radius: 10px;
    }

    .card-action-link {
        display: inline-flex;
        align-items: center;
        text-decoration: none;
        font-size: 0.8125rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        transition: gap 0.2s;
    }
    .card-action-link:hover { gap: 8px; }

    /* Card Themes */
    .card-students .stat-icon-box { background: rgba(24, 140, 204, 0.1); color: var(--pgu-secondary); }
    .card-students .progress-bar { background: var(--pgu-secondary); }
    .card-students .card-action-link { color: var(--pgu-secondary); }

    .card-teachers .stat-icon-box { background: rgba(124, 58, 237, 0.1); color: #7c3aed; }
    .card-teachers .progress-bar { background: #7c3aed; }
    .card-teachers .card-action-link { color: #7c3aed; }

    .card-classes .stat-icon-box { background: rgba(245, 158, 11, 0.1); color: var(--pgu-warning); }
    .card-classes .progress-bar { background: var(--pgu-warning); }
    .card-classes .card-action-link { color: var(--pgu-warning); }

    .card-courses .stat-icon-box { background: rgba(243, 93, 133, 0.1); color: var(--pgu-primary); }
    .card-courses .progress-bar { background: var(--pgu-primary); }
    .card-courses .card-action-link { color: var(--pgu-primary); }

    /* Table Styling */
    .table-container {
        background: #fff;
        border-radius: 20px;
        overflow: hidden;
    }
    .custom-pgu-table thead th {
        background: #f8fafc;
        color: #64748b;
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        padding: 1.25rem 1rem;
        border-bottom: 1px solid #f1f5f9;
    }
    .custom-pgu-table tbody td {
        padding: 1.25rem 1rem;
        border-bottom: 1px solid #f8fafc;
    }
    .custom-pgu-table tbody tr:last-child td { border-bottom: none; }

    .avatar-sm {
        width: 32px;
        height: 32px;
        font-size: 0.75rem;
    }

    .btn-primary-pgu {
        background-color: var(--pgu-primary);
        border: none;
        color: #fff;
        font-weight: 700;
        transition: all 0.2s;
    }
    .btn-primary-pgu:hover {
        background-color: var(--pgu-primary-dark);
        transform: translateY(-2px);
    }

    .status-badge {
        padding: 6px 12px;
        border-radius: 10px;
        font-size: 0.75rem;
        font-weight: 700;
    }
    .status-badge.active { background: rgba(16, 185, 129, 0.1); color: #059669; }

    .btn-icon-only {
        width: 36px;
        height: 36px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s;
    }
    .btn-icon-only:hover { background-color: #f1f5f9 !important; color: var(--pgu-primary) !important; }

    .x-small { font-size: 0.7rem; }

    @media (max-width: 991px) {
        .registration-dashboard { padding: 1.25rem; }
    }
</style>
