<x-hostel-heaser />

<div class="container my-5">

    <div class="card shadow-sm border-0 rounded-3">
        <!-- Header -->
        <div class="card-header bg-white border-bottom d-flex justify-content-between align-items-center px-4 py-3">
            <h5 class="mb-0 fw-semibold text-dark">
                Hostel Accommodation Requests
            </h5>
        </div>

        <div class="card-body px-4 py-4">

            {{-- Success Message --}}
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            {{-- No Data --}}
            @if($hostelRequests->isEmpty())
                <div class="text-center py-5">
                    <p class="text-muted mb-0">No hostel accommodation requests found.</p>
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-hover table-striped align-middle text-center">
                        <thead class="table-light text-uppercase small">
                            <tr>
                                <th>#</th>
                                <th>Student</th>
                                <th>Hostel</th>
                                <th>Room Type</th>
                                <th>Duration</th>
                                <th>Semester</th>
                                <th>Emergency Contact</th>
                                <th>Medical</th>
                                <th>Address</th>
                                <th>Reason</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($hostelRequests as $index => $request)
                                <tr>
                                    <td class="fw-semibold">{{ $index + 1 }}</td>

                                    <td>
                                        <div class="fw-semibold">
                                            {{ $request->student->name ?? 'N/A' }}
                                        </div>
                                    </td>

                                    <td>{{ $request->hostel_type }}</td>
                                    <td>{{ $request->room_type }}</td>

                                    <td>
                                        {{ $request->duration }}
                                        {{ Str::plural('Semester', $request->duration) }}
                                    </td>

                                    <td>{{ $request->semester }}</td>

                                    <td>
                                        <div class="fw-semibold">{{ $request->emergency_name }}</div>
                                        <small class="text-muted">{{ $request->emergency_number }}</small>
                                    </td>

                                    <td>
                                        <span class="text-muted">
                                            {{ $request->medical_info ?? '—' }}
                                        </span>
                                    </td>

                                    <td class="text-start">
                                        {{ $request->address }}
                                    </td>

                                    <td class="text-start">
                                        {{ $request->reason }}
                                    </td>

                                    <td>
                                        @if($request->status === 'pending')
                                            <span class="badge bg-warning-subtle text-warning fw-semibold">
                                                Pending
                                            </span>
                                        @elseif($request->status === 'approved')
                                            <span class="badge bg-success-subtle text-success fw-semibold">
                                                Approved
                                            </span>
                                        @else
                                            <span class="badge bg-danger-subtle text-danger fw-semibold">
                                                Rejected
                                            </span>
                                        @endif
                                    </td>

                                    <td>
                                        @if($request->status === 'pending')
                                            <form action="" method="POST" class="d-flex gap-2 justify-content-center">
                                                @csrf
                                                @method('PATCH')

                                                <button type="submit" name="status" value="approved"
                                                    class="btn btn-sm btn-outline-success">
                                                    Approve
                                                </button>

                                                <button type="submit" name="status" value="rejected"
                                                    class="btn btn-sm btn-outline-danger">
                                                    Reject
                                                </button>
                                            </form>
                                        @else
                                            <span class="text-muted small">No action</span>
                                        @endif
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

<x-hostel-footer />

<style>
    .table th {
        white-space: nowrap;
        font-size: 13px;
    }

    .table td {
        font-size: 14px;
        vertical-align: middle;
    }

    .badge {
        padding: 0.45em 0.7em;
        font-size: 0.75rem;
        border-radius: 12px;
    }

    @media (max-width: 768px) {
        .table th,
        .table td {
            font-size: 12px;
        }
    }
</style>
