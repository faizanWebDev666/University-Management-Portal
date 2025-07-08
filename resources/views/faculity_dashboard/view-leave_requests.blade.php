<x-faculityheader />

<div class="container my-5">
    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-header bg-dark text-white fw-bold fs-5 px-4 py-3">
            🗂️ My Leave Applications
        </div>

        <div class="card-body px-4 py-4">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if($leaveRequests->isEmpty())
                <div class="alert alert-warning">No leave applications found.</div>
            @else
                <table class="table table-bordered table-striped align-middle">
                    <thead class="table-dark">
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
                                    <span class="badge 
                                        @if($leave->status == 'Pending') bg-warning
                                        @elseif($leave->status == 'Approved') bg-success
                                        @else bg-danger @endif">
                                        {{ $leave->status }}
                                    </span>
                                </td>
                               <td class="text-center">
    @if($leave->status === 'Rejected')
        {{-- Rejection Reason --}}
        <div class="alert alert-danger text-start p-2 mb-2" style="white-space: pre-wrap; word-wrap: break-word; font-size: 0.875rem;">
            <strong>Rejection Reason:</strong><br>
            {{ $leave->rejection_reason ?? 'No reason provided.' }}
        </div>

        {{-- Disabled Edit Button --}}
        <button class="btn btn-sm btn-secondary" disabled>Edit</button>
    @else
        {{-- Edit Button --}}
        <a href="{{ route('faculty.leave.edit', $leave->id) }}" class="btn btn-sm btn-primary">Edit</a>
    @endif

    {{-- Delete Button (always enabled) --}}
    <form action="{{ route('faculty.leave.destroy', $leave->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure to delete this leave request?')">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
    </form>
</td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</div>

<x-faculityfooter />
