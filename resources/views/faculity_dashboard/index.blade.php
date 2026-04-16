<x-faculityheader />

<div class="professor-dashboard" style="background-color: #f0f2f5; min-height: 100%; padding: 0;">
    <!-- Animated Professional Background Elements -->
    <div class="background-decorations">
        <div class="floating-shape shape-1"></div>
        <div class="floating-shape shape-2"></div>
        <div class="floating-shape shape-3"></div>
    </div>
    
    <div class="container-fluid position-relative z-2" style="padding: 20px 30px;">
        <!-- Header Section with Profile -->
        <div class="row align-items-center mb-5">
            <div class="col-lg-8">
                <div class="d-flex align-items-center gap-4 mb-4">
                    <div class="position-relative profile-avatar-container">
                        <div class="avatar-glow"></div>
                        <img src="{{ asset('frontend/images/Person.png') }}" alt="Professor Avatar"
                            class="rounded-circle shadow-lg professor-avatar"
                            style="width: 120px; height: 120px; object-fit: cover; border: 5px solid #00D4FF; position: relative; z-index: 2;">
                        <span class="position-absolute bottom-0 end-0 translate-middle-y p-2 bg-success border-4 border-dark rounded-circle status-badge"
                            style="width: 35px; height: 35px; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-check text-white" style="font-size: 14px;"></i>
                        </span>
                    </div>
                    <div class="text-dark">
                        <h1 class="fw-bold mb-1" style="font-size: 2.5rem; color: #1a1a1a; text-shadow: 0 1px 2px rgba(0,0,0,0.05);">Welcome, {{ session('name', 'Professor') }}!</h1>
                        <p class="mb-2" style="font-size: 1.1rem; color: #0066cc; font-weight: 500;">Faculty Member</p>
                        <div class="d-flex gap-2 mt-3 flex-wrap">
                            <span class="badge-custom px-3 py-2" style="background: rgba(0, 102, 204, 0.1); border: 1px solid #0066cc; color: #0066cc; border-radius: 20px;">
                                <i class="fas fa-book me-1"></i> {{ !empty($professor->offeredCourses) ? count($professor->offeredCourses) : 0 }} Courses
                            </span>
                            <span class="badge-custom px-3 py-2" style="background: rgba(76, 175, 80, 0.1); border: 1px solid #4CAF50; color: #4CAF50; border-radius: 20px;">
                                <i class="fas fa-calendar me-1"></i> {{ date('Y') }} Academic Year
                            </span>
                            <span class="badge-custom px-3 py-2" style="background: rgba(76, 175, 80, 0.1); border: 1px solid #4CAF50; color: #4CAF50; border-radius: 20px;">
                                <i class="fas fa-circle-check me-1"></i> Active
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 text-lg-end text-center mt-3 mt-lg-0">
                <div class="dropdown">
                    <button class="btn btn-lg btn-primary-edu rounded-pill shadow px-5 dropdown-toggle fw-bold" 
                        type="button" id="profile-dropdown" data-bs-toggle="dropdown" aria-expanded="false"
                        style="background: linear-gradient(135deg, #0066cc, #0052a3); border: none;">
                        <i class="fas fa-user-circle me-2"></i> Profile
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end shadow-lg" style="border-radius: 15px; border: 1px solid #e0e0e0; background: #ffffff;" aria-labelledby="profile-dropdown">
                        <li><a class="dropdown-item py-2 text-dark" href="{{ route('Registration.profile') }}">
                            <i class="fas fa-user-edit me-2" style="color: #0066cc;"></i> View Profile
                        </a></li>
                        <li><a class="dropdown-item py-2 text-dark" href="{{ route('teacher.change.password') }}">
                            <i class="fas fa-key me-2" style="color: #FF9800;"></i> Change Password
                        </a></li>
                        <li><hr class="dropdown-divider my-2" style="border-color: #e0e0e0;"></li>
                        <li><a class="dropdown-item py-2 text-danger" href="{{ route('logout') }}">
                            <i class="fas fa-sign-out-alt me-2"></i> Logout
                        </a></li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="row g-4 mb-5">
            <div class="col-lg-3 col-md-6">
                <div class="stat-card-advanced rounded-4 border-0 shadow p-4 overflow-hidden" 
                    style="background: linear-gradient(135deg, #ffffff 0%, #f8fbff 100%); border-left: 5px solid #0066cc;">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <p class="text-muted mb-2" style="font-size: 0.95rem;">Total Courses</p>
                            <h3 class="fw-bold mb-2 text-dark" style="font-size: 2.5rem;">{{ !empty($professor->offeredCourses) ? count($professor->offeredCourses) : 0 }}</h3>
                            <small class="text-muted"><i class="fas fa-arrow-up me-1" style="color: #4CAF50;"></i> Active</small>
                        </div>
                        <div class="stat-icon" style="font-size: 2.5rem; opacity: 0.2; color: #0066cc;">
                            <i class="fas fa-book-open"></i>
                        </div>
                    </div>
                    <div class="progress mt-3" style="height: 4px; background: #e8e8e8;">
                        <div class="progress-bar" style="width: 75%; background: linear-gradient(90deg, #0066cc, #0052a3);"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="stat-card-advanced rounded-4 border-0 shadow p-4 overflow-hidden" 
                    style="background: linear-gradient(135deg, #ffffff 0%, #f9fff8 100%); border-left: 5px solid #4CAF50;">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <p class="text-muted mb-2" style="font-size: 0.95rem;">Active Classes</p>
                            <h3 class="fw-bold mb-2 text-dark" style="font-size: 2.5rem;">{{ !empty($professor->offeredCourses) ? $professor->offeredCourses->filter(fn($c) => $c->class)->count() : 0 }}</h3>
                            <small class="text-muted"><i class="fas fa-users me-1" style="color: #FF9800;"></i> Students</small>
                        </div>
                        <div class="stat-icon" style="font-size: 2.5rem; opacity: 0.2; color: #4CAF50;">
                            <i class="fas fa-chalkboard-user"></i>
                        </div>
                    </div>
                    <div class="progress mt-3" style="height: 4px; background: #e8e8e8;">
                        <div class="progress-bar" style="width: 60%; background: linear-gradient(90deg, #4CAF50, #45a049);"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="stat-card-advanced rounded-4 border-0 shadow p-4 overflow-hidden" 
                    style="background: linear-gradient(135deg, #ffffff 0%, #fffbf8 100%); border-left: 5px solid #FF9800;">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <p class="text-muted mb-2" style="font-size: 0.95rem;">Assignments</p>
                            <h3 class="fw-bold mb-2 text-dark" style="font-size: 2.5rem;">12</h3>
                            <small class="text-muted"><i class="fas fa-fire me-1" style="color: #FF7043;"></i> Pending</small>
                        </div>
                        <div class="stat-icon" style="font-size: 2.5rem; opacity: 0.2; color: #FF9800;">
                            <i class="fas fa-tasks"></i>
                        </div>
                    </div>
                    <div class="progress mt-3" style="height: 4px; background: #e8e8e8;">
                        <div class="progress-bar" style="width: 85%; background: linear-gradient(90deg, #FF9800, #F57C00);"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="stat-card-advanced rounded-4 border-0 shadow p-4 overflow-hidden" 
                    style="background: linear-gradient(135deg, #ffffff 0%, #fef8ff 100%); border-left: 5px solid #7C3AED;">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <p class="text-muted mb-2" style="font-size: 0.95rem;">Students Taught</p>
                            <h3 class="fw-bold mb-2 text-dark" style="font-size: 2.5rem;">{{ !empty($professor->offeredCourses) ? $professor->offeredCourses->sum(fn($c) => $c->class ? 30 : 0) : 0 }}</h3>
                            <small class="text-muted"><i class="fas fa-graduation-cap me-1" style="color: #7C3AED;"></i> Total</small>
                        </div>
                        <div class="stat-icon" style="font-size: 2.5rem; opacity: 0.2; color: #7C3AED;">
                            <i class="fas fa-user-graduate"></i>
                        </div>
                    </div>
                    <div class="progress mt-3" style="height: 4px; background: #e8e8e8;">
                        <div class="progress-bar" style="width: 70%; background: linear-gradient(90deg, #7C3AED, #6D28D9);"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="row g-4 mb-5">
            <div class="col-12">
                <h5 class="fw-bold text-dark mb-4" style="font-size: 1.3rem;">
                    <i class="fas fa-lightning me-2" style="color: #FF9800;"></i> Quick Actions
                </h5>
                <div class="d-flex flex-wrap gap-3">
                    <a href="{{ route('teacher.leave') }}" class="action-btn px-4 py-2 rounded-pill fw-semibold"
                        style="background: rgba(255, 152, 0, 0.1); border: 2px solid #FF9800; color: #FF9800; transition: all 0.3s;">
                        <i class="fas fa-calendar-times me-2"></i> Request Leave
                    </a>
                    <a href="#coursesSection" class="action-btn px-4 py-2 rounded-pill fw-semibold"
                        style="background: rgba(0, 102, 204, 0.1); border: 2px solid #0066cc; color: #0066cc; transition: all 0.3s;">
                        <i class="fas fa-book-open me-2"></i> View Courses
                    </a>
                    <a href="{{ route('faculty.course.details', $professor->offeredCourses->first()?->course?->uuid ?? '#') }}" class="action-btn px-4 py-2 rounded-pill fw-semibold"
                        style="background: rgba(76, 175, 80, 0.1); border: 2px solid #4CAF50; color: #4CAF50; transition: all 0.3s;">
                        <i class="fas fa-tasks me-2"></i> Manage Courses
                    </a>
                    <a href="{{ route('teacher.change.password') }}" class="action-btn px-4 py-2 rounded-pill fw-semibold"
                        style="background: rgba(124, 58, 237, 0.1); border: 2px solid #7C3AED; color: #7C3AED; transition: all 0.3s;">
                        <i class="fas fa-lock me-2"></i> Security
                    </a>
                </div>
            </div>
        </div>

        <!-- Main Content: Courses Section -->
        <div class="row g-0 mb-5">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="fw-bold text-dark" style="font-size: 1.3rem;">
                        <i class="fas fa-book me-2" style="color: #0066cc;"></i> My Courses
                    </h5>
                    <span class="badge-custom" style="background: rgba(0, 102, 204, 0.1); border: 1px solid #0066cc; color: #0066cc; border-radius: 20px; padding: 0.5rem 1rem;">
                        {{ !empty($professor->offeredCourses) ? count($professor->offeredCourses) : 0 }} Total
                    </span>
                </div>
            </div>
        </div>

        <!-- Courses Grid -->
        @if (!empty($professor->offeredCourses) && count($professor->offeredCourses) > 0)
        <div class="row g-4" id="coursesSection">
            @foreach ($professor->offeredCourses as $offered)
            <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="course-card-edu border-0 rounded-4 shadow-lg overflow-hidden h-100 transition-all pos-rel"
                    style="background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(10px); border: 1px solid rgba(0, 102, 204, 0.15); cursor: pointer; transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);">
                    
                    <!-- Course Header with Gradient -->
                    <div class="course-header-edu p-4" style="background: linear-gradient(135deg, #0066cc 0%, #0052a3 100%); color: white; position: relative; overflow: hidden; border-bottom: 2px solid rgba(0, 102, 204, 0.4);">
                        <div class="course-header-anime"></div>
                        <div class="position-relative z-1">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <div class="course-icon-edu rounded-3 p-3" style="background: rgba(255, 255, 255, 0.2);">
                                    <i class="fas fa-book-open" style="font-size: 1.5rem; color: #ffffff;"></i>
                                </div>
                                <span class="badge-custom" style="background: rgba(255, 255, 255, 0.25); border: 1px solid rgba(255, 255, 255, 0.4); color: #ffffff; border-radius: 8px; padding: 0.3rem 0.7rem;">
                                    @if ($offered->class)
                                        {{ strtoupper(substr($offered->class->semester, 0, 1)) }}-{{ substr($offered->class->year, -2) }}
                                    @else
                                        N/A
                                    @endif
                                </span>
                            </div>
                            <h6 class="fw-bold mb-2" style="font-size: 1.2rem; line-height: 1.4; color: #ffffff;">{{ $offered->course->course_name }}</h6>
                            <p class="mb-0" style="font-size: 0.9rem; color: rgba(255, 255, 255, 0.9);">Code: <strong>{{ $offered->course->course_code }}</strong></p>
                        </div>
                    </div>

                    <!-- Course Body -->
                    <div class="p-4">
                        <!-- Course Details -->
                        <div class="mb-4">
                            @if ($offered->class)
                            <div class="row g-2">
                                <div class="col-6">
                                    <small class="text-muted d-block mb-1" style="font-size: 0.8rem;">DEPARTMENT</small>
                                    <span class="badge-custom" style="background: rgba(0, 102, 204, 0.1); border: 1px solid rgba(0, 102, 204, 0.5); color: #0066cc; border-radius: 6px; padding: 0.35rem 0.7rem; font-size: 0.8rem;">
                                        {{ $offered->class->department }}
                                    </span>
                                </div>
                                <div class="col-6">
                                    <small class="text-muted d-block mb-1" style="font-size: 0.8rem;">SECTION</small>
                                    <span class="badge-custom" style="background: rgba(76, 175, 80, 0.1); border: 1px solid rgba(76, 175, 80, 0.5); color: #4CAF50; border-radius: 6px; padding: 0.35rem 0.7rem; font-size: 0.8rem;">
                                        {{ $offered->class->section }}
                                    </span>
                                </div>
                                <div class="col-6">
                                    <small class="text-muted d-block mb-1" style="font-size: 0.8rem;">CREDIT HOURS</small>
                                    <span class="badge-custom" style="background: rgba(255, 152, 0, 0.1); border: 1px solid rgba(255, 152, 0, 0.5); color: #FF9800; border-radius: 6px; padding: 0.35rem 0.7rem; font-size: 0.8rem;">
                                        {{ $offered->course->credit_hours }} hrs
                                    </span>
                                </div>
                                <div class="col-6">
                                    <small class="text-muted d-block mb-1" style="font-size: 0.8rem;">DEGREE</small>
                                    <span class="badge-custom" style="background: rgba(124, 58, 237, 0.1); border: 1px solid rgba(124, 58, 237, 0.5); color: #7C3AED; border-radius: 6px; padding: 0.35rem 0.7rem; font-size: 0.8rem;">
                                        {{ substr($offered->class->degree_program, 0, 8) }}
                                    </span>
                                </div>
                            </div>
                            @endif
                        </div>

                        <!-- Quick Stats -->
                        <div class="d-flex justify-content-around text-center mb-4 pb-4" style="border-bottom: 1px solid rgba(0, 0, 0, 0.1);">
                            <div>
                                <div class="text-muted small mb-2" style="font-size: 0.85rem;">STUDENTS</div>
                                <strong class="d-block fw-bold" style="color: #0066cc; font-size: 1.4rem;">{{ $offered->class ? '30+' : '0' }}</strong>
                            </div>
                            <div style="width: 1px; background: rgba(0, 0, 0, 0.1);"></div>
                            <div>
                                <div class="text-muted small mb-2" style="font-size: 0.85rem;">ASSIGNMENTS</div>
                                <strong class="d-block fw-bold" style="color: #4CAF50; font-size: 1.4rem;">5</strong>
                            </div>
                            <div style="width: 1px; background: rgba(0, 0, 0, 0.1);"></div>
                            <div>
                                <div class="text-muted small mb-2" style="font-size: 0.85rem;">QUIZZES</div>
                                <strong class="d-block fw-bold" style="color: #FF9800; font-size: 1.4rem;">3</strong>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="d-grid gap-2">
                            <a href="{{ route('faculty.course.details', $offered->course->uuid) }}" 
                                class="btn btn-primary-edu rounded-3 py-2 fw-semibold text-white" style="background: linear-gradient(135deg, #0066cc, #0052a3); border: none;">
                                <i class="fas fa-cog me-2"></i> Manage Course
                            </a>
                            <button class="btn btn-outline-custom rounded-3 py-2 fw-semibold" 
                                style="border: 2px solid #0066cc; color: #0066cc; background: transparent; transition: all 0.3s;">
                                <i class="fas fa-eye me-2"></i> View Details
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="row">
            <div class="col-12">
                <div class="alert-custom border-0 rounded-4 shadow-lg p-5 text-center" 
                    style="background: rgba(0, 102, 204, 0.08); backdrop-filter: blur(10px); border: 1px solid rgba(0, 102, 204, 0.2);">
                    <i class="fas fa-inbox" style="font-size: 3rem; color: #0066cc; mb-3;"></i>
                    <h5 class="fw-bold mt-3 text-dark">No Assigned Courses</h5>
                    <p class="text-muted">You don't have any courses assigned yet. Please contact administration.</p>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>

<x-faculityfooter />

<style>
    :root {
        --primary-color: #3f634d;
        --secondary-color: #2F4F4F;
        --light-bg: #F4F8F5;
        --border-radius: 12px;
        --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        --cyan-primary: #00D4FF;
        --success-green: #4CAF50;
        --warning-gold: #FFB700;
        --purple-accent: #9C27B0;
    }

    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #f0f2f5;
    }

    .professor-dashboard {
        background-color: #f0f2f5;
        position: relative;
        overflow: hidden;
        width: 100%;
    }

    /* Animated Background Elements */
    .background-decorations {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 0;
        pointer-events: none;
    }

    .floating-shape {
        position: absolute;
        border-radius: 50%;
        opacity: 0.05;
        mix-blend-mode: screen;
    }

    .shape-1 {
        width: 400px;
        height: 400px;
        background: #00D4FF;
        top: -100px;
        right: -50px;
        animation: float 6s ease-in-out infinite;
    }

    .shape-2 {
        width: 300px;
        height: 300px;
        background: #4CAF50;
        bottom: -50px;
        left: 50px;
        animation: float 8s ease-in-out infinite reverse;
    }

    .shape-3 {
        width: 250px;
        height: 250px;
        background: #9C27B0;
        top: 50%;
        left: 10%;
        animation: float 7s ease-in-out infinite;
    }

    .grid-pattern {
        position: absolute;
        width: 100%;
        height: 100%;
        background-image: 
            linear-gradient(0deg, transparent 24%, rgba(0, 212, 255, 0.03) 25%, rgba(0, 212, 255, 0.03) 26%, transparent 27%, transparent 74%, rgba(0, 212, 255, 0.03) 75%, rgba(0, 212, 255, 0.03) 76%, transparent 77%, transparent),
            linear-gradient(90deg, transparent 24%, rgba(0, 212, 255, 0.03) 25%, rgba(0, 212, 255, 0.03) 26%, transparent 27%, transparent 74%, rgba(0, 212, 255, 0.03) 75%, rgba(0, 212, 255, 0.03) 76%, transparent 77%, transparent);
        background-size: 50px 50px;
    }

    @keyframes float {
        0%, 100% { transform: translateY(0px) translateX(0px); }
        50% { transform: translateY(30px) translateX(10px); }
    }

    .z-2 {
        position: relative;
        z-index: 2;
    }

    .text-white-70 {
        color: rgba(255, 255, 255, 0.7);
    }

    /* Profile Avatar */
    .profile-avatar-container {
        position: relative;
    }

    .avatar-glow {
        position: absolute;
        width: 130px;
        height: 130px;
        background: radial-gradient(circle, rgba(0, 212, 255, 0.3) 0%, transparent 70%);
        border-radius: 50%;
        animation: pulse 3s ease-in-out infinite;
    }

    .professor-avatar {
        position: relative;
        z-index: 2;
    }

    .status-badge {
        position: relative;
        z-index: 3;
    }

    @keyframes pulse {
        0%, 100% { transform: scale(1); opacity: 0.5; }
        50% { transform: scale(1.1); opacity: 0.8; }
    }

    /* Stat Cards */
    .stat-card-advanced {
        transition: var(--transition);
        position: relative;
        overflow: hidden;
        background: rgba(255, 255, 255, 0.08) !important;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(0, 212, 255, 0.2) !important;
    }

    .stat-card-advanced::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
        transition: left 0.6s ease;
    }

    .stat-card-advanced:hover::before {
        left: 100%;
    }

    .stat-card-advanced:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 48px rgba(0, 212, 255, 0.3) !important;
        background: rgba(255, 255, 255, 0.12) !important;
    }

    .stat-icon {
        font-size: 2.5rem;
        opacity: 0.4;
    }

    /* Card Advanced */
    .card-advanced {
        background: rgba(255, 255, 255, 0.05) !important;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.1) !important;
        transition: var(--transition);
    }

    .card-advanced:hover {
        background: rgba(255, 255, 255, 0.08) !important;
        border: 1px solid rgba(255, 255, 255, 0.2) !important;
    }

    /* Course Card Modern */
    .course-card-edu {
        display: flex;
        flex-direction: column;
        height: 100%;
        transition: var(--transition);
        background: rgba(255, 255, 255, 0.08) !important;
        backdrop-filter: blur(10px);
    }

    .course-card-edu:hover {
        transform: translateY(-12px);
        box-shadow: 0 30px 60px rgba(0, 212, 255, 0.25) !important;
        background: rgba(255, 255, 255, 0.12) !important;
    }

    .course-header-edu {
        position: relative;
        overflow: hidden;
        background: linear-gradient(135deg, rgba(0, 212, 255, 0.2) 0%, rgba(76, 175, 80, 0.2) 100%) !important;
    }

    .course-header-anime {
        position: absolute;
        top: -50%;
        right: -50%;
        width: 200px;
        height: 200px;
        background: radial-gradient(circle, rgba(0, 212, 255, 0.3) 0%, transparent 70%);
        border-radius: 50%;
        animation: float 4s ease-in-out infinite;
    }

    .course-icon-edu {
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    /* Primary Buttons */
    .btn-primary-edu {
        background: linear-gradient(135deg, #00D4FF, #66BBFF) !important;
        border: none !important;
        transition: var(--transition);
    }

    .btn-primary-edu:hover {
        transform: translateY(-2px);
        box-shadow: 0 12px 24px rgba(0, 212, 255, 0.4) !important;
    }

    .btn-outline-custom {
        transition: var(--transition);
    }

    .btn-outline-custom:hover {
        background-color: rgba(0, 212, 255, 0.1) !important;
        border-color: #00D4FF !important;
        color: #00D4FF !important;
    }

    /* Badge Custom */
    .badge-custom {
        display: inline-block;
        font-weight: 500;
        transition: var(--transition);
    }

    .badge-custom:hover {
        transform: translateY(-2px);
    }

    /* Alert Custom */
    .alert-custom {
        background: rgba(0, 212, 255, 0.08) !important;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(0, 212, 255, 0.2) !important;
        color: #00D4FF;
    }

    /* Action Buttons */
    .action-btn {
        display: inline-flex;
        align-items: center;
        transition: var(--transition);
    }

    .action-btn:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 24px rgba(0, 0, 0, 0.2);
    }

    .action-btn:hover {
        color: inherit;
        text-decoration: none;
    }

    /* Activity List */
    .activity-list, .events-list {
        max-height: 400px;
        overflow-y: auto;
    }

    .activity-item, .event-item {
        transition: var(--transition);
    }

    .activity-item:hover, .event-item:hover {
        transform: translateX(5px);
    }

    /* Responsive Adjustments */
    @media (max-width: 1200px) {
        .container-fluid {
            padding: 20px !important;
        }

        .stat-card-advanced {
            margin-bottom: 1rem;
        }
    }

    @media (max-width: 768px) {
        .professor-dashboard {
            padding: 0;
        }

        .container-fluid {
            padding: 15px !important;
        }

        .profile-avatar-container {
            margin-bottom: 1.5rem;
        }

        .avatar-glow {
            width: 100px;
            height: 100px;
        }

        .professor-avatar {
            width: 100px !important;
            height: 100px !important;
        }

        h1 {
            font-size: 1.8rem !important;
        }

        .stat-card-advanced {
            padding: 1.5rem !important;
        }

        .course-card-edu {
            margin-bottom: 1.5rem;
        }

        .d-flex.gap-2, .d-flex.gap-3, .d-flex.gap-4 {
            flex-wrap: wrap;
        }

        .action-btn {
            font-size: 0.9rem;
            padding: 0.5rem 1.5rem !important;
        }

        .professor-dashboard .container-fluid {
            padding-top: 56px !important;
        }

        .professor-dashboard .row.align-items-center.mb-5 {
            margin-bottom: 1.5rem !important;
        }

        .professor-dashboard .d-flex.align-items-center.gap-4.mb-4 {
            flex-direction: column;
            align-items: flex-start !important;
            gap: 1rem !important;
        }

        .professor-dashboard .text-lg-end.text-center.mt-3.mt-lg-0 {
            text-align: left !important;
        }

        .professor-dashboard .btn.btn-lg.btn-primary-edu {
            width: 100%;
            max-width: 320px;
            padding-left: 1rem !important;
            padding-right: 1rem !important;
            font-size: 0.95rem;
        }

        .professor-dashboard .d-flex.justify-content-between.align-items-center.mb-4 {
            flex-direction: column;
            align-items: flex-start !important;
            gap: 0.75rem;
        }
    }

    @media (max-width: 576px) {
        .row {
            margin: 0;
        }

        .col-lg-8, .col-lg-4, .col-lg-6, .col-lg-3, .col-md-6 {
            padding: 0.5rem;
        }

        h5 {
            font-size: 1rem !important;
        }

        .stat-card-advanced h3 {
            font-size: 2rem !important;
        }

        .professor-dashboard .action-btn {
            width: 100%;
            justify-content: center;
            padding: 0.65rem 1rem !important;
            font-size: 0.85rem;
        }

        .professor-dashboard .course-card-edu .d-grid.gap-2 .btn {
            width: 100%;
            font-size: 0.85rem;
            padding-left: 0.75rem !important;
            padding-right: 0.75rem !important;
        }
    }

    @media (max-width: 300px) {
        .professor-dashboard .container-fluid {
            padding: 50px 6px 10px !important;
        }

        .professor-dashboard h1 {
            font-size: 1.15rem !important;
        }

        .professor-dashboard .badge-custom {
            font-size: 0.7rem !important;
            padding: 0.25rem 0.45rem !important;
        }

        .professor-dashboard .stat-card-advanced {
            padding: 0.8rem !important;
        }

        .professor-dashboard .stat-card-advanced h3 {
            font-size: 1.25rem !important;
        }

        .professor-dashboard .course-header-edu,
        .professor-dashboard .course-card-edu .p-4 {
            padding: 0.75rem !important;
        }
    }

    /* Transition Classes */
    .transition-all {
        transition: var(--transition);
    }

    /* Shadow Classes */
    .shadow-lg {
        box-shadow: 0 20px 48px rgba(0, 0, 0, 0.2) !important;
    }

    .shadow-xl {
        box-shadow: 0 25px 60px rgba(0, 212, 255, 0.25) !important;
    }

    .pos-rel {
        position: relative;
    }

    .z-1 {
        position: relative;
        z-index: 1;
    }
</style>

<script>
    // Initialize tooltips
    document.addEventListener('DOMContentLoaded', function() {
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });

        // Add smooth scroll
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                const href = this.getAttribute('href');
                if (href !== '#' && document.querySelector(href)) {
                    e.preventDefault();
                    document.querySelector(href).scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Responsive sidebar toggle (if needed)
        const closeBtn = document.querySelector('.close-btn');
        if (closeBtn) {
            closeBtn.addEventListener('click', function() {
                const sidebar = document.querySelector('.dash-aside-navbar');
                if (sidebar) {
                    sidebar.classList.toggle('show');
                }
            });
        }
    });
</script>
