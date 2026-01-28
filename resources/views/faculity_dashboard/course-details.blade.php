<x-faculityheader />

<div class="course-details-wrapper" style="background-color: #F4F8F5; min-height: 100vh; padding: 40px 0;">
    <div class="container-xxl">
        <!-- Header Section -->
        <div class="d-flex justify-content-between align-items-center mb-5 px-3 px-md-0">
            <div class="d-flex align-items-center gap-3">
                <a href="{{ route('faculity.dashboard') }}" class="btn btn-outline-secondary rounded-3 px-4 py-2">
                    <i class="bi bi-arrow-left me-2"></i> Back
                </a>
                <h1 class="text-dark fw-bold mb-0" style="font-size: 2.2rem;">Course Details</h1>
            </div>
            <div class="user-data d-flex align-items-center gap-3">
                <div class="user-avatar position-relative rounded-circle">
                    <img src="{{ asset('frontend/images/Person.png') }}" alt="User Avatar"
                        class="lazy-img rounded-circle"
                        style="width:48px; height:48px; object-fit:cover; border: 3px solid #3f634d;">
                    <span class="position-absolute bottom-0 end-0 translate-middle p-1 bg-success border border-2 border-light rounded-circle"></span>
                </div>
                <div class="dropdown">
                    <button class="btn btn-outline-primary rounded-pill dropdown-toggle fw-semibold px-4 py-2"
                        type="button" id="profile-dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-person-circle me-2"></i> {{ session('name', 'Guest') }}
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end shadow-lg" aria-labelledby="profile-dropdown">
                        <li>
                            <a class="dropdown-item d-flex align-items-center py-2 px-3" href="{{ route('Registration.profile') }}">
                                <i class="bi bi-person-circle me-2 text-primary"></i> View Profile
                            </a>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center py-2 px-3 text-danger" href="{{ route('logout') }}">
                                <i class="bi bi-box-arrow-right me-2"></i> Logout
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>


        <!-- Course Header Card -->
        <div class="card shadow-lg border-0 rounded-4 mb-5 px-3 px-md-0" style="background: linear-gradient(135deg, #ffffff 0%, #f8faf9 100%);">
            <div class="card-body p-4 p-lg-5">
                <div class="row align-items-center g-4">
                    <div class="col-lg-8">
                        <div class="d-flex align-items-start gap-4">
                            <div class="icon flex-shrink-0" style="background: linear-gradient(135deg, #3f634d 0%, #2F4F4F 100%); padding: 24px; border-radius: 12px; width: 80px; height: 80px; display: flex; align-items: center; justify-content: center;">
                                <i class="bi bi-journal-bookmark-fill fs-2 text-white"></i>
                            </div>
                            <div class="flex-grow-1">
                                <h1 class="fw-bold text-dark mb-3" style="font-size: 2rem;">{{ $offeredCourse->course->course_name }}</h1>
                                <div class="row g-3">
                                    <div class="col-sm-6">
                                        <p class="text-muted mb-0"><small class="text-secondary">Course Code</small></p>
                                        <p class="text-dark fw-semibold">{{ $offeredCourse->course->course_code }}</p>
                                    </div>
                                    <div class="col-sm-6">
                                        <p class="text-muted mb-0"><small class="text-secondary">Credit Hours</small></p>
                                        <p class="text-dark fw-semibold">{{ $offeredCourse->course->credit_hours }} Hrs</p>
                                    </div>
                                    <div class="col-sm-6">
                                        <p class="text-muted mb-0"><small class="text-secondary">Instructor</small></p>
                                        <p class="text-dark fw-semibold">{{ $offeredCourse->professor->name }}</p>
                                    </div>
                                    <div class="col-sm-6">
                                        <p class="text-muted mb-0"><small class="text-secondary">Class</small></p>
                                        <p class="text-dark fw-semibold">
                                            @if ($offeredCourse->class)
                                                {{ strtoupper(substr($offeredCourse->class->semester, 0, 2)) }}{{ substr($offeredCourse->class->year, -2) }}-{{ strtoupper($offeredCourse->class->department) }}-{{ strtoupper($offeredCourse->class->section) }}
                                            @else
                                                N/A
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 d-flex justify-content-lg-end justify-content-center">
                        <div class="badge bg-success p-4 rounded-3" style="font-size: 1rem; min-width: 160px; text-align: center;">
                            <i class="bi bi-check-circle me-2"></i>
                            <span class="fw-semibold">Active</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Course Statistics -->
        <div class="row g-3 mb-5 px-3 px-md-0">
            <div class="col-6 col-lg-3">
                <div class="card shadow-sm border-0 rounded-3 h-100 text-center" style="transition: all 0.3s ease;">
                    <div class="card-body py-4">
                        <div class="mb-3">
                            <i class="bi bi-people-fill" style="color: #3f634d; font-size: 2rem;"></i>
                        </div>
                        <h3 class="fw-bold text-dark mb-2">{{ $registeredStudents->count() }}</h3>
                        <p class="text-muted mb-0 small">Registered Students</p>
                    </div>
                </div>
            </div>
            <div class="col-6 col-lg-3">
                <div class="card shadow-sm border-0 rounded-3 h-100 text-center" style="transition: all 0.3s ease;">
                    <div class="card-body py-4">
                        <div class="mb-3">
                            <i class="bi bi-file-earmark-text-fill" style="color: #3f634d; font-size: 2rem;"></i>
                        </div>
                        <h3 class="fw-bold text-dark mb-2">{{ $assignments->count() }}</h3>
                        <p class="text-muted mb-0 small">Assignments Posted</p>
                    </div>
                </div>
            </div>
            <div class="col-6 col-lg-3">
                <div class="card shadow-sm border-0 rounded-3 h-100 text-center" style="transition: all 0.3s ease;">
                    <div class="card-body py-4">
                        <div class="mb-3">
                            <i class="bi bi-question-circle-fill" style="color: #3f634d; font-size: 2rem;"></i>
                        </div>
                        <h3 class="fw-bold text-dark mb-2">{{ $quizzes->count() }}</h3>
                        <p class="text-muted mb-0 small">Quizzes Created</p>
                    </div>
                </div>
            </div>
            <div class="col-6 col-lg-3">
                <div class="card shadow-sm border-0 rounded-3 h-100 text-center" style="transition: all 0.3s ease;">
                    <div class="card-body py-4">
                        <div class="mb-3">
                            <i class="bi bi-book-fill" style="color: #3f634d; font-size: 2rem;"></i>
                        </div>
                        <h3 class="fw-bold text-dark mb-2">{{ $offeredCourse->course->credit_hours }}</h3>
                        <p class="text-muted mb-0 small">Credit Hours</p>
                    </div>
                </div>
            </div>
        </div>


        <!-- Navigation Tabs -->
        <ul class="nav nav-tabs nav-fill mb-0 shadow-sm px-3 px-md-0" id="courseDetailsTabs" role="tablist" style="border-bottom: 3px solid #e9ecef; border-radius: 8px 8px 0 0;">
            <li class="nav-item" role="presentation">
                <button class="nav-link active fw-semibold py-3 px-3" id="students-tab" data-bs-toggle="tab" data-bs-target="#students-pane" type="button" role="tab" aria-controls="students-pane" aria-selected="true" style="border: none;">
                    <i class="bi bi-people-fill me-2"></i> <span class="d-none d-sm-inline">Enrolled Students</span>
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link fw-semibold py-3 px-3" id="assignments-tab" data-bs-toggle="tab" data-bs-target="#assignments-pane" type="button" role="tab" aria-controls="assignments-pane" aria-selected="false" style="border: none;">
                    <i class="bi bi-file-earmark-text-fill me-2"></i> <span class="d-none d-sm-inline">Assignments</span>
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link fw-semibold py-3 px-3" id="quizzes-tab" data-bs-toggle="tab" data-bs-target="#quizzes-pane" type="button" role="tab" aria-controls="quizzes-pane" aria-selected="false" style="border: none;">
                    <i class="bi bi-question-circle-fill me-2"></i> <span class="d-none d-sm-inline">Quizzes</span>
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link fw-semibold py-3 px-3" id="description-tab" data-bs-toggle="tab" data-bs-target="#description-pane" type="button" role="tab" aria-controls="description-pane" aria-selected="false" style="border: none;">
                    <i class="bi bi-file-earmark-text me-2"></i> <span class="d-none d-sm-inline">Info</span>
                </button>
            </li>
        </ul>

        <!-- Tab Content -->
        <div class="tab-content bg-white shadow-sm p-4 p-lg-5 mb-5 px-3 px-md-0" id="courseDetailsTabContent" style="border-radius: 0 0 8px 8px;">
            <!-- Enrolled Students Tab -->
            <div class="tab-pane fade show active" id="students-pane" role="tabpanel" aria-labelledby="students-tab">
                <h4 class="fw-bold text-dark mb-4 pb-3 border-bottom">
                    <i class="bi bi-people-fill me-2" style="color: #3f634d;"></i> Enrolled Students <span class="badge bg-primary ms-2">{{ $registeredStudents->count() }}</span>
                </h4>
                @if ($registeredStudents->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead style="background-color: #f8f9fa;">
                                <tr>
                                    <th scope="col" class="fw-bold text-dark">Roll No.</th>
                                    <th scope="col" class="fw-bold text-dark">Student Name</th>
                                    <th scope="col" class="fw-bold text-dark d-none d-md-table-cell">Email</th>
                                    <th scope="col" class="fw-bold text-dark d-none d-lg-table-cell">Department</th>
                                    <th scope="col" class="fw-bold text-dark text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($registeredStudents as $registration)
                                    <tr style="border-bottom: 1px solid #e9ecef;">
                                        <td>
                                            <span class="badge bg-light text-dark fw-semibold">{{ $registration->student->registration->roll_number ?? 'N/A' }}</span>
                                        </td>
                                        <td class="fw-500 text-dark">{{ $registration->student->name ?? 'N/A' }}</td>
                                        <td class="text-muted d-none d-md-table-cell">{{ $registration->student->email ?? 'N/A' }}</td>
                                        <td class="text-muted d-none d-lg-table-cell">{{ $registration->student->registration->department ?? 'N/A' }}</td>
                                        <td class="text-center">
                                            <button class="btn btn-sm btn-outline-primary rounded-2" data-bs-toggle="tooltip" title="View Student Profile">
                                                <i class="bi bi-eye"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="alert alert-info rounded-3 border-0" role="alert">
                        <i class="bi bi-info-circle me-2"></i> No students enrolled in this course yet.
                    </div>
                @endif
            </div>

            <!-- Assignments Tab -->
            <div class="tab-pane fade" id="assignments-pane" role="tabpanel" aria-labelledby="assignments-tab">
                <h4 class="fw-bold text-dark mb-4 pb-3 border-bottom">
                    <i class="bi bi-file-earmark-text-fill me-2" style="color: #3f634d;"></i> Course Assignments <span class="badge bg-primary ms-2">{{ $assignments->count() }}</span>
                </h4>
                @if ($assignments->count() > 0)
                    <div class="row g-4">
                        @foreach ($assignments as $assignment)
                            <div class="col-12 col-lg-6">
                                <div class="card border-0 shadow-sm rounded-3 h-100 assignment-card" style="transition: all 0.3s ease;">
                                    <div class="card-body pb-0">
                                        <h5 class="card-title fw-bold text-dark mb-2">{{ $assignment->assignment_title }}</h5>
                                        <p class="card-text text-muted small mb-3"><i class="bi bi-file-pdf me-1"></i> {{ basename($assignment->assignment_file) }}</p>
                                        <div class="d-flex justify-content-between align-items-center gap-2">
                                            <span class="badge bg-warning text-dark px-3 py-2">
                                                <i class="bi bi-check2-circle me-1"></i> {{ $assignment->submissions->count() }} Submitted
                                            </span>
                                            <a href="{{ route('teacher.viewSubmissions', $assignment->id) }}" class="btn btn-sm btn-outline-primary rounded-2">
                                                <i class="bi bi-eye me-1"></i> View
                                            </a>
                                        </div>
                                    </div>
                                    <div class="card-footer bg-light small text-muted border-0 py-3">
                                        <i class="bi bi-calendar-event me-1"></i> Due: <strong>{{ \Carbon\Carbon::parse($assignment->deadline)->format('M d, Y') }}</strong>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="alert alert-info rounded-3 border-0" role="alert">
                        <i class="bi bi-info-circle me-2"></i> No assignments posted for this course yet.
                    </div>
                @endif
            </div>

            <!-- Quizzes Tab -->
            <div class="tab-pane fade" id="quizzes-pane" role="tabpanel" aria-labelledby="quizzes-tab">
                <h4 class="fw-bold text-dark mb-4 pb-3 border-bottom">
                    <i class="bi bi-question-circle-fill me-2" style="color: #3f634d;"></i> Course Quizzes <span class="badge bg-primary ms-2">{{ $quizzes->count() }}</span>
                </h4>
                @if ($quizzes->count() > 0)
                    <div class="row g-4">
                        @foreach ($quizzes as $quiz)
                            <div class="col-12 col-lg-6">
                                <div class="card border-0 shadow-sm rounded-3 h-100 quiz-card" style="transition: all 0.3s ease;">
                                    <div class="card-body pb-0">
                                        <h5 class="card-title fw-bold text-dark mb-3">{{ $quiz->quiz_title }}</h5>
                                        <div class="row text-center mb-4 g-3">
                                            <div class="col-6 border-end">
                                                <small class="text-muted d-block mb-1">Type</small>
                                                <p class="fw-bold text-dark mb-0">{{ ucfirst($quiz->quiz_type) }}</p>
                                            </div>
                                            <div class="col-6">
                                                <small class="text-muted d-block mb-1">Deadline</small>
                                                <p class="fw-bold text-dark mb-0">{{ \Carbon\Carbon::parse($quiz->deadline)->format('M d') }}</p>
                                            </div>
                                        </div>
                                        <a href="{{ route('faculity.showquiz', $quiz->id) }}" class="btn btn-sm btn-outline-primary w-100 rounded-2">
                                            <i class="bi bi-arrow-right me-1"></i> View Results
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="alert alert-info rounded-3 border-0" role="alert">
                        <i class="bi bi-info-circle me-2"></i> No quizzes created for this course yet.
                    </div>
                @endif
            </div>

            <!-- Course Description Tab -->
            <div class="tab-pane fade" id="description-pane" role="tabpanel" aria-labelledby="description-tab">
                <h4 class="fw-bold text-dark mb-4 pb-3 border-bottom">
                    <i class="bi bi-file-earmark-text me-2" style="color: #3f634d;"></i> Course Information
                </h4>
                <div class="row g-4">
                    <div class="col-12 col-md-6">
                        <div class="info-item p-3 rounded-3" style="background-color: #f8f9fa;">
                            <p class="text-muted mb-1"><small>Course Name</small></p>
                            <p class="text-dark fw-semibold">{{ $offeredCourse->course->course_name }}</p>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="info-item p-3 rounded-3" style="background-color: #f8f9fa;">
                            <p class="text-muted mb-1"><small>Course Code</small></p>
                            <p class="text-dark fw-semibold">{{ $offeredCourse->course->course_code }}</p>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="info-item p-3 rounded-3" style="background-color: #f8f9fa;">
                            <p class="text-muted mb-1"><small>Credit Hours</small></p>
                            <p class="text-dark fw-semibold">{{ $offeredCourse->course->credit_hours }} Hours</p>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="info-item p-3 rounded-3" style="background-color: #f8f9fa;">
                            <p class="text-muted mb-1"><small>Instructor</small></p>
                            <p class="text-dark fw-semibold">{{ $offeredCourse->professor->name }}</p>
                        </div>
                    </div>
                    @if ($offeredCourse->class)
                        <div class="col-12 col-md-6">
                            <div class="info-item p-3 rounded-3" style="background-color: #f8f9fa;">
                                <p class="text-muted mb-1"><small>Semester</small></p>
                                <p class="text-dark fw-semibold">{{ $offeredCourse->class->semester }} - {{ $offeredCourse->class->year }}</p>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="info-item p-3 rounded-3" style="background-color: #f8f9fa;">
                                <p class="text-muted mb-1"><small>Department</small></p>
                                <p class="text-dark fw-semibold">{{ $offeredCourse->class->department }}</p>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="info-item p-3 rounded-3" style="background-color: #f8f9fa;">
                                <p class="text-muted mb-1"><small>Degree Program</small></p>
                                <p class="text-dark fw-semibold">{{ $offeredCourse->class->degree_program }}</p>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="info-item p-3 rounded-3" style="background-color: #f8f9fa;">
                                <p class="text-muted mb-1"><small>Section</small></p>
                                <p class="text-dark fw-semibold">{{ $offeredCourse->class->section }}</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>


        <!-- Action Buttons -->
        <div class="d-flex flex-wrap justify-content-center gap-3 mb-4 px-3 px-md-0">
            <a href="{{ route('faculity.dashboard') }}" class="btn btn-outline-secondary btn-lg rounded-3 px-4" style="min-width: 200px;">
                <i class="bi bi-arrow-left me-2"></i> Back to Dashboard
            </a>
            <a href="{{ route('Upload.assignments') }}" class="btn btn-primary btn-lg rounded-3 px-4" style="background-color: #3f634d; border-color: #3f634d; min-width: 200px;">
                <i class="bi bi-plus-circle me-2"></i> New Assignment
            </a>
            <a href="{{ route('Upload.Quizzes') }}" class="btn btn-primary btn-lg rounded-3 px-4" style="background-color: #3f634d; border-color: #3f634d; min-width: 200px;">
                <i class="bi bi-plus-circle me-2"></i> Create Quiz
            </a>
        </div>
    </div>
</div>

<x-faculityfooter />

<style>
    :root {
        --primary-color: #3f634d;
        --secondary-color: #2F4F4F;
        --light-bg: #F4F8F5;
        --border-radius: 12px;
    }

    body {
        background-color: var(--light-bg);
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .course-details-wrapper {
        background-color: var(--light-bg);
    }

    /* Cards */
    .card {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        border-radius: var(--border-radius);
    }

    .card:hover {
        box-shadow: 0 12px 32px rgba(63, 99, 77, 0.15) !important;
        transform: translateY(-4px);
    }

    .assignment-card:hover,
    .quiz-card:hover {
        box-shadow: 0 12px 32px rgba(63, 99, 77, 0.15) !important;
        transform: translateY(-3px);
    }

    /* Tabs */
    .nav-tabs .nav-link {
        color: #666;
        border: none;
        transition: all 0.3s ease;
        position: relative;
    }

    .nav-tabs .nav-link:hover {
        color: var(--primary-color);
        background-color: rgba(63, 99, 77, 0.05);
    }

    .nav-tabs .nav-link.active {
        color: #fff;
        background-color: var(--primary-color);
        border: none;
    }

    /* Buttons */
    .btn-primary {
        background-color: var(--primary-color);
        border-color: var(--primary-color);
    }

    .btn-primary:hover {
        background-color: var(--secondary-color);
        border-color: var(--secondary-color);
    }

    .btn-outline-primary {
        color: var(--primary-color);
        border-color: var(--primary-color);
    }

    .btn-outline-primary:hover {
        background-color: var(--primary-color);
        border-color: var(--primary-color);
        color: #fff;
    }

    .btn-outline-secondary:hover {
        background-color: #6c757d;
        border-color: #6c757d;
        color: #fff;
    }

    /* Tables */
    .table-hover tbody tr:hover {
        background-color: rgba(63, 99, 77, 0.05);
    }

    /* Badges */
    .badge {
        font-size: 0.85rem;
        padding: 0.5rem 0.75rem;
    }

    .badge.bg-primary {
        background-color: var(--primary-color) !important;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .main-title {
            font-size: 1.8rem;
        }

        .nav-link {
            font-size: 0.9rem;
            padding: 0.75rem 0.5rem !important;
        }

        .card-body {
            padding: 1rem !important;
        }

        .btn-lg {
            padding: 0.75rem 1rem;
            font-size: 0.95rem;
        }
    }

    /* Animations */
    .fade {
        animation: fadeIn 0.3s ease-in;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Info Items */
    .info-item {
        transition: all 0.3s ease;
        border-left: 4px solid var(--primary-color);
    }

    .info-item:hover {
        background-color: #e8f1ed !important;
    }

    /* Icon styling */
    .icon {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* Status Badge */
    .bg-success {
        background-color: #28a745 !important;
    }
</style>

<script>
    // Initialize tooltips
    document.addEventListener('DOMContentLoaded', function() {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    });
</script>
