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

@if (session('success'))
    <div class="alert alert-success mx-auto my-4 w-75 rounded shadow-sm">
        {{ session('success') }}
    </div>
@endif

<div class="container my-5">
    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-header bg-dark text-white fw-bold fs-5 px-4 py-3">
            🗓️ Faculty Leave Request
        </div>

        <div class="card-body px-4 py-4">
            <div class="alert alert-info border border-primary shadow-sm mb-4">
                <h5 class="fw-bold text-primary">📌 Leave Request Guidelines</h5>
                <ul class="mb-0">
                    <li>Submit leave requests at least <strong>2 days in advance</strong>.</li>
                    <li>Provide a valid reason for the leave.</li>
                    <li>Specify the leave duration clearly.</li>
                    <li>You’ll receive a notification once the leave is approved or rejected.</li>
                </ul>
            </div>

            <form action="{{ route('faculty.leave.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="leave_type" class="form-label fw-semibold">Leave Type</label>
                    <select class="form-select rounded-3" name="leave_type" id="leave_type" required>
                        <option value="">Select Leave Type</option>
                        <option value="Sick Leave">Sick Leave</option>
                        <option value="Casual Leave">Casual Leave</option>
                        <option value="Emergency Leave">Emergency Leave</option>
                        <option value="Other">Other</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="from_date" class="form-label fw-semibold">From Date</label>
                    <input type="date" name="from_date" id="from_date" class="form-control rounded-3" required min="{{ now()->toDateString() }}">
                </div>

                <div class="mb-3">
                    <label for="to_date" class="form-label fw-semibold">To Date</label>
                    <input type="date" name="to_date" id="to_date" class="form-control rounded-3" required min="{{ now()->toDateString() }}">
                </div>

                <div class="mb-3">
                    <label for="reason" class="form-label fw-semibold">Reason for Leave</label>
                    <textarea name="reason" id="reason" class="form-control rounded-3" rows="4" placeholder="Explain your reason..." required></textarea>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-success px-4 rounded-pill shadow-sm">Submit Request</button>
                </div>
            </form>
        </div>
    </div>
</div>

<x-faculityfooter/>
