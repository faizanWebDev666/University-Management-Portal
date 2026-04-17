<x-faculityheader />

<div class="professor-leave-wrapper" style="background-color: #f8fafc; min-height: 100vh; padding: 2rem 0;">
    <div class="container-fluid px-4">
        <!-- Header Section -->
        <div class="row align-items-center mb-5">
            <div class="col-md-8">
                <div class="d-flex align-items-center gap-3 mb-2">
                    <a href="{{ route('faculity.dashboard') }}" class="btn btn-icon-only rounded-circle border bg-white shadow-sm hover-lift">
                        <i class="bi bi-arrow-left"></i>
                    </a>
                    <div class="brand-accent"></div>
                    <h2 class="main-title mb-0">Leave Application</h2>
                </div>
                <p class="text-muted fs-5 mb-0 ps-5">Submit and manage your leave requests professionally.</p>
            </div>
        </div>

        <div class="row g-4">
            <!-- Left Column: Form -->
            <div class="col-lg-7">
                <div class="modern-leave-card h-100">
                    <div class="card-header bg-white border-bottom p-4">
                        <h5 class="fw-bold text-dark mb-0">
                            <i class="bi bi-pencil-square me-2 text-primary"></i>New Leave Request
                        </h5>
                    </div>
                    <div class="card-body p-4 p-lg-5">
                        <form action="{{ route('faculty.leave.store') }}" method="POST" id="leaveForm">
                            @csrf

                            <div class="row g-4">
                                <!-- Leave Type -->
                                <div class="col-12">
                                    <div class="form-floating custom-floating">
                                        <select class="form-select" name="leave_type" id="leave_type" required>
                                            <option value="">Select Leave Type</option>
                                            <option value="Sick Leave">Sick Leave</option>
                                            <option value="Casual Leave">Casual Leave</option>
                                            <option value="Emergency Leave">Emergency Leave</option>
                                            <option value="Other">Other</option>
                                        </select>
                                        <label for="leave_type">Leave Category</label>
                                    </div>
                                </div>

                                <!-- Other Reason (Hidden by Default) -->
                                <div class="col-12 d-none" id="other_reason_box">
                                    <div class="form-floating custom-floating">
                                        <input type="text" name="other_reason" id="other_reason" class="form-control" placeholder="Specify Reason">
                                        <label for="other_reason">Specify Other Reason</label>
                                    </div>
                                </div>

                                <!-- Dates -->
                                <div class="col-md-6">
                                    <div class="form-floating custom-floating">
                                        <input type="date" name="from_date" id="from_date" class="form-control" required min="{{ now()->toDateString() }}">
                                        <label for="from_date">From Date</label>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating custom-floating">
                                        <input type="date" name="to_date" id="to_date" class="form-control" required min="{{ now()->toDateString() }}">
                                        <label for="to_date">To Date</label>
                                    </div>
                                </div>

                                <!-- Reason -->
                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="form-label fw-bold small text-muted text-uppercase mb-2">Detailed Reason *</label>
                                        <textarea name="reason" id="reason" class="form-control rounded-4 p-3" rows="5" placeholder="Please provide a clear explanation for your leave request..." required style="border: 1.5px solid #e2e8f0;"></textarea>
                                        <div class="text-danger x-small mt-2 d-none" id="reason_error">
                                            <i class="bi bi-exclamation-circle me-1"></i> Reason must be at least 10 characters.
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 pt-3">
                                    <button type="submit" class="btn btn-primary-pgu w-100 rounded-pill py-3 fw-bold shadow-sm hover-lift">
                                        <i class="bi bi-send-fill me-2"></i> Submit Leave Application
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Right Column: Guidelines & Status -->
            <div class="col-lg-5">
                <div class="row g-4">
                    <!-- Guidelines -->
                    <div class="col-12">
                        <div class="guidelines-card p-4 p-lg-5 rounded-4 border-0 shadow-sm">
                            <div class="d-flex align-items-center gap-3 mb-4">
                                <div class="icon-box bg-soft-primary text-primary rounded-3 p-2">
                                    <i class="bi bi-info-circle-fill fs-4"></i>
                                </div>
                                <h5 class="fw-bold text-dark mb-0">Leave Guidelines</h5>
                            </div>
                            <ul class="guidelines-list list-unstyled mb-0">
                                <li class="mb-3 d-flex gap-3">
                                    <i class="bi bi-check2-circle text-success mt-1"></i>
                                    <span class="text-muted small">Submit requests at least <strong>2 days in advance</strong> for planned leaves.</span>
                                </li>
                                <li class="mb-3 d-flex gap-3">
                                    <i class="bi bi-check2-circle text-success mt-1"></i>
                                    <span class="text-muted small">Provide a <strong>valid and detailed reason</strong> for administrative review.</span>
                                </li>
                                <li class="mb-3 d-flex gap-3">
                                    <i class="bi bi-check2-circle text-success mt-1"></i>
                                    <span class="text-muted small">Specify the <strong>exact duration</strong> (From and To dates) clearly.</span>
                                </li>
                                <li class="d-flex gap-3">
                                    <i class="bi bi-check2-circle text-success mt-1"></i>
                                    <span class="text-muted small">Approval notifications will be sent to your <strong>official dashboard</strong>.</span>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Status Summary -->
                    <div class="col-12">
                        <div class="status-summary-card p-4 p-lg-5 rounded-4 border-0 shadow-sm bg-white">
                            <h6 class="fw-bold text-dark mb-4 text-uppercase small letter-spacing-1">Current Semester Summary</h6>
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span class="text-muted small">Total Leaves Taken</span>
                                <span class="badge bg-soft-secondary text-secondary rounded-pill px-3">04 Days</span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="text-muted small">Pending Requests</span>
                                <span class="badge bg-soft-warning text-warning rounded-pill px-3">01 Pending</span>
                            </div>
                            <hr class="my-4 opacity-50">
                            <a href="{{ route('faculty.leave.index') }}" class="btn btn-outline-primary w-100 rounded-pill py-2 fw-bold small hover-lift">
                                <i class="bi bi-clock-history me-2"></i> View Leave History
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<x-faculityfooter />

<style>
    /* Professional Color Palette from Brand Identity */
    :root {
        --pgu-primary: #f35d85; /* Blush */
        --pgu-primary-dark: #d64a6d;
        --pgu-secondary: #188ccc; /* Cyan */
        --pgu-success: #10b981;
        --pgu-warning: #f59e0b;
        --pgu-danger: #ef4444;
        --pgu-bg: #f8fafc;
        --pgu-text-dark: #1e293b;
        --pgu-text-muted: #64748b;
        --pgu-card-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.04), 0 8px 10px -6px rgba(0, 0, 0, 0.04);
        --bg-soft-primary: rgba(243, 93, 133, 0.1);
    }

    body {
        font-family: 'Inter', 'Segoe UI', sans-serif;
        background-color: var(--pgu-bg);
    }

    .brand-accent {
        width: 8px;
        height: 32px;
        background: var(--pgu-primary);
        border-radius: 4px;
    }

    .main-title {
        font-weight: 800;
        letter-spacing: -0.02em;
        color: #0f172a;
    }

    /* Modern Cards */
    .modern-leave-card, .guidelines-card, .status-summary-card {
        background: #fff;
        border-radius: 24px;
        border: 1px solid rgba(0,0,0,0.04);
        box-shadow: var(--pgu-card-shadow);
        overflow: hidden;
    }

    .guidelines-card {
        background: linear-gradient(135deg, #ffffff 0%, #fdf2f7 100%);
    }

    /* Form Styling */
    .custom-floating > .form-control, .custom-floating > .form-select {
        border-radius: 12px;
        border: 1.5px solid #e2e8f0;
        padding-top: 1.625rem;
        padding-bottom: 0.625rem;
        height: auto;
        font-weight: 600;
        color: #1e293b;
    }
    .custom-floating > .form-control:focus, .custom-floating > .form-select:focus {
        border-color: var(--pgu-primary);
        box-shadow: 0 0 0 4px rgba(243, 93, 133, 0.1);
        background-color: #fff;
    }
    .custom-floating > label {
        font-weight: 600;
        color: var(--pgu-text-muted);
        padding-left: 1rem;
    }

    textarea.form-control:focus {
        border-color: var(--pgu-primary) !important;
        box-shadow: 0 0 0 4px rgba(243, 93, 133, 0.1) !important;
        outline: none;
    }

    /* Buttons */
    .btn-primary-pgu {
        background-color: var(--pgu-primary);
        border: none;
        color: #fff;
    }
    .btn-primary-pgu:hover { background-color: var(--pgu-primary-dark); transform: translateY(-2px); color: #fff; }

    .btn-icon-only {
        width: 36px;
        height: 36px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .icon-box {
        width: 44px;
        height: 44px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .hover-lift:hover { transform: translateY(-2px); }
    .letter-spacing-1 { letter-spacing: 0.05em; }
    .x-small { font-size: 0.7rem; }
    .bg-soft-primary { background-color: rgba(243, 93, 133, 0.1) !important; }
    .bg-soft-secondary { background-color: rgba(24, 140, 204, 0.1) !important; }
    .bg-soft-warning { background-color: rgba(245, 158, 11, 0.1) !important; }
</style>

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
            reason.style.borderColor = 'var(--pgu-danger)';
            reasonError.classList.remove('d-none');
        } else {
            reason.style.borderColor = '#e2e8f0';
            reasonError.classList.add('d-none');
        }
    });

    // Prevent form submission if reason is too short
    form.addEventListener('submit', function(e) {
        if (reason.value.length < 10) {
            e.preventDefault();
            reason.style.borderColor = 'var(--pgu-danger)';
            reasonError.classList.remove('d-none');
        }
    });
});
</script>
