<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Punjab Global University Portal - Modern educational platform for students, faculty, and administrators.">
    <meta name="keywords" content="university, portal, student, faculty, education, Punjab Global">
    <title>Punjab Global University Portal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        html {
            zoom: 0.90;
        }
        body {
            font-family: 'Inter', sans-serif;
            line-height: 1.6;
            color: #374151;
        }
        .navbar {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }
        .hero-section {
            background: linear-gradient(135deg, #2E7D32 0%, #4CAF50 30%, #81C784 70%, #A5D6A7 100%);
            color: white;
            padding: 140px 0;
            position: relative;
            overflow: hidden;
            min-height: 100vh;
            display: flex;
            align-items: center;
        }
        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="2" fill="rgba(255,255,255,0.05)"/><circle cx="75" cy="75" r="3" fill="rgba(255,255,255,0.03)"/><circle cx="50" cy="10" r="1.5" fill="rgba(255,255,255,0.04)"/><circle cx="90" cy="40" r="2.5" fill="rgba(255,255,255,0.02)"/><circle cx="10" cy="80" r="1" fill="rgba(255,255,255,0.03)"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>') repeat;
            opacity: 0.6;
            animation: float 20s ease-in-out infinite;
        }
        .hero-section::after {
            content: '';
            position: absolute;
            top: 10%;
            left: 10%;
            width: 200px;
            height: 200px;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
            border-radius: 50%;
            animation: pulse 4s ease-in-out infinite;
        }
        .hero-section .container {
            position: relative;
            z-index: 2;
        }
        .hero-title {
            font-size: 4.5rem;
            font-weight: 800;
            margin-bottom: 32px;
            line-height: 1.1;
            text-shadow: 0 4px 8px rgba(0,0,0,0.3);
            animation: fadeInUp 1s ease-out;
        }
        .hero-subtitle {
            font-size: 1.375rem;
            margin-bottom: 56px;
            max-width: 700px;
            margin-left: auto;
            margin-right: auto;
            opacity: 0.95;
            animation: fadeInUp 1s ease-out 0.2s both;
        }
        .hero-badges {
            display: flex;
            justify-content: center;
            margin-bottom: 48px;
            animation: fadeInUp 1s ease-out 0.4s both;
        }
        .badge-premium {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 0.875rem;
            font-weight: 600;
            margin: 0 8px;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
        .btn-primary-custom {
            background: linear-gradient(135deg, #1F2937 0%, #374151 100%);
            border: none;
            color: white;
            padding: 18px 36px;
            font-size: 1.125rem;
            font-weight: 600;
            border-radius: 12px;
            margin: 8px;
            transition: all 0.3s ease;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            position: relative;
            overflow: hidden;
            animation: fadeInUp 1s ease-out 0.6s both;
        }
        .btn-primary-custom::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s;
        }
        .btn-primary-custom:hover::before {
            left: 100%;
        }
        .btn-primary-custom:hover {
            background: linear-gradient(135deg, #111827 0%, #1F2937 100%);
            transform: translateY(-3px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.3);
        }
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }
        @keyframes pulse {
            0%, 100% { transform: scale(1); opacity: 0.5; }
            50% { transform: scale(1.1); opacity: 0.8; }
        }
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .features-section {
            padding: 96px 0;
            background: #F9FAFB;
        }
        .feature-card {
            background: white;
            padding: 48px 32px;
            border-radius: 16px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            text-align: center;
            margin-bottom: 32px;
        }
        .feature-card:hover {
            transform: scale(1.05);
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
        }
        .feature-icon {
            font-size: 3rem;
            color: #2E7D32;
            margin-bottom: 24px;
        }
        .about-section {
            padding: 96px 0;
            background: white;
        }
        .about-image img {
            width: 100%;
            border-radius: 16px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .cta-section {
            background: linear-gradient(135deg, #2E7D32 0%, #4CAF50 100%);
            color: white;
            padding: 96px 0;
            text-align: center;
        }
        .cta-title {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 24px;
        }
        .footer {
            background: #1F2937;
            color: #9CA3AF;
            padding: 64px 0 32px;
        }
        .footer h5 {
            color: white;
            margin-bottom: 24px;
        }
        .footer a {
            color: #9CA3AF;
            text-decoration: none;
            transition: color 0.3s ease;
        }
        .footer a:hover {
            color: white;
        }
        .social-icons a {
            color: #9CA3AF;
            font-size: 1.5rem;
            margin-right: 16px;
            transition: color 0.3s ease;
        }
        .social-icons a:hover {
            color: #2E7D32;
        }
        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.5rem;
            }
            .hero-subtitle {
                font-size: 1rem;
            }
            .btn-primary-custom {
                padding: 12px 24px;
                font-size: 1rem;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top">
        <div class="container">
            <a class="navbar-brand fw-bold text-dark" href="#">
                <i class="fas fa-university me-2 text-success"></i>Punjab Global University
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#features">Features</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-primary-custom ms-3" data-bs-toggle="modal" data-bs-target="#loginModal">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10 text-center">
                    <div class="hero-badges">
                        <span class="badge-premium"><i class="fas fa-star me-1"></i>Premium Platform</span>
                        <span class="badge-premium"><i class="fas fa-shield-alt me-1"></i>Secure & Reliable</span>
                        <span class="badge-premium"><i class="fas fa-users me-1"></i>1M+ Users</span>
                    </div>
                    <h1 class="hero-title">Empowering Education Through Innovation</h1>
                    <p class="hero-subtitle">Access comprehensive academic resources, connect with faculty, and streamline your educational journey with our modern university portal designed for excellence.</p>
                    @if ($errors->any())
                        <div class="alert alert-danger mt-4">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="d-flex flex-wrap justify-content-center">
                        <a href="#" class="btn btn-primary-custom" data-bs-toggle="modal" data-bs-target="#loginModal" data-role="student">
                            <i class="fas fa-user-graduate me-2"></i>Student Login
                        </a>
                        <a href="#" class="btn btn-primary-custom" data-bs-toggle="modal" data-bs-target="#loginModal" data-role="professor">
                            <i class="fas fa-chalkboard-teacher me-2"></i>Faculty Login
                        </a>
                        <a href="#" class="btn btn-primary-custom" data-bs-toggle="modal" data-bs-target="#loginModal" data-role="admin">
                            <i class="fas fa-cog me-2"></i>Admin Login
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="features-section">
        <div class="container">
            <div class="row justify-content-center mb-5">
                <div class="col-lg-6 text-center">
                    <h2 class="fw-bold text-dark mb-3">Why Choose Our Platform?</h2>
                    <p class="text-muted">Discover the features that make our university portal the preferred choice for modern education.</p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-book-open"></i>
                        </div>
                        <h4 class="fw-semibold mb-3">Comprehensive Resources</h4>
                        <p class="text-muted">Access a vast library of academic materials, research papers, and educational tools tailored for your needs.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <h4 class="fw-semibold mb-3">Collaborative Learning</h4>
                        <p class="text-muted">Connect with peers and faculty through integrated communication tools and group study features.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <h4 class="fw-semibold mb-3">Secure & Reliable</h4>
                        <p class="text-muted">Enjoy peace of mind with our advanced security measures and 99.9% uptime guarantee.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="about-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h2 class="fw-bold text-dark mb-4">About Punjab Global University</h2>
                    <p class="text-muted mb-4">Punjab Global University is committed to providing world-class education and fostering innovation. Our portal serves as a digital hub for students, faculty, and administrators to streamline academic processes and enhance learning experiences.</p>
                    <p class="text-muted">With cutting-edge technology and user-centric design, we ensure that every user has the tools they need to succeed in their academic journey.</p>
                </div>
                <div class="col-lg-6 mt-4 mt-lg-0">
                    <div class="about-image">
                        <img src="https://source.unsplash.com/600x400/?university,students" alt="University Campus" loading="lazy">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 text-center">
                    <h2 class="cta-title">Ready to Get Started?</h2>
                    <p class="mb-4 opacity-75">Join thousands of students and faculty members who trust our platform for their academic needs.</p>
                    <a href="#" class="btn btn-light btn-lg px-5 py-3 fw-semibold" data-bs-toggle="modal" data-bs-target="#loginModal" data-role="student">
                        <i class="fas fa-sign-in-alt me-2"></i>Login Now
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 mb-4">
                    <h5>Punjab Global University</h5>
                    <p class="mb-3">Empowering education through innovation and technology.</p>
                    <div class="social-icons">
                        <a href="#"><i class="fab fa-facebook"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-linkedin"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <h5>Quick Links</h5>
                    <ul class="list-unstyled">
                        <li><a href="#features">Features</a></li>
                        <li><a href="#about">About</a></li>
                        <li><a href="#contact">Contact</a></li>
                        <li><a href="#">Support</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <h5>Resources</h5>
                    <ul class="list-unstyled">
                        <li><a href="#">Student Handbook</a></li>
                        <li><a href="#">Faculty Guide</a></li>
                        <li><a href="#">Academic Calendar</a></li>
                        <li><a href="#">Library</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <h5>Contact Us</h5>
                    <p class="mb-2"><i class="fas fa-map-marker-alt me-2"></i>123 University Road, Punjab</p>
                    <p class="mb-2"><i class="fas fa-phone me-2"></i>+1 (555) 123-4567</p>
                    <p class="mb-0"><i class="fas fa-envelope me-2"></i>info@punjabglobal.edu</p>
                </div>
            </div>
            <hr class="my-4">
            <div class="row">
                <div class="col-12 text-center">
                    <p class="mb-0">&copy; 2024 Punjab Global University. All rights reserved.</p>
                </div>
            </div>
        </div>
    </footer>

    <script>
        // Set user role in login modal
        document.querySelectorAll('[data-bs-toggle="modal"]').forEach(button => {
            button.addEventListener('click', function() {
                const role = this.getAttribute('data-role');
                if (role) {
                    document.getElementById('requested_type').value = role;
                    console.log('Role set to:', role);
                }
            });
        });

        // Smooth scrolling
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Navbar active state
        window.addEventListener('scroll', function() {
            const sections = document.querySelectorAll('section[id]');
            const navLinks = document.querySelectorAll('.navbar-nav .nav-link');

            sections.forEach(section => {
                const rect = section.getBoundingClientRect();
                if (rect.top <= 100 && rect.bottom >= 100) {
                    navLinks.forEach(link => {
                        link.classList.remove('active');
                        if (link.getAttribute('href') === '#' + section.id) {
                            link.classList.add('active');
                        }
                    });
                }
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <x-loginmodel />
</body>
</html>
