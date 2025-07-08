<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="keywords" content="Digital marketing agency, Digital marketing company, Digital marketing services">
    <meta name="description" content="Jobi is a beautiful website template designed for job board websites.">
    <meta property="og:site_name" content="Jano">
    <meta property="og:url" content="https://creativegigstf.com/">
    <meta property="og:type" content="website">
    <meta property="og:title" content="Portal">
    <meta name='og:image' content='frontend/images/assets/ogg.png'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#244034">
    <meta name="msapplication-navbutton-color" content="#244034">
    <meta name="apple-mobile-web-app-status-bar-style" content="#244034">
    <title>LMS Portal</title>
    <link rel="icon" type="image/png" sizes="56x56" href="frontend/images/icon/icon.png">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('frontend/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('frontend/css/style.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('frontend/css/responsive.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

     <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
        }

        .top-bar {
            background-color: #009999;
            color: white;
            text-align: center;
            padding: 10px;
            font-size: 20px;
            font-weight: bold;
        }

        .nav-container {
            background-color: black;
            color: white;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            padding: 15px 20px;
            gap: 10px;
        }

        .university-info {
            display: flex;
            align-items: center;
            gap: 15px;
            flex-shrink: 0;
        }

        .university-info img {
            height: 90px;
        }

        .university-info .text {
            font-size: 22px;
            font-weight: bold;
            line-height: 1.2;
        }

        .nav-links {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 10px;
            flex-grow: 1;
        }

       .nav-btn {
    background: white;
    color: black;
    text-align: center;
    border-radius: 6px;
    padding: 6px 10px;
    text-decoration: none;
    font-weight: 500;
    font-size: 13px;
    min-width: 80px;
    transition: background 0.3s;
}

.nav-btn i {
    display: block;
    font-size: 16px;
    margin-bottom: 4px;
}


        .nav-btn:hover {
            background: #e0e0e0;
        }

        

        .student-image {
            flex-shrink: 0;
        }

         .student-image img {
        height: 70px;
        width: 70px;
        object-fit: cover;
        border-radius: 10px;
        margin-left: 15px;
    }

        /* Responsive behavior */
        @media (max-width: 768px) {
            .nav-btn {
                padding: 8px 10px;
                font-size: 14px;
                min-width: 90px;
            }

            .nav-btn i {
                font-size: 18px;
            }

            .university-info .text {
                font-size: 18px;
            }
        }
    </style>
</head>

<body>
    <div class="main-page-wrapper">
        @php
            use Illuminate\Support\Facades\Session;
            use App\Models\StudentsRegistration;

            $student = null;
            if (Session::has('id')) {
                $student = StudentsRegistration::with('image')->where('user_id', Session::get('id'))->first();
            }
        @endphp


    <!-- Top Welcome Bar -->
    <div class="top-bar">
       Welcome: {{ $student->session }} {{ $student->degree_program }}{{ $student->department }}-{{ $student->roll_no }}
    </div>

    <!-- Main Navigation Container -->
    <div class="nav-container">
        
        <!-- University Logo & Name -->
        <div class="university-info">
            <img src="{{ asset('frontend/images/logo/logo_01.png') }}" alt="University Logo">
            <div class="text">
                University Of<br>Albourne
            </div>
        </div>

        <!-- Navigation Links -->
        <div class="nav-links">
            <a href="{{ route('Students.dashboard') }}" class="nav-btn">
                <i class="fas fa-home"></i>Dashboard
            </a>
            <a href="{{ route('Student.offerCourses') }}" class="nav-btn">
                <i class="fas fa-id-card"></i>Registration Card
            </a>
            <a href="{{ route('quizzes.list') }}" class="nav-btn">
                <i class="fas fa-list-alt"></i>Quizzes
            </a>
            <a href="#" class="nav-btn">
                <i class="fas fa-money-bill-wave"></i>Fees
            </a>
            <a href="#" class="nav-btn">
                <i class="fas fa-chart-bar"></i>Result Card
            </a>
            <a href="{{ route('assignments.student') }}" class="nav-btn">
                <i class="fas fa-user"></i>Assignments
            </a>
            <a href="{{ route('logout') }}" class="nav-btn">
                <i class="fas fa-sign-out-alt"></i>Logout
            </a>
        </div>

        <!-- Student Image -->
        <div class="student-image">
            @if ($student && $student->image)
                <img src="{{ Storage::url($student->image->image_path) }}" alt="Student Image">
            @else
                <img src="{{ asset('frontend/images/Person.png') }}" alt="Default Student Image">
            @endif
        </div>

    </div>

</body>
</html>