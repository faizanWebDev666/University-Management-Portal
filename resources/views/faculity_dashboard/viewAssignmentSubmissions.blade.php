<x-faculityheader />

<div class="course-details-wrapper" style="background-color: #F4F8F5; min-height: 100vh; padding: 40px 0;">
    <div class="container-xxl">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="text-dark fw-bold mb-0">Assignment Submissions: {{ $assignment->assignment_title }}</h1>
            <a href="{{ route('faculty.course.details', $assignment->course->uuid) }}#assignments-pane" class="btn btn-outline-secondary rounded-3 px-4 py-2">
                <i class="fas fa-arrow-left me-2"></i> Back to Course
            </a>
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

                <h5 class="fw-bold text-dark mb-3">Student Submissions</h5>
                @if ($assignment->submissions->count() > 0)
                    <form action="{{ route('assignments.storeMarks', $assignment->id) }}" method="POST">
                        @csrf
                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead style="background-color: #f8f9fa;">
                                    <tr>
                                        <th scope="col" class="fw-bold text-dark">Student Name</th>
                                        <th scope="col" class="fw-bold text-dark">Roll No.</th>
                                        <th scope="col" class="fw-bold text-dark">Submission File</th>
                                        <th scope="col" class="fw-bold text-dark">Submitted At</th>
                                        <th scope="col" class="fw-bold text-dark">Marks</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($assignment->submissions as $submission)
                                        <tr>
                                            <td>{{ $submission->student->name ?? 'N/A' }}</td>
                                            <td>{{ $submission->student->registration->roll_no ?? 'N/A' }}</td>
                                            <td>
                                                <a href="{{ asset('storage/' . $submission->file_path) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                                    <i class="fas fa-download me-1"></i> Download File
                                                </a>
                                            </td>
                                            <td>{{ \Carbon\Carbon::parse($submission->created_at)->format('M d, Y H:i') }}</td>
                                            <td>
                                                <input type="number" name="marks[{{ $submission->id }}]" class="form-control form-control-sm" value="{{ $submission->marks }}" min="0" max="{{ $assignment->total_marks }}" style="width: 80px;">
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
                    <div class="alert alert-info text-center">No submissions for this assignment yet.</div>
                @endif
            </div>
        </div>
    </div>
</div>

<x-faculityfooter />
