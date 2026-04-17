<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta name="keywords" content="Digital marketing agency, Digital marketing company, Digital marketing services">
    <meta name="description" content="Jobi is a beautiful website template designed for job board websites.">
    <meta property="og:site_name" content="Jano">
    <meta property="og:url" content="https://creativegigstf.com/">
    <meta property="og:type" content="website">
    <meta property="og:title" content="Jobi - Responsive Job Board HTML Template">
    <meta name='og:image' content='../backend_faculity/images/assets/ogg.png'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#244034">
    <meta name="msapplication-navbutton-color" content="#244034">
    <meta name="apple-mobile-web-app-status-bar-style" content="#244034">
    <title>Faculity Dashboard</title>
    <link rel="icon" type="image/png" sizes="56x56" href="frontend/images/icon/icon.png">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('backend_faculity/css/bootstrap.min.css') }}"media="all">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('backend_faculity/css/style.min.css') }}" media="all">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('backend_faculity/css/responsive.css') }}"media="all">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<style>
    /* Professional Sidebar Redesign Styles */
    :root {
        --sidebar-bg: #ffffff;
        --sidebar-text: #475569;
        --sidebar-text-muted: #94a3b8;
        --primary-teal: #009A9A;
        --primary-teal-light: #f0fdfd;
        --primary-teal-dark: #007a7a;
        --sidebar-active-bg: #f0fdfd;
        --sidebar-hover-bg: #f8fafc;
        --border-color: #f1f5f9;
        --transition-smooth: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        --sidebar-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
    }

    body {
        font-family: 'Inter', system-ui, -apple-system, sans-serif;
        background-color: #f0f2f5; /* Unified background color */
        color: #1e293b;
        margin: 0;
        padding: 0;
    }

    .main-page-wrapper {
        display: flex;
        min-height: 100vh;
        position: relative;
        background-color: #f0f2f5; /* Match body */
    }

    /* Sidebar Navigation - Independent Scroll Fix */
    .dash-aside-navbar {
        width: 280px;
        flex-shrink: 0;
        background-color: var(--sidebar-bg);
        border-right: none !important; /* Remove border to eliminate gap */
        padding: 0;
        display: flex;
        flex-direction: column;
        position: fixed;
        left: 0;
        top: 0;
        bottom: 0;
        height: 100vh;
        overflow-y: auto;
        overflow-x: hidden;
        z-index: 1040;
        transition: var(--transition-smooth);
        box-shadow: none !important; /* Remove shadow that might look like a gap */
    }

    /* Prevent scrollbar from affecting the dashboard page layout */
    .dash-aside-navbar::-webkit-scrollbar {
        width: 5px;
    }

    .dash-aside-navbar::-webkit-scrollbar-track {
        background: transparent;
    }

    .dash-aside-navbar::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 10px;
    }

    .dash-aside-navbar::-webkit-scrollbar-thumb:hover {
        background: var(--primary-teal);
    }

    /* Dashboard Content Area - Balanced Spacing */
    .dashboard-body {
        flex-grow: 1;
        margin-left: 280px !important; /* Strict alignment */
        padding: 25px 35px;
        background-color: #f0f2f5;
        min-height: 100vh;
        width: calc(100% - 280px) !important;
        transition: var(--transition-smooth);
        border-left: 1px solid #e2e8f0 !important; /* Add border here instead of sidebar */
    }

    .dash-aside-navbar .logo {
        padding: 24px 20px;
        border-bottom: 1px solid var(--border-color);
        display: flex;
        align-items: center;
        justify-content: center;
        background: #fff;
    }

    .dash-aside-navbar .logo img {
        max-width: 140px;
        height: auto;
        transition: var(--transition-smooth);
    }

    /* User Profile Section */
    .user-profile-card {
        padding: 24px 20px;
        text-align: center;
        background: linear-gradient(to bottom, #fff, #f8fafc);
        border-bottom: 1px solid var(--border-color);
    }

    .user-avatar-wrapper {
        position: relative;
        width: 80px;
        height: 80px;
        margin: 0 auto 16px;
    }

    .user-avatar-wrapper .avatar-inner {
        width: 100%;
        height: 100%;
        border-radius: 50%;
        padding: 3px;
        background: linear-gradient(135deg, var(--primary-teal), #2dd4bf);
        box-shadow: 0 4px 12px rgba(0, 154, 154, 0.2);
    }

    .user-avatar-wrapper img {
        width: 100%;
        height: 100%;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid #fff;
    }

    .user-avatar-wrapper .status-indicator {
        position: absolute;
        bottom: 2px;
        right: 2px;
        width: 14px;
        height: 14px;
        background: #22c55e;
        border: 2px solid #fff;
        border-radius: 50%;
    }

    .user-profile-card h5 {
        font-size: 1rem;
        font-weight: 600;
        color: #1e293b;
        margin-bottom: 4px;
    }

    .user-profile-card span {
        font-size: 0.8125rem;
        color: var(--sidebar-text-muted);
        font-weight: 500;
    }

    /* Main Navigation Override */
    .dasboard-main-nav {
        flex-grow: 1;
        padding: 20px 12px;
    }

    .dasboard-main-nav ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .dasboard-main-nav ul li {
        margin-bottom: 4px !important;
    }

    .dasboard-main-nav ul li a,
    .nav-link-item {
        display: flex !important;
        align-items: center !important;
        padding: 12px 16px !important;
        color: var(--sidebar-text) !important;
        font-size: 0.9375rem !important;
        font-weight: 500 !important;
        text-decoration: none !important;
        border-radius: 12px !important;
        background-color: transparent !important;
        transition: var(--transition-smooth) !important;
        position: relative !important;
        box-shadow: none !important;
        border: none !important;
    }

    .nav-link-item i, 
    .dasboard-main-nav ul li a i:not(.collapse-icon) {
        font-size: 1.1rem !important;
        width: 24px !important;
        margin-right: 12px !important;
        color: var(--sidebar-text-muted) !important;
        transition: var(--transition-smooth) !important;
    }

    /* Hover State */
    .nav-link-item:hover, 
    .dasboard-main-nav ul li a:hover {
        background-color: var(--sidebar-hover-bg) !important;
        color: var(--primary-teal) !important;
    }

    .nav-link-item:hover i, 
    .dasboard-main-nav ul li a:hover i {
        color: var(--primary-teal) !important;
    }

    /* Active State */
    .nav-link-item.active, 
    .dasboard-main-nav ul li a.active {
        background-color: var(--sidebar-active-bg) !important;
        color: var(--primary-teal) !important;
        font-weight: 600 !important;
    }

    .nav-link-item.active i, 
    .dasboard-main-nav ul li a.active i {
        color: var(--primary-teal) !important;
    }

    /* Vertical Indicator for Active Link */
    .nav-link-item.active::before, 
    .dasboard-main-nav > ul > li > a.active::before {
        content: '';
        position: absolute;
        left: 0;
        top: 50%;
        transform: translateY(-50%);
        width: 4px;
        height: 20px;
        background: var(--primary-teal);
        border-radius: 0 4px 4px 0;
    }

    /* Sub-menu Styling Override */
    .collapse-icon {
        font-size: 0.75rem;
        transition: transform 0.3s ease;
        opacity: 0.5;
    }

    .nav-link-item[aria-expanded="true"] .collapse-icon {
        transform: rotate(180deg);
        opacity: 1;
    }

    .sub-menu {
        margin-top: 4px !important;
        padding-left: 20px !important;
        position: relative !important;
        background-color: transparent !important;
        border: none !important;
    }

    .sub-menu::before {
        content: '';
        position: absolute;
        left: 28px;
        top: 0;
        bottom: 10px;
        width: 1px;
        background: var(--border-color);
    }

    .sub-menu li {
        margin-bottom: 2px !important;
    }

    .sub-menu li a {
        padding: 8px 16px !important;
        font-size: 0.875rem !important;
        border-radius: 8px !important;
        display: flex;
        align-items: center;
        color: var(--sidebar-text);
        text-decoration: none;
        transition: var(--transition-smooth);
    }

    .sub-menu li a:hover {
        background-color: var(--sidebar-hover-bg) !important;
        color: var(--primary-teal) !important;
    }

    .sub-menu li a.active {
        background-color: transparent !important;
        color: var(--primary-teal) !important;
        font-weight: 600 !important;
    }

    .sub-menu li a.active::before {
        display: none !important;
    }

    /* Profile Completion Section */
    .sidebar-footer {
        padding: 20px;
        border-top: 1px solid var(--border-color);
        background: #fff;
    }

    .profile-progress-wrapper {
        background: #f8fafc;
        padding: 12px;
        border-radius: 12px;
        margin-bottom: 16px;
    }

    .progress-info {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 8px;
    }

    .progress-info span {
        font-size: 0.75rem;
        font-weight: 600;
        color: var(--sidebar-text);
    }

    .progress-info .percentage {
        color: var(--primary-teal);
    }

    .progress-bar-container {
        height: 6px;
        background: #e2e8f0;
        border-radius: 10px;
        overflow: hidden;
    }

    .progress-bar-fill {
        height: 100%;
        background: linear-gradient(90deg, var(--primary-teal), #2dd4bf);
        border-radius: 10px;
        transition: width 1s ease-in-out;
    }

    /* Logout Button */
    .logout-btn-wrapper {
        padding: 0 12px 20px;
    }

    .logout-link {
        display: flex;
        align-items: center;
        padding: 12px 16px;
        color: #ef4444;
        font-size: 0.9375rem;
        font-weight: 600;
        text-decoration: none;
        border-radius: 10px;
        transition: var(--transition-smooth);
        background: #fef2f2;
    }

    .logout-link i {
        margin-right: 12px;
        font-size: 1.1rem;
    }

    .logout-link:hover {
        background: #fee2e2;
        transform: translateY(-1px);
    }

    /* Mobile Toggle & Overlay */
    .faculty-mobile-toggle {
        display: none;
        position: fixed;
        top: 12px;
        left: 12px;
        z-index: 1051;
        width: 42px;
        height: 42px;
        border-radius: 12px;
        background: var(--primary-teal);
        color: #fff;
        border: none;
        box-shadow: 0 4px 12px rgba(0, 154, 154, 0.3);
        align-items: center;
        justify-content: center;
        cursor: pointer;
    }

    .faculty-sidebar-overlay {
        position: fixed;
        inset: 0;
        background: rgba(15, 23, 42, 0.4);
        backdrop-filter: blur(4px);
        z-index: 1035;
        opacity: 0;
        visibility: hidden;
        transition: all 0.3s ease;
    }

    .faculty-sidebar-overlay.show {
        opacity: 1;
        visibility: visible;
    }

    /* Responsive Adjustments */
    @media (max-width: 991.98px) {
        .faculty-mobile-toggle {
            display: flex;
        }

        .dash-aside-navbar {
            transform: translateX(-100%);
            box-shadow: 20px 0 25px -5px rgb(0 0 0 / 0.1);
        }

        .dash-aside-navbar.sidebar-open {
            transform: translateX(0);
        }

        .dashboard-body {
            margin-left: 0; /* No offset on mobile */
            width: 100%;
            padding: 70px 16px 24px;
        }
    }

    @media (max-width: 575.98px) {
        .dash-aside-navbar {
            width: 260px;
        }
    }
</style>
</head>

<body>
    @php
        use Illuminate\Support\Facades\Session;
        use App\Models\TeacherRegistration;
        use App\Models\User;

        $professor = null;
        $student = null;
        if (Session::has('id')) {
            $user = User::where('id', Session::get('id'))->first();
            if ($user && $user->type === 'professor') {
                $professor = $user;
                $teacherReg = TeacherRegistration::with('image')->where('email', $user->email)->first();
            }
        }

        // Helper function to check if a route is active
        function isActive($routeNames) {
            foreach ((array) $routeNames as $routeName) {
                if (request()->routeIs($routeName)) {
                    return 'active';
                }
            }
            return '';
        }
    @endphp
    <div class="main-page-wrapper">
        <aside class="dash-aside-navbar">
            <div class="position-relative">
                <div class="logo text-md-center d-md-block d-flex align-items-center justify-content-between">
                    <a href="{{ route('faculity.dashboard') }}">
                        <img src="{{ URL::asset('frontend/images/logo/3rdlogo.png') }}" alt="Logo">
                    </a>
                    <button class="close-btn d-block d-md-none"><i class="bi bi-x-lg"></i></button>
                </div>

                <div class="user-profile-card d-none d-md-block">
                    <div class="user-avatar-wrapper">
                        <div class="avatar-inner">
                            @if($teacherReg && $teacherReg->image)
                                <img src="{{ asset('storage/' . $teacherReg->image->image_path) }}" alt="Avatar" class="lazy-img">
                            @else
                                <img src="{{ asset('frontend/images/Person.png') }}" alt="Avatar" class="lazy-img">
                            @endif
                        </div>
                        <div class="status-indicator"></div>
                    </div>
                    <div class="user-info">
                        <h5 class="mb-0">{{ session('name', 'Professor') }}</h5>
                        <span>{{ $teacherReg->designation ?? 'Faculty Member' }}</span>
                    </div>
                </div>

                <nav class="dasboard-main-nav">
                    <ul class="style-none">
                        <li>
                            <a href="{{ route('faculity.dashboard') }}" class="{{ isActive('faculity.dashboard') }}">
                                <i class="fas fa-tachometer-alt"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>

                       

                        <li class="nav-item-wrapper">
                            <a class="nav-link-item {{ isActive(['postedAssignments']) ? 'active' : '' }}" data-bs-toggle="collapse" href="#studentManagement" role="button" aria-expanded="{{ isActive(['postedAssignments', 'teacher.leave', 'faculty.leave.index']) ? 'true' : 'false' }}" aria-controls="studentManagement">
                                <i class="fas fa-users"></i>
                                <span>Leave Management</span>
                                <i class="fas fa-chevron-down ms-auto collapse-icon"></i>
                            </a>
                            <div class="collapse {{ isActive(['teacher.leave', 'faculty.leave.index']) ? 'show' : '' }}" id="studentManagement">
                                <ul class="style-none sub-menu">
                                    <li><a href="{{ route('teacher.leave') }}" class="{{ isActive('teacher.leave') }}">
                                        <span>Leave Requests</span>
                                    </a></li>
                                    <li><a href="{{ route('faculty.leave.index') }}" class="{{ isActive('faculty.leave.index') }}">
                                        <span>My Applications</span>
                                    </a></li>
                                </ul>
                            </div>
                        </li>

                        <li class="nav-item-wrapper">
                            <a class="nav-link-item" data-bs-toggle="collapse" href="#profileSettings" role="button" aria-expanded="{{ isActive(['faculty.profile', 'teacher.change.password']) ? 'true' : 'false' }}" aria-controls="profileSettings">
                                <i class="fas fa-user-cog"></i>
                                <span>Profile Settings</span>
                                <i class="fas fa-chevron-down ms-auto collapse-icon"></i>
                            </a>
                            <div class="collapse {{ isActive(['faculty.profile', 'teacher.change.password']) ? 'show' : '' }}" id="profileSettings">
                                <ul class="style-none sub-menu">
                                    <li><a href="{{ route('faculty.profile') }}" class="{{ isActive('faculty.profile') }}">
                                        <span>Manage Profile</span>
                                    </a></li>
                                    <li><a href="{{ route('teacher.change.password') }}" class="{{ isActive('teacher.change.password') }}">
                                        <span>Change Password</span>
                                    </a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </nav>

                <div class="sidebar-footer">
                    <div class="profile-progress-wrapper">
                        <div class="progress-info">
                            <span>Profile Completion</span>
                            <span class="percentage">87%</span>
                        </div>
                        <div class="progress-bar-container">
                            <div class="progress-bar-fill" style="width: 87%;"></div>
                        </div>
                    </div>
                </div>

                <div class="logout-btn-wrapper">
                    <a href="{{ route('logout') }}" class="logout-link">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Logout</span>
                    </a>
                </div>
            </div>
        </aside>
        <div class="faculty-sidebar-overlay" id="facultySidebarOverlay"></div>

        <div class="dashboard-body">
            <x-flash-messages />
            <button class="faculty-mobile-toggle" id="facultySidebarOpenBtn" type="button" aria-label="Open faculty menu">
                <i class="fas fa-bars"></i>
            </button>
            <div class="position-relative">
