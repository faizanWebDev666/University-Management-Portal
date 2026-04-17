@if(!request()->ajax())
<x-faculityheader />

<div class="course-details-wrapper" style="background-color: #F4F8F5; min-height: 100vh; padding: 40px 0;">
    <div class="container-xxl">
@endif
        <div class="d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom">
            <h4 class="text-dark fw-bold mb-0">
                <i class="fas fa-file-alt me-2" style="color: #3f634d;"></i>
                Assignment Submissions: {{ $assignment->assignment_title }}
            </h4>
            @if(!request()->ajax())
            <a href="{{ route('faculty.course.details', $assignment->course->uuid) }}#assignments-pane" class="btn btn-outline-secondary rounded-3 px-4 py-2">
                <i class="fas fa-arrow-left me-2"></i> Back to Course
            </a>
            @endif
        </div>

        <div class="card shadow-sm border-0 rounded-3 mb-5">
            <div class="card-body p-4">
                <h5 class="fw-bold text-dark mb-3">Assignment Details</h5>
                <div class="row mb-4">
                    <div class="col-md-4">
                        <p class="text-muted mb-1"><strong>Course:</strong> {{ $assignment->course->course_name }}</p>
                    </div>
                    <div class="col-md-4">
                        <p class="text-muted mb-1"><strong>Total Marks:</strong> {{ $assignment->total_marks }}</p>
                    </div>
                    <div class="col-md-4">
                        <p class="text-muted mb-1"><strong>Deadline:</strong> {{ \Carbon\Carbon::parse($assignment->deadline)->format('M d, Y') }}</p>
                    </div>
                </div>

                <h5 class="fw-bold text-dark mb-3">Class Gradebook</h5>
                <div class="alert alert-info">
                    Assign marks for all students in one screen. You can grade even if a student did not upload a file.
                </div>
                @php
                    $totalStudents = $students->count();
                    $submittedStudents = 0;
                    $submittedList = collect();
                    $notSubmittedList = collect();

                    foreach ($students as $student) {
                        $studentUserId = $student->user_id;
                        $submission = $studentUserId ? ($submissions[$studentUserId] ?? null) : null;
                        $hasRealSubmission = $submission && $submission->file_path && $submission->file_path !== 'NO_SUBMISSION';

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
                            <button type="button" class="btn btn-sm btn-outline-success" data-bs-toggle="modal" data-bs-target="#submittedStudentsModal">
                                View Students
                            </button>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="border rounded-3 p-3 bg-light h-100">
                            <p class="small text-muted mb-1 fw-bold text-uppercase">Not Submitted</p>
                            <h4 class="mb-2 text-danger">{{ $totalStudents - $submittedStudents }}</h4>
                            <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#notSubmittedStudentsModal">
                                View Students
                            </button>
                        </div>
                    </div>
                </div>
                <form action="{{ route('assignments.storeMarks', $assignment->id) }}" method="POST">
                    @csrf
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead style="background-color: #f8f9fa;">
                                <tr>
                                    <th scope="col" class="fw-bold text-dark">Student Name</th>
                                    <th scope="col" class="fw-bold text-dark">Roll No.</th>
                                    <th scope="col" class="fw-bold text-dark">Submission</th>
                                    <th scope="col" class="fw-bold text-dark">Submitted At</th>
                                    <th scope="col" class="fw-bold text-dark">Marks / {{ $assignment->total_marks }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($students as $student)
                                    @php
                                        $studentUserId = $student->user_id;
                                        $submission = $studentUserId ? ($submissions[$studentUserId] ?? null) : null;
                                        $hasRealSubmission = $submission && $submission->file_path && $submission->file_path !== 'NO_SUBMISSION';
                                    @endphp
                                    <tr>
                                        <td>{{ $student->user->name ?? $student->full_name ?? 'N/A' }}</td>
                                        <td>{{ $student->roll_no ?? 'N/A' }}</td>
                                        <td>
                                            @if ($hasRealSubmission)
                                                <a href="{{ asset('storage/' . $submission->file_path) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                                    <i class="fas fa-download me-1"></i> Download File
                                                </a>
                                            @else
                                                <span class="badge bg-secondary-subtle text-secondary border">No Submission</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($submission?->submitted_at)
                                                {{ \Carbon\Carbon::parse($submission->submitted_at)->format('M d, Y H:i') }}
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td style="width: 140px;">
                                            @if ($studentUserId)
                                                <input
                                                    type="number"
                                                    name="student_marks[{{ $studentUserId }}]"
                                                    class="form-control form-control-sm"
                                                    value="{{ $submission?->marks }}"
                                                    min="0"
                                                    max="{{ $assignment->total_marks }}"
                                                    step="0.01"
                                                >
                                            @else
                                                <span class="text-muted small">User not linked</span>
                                            @endif
                                        </td>
                                    </tr>
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

<div class="modal fade" id="submittedStudentsModal" tabindex="-1" aria-hidden="true">
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

<div class="modal fade" id="notSubmittedStudentsModal" tabindex="-1" aria-hidden="true">
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
