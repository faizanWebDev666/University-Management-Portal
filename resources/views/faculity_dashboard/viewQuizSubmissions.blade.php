<x-faculityheader />

<div class="course-details-wrapper" style="background-color: #F4F8F5; min-height: 100vh; padding: 40px 0;">
    <div class="container-xxl">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="text-dark fw-bold mb-0">Quiz Submissions: {{ $quiz->quiz_title }}</h1>
            <a href="{{ route('faculty.course.details', $quiz->course->uuid) }}#quizzes-pane" class="btn btn-outline-secondary rounded-3 px-4 py-2">
                <i class="fas fa-arrow-left me-2"></i> Back to Course
            </a>
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

                <h5 class="fw-bold text-dark mb-3">Student Submissions</h5>
                @if ($quiz->submissions->count() > 0)
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
                                    @foreach ($quiz->submissions as $submission)
                                        <tr>
                                            <td>{{ $submission->studentRegistration->user->name ?? 'N/A' }}</td>
                                            <td>{{ $submission->studentRegistration->roll_no ?? 'N/A' }}</td>
                                            <td>
                                                @if ($quiz->quiz_type === 'file' && $submission->answer_file)
                                                    <a href="{{ asset('storage/' . $submission->answer_file) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                                        <i class="fas fa-download me-1"></i> Download File
                                                    </a>
                                                @elseif ($quiz->quiz_type === 'mcq' && $submission->mcq_answers)
                                                    <button type="button" class="btn btn-sm btn-outline-info" data-bs-toggle="modal" data-bs-target="#mcqAnswersModal{{ $submission->id }}">
                                                        <i class="fas fa-eye me-1"></i> View Answers
                                                    </button>
                                                    <!-- MCQ Answers Modal -->
                                                    <div class="modal fade" id="mcqAnswersModal{{ $submission->id }}" tabindex="-1" aria-labelledby="mcqAnswersModalLabel{{ $submission->id }}" aria-hidden="true">
                                                        <div class="modal-dialog modal-lg">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="mcqAnswersModalLabel{{ $submission->id }}">MCQ Answers for {{ $submission->studentRegistration->user->name ?? 'N/A' }}</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    @php
                                                                        $studentAnswers = json_decode($submission->mcq_answers, true);
                                                                        $quizQuestions = json_decode($quiz->quiz_data, true);
                                                                    @endphp
                                                                    @if ($quizQuestions)
                                                                        @foreach ($quizQuestions as $qIndex => $question)
                                                                            <div class="mb-3">
                                                                                <p class="fw-bold">Q{{ $qIndex + 1 }}: {{ $question['question'] }}</p>
                                                                                <p>Your Answer: {{ $studentAnswers[$qIndex] ?? 'N/A' }}</p>
                                                                                <p>Correct Answer: {{ $question['correct_option'] ?? 'N/A' }}</p>
                                                                            </div>
                                                                        @endforeach
                                                                    @else
                                                                        <p>No quiz questions found.</p>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @elseif ($quiz->quiz_type === 'written' && $submission->written_answer)
                                                    <button type="button" class="btn btn-sm btn-outline-info" data-bs-toggle="modal" data-bs-target="#writtenAnswerModal{{ $submission->id }}">
                                                        <i class="fas fa-eye me-1"></i> View Answer
                                                    </button>
                                                    <!-- Written Answer Modal -->
                                                    <div class="modal fade" id="writtenAnswerModal{{ $submission->id }}" tabindex="-1" aria-labelledby="writtenAnswerModalLabel{{ $submission->id }}" aria-hidden="true">
                                                        <div class="modal-dialog modal-lg">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="writtenAnswerModalLabel{{ $submission->id }}">Written Answer for {{ $submission->studentRegistration->user->name ?? 'N/A' }}</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <p class="fw-bold">Questions:</p>
                                                                    <pre class="bg-light p-3 rounded border mb-3">{{ $quiz->written_questions }}</pre>
                                                                    <p class="fw-bold">Student's Answer:</p>
                                                                    <pre class="bg-light p-3 rounded border">{{ $submission->written_answer }}</pre>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @else
                                                    N/A
                                                @endif
                                            </td>
                                            <td>{{ \Carbon\Carbon::parse($submission->submitted_at)->format('M d, Y H:i') }}</td>
                                            <td>
                                                <input type="number" name="marks[{{ $submission->id }}]" class="form-control form-control-sm" value="{{ $submission->marks }}" min="0" style="width: 80px;">
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="text-end mt-4">
                            <button type="submit" class="btn btn-primary px-4 rounded-pill">
                                <i class="fas fa-save me-2"></i> Save Marks
                            </button>
                        </div>
                    </form>
                @else
                    <div class="alert alert-info text-center">No submissions for this quiz yet.</div>
                @endif
            </div>
        </div>
    </div>
</div>

<x-faculityfooter />
