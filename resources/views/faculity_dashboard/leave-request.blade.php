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

            <form action="{{ route('faculty.leave.store') }}" method="POST" id="leaveForm">
                @csrf

                <!-- Leave Type -->
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

                <!-- Other Reason (Hidden by Default) -->
                <div class="mb-3 d-none" id="other_reason_box">
                    <label for="other_reason" class="form-label fw-semibold">Specify Other Reason</label>
                    <input type="text" name="other_reason" id="other_reason" class="form-control rounded-3">
                </div>

                <!-- From Date -->
                <div class="mb-3">
                    <label for="from_date" class="form-label fw-semibold">From Date</label>
                    <input type="date" name="from_date" id="from_date" class="form-control rounded-3" required min="{{ now()->toDateString() }}">
                </div>

                <!-- To Date -->
                <div class="mb-3">
                    <label for="to_date" class="form-label fw-semibold">To Date</label>
                    <input type="date" name="to_date" id="to_date" class="form-control rounded-3" required min="{{ now()->toDateString() }}">
                </div>

                <!-- Reason -->
                <div class="mb-3">
                    <label for="reason" class="form-label fw-semibold">Reason for Leave</label>
                    <textarea name="reason" id="reason" class="form-control rounded-3" rows="4" placeholder="Explain your reason..." required></textarea>
                    <div class="text-danger small mt-1 d-none" id="reason_error">Reason must be at least 10 characters.</div>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-success px-4 rounded-pill shadow-sm">Submit Request</button>
                </div>
            </form>
        </div>
    </div>
</div>

<x-faculityfooter/>

<!-- ✅ Client-Side Validation Script -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const leaveType = document.getElementById('leave_type');
    const otherBox = document.getElementById('other_reason_box');
    const reason = document.getElementById('reason');
    const reasonError = document.getElementById('reason_error');
    const form = document.getElementById('leaveForm');

    // Show Other reason input if "Other" is selected
    leaveType.addEventListener('change', function() {
        if (this.value === 'Other') {
            otherBox.classList.remove('d-none');
            document.getElementById('other_reason').setAttribute('required', 'required');
        } else {
            otherBox.classList.add('d-none');
            document.getElementById('other_reason').removeAttribute('required');
        }
    });

    // Validate Reason Length
    reason.addEventListener('input', function() {
        if (reason.value.length < 10) {
            reason.classList.add('is-invalid');
            reasonError.classList.remove('d-none');
        } else {
            reason.classList.remove('is-invalid');
            reasonError.classList.add('d-none');
        }
    });

    // Prevent form submission if reason is too short
    form.addEventListener('submit', function(e) {
        if (reason.value.length < 10) {
            e.preventDefault();
            reason.classList.add('is-invalid');
            reasonError.classList.remove('d-none');
        }
    });
});
</script>
