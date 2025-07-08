<x-faculityheader/>

@if ($errors->any())
    <div class="alert alert-danger mx-auto my-4 w-75 rounded shadow-sm">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="container my-5">
    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-header bg-dark text-white fw-bold fs-5 px-4 py-3">
            📄 Upload Assignment
        </div>

        <div class="card-body px-4 py-4">
            {{-- Important Notes --}}
            <div class="alert alert-info border border-primary shadow-sm mb-4">
                <h5 class="fw-bold text-primary">📝 Important Notes for Uploading Assignments</h5>
                <ul class="mb-0">
                    <li>Select the correct <strong>Class & Course</strong> before uploading.</li>
                    <li>Assignment titles should be clear and descriptive.</li>
                    <li>Only <strong>.pdf, .doc, .docx</strong> files are allowed.</li>
                    <li>Make sure the <strong>Deadline</strong> is not in the past.</li>
                    <li>Once uploaded, assignments can only be changed from the faculty dashboard.</li>
                </ul>
            </div>

            <form action="{{ route('assignments.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label for="course_class" class="form-label fw-semibold">Class & Course</label>
                    <select class="form-select rounded-3" name="course_class" id="course_class" required>
                        <option value="">Select Class & Course</option>
                        @foreach ($offerCourses as $course)
                            @if($course->class)
                                <option value="{{ $course->course_id }}|{{ $course->class_id }}">
                                    {{ strtoupper(substr($course->class->semester, 0, 2)) }}{{ substr($course->class->year, -2) }} -
                                    {{ strtoupper(substr($course->class->degree_program, 0, 1)) }}{{ strtoupper(substr($course->class->department, 0, 2)) }}-{{ $course->class->section }} |
                                    {{ $course->course->course_code }} ({{ $course->course->course_name }})
                                </option>
                            @endif
                        @endforeach
                    </select>
                </div>

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
                    <button type="submit" class="btn btn-success px-4 rounded-pill shadow-sm">Upload</button>
                </div>
            </form>
        </div>
    </div>
</div>

<x-faculityfooter/>
