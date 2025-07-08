<x-header />

<div class="container my-5">
    <div class="text-center mb-5">
<h2 class="text-white py-3" style="background-color: #009A9A; font-size: 30px;">Available Quizzes</h2>
        </div>

    @forelse ($quizzes as $quiz)
        @php
            $badgeClass = match($quiz->quiz_type) {
                'mcq' => 'bg-primary',
                'written' => 'bg-warning text-dark',
                'file' => 'bg-success',
                default => 'bg-secondary'
            };
        @endphp

        <div class="card mb-4 border-dark shadow-sm" style="background-color: #f8f9fa; border-radius: 12px;">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h5 class="mb-0 fw-semibold text-dark">{{ $quiz->quiz_title }}</h5>
                    <span class="badge {{ $badgeClass }}">{{ strtoupper($quiz->quiz_type) }}</span>
                </div>

                <div class="mb-2 text-muted">
                    <small>
                        <strong>Deadline:</strong>
                        {{ \Carbon\Carbon::parse($quiz->deadline)->format('d M Y') }} at
                        {{ \Carbon\Carbon::parse($quiz->deadline_time)->format('h:i A') }}
                    </small>
                </div>

                {{-- File-Based Quiz --}}
                @if($quiz->quiz_type === 'file' && $quiz->quiz_file)
                    @if($quiz->is_deadline_over)
                        <p class="text-danger fw-semibold">🚫 This quiz is closed. Deadline has passed.</p>
                    @else
                        <div class="mb-3">
                            <a href="{{ asset('storage/' . $quiz->quiz_file) }}"
                               class="btn btn-outline-dark btn-sm" target="_blank">
                                <i class="bi bi-download"></i> Download Quiz File
                            </a>
                        </div>

                        @if(!$quiz->already_submitted)
                            <form action="{{ route('student.uploadAnswer', $quiz->id) }}"
                                  method="POST"
                                  enctype="multipart/form-data"
                                  class="mt-3">
                                @csrf
                                <label class="form-label fw-semibold">Upload Your Answer (PDF only, max 10MB)</label>
                                <input type="file" name="answer_file" class="form-control mb-2"
                                       accept="application/pdf" required>
                                <button class="btn btn-success btn-sm" type="submit">Submit Answer</button>
                            </form>
                        @else
                            <p class="text-success fw-semibold">✅ You have already submitted this quiz.</p>
                        @endif
                    @endif

                {{-- Written Quiz --}}
                @elseif($quiz->quiz_type === 'written')
                    <div class="bg-light p-3 rounded mb-3 border">
                        <h6 class="fw-bold">Questions</h6>
                        <pre class="mb-0 text-dark">{{ $quiz->written_questions }}</pre>
                    </div>

                    @if($quiz->is_deadline_over)
                        <p class="text-danger fw-semibold">🚫 This quiz is closed. Deadline has passed.</p>
                    @elseif(!$quiz->already_submitted)
                        <form action="{{ route('student.uploadAnswer', $quiz->id) }}"
                              method="POST"
                              enctype="multipart/form-data"
                              class="mt-3">
                            @csrf
                            <label class="form-label fw-semibold">Upload Your Answer (PDF only, max 5MB)</label>
                            <input type="file" name="answer_file" class="form-control mb-2"
                                   accept="application/pdf" required>
                            <button class="btn btn-success btn-sm" type="submit">Submit Answer</button>
                        </form>
                    @else
                        <p class="text-success fw-semibold">✅ You have already submitted this quiz.</p>
                    @endif

                {{-- MCQ Quiz --}}
                @elseif($quiz->quiz_type === 'mcq')
                    @php $questions = json_decode($quiz->quiz_data, true); @endphp

                    <div id="mcq-quiz-{{ $quiz->id }}">
                        <h6 class="fw-bold">MCQ Quiz</h6>
                        <p class="text-muted small">
                            🕒 Each question will appear one at a time with a 1-minute time limit.
                        </p>

                        @if($quiz->is_deadline_over)
                            <p class="text-danger fw-semibold">🚫 This quiz is closed. Deadline has passed.</p>
                        @elseif(!$quiz->already_submitted)
                            <form id="mcq-form-{{ $quiz->id }}"
                                  action="{{ route('student.uploadAnswer', $quiz->id) }}"
                                  method="POST">
                                @csrf
                                <div id="question-container-{{ $quiz->id }}"></div>
                                <input type="hidden" name="answers" id="answers-{{ $quiz->id }}">
                            </form>

                            <div class="d-flex justify-content-between align-items-center mt-2">
                                <div class="progress w-75" style="height: 10px;">
                                    <div id="progress-bar-{{ $quiz->id }}"
                                         class="progress-bar bg-dark"
                                         style="width: 0%;">
                                    </div>
                                </div>
                                <span id="timer-{{ $quiz->id }}"
                                      class="text-danger fw-bold ms-3">Time: 60</span>
                            </div>

                            <button class="btn btn-primary btn-sm mt-3"
                                    onclick="startQuiz({{ json_encode($questions) }}, '{{ $quiz->id }}')">
                                ▶️ Start Quiz
                            </button>
                        @else
                            <p class="text-success fw-semibold">✅ You have already submitted this quiz.</p>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    @empty
        <div class="alert alert-info">No quizzes available right now.</div>
    @endforelse
</div>
<style>
    .card {
    transition: transform 0.2s ease-in-out;
    border-radius: 12px;
}
.card:hover {
    transform: scale(1.01);
}
pre {
    background-color: #f1f1f1;
    padding: 10px;
    border-left: 4px solid #343a40;
    border-radius: 4px;
}

</style>

<script>
function startQuiz(questions, quizId) {
    let index = 0;
    let container = document.getElementById(`question-container-${quizId}`);
    let timerEl = document.getElementById(`timer-${quizId}`);
    let progressBar = document.getElementById(`progress-bar-${quizId}`);
    let answersInput = document.getElementById(`answers-${quizId}`);
    let form = document.getElementById(`mcq-form-${quizId}`);
    let answers = [];
    let time = 60;
    let interval;

    // Load and display the current question
    function loadQuestion() {
        if (index >= questions.length) {
            submitQuiz();
            return;
        }

        const q = questions[index];
        let html = `
            <div class="mb-3">
                <strong>Q${index + 1} of ${questions.length}:</strong> ${q.question}
                <div class="mt-2">`;

        q.options.forEach((opt, i) => {
            const optId = `opt-${quizId}-${index}-${i}`;
            html += `
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="option-${quizId}-${index}" id="${optId}" value="${String.fromCharCode(65 + i)}">
                    <label class="form-check-label" for="${optId}">
                        ${String.fromCharCode(65 + i)}. ${opt}
                    </label>
                </div>`;
        });

        html += `
                </div>
                <button type="button" class="btn btn-sm btn-outline-primary mt-3" id="next-btn-${quizId}">Next</button>
            </div>`;

        container.innerHTML = html;

        // Add event listener to the dynamically created button
        document.getElementById(`next-btn-${quizId}`).addEventListener('click', nextQuestion);

        time = 60;
        timerEl.textContent = `Time: ${time}`;
        updateProgress();
    }

    // Handle next question manually or by timer
    function nextQuestion(e) {
        if (e) e.preventDefault();
        clearInterval(interval); // Clear timer

        const selectedOption = document.querySelector(`input[name="option-${quizId}-${index}"]:checked`);
        answers.push(selectedOption ? selectedOption.value : null);

        index++;
        loadQuestion();
        startTimer();
    }

    // Start countdown timer for each question
    function startTimer() {
        interval = setInterval(() => {
            time--;
            timerEl.textContent = `Time: ${time}`;
            if (time <= 0) {
                nextQuestion(new Event('submit')); // Automatically go to next question
            }
        }, 1000);
    }

    // Update progress bar
    function updateProgress() {
        const percent = (index / questions.length) * 100;
        progressBar.style.width = `${percent}%`;
    }

    // When all questions are done
    function submitQuiz() {
        clearInterval(interval);

        // Optional: send data to a server or set it in a hidden input
        if (answersInput) {
            answersInput.value = JSON.stringify(answers);
        }

        if (form) {
            form.submit();
        } else {
            alert("Quiz completed. Answers: " + JSON.stringify(answers));
        }
    }

    // Start quiz
    loadQuestion();
    startTimer();
}
</script>


<x-footer />
