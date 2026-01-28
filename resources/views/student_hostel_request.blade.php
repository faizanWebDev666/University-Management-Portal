<x-header />

<section class="hostel-request-section py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">

                <div class="hostel-card">
                    <div class="hostel-card-header">
                        <i class="fas fa-bed"></i>
                        Hostel Accommodation Request Form
                    </div>
@if ($errors->any())
    <div class="alert alert-danger mx-auto my-4 w-75 rounded shadow-sm">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
                    <div class="hostel-card-body">
                        <form action="{{ route('student.hostel.store') }}" method="POST">
                            @csrf

                            <!-- Hostel & Room -->
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Preferred Hostel</label>
                                    <select class="form-control" name="hostel_type" required>
                                        <option value="">Select Hostel</option>
                                        <option value="Boys">Boys Hostel</option>
                                        <option value="Girls">Girls Hostel</option>
                                    </select>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Room Type</label>
                                    <select class="form-control" name="room_type" required>
                                        <option value="">Select Room Type</option>
                                        <option value="Single">Single Room</option>
                                        <option value="Shared">Shared Room</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Duration & Semester -->
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Accommodation Duration</label>
                                    <select class="form-control" id="duration" name="duration" required>
                                        <option value="">Select Duration</option>
                                        <option value="1">1 Semester</option>
                                        <option value="2">2 Semesters</option>
                                    </select>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Semester</label>
                                    <input type="text" id="semesterField" class="form-control"
                                        placeholder="e.g. Fall 2026" name="semester" required>
                                </div>
                            </div>

                            <!-- Personal & Contact -->
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Emergency Contact Name</label>
                                    <input type="text" class="form-control" name="emergency_name"
                                        placeholder="John Doe" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Emergency Contact Number</label>
                                    <input type="tel" class="form-control" name="emergency_number"
                                        placeholder="+92 300 1234567" required>
                                </div>
                            </div>

                            <!-- Medical Info -->
                            <div class="mb-3">
                                <label class="form-label">Medical Conditions</label>
                                <textarea class="form-control" name="medical_info" rows="2"
                                    placeholder="Mention allergies, chronic illness, or write N/A" required></textarea>
                            </div>

                            <!-- Address -->
                            <div class="mb-3">
                                <label class="form-label">Permanent Home Address</label>
                                <textarea class="form-control" name="address" rows="2"
                                    placeholder="House No, Street, City, Postal Code" required></textarea>
                            </div>

                            <!-- Reason -->
                            <div class="mb-3">
                                <label class="form-label">Reason for Hostel Request</label>
                                <textarea class="form-control" name="reason" rows="3"
                                    placeholder="Briefly explain why you require hostel accommodation" required></textarea>
                            </div>

                            <!-- Rules Agreement -->
                            <div class="form-check mb-4">
                                <input class="form-check-input" type="checkbox" name="agreement" required>
                                <label class="form-check-label">
                                    I agree to follow hostel rules, regulations, and disciplinary policies.
                                </label>
                            </div>

                            <!-- Submit -->
                            <div class="text-end">
                                <button type="submit" class="btn hostel-submit-btn">
                                    Submit Request
                                </button>
                            </div>

                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

<x-footer />

<script>
    // Auto-fill Semester field based on Accommodation Duration
    const durationField = document.getElementById('duration');
    const semesterField = document.getElementById('semesterField');

    durationField.addEventListener('change', function () {
        if (this.value === "1") {
            semesterField.value = "Fall 2026"; // Example: first semester
        } else if (this.value === "2") {
            semesterField.value = "Fall 2026 / Spring 2027"; // Two semesters
        } else {
            semesterField.value = "";
        }
    });
</script>

<style>
.hostel-request-section {
    background-color: #f4f6f8;
}

.hostel-card {
    background: #fff;
    border-radius: 10px;
    box-shadow: 0 8px 22px rgba(0,0,0,0.08);
}

.hostel-card-header {
    background: #009999;
    color: #fff;
    padding: 16px 20px;
    font-size: 18px;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 8px;
}

.hostel-card-body {
    padding: 24px;
}

.form-label {
    font-weight: 600;
    font-size: 14px;
}

.form-control {
    font-size: 14px;
    border-radius: 6px;
    padding: 9px 12px;
}

.form-control:focus {
    border-color: #009999;
    box-shadow: 0 0 0 0.12rem rgba(0,153,153,.25);
}

.hostel-submit-btn {
    background: #009999;
    color: #fff;
    padding: 9px 26px;
    font-weight: 600;
    border-radius: 6px;
    border: none;
}

.hostel-submit-btn:hover {
    background: #007e7e;
}
</style>
