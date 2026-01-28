<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>University Portal</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

  <style>
    :root {
      --primary-color: #2e5a3e;
      --primary-hover: #21442d;
    }

    body {
      font-family: "Segoe UI", sans-serif;
      background: #f4f6f9;
      color: #333;
      position: relative;
      z-index: 1;
    }

    /* Watermark Background */
    body::before {
      content: "";
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: url("{{ asset('frontend/images/logo/logo_01_whitebg.jpg') }}") no-repeat center center;
      background-size: contain;
      opacity: 0.08;
      z-index: -1;
    }

    /* Navbar */
    .navbar {
      background: white;
      padding: 15px 0;
      box-shadow: 0 2px 6px rgba(0,0,0,0.08);
    }

    .navbar-brand {
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .navbar-brand img {
      height: 45px;
    }

    .navbar-nav .nav-link {
      color: #333 !important;
      font-weight: 600;
      margin-left: 25px;
      font-size: 1rem;
      transition: 0.3s;
    }

    .navbar-nav .nav-link:hover {
      color: var(--primary-color) !important;
    }

    /* Hero Section */
    .hero-section {
      padding: 120px 20px 80px;
      background: linear-gradient(135deg, rgba(46,90,62,0.9), rgba(33,68,45,0.9));
      color: white;
      text-align: center;
      border-radius: 0 0 50px 50px;
      margin-bottom: 50px;
    }

    .hero-section h1 {
      font-weight: 800;
      font-size: 3rem;
      margin-bottom: 15px;
    }

    .hero-section p {
      font-size: 1.2rem;
      margin-bottom: 30px;
      opacity: 0.95;
    }

    .hero-section .btn-custom {
      background: white;
      color: var(--primary-color);
      font-weight: 600;
      border-radius: 10px;
      padding: 14px 30px;
      font-size: 1.1rem;
      transition: 0.3s;
      margin: 10px;
    }

    .hero-section .btn-custom:hover {
      background: var(--primary-hover);
      color: white;
    }

    /* Footer */
    footer {
      margin-top: 80px;
      background: var(--primary-color);
      color: white;
      text-align: center;
      padding: 22px 0;
      font-size: 0.95rem;
      border-radius: 30px 30px 0 0;
    }

    /* Keep Modals Same but Polished */
    .modal-content {
      border: none;
      border-radius: 18px;
      background: #fff;
      box-shadow: 0 10px 40px rgba(0,0,0,0.15);
      padding: 20px;
    }
  </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg sticky-top">
  <div class="container">
    <a class="navbar-brand" href="#">
      <img src="{{ asset('frontend/images/logo/logo_01_whitebg.png') }}" alt="Albourne University">
      <span class="fw-bold text-dark">Punjab Global University</span>
    </a>
    <div class="collapse navbar-collapse justify-content-end">
      <ul class="navbar-nav">
        <li class="nav-item"><a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#loginModal">Login</a></li>
        <li class="nav-item"><a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#signupModal">Register</a></li>
      </ul>
    </div>
  </div>
</nav>

<!-- Hero Section -->
<section class="hero-section">
  <div class="container">
    <h1>Welcome to Punjab Global University Portal</h1>
    <p>Your gateway to academic resources, student services, and faculty tools.</p>
    <div>
      <!-- Replaced cards with clean login buttons -->
     <a href="#" class="btn btn-custom" data-bs-toggle="modal" data-bs-target="#loginModal" data-role="student">Student Login</a>
<a href="#" class="btn btn-custom" data-bs-toggle="modal" data-bs-target="#loginModal" data-role="professor">Faculty Login</a>
<a href="#" class="btn btn-custom" data-bs-toggle="modal" data-bs-target="#loginModal" data-role="registrationoffice">Registration Office</a>
<a href="#" class="btn btn-custom" data-bs-toggle="modal" data-bs-target="#loginModal" data-role="admin">Admin / HOD</a>

  </div>
</section>
<script>
  document.querySelectorAll('[data-bs-toggle="modal"]').forEach(button => {
    button.addEventListener('click', function () {
      const role = this.getAttribute('data-role');
      document.getElementById('requested_type').value = role;
      console.log('Role set to:', role); // ✅ DEBUG LINE
    });
  });
</script>

<!-- Login Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-hidden="true">
 <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content border-0 shadow-lg rounded-4 p-4">
      
      <!-- Close Button -->
      <button type="button" class="btn-close ms-auto" data-bs-dismiss="modal" aria-label="Close"></button>
      
      <!-- Header -->
      <div class="text-center mb-4">
        <h4 class="fw-bold text-dark">Welcome Back 👋</h4>
        <p class="text-muted small">Login to continue to your account</p>
      </div>
      
      <!-- Form -->
      <form action="{{ route('loginUser') }}" method="POST">
        @csrf
        <div class="mb-3">
          <label class="form-label fw-semibold">Email Address</label>
          <input type="email" class="form-control rounded-3 shadow-sm" name="email" placeholder="you@example.com" required>
        </div>
        <input type="hidden" name="requested_type" id="requested_type" value="">

        <div class="mb-3 position-relative">
          <label class="form-label fw-semibold">Password</label>
          <input type="password" class="form-control rounded-3 shadow-sm" id="loginPassword" name="password" placeholder="Enter your password" required>
          <span class="position-absolute top-50 end-0 translate-middle-y me-3 text-muted" id="toggleLoginPassword" style="cursor:pointer;">
            <i class="bi bi-eye-slash-fill"></i>
          </span>
        </div>
        
        @php
          use Anhskohbo\NoCaptcha\Facades\NoCaptcha;
        @endphp
        <div class="mt-3">
          {!! NoCaptcha::renderJs() !!}
          {!! NoCaptcha::display() !!}
          <small class="text-danger">
            @error('g-recaptcha-response') {{ $message }} @enderror
          </small>
        </div>
        
        <div class="d-grid mt-4">
          <button class="btn btn-custom fw-semibold rounded-3 py-2">Login</button>
        </div>
      </form>
      
      <div class="text-center mt-3">
        <a href="#" class="small text-decoration-none">Forgot Password?</a>
        <p class="mt-2 mb-0 small">Don’t have an account? 
          <a href="" class="fw-semibold">Sign Up</a>
        </p>
      </div>
    </div>
  </div>
</div>

<!-- Signup Modal -->
<div class="modal fade" id="signupModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0 shadow rounded-4 p-4">
      <button type="button" class="btn-close ms-auto mb-2" data-bs-dismiss="modal" aria-label="Close"></button>
      <div class="text-center mb-3">
        <h4 class="fw-bold text-dark">Create Account</h4>
        <p class="text-muted small">Register to access university services</p>
      </div>
      <form action="{{ URL::to('registerUser') }}" method="POST">
        @csrf
        <div class="mb-3">
          <label class="form-label">Name*</label>
          <input type="text" class="form-control rounded-3" name="name" placeholder="Enter full name">
        </div>
        <div class="mb-3">
          <label class="form-label">Email*</label>
          <input type="email" class="form-control rounded-3" name="email" placeholder="Enter email">
        </div>
        <div class="mb-3 position-relative">
          <label class="form-label">Password*</label>
          <input type="password" class="form-control rounded-3" id="signupPassword" name="password" placeholder="Enter password">
          <span class="position-absolute top-50 end-0 translate-middle-y me-3 text-muted" id="toggleSignupPassword" style="cursor:pointer;">
            <i class="bi bi-eye-slash-fill"></i>
          </span>
        </div>
        <button class="btn w-100 fw-semibold rounded-3" style="background:#2e5a3e; color:white;">Sign Up</button>
      </form>
    </div>
  </div>
</div>

<!-- Password Toggle Script -->
<script>
  function togglePassword(inputId, toggleId) {
    const input = document.getElementById(inputId);
    const toggle = document.getElementById(toggleId);
    toggle.addEventListener("click", () => {
      const type = input.type === "password" ? "text" : "password";
      input.type = type;
      toggle.innerHTML = type === "password" 
        ? '<i class="bi bi-eye-slash-fill"></i>' 
        : '<i class="bi bi-eye-fill"></i>';
    });
  }
  togglePassword("loginPassword", "toggleLoginPassword");
  togglePassword("signupPassword", "toggleSignupPassword");
</script>

<!-- Footer -->
<footer>
  <p>© 2025 Punjab Global University Portal - All Rights Reserved</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
