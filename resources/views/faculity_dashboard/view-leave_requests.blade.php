<x-faculityheader />

<div class="professor-leave-history-wrapper" style="background-color: #f8fafc; min-height: 100vh; padding: 2rem 0;">
    <div class="container-fluid px-4">
        <!-- Header Section -->
        <div class="row align-items-center mb-5">
            <div class="col-md-8">
                <div class="d-flex align-items-center gap-3 mb-2">
                    <a href="{{ route('teacher.leave') }}" class="btn btn-icon-only rounded-circle border bg-white shadow-sm hover-lift">
                        <i class="bi bi-arrow-left"></i>
                    </a>
                    <div class="brand-accent"></div>
                    <h2 class="main-title mb-0">Leave History</h2>
                </div>
                <p class="text-muted fs-5 mb-0 ps-5">Track and manage your previous leave applications.</p>
            </div>
            <div class="col-md-4 text-md-end mt-4 mt-md-0">
                <a href="{{ route('teacher.leave') }}" class="btn btn-primary-pgu rounded-pill px-4 py-2 fw-bold shadow-sm hover-lift">
                    <i class="bi bi-plus-lg me-2"></i> New Application
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="modern-table-card shadow-sm border-0 rounded-4 overflow-hidden bg-white">
                    <div class="card-header bg-white border-bottom p-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="fw-bold text-dark mb-0">My Applications</h5>
                            <div class="search-box position-relative">
                                <i class="bi bi-search position-absolute top-50 start-0 translate-middle-y ms-3 text-muted"></i>
                                <input type="text" class="form-control form-control-sm rounded-pill ps-5 py-2 border-light bg-light" placeholder="Search applications...">
                            </div>
                        </div>
                    </div>
                    
                    <div class="card-body p-0">
                        @if($leaveRequests->isEmpty())
                            <div class="empty-state p-5 text-center">
                                <div class="empty-icon-box mb-4 mx-auto">
                                    <i class="bi bi-folder2-open"></i>
                                </div>
                                <h5 class="fw-bold text-dark">No Applications Found</h5>
                                <p class="text-muted">You haven't submitted any leave applications yet.</p>
                            </div>
                        @else
                            <div class="table-responsive">
                                <table class="table table-hover align-middle mb-0 custom-pgu-table">
                                    <thead>
                                        <tr>
                                            <th class="ps-4">#</th>
                                            <th>Type</th>
                                            <th>Duration</th>
                                            <th>Reason</th>
                                            <th>Status</th>
                                            <th class="pe-4 text-end">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($leaveRequests as $index => $leave)
                                            <tr>
                                                <td class="ps-4 text-muted small">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</td>
                                                <td>
                                                    <div class="fw-bold text-dark">{{ $leave->leave_type }}</div>
                                                    <small class="text-muted x-small">Ref: #LV-{{ $leave->id }}</small>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center gap-2">
                                                        <div class="date-pill">
                                                            <span class="d-block x-small text-muted text-uppercase fw-bold">From</span>
                                                            <span class="fw-bold small">{{ \Carbon\Carbon::parse($leave->from_date)->format('M d, Y') }}</span>
                                                        </div>
                                                        <i class="bi bi-arrow-right text-muted small"></i>
                                                        <div class="date-pill">
                                                            <span class="d-block x-small text-muted text-uppercase fw-bold">To</span>
                                                            <span class="fw-bold small">{{ \Carbon\Carbon::parse($leave->to_date)->format('M d, Y') }}</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <p class="mb-0 text-muted small" style="max-width: 250px;">{{ Str::limit($leave->reason, 60) }}</p>
                                                </td>
                                                <td>
                                                    <span class="status-badge 
                                                        @if($leave->status == 'Pending') s-pending
                                                        @elseif($leave->status == 'Approved') s-approved
                                                        @else s-rejected @endif">
                                                        {{ $leave->status }}
                                                    </span>
                                                </td>
                                                <td class="pe-4 text-end">
                                                    <div class="d-flex justify-content-end gap-2">
                                                        @if($leave->status === 'Pending')
                                                            <a href="{{ route('faculty.leave.edit', $leave->id) }}" class="btn btn-icon-only rounded-circle bg-soft-primary text-primary border-0 hover-lift" title="Edit Application">
                                                                <i class="bi bi-pencil-square"></i>
                                                            </a>
                                                            <form action="{{ route('faculty.leave.destroy', $leave->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this request?')">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-icon-only rounded-circle bg-soft-danger text-danger border-0 hover-lift" title="Delete Application">
                                                                    <i class="bi bi-trash3"></i>
                                                                </button>
                                                            </form>
                                                        @elseif($leave->status === 'Rejected')
                                                            <button class="btn btn-icon-only rounded-circle bg-soft-danger text-danger border-0 hover-lift" 
                                                                    data-bs-toggle="tooltip" data-bs-placement="top" 
                                                                    title="Rejected: {{ $leave->rejection_reason ?? 'No reason provided.' }}">
                                                                <i class="bi bi-info-circle"></i>
                                                            </button>
                                                        @else
                                                            <span class="badge bg-soft-success text-success border-0 rounded-pill px-3">
                                                                <i class="bi bi-check-lg"></i> Finalized
                                                            </span>
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
        --bg-soft-success: rgba(16, 185, 129, 0.1);
        --bg-soft-danger: rgba(239, 68, 68, 0.1);
        --bg-soft-warning: rgba(245, 158, 11, 0.1);
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

    /* Modern Table Card */
    .modern-table-card {
        border: 1px solid rgba(0,0,0,0.04);
        box-shadow: var(--pgu-card-shadow);
    }

    .custom-pgu-table thead th {
        background: #f8fafc;
        padding: 1.25rem 1rem;
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        font-weight: 700;
        color: var(--pgu-text-muted);
        border-bottom: 1px solid #f1f5f9;
    }

    .custom-pgu-table tbody td {
        padding: 1.25rem 1rem;
        border-bottom: 1px solid #f8fafc;
    }

    .custom-pgu-table tbody tr:last-child td {
        border-bottom: none;
    }

    /* Status Badges */
    .status-badge {
        padding: 6px 14px;
        border-radius: 10px;
        font-size: 0.75rem;
        font-weight: 700;
        display: inline-block;
    }
    .s-pending { background: var(--bg-soft-warning); color: #d97706; }
    .s-approved { background: var(--bg-soft-success); color: #059669; }
    .s-rejected { background: var(--bg-soft-danger); color: #dc2626; }

    /* Date Pills */
    .date-pill {
        background: #f8fafc;
        padding: 4px 12px;
        border-radius: 8px;
        border: 1px solid #e2e8f0;
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
        transition: all 0.2s;
    }

    .bg-soft-primary { background-color: rgba(243, 93, 133, 0.1) !important; }
    .bg-soft-danger { background-color: rgba(239, 68, 68, 0.1) !important; }
    .bg-soft-success { background-color: rgba(16, 185, 129, 0.1) !important; }

    .hover-lift:hover { transform: translateY(-2px); }

    /* Empty State */
    .empty-icon-box {
        width: 80px;
        height: 80px;
        background: #f8fafc;
        border-radius: 24px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2.5rem;
        color: var(--pgu-text-muted);
    }

    .x-small { font-size: 0.65rem; }
</style>
