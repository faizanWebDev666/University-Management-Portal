<x-admin-header/>
<div class="container mt-5">
    <h3>Edit Leave Request</h3>
    <form action="{{ route('leaves.update', $leave->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Leave Type</label>
            <input type="text" class="form-control" value="{{ $leave->leave_type }}" disabled>
        </div>

         <div class="mb-3">
        <label>From Date</label>
        <input type="date" name="from_date" class="form-control" value="{{ old('from_date', $leave->from_date) }}" required>
    </div>

    <div class="mb-3">
        <label>To Date</label>
        <input type="date" name="to_date" class="form-control" value="{{ old('to_date', $leave->to_date) }}" required>
    </div>

        <div class="form-group">
            <label>Reason</label>
            <textarea class="form-control" rows="10" disabled>{{ $leave->reason }}</textarea>
        </div>

        <div class="form-group">
            <label>Status</label>
            <select name="status" class="form-control" required onchange="toggleReason(this.value)">
                <option value="Pending" {{ $leave->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                <option value="Approved" {{ $leave->status == 'Approved' ? 'selected' : '' }}>Approved</option>
                <option value="Rejected" {{ $leave->status == 'Rejected' ? 'selected' : '' }}>Rejected</option>
                                <option value="Accepted With Modifications" {{ $leave->status == 'Accepted With Modifications' ? 'selected' : '' }}>Accepted With Modifications</option>

            </select>
        </div>

        <div class="form-group" id="rejection-reason" style="display: {{ $leave->status == 'Rejected' ? 'block' : 'none' }};">
            <label>Rejection Reason</label>
            <textarea name="rejection_reason" class="form-control" rows="3">{{ $leave->rejection_reason }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Update Leave Status</button>
        <a href="{{ route('admin.viewLeaves') }}" class="btn btn-secondary">Back</a>
    </form>
</div>

<script>
    function toggleReason(status) {
        const reasonBox = document.getElementById('rejection-reason');
        if (status === 'Rejected' || status === 'Accepted With Modifications') {
            reasonBox.style.display = 'block';
        } else {
            reasonBox.style.display = 'none';
        }
    }
</script>

<x-admin-footer/>
