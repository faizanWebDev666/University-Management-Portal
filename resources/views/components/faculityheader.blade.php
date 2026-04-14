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
    /* General Body and Layout */
    body {
        font-family: 'Inter', sans-serif;
        background-color: #f8f9fa; /* Light background for the whole page */
    }

    .main-page-wrapper {
        display: flex;
        min-height: 100vh;
    }

    /* Sidebar Navigation */
    .dash-aside-navbar {
        width: 280px;
        flex-shrink: 0;
        background-color: #ffffff; /* White background for sidebar */
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.05);
        padding: 20px 0;
        display: flex;
        flex-direction: column;
        position: sticky;
        top: 0;
        height: 100vh;
        overflow-y: auto; /* Enable scrolling for long menus */
    }

    .dash-aside-navbar .logo {
        padding: 0 20px 20px 20px;
        border-bottom: 1px solid #eee;
        margin-bottom: 20px;
    }

    .dash-aside-navbar .logo img {
        max-width: 150px;
    }

    .dash-aside-navbar .user-data {
        padding: 0 20px 20px 20px;
        margin-bottom: 20px;
    }

    .dash-aside-navbar .user-avatar {
        margin: 0 auto 10px auto;
        border: 3px solid #009A9A; /* Accent color border */
    }

    .dash-aside-navbar .user-avatar img {
        width: 70px;
        height: 70px;
        object-fit: cover;
    }

    .dash-aside-navbar .user-data h5 {
        color: #333;
        font-size: 1.1rem;
    }

    .dash-aside-navbar .user-data span {
        color: #777;
        font-size: 0.85rem;
    }

    .dasboard-main-nav {
        flex-grow: 1;
        padding: 0 20px;
    }

    .dasboard-main-nav ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .dasboard-main-nav > ul > li {
        margin-bottom: 5px;
    }

    .dasboard-main-nav > ul > li > a,
    .dasboard-main-nav .nav-link-item {
        display: flex;
        align-items: center;
        padding: 12px 15px;
        color: #555;
        font-size: 1rem;
        font-weight: 500;
        text-decoration: none;
        border-radius: 8px;
        transition: all 0.3s ease;
    }

    .dasboard-main-nav > ul > li > a i,
    .dasboard-main-nav .nav-link-item i {
        font-size: 1.1rem;
        width: 25px; /* Fixed width for icons */
        text-align: center;
        color: #777;
    }

    .dasboard-main-nav > ul > li > a:hover,
    .dasboard-main-nav .nav-link-item:hover {
        background-color: #e6f5f5; /* Light teal hover */
        color: #007a7a; /* Darker teal text */
    }

    .dasboard-main-nav > ul > li > a.active,
    .dasboard-main-nav .nav-link-item.active {
        background-color: #009A9A; /* Primary teal background */
        color: #ffffff;
        font-weight: 600;
        box-shadow: 0 4px 10px rgba(0, 154, 154, 0.2);
    }

    .dasboard-main-nav > ul > li > a.active i,
    .dasboard-main-nav .nav-link-item.active i {
        color: #ffffff;
    }

    /* Collapse/Expand Styling */
    .nav-link-item .collapse-icon {
        transition: transform 0.3s ease;
    }

    .nav-link-item.collapsed .collapse-icon {
        transform: rotate(-90deg);
    }

    .dasboard-main-nav .sub-menu {
        padding: 5px 0 5px 20px; /* Indent sub-menu items */
        margin-top: 5px;
        border-left: 2px solid #eee; /* Visual indicator for sub-menu */
    }

    .dasboard-main-nav .sub-menu li a {
        padding: 8px 15px;
        color: #666;
        font-size: 0.9rem;
        font-weight: 400;
        text-decoration: none;
        border-radius: 6px;
        transition: all 0.3s ease;
    }

    .dasboard-main-nav .sub-menu li a i {
        font-size: 0.9rem;
        width: 20px;
        text-align: center;
        color: #888;
    }

    .dasboard-main-nav .sub-menu li a:hover {
        background-color: #f0fafa;
        color: #007a7a;
    }

    .dasboard-main-nav .sub-menu li a.active {
        background-color: #e6f5f5;
        color: #007a7a;
        font-weight: 500;
    }

    .dasboard-main-nav .sub-menu li a.active i {
        color: #007a7a;
    }

    /* Profile Complete Status */
    .profile-complete-status {
        padding: 20px;
        margin-top: auto; /* Pushes it to the bottom */
    }

    .profile-complete-status .progress-value {
        font-size: 1.1rem;
        color: #009A9A;
        margin-bottom: 5px;
    }

    .profile-complete-status .progress-line {
        height: 6px;
        background-color: #e0e0e0;
        border-radius: 3px;
        overflow: hidden;
    }

    .profile-complete-status .inner-line {
        height: 100%;
        background-color: #009A9A;
        border-radius: 3px;
    }

    .profile-complete-status p {
        font-size: 0.8rem;
        color: #777;
        margin-top: 10px;
    }

    /* Logout Button */
    .logout-btn {
        display: flex;
        align-items: center;
        padding: 12px 20px;
        color: #dc3545; /* Red for logout */
        font-size: 1rem;
        font-weight: 500;
        text-decoration: none;
        border-top: 1px solid #eee;
        transition: all 0.3s ease;
    }

    .logout-btn i {
        font-size: 1.1rem;
        width: 25px;
        text-align: center;
        color: #dc3545;
    }

    .logout-btn:hover {
        background-color: #ffebeb; /* Light red hover */
        color: #c82333;
    }

    .logout-btn:hover i {
        color: #c82333;
    }

    /* Dashboard Body Content */
    .dashboard-body {
        flex-grow: 1;
        padding: 30px;
        background-color: #f0f2f5; /* Slightly darker background for content area */
    }

    /* Responsive Adjustments */
    @media (max-width: 768px) {
        .dash-aside-navbar {
            width: 100%;
            height: auto;
            position: relative;
            box-shadow: none;
            border-bottom: 1px solid #eee;
        }
        .dash-aside-navbar .logo {
            text-align: left;
        }
        .dash-aside-navbar .user-data {
            display: none; /* Hide user data on small screens */
        }
        .dasboard-main-nav {
            padding: 0 10px;
        }
        .dashboard-body {
            padding: 20px;
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
            $professor = User::where('id', Session::get('id'))->where('type', 'professor')->first();

            $student = TeacherRegistration::with('image')->where('id', Session::get('id'))->first();
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

               

                <nav class="dasboard-main-nav pt-4">
                    <ul class="style-none">
                        <li>
                            <a href="{{ route('faculity.dashboard') }}" class="d-flex w-100 align-items-center {{ isActive('faculity.dashboard') }}">
                                <i class="fas fa-tachometer-alt me-3"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>

                        <li class="nav-item-wrapper">
                            <a class="nav-link-item d-flex w-100 align-items-center collapsed {{ isActive(['faculity.dashboard', 'faculty.course.details']) ? 'active' : '' }}" data-bs-toggle="collapse" href="#courseManagement" role="button" aria-expanded="{{ isActive(['faculity.dashboard', 'faculty.course.details']) ? 'true' : 'false' }}" aria-controls="courseManagement">
                                <i class="fas fa-book-open me-3"></i>
                                <span>Course Management</span>
                                <i class="fas fa-chevron-down ms-auto collapse-icon"></i>
                            </a>
                            <div class="collapse {{ isActive(['faculity.dashboard', 'faculty.course.details']) ? 'show' : '' }}" id="courseManagement">
                                <ul class="style-none sub-menu">
                                    <li><a href="{{ route('faculity.dashboard') }}" class="d-flex w-100 align-items-center {{ isActive('faculity.dashboard') }}">
                                        <i class="fas fa-chalkboard-teacher me-3"></i>
                                        <span>My Courses</span>
                                    </a></li>
                                </ul>
                            </div>
                        </li>

                        <li class="nav-item-wrapper">
                            <a class="nav-link-item d-flex w-100 align-items-center collapsed {{ isActive(['postedAssignments', 'teacher.leave', 'faculty.leave.index']) ? 'active' : '' }}" data-bs-toggle="collapse" href="#studentManagement" role="button" aria-expanded="{{ isActive(['postedAssignments', 'teacher.leave', 'faculty.leave.index']) ? 'true' : 'false' }}" aria-controls="studentManagement">
                                <i class="fas fa-users me-3"></i>
                                <span>Student Management</span>
                                <i class="fas fa-chevron-down ms-auto collapse-icon"></i>
                            </a>
                            <div class="collapse {{ isActive(['postedAssignments', 'teacher.leave', 'faculty.leave.index']) ? 'show' : '' }}" id="studentManagement">
                                <ul class="style-none sub-menu">
                                    <li><a href="{{ route('postedAssignments') }}" class="d-flex w-100 align-items-center {{ isActive('postedAssignments') }}">
                                        <i class="fas fa-tasks me-3"></i>
                                        <span>View Assignments</span>
                                    </a></li>
                                    <li><a href="{{ route('teacher.leave') }}" class="d-flex w-100 align-items-center {{ isActive('teacher.leave') }}">
                                        <i class="fas fa-calendar-times me-3"></i>
                                        <span>Leave Requests</span>
                                    </a></li>
                                    <li><a href="{{ route('faculty.leave.index') }}" class="d-flex w-100 align-items-center {{ isActive('faculty.leave.index') }}">
                                        <i class="fas fa-file-alt me-3"></i>
                                        <span>My Applications</span>
                                    </a></li>
                                </ul>
                            </div>
                        </li>

                        <li class="nav-item-wrapper">
                            <a class="nav-link-item d-flex w-100 align-items-center collapsed {{ isActive(['teacher.change.password']) ? 'active' : '' }}" data-bs-toggle="collapse" href="#settings" role="button" aria-expanded="{{ isActive(['teacher.change.password']) ? 'true' : 'false' }}" aria-controls="settings">
                                <i class="fas fa-cog me-3"></i>
                                <span>Settings</span>
                                <i class="fas fa-chevron-down ms-auto collapse-icon"></i>
                            </a>
                            <div class="collapse {{ isActive(['teacher.change.password']) ? 'show' : '' }}" id="settings">
                                <ul class="style-none sub-menu">
                                    <li><a href="{{ route('teacher.change.password') }}" class="d-flex w-100 align-items-center {{ isActive('teacher.change.password') }}">
                                        <i class="fas fa-key me-3"></i>
                                        <span>Update Password</span>
                                    </a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </nav>
                <div class="profile-complete-status mt-5 pt-4 border-top text-center">
                    <div class="progress-value fw-500">87%</div>
                    <div class="progress-line position-relative">
                        <div class="inner-line" style="width:80%;"></div>
                    </div>
                    <p>Profile Complete</p>
                </div>

                <a href="{{ route('logout') }}" class="d-flex w-100 align-items-center logout-btn">
                    <i class="fas fa-sign-out-alt me-3"></i>
                    <span>Logout</span>
                </a>
            </div>
        </aside>

        <div class="dashboard-body">
            <div class="position-relative">
