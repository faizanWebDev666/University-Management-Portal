<x-faculityheader />

@if ($errors->any())
    <div class="alert alert-danger mx-auto my-4 w-75 rounded shadow-sm">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<style>
   

    .form-label {
        font-weight: 600;
    }

    .btn-success-custom {
        color: white;
        transition: 0.3s;
    }

    .btn-success-custom:hover {
        background-color: black;
    }
</style>

<div class="container my-5">
    <div class="card shadow-lg border-0">
        {{-- Header --}}
        <div class="card-header bg-dark text-white fw-bold fs-5">
             Upload Quiz
        </div>
{{-- Necessary Notes --}}
<div class="alert alert-info border border-primary shadow-sm mb-4">
    <h5 class="fw-bold text-primary">Important Notes Before Uploading</h5>
    <ul class="mb-0">
        <li>Please ensure the correct <strong>Class & Course</strong> is selected.</li>
        <li>For <strong>File Upload</strong>, only PDF, DOC, and DOCX formats are allowed (max size 10MB).</li>
        <li>If selecting <strong>MCQs</strong>, add at least one question with options and specify the correct answer.</li>
        <li>In <strong>Written Questions</strong>, clearly number each question and mention if diagrams or calculations are needed.</li>
        <li>Set the <strong>Deadline</strong> carefully. Students will not be able to access or submit the quiz after the deadline.</li>
        <li>Once uploaded, quizzes cannot be edited — please double-check before submission.</li>
    </ul>
</div>

        <div class="card-body">
            <form action="{{ route('quizzes.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- Class & Course --}}
                <div class="mb-3">
                    <label for="course_class" class="form-label">Class & Course</label>
                    <select class="form-select border-success" name="course_class" id="course_class" required>
                        <option value="">-- Select Class & Course --</option>
                        @foreach ($offerCourses as $course)
                            @if ($course->class)
                                <option value="{{ $course->course_id }}|{{ $course->class_id }}">
                                    {{ strtoupper(substr($course->class->semester, 0, 2)) }}{{ substr($course->class->year, -2) }}-
                                    {{ strtoupper(substr($course->class->degree_program, 0, 1)) }}{{ strtoupper(substr($course->class->department, 0, 2)) }}-{{ $course->class->section }} |
                                    {{ $course->course->course_code }} ({{ $course->course->course_name }})
                                </option>
                            @endif
                        @endforeach
                    </select>
                </div>

                {{-- Quiz Title --}}
                <div class="mb-3">
                    <label for="quiz_title" class="form-label">Quiz Title</label>
                    <input type="text" name="quiz_title" id="quiz_title" class="form-control border-success" placeholder="Enter quiz title" required>
                </div>

                {{-- Quiz Type --}}
                <div class="mb-3">
                    <label for="quiz_type" class="form-label">Quiz Type</label>
                    <select name="quiz_type" id="quiz_type" class="form-select border-success" onchange="toggleQuizFields()" required>
                        <option value="">-- Select Type --</option>
                        <option value="file">File Upload</option>
                        <option value="mcq">MCQs</option>
                        <option value="written">Written Questions</option>
                    </select>
                </div>

                {{-- File Upload --}}
                <div id="file_upload_section" class="mb-3" style="display:none;">
                    <label for="quiz_file" class="form-label">Upload File</label>
                    <input type="file" name="quiz_file" id="quiz_file" class="form-control border-success" accept=".pdf,.doc,.docx">
                </div>

                {{-- MCQ Section --}}
                <div id="mcq_section" style="display:none;">
                    <div id="mcq_container"></div>
                    <button type="button" class="btn btn-success-custom my-3" onclick="addMCQ()">+ Add Question</button>
                    <input type="hidden" name="quiz_data" id="quiz_data">
                </div>

                {{-- Written Questions --}}
                <div id="written_section" class="mb-3" style="display:none;">
                    <label for="written_questions" class="form-label">Written Questions</label>
                    <textarea name="written_questions" id="written_questions" class="form-control border-success" rows="5" placeholder="Write the questions here..."></textarea>
                </div>

                {{-- Deadline Date --}}
                <div class="mb-3">
                    <label for="deadline" class="form-label">Deadline Date</label>
                    <input type="date" name="deadline" id="deadline" class="form-control border-success" min="{{ now()->toDateString() }}" required>
                </div>

                {{-- Deadline Time --}}
                <div class="mb-4">
                    <label for="deadline_time" class="form-label">Deadline Time</label>
                    <input type="time" name="deadline_time" id="deadline_time" class="form-control border-success" required>
                </div>

                {{-- Submit --}}
                <div class="text-end">
                    <button type="submit" class="btn btn-success px-4"> Upload Quiz</button>
                </div>
            </form>
        </div>
    </div>
</div>

                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        let questionIndex = 0;

                        // Show/Hide sections based on quiz type selection
                        function toggleQuizFields() {
                            const type = document.getElementById('quiz_type').value;
                            document.getElementById('file_upload_section').style.display = (type === 'file') ? 'block' : 'none';
                            document.getElementById('mcq_section').style.display = (type === 'mcq') ? 'block' : 'none';
                            document.getElementById('written_section').style.display = (type === 'written') ? 'block' : 'none';
                        }

                        // Make it accessible globally
                        window.toggleQuizFields = toggleQuizFields;

                        // Add MCQ question block
                        function addMCQ() {
                            const container = document.getElementById('mcq_container');
                            const qId = `question_${questionIndex}`;
                            const html = `
            <div class="card mb-4 p-3 shadow-sm" id="${qId}">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="fw-bold mb-3">Question ${questionIndex + 1}</h5>
                    <button type="button" class="btn btn-sm btn-outline-danger" onclick="removeMCQ('${qId}')">Remove</button>
                </div>
                <div class="mb-3">
                    <input type="text" class="form-control" placeholder="Enter question text" name="questions[${questionIndex}][question]" required>
                </div>
                <div class="mb-3">
                    <div class="row g-2">
                        ${['A', 'B', 'C', 'D'].map((label) => `
                                                                            <div class="col-md-6">
                                                                                <div class="input-group">
                                                                                    <div class="input-group-text">
                                                                                        <input class="form-check-input mt-0" type="radio" name="questions[${questionIndex}][answer]" value="${label}" required>
                                                                                    </div>
                                                                                    <input type="text" class="form-control" name="questions[${questionIndex}][options][]" placeholder="Option ${label}" required>
                                                                                </div>
                                                                            </div>
                                                                        `).join('')}
                    </div>
                </div>
            </div>`;
                            container.insertAdjacentHTML('beforeend', html);
                            questionIndex++;
                        }

                        window.addMCQ = addMCQ;

                        function removeMCQ(id) {
                            const element = document.getElementById(id);
                            if (element) {
                                element.remove();
                            }
                        }

                        window.removeMCQ = removeMCQ;
                        const form = document.querySelector('form');
                        form.addEventListener('submit', function(e) {
                            const quizType = document.getElementById('quiz_type').value;

                            if (quizType === 'mcq') {
                                const questions = [];
                                const cards = document.querySelectorAll('#mcq_container .card');

                                cards.forEach((card, index) => {
                                    const questionText = card.querySelector(
                                        `input[name^="questions[${index}][question]"]`)?.value;
                                    const options = Array.from(card.querySelectorAll(
                                        `input[name^="questions[${index}][options][]"]`)).map(el => el
                                        .value);
                                    const selectedAnswer = card.querySelector(
                                        `input[name^="questions[${index}][answer]"]:checked`)?.value;

                                    if (questionText && options.length === 4 && selectedAnswer) {
                                        questions.push({
                                            question: questionText,
                                            options: options,
                                            answer: selectedAnswer
                                        });
                                    }
                                });

                                if (questions.length === 0) {
                                    alert('Please add at least one MCQ.');
                                    e.preventDefault();
                                    return;
                                }

                                document.getElementById('quiz_data').value = JSON.stringify(questions);
                            }
                        });
                    });
                </script>


               
           

<x-faculityfooter />
