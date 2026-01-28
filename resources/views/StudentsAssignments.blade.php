<x-header />

<div class="container my-5">
    <div class="card shadow-sm rounded-3">
        <div class="text-center mb-5">
            <h2 class="text-white py-3" style="background-color: #009A9A; font-size: 30px;">Assignments</h2>
        </div>
        <div class="card-body">
            @if ($assignments->isEmpty())
                <div class="alert alert-warning mb-0">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i> No assignments available.
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-bordered align-middle text-center">
                        <thead style="background-color: #111; color: white;">
                            <tr>
                                <th>Title</th>
                                <th>Subject</th>
                                <th>Course Code</th>
                                <th>Deadline</th>
                                <th>File</th>
                                <th>Submit</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($assignments as $assignment)
                                @php
                                    $submitted = isset($submissions[$assignment->id]);
                                @endphp
                                <tr>
                                    <td class="fw-semibold">{{ $assignment->assignment_title }}</td>
                                    <td>{{ $assignment->course->course_name ?? 'N/A' }}</td>
                                    <td>{{ $assignment->course->course_code ?? 'N/A' }}</td>
                                    <td>{{ \Carbon\Carbon::parse($assignment->deadline)->format('d M, Y') }}</td>
                                    <td>
                                        <a href="{{ asset('storage/' . $assignment->assignment_file) }}"
                                            class="btn btn-outline-dark btn-sm" download>
                                            <i class="bi bi-download me-1"></i> Download
                                        </a>
                                    </td>
                                    <td>
                                        <div id="upload-section-{{ $assignment->id }}">
                                            @if ($submitted)
                                                <button class="btn btn-secondary btn-sm" disabled>
                                                    <i class="bi bi-check2-circle me-1"></i> Submitted
                                                </button>
                                            @else
                                                <form
                                                    class="upload-form d-flex align-items-center justify-content-center gap-2"
                                                    data-assignment-id="{{ $assignment->id }}"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    <input type="file" name="submission_file"
                                                        accept=".pdf,.doc,.docx" class="form-control form-control-sm"
                                                        style="width: 180px;" required>
                                                    <button type="submit" class="btn btn-success btn-sm">
                                                        <i class="bi bi-upload me-1"></i> Upload
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).on('submit', '.upload-form', function(e) {
        e.preventDefault();
        let form = $(this);
        let assignmentId = form.data('assignment-id');
        let formData = new FormData(this);
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
                    <button class="btn btn-secondary btn-sm" disabled>
                        <i class="bi bi-check2-circle me-1"></i> Submitted
                    </button>
                `);
            },
            error: function(xhr) {
                let msg = xhr.responseJSON?.message || 'Upload failed.';
                alert(msg);
            }
        });
    });
</script>
