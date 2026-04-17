@if(!request()->ajax())
<x-faculityheader />

<div class="course-details-wrapper" style="background-color: #F4F8F5; min-height: 100vh; padding: 40px 0;">
    <div class="container-xxl">
@endif
        <div class="d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom">
            <h4 class="text-dark fw-bold mb-0">
                <i class="fas fa-question-circle me-2" style="color: #3f634d;"></i>
                Quiz Submissions: {{ $quiz->quiz_title }}
            </h4>
            @if(!request()->ajax())
            <a href="{{ route('faculty.course.details', $quiz->course->uuid) }}#quizzes-pane" class="btn btn-outline-secondary rounded-3 px-4 py-2">
                <i class="fas fa-arrow-left me-2"></i> Back to Course
            </a>
            @endif
        </div>

        <div class="card shadow-sm border-0 rounded-3 mb-5">
            <div class="card-body p-4">
                <h5 class="fw-bold text-dark mb-3">Quiz Details</h5>
                <div class="row mb-4">
                    <div class="col-md-4">
                        <p class="text-muted mb-1"><strong>Course:</strong> {{ $quiz->course->course_name }}</p>
                    </div>
                    <div class="col-md-4">
                        <p class="text-muted mb-1"><strong>Type:</strong> {{ ucfirst($quiz->quiz_type) }}</p>
                    </div>
                    <div class="col-md-4">
                        <p class="text-muted mb-1"><strong>Deadline:</strong> {{ \Carbon\Carbon::parse($quiz->deadline)->format('M d, Y') }} at {{ \Carbon\Carbon::parse($quiz->deadline_time)->format('h:i A') }}</p>
                    </div>
                </div>

                <h5 class="fw-bold text-dark mb-3">Class Gradebook</h5>
                <div class="alert alert-info">
                    Grade all students in one table. You can assign marks even when a student has not submitted.
                </div>
                @php
                    $totalStudents = $students->count();
                    $submittedStudents = 0;
                    $submittedList = collect();
                    $notSubmittedList = collect();

                    foreach ($students as $student) {
                        $studentUserId = $student->user_id;
                        $submission = $studentUserId ? ($submissions[$studentUserId] ?? null) : null;
                        $hasRealSubmission = $submission && (
                            ($quiz->quiz_type === 'file' && !empty($submission->answer_file)) ||
                            ($quiz->quiz_type === 'mcq' && !empty($submission->mcq_answers)) ||
                            ($quiz->quiz_type === 'written' && !empty($submission->written_answer))
                        );

                        if ($hasRealSubmission) {
                            $submittedStudents++;
                            $submittedList->push($student);
                        } else {
                            $notSubmittedList->push($student);
                        }
                    }
                @endphp
                <div class="row g-3 mb-4">
                    <div class="col-md-4">
                        <div class="border rounded-3 p-3 bg-light h-100">
                            <p class="small text-muted mb-1 fw-bold text-uppercase">Total Students</p>
                            <h4 class="mb-0">{{ $totalStudents }}</h4>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="border rounded-3 p-3 bg-light h-100">
                            <p class="small text-muted mb-1 fw-bold text-uppercase">Submitted</p>
                            <h4 class="mb-2 text-success">{{ $submittedStudents }}</h4>
                            <button type="button" class="btn btn-sm btn-outline-success" data-bs-toggle="modal" data-bs-target="#quizSubmittedStudentsModal">
                                View Students
                            </button>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="border rounded-3 p-3 bg-light h-100">
                            <p class="small text-muted mb-1 fw-bold text-uppercase">Not Submitted</p>
                            <h4 class="mb-2 text-danger">{{ $totalStudents - $submittedStudents }}</h4>
                            <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#quizNotSubmittedStudentsModal">
                                View Students
                            </button>
                        </div>
                    </div>
                </div>
                <form action="{{ route('quizzes.storeMarks', $quiz->id) }}" method="POST">
                    @csrf
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead style="background-color: #f8f9fa;">
                                <tr>
                                    <th scope="col" class="fw-bold text-dark">Student Name</th>
                                    <th scope="col" class="fw-bold text-dark">Roll No.</th>
                                    <th scope="col" class="fw-bold text-dark">Submission</th>
                                    <th scope="col" class="fw-bold text-dark">Submitted At</th>
                                    <th scope="col" class="fw-bold text-dark">Marks</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($students as $student)
                                    @php
                                        $studentUserId = $student->user_id;
                                        $submission = $studentUserId ? ($submissions[$studentUserId] ?? null) : null;
                                    @endphp
                                    <tr>
                                        <td>{{ $student->user->name ?? $student->full_name ?? 'N/A' }}</td>
                                        <td>{{ $student->roll_no ?? 'N/A' }}</td>
                                        <td>
                                            @if ($submission)
                                                @if ($quiz->quiz_type === 'file' && $submission->answer_file)
                                                    <a href="{{ asset('storage/' . $submission->answer_file) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                                        <i class="fas fa-download me-1"></i> Download File
                                                    </a>
                                                @elseif ($quiz->quiz_type === 'mcq' && $submission->mcq_answers)
                                                    <button type="button" class="btn btn-sm btn-outline-info" data-bs-toggle="modal" data-bs-target="#mcqAnswersModal{{ $submission->id }}">
                                                        <i class="fas fa-eye me-1"></i> View Answers
                                                    </button>
                                                @elseif ($quiz->quiz_type === 'written' && $submission->written_answer)
                                                    <button type="button" class="btn btn-sm btn-outline-info" data-bs-toggle="modal" data-bs-target="#writtenAnswerModal{{ $submission->id }}">
                                                        <i class="fas fa-eye me-1"></i> View Answer
                                                    </button>
                                                @else
                                                    <span class="badge bg-secondary-subtle text-secondary border">No Submission</span>
                                                @endif
                                            @else
                                                <span class="badge bg-secondary-subtle text-secondary border">No Submission</span>
                                            @endif
                                        </td>
                                        <td>
                                            {{ $submission?->submitted_at ? \Carbon\Carbon::parse($submission->submitted_at)->format('M d, Y H:i') : '-' }}
                                        </td>
                                        <td style="width: 120px;">
                                            @if ($studentUserId)
                                                <input type="number" name="student_marks[{{ $studentUserId }}]" class="form-control form-control-sm" value="{{ $submission?->marks }}" min="0" step="0.01">
                                            @else
                                                <span class="text-muted small">User not linked</span>
                                            @endif
                                        </td>
                                    </tr>

                                    @if ($submission && $quiz->quiz_type === 'mcq' && $submission->mcq_answers)
                                        <div class="modal fade" id="mcqAnswersModal{{ $submission->id }}" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">MCQ Answers</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        @php
                                                            $studentAnswers = is_array($submission->mcq_answers) ? $submission->mcq_answers : json_decode($submission->mcq_answers, true);
                                                            $quizQuestions = json_decode($quiz->quiz_data, true);
                                                        @endphp
                                                        @if ($quizQuestions)
                                                            @foreach ($quizQuestions as $qIndex => $question)
                                                                <div class="mb-3">
                                                                    <p class="fw-bold mb-1">Q{{ $qIndex + 1 }}: {{ $question['question'] }}</p>
                                                                    <p class="mb-1">Student Answer: {{ $studentAnswers[$qIndex] ?? 'N/A' }}</p>
                                                                    <p class="mb-0">Correct Answer: {{ $question['correct_option'] ?? 'N/A' }}</p>
                                                                </div>
                                                            @endforeach
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                    @if ($submission && $quiz->quiz_type === 'written' && $submission->written_answer)
                                        <div class="modal fade" id="writtenAnswerModal{{ $submission->id }}" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Written Answer</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p class="fw-bold mb-1">Questions:</p>
                                                        <pre class="bg-light p-3 rounded border mb-3">{{ $quiz->written_questions }}</pre>
                                                        <p class="fw-bold mb-1">Student's Answer:</p>
                                                        <pre class="bg-light p-3 rounded border">{{ $submission->written_answer }}</pre>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">No students found in this class.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="text-end mt-4">
                        <button type="submit" class="btn btn-primary px-4 rounded-pill">
                            <i class="fas fa-save me-2"></i> Save All Marks
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="quizSubmittedStudentsModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Students Who Submitted</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @if ($submittedList->count())
                    <ul class="list-group">
                        @foreach ($submittedList as $student)
                            <li class="list-group-item d-flex justify-content-between">
                                <span>{{ $student->user->name ?? $student->full_name ?? 'N/A' }}</span>
                                <span class="text-muted">{{ $student->roll_no ?? 'N/A' }}</span>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-muted mb-0">No students have submitted yet.</p>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="quizNotSubmittedStudentsModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Students Who Did Not Submit</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @if ($notSubmittedList->count())
                    <ul class="list-group">
                        @foreach ($notSubmittedList as $student)
                            <li class="list-group-item d-flex justify-content-between">
                                <span>{{ $student->user->name ?? $student->full_name ?? 'N/A' }}</span>
                                <span class="text-muted">{{ $student->roll_no ?? 'N/A' }}</span>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-muted mb-0">All students submitted.</p>
                @endif
            </div>
        </div>
@if(!request()->ajax())
    </div>
</div>

<x-faculityfooter />
@endif
