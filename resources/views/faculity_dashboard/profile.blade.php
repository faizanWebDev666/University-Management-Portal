<x-faculityheader />

<div class="professor-profile-wrapper" style="background-color: #f8fafc; min-height: 100vh; padding: 2rem 0;">
    <div class="container-fluid px-4">
        <!-- Header Section -->
        <div class="row align-items-center mb-5">
            <div class="col-md-8">
                <div class="d-flex align-items-center gap-3 mb-2">
                    <a href="{{ route('faculity.dashboard') }}" class="btn btn-icon-only rounded-circle border bg-white shadow-sm hover-lift">
                        <i class="bi bi-arrow-left"></i>
                    </a>
                    <div class="brand-accent"></div>
                    <h2 class="main-title mb-0">Manage My Profile</h2>
                </div>
                <p class="text-muted fs-5 mb-0 ps-5">Keep your professional information up to date for the university directory.</p>
            </div>
        </div>

        <form action="{{ route('faculty.profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row g-4">
                <!-- Left Column: Avatar and Quick Info -->
                <div class="col-lg-4">
                    <div class="modern-profile-card h-100">
                        <div class="card-body p-4 p-lg-5 text-center">
                            <!-- Avatar Section -->
                            <div class="position-relative d-inline-block mb-4">
                                <div class="profile-avatar-large shadow-lg">
                                    @if($professor->image)
                                        <img src="{{ asset('storage/' . $professor->image->image_path) }}" alt="Profile" id="imagePreview">
                                    @else
                                        <img src="{{ asset('frontend/images/Person.png') }}" alt="Default Profile" id="imagePreview">
                                    @endif
                                </div>
                                <label for="teacher_image" class="avatar-edit-badge shadow-sm hover-lift">
                                    <i class="bi bi-camera-fill"></i>
                                    <input type="file" name="teacher_image" id="teacher_image" class="d-none" accept="image/*" onchange="previewImage(this)">
                                </label>
                            </div>

                            <h3 class="fw-bold text-dark mb-1">{{ $professor->full_name }}</h3>
                            <p class="text-muted fw-medium mb-3">{{ $professor->designation }}</p>
                            
                            <div class="d-flex justify-content-center gap-2 mb-5">
                                <span class="badge bg-soft-primary text-primary border-0 rounded-pill px-3 py-2">
                                    <i class="bi bi-person-badge me-1"></i> {{ $professor->role }}
                                </span>
                            </div>

                            <div class="academic-doc-card p-4 rounded-4 text-start">
                                <h6 class="fw-bold text-dark mb-3 text-uppercase small letter-spacing-1">Academic Documents</h6>
                                <div class="doc-item d-flex align-items-center justify-content-between p-3 rounded-3 bg-white border mb-3">
                                    <div class="d-flex align-items-center">
                                        <div class="doc-icon bg-soft-danger text-danger rounded-3 me-3">
                                            <i class="bi bi-file-earmark-pdf"></i>
                                        </div>
                                        <div>
                                            <p class="mb-0 fw-bold text-dark small">Resume / CV</p>
                                            <small class="text-muted x-small">{{ $professor->resume ? 'Available' : 'Not uploaded' }}</small>
                                        </div>
                                    </div>
                                    @if($professor->resume)
                                        <a href="{{ asset('storage/' . $professor->resume) }}" target="_blank" class="btn btn-icon-only rounded-circle bg-light border-0">
                                            <i class="bi bi-download"></i>
                                        </a>
                                    @endif
                                </div>
                                
                                <label for="resume" class="btn btn-outline-primary w-100 rounded-pill py-2 fw-bold small hover-lift">
                                    <i class="bi bi-cloud-upload me-2"></i> {{ $professor->resume ? 'Update Resume' : 'Upload Resume' }}
                                    <input type="file" name="resume" id="resume" class="d-none" accept=".pdf,.doc,.docx">
                                </label>
                                <p class="text-center text-muted x-small mt-2 mb-0">Max size 2MB (PDF/DOC)</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Form Details -->
                <div class="col-lg-8">
                    <div class="modern-profile-details-card h-100">
                        <div class="card-header-tabs p-0">
                            <ul class="nav nav-pills custom-modern-pills m-3" id="profileTab" role="tablist">
                                <li class="nav-item">
                                    <button class="nav-link active" id="personal-tab" data-bs-toggle="tab" data-bs-target="#personal" type="button">
                                        <i class="bi bi-person-lines-fill me-2"></i> Personal Information
                                    </button>
                                </li>
                                <li class="nav-item">
                                    <button class="nav-link" id="academic-tab" data-bs-toggle="tab" data-bs-target="#academic" type="button">
                                        <i class="bi bi-mortarboard-fill me-2"></i> Academic Records
                                    </button>
                                </li>
                            </ul>
                        </div>

                        <div class="card-body p-4 p-lg-5">
                            <div class="tab-content" id="profileTabContent">
                                <!-- Personal Info Tab -->
                                <div class="tab-pane fade show active" id="personal" role="tabpanel">
                                    <div class="row g-4">
                                        <div class="col-md-6">
                                            <div class="form-floating custom-floating">
                                                <input type="text" name="full_name" class="form-control" id="f_name" value="{{ old('full_name', $professor->full_name) }}" required>
                                                <label for="f_name">Full Name</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating custom-floating">
                                                <input type="email" class="form-control bg-light" id="f_email" value="{{ $professor->email }}" readonly>
                                                <label for="f_email">Email Address (Read-only)</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating custom-floating">
                                                <input type="text" name="phone" class="form-control" id="f_phone" value="{{ old('phone', $professor->phone) }}" required>
                                                <label for="f_phone">Phone Number</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating custom-floating">
                                                <input type="text" class="form-control bg-light" id="f_gender" value="{{ $professor->gender }}" readonly>
                                                <label for="f_gender">Gender</label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-floating custom-floating">
                                                <input type="text" name="address" class="form-control" id="f_address" value="{{ old('address', $professor->address) }}" required>
                                                <label for="f_address">Home Address</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating custom-floating">
                                                <input type="text" name="city" class="form-control" id="f_city" value="{{ old('city', $professor->city) }}" required>
                                                <label for="f_city">City</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating custom-floating">
                                                <input type="text" name="country" class="form-control" id="f_country" value="{{ old('country', $professor->country) }}" required>
                                                <label for="f_country">Country</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Academic Info Tab -->
                                <div class="tab-pane fade" id="academic" role="tabpanel">
                                    <div class="row g-4">
                                        <div class="col-md-6">
                                            <div class="form-floating custom-floating">
                                                <input type="text" class="form-control bg-light" value="{{ $professor->designation }}" readonly>
                                                <label>Current Designation</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating custom-floating">
                                                <input type="text" class="form-control bg-light" value="{{ $professor->qualification }}" readonly>
                                                <label>Highest Qualification</label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-floating custom-floating">
                                                <input type="text" class="form-control bg-light" value="{{ $professor->specialization }}" readonly>
                                                <label>Area of Specialization</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating custom-floating">
                                                <input type="text" class="form-control bg-light" value="{{ $professor->joining_date }}" readonly>
                                                <label>University Joining Date</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating custom-floating">
                                                <input type="text" class="form-control bg-light" value="{{ $professor->username }}" readonly>
                                                <label>System Username</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="info-notice-box mt-5 p-4 rounded-4 d-flex gap-3">
                                        <div class="notice-icon text-warning fs-4">
                                            <i class="bi bi-info-circle-fill"></i>
                                        </div>
                                        <p class="mb-0 text-dark small fw-medium">
                                            <strong>Note:</strong> Academic information is strictly managed by the Administration. 
                                            If you notice any discrepancies in your designation or joining details, please contact the HR department or the Registration Branch.
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-5 pt-4 border-top d-flex gap-3">
                                <button type="submit" class="btn btn-primary-pgu rounded-pill px-5 py-3 shadow-sm fw-bold">
                                    <i class="bi bi-check-circle-fill me-2"></i> Update Profile Settings
                                </button>
                                <a href="{{ route('faculity.dashboard') }}" class="btn btn-light border rounded-pill px-5 py-3 fw-bold">
                                    Discard Changes
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
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
        --bg-soft-danger: rgba(239, 68, 68, 0.1);
        --light-soft: #f1f5f9;
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

    /* Modern Profile Cards */
    .modern-profile-card, .modern-profile-details-card {
        background: #fff;
        border-radius: 24px;
        border: 1px solid rgba(0,0,0,0.04);
        box-shadow: var(--pgu-card-shadow);
        overflow: hidden;
    }

    /* Avatar Section */
    .profile-avatar-large {
        width: 180px;
        height: 180px;
        border-radius: 50%;
        overflow: hidden;
        border: 6px solid #fff;
        background: #f8fafc;
    }
    .profile-avatar-large img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .avatar-edit-badge {
        position: absolute;
        bottom: 10px;
        right: 10px;
        width: 44px;
        height: 44px;
        background: var(--pgu-primary);
        color: #fff;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        border: 4px solid #fff;
        font-size: 1.25rem;
    }

    /* Document Card */
    .academic-doc-card {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
    }
    .doc-icon {
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
    }

    /* Tabs Styling */
    .custom-modern-pills {
        padding: 0.5rem;
        background: #f8fafc;
        border-radius: 16px;
        gap: 0.25rem;
        display: inline-flex;
    }
    .custom-modern-pills .nav-link {
        border-radius: 12px;
        padding: 0.75rem 1.5rem;
        color: var(--pgu-text-muted);
        font-weight: 700;
        transition: all 0.2s;
        border: 1px solid transparent;
        font-size: 0.9rem;
    }
    .custom-modern-pills .nav-link:hover {
        color: var(--pgu-primary);
    }
    .custom-modern-pills .nav-link.active {
        background: #fff;
        color: var(--pgu-primary);
        box-shadow: 0 4px 12px rgba(243, 93, 133, 0.1);
        border-color: rgba(243, 93, 133, 0.1);
    }

    /* Form Styling */
    .custom-floating > .form-control {
        border-radius: 12px;
        border: 1.5px solid #e2e8f0;
        padding-top: 1.625rem;
        padding-bottom: 0.625rem;
        height: auto;
        font-weight: 600;
        color: #1e293b;
    }
    .custom-floating > .form-control:focus {
        border-color: var(--pgu-primary);
        box-shadow: 0 0 0 4px rgba(243, 93, 133, 0.1);
    }
    .custom-floating > label {
        font-weight: 600;
        color: var(--pgu-text-muted);
        padding-left: 1rem;
    }

    /* Buttons */
    .btn-primary-pgu {
        background-color: var(--pgu-primary);
        border: none;
        color: #fff;
    }
    .btn-primary-pgu:hover { background-color: var(--pgu-primary-dark); transform: translateY(-2px); }

    .info-notice-box {
        background: rgba(245, 158, 11, 0.05);
        border: 1px solid rgba(245, 158, 11, 0.2);
    }

    .btn-icon-only {
        width: 36px;
        height: 36px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .hover-lift:hover { transform: translateY(-2px); }
    .letter-spacing-1 { letter-spacing: 0.05em; }
    .x-small { font-size: 0.7rem; }
    .bg-soft-primary { background-color: rgba(243, 93, 133, 0.1) !important; }
    .bg-soft-danger { background-color: rgba(239, 68, 68, 0.1) !important; }
</style>

<script>
    function previewImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('imagePreview').src = e.target.result;
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

<x-faculityfooter />
