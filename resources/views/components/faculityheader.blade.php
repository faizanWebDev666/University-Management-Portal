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

    @endphp
    <div class="main-page-wrapper">
        <aside class="dash-aside-navbar">
            <div class="position-relative">
                <div class="logo text-md-center d-md-block d-flex align-items-center justify-content-between">
                    <a href="candidate-dashboard-index.html">
                        <img src="frontend/images/logo/logo_01_whitebg.png" alt="">
                    </a>
                    <button class="close-btn d-block d-md-none"><i class="bi bi-x-lg"></i></button>
                </div>

                <div class="user-data">
                    <div class="user-name-data">
                        @if ($student && $student->image)
                            <img src="{{ asset('storage/' . $student->image->image_path) }}" alt="Student Image"
                                style="height: 110px; border-radius: 15px; display: block; margin: 0 auto;">
                        @else
                            <img src="{{ asset('frontend/images/Person.png') }}" alt="Default Student Image"
                                style="height: 110px; border-radius: 15px; display: block; margin: 0 auto;">
                        @endif
                        <button class="user-name dropdown-toggle" type="button" id="profile-dropdown"
                            data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                            {{ $professor->name ?? 'Professor' }}
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="profile-dropdown">
                            <li>
                                <a class="dropdown-item d-flex align-items-center"
                                    href="candidate-dashboard-profile.html"><img
                                        src="../backend_faculity/images/lazy.svg"
                                        data-src="backend_faculity/images/icon/icon_23.svg" alt=""
                                        class="lazy-img"><span class="ms-2 ps-1">Profile</span></a>
                            </li>
                            <li>
                                <a class="dropdown-item d-flex align-items-center"
                                    href="candidate-dashboard-settings.html"><img
                                        src="../backend_faculity/images/lazy.svg"
                                        data-src="backend_faculity/images/icon/icon_24.svg" alt=""
                                        class="lazy-img"><span class="ms-2 ps-1">Account Settings</span></a>
                            </li>
                            <li>
                                <a class="dropdown-item d-flex align-items-center" href="#"><img
                                        src="../backend_faculity/images/lazy.svg"
                                        data-src="backend_faculity/images/icon/icon_25.svg" alt=""
                                        class="lazy-img"><span class="ms-2 ps-1">Notification</span></a>
                            </li>
                        </ul>
                    </div>
                </div>

                <nav class="dasboard-main-nav">
                    <ul class="style-none">
                        <li><a href="{{ route('faculity.dashboard') }}" class="d-flex w-100 align-items-center active">
                                <img src="../backend_faculity/images/lazy.svg"
                                    data-src="backend_faculity/images/icon/icon_1_active.svg" alt=""
                                    class="lazy-img">
                                <span>Dashboard</span>
                            </a></li>
                        <li><a href="{{ route('Students_Attendence') }}" class="d-flex w-100 align-items-center">
                                <img src="../backend_faculity/images/lazy.svg"
                                    data-src="backend_faculity/images/icon/icon_2.svg" alt="" class="lazy-img">
                                <span>Upload Attendence</span>
                            </a></li>
                        <li><a href="{{ route('Upload.assignments') }}" class="d-flex w-100 align-items-center">
                                <img src="../backend_faculity/images/lazy.svg"
                                    data-src="backend_faculity/images/icon/icon_2.svg" alt=""
                                    class="lazy-img">
                                <span>Upload Assignments</span>
                            </a></li>
                        <li><a href="{{ ROUTE('Upload.Quizzes') }}" class="d-flex w-100 align-items-center">
                                <img src="../backend_faculity/images/lazy.svg"
                                    data-src="backend_faculity/images/icon/icon_2.svg" alt=""
                                    class="lazy-img">
                                <span>Upload Quizzes</span>
                            </a></li>
                        <li>
                            <a href="{{ route('teacher.assignments.list') }}"
                                class="d-flex w-100 align-items-center">
                                <img src="../backend_faculity/images/lazy.svg"
                                    data-src="backend_faculity/images/icon/icon_2.svg" alt=""
                                    class="lazy-img">
                                <span>View Assignments</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('teacher.leave') }}" class="d-flex w-100 align-items-center">
                                <img src="../backend_faculity/images/lazy.svg"
                                    data-src="backend_faculity/images/icon/icon_2.svg" alt=""
                                    class="lazy-img">
                                <span>leave Request</span>
                            </a>
                        </li>
                        <li><a href="{{ route('faculty.leave.index') }}" class="d-flex w-100 align-items-center">
                                <img src="../backend_faculity/images/lazy.svg"
                                    data-src="backend_faculity/images/icon/icon_2.svg" alt=""
                                    class="lazy-img">
                                <span>My Applications</span>
                            </a></li>

                        <li><a href="candidate-dashboard-profile.html" class="d-flex w-100 align-items-center">
                                <img src="../backend_faculity/images/lazy.svg"
                                    data-src="backend_faculity/images/icon/icon_2.svg" alt=""
                                    class="lazy-img">
                                <span>Upload Marks</span>
                            </a></li>
                    </ul>
                </nav>
                <div class="profile-complete-status">
                    <div class="progress-value fw-500">87%</div>
                    <div class="progress-line position-relative">
                        <div class="inner-line" style="width:80%;"></div>
                    </div>
                    <p>Profile Complete</p>
                </div>

                <a href="{{ route('logout') }}" class="d-flex w-100 align-items-center logout-btn">
                    <img src="../backend_faculity/images/lazy.svg" data-src="backend_faculity/images/icon/icon_9.svg"
                        alt="" class="lazy-img">
                    <span>Logout</span>
                </a>
            </div>
        </aside>

        <div class="dashboard-body">
            <div class="position-relative">
