<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Choose Correct Role</title>
    <link rel="stylesheet" type="text/css" href="frontend/css/bootstrap.min.css" media="all">
    <link rel="stylesheet" type="text/css" href="frontend/css/style.min.css" media="all">
    <link rel="stylesheet" type="text/css" href="frontend/css/responsive.css" media="all">
    <link rel="icon" type="image/png" sizes="56x56" href="frontend/images/icon/icon.png">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #eef8f3;
            font-family: 'Segoe UI', sans-serif;
            color: #1e1e1e;
        }

        .header {
            background-color: black;
            color: white;
            padding: 20px;
        }

        .logo {
            height: 100px;
        }

        .section-title {
            font-weight: bold;
            font-size: 1.8rem;
        }

        .console-card {
            background-color: #ffffff;
            border: 1px solid #e0e0e0;
            transition: 0.3s;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
            color: #1e1e1e;
        }

        .console-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.08);
        }

        .console-card div:first-child {
            font-size: 2rem;
        }

        .console-card div:last-child {
            font-weight: 500;
            margin-top: 10px;
        }

        .rounded-card-img {
            border-radius: 12px;
        }

        a.console-link {
            text-decoration: none;
            color: inherit;
        }
    </style>
</head>

<body>

    <!-- Header -->
    <div class="header d-flex align-items-center justify-content-between px-5">
        <img src="frontend/images/logo/logo_01.png" class="logo" alt="COMSATS Logo">
        <div>
            <h2 class="m-0">UNIVERSITY Of ALBOURNE</h2>
            <h4 class="m-0">LMS - Learning Management System</h4>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container py-5">
        <div class="row mb-4">
            <!-- Left Sidebar -->
          <div class="col-md-3">
    <h4 class="section-title">Campus Information</h4>
    <div class="border rounded p-3 shadow-sm">
        <p class="small text-muted text-justify">
            This institution operates as a recognized degree-awarding university, offering quality education and fostering academic growth. It provides a broad range of programs designed to support student development, research innovation, and community advancement.
        </p>
    </div>
</div>


            <!-- Middle Console -->
            <div class="col-md-6">
                <h4 class="section-title mb-3">The University Portal</h4>
                <div class="row row-cols-3 g-3">
                    <!-- Repeatable console cards -->
                    <div class="col">
                        <a href="#" class="console-link" data-bs-toggle="modal" data-bs-target="#loginModal">
                            <div class="card console-card text-center p-3">
                                <div>👨‍🎓</div>
                                <div>Student/Parent Console</div>
                            </div>
                        </a>
                    </div>
                    <div class="col">
                        <a href="#" class="console-link" data-bs-toggle="modal" data-bs-target="#loginModal">
                            <div class="card console-card text-center p-3">
                                <div>👨‍🏫</div>
                                <div>Faculty Console</div>
                            </div>
                        </a>
                    </div>
                    <div class="col">
                        <a href="#" class="console-link" data-bs-toggle="modal" data-bs-target="#loginModal">
                            <div class="card console-card text-center p-3">
                                <div>💰</div>
                                <div>Student Fee</div>
                            </div>
                        </a>
                    </div>
                    <div class="col">
                        <a href="{{ route('Admin.Dashboard') }}" class="console-link">
                            <div class="card console-card text-center p-3">
                                <div>🌐</div>
                                <div>HOD/Coordinator</div>
                            </div>
                        </a>
                    </div>
                    <div class="col">
                        <a href="#" class="console-link" data-bs-toggle="modal" data-bs-target="#loginModal">
                            <div class="card console-card text-center p-3">
                                <div>📚</div>
                                <div>Academic Console</div>
                            </div>
                        </a>
                    </div>
                    <div class="col">
                        <a href="#" class="console-link" data-bs-toggle="modal" data-bs-target="#loginModal">
                            <div class="card console-card text-center p-3">
                                <div>📝</div>
                                <div>Exam Console</div>
                            </div>
                        </a>
                    </div>
                    <div class="col">
                        <a href="#" class="console-link" data-bs-toggle="modal" data-bs-target="#loginModal">
                            <div class="card console-card text-center p-3">
                                <div>👥</div>
                                <div>Coordinator Console</div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Right Info Card -->
         <div class="col-md-3">
    <img src="frontend/images/university.jpg" class="img-fluid rounded mb-2" />
    <h4 class="section-title">University Overview</h4>
    <p style="text-align: justify;">
        This university is committed to promoting academic excellence, innovation, and research. With a focus on student development and community engagement, it offers diverse programs designed to equip students with the skills and knowledge needed for future success.
    </p>
</div>

        </div>

        <!-- Intro Section -->
     <div>
    <h4 class="section-title">Online Portal Introduction</h4>
    <p>
        The university's online portal is designed to automate key academic and administrative processes under a unified system. It provides a secure, web-based platform with anytime/anywhere access, supporting efficient management and enhanced user experience for students, faculty, and staff.
    </p>
</div>


    <!-- signup Modal -->
    <div class="modal fade" id="signupModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen modal-dialog-centered">
            <div class="container">
                <div class="user-data-form modal-content">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                    <div class="form-wrapper m-auto">

                        <form action="{{ URL::to('registerUser') }}" class="mt-10" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="input-group-meta position-relative mb-25">
                                        <label>Name*</label>
                                        <input type="name" name="name" placeholder="">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="input-group-meta position-relative mb-25">
                                        <label>Email*</label>
                                        <input type="email" name="email" placeholder="rshdkabir@gmail.com">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="input-group-meta position-relative mb-20">
                                        <label>Password*</label>
                                        <input type="password" name="password" placeholder="Enter Password"
                                            class="pass_log_id">
                                        <span class="placeholder_icon"><span class="passVicon"><img
                                                    src="frontend/images/icon/icon_60.svg"
                                                    alt=""></span></span>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="agreement-checkbox d-flex justify-content-between align-items-center">
                                        <div>
                                            <input type="checkbox" id="remember">
                                            <label for="remember">Keep me logged in</label>
                                        </div>
                                        <a href="#">Forget Password?</a>
                                    </div> <!-- /.agreement-checkbox -->
                                </div>
                                <div class="col-12">
                                    <button class="btn-eleven fw-500 tran3s d-block mt-20">Register</button>
                                </div>
                            </div>
                        </form>
                        <div class="d-flex align-items-center mt-30 mb-10">
                            <div class="line"></div>
                            <span class="pe-3 ps-3">OR</span>
                            <div class="line"></div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <a href="#"
                                    class="social-use-btn d-flex align-items-center justify-content-center tran3s w-100 mt-10">
                                    <img src="frontend/images/icon/google.png" alt="">
                                    <span class="ps-2">Login with Google</span>
                                </a>
                            </div>
                            <div class="col-md-6">
                                <a href="#"
                                    class="social-use-btn d-flex align-items-center justify-content-center tran3s w-100 mt-10">
                                    <img src="frontend/images/icon/facebook.png" alt="">
                                    <span class="ps-2">Login with Facebook</span>
                                </a>
                            </div>
                        </div>
                        <p class="text-center mt-10">Don't have an account? <a href="signup.html" class="fw-500">Sign
                                up</a></p>
                    </div>
                    <!-- /.form-wrapper -->
                </div>
                <!-- /.user-data-form -->
            </div>
        </div>
    </div>


    <button class="scroll-top">
        <i class="bi bi-arrow-up-short"></i>
    </button>

    <div class="modal fade" id="loginModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen modal-dialog-centered">
            <div class="container">
                <div class="user-data-form modal-content">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="text-center">
                        <h2>Hi, Welcome Back!</h2>
                       
                    </div>
                    <div class="form-wrapper m-auto">
                        <form action="{{route('loginUser')}}" class="mt-10" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="input-group-meta position-relative mb-25">
                                        <label>Email*</label>
                                        <input type="email" name="email" placeholder="rshdkabir@gmail.com">
                                    </div>
                                </div>
                                <div class="col-12">
    <div class="input-group-meta position-relative mb-20">
        <label>Password*</label>
        <input type="password" name="password" placeholder="Enter Password"
               class="pass_log_id" id="passwordInput">
        <span class="placeholder_icon" id="togglePassword" style="cursor: pointer;">
            <span class="passVicon">
                <img src="frontend/images/icon/icon_60.svg" alt="Toggle visibility" id="eyeIcon">
            </span>
        </span>
    </div>
</div>



                                @php
                                    use Anhskohbo\NoCaptcha\Facades\NoCaptcha;
                                @endphp

                                <!-- reCAPTCHA -->
                                <div class="mt-4">
                                    {!! NoCaptcha::renderJs() !!}
                                    {!! NoCaptcha::display() !!}
                                    <span style="color: red;">
                                        @error('g-recaptcha-response')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                             
                                <div class="col-12">
                                    <button class="btn-eleven fw-500 tran3s d-block mt-20">Login</button>
                                </div>
                            </div>
                        </form>
                        
                    </div>
                    <!-- /.form-wrapper -->
                </div>
                <!-- /.user-data-form -->
            </div>
        </div>
    </div>


    <button class="scroll-top">
        <i class="bi bi-arrow-up-short"></i>
    </button>

<script>
    const togglePassword = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('passwordInput');
    const eyeIcon = document.getElementById('eyeIcon');

    togglePassword.addEventListener('click', function () {
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);

       
    });
</script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>


