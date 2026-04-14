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
                <button class="nav-link active fw-semibold py-3 px-3" id="attendance-tab" data-bs-toggle="tab" data-bs-target="#attendance-pane" type="button" role="tab" aria-controls="attendance-pane" aria-selected="true" style="border: none;">
                    <i class="fas fa-calendar-check me-2"></i> <span class="d-none d-sm-inline">Attendance</span>
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link fw-semibold py-3 px-3" id="assignments-tab" data-bs-toggle="tab" data-bs-target="#assignments-pane" type="button" role="tab" aria-controls="assignments-pane" aria-selected="false" style="border: none;">
                    <i class="fas fa-file-alt me-2"></i> <span class="d-none d-sm-inline">Assignments</span>
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link fw-semibold py-3 px-3" id="quizzes-tab" data-bs-toggle="tab" data-bs-target="#quizzes-pane" type="button" role="tab" aria-controls="quizzes-pane" aria-selected="false" style="border: none;">
                    <i class="fas fa-question-circle me-2"></i> <span class="d-none d-sm-inline">Quizzes</span>
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link fw-semibold py-3 px-3" id="marks-tab" data-bs-toggle="tab" data-bs-target="#marks-pane" type="button" role="tab" aria-controls="marks-pane" aria-selected="false" style="border: none;">
                    <i class="fas fa-marker me-2"></i> <span class="d-none d-sm-inline">Marks</span>
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link fw-semibold py-3 px-3" id="students-tab" data-bs-toggle="tab" data-bs-target="#students-pane" type="button" role="tab" aria-controls="students-pane" aria-selected="false" style="border: none;">
                    <i class="fas fa-users me-2"></i> <span class="d-none d-sm-inline">Enrolled Students</span>
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link fw-semibold py-3 px-3" id="course-info-tab" data-bs-toggle="tab" data-bs-target="#course-info-pane" type="button" role="tab" aria-controls="course-info-pane" aria-selected="false" style="border: none;">
                    <i class="fas fa-info-circle me-2"></i> <span class="d-none d-sm-inline">Course Info</span>
                </button>
            </li>
        </ul>

        <!-- Tab Content -->
        <div class="tab-content bg-white shadow-sm p-4 p-lg-5 mb-5 px-3 px-md-0" id="courseDetailsTabContent" style="border-radius: 0 0 8px 8px;">
            <!-- Attendance Tab -->
            <div class="tab-pane fade show active" id="attendance-pane" role="tabpanel" aria-labelledby="attendance-tab">
                <h4 class="fw-bold text-dark mb-4 pb-3 border-bottom">
                    <i class="fas fa-calendar-check me-2" style="color: #3f634d;"></i> Record Attendance
                </h4>
                @if ($canEditMarkedAttendance)
                    <div class="alert alert-success d-flex align-items-center mb-4" role="alert">
                        <i class="fas fa-check-circle me-2"></i>
                        <span><strong>Attendance Edit Access:</strong> Enabled by admin. You can update already marked attendance.</span>
                    </div>
                @else
                    <div class="alert alert-warning d-flex align-items-center mb-4" role="alert">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        <span><strong>Attendance Edit Access:</strong> Disabled. Ask admin to enable permission to edit marked attendance.</span>
                    </div>
                @endif

                <!-- Attendance Recording Form -->
                <div class="card border-0 shadow-sm rounded-3 mb-5">
                    <div class="card-body p-4">
                        <form id="attendanceForm" action="{{ route('Attendance.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="offer_course_id" value="{{ $offeredCourse->id }}">
                            <input type="hidden" id="attendance_session_id" name="attendance_session_id" value="">
                            
                            <div class="row g-3 mb-4">
                                <div class="col-md-6">
                                    <label for="attendance_date" class="form-label fw-semibold">Date</label>
                                    <input type="date" class="form-control" id="attendance_date" name="date" value="{{ old('date', date('Y-m-d')) }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="time_slot" class="form-label fw-semibold">Time Slot</label>
                                    <select class="form-select" id="time_slot" name="time_slot" required>
                                        <option value="">Select Time Slot</option>
                                        <option value="Morning" {{ old('time_slot') == 'Morning' ? 'selected' : '' }}>Morning</option>
                                        <option value="Afternoon" {{ old('time_slot') == 'Afternoon' ? 'selected' : '' }}>Afternoon</option>
                                        <option value="Evening" {{ old('time_slot') == 'Evening' ? 'selected' : '' }}>Evening</option>
                                    </select>
                                </div>
                            </div>
                            <div id="attendanceEditModeAlert" class="alert alert-primary d-flex justify-content-between align-items-center mb-3" style="display: none;">
                                <div>
                                    <i class="fas fa-edit me-2"></i>
                                    <strong>Edit Mode:</strong> You are editing a selected attendance session.
                                </div>
                                <button type="button" id="cancelAttendanceEditBtn" class="btn btn-outline-secondary btn-sm">Cancel Edit</button>
                            </div>

                            <h5 class="fw-bold text-dark mb-3">Mark Students:</h5>
                            @if ($registeredStudents->count() > 0)
                                <!-- Bulk Actions -->
                                <div class="d-flex gap-2 mb-3">
                                    <button type="button" class="btn btn-success btn-sm" id="markAllPresent">
                                        <i class="fas fa-check-circle me-1"></i> Mark All Present
                                    </button>
                                    <button type="button" class="btn btn-danger btn-sm" id="markAllAbsent">
                                        <i class="fas fa-times-circle me-1"></i> Mark All Absent
                                    </button>
                                </div>
                                <div class="table-responsive mb-4">
                                    <table class="table table-hover align-middle">
                                        <thead style="background-color: #f8f9fa;">
                                            <tr>
                                                <th scope="col" class="fw-bold text-dark">Roll No.</th>
                                                <th scope="col" class="fw-bold text-dark">Student Name</th>
                                                <th scope="col" class="fw-bold text-dark text-center">Attendance %</th>
                                                <th scope="col" class="fw-bold text-dark text-center">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($registeredStudents as $student)
                                                @php
                                                    $totalSessions = $allCourseAttendanceSessions->count();
                                                    $presentCount = 0;
                                                    foreach ($allCourseAttendanceSessions as $session) {
                                                        if ($session->getStatusForStudent($student->id) == 'present') {
                                                            $presentCount++;
                                                        }
                                                    }
                                                    $percentage = $totalSessions > 0 ? round(($presentCount / $totalSessions) * 100, 1) : 0;
                                                    $rowClass = $percentage < 85 ? 'table-danger' : '';
                                                @endphp
                                                <tr class="{{ $rowClass }}" style="border-bottom: 1px solid #e9ecef;">
                                                    <td>{{ $student->student->registration->roll_no ?? 'N/A' }}</td>
                                                    <td>{{ $student->student->name ?? 'N/A' }}</td>
                                                    <td class="text-center fw-semibold">{{ $percentage }}%</td>
                                                    <td class="text-center">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="attendance[{{ $student->id }}]" id="present_{{ $student->id }}" value="present" checked>
                                                            <label class="form-check-label" for="present_{{ $student->id }}">Present</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="attendance[{{ $student->id }}]" id="absent_{{ $student->id }}" value="absent">
                                                            <label class="form-check-label" for="absent_{{ $student->id }}">Absent</label>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <button type="submit" id="saveAttendanceBtn" class="btn btn-primary btn-lg rounded-3 px-5">
                                    <i class="fas fa-save me-2"></i> <span id="saveAttendanceBtnLabel">Save Attendance</span>
                                </button>
                            @else
                                <div class="alert alert-info text-center">No students enrolled in this course to mark attendance.</div>
                            @endif
                        </form>
                    </div>
                </div>

                <h4 class="fw-bold text-dark mb-4 pb-3 border-bottom">
                    <i class="fas fa-history me-2" style="color: #3f634d;"></i> Attendance History
                </h4>
                <!-- Attendance History Cards -->
                @if ($allCourseAttendanceSessions->count() > 0)
                    <div class="row g-3">
                        @foreach ($allCourseAttendanceSessions as $session)
                            <div class="col-12 col-md-6 col-lg-4">
                                <div class="card border-0 shadow-sm rounded-3 h-100 attendance-card" style="cursor: pointer; transition: all 0.3s ease;" data-session-id="{{ $session->id }}" onclick="openAttendanceModal({{ $session->id }})">
                                    <div class="card-body text-center p-4">
                                        <div class="mb-3">
                                            <i class="fas fa-calendar-alt fa-2x text-primary mb-3"></i>
                                            <h6 class="card-title fw-bold text-dark mb-2">{{ \Carbon\Carbon::parse($session->date)->format('M d, Y') }}</h6>
                                            <p class="card-text text-muted small mb-0">{{ $session->time_slot }}</p>
                                        </div>
                                        <div class="d-flex justify-content-center gap-3">
                                            @php
                                                $presentCount = 0;
                                                $absentCount = 0;
                                                foreach ($registeredStudents as $student) {
                                                    $status = $session->getStatusForStudent($student->id);
                                                    if ($status == 'present') $presentCount++;
                                                    elseif ($status == 'absent') $absentCount++;
                                                }
                                            @endphp
                                            <span class="badge bg-success-subtle text-success px-3 py-2 rounded-pill">
                                                <i class="fas fa-check-circle me-1"></i> {{ $presentCount }} Present
                                            </span>
                                            <span class="badge bg-danger-subtle text-danger px-3 py-2 rounded-pill">
                                                <i class="fas fa-times-circle me-1"></i> {{ $absentCount }} Absent
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="alert alert-info rounded-3 border-0" role="alert">
                        <i class="fas fa-info-circle me-2"></i> No attendance records found for this course.
                    </div>
                @endif
            </div>

            <!-- Assignments Tab -->
            <div class="tab-pane fade" id="assignments-pane" role="tabpanel" aria-labelledby="assignments-tab">
                <h4 class="fw-bold text-dark mb-4 pb-3 border-bottom">
                    <i class="fas fa-file-alt me-2" style="color: #3f634d;"></i> Upload New Assignment
                </h4>

                <!-- Assignment Upload Form -->
                <div class="card border-0 shadow-sm rounded-3 mb-5">
                    <div class="card-body p-4">
                        <form action="{{ route('assignments.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="course_id" value="{{ $offeredCourse->course_id }}">
                            <input type="hidden" name="class_id" value="{{ $offeredCourse->class_id }}">

                            <div class="mb-3">
                                <label for="assignment_title" class="form-label fw-semibold">Assignment Title</label>
                                <input type="text" name="assignment_title" id="assignment_title" class="form-control rounded-3" placeholder="Enter assignment title" required>
                            </div>

                            <div class="mb-3">
                                <label for="assignment_file" class="form-label fw-semibold">Upload File</label>
                                <input type="file" name="assignment_file" id="assignment_file" class="form-control rounded-3" accept=".pdf,.doc,.docx" required>
                                <small class="form-text text-muted mt-1">Accepted formats: .pdf, .doc, .docx</small>
                            </div>

                            <div class="mb-4">
                                <label for="deadline" class="form-label fw-semibold">Deadline</label>
                                <input type="date" name="deadline" id="deadline" class="form-control rounded-3" required min="{{ now()->toDateString() }}">
                            </div>
                            <div class="mb-3">
                                <label for="total_marks" class="form-label fw-semibold">Total Marks</label>
                                <input type="number" name="total_marks" id="total_marks" class="form-control rounded-3" placeholder="e.g. 100" required min="1">
                            </div>

                            <div class="text-end">
                                <button type="submit" class="btn btn-primary px-4 rounded-pill shadow-sm">
                                    <i class="fas fa-upload me-2"></i> Upload Assignment
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <h4 class="fw-bold text-dark mb-4 pb-3 border-bottom">
                    <i class="fas fa-list-alt me-2" style="color: #3f634d;"></i> Posted Assignments
                </h4>
                @if ($assignments->count() > 0)
                    <div class="row g-4">
                        @foreach ($assignments as $assignment)
                            <div class="col-12 col-lg-6">
                                <div class="card border-0 shadow-sm rounded-3 h-100 assignment-card" style="transition: all 0.3s ease;">
                                    <div class="card-body pb-0">
                                        <h5 class="card-title fw-bold text-dark mb-2">{{ $assignment->assignment_title }}</h5>
                                        <p class="card-text text-muted small mb-3"><i class="fas fa-file-pdf me-1"></i> {{ basename($assignment->assignment_file) }}</p>
                                        <div class="d-flex justify-content-between align-items-center gap-2">
                                            <span class="badge bg-warning text-dark px-3 py-2">
                                                <i class="fas fa-check-circle me-1"></i> {{ $assignment->submissions->count() }} Submitted
                                            </span>
                                            <div class="d-flex gap-2">
                                                <button class="btn btn-sm btn-outline-secondary rounded-2" type="button" data-bs-toggle="collapse" data-bs-target="#assignmentEdit{{ $assignment->id }}">
                                                    <i class="fas fa-pen me-1"></i> Edit
                                                </button>
                                                <a href="{{ route('teacher.viewSubmissions', $assignment->id) }}" class="btn btn-sm btn-outline-primary rounded-2">
                                                    <i class="fas fa-check-double me-1"></i> Manage Marks
                                                </a>
                                            </div>
                                        </div>
                                        <div class="collapse mt-3" id="assignmentEdit{{ $assignment->id }}">
                                            <form action="{{ route('assignments.updateMeta', $assignment->id) }}" method="POST" class="border rounded-3 p-3 bg-light">
                                                @csrf
                                                <div class="row g-2 align-items-end">
                                                    <div class="col-md-5">
                                                        <label class="form-label fw-semibold mb-1">Extend Deadline</label>
                                                        <input type="date" name="deadline" class="form-control form-control-sm" min="{{ \Carbon\Carbon::parse($assignment->deadline)->format('Y-m-d') }}" value="{{ \Carbon\Carbon::parse($assignment->deadline)->format('Y-m-d') }}" required>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label class="form-label fw-semibold mb-1">Total Marks</label>
                                                        <input type="number" name="total_marks" class="form-control form-control-sm" min="1" value="{{ $assignment->total_marks }}" required>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <button type="submit" class="btn btn-sm btn-primary w-100">
                                                            <i class="fas fa-save me-1"></i> Update
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="card-footer bg-light small text-muted border-0 py-3">
                                        <i class="fas fa-calendar-alt me-1"></i> Due: <strong>{{ \Carbon\Carbon::parse($assignment->deadline)->format('M d, Y') }}</strong>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="alert alert-info rounded-3 border-0" role="alert">
                        <i class="fas fa-info-circle me-2"></i> No assignments posted for this course yet.
                    </div>
                @endif
            </div>

            <!-- Quizzes Tab -->
            <div class="tab-pane fade" id="quizzes-pane" role="tabpanel" aria-labelledby="quizzes-tab">
                <h4 class="fw-bold text-dark mb-4 pb-3 border-bottom">
                    <i class="fas fa-question-circle me-2" style="color: #3f634d;"></i> Create New Quiz
                </h4>

                <!-- Quiz Upload Form -->
                <div class="card border-0 shadow-sm rounded-3 mb-5">
                    <div class="card-body p-4">
                        <form action="{{ route('quizzes.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="course_id" value="{{ $offeredCourse->course_id }}">
                            <input type="hidden" name="class_id" value="{{ $offeredCourse->class_id }}">

                            {{-- Quiz Title --}}
                            <div class="mb-3">
                                <label for="quiz_title" class="form-label fw-semibold">Quiz Title</label>
                                <input type="text" name="quiz_title" id="quiz_title" class="form-control rounded-3" placeholder="Enter quiz title" required>
                            </div>

                            {{-- Quiz Type --}}
                            <div class="mb-3">
                                <label for="quiz_type" class="form-label fw-semibold">Quiz Type</label>
                                <select name="quiz_type" id="quiz_type" class="form-select rounded-3" onchange="toggleQuizFields()" required>
                                    <option value="">-- Select Type --</option>
                                    <option value="file">File Upload</option>
                                    <option value="mcq">MCQs</option>
                                    <option value="written">Written Questions</option>
                                </select>
                            </div>

                            {{-- File Upload --}}
                            <div id="file_upload_section" class="mb-3" style="display:none;">
                                <label for="quiz_file" class="form-label fw-semibold">Upload File</label>
                                <input type="file" name="quiz_file" id="quiz_file" class="form-control rounded-3" accept=".pdf,.doc,.docx">
                            </div>

                            {{-- MCQ Section --}}
                            <div id="mcq_section" style="display:none;">
                                <div id="mcq_container"></div>
                                <button type="button" class="btn btn-primary my-3" onclick="addMCQ()">
                                    <i class="fas fa-plus me-2"></i> Add Question
                                </button>
                                <input type="hidden" name="quiz_data" id="quiz_data">
                            </div>

                            {{-- Written Questions --}}
                            <div id="written_section" class="mb-3" style="display:none;">
                                <label for="written_questions" class="form-label fw-semibold">Written Questions</label>
                                <textarea name="written_questions" id="written_questions" class="form-control rounded-3" rows="5" placeholder="Write the questions here..."></textarea>
                            </div>

                            {{-- Deadline Date --}}
                            <div class="mb-3">
                                <label for="deadline" class="form-label fw-semibold">Deadline Date</label>
                                <input type="date" name="deadline" id="deadline" class="form-control rounded-3" min="{{ now()->toDateString() }}" required>
                            </div>

                            {{-- Deadline Time --}}
                            <div class="mb-4">
                                <label for="deadline_time" class="form-label fw-semibold">Deadline Time</label>
                                <input type="time" name="deadline_time" id="deadline_time" class="form-control rounded-3" required>
                            </div>

                            {{-- Submit --}}
                            <div class="text-end">
                                <button type="submit" class="btn btn-primary px-4 rounded-pill shadow-sm">
                                    <i class="fas fa-upload me-2"></i> Create Quiz
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <h4 class="fw-bold text-dark mb-4 pb-3 border-bottom">
                    <i class="fas fa-list-alt me-2" style="color: #3f634d;"></i> Posted Quizzes
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
                                        <div class="d-flex gap-2">
                                            <button class="btn btn-sm btn-outline-secondary w-50 rounded-2" type="button" data-bs-toggle="collapse" data-bs-target="#quizEdit{{ $quiz->id }}">
                                                <i class="fas fa-clock me-1"></i> Extend
                                            </button>
                                            <a href="{{ route('faculity.showquiz', $quiz->id) }}" class="btn btn-sm btn-outline-primary w-50 rounded-2">
                                                <i class="fas fa-check-double me-1"></i> Manage Marks
                                            </a>
                                        </div>
                                        <div class="collapse mt-3" id="quizEdit{{ $quiz->id }}">
                                            <form action="{{ route('quizzes.updateTimeline', $quiz->id) }}" method="POST" class="border rounded-3 p-3 bg-light">
                                                @csrf
                                                <div class="row g-2 align-items-end">
                                                    <div class="col-md-5">
                                                        <label class="form-label fw-semibold mb-1">New Deadline Date</label>
                                                        <input type="date" name="deadline" class="form-control form-control-sm" min="{{ \Carbon\Carbon::parse($quiz->deadline)->format('Y-m-d') }}" value="{{ \Carbon\Carbon::parse($quiz->deadline)->format('Y-m-d') }}" required>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label class="form-label fw-semibold mb-1">New Deadline Time</label>
                                                        <input type="time" name="deadline_time" class="form-control form-control-sm" value="{{ \Carbon\Carbon::parse($quiz->deadline_time)->format('H:i') }}" required>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <button type="submit" class="btn btn-sm btn-primary w-100">
                                                            <i class="fas fa-save me-1"></i> Update
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="alert alert-info rounded-3 border-0" role="alert">
                        <i class="fas fa-info-circle me-2"></i> No quizzes created for this course yet.
                    </div>
                @endif
            </div>

            <!-- Marks Tab -->
            <div class="tab-pane fade" id="marks-pane" role="tabpanel" aria-labelledby="marks-tab">
                <h4 class="fw-bold text-dark mb-4 pb-3 border-bottom">
                    <i class="fas fa-marker me-2" style="color: #3f634d;"></i> Manage Marks
                </h4>

                <div class="card border-0 shadow-sm rounded-3 mb-5">
                    <div class="card-body p-4">
                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label for="mark_type_select" class="form-label fw-semibold">Select Type</label>
                                <select class="form-select rounded-3" id="mark_type_select">
                                    <option value="">-- Select Assignment/Quiz --</option>
                                    <option value="assignments">Assignments</option>
                                    <option value="quizzes">Quizzes</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="item_select" class="form-label fw-semibold">Select Item</label>
                                <select class="form-select rounded-3" id="item_select" disabled>
                                    <option value="">-- Select an item --</option>
                                </select>
                            </div>
                        </div>

                        <div id="marks_submission_area" class="mt-4">
                            <div class="alert alert-info text-center">Please select an assignment or quiz to manage marks.</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Enrolled Students Tab -->
            <div class="tab-pane fade" id="students-pane" role="tabpanel" aria-labelledby="students-tab">
                <h4 class="fw-bold text-dark mb-4 pb-3 border-bottom">
                    <i class="fas fa-users me-2" style="color: #3f634d;"></i> Enrolled Students <span class="badge bg-primary ms-2">{{ $registeredStudents->count() }}</span>
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
                                            <span class="badge bg-light text-dark fw-semibold">{{ $registration->student->registration->roll_no ?? 'N/A' }}</span>
                                        </td>
                                        <td class="fw-500 text-dark">{{ $registration->student->name ?? 'N/A' }}</td>
                                        <td class="text-muted d-none d-md-table-cell">{{ $registration->student->email ?? 'N/A' }}</td>
                                        <td class="text-muted d-none d-lg-table-cell">{{ $registration->student->registration->department ?? 'N/A' }}</td>
                                        <td class="text-center">
                                            <button class="btn btn-sm btn-outline-primary rounded-2" data-bs-toggle="tooltip" title="View Student Profile">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="alert alert-info rounded-3 border-0" role="alert">
                        <i class="fas fa-info-circle me-2"></i> No students enrolled in this course yet.
                    </div>
                @endif
            </div>

            <!-- Course Info Tab -->
            <div class="tab-pane fade" id="course-info-pane" role="tabpanel" aria-labelledby="course-info-tab">
                <h4 class="fw-bold text-dark mb-4 pb-3 border-bottom">
                    <i class="fas fa-info-circle me-2" style="color: #3f634d;"></i> Course Information
                </h4>
                <div class="row g-4">
                    <div class="col-12 col-md-6">
                        <div class="info-item p-3 rounded-3" style="background-color: #f8f9fa;">
                            <p class="text-muted mb-1"><strong>Course Name:</strong></p>
                            <p class="text-dark fw-semibold">{{ $offeredCourse->course->course_name }}</p>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="info-item p-3 rounded-3" style="background-color: #f8f9fa;">
                            <p class="text-muted mb-1"><strong>Course Code:</strong></p>
                            <p class="text-dark fw-semibold">{{ $offeredCourse->course->course_code }}</p>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="info-item p-3 rounded-3" style="background-color: #f8f9fa;">
                            <p class="text-muted mb-1"><strong>Credit Hours:</strong></p>
                            <p class="text-dark fw-semibold">{{ $offeredCourse->course->credit_hours }} Hours</p>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="info-item p-3 rounded-3" style="background-color: #f8f9fa;">
                            <p class="text-muted mb-1"><strong>Instructor:</strong></p>
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@php
    $attendanceSessionsForJs = $allCourseAttendanceSessions->mapWithKeys(function ($session) {
        return [
            $session->id => [
                'date' => \Carbon\Carbon::parse($session->date)->format('Y-m-d'),
                'time_slot' => $session->time_slot,
                'attendance_data' => $session->attendance_data,
            ],
        ];
    })->toArray();
@endphp
<script>
    const canEditMarkedAttendance = @json($canEditMarkedAttendance);
    const attendanceSessions = @json($attendanceSessionsForJs);
    let selectedAttendanceSessionId = null;
    const defaultAttendanceDate = $('#attendance_date').val();
    const defaultTimeSlot = $('#time_slot').val();

    // Initialize tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    })

    // Handle tab persistence on page reload
    $(document).ready(function() {
        let url = location.href.replace(/\/$/, "");
        if (location.hash) {
            const hash = url.split("#");
            $('#courseDetailsTabs button[data-bs-target="#' + hash[1] + '"]').tab("show");
            url = location.href.replace(/\/#/, "#");
            history.replaceState(null, null, url);
            setTimeout(() => {
                $(window).scrollTop(0);
            }, 400);
        }

        $('button[data-bs-toggle="tab"]').on("click", function() {
            let newUrl;
            const hash = $(this).attr("data-bs-target");
            newUrl = url.split("#")[0] + hash;
            history.replaceState(null, null, newUrl);
        });

        // Marks Management Logic
        const markTypeSelect = $('#mark_type_select');
        const itemSelect = $('#item_select');
        const marksSubmissionArea = $('#marks_submission_area');
        const assignments = @json($assignments);
        const quizzes = @json($quizzes);

        markTypeSelect.on('change', function() {
            const selectedType = $(this).val();
            itemSelect.empty().append('<option value="">-- Select an item --</option>');
            itemSelect.prop('disabled', true);
            marksSubmissionArea.html('<div class="alert alert-info text-center">Please select an assignment or quiz to manage marks.</div>');

            if (selectedType === 'assignments') {
                assignments.forEach(assignment => {
                    itemSelect.append(`<option value="${assignment.id}">${assignment.assignment_title}</option>`);
                });
                itemSelect.prop('disabled', false);
            } else if (selectedType === 'quizzes') {
                quizzes.forEach(quiz => {
                    itemSelect.append(`<option value="${quiz.id}">${quiz.quiz_title}</option>`);
                });
                itemSelect.prop('disabled', false);
            }
        });

        itemSelect.on('change', function() {
            const selectedItemId = $(this).val();
            const selectedType = markTypeSelect.val();
            
            if (selectedItemId && selectedType) {
                let url = '';
                if (selectedType === 'assignments') {
                    url = `/faculty/assignments/${selectedItemId}/submissions`;
                } else if (selectedType === 'quizzes') {
                    url = `/faculty/quizzes/${selectedItemId}/submissions`;
                }

                if (url) {
                    marksSubmissionArea.html('<div class="text-center py-5"><i class="fas fa-spinner fa-spin fa-3x text-primary"></i><p class="mt-3">Loading submissions...</p></div>');
                    $.ajax({
                        url: url,
                        method: 'GET',
                        success: function(response) {
                            marksSubmissionArea.html(response);
                        },
                        error: function() {
                            marksSubmissionArea.html('<div class="alert alert-danger text-center">Error loading submissions. Please try again.</div>');
                        }
                    });
                }
            } else {
                marksSubmissionArea.html('<div class="alert alert-info text-center">Please select an assignment or quiz to manage marks.</div>');
            }
        });
    });

    // Bulk attendance actions
    $('#markAllPresent').click(function() {
        $('input[type="radio"][value="present"]').prop('checked', true);
        $('input[type="radio"][value="absent"]').prop('checked', false);
    });

    $('#markAllAbsent').click(function() {
        $('input[type="radio"][value="absent"]').prop('checked', true);
        $('input[type="radio"][value="present"]').prop('checked', false);
    });

    function resetAttendanceRadiosToDefault() {
        $('input[type="radio"][value="present"]').prop('checked', true);
        $('input[type="radio"][value="absent"]').prop('checked', false);
    }

    function enableAttendanceEditMode(sessionId) {
        $('#attendance_session_id').val(sessionId);
        $('#attendanceEditModeAlert').show();
        $('#saveAttendanceBtnLabel').text('Update Attendance');
    }

    function disableAttendanceEditMode() {
        selectedAttendanceSessionId = null;
        $('#attendance_session_id').val('');
        $('#attendanceEditModeAlert').hide();
        $('#saveAttendanceBtnLabel').text('Save Attendance');
        $('#attendance_date').val(defaultAttendanceDate);
        $('#time_slot').val(defaultTimeSlot);
        resetAttendanceRadiosToDefault();
    }

    function hideAttendanceModal() {
        const modalEl = document.getElementById('attendanceModal');
        if (!modalEl) {
            return;
        }

        if (window.bootstrap && window.bootstrap.Modal) {
            const modalInstance = bootstrap.Modal.getOrCreateInstance(modalEl);
            modalInstance.hide();
            return;
        }

        if (typeof $('#attendanceModal').modal === 'function') {
            $('#attendanceModal').modal('hide');
        }
    }

    window.loadAttendanceForEdit = function() {
        if (!canEditMarkedAttendance || !selectedAttendanceSessionId) {
            return;
        }

        const sessionData = attendanceSessions[selectedAttendanceSessionId];
        if (!sessionData) {
            return;
        }

        $('#attendance_date').val(sessionData.date);
        $('#time_slot').val(sessionData.time_slot);
        enableAttendanceEditMode(selectedAttendanceSessionId);

        const attendanceData = sessionData.attendance_data || {};
        resetAttendanceRadiosToDefault();
        Object.keys(attendanceData).forEach(function(studentId) {
            const status = attendanceData[studentId];
            $(`input[name="attendance[${studentId}]"][value="${status}"]`).prop('checked', true);
        });

        hideAttendanceModal();
        document.getElementById('attendance-pane').scrollIntoView({ behavior: 'smooth', block: 'start' });
    };

    $('#editAttendanceBtn').on('click', function() {
        window.loadAttendanceForEdit();
    });

    $('#cancelAttendanceEditBtn').on('click', function() {
        disableAttendanceEditMode();
    });

    // Quiz builder helpers
    let mcqQuestionCount = 0;

    window.toggleQuizFields = function() {
        const quizType = $('#quiz_type').val();
        $('#file_upload_section, #mcq_section, #written_section').hide();

        if (quizType === 'file') {
            $('#file_upload_section').show();
        } else if (quizType === 'mcq') {
            $('#mcq_section').show();
            if ($('#mcq_container .mcq-question-block').length === 0) {
                window.addMCQ();
            }
        } else if (quizType === 'written') {
            $('#written_section').show();
        }
    };

    window.addMCQ = function() {
        mcqQuestionCount++;
        const block = `
            <div class="card mb-3 p-3 mcq-question-block" data-question-index="${mcqQuestionCount}">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h6 class="mb-0">Question ${mcqQuestionCount}</h6>
                    <button type="button" class="btn btn-sm btn-outline-danger remove-mcq-btn">Remove</button>
                </div>
                <div class="mb-2">
                    <label class="form-label">Question</label>
                    <input type="text" class="form-control mcq-question" placeholder="Enter question" required>
                </div>
                <div class="row g-2">
                    <div class="col-md-6">
                        <label class="form-label">Option A</label>
                        <input type="text" class="form-control mcq-option" data-option-letter="A" placeholder="Option A" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Option B</label>
                        <input type="text" class="form-control mcq-option" data-option-letter="B" placeholder="Option B" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Option C</label>
                        <input type="text" class="form-control mcq-option" data-option-letter="C" placeholder="Option C" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Option D</label>
                        <input type="text" class="form-control mcq-option" data-option-letter="D" placeholder="Option D" required>
                    </div>
                </div>
                <div class="mt-2">
                    <label class="form-label">Correct Option</label>
                    <select class="form-select mcq-correct-option" required>
                        <option value="">Select correct answer</option>
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="C">C</option>
                        <option value="D">D</option>
                    </select>
                </div>
            </div>
        `;

        $('#mcq_container').append(block);
    };

    $(document).on('click', '.remove-mcq-btn', function() {
        $(this).closest('.mcq-question-block').remove();
    });

    $('form[action="{{ route('quizzes.store') }}"]').on('submit', function(e) {
        const quizType = $('#quiz_type').val();
        if (quizType !== 'mcq') {
            return;
        }

        const mcqPayload = [];
        let hasValidationError = false;

        $('#mcq_container .mcq-question-block').each(function() {
            const question = $(this).find('.mcq-question').val().trim();
            const options = [];
            $(this).find('.mcq-option').each(function() {
                options.push($(this).val().trim());
            });
            const correctOption = $(this).find('.mcq-correct-option').val();

            if (!question || options.some(option => !option) || !correctOption) {
                hasValidationError = true;
                return false;
            }

            mcqPayload.push({
                question: question,
                options: options,
                correct_option: correctOption
            });
        });

        if (hasValidationError || mcqPayload.length === 0) {
            e.preventDefault();
            alert('Please complete all MCQ fields and add at least one question.');
            return;
        }

        $('#quiz_data').val(JSON.stringify(mcqPayload));
    });

    // Function to open attendance modal
    window.openAttendanceModal = function(sessionId) {
        selectedAttendanceSessionId = sessionId;
        if (canEditMarkedAttendance) {
            $('#editAttendanceBtn').show();
        } else {
            $('#editAttendanceBtn').hide();
        }

        // Find the session data
        @foreach ($allCourseAttendanceSessions as $session)
            if ({{ $session->id }} === sessionId) {
                $('#modalDate').text('{{ \Carbon\Carbon::parse($session->date)->format("M d, Y") }}');
                $('#modalTimeSlot').text('{{ $session->time_slot }}');

                let presentList = '';
                let absentList = '';

                @foreach ($registeredStudents as $student)
                    @php
                        $status = $session->getStatusForStudent($student->id);
                    @endphp
                    @if ($status == 'present')
                        presentList += '<li class="list-group-item d-flex justify-content-between align-items-center"><span>{{ $student->student->name ?? "N/A" }} ({{ $student->student->registration->roll_no ?? "N/A" }})</span><span class="badge bg-success rounded-pill"><i class="fas fa-check"></i></span></li>';
                    @elseif ($status == 'absent')
                        absentList += '<li class="list-group-item d-flex justify-content-between align-items-center"><span>{{ $student->student->name ?? "N/A" }} ({{ $student->student->registration->roll_no ?? "N/A" }})</span><span class="badge bg-danger rounded-pill"><i class="fas fa-times"></i></span></li>';
                    @endif
                @endforeach

                $('#presentStudents').html(presentList || '<li class="list-group-item text-muted">No students marked present</li>');
                $('#absentStudents').html(absentList || '<li class="list-group-item text-muted">No students marked absent</li>');

                if (window.bootstrap && window.bootstrap.Modal) {
                    const modalEl = document.getElementById('attendanceModal');
                    const modalInstance = bootstrap.Modal.getOrCreateInstance(modalEl);
                    modalInstance.show();
                } else {
                    $('#attendanceModal').modal('show');
                }
                return;
            }
        @endforeach
    };
</script>

<!-- Attendance Details Modal -->
<div class="modal fade" id="attendanceModal" tabindex="-1" aria-labelledby="attendanceModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content rounded-3 border-0 shadow">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title fw-bold" id="attendanceModalLabel">
                    <i class="fas fa-calendar-check me-2"></i> Attendance Details
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="card border-0 bg-light">
                            <div class="card-body text-center">
                                <i class="fas fa-calendar-alt fa-2x text-primary mb-2"></i>
                                <h6 class="card-title fw-bold text-dark">Date</h6>
                                <p class="card-text text-muted mb-0" id="modalDate"></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card border-0 bg-light">
                            <div class="card-body text-center">
                                <i class="fas fa-clock fa-2x text-primary mb-2"></i>
                                <h6 class="card-title fw-bold text-dark">Time Slot</h6>
                                <p class="card-text text-muted mb-0" id="modalTimeSlot"></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <h6 class="fw-bold text-success mb-3">
                            <i class="fas fa-check-circle me-2"></i> Present Students
                        </h6>
                        <ul class="list-group list-group-flush" id="presentStudents">
                            <!-- Present students will be populated here -->
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <h6 class="fw-bold text-danger mb-3">
                            <i class="fas fa-times-circle me-2"></i> Absent Students
                        </h6>
                        <ul class="list-group list-group-flush" id="absentStudents">
                            <!-- Absent students will be populated here -->
                        </ul>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="editAttendanceBtn" onclick="loadAttendanceForEdit()" class="btn btn-primary rounded-pill px-4" style="display: none;">
                    <i class="fas fa-edit me-2"></i> Edit This Attendance
                </button>
                <button type="button" class="btn btn-secondary rounded-pill px-4" data-bs-dismiss="modal">
                    <i class="fas fa-times me-2"></i> Close
                </button>
            </div>
        </div>
    </div>
</div>
