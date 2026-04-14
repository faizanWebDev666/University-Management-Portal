<x-header />

<section class="course-details-section pt-80 pb-80">
    <div class="container">
        <!-- Course Title Header -->
        <div class="text-center mb-5">
            <h2 class="course-title-banner">
                {{ $registration->course->course_name ?? 'Course Details' }}
            </h2>
            <div class="course-meta mt-3">
                <span class="badge-code">
                    <i class="fas fa-hashtag"></i> {{ $registration->course->course_code ?? 'N/A' }}
                </span>
                <span class="badge-prof">
                    <i class="fas fa-chalkboard-teacher"></i> {{ $registration->professor->name ?? 'TBD' }}
                </span>
                <span class="badge-credits">
                    <i class="fas fa-star"></i> Credits: {{ $registration->course->credit_hours ?? 'N/A' }}
                </span>
            </div>
        </div>

        <!-- Navigation Icon Cards (Tabs) -->
        <div class="row justify-content-center mb-5 g-4">
            <div class="col-md-4">
                <div class="nav-icon-card card-attendance active-card" id="card-attendance-section" onclick="showSection('attendance-section')">
                    <div class="icon-circle bg-attendance">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                    <h4>Attendance</h4>
                    <p>View your class presence</p>
                    <span class="card-arrow"><i class="fas fa-arrow-down"></i></span>
                </div>
            </div>
            <div class="col-md-4">
                <div class="nav-icon-card card-assignments" id="card-assignments-section" onclick="showSection('assignments-section')">
                    <div class="icon-circle bg-assignments">
                        <i class="fas fa-file-alt"></i>
                    </div>
                    <h4>Assignments</h4>
                    <p>Download & submit tasks</p>
                    <span class="card-arrow"><i class="fas fa-arrow-down"></i></span>
                </div>
            </div>
            <div class="col-md-4">
                <div class="nav-icon-card card-quizzes" id="card-quizzes-section" onclick="showSection('quizzes-section')">
                    <div class="icon-circle bg-quizzes">
                        <i class="fas fa-question-circle"></i>
                    </div>
                    <h4>Quizzes</h4>
                    <p>Attempt & review quizzes</p>
                    <span class="card-arrow"><i class="fas fa-arrow-down"></i></span>
                </div>
            </div>
        </div>

        <!-- ===================== ATTENDANCE SECTION ===================== -->
        <div id="attendance-section" class="detail-section">
            <div class="section-header">
                <div class="section-icon bg-attendance"><i class="fas fa-calendar-check"></i></div>
                <div>
                    <h3 class="mb-0 fw-bold">Attendance History</h3>
                    <small class="text-muted">Your class presence records for this course</small>
                </div>
            </div>

            @php
                $totalClasses = $attendances->count();
                $presentCount = $attendances->where('status', 'present')->count();
                $absentCount = $totalClasses - $presentCount;
                $attendancePercent = $totalClasses > 0 ? round(($presentCount / $totalClasses) * 100) : 0;
            @endphp

            <!-- Attendance Summary Cards -->
            <div class="row g-3 mb-4">
                <div class="col-md-3 col-6">
                    <div class="stat-card stat-total">
                        <div class="stat-number">{{ $totalClasses }}</div>
                        <div class="stat-label">Total Classes</div>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="stat-card stat-present">
                        <div class="stat-number">{{ $presentCount }}</div>
                        <div class="stat-label">Present</div>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="stat-card stat-absent">
                        <div class="stat-number">{{ $absentCount }}</div>
                        <div class="stat-label">Absent</div>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="stat-card stat-percent">
                        <div class="stat-number">{{ $attendancePercent }}%</div>
                        <div class="stat-label">Percentage</div>
                    </div>
                </div>
            </div>

            <!-- Attendance Progress Bar -->
            <div class="mb-4">
                <div class="progress" style="height: 25px; border-radius: 12px; background-color: #e9ecef;">
                    <div class="progress-bar {{ $attendancePercent >= 75 ? 'bg-success' : ($attendancePercent >= 50 ? 'bg-warning' : 'bg-danger') }}"
                         style="width: {{ $attendancePercent }}%; font-weight: 700; font-size: 14px;">
                        {{ $attendancePercent }}%
                    </div>
                </div>
            </div>

            <!-- Attendance Table -->
            <div class="table-responsive shadow-sm rounded">
                <table class="table table-hover align-middle bg-white mb-0 custom-table">
                    <thead style="background: #1a1a2e; color: white;">
                        <tr>
                            <th class="ps-4" style="border-top-left-radius: 8px;">#</th>
                            <th>Date</th>
                            <th>Time Slot</th>
                            <th style="border-top-right-radius: 8px;">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($attendances as $index => $attendance)
                            <tr>
                                <td class="ps-4 fw-bold text-muted">{{ $index + 1 }}</td>
                                <td>{{ \Carbon\Carbon::parse($attendance->date)->format('M d, Y') }}</td>
                                <td>{{ $attendance->time_slot }}</td>
                                <td>
                                    @if($attendance->status == 'present')
                                        <span class="status-badge status-present"><i class="fas fa-check-circle me-1"></i>Present</span>
                                    @else
                                        <span class="status-badge status-absent"><i class="fas fa-times-circle me-1"></i>Absent</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-5 text-muted">
                                    <i class="fas fa-inbox fa-3x mb-3 d-block" style="opacity: 0.5;"></i>
                                    <h5>No attendance records found</h5>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- ===================== ASSIGNMENTS SECTION ===================== -->
        <div id="assignments-section" class="detail-section d-none">
            <div class="section-header">
                <div class="section-icon bg-assignments"><i class="fas fa-file-alt"></i></div>
                <div>
                    <h3 class="mb-0 fw-bold">Course Assignments</h3>
                    <small class="text-muted">Download, complete, and submit your assignments</small>
                </div>
            </div>

            @if ($assignments->isEmpty())
                <div class="empty-state">
                    <i class="fas fa-clipboard-list fa-4x mb-4 text-warning" style="opacity: 0.6;"></i>
                    <h4 class="fw-bold">No Assignments Yet</h4>
                    <p class="text-muted">No assignments have been posted for this course.</p>
                </div>
            @else
                <div class="row">
                    @foreach ($assignments as $index => $assignment)
                        @php
                            $submitted = $assignment->submissions->isNotEmpty();
                            $isPastDeadline = \Carbon\Carbon::parse($assignment->deadline)->isPast();
                        @endphp
                        <div class="col-lg-6 mb-4">
                            <div class="content-card">
                                <div class="d-flex justify-content-between align-items-start mb-3">
                                    <h5 class="fw-bold mb-0 text-dark">{{ $assignment->assignment_title }}</h5>
                                    <span class="marks-badge">{{ $assignment->total_marks }} Marks</span>
                                </div>
                                
                                <div class="mb-3 text-muted small">
                                    <div class="mb-1">
                                        <i class="fas fa-clock text-primary me-2"></i> 
                                        <strong>Deadline:</strong> <span class="{{ $isPastDeadline && !$submitted ? 'text-danger fw-bold' : '' }}">{{ \Carbon\Carbon::parse($assignment->deadline)->format('d M, Y') }}</span>
                                    </div>
                                </div>

                                <div class="d-flex gap-2 mt-4 mt-auto">
                                    <a href="{{ asset('storage/' . $assignment->assignment_file) }}" class="btn btn-sm btn-outline-dark flex-grow-1" download>
                                        <i class="fas fa-download me-1"></i> Download File
                                    </a>
                                </div>

                                <hr class="my-3 opacity-25">

                                <div id="upload-section-{{ $assignment->id }}" class="mt-2 text-center">
                                    @if ($submitted)
                                        <div class="alert alert-success py-2 mb-0 border-0 fs-sm" style="border-radius: 8px;">
                                            <i class="fas fa-check-circle me-1"></i> Assignment Submitted Successfully
                                        </div>
                                    @elseif ($isPastDeadline)
                                        <div class="alert alert-danger py-2 mb-0 border-0 fs-sm" style="border-radius: 8px;">
                                            <i class="fas fa-times-circle me-1"></i> Deadline Passed
                                        </div>
                                    @else
                                        <form class="upload-form d-flex flex-column gap-2"
                                              data-assignment-id="{{ $assignment->id }}"
                                              enctype="multipart/form-data">
                                            @csrf
                                            <div class="d-flex align-items-center gap-2">
                                                <input type="file" name="submission_file"
                                                    accept=".pdf,.doc,.docx" class="form-control form-control-sm border-2" required>
                                                <button type="submit" class="btn btn-sm btn-upload px-4 text-nowrap">
                                                    <i class="fas fa-upload me-1"></i> Upload
                                                </button>
                                            </div>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <!-- ===================== QUIZZES SECTION ===================== -->
        <div id="quizzes-section" class="detail-section d-none">
            <div class="section-header">
                <div class="section-icon bg-quizzes"><i class="fas fa-question-circle"></i></div>
                <div>
                    <h3 class="mb-0 fw-bold">Course Quizzes</h3>
                    <small class="text-muted">Attempt quizzes and track your performance</small>
                </div>
            </div>

            @if ($quizzes->isEmpty())
                <div class="empty-state">
                    <i class="fas fa-brain fa-4x mb-4 text-danger" style="opacity: 0.6;"></i>
                    <h4 class="fw-bold">No Quizzes Yet</h4>
                    <p class="text-muted">No quizzes have been posted for this course.</p>
                </div>
            @else
                @foreach ($quizzes as $quiz)
                    @php
                        $badgeClass = match($quiz->quiz_type) {
                            'mcq' => 'quiz-type-mcq',
                            'written' => 'quiz-type-written',
                            'file' => 'quiz-type-file',
                            default => 'quiz-type-default'
                        };
                        $isDeadlineOver = \Carbon\Carbon::parse($quiz->deadline . ' ' . ($quiz->deadline_time ?? '23:59'))->isPast();
                        $alreadySubmitted = $quiz->submissions->isNotEmpty();
                    @endphp

                    <div class="content-card mb-4 border-start border-4
                        {{ $quiz->quiz_type == 'mcq' ? 'border-primary' : ($quiz->quiz_type == 'written' ? 'border-warning' : 'border-success') }}">
                        
                        <div class="d-flex flex-wrap justify-content-between align-items-md-center mb-3 pb-3 border-bottom border-light">
                            <div>
                                <h4 class="mb-1 fw-bold text-dark">{{ $quiz->quiz_title }}</h4>
                                <small class="text-muted">
                                    <i class="fas fa-clock text-primary me-1"></i>
                                    <strong>Deadline:</strong>
                                    <span class="{{ $isDeadlineOver && !$alreadySubmitted ? 'text-danger fw-bold' : '' }}">
                                        {{ \Carbon\Carbon::parse($quiz->deadline)->format('d M Y') }}
                                        @if($quiz->deadline_time)
                                            at {{ \Carbon\Carbon::parse($quiz->deadline_time)->format('h:i A') }}
                                        @endif
                                    </span>
                                </small>
                            </div>
                            <div class="mt-2 mt-md-0">
                                <span class="quiz-type-badge {{ $badgeClass }} fs-6 px-3 py-1">{{ strtoupper($quiz->quiz_type) }} QUIZ</span>
                            </div>
                        </div>

                        <div class="quiz-content py-2">
                            {{-- FILE-BASED QUIZ --}}
                            @if($quiz->quiz_type === 'file' && $quiz->quiz_file)
                                <div class="bg-light p-4 rounded-3 text-center mb-0">
                                    <i class="fas fa-file-pdf fa-3x text-danger mb-3"></i>
                                    <h5 class="fw-bold">File Based Quiz</h5>
                                    <p class="text-muted small mb-3">Download the question file, write your answers, and upload the completed document before the deadline.</p>
                                    
                                    @if($isDeadlineOver && !$alreadySubmitted)
                                        <div class="alert alert-danger py-2 mb-0 border-0 d-inline-block">
                                            <i class="fas fa-ban me-1"></i> This quiz is closed. Deadline has passed.
                                        </div>
                                    @else
                                        <div class="mb-4">
                                            <a href="{{ asset('storage/' . $quiz->quiz_file) }}"
                                               class="btn btn-outline-dark" target="_blank">
                                                <i class="fas fa-download me-1"></i> Download Question File
                                            </a>
                                        </div>

                                        @if(!$alreadySubmitted)
                                            <div class="upload-box p-3 bg-white border rounded">
                                                <form action="{{ route('student.uploadAnswer', $quiz->id) }}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    <label class="form-label fw-semibold text-dark"><i class="fas fa-upload me-2 text-primary"></i>Upload Your Answer <small class="text-muted fw-normal">(PDF only, max 10MB)</small></label>
                                                    <div class="d-flex align-items-center gap-2 max-w-500 mx-auto">
                                                        <input type="file" name="answer_file" class="form-control border-2" accept="application/pdf" required>
                                                        <button class="btn btn-upload px-4" type="submit">Submit</button>
                                                    </div>
                                                </form>
                                            </div>
                                        @else
                                            <div class="alert alert-success py-2 border-0 d-inline-block shadow-sm">
                                                <i class="fas fa-check-circle me-1"></i> Quiz Submitted Successfully
                                            </div>
                                        @endif
                                    @endif
                                </div>

                            {{-- WRITTEN QUIZ --}}
                            @elseif($quiz->quiz_type === 'written')
                                <div class="written-questions-box mb-4 shadow-sm border border-light">
                                    <h6 class="fw-bold mb-3 pb-2 border-bottom"><i class="fas fa-pen-nib text-warning me-2"></i> Questions</h6>
                                    <pre class="mb-0 fs-6" style="line-height: 1.6;">{{ $quiz->written_questions }}</pre>
                                </div>

                                <div class="bg-light p-4 rounded-3 text-center border">
                                    @if($isDeadlineOver && !$alreadySubmitted)
                                        <div class="alert alert-danger py-2 mb-0 border-0 d-inline-block">
                                            <i class="fas fa-ban me-1"></i> This quiz is closed. Deadline has passed.
                                        </div>
                                    @elseif(!$alreadySubmitted)
                                        <div class="upload-box p-3 bg-white border rounded shadow-sm">
                                            <form action="{{ route('student.uploadAnswer', $quiz->id) }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <label class="form-label fw-semibold text-dark"><i class="fas fa-file-upload text-primary me-2"></i>Upload Your Response <small class="text-muted fw-normal">(PDF only)</small></label>
                                                <div class="d-flex align-items-center gap-2 max-w-500 mx-auto">
                                                    <input type="file" name="answer_file" class="form-control border-2" accept="application/pdf" required>
                                                    <button class="btn btn-warning fw-bold text-dark px-4" type="submit">Submit</button>
                                                </div>
                                            </form>
                                        </div>
                                    @else
                                        <div class="alert alert-success py-2 border-0 d-inline-block shadow-sm">
                                            <i class="fas fa-check-circle me-1"></i> Quiz Submitted Successfully
                                        </div>
                                    @endif
                                </div>

                            {{-- MCQ QUIZ --}}
                            @elseif($quiz->quiz_type === 'mcq')
                                @php $questions = json_decode($quiz->quiz_data, true); @endphp

                                <div id="mcq-quiz-{{ $quiz->id }}" class="bg-light p-4 rounded-3 border">
                                    
                                    @if($isDeadlineOver && !$alreadySubmitted)
                                        <div class="text-center">
                                            <div class="alert alert-danger py-2 mb-0 border-0 d-inline-block">
                                                <i class="fas fa-ban me-1"></i> This quiz is closed. Deadline has passed.
                                            </div>
                                        </div>
                                    @elseif(!$alreadySubmitted)
                                        <div class="text-center mb-4 quiz-intro-{{ $quiz->id }}">
                                            <i class="fas fa-laptop-code fa-3x text-primary mb-3"></i>
                                            <h5 class="fw-bold">Multiple Choice Quiz</h5>
                                            <p class="text-muted">Contains <strong>{{ count($questions ?? []) }}</strong> questions. Each question has a 1-minute time limit.</p>
                                            <button class="btn btn-primary btn-lg mt-2 shadow-sm rounded-pill px-5"
                                                    onclick="startQuiz({{ json_encode($questions) }}, '{{ $quiz->id }}')">
                                                <i class="fas fa-play-circle me-1"></i> Start Interactive Quiz
                                            </button>
                                        </div>

                                        <div class="d-none" id="quiz-container-wrapper-{{ $quiz->id }}">
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <span class="badge bg-primary px-3 py-2 fs-6" id="q-counter-{{ $quiz->id }}">Question 1/X</span>
                                                <span id="timer-{{ $quiz->id }}" class="badge bg-danger px-3 py-2 fs-6 fw-bold shadow-sm">
                                                    <i class="fas fa-stopwatch me-1"></i> 60s
                                                </span>
                                            </div>

                                            <div class="progress mb-4" style="height: 10px; border-radius: 5px;">
                                                <div id="progress-bar-{{ $quiz->id }}" class="progress-bar progress-bar-striped progress-bar-animated bg-primary" style="width: 0%;"></div>
                                            </div>

                                            <form id="mcq-form-{{ $quiz->id }}" action="{{ route('student.uploadAnswer', $quiz->id) }}" method="POST">
                                                @csrf
                                                <div id="question-container-{{ $quiz->id }}" class="bg-white p-4 rounded border shadow-sm"></div>
                                                <input type="hidden" name="answers" id="answers-{{ $quiz->id }}">
                                            </form>
                                        </div>
                                    @else
                                        <div class="text-center">
                                            <i class="fas fa-check-circle fa-4x text-success mb-3 opacity-75"></i>
                                            <h5 class="fw-bold text-success">Quiz Completed</h5>
                                            <p class="text-muted">You have successfully attempted and submitted this quiz.</p>
                                        </div>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            @endif
        </div>

        <!-- Back to Dashboard Button -->
        <div class="text-center mt-5">
            <a href="{{ route('Students.dashboard') }}" class="btn btn-back-dashboard shadow-sm">
                <i class="fas fa-arrow-left me-2"></i> Back to Dashboard
            </a>
        </div>
    </div>
</section>

<style>
    /* ================= GENERAL ================= */
    .course-details-section {
        background: #f8f9fa;
        min-height: 100vh;
        font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
    }

    /* ================= COURSE TITLE ================= */
    .course-title-banner {
        background: linear-gradient(135deg, #009A9A 0%, #006666 100%);
        color: white;
        padding: 24px 30px;
        border-radius: 16px;
        font-size: 32px;
        font-weight: 800;
        box-shadow: 0 10px 25px rgba(0, 154, 154, 0.25);
        letter-spacing: -0.5px;
    }

    .course-meta {
        display: flex;
        justify-content: center;
        gap: 15px;
        flex-wrap: wrap;
    }

    .badge-code, .badge-prof, .badge-credits {
        background: white;
        padding: 8px 20px;
        border-radius: 30px;
        font-size: 14px;
        font-weight: 700;
        box-shadow: 0 4px 10px rgba(0,0,0,0.06);
        color: #444;
        border: 1px solid #f0f0f0;
    }

    .badge-code i { color: #009A9A; }
    .badge-prof i { color: #e67e22; }
    .badge-credits i { color: #f39c12; }

    /* ================= NAV ICON CARDS (TABS) ================= */
    .nav-icon-card {
        background: white;
        border-radius: 20px;
        padding: 35px 20px;
        cursor: pointer;
        transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        position: relative;
        overflow: hidden;
        border: 2px solid transparent;
        height: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .nav-icon-card::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0;
        height: 5px;
        border-radius: 20px 20px 0 0;
        opacity: 0.7;
        transition: opacity 0.3s;
    }

    .card-attendance::before { background: linear-gradient(90deg, #20c997, #12b886); }
    .card-assignments::before { background: linear-gradient(90deg, #f39c12, #e67e22); }
    .card-quizzes::before { background: linear-gradient(90deg, #e74c3c, #c0392b); }

    .nav-icon-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 35px rgba(0,0,0,0.1);
    }
    
    .nav-icon-card:hover::before { opacity: 1; height: 8px; }

    /* ACTIVE TAB STATE */
    .nav-icon-card.active-card {
        transform: translateY(-10px);
        box-shadow: 0 15px 35px rgba(0, 154, 154, 0.15);
        border: 2px solid #009A9A;
        background: #f8ffff;
    }
    
    .nav-icon-card.active-card::before {
        background: #009A9A;
        height: 8px;
        opacity: 1;
    }

    .nav-icon-card h4 {
        font-weight: 800;
        margin-top: 20px;
        font-size: 20px;
        color: #2b2b2b;
    }

    .nav-icon-card p {
        color: #6b7280;
        margin: 0;
        font-size: 14px;
        font-weight: 500;
    }

    .icon-circle {
        width: 75px;
        height: 75px;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 32px;
        color: white;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        transition: transform 0.3s;
    }
    
    .nav-icon-card.active-card .icon-circle {
        transform: scale(1.1);
    }

    .bg-attendance { background: linear-gradient(135deg, #20c997, #12b886); }
    .bg-assignments { background: linear-gradient(135deg, #f39c12, #e67e22); }
    .bg-quizzes { background: linear-gradient(135deg, #e74c3c, #c0392b); }

    .card-arrow {
        display: block;
        margin-top: 15px;
        color: #009A9A;
        font-size: 18px;
        transition: all 0.3s ease;
        opacity: 0; 
        transform: translateY(-10px);
    }

    .nav-icon-card.active-card .card-arrow {
        opacity: 1;
        transform: translateY(0);
    }

    /* ================= DETAIL SECTION (TAB CONTENT) ================= */
    .detail-section {
        background: white;
        border-radius: 20px;
        padding: 35px;
        box-shadow: 0 10px 40px rgba(0,0,0,0.06);
        animation: slideFadeIn 0.5s ease;
        border: 1px solid #f1f3f5;
    }

    @keyframes slideFadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .section-header {
        display: flex;
        align-items: center;
        gap: 18px;
        margin-bottom: 30px;
        padding-bottom: 20px;
        border-bottom: 2px solid #f8f9fa;
    }

    .section-icon {
        width: 55px;
        height: 55px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
        color: white;
        flex-shrink: 0;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }

    /* ================= STAT CARDS ================= */
    .stat-card {
        background: #fafbfe;
        border-radius: 16px;
        padding: 22px 15px;
        text-align: center;
        box-shadow: 0 4px 12px rgba(0,0,0,0.03);
        border: 1px solid #edf2f9;
        transition: all 0.3s ease;
    }

    .stat-card:hover { transform: translateY(-3px); box-shadow: 0 6px 15px rgba(0,0,0,0.06); }
    
    .stat-number {
        font-size: 32px;
        font-weight: 800;
        color: #1a1a2e;
        line-height: 1.1;
        margin-bottom: 5px;
    }

    .stat-label {
        font-size: 13px;
        color: #6c757d;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    /* Highlight coloring for specific stats */
    .stat-present .stat-number { color: #12b886; }
    .stat-absent .stat-number { color: #fa5252; }
    .stat-percent .stat-number { color: #009A9A; }

    /* ================= CONTENT CARDS (Assignments/Quizzes) ================= */
    .content-card {
        background: #ffffff;
        border-radius: 16px;
        padding: 25px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.04);
        border: 1px solid #edf2f9;
        height: 100%;
        display: flex;
        flex-direction: column;
        transition: all 0.3s ease;
    }
    
    .content-card:hover {
        box-shadow: 0 8px 30px rgba(0,0,0,0.08);
        border-color: #e2e8f0;
    }

    /* ================= STATUS BADGES ================= */
    .status-badge {
        padding: 6px 16px;
        border-radius: 20px;
        font-size: 13px;
        font-weight: 700;
    }

    .status-present {
        background: #e6fcf5;
        color: #0ca678;
    }

    .status-absent {
        background: #fff5f5;
        color: #e03131;
    }

    /* ================= BUTTONS ================= */
    .btn-download, .btn-upload {
        border: none;
        border-radius: 8px;
        font-weight: 700;
        padding: 8px 20px;
        transition: all 0.3s ease;
    }

    .btn-upload {
        background: linear-gradient(135deg, #009A9A, #007a7a);
        color: white;
        box-shadow: 0 4px 10px rgba(0, 154, 154, 0.2);
    }

    .btn-upload:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 15px rgba(0, 154, 154, 0.3);
        color: white;
    }

    .btn-back-dashboard {
        background: white;
        color: #4b5563;
        border: 2px solid #e5e7eb;
        border-radius: 12px;
        padding: 12px 35px;
        font-weight: 700;
        font-size: 16px;
        transition: all 0.3s ease;
    }

    .btn-back-dashboard:hover {
        background: #f9fafb;
        color: #111827;
        border-color: #d1d5db;
        transform: translateY(-2px);
    }

    /* ================= BADGES ================= */
    .marks-badge {
        background: #f1f3f5;
        color: #495057;
        padding: 6px 16px;
        border-radius: 20px;
        font-weight: 800;
        font-size: 14px;
        border: 1px solid #e9ecef;
    }

    .quiz-type-badge {
        border-radius: 8px;
        font-weight: 800;
        letter-spacing: 1px;
    }
    
    .quiz-type-mcq { background: #e7f5ff; color: #1c7ed6; }
    .quiz-type-written { background: #fff9db; color: #f59f00; }
    .quiz-type-file { background: #ebfbee; color: #2b8a3e; }

    /* ================= TYPOGRAPHY & MISC ================= */
    .fs-sm { font-size: 14px; }
    .max-w-500 { max-width: 500px; }
    .custom-table th { padding: 16px; border: none; letter-spacing: 0.5px; opacity: 0.9; }
    .custom-table td { padding: 18px 16px; border-bottom: 1px solid #f1f3f5; }

    .written-questions-box {
        background: #fff;
        padding: 20px 25px;
        border-radius: 12px;
        border-left: 5px solid #f59f00 !important;
    }

    .empty-state {
        text-align: center;
        padding: 60px 20px;
        background: #fafbfe;
        border-radius: 16px;
        border: 2px dashed #edf2f9;
        margin: 20px 0;
    }

    /* ================= MOBILE RESPONSIVE ================= */
    @media (max-width: 768px) {
        .course-title-banner { font-size: 24px; padding: 18px; }
        .badge-code, .badge-prof, .badge-credits { font-size: 12px; padding: 6px 14px; }
        .nav-icon-card { padding: 20px 15px; }
        .icon-circle { width: 60px; height: 60px; font-size: 26px; }
        .detail-section { padding: 25px 15px; border-radius: 16px; }
        .stat-number { font-size: 24px; }
        .section-header { flex-direction: column; text-align: center; gap: 10px; }
    }
</style>

<!-- Functional Scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // ----- TAB SWITCHING LOGIC ------
    function showSection(sectionId) {
        // 1. Hide all detail sections
        const sections = document.querySelectorAll('.detail-section');
        sections.forEach(section => {
            section.classList.add('d-none');
        });

        // 2. Remove 'active-card' from all nav cards
        const cards = document.querySelectorAll('.nav-icon-card');
        cards.forEach(card => {
            card.classList.remove('active-card');
        });

        // 3. Show the selected section
        const selectedSection = document.getElementById(sectionId);
        if (selectedSection) {
            selectedSection.classList.remove('d-none');
            // Scroll to the content slightly down for better UX on mobile
            const y = selectedSection.getBoundingClientRect().top + window.scrollY - 100;
            window.scrollTo({top: y, behavior: 'smooth'});
        }

        // 4. Add 'active-card' state to the clicked nav card
        const selectedCard = document.getElementById('card-' + sectionId);
        if (selectedCard) {
            selectedCard.classList.add('active-card');
        }
    }

    // ----- ASSIGNMENT UPLOAD AJAX ------
    $(document).on('submit', '.upload-form', function(e) {
        e.preventDefault();
        let form = $(this);
        let assignmentId = form.data('assignment-id');
        let formData = new FormData(this);
        let btn = form.find('.btn-upload');
        let originalText = btn.html();
        
        btn.html('<i class="fas fa-spinner fa-spin me-1"></i> Uploading...').prop('disabled', true);
        
        $.ajax({
            url: `/student/submit-assignment/${assignmentId}`,
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            success: function(response) {
                $(`#upload-section-${assignmentId}`).html(`
                    <div class="alert alert-success py-2 mb-0 border-0 fs-sm" style="border-radius: 8px; animation: slideFadeIn 0.3s ease;">
                        <i class="fas fa-check-circle me-1"></i> Assignment Submitted Successfully
                    </div>
                `);
            },
            error: function(xhr) {
                let msg = xhr.responseJSON?.message || 'Upload failed.';
                alert(msg);
                btn.html(originalText).prop('disabled', false);
            }
        });
    });

    // ----- MCQ QUIZ ENGINE ------
    function startQuiz(questions, quizId) {
        // Hide intro, show quiz
        document.querySelector(`.quiz-intro-${quizId}`).classList.add('d-none');
        document.getElementById(`quiz-container-wrapper-${quizId}`).classList.remove('d-none');

        let index = 0;
        let container = document.getElementById(`question-container-${quizId}`);
        let timerEl = document.getElementById(`timer-${quizId}`);
        let progressBar = document.getElementById(`progress-bar-${quizId}`);
        let answersInput = document.getElementById(`answers-${quizId}`);
        let counterEl = document.getElementById(`q-counter-${quizId}`);
        let form = document.getElementById(`mcq-form-${quizId}`);
        let answers = [];
        let time = 60;
        let interval;

        function loadQuestion() {
            if (index >= questions.length) {
                submitQuiz();
                return;
            }

            const q = questions[index];
            counterEl.textContent = `Question ${index + 1} of ${questions.length}`;
            
            let html = `
                <div class="mb-4">
                    <h5 class="fw-bold mb-4" style="line-height: 1.5;">${q.question}</h5>
                    <div class="options-grid">`;

            q.options.forEach((opt, i) => {
                const optId = `opt-${quizId}-${index}-${i}`;
                html += `
                    <div class="form-check custom-radio-btn mb-3 p-3 border rounded-3 position-relative" style="cursor:pointer; transition:all 0.2s;" onclick="document.getElementById('${optId}').click()">
                        <input class="form-check-input ms-1 me-3 position-absolute top-50 translate-middle-y" style="width:1.2em; height:1.2em;" type="radio" name="option-${quizId}-${index}" id="${optId}" value="${String.fromCharCode(65 + i)}">
                        <label class="form-check-label ps-4 w-100 fw-medium" for="${optId}" style="cursor:pointer;">
                            <span class="badge bg-light text-dark border me-2">${String.fromCharCode(65 + i)}</span> 
                            ${opt}
                        </label>
                    </div>`;
            });

            html += `
                    </div>
                </div>
                <div class="text-end border-top pt-3 mt-4">
                    <button type="button" class="btn btn-primary px-4 fw-bold shadow-sm rounded-pill" id="next-btn-${quizId}">
                        ${index === questions.length - 1 ? 'Finish & Submit <i class="fas fa-check ms-1"></i>' : 'Next Question <i class="fas fa-arrow-right ms-1"></i>'}
                    </button>
                </div>`;

            container.innerHTML = html;
            
            // Add hover effects via JS for custom radio buttons
            document.querySelectorAll('.custom-radio-btn').forEach(btn => {
                btn.addEventListener('mouseenter', function() { if(!this.querySelector('input').checked) this.classList.add('bg-light'); });
                btn.addEventListener('mouseleave', function() { this.classList.remove('bg-light'); });
                btn.querySelector('input').addEventListener('change', function() {
                    document.querySelectorAll('.custom-radio-btn').forEach(b => {
                        b.classList.remove('border-primary', 'bg-primary');
                        b.style.backgroundColor = '';
                    });
                    this.closest('.custom-radio-btn').classList.add('border-primary');
                    this.closest('.custom-radio-btn').style.backgroundColor = '#e7f5ff';
                });
            });

            document.getElementById(`next-btn-${quizId}`).addEventListener('click', nextQuestion);

            time = 60;
            updateTimerDisplay();
            updateProgress();
        }

        function updateTimerDisplay() {
            if(time <= 10) {
                timerEl.classList.remove('bg-primary');
                timerEl.classList.add('bg-danger');
                timerEl.classList.add('animate__animated', 'animate__pulse', 'animate__infinite');
            } else {
                timerEl.classList.add('bg-primary');
                timerEl.classList.remove('bg-danger');
                timerEl.classList.remove('animate__animated', 'animate__pulse', 'animate__infinite');
            }
            timerEl.innerHTML = `<i class="fas fa-stopwatch me-1"></i> ${time}s`;
        }

        function nextQuestion(e) {
            if (e) e.preventDefault();
            clearInterval(interval);

            const selectedOption = document.querySelector(`input[name="option-${quizId}-${index}"]:checked`);
            answers.push(selectedOption ? selectedOption.value : null);

            index++;
            loadQuestion();
            startTimer();
        }

        function startTimer() {
            interval = setInterval(() => {
                time--;
                updateTimerDisplay();
                if (time <= 0) {
                    nextQuestion(new Event('submit'));
                }
            }, 1000);
        }

        function updateProgress() {
            const percent = (index / questions.length) * 100;
            progressBar.style.width = `${percent}%`;
        }

        function submitQuiz() {
            clearInterval(interval);
            container.innerHTML = `
                <div class="text-center py-5">
                    <i class="fas fa-circle-notch fa-spin fa-3x text-primary mb-3"></i>
                    <h5 class="fw-bold">Submitting Your Quiz</h5>
                    <p class="text-muted">Please wait...</p>
                </div>
            `;
            
            if (answersInput) answersInput.value = JSON.stringify(answers);
            if (form) form.submit();
        }

        loadQuestion();
        startTimer();
    }
</script>

