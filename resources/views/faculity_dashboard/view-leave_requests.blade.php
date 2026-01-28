<x-faculityheader />

<div class="container my-5">
    <div class="card shadow-lg border-0 rounded-4" style="background-color: #fff;">
        <!-- Card Header with Theme Color -->
        <div class="card-header text-white fw-bold fs-5 px-4 py-3" style="background-color: #3f634d;">
            🗂️ My Leave Applications
        </div>

        <div class="card-body px-4 py-4" style="background-color: #F4F8F5;">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if($leaveRequests->isEmpty())
                <div class="alert alert-warning text-center">No leave applications found.</div>
            @else
                <div class="table-responsive">
                    <table class="table table-bordered align-middle">
                        <thead style="background-color: #3f634d; color: white;">
                            <tr>
                                <th>#</th>
                                <th>Leave Type</th>
                                <th>From</th>
                                <th>To</th>
                                <th>Reason</th>
                                <th>Status</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($leaveRequests as $index => $leave)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $leave->leave_type }}</td>
                                    <td>{{ $leave->from_date }}</td>
                                    <td>{{ $leave->to_date }}</td>
                                    <td>{{ Str::limit($leave->reason, 50) }}</td>
                                    <td>
                                        <span class="badge rounded-pill px-3 py-2
                                            @if($leave->status == 'Pending') bg-warning text-dark
                                            @elseif($leave->status == 'Approved') bg-success
                                            @else bg-danger @endif">
                                            {{ $leave->status }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        @if($leave->status === 'Rejected')
                                            <!-- Show rejection reason -->
                                            <div class="alert alert-danger text-start p-2 mb-2 small" 
                                                 style="white-space: pre-wrap;">
                                                <strong>Rejection Reason:</strong><br>
                                                {{ $leave->rejection_reason ?? 'No reason provided.' }}
                                            </div>
                                            <!-- Disabled Edit Button -->
                                            <button class="btn btn-sm btn-secondary rounded-pill shadow-sm" disabled>
                                                ✏️ Edit
                                            </button>

                                        @elseif($leave->status === 'Approved')
                                            <span class="text-muted small d-block mb-2">
                                                ✅ Approved – Cannot Edit
                                            </span>

                                        @else
                                            <!-- Edit Button -->
                                            <a href="{{ route('faculty.leave.edit', $leave->id) }}" 
                                               class="btn btn-sm btn-primary rounded-pill px-3 shadow-sm mb-1">
                                                ✏️ Edit
                                            </a>
                                        @endif

                                        <!-- Delete Button -->
                                        @if($leave->status === 'Pending')
                                            <form action="{{ route('faculty.leave.destroy', $leave->id) }}" 
                                                  method="POST" class="d-inline" 
                                                  onsubmit="return confirm('Are you sure you want to delete this leave request?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger rounded-pill px-3 shadow-sm">
                                                    🗑️ Delete
                                                </button>
                                            </form>
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

<x-faculityfooter />

<!-- Custom Theme Styles -->
<style>
    body {
        background-color: #F4F8F5;
        color: #333;
    }
    .btn-primary {
        background-color: #3f634d;
        border-color: #3f634d;
    }
    .btn-primary:hover {
        background-color: #1e3e28;
        border-color: #1e3e28;
    }
    .btn-danger {
        background-color: #c0392b;
        border-color: #c0392b;
    }
    .btn-danger:hover {
        background-color: #a93226;
        border-color: #a93226;
    }
    .badge {
        font-size: 0.85rem;
    }
</style>
