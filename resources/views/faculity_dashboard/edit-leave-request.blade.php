<x-faculityheader />

<div class="container my-5">
    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-header bg-primary text-white fw-bold fs-5 px-4 py-3">
            ✏️ Edit Leave Application
        </div>

        <div class="card-body px-4 py-4">
            @if ($errors->any())
                <div class="alert alert-danger mb-3">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('faculty.leave.update', $leave->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="leave_type" class="form-label fw-semibold">Leave Type</label>
                    <input type="text" name="leave_type" id="leave_type" class="form-control rounded-3" value="{{ old('leave_type', $leave->leave_type) }}" required>
                </div>

                <div class="mb-3">
                    <label for="from_date" class="form-label fw-semibold">From Date</label>
                    <input type="date" name="from_date" id="from_date" class="form-control rounded-3" value="{{ old('from_date', $leave->from_date) }}" required>
                </div>

                <div class="mb-3">
                    <label for="to_date" class="form-label fw-semibold">To Date</label>
                    <input type="date" name="to_date" id="to_date" class="form-control rounded-3" value="{{ old('to_date', $leave->to_date) }}" required>
                </div>

                <div class="mb-3">
                    <label for="reason" class="form-label fw-semibold">Reason</label>
                    <textarea name="reason" id="reason" rows="4" class="form-control rounded-3" required>{{ old('reason', $leave->reason) }}</textarea>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-success rounded-pill px-4">Update Leave</button>
                </div>
            </form>
        </div>
    </div>
</div>

<x-faculityfooter />
