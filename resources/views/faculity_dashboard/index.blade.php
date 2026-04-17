<x-faculityheader />

<div class="professor-dashboard" style="background-color: #f8fafc; min-height: 100vh; padding: 2rem;">
    <div class="container-fluid">
        <!-- Header Section -->
        <div class="row align-items-center mb-5">
            <div class="col-lg-8">
                <div class="d-flex align-items-center gap-3 mb-2">
                    <div class="brand-accent"></div>
                    <h2 class="main-title mb-0">Faculty Portal</h2>
                </div>
                <p class="text-muted fs-5 mb-0">Welcome back, Professor. Manage your courses, students, and academic activities.</p>
            </div>

            <div class="col-lg-4 text-lg-end mt-4 mt-lg-0">
                <div class="d-inline-flex align-items-center p-2 bg-white rounded-pill shadow-sm border">
                    <div class="profile-img-container me-3">
                        @if($teacherReg && $teacherReg->image)
                            <img src="{{ asset('storage/' . $teacherReg->image->image_path) }}" alt="Profile" class="rounded-circle shadow-sm">
                        @else
                            <img src="{{ asset('frontend/images/Person.png') }}" alt="Profile" class="rounded-circle shadow-sm">
                        @endif
                        <span class="status-dot"></span>
                    </div>
                    <div class="text-start me-3 d-none d-sm-block">
                        <h6 class="mb-0 fw-bold">{{ session('name', 'Professor') }}</h6>
                        <small class="text-muted">{{ $teacherReg->designation ?? 'Faculty Member' }}</small>
                    </div>
                    <div class="dropdown">
                        <button class="btn btn-icon-only rounded-circle border-0 bg-light" type="button" data-bs-toggle="dropdown">
                            <i class="bi bi-three-dots-vertical"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0 rounded-3">
                            <li><a class="dropdown-item py-2" href="{{ route('faculty.profile') }}"><i class="bi bi-person me-2"></i> Profile</a></li>
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
                <div class="modern-stat-card card-courses-stat">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div class="stat-icon-box">
                                <i class="bi bi-journal-bookmark"></i>
                            </div>
                            <span class="trend-indicator pos">Active</span>
                        </div>
                        <h3 class="stat-value">{{ !empty($professor->offeredCourses) ? count($professor->offeredCourses) : 0 }}</h3>
                        <p class="stat-label">Total Courses</p>
                        <div class="progress-container">
                            <div class="progress-bar" style="width: 75%"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="modern-stat-card card-classes-stat">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div class="stat-icon-box">
                                <i class="bi bi-easel"></i>
                            </div>
                            <span class="trend-indicator pos">Scheduled</span>
                        </div>
                        <h3 class="stat-value">{{ !empty($professor->offeredCourses) ? $professor->offeredCourses->filter(fn($c) => $c->class)->count() : 0 }}</h3>
                        <p class="stat-label">Active Classes</p>
                        <div class="progress-container">
                            <div class="progress-bar" style="width: 60%"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="modern-stat-card card-assignments-stat">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div class="stat-icon-box">
                                <i class="bi bi-file-earmark-text"></i>
                            </div>
                            <span class="trend-indicator warning">Pending</span>
                        </div>
                        <h3 class="stat-value">12</h3>
                        <p class="stat-label">New Submissions</p>
                        <div class="progress-container">
                            <div class="progress-bar" style="width: 85%"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="modern-stat-card card-students-stat">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div class="stat-icon-box">
                                <i class="bi bi-people"></i>
                            </div>
                            <span class="trend-indicator pos">Total</span>
                        </div>
                        <h3 class="stat-value">{{ !empty($professor->offeredCourses) ? $professor->offeredCourses->sum(fn($c) => $c->class ? 30 : 0) : 0 }}</h3>
                        <p class="stat-label">Students Taught</p>
                        <div class="progress-container">
                            <div class="progress-bar" style="width: 90%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="row g-4 mb-5">
            <div class="col-12">
                <h5 class="fw-bold text-dark mb-4">
                    <i class="bi bi-lightning-charge-fill me-2 text-warning"></i> Quick Actions
                </h5>
                <div class="d-flex flex-wrap gap-3">
                    <a href="{{ route('teacher.leave') }}" class="btn btn-action shadow-sm">
                        <i class="bi bi-calendar-event me-2"></i> Request Leave
                    </a>
                    <a href="{{ route('postedAssignments') }}" class="btn btn-action shadow-sm">
                        <i class="bi bi-upload me-2"></i> Upload Assignment
                    </a>
                    <a href="{{ route('teacher.assignments.list') }}" class="btn btn-action shadow-sm">
                        <i class="bi bi-check2-square me-2"></i> Grade Work
                    </a>
                    <a href="{{ route('teacher.change.password') }}" class="btn btn-action shadow-sm">
                        <i class="bi bi-shield-lock me-2"></i> Change Password
                    </a>
                </div>
            </div>
        </div>

        <!-- Courses Grid -->
        <div class="row mb-4">
            <div class="col-12 d-flex justify-content-between align-items-center">
                <h4 class="fw-bold text-dark mb-0">My Assigned Courses</h4>
                <span class="badge rounded-pill bg-white border text-dark px-3 py-2 shadow-sm">
                    {{ !empty($professor->offeredCourses) ? count($professor->offeredCourses) : 0 }} Courses
                </span>
            </div>
        </div>

        @if (!empty($professor->offeredCourses) && count($professor->offeredCourses) > 0)
        <div class="row g-4">
            @foreach ($professor->offeredCourses as $offered)
            <div class="col-lg-4 col-md-6">
                <div class="modern-course-card h-100">
                    <div class="card-header-gradient p-4">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div class="course-code-pill">{{ $offered->course->course_code }}</div>
                            <div class="semester-tag">
                                {{ $offered->class ? strtoupper(substr($offered->class->semester, 0, 1)) . '-' . substr($offered->class->year, -2) : 'N/A' }}
                            </div>
                        </div>
                        <h5 class="course-title">{{ $offered->course->course_name }}</h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="course-meta-grid mb-4">
                            <div class="meta-item">
                                <small>Department</small>
                                <span>{{ $offered->class->department ?? 'N/A' }}</span>
                            </div>
                            <div class="meta-item">
                                <small>Section</small>
                                <span>{{ $offered->class->section ?? 'N/A' }}</span>
                            </div>
                            <div class="meta-item">
                                <small>Credits</small>
                                <span>{{ $offered->course->credit_hours }} hrs</span>
                            </div>
                            <div class="meta-item">
                                <small>Class Size</small>
                                <span>30+</span>
                            </div>
                        </div>
                        
                        <div class="d-grid gap-2">
                            <a href="{{ route('faculty.course.details', $offered->course->uuid) }}" class="btn btn-primary-pgu rounded-3 py-2 fw-bold">
                                <i class="bi bi-gear-fill me-2"></i> Manage Course
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="row">
            <div class="col-12">
                <div class="empty-state-container p-5 text-center bg-white rounded-4 border shadow-sm">
                    <div class="empty-icon-box mb-4 mx-auto">
                        <i class="bi bi-journal-x"></i>
                    </div>
                    <h5 class="fw-bold text-dark">No Assigned Courses</h5>
                    <p class="text-muted">You don't have any courses assigned to you for the current semester.</p>
                    <button class="btn btn-primary-pgu rounded-pill px-4 mt-3">Contact Administration</button>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>

<x-faculityfooter />

<style>
    /* Color Palette derived from site identity */
    :root {
        --pgu-primary: #f35d85; /* Blush theme */
        --pgu-primary-dark: #d64a6d;
        --pgu-secondary: #188ccc; /* Cyan/Blue */
        --pgu-success: #10b981;
        --pgu-warning: #f59e0b;
        --pgu-danger: #ef4444;
        --pgu-bg: #f8fafc;
        --pgu-text-dark: #1e293b;
        --pgu-text-muted: #64748b;
        --pgu-card-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.04), 0 8px 10px -6px rgba(0, 0, 0, 0.04);
    }

    body {
        font-family: 'Inter', 'Segoe UI', sans-serif;
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
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
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
    .trend-indicator.warning { background: rgba(245, 158, 11, 0.1); color: #d97706; }

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

    /* Stat Card Themes */
    .card-courses-stat .stat-icon-box { background: rgba(24, 140, 204, 0.1); color: var(--pgu-secondary); }
    .card-courses-stat .progress-bar { background: var(--pgu-secondary); }

    .card-classes-stat .stat-icon-box { background: rgba(124, 58, 237, 0.1); color: #7c3aed; }
    .card-classes-stat .progress-bar { background: #7c3aed; }

    .card-assignments-stat .stat-icon-box { background: rgba(245, 158, 11, 0.1); color: var(--pgu-warning); }
    .card-assignments-stat .progress-bar { background: var(--pgu-warning); }

    .card-students-stat .stat-icon-box { background: rgba(243, 93, 133, 0.1); color: var(--pgu-primary); }
    .card-students-stat .progress-bar { background: var(--pgu-primary); }

    /* Action Buttons */
    .btn-action {
        background: white;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 0.75rem 1.25rem;
        color: var(--pgu-text-dark);
        font-weight: 600;
        transition: all 0.2s;
    }
    .btn-action:hover {
        border-color: var(--pgu-primary);
        color: var(--pgu-primary);
        transform: translateY(-2px);
    }

    /* Modern Course Cards */
    .modern-course-card {
        background: #fff;
        border-radius: 24px;
        overflow: hidden;
        border: 1px solid rgba(0,0,0,0.04);
        box-shadow: var(--pgu-card-shadow);
        transition: all 0.3s ease;
    }
    .modern-course-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.08);
    }

    .card-header-gradient {
        background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
        color: white;
    }
    .course-code-pill {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(4px);
        padding: 4px 12px;
        border-radius: 8px;
        font-size: 0.75rem;
        font-weight: 700;
        letter-spacing: 0.05em;
        border: 1px solid rgba(255, 255, 255, 0.1);
    }
    .semester-tag {
        font-size: 0.75rem;
        font-weight: 700;
        opacity: 0.8;
    }
    .course-title {
        font-weight: 700;
        line-height: 1.4;
        margin: 0;
    }

    .course-meta-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1.25rem;
    }
    .meta-item small {
        display: block;
        color: var(--pgu-text-muted);
        font-size: 0.7rem;
        text-transform: uppercase;
        font-weight: 700;
        letter-spacing: 0.05em;
        margin-bottom: 0.25rem;
    }
    .meta-item span {
        font-weight: 700;
        color: #0f172a;
        font-size: 0.9rem;
    }

    .btn-primary-pgu {
        background-color: var(--pgu-primary);
        border: none;
        color: #fff;
        transition: all 0.2s;
    }
    .btn-primary-pgu:hover {
        background-color: var(--pgu-primary-dark);
        transform: scale(1.02);
    }

    /* Empty State */
    .empty-icon-box {
        width: 80px;
        height: 80px;
        background: #f8fafc;
        border-radius: 24px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2.5rem;
        color: var(--pgu-text-muted);
    }

    .btn-icon-only {
        width: 36px;
        height: 36px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    @media (max-width: 768px) {
        .professor-dashboard { padding: 1.25rem; }
    }
</style>
