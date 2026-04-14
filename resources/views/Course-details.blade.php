<x-header />

<section class="course-details-section">
    <!-- Top Header Banner -->
    <div class="course-header-banner">
        <div class="container">
            <div class="row align-items-center py-5">
                <div class="col-lg-8">
                    <nav aria-label="breadcrumb" class="mb-3">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('Students.dashboard') }}" class="text-white-50 text-decoration-none">Dashboard</a></li>
                            <li class="breadcrumb-item active text-white" aria-current="page">{{ $registration->course->course_code ?? 'N/A' }}</li>
                        </ol>
                    </nav>
                    <h1 class="display-5 fw-bold text-white mb-2">{{ $registration->course->course_name ?? 'Course Details' }}</h1>
                    <div class="d-flex flex-wrap gap-4 mt-3">
                        <div class="header-meta-item">
                            <span class="text-white-50 d-block small text-uppercase fw-bold">Instructor</span>
                            <span class="text-white fw-semibold"><i class="fas fa-chalkboard-teacher me-2 opacity-75"></i>{{ $registration->professor->name ?? 'TBD' }}</span>
                        </div>
                        <div class="header-meta-item">
                            <span class="text-white-50 d-block small text-uppercase fw-bold">Credits</span>
                            <span class="text-white fw-semibold"><i class="fas fa-star me-2 opacity-75"></i>{{ $registration->course->credit_hours ?? 'N/A' }} Hours</span>
                        </div>
                        <div class="header-meta-item">
                            <span class="text-white-50 d-block small text-uppercase fw-bold">Course Code</span>
                            <span class="text-white fw-semibold"><i class="fas fa-hashtag me-2 opacity-75"></i>{{ $registration->course->course_code ?? 'N/A' }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mt-4 mt-lg-0">
                    @php
                        $totalClasses = $attendances->count();
                        $presentCount = $attendances->where('status', 'present')->count();
                        $absentCount = $totalClasses - $presentCount;
                        $attendancePercent = $totalClasses > 0 ? round(($presentCount / $totalClasses) * 100) : 0;
                    @endphp
                    <div class="attendance-progress-box p-4 rounded-3" style="background: rgba(255,255,255,0.1); backdrop-filter: blur(5px);">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="text-white small fw-bold text-uppercase">Overall Attendance</span>
                            <span class="text-white fw-bold">{{ $attendancePercent }}%</span>
                        </div>
                        <div class="progress" style="height: 10px; background: rgba(255,255,255,0.2);">
                            <div class="progress-bar {{ $attendancePercent >= 75 ? 'bg-success' : ($attendancePercent >= 50 ? 'bg-warning' : 'bg-danger') }}" 
                                 role="progressbar" style="width: {{ $attendancePercent }}%" 
                                 aria-valuenow="{{ $attendancePercent }}" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <p class="text-white-50 small mt-2 mb-0">Requirement: 75% for exam eligibility</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Navigation Tabs Bar -->
    <div class="course-nav-bar sticky-top border-bottom bg-white shadow-sm">
        <div class="container">
            <ul class="nav nav-tabs border-0" id="course-tabs" role="tablist">
                <li class="nav-item">
                    <button class="nav-link active" id="tab-attendance" onclick="showSection('attendance-section')">
                        <i class="fas fa-calendar-check me-2"></i>Attendance
                    </button>
                </li>
                <li class="nav-item">
                    <button class="nav-link" id="tab-assignments" onclick="showSection('assignments-section')">
                        <i class="fas fa-file-alt me-2"></i>Assignments
                    </button>
                </li>
                <li class="nav-item">
                    <button class="nav-link" id="tab-quizzes" onclick="showSection('quizzes-section')">
                        <i class="fas fa-question-circle me-2"></i>Quizzes
                    </button>
                </li>
            </ul>
        </div>
    </div>

    <div class="container py-5">
        <!-- ===================== ATTENDANCE SECTION ===================== -->
        <div id="attendance-section" class="detail-section">
            <!-- Inline Stats Row -->
            <div class="row g-0 mb-5 border rounded-3 bg-white overflow-hidden">
                <div class="col-md-3 col-6 border-end p-4 text-center">
                    <span class="text-muted small text-uppercase fw-bold d-block mb-1">Total Classes</span>
                    <h3 class="fw-bold mb-0 text-dark">{{ $totalClasses }}</h3>
                </div>
                <div class="col-md-3 col-6 border-end p-4 text-center">
                    <span class="text-muted small text-uppercase fw-bold d-block mb-1">Present</span>
                    <h3 class="fw-bold mb-0 text-success">{{ $presentCount }}</h3>
                </div>
                <div class="col-md-3 col-6 border-end p-4 text-center">
                    <span class="text-muted small text-uppercase fw-bold d-block mb-1">Absent</span>
                    <h3 class="fw-bold mb-0 text-danger">{{ $absentCount }}</h3>
                </div>
                <div class="col-md-3 col-6 p-4 text-center">
                    <span class="text-muted small text-uppercase fw-bold d-block mb-1">Percentage</span>
                    <h3 class="fw-bold mb-0" style="color: #009A9A;">{{ $attendancePercent }}%</h3>
                </div>
            </div>

            <!-- Attendance Table -->
            <div class="table-container border rounded-3 bg-white">
                <table class="table table-hover mb-0 align-middle">
                    <thead class="bg-light border-bottom">
                        <tr>
                            <th class="ps-4 py-3 text-uppercase small fw-bold text-muted" style="width: 80px;">#</th>
                            <th class="py-3 text-uppercase small fw-bold text-muted">Date</th>
                            <th class="py-3 text-uppercase small fw-bold text-muted">Time Slot</th>
                            <th class="pe-4 py-3 text-uppercase small fw-bold text-muted text-end">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($attendances as $index => $attendance)
                            <tr class="border-bottom">
                                <td class="ps-4 py-3 text-muted fw-semibold">{{ $index + 1 }}</td>
                                <td class="py-3 fw-medium">{{ \Carbon\Carbon::parse($attendance->date)->format('M d, Y') }}</td>
                                <td class="py-3 text-muted">{{ $attendance->time_slot }}</td>
                                <td class="pe-4 py-3 text-end">
                                    @if($attendance->status == 'present')
                                        <span class="badge rounded-pill bg-success-subtle text-success px-3 border border-success-subtle">
                                            <i class="fas fa-check-circle me-1 small"></i>Present
                                        </span>
                                    @else
                                        <span class="badge rounded-pill bg-danger-subtle text-danger px-3 border border-danger-subtle">
                                            <i class="fas fa-times-circle me-1 small"></i>Absent
                                        </span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-5">
                                    <div class="py-4">
                                        <i class="fas fa-inbox fa-3x mb-3 text-muted opacity-25"></i>
                                        <p class="text-muted mb-0">No attendance records found for this course.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- ===================== ASSIGNMENTS SECTION ===================== -->
        <div id="assignments-section" class="detail-section d-none">
            <div class="row g-4">
                @forelse ($assignments as $index => $assignment)
                    @php
                        $submitted = $assignment->submissions->isNotEmpty();
                        $isPastDeadline = \Carbon\Carbon::parse($assignment->deadline)->isPast();
                    @endphp
                    <div class="col-lg-12">
                        <div class="assignment-row border rounded-3 bg-white p-4 d-md-flex align-items-center justify-content-between gap-4">
                            <div class="d-flex align-items-center gap-4 flex-grow-1">
                                <div class="assignment-icon flex-shrink-0 d-flex align-items-center justify-content-center rounded-3 bg-light text-primary" style="width: 50px; height: 50px;">
                                    <i class="fas fa-file-pdf fs-4"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <h5 class="fw-bold text-dark mb-1">{{ $assignment->assignment_title }}</h5>
                                    <div class="d-flex flex-wrap gap-3 small text-muted">
                                        <span><i class="fas fa-calendar-alt me-1"></i> Due: {{ \Carbon\Carbon::parse($assignment->deadline)->format('d M, Y') }}</span>
                                        <span><i class="fas fa-star me-1"></i> {{ $assignment->total_marks }} Marks</span>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex flex-column align-items-md-end gap-3 mt-4 mt-md-0" id="upload-section-{{ $assignment->id }}">
                                <div class="d-flex gap-2">
                                    <a href="{{ asset('storage/' . $assignment->assignment_file) }}" class="btn btn-sm btn-outline-dark px-3 rounded-pill" download>
                                        <i class="fas fa-download me-1"></i> Download
                                    </a>
                                    
                                    @if ($submitted)
                                        <span class="btn btn-sm btn-success px-3 rounded-pill disabled border-0">
                                            <i class="fas fa-check-circle me-1"></i> Submitted
                                        </span>
                                    @elseif ($isPastDeadline)
                                        <span class="btn btn-sm btn-danger px-3 rounded-pill disabled border-0">
                                            <i class="fas fa-times-circle me-1"></i> Overdue
                                        </span>
                                    @endif
                                </div>

                                @if (!$submitted && !$isPastDeadline)
                                    <form class="upload-form" data-assignment-id="{{ $assignment->id }}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="input-group input-group-sm">
                                            <input type="file" name="submission_file" accept=".pdf,.doc,.docx" class="form-control border-end-0 rounded-start-pill" required>
                                            <button type="submit" class="btn btn-primary btn-upload rounded-end-pill px-4">
                                                <i class="fas fa-upload me-1"></i> Upload
                                            </button>
                                        </div>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <div class="py-5 bg-white border rounded-3">
                            <i class="fas fa-clipboard-list fa-3x mb-3 text-muted opacity-25"></i>
                            <p class="text-muted">No assignments have been posted yet.</p>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- ===================== QUIZZES SECTION ===================== -->
        <div id="quizzes-section" class="detail-section d-none">
            <div class="row g-4">
                @forelse ($quizzes as $quiz)
                    @php
                        $badgeClass = match($quiz->quiz_type) {
                            'mcq' => 'bg-primary-subtle text-primary',
                            'written' => 'bg-warning-subtle text-warning-emphasis',
                            'file' => 'bg-success-subtle text-success',
                            default => 'bg-secondary-subtle text-secondary'
                        };
                        $isDeadlineOver = \Carbon\Carbon::parse($quiz->deadline . ' ' . ($quiz->deadline_time ?? '23:59'))->isPast();
                        $alreadySubmitted = $quiz->submissions->isNotEmpty();
                    @endphp

                    <div class="col-lg-12">
                        <div class="quiz-row border rounded-3 bg-white p-4">
                            <div class="d-md-flex align-items-center justify-content-between gap-4 mb-4">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="quiz-icon flex-shrink-0 d-flex align-items-center justify-content-center rounded-3 {{ $badgeClass }} border" style="width: 50px; height: 50px;">
                                        <i class="fas {{ $quiz->quiz_type == 'mcq' ? 'fa-list-ul' : ($quiz->quiz_type == 'written' ? 'fa-pen-nib' : 'fa-file-upload') }} fs-4"></i>
                                    </div>
                                    <div>
                                        <h5 class="fw-bold text-dark mb-1">{{ $quiz->quiz_title }}</h5>
                                        <div class="d-flex flex-wrap gap-3 small text-muted">
                                            <span><i class="fas fa-clock me-1"></i> Due: {{ \Carbon\Carbon::parse($quiz->deadline)->format('d M, Y') }}</span>
                                            <span class="badge rounded-pill {{ $badgeClass }} px-2 text-uppercase" style="font-size: 10px;">{{ $quiz->quiz_type }}</span>
                                        </div>
                                    </div>
                                </div>
                                
                                @if($alreadySubmitted)
                                    <div class="alert alert-success py-1 px-3 mb-0 border-0 rounded-pill small">
                                        <i class="fas fa-check-circle me-1"></i> Completed
                                    </div>
                                @elseif($isDeadlineOver)
                                    <div class="alert alert-danger py-1 px-3 mb-0 border-0 rounded-pill small">
                                        <i class="fas fa-ban me-1"></i> Closed
                                    </div>
                                @endif
                            </div>

                            <div class="quiz-action-container mt-3">
                                {{-- FILE-BASED QUIZ --}}
                                @if($quiz->quiz_type === 'file' && $quiz->quiz_file)
                                    <div class="bg-light p-4 rounded-3 border-0">
                                        <div class="row align-items-center g-4">
                                            <div class="col-md-7">
                                                <p class="text-muted small mb-0">Download the question file, write your answers, and upload as PDF.</p>
                                            </div>
                                            <div class="col-md-5 text-md-end">
                                                @if(!$alreadySubmitted && !$isDeadlineOver)
                                                    <div class="d-flex flex-column gap-3">
                                                        <a href="{{ asset('storage/' . $quiz->quiz_file) }}" class="btn btn-sm btn-dark px-4 rounded-pill" target="_blank">
                                                            <i class="fas fa-download me-2"></i> Download Question
                                                        </a>
                                                        <form action="{{ route('student.uploadAnswer', $quiz->id) }}" method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                            <div class="input-group input-group-sm">
                                                                <input type="file" name="answer_file" class="form-control rounded-start-pill border-end-0" accept="application/pdf" required>
                                                                <button class="btn btn-primary px-4 rounded-end-pill" type="submit">Submit</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                @elseif(!$alreadySubmitted && $isDeadlineOver)
                                                    <button class="btn btn-sm btn-outline-secondary px-4 rounded-pill disabled">
                                                        <i class="fas fa-lock me-2"></i> Quiz Closed
                                                    </button>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                {{-- WRITTEN QUIZ --}}
                                @elseif($quiz->quiz_type === 'written')
                                    <div class="written-box p-4 rounded-3 bg-light mb-0 border-0">
                                        <h6 class="fw-bold text-dark mb-3">Questions:</h6>
                                        <pre class="bg-white p-3 rounded border small mb-4 text-dark" style="white-space: pre-wrap;">{{ $quiz->written_questions }}</pre>
                                        
                                        @if(!$alreadySubmitted && !$isDeadlineOver)
                                            <div class="max-w-500 ms-auto">
                                                <form action="{{ route('student.uploadAnswer', $quiz->id) }}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="input-group input-group-sm">
                                                        <input type="file" name="answer_file" class="form-control rounded-start-pill border-end-0" accept="application/pdf" required>
                                                        <button class="btn btn-primary px-4 rounded-end-pill" type="submit">Submit</button>
                                                    </div>
                                                </form>
                                            </div>
                                        @endif
                                    </div>

                                {{-- MCQ QUIZ --}}
                                @elseif($quiz->quiz_type === 'mcq')
                                    @php $questions = json_decode($quiz->quiz_data, true); @endphp
                                    <div id="mcq-quiz-{{ $quiz->id }}" class="bg-light p-4 rounded-3 border-0 text-center">
                                        @if(!$alreadySubmitted && !$isDeadlineOver)
                                            <div class="quiz-intro-{{ $quiz->id }}">
                                                <p class="text-muted small mb-4">Multiple Choice Quiz • {{ count($questions ?? []) }} Questions • 1 Minute per Question</p>
                                                <button class="btn btn-primary px-5 py-2 rounded-pill fw-bold" 
                                                        onclick="startQuiz({{ json_encode($questions) }}, '{{ $quiz->id }}')">
                                                    <i class="fas fa-play me-2"></i> Start Quiz
                                                </button>
                                            </div>

                                            <div class="d-none text-start" id="quiz-container-wrapper-{{ $quiz->id }}">
                                                <div class="d-flex justify-content-between align-items-center mb-3">
                                                    <span class="badge bg-white text-dark border px-3 py-2 fw-semibold" id="q-counter-{{ $quiz->id }}">Question 1</span>
                                                    <span id="timer-{{ $quiz->id }}" class="badge bg-danger px-3 py-2 fw-bold shadow-sm">60s</span>
                                                </div>
                                                <div class="progress mb-4" style="height: 6px; border-radius: 3px; background: #e0e0e0;">
                                                    <div id="progress-bar-{{ $quiz->id }}" class="progress-bar bg-primary" style="width: 0%;"></div>
                                                </div>
                                                <form id="mcq-form-{{ $quiz->id }}" action="{{ route('student.uploadAnswer', $quiz->id) }}" method="POST">
                                                    @csrf
                                                    <div id="question-container-{{ $quiz->id }}" class="bg-white p-4 rounded-3 border"></div>
                                                    <input type="hidden" name="answers" id="answers-{{ $quiz->id }}">
                                                </form>
                                            </div>
                                        @elseif($alreadySubmitted)
                                            <div class="py-2">
                                                <i class="fas fa-check-circle fa-2x text-success mb-2"></i>
                                                <p class="text-success fw-bold mb-0">Quiz Submitted</p>
                                            </div>
                                        @endif
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <div class="py-5 bg-white border rounded-3">
                            <i class="fas fa-brain fa-3x mb-3 text-muted opacity-25"></i>
                            <p class="text-muted">No quizzes have been posted yet.</p>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</section>

<style>
    /* ================= UNIVERSAL STYLES ================= */
    :root {
        --primary: #009A9A;
        --primary-dark: #007a7a;
        --bg-light: #f8f9fa;
        --border-color: #e9ecef;
    }

    body {
        background-color: var(--bg-light);
        font-family: 'Inter', -apple-system, system-ui, sans-serif;
    }

    /* ================= HEADER BANNER ================= */
    .course-header-banner {
        background: linear-gradient(135deg, #009A9A 0%, #006666 100%);
        color: white;
        border-bottom: 1px solid rgba(255,255,255,0.1);
    }

    .breadcrumb-item + .breadcrumb-item::before {
        color: rgba(255,255,255,0.3);
    }

    .header-meta-item {
        position: relative;
    }

    /* ================= NAVIGATION ================= */
    .course-nav-bar {
        z-index: 1020;
    }

    .nav-tabs .nav-link {
        border: none;
        padding: 1.2rem 1.5rem;
        font-weight: 600;
        color: #6c757d;
        font-size: 15px;
        position: relative;
        background: transparent;
        transition: all 0.2s ease;
    }

    .nav-tabs .nav-link:hover {
        color: var(--primary);
    }

    .nav-tabs .nav-link.active {
        color: var(--primary);
        background: transparent;
    }

    .nav-tabs .nav-link.active::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 3px;
        background: var(--primary);
    }

    /* ================= TABLES & LISTS ================= */
    .table thead th {
        background: #fdfdfd;
        border-top: none;
    }

    .table-hover tbody tr:hover {
        background-color: #f8ffff;
    }

    .badge-subtle {
        font-weight: 700;
    }

    .assignment-row, .quiz-row {
        transition: all 0.2s ease;
        border: 1px solid var(--border-color) !important;
    }

    .assignment-row:hover, .quiz-row:hover {
        border-color: var(--primary) !important;
        background-color: #fdfdfd;
    }

    /* ================= BUTTONS ================= */
    .btn-primary, .btn-upload {
        background-color: var(--primary) !important;
        border-color: var(--primary) !important;
        font-weight: 600;
    }

    .btn-primary:hover, .btn-upload:hover {
        background-color: var(--primary-dark) !important;
        border-color: var(--primary-dark) !important;
    }

    .rounded-pill {
        border-radius: 50rem !important;
    }

    /* ================= PROGRESS & CARDS ================= */
    .progress {
        background-color: #e9ecef;
        box-shadow: none;
    }

    .bg-success-subtle { background-color: #e6fcf5; }
    .bg-danger-subtle { background-color: #fff5f5; }
    .bg-primary-subtle { background-color: #e7f5ff; }
    .bg-warning-subtle { background-color: #fff9db; }

    /* ================= QUIZ ENGINE ================= */
    .custom-radio-btn {
        transition: all 0.2s ease;
    }
    
    .custom-radio-btn:hover {
        border-color: var(--primary) !important;
    }

    pre {
        font-family: inherit;
    }

    @media (max-width: 768px) {
        .nav-tabs .nav-link {
            padding: 1rem 0.8rem;
            font-size: 13px;
        }
        .header-meta-item {
            width: 100%;
        }
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

        // 2. Remove 'active' from all nav links
        const navLinks = document.querySelectorAll('.nav-link');
        navLinks.forEach(link => {
            link.classList.remove('active');
        });

        // 3. Show the selected section
        const selectedSection = document.getElementById(sectionId);
        if (selectedSection) {
            selectedSection.classList.remove('d-none');
        }

        // 4. Add 'active' state to the clicked tab button
        const selectedTab = document.getElementById('tab-' + sectionId.split('-')[0]);
        if (selectedTab) {
            selectedTab.classList.add('active');
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
                    <div class="alert alert-success py-2 px-4 mb-0 border-0 rounded-pill small" style="animation: slideFadeIn 0.3s ease;">
                        <i class="fas fa-check-circle me-1"></i> Submitted Successfully
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
                    <div class="form-check custom-radio-btn mb-3 p-3 border rounded-3 position-relative" style="cursor:pointer;" onclick="document.getElementById('${optId}').click()">
                        <input class="form-check-input ms-1 me-3 position-absolute top-50 translate-middle-y" style="width:1.2em; height:1.2em;" type="radio" name="option-${quizId}-${index}" id="${optId}" value="${String.fromCharCode(65 + i)}">
                        <label class="form-check-label ps-4 w-100 fw-medium mb-0" for="${optId}" style="cursor:pointer;">
                            <span class="badge bg-light text-dark border me-2">${String.fromCharCode(65 + i)}</span> 
                            ${opt}
                        </label>
                    </div>`;
            });

            html += `
                    </div>
                </div>
                <div class="text-end border-top pt-4 mt-4">
                    <button type="button" class="btn btn-primary px-5 rounded-pill fw-bold" id="next-btn-${quizId}">
                        ${index === questions.length - 1 ? 'Finish & Submit' : 'Next Question'}
                    </button>
                </div>`;

            container.innerHTML = html;
            
            document.querySelectorAll('.custom-radio-btn').forEach(btn => {
                btn.querySelector('input').addEventListener('change', function() {
                    document.querySelectorAll('.custom-radio-btn').forEach(b => {
                        b.classList.remove('border-primary', 'bg-primary-subtle');
                        b.style.borderColor = '#e9ecef';
                    });
                    this.closest('.custom-radio-btn').classList.add('border-primary', 'bg-primary-subtle');
                    this.closest('.custom-radio-btn').style.borderColor = 'var(--primary)';
                });
            });

            document.getElementById(`next-btn-${quizId}`).addEventListener('click', nextQuestion);
            time = 60;
            updateTimerDisplay();
            updateProgress();
        }

        function updateTimerDisplay() {
            timerEl.textContent = `${time}s`;
            if(time <= 10) timerEl.classList.replace('bg-danger', 'bg-danger');
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
                if (time <= 0) nextQuestion();
            }, 1000);
        }

        function updateProgress() {
            progressBar.style.width = `${(index / questions.length) * 100}%`;
        }

        function submitQuiz() {
            clearInterval(interval);
            container.innerHTML = `<div class="text-center py-5"><i class="fas fa-circle-notch fa-spin fa-2x text-primary mb-3"></i><p>Submitting...</p></div>`;
            if (answersInput) answersInput.value = JSON.stringify(answers);
            if (form) form.submit();
        }

        loadQuestion();
        startTimer();
    }
</script>

