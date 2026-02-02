<style>
    :root {
        --pgu-green-light: #2e5a3e;
        --pgu-green-dark: #21442d;
        --pgu-gold: #d4af37;
        --pgu-light: #f8f9fa;
        --pgu-text: #fff;
        --pgu-card-bg: #ffffff;
    }



    .navbar-brand {
        font-weight: 700;
        color: var(--pgu-green-light) !important;
    }

    .pgu-header {
        background: linear-gradient(135deg, rgba(46, 90, 62, 0.9), rgba(33, 68, 45, 0.9));
        background-size: cover;
        background-position: center;
        color: var(--pgu-text);
        padding: 80px 0 60px;
        margin-bottom: 40px;
    }

    .pgu-header h1 {
        font-weight: 700;
        margin-bottom: 20px;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
    }

    .pgu-header p {
        font-size: 1.2rem;
        max-width: 700px;
        margin: 0 auto;
    }

    .contact-card {
        background: var(--pgu-card-bg);
        border-radius: 10px;
        padding: 30px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        height: 100%;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border-top: 4px solid var(--pgu-green-light);
    }

    .contact-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }

    .contact-icon {
        font-size: 2.5rem;
        color: var(--pgu-green-light);
        margin-bottom: 20px;
    }

    .contact-form-container {
        background: var(--pgu-card-bg);
        border-radius: 10px;
        padding: 30px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
    }

    .btn-pgu {
        background-color: var(--pgu-green-light);
        color: white;
        padding: 12px 30px;
        font-weight: 600;
        border: none;
        transition: all 0.3s ease;
    }

    .btn-pgu:hover {
        background-color: var(--pgu-green-dark);
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    .form-control:focus {
        border-color: var(--pgu-green-light);
        box-shadow: 0 0 0 0.25rem rgba(46, 90, 62, 0.25);
    }

    .footer {
        background-color: var(--pgu-green-dark);
        color: white;
        padding: 40px 0 20px;
        margin-top: 60px;
    }

    .footer-links a {
        color: rgba(255, 255, 255, 0.8);
        text-decoration: none;
        transition: color 0.2s;
    }

    .footer-links a:hover {
        color: var(--pgu-gold);
        text-decoration: underline;
    }

    .social-icons a {
        display: inline-block;
        width: 40px;
        height: 40px;
        background-color: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        text-align: center;
        line-height: 40px;
        margin-right: 10px;
        color: white;
        transition: all 0.3s ease;
    }

    .social-icons a:hover {
        background-color: var(--pgu-gold);
        transform: translateY(-3px);
    }

    .department-list {
        list-style-type: none;
        padding-left: 0;
    }

    .department-list li {
        padding: 5px 0;
        border-bottom: 1px solid #eee;
    }

    .department-list li:last-child {
        border-bottom: none;
    }

    .map-container {
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
    }

    .accordion-button:not(.collapsed) {
        background-color: rgba(46, 90, 62, 0.1);
        color: var(--pgu-green-light);
        font-weight: 600;
    }

    .accordion-button:focus {
        box-shadow: 0 0 0 0.25rem rgba(46, 90, 62, 0.25);
        border-color: var(--pgu-green-light);
    }

    .status-badge {
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
    }

    .badge-open {
        background-color: rgba(40, 167, 69, 0.1);
        color: #28a745;
    }

    .badge-closed {
        background-color: rgba(220, 53, 69, 0.1);
        color: #dc3545;
    }

    .quick-contact {
        background-color: rgba(46, 90, 62, 0.05);
        border-radius: 10px;
        padding: 20px;
        margin-top: 20px;
    }
</style>

<x-indexheader />

<div class="pgu-header text-center">
    <div class="container">
        <h1>Contact Punjab Global University</h1>
        <p>We are here to help you with any inquiries about admissions, programs, campus facilities, or any other
            university-related matters. Reach out to us through any of the following channels.</p>
    </div>
</div>

<div class="container">
    <div class="row g-4 mb-5">
        <div class="col-lg-4 col-md-6">
            <div class="contact-card">
                <div class="text-center">
                    <i class="fas fa-map-marker-alt contact-icon"></i>
                    <h4>Visit Our Campus</h4>
                    <p>Global Education City, ABC Road, Lahore, Punjab 141001, Pakisatn</p>
                    <p><strong>Campus Hours:</strong> Mon-Sat: 8:00 AM - 8:00 PM</p>
                    <span class="status-badge badge-open">Currently Open</span>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6">
            <div class="contact-card">
                <div class="text-center">
                    <i class="fas fa-phone-alt contact-icon"></i>
                    <h4>Call Us</h4>
                    <p><strong>Admissions:</strong> +91-161-1234567</p>
                    <p><strong>General Inquiries:</strong> +91-161-1234568</p>
                    <p><strong>Emergency:</strong> +91-9876543210</p>
                    <p><strong>Hours:</strong> 9:00 AM - 5:00 PM (IST)</p>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-12">
            <div class="contact-card">
                <div class="text-center">
                    <i class="fas fa-envelope contact-icon"></i>
                    <h4>Email Us</h4>
                    <p><strong>Admissions:</strong> admissions@pgu.edu.in</p>
                    <p><strong>Registrar:</strong> registrar@pgu.edu.in</p>
                    <p><strong>Academic Inquiries:</strong> academics@pgu.edu.in</p>
                    <p><strong>General Info:</strong> info@pgu.edu.in</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Contact Form and Map Section -->
    <div class="row g-4 mb-5">
        <div class="col-lg-7">
            <div class="contact-form-container">
                <h3 class="mb-4">Send Us a Message</h3>
                <!-- Success Message -->
                @if (session('success'))
                    <div class="alert alert-success">
                        <ul class="mb-0">
                            <li>{{ session('success') }}</li>
                        </ul>
                    </div>
                @endif

                <!-- Error Messages -->
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form id="contactForm" action="{{ route('contact.store') }}" method="POST">
                    <div id="form-messages"></div> <!-- Success/Error messages will appear here -->
                    @csrf


                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="firstName" class="form-label">First Name *</label>
                            <input type="text" class="form-control" name="name" required>
                        </div>
                        <div class="col-md-6">
                            <label for="lastName" class="form-label">Last Name *</label>
                            <input type="text" class="form-control" name="lastname" required>
                        </div>
                        <div class="col-md-6">
                            <label for="email" class="form-label">Email Address *</label>
                            <input type="email" class="form-control" name="email" required>
                        </div>
                        <div class="col-md-6">
                            <label for="phone" class="form-label">Phone Number</label>
                            <input type="tel" class="form-control" name="phone">
                        </div>
                        <div class="col-12">
                            <label for="department" class="form-label">Department / Inquiry Type *</label>
                            <select class="form-select" name="department" required>
                                <option value="" selected disabled>Select a department</option>
                                <option value="admissions">Admissions</option>
                                <option value="academics">Academic Programs</option>
                                <option value="finance">Finance & Fees</option>
                                <option value="campus">Campus Facilities</option>
                                <option value="hr">Human Resources</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label for="message" class="form-label">Your Message *</label>
                            <textarea class="form-control" name="message" rows="5" required></textarea>
                        </div>
                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="newsletter">
                                <label class="form-check-label" for="newsletter">
                                    Subscribe to our newsletter for updates on programs and events
                                </label>
                            </div>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-pgu">
                                <i class="fas fa-paper-plane me-2"></i>Send Message
                            </button>
                        </div>
                    </div>
                </form>
             <x-contact-form-jquery-script/>

                <!-- Quick Contact Info -->
                <div class="quick-contact">
                    <h5><i class="fas fa-bolt me-2"></i>Quick Contact</h5>
                    <p class="mb-2">For urgent matters, you can also reach us via:</p>
                    <div class="row">
                        <div class="col-md-6">
                            <p class="mb-1"><i class="fab fa-whatsapp me-2 text-success"></i> WhatsApp: +91-9876543211
                            </p>
                        </div>
                        <div class="col-md-6">
                            <p class="mb-1"><i class="fas fa-comment-alt me-2 text-primary"></i> Live Chat: Available
                                10AM-4PM (IST)</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-5">
            <!-- Map -->
            <div class="map-container mb-4">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3410.755174299971!2d75.857864115148!3d31.255201981456705!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x391a5a594d22b88d%3A0x4cc934c58d0992ec!2sPunjab%20Agricultural%20University!5e0!3m2!1sen!2sin!4v1658501234567!5m2!1sen!2sin"
                    width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>

            <!-- FAQ Accordion -->
            <div class="accordion" id="faqAccordion">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseOne">
                            What are the university office hours?
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            Our administrative offices are open Monday to Saturday from 9:00 AM to 5:00 PM (IST). The
                            campus is accessible from 8:00 AM to 8:00 PM daily.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseTwo">
                            How can I schedule a campus tour?
                        </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            Campus tours are available by appointment. Please contact the Admissions Office at
                            +91-161-1234567 or email admissions@pgu.edu.in to schedule your visit.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingThree">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseThree">
                            Where can I find department-specific contacts?
                        </button>
                    </h2>
                    <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            You can find detailed department contacts in the directory section of our website or select
                            the relevant department in the contact form above.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Department Directory -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="contact-card">
                <h3 class="mb-4">Department Directory</h3>
                <div class="row">
                    <div class="col-md-3">
                        <h6>Academic Departments</h6>
                        <ul class="department-list">
                            <li><strong>Engineering:</strong> ext. 101</li>
                            <li><strong>Business:</strong> ext. 102</li>
                            <li><strong>Medicine:</strong> ext. 103</li>
                            <li><strong>Arts & Sciences:</strong> ext. 104</li>
                        </ul>
                    </div>
                    <div class="col-md-3">
                        <h6>Administration</h6>
                        <ul class="department-list">
                            <li><strong>Registrar:</strong> ext. 201</li>
                            <li><strong>Finance:</strong> ext. 202</li>
                            <li><strong>HR:</strong> ext. 203</li>
                            <li><strong>IT Support:</strong> ext. 204</li>
                        </ul>
                    </div>
                    <div class="col-md-3">
                        <h6>Student Services</h6>
                        <ul class="department-list">
                            <li><strong>Admissions:</strong> ext. 301</li>
                            <li><strong>Career Services:</strong> ext. 302</li>
                            <li><strong>Housing:</strong> ext. 303</li>
                            <li><strong>Counselling:</strong> ext. 304</li>
                        </ul>
                    </div>
                    <div class="col-md-3">
                        <h6>Campus Facilities</h6>
                        <ul class="department-list">
                            <li><strong>Library:</strong> ext. 401</li>
                            <li><strong>Sports Complex:</strong> ext. 402</li>
                            <li><strong>Medical Center:</strong> ext. 403</li>
                            <li><strong>Cafeteria:</strong> ext. 404</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<x-indexfooter/>


<!-- Bootstrap JS Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<!-- Contact Form JavaScript -->
<script>
    document.getElementById('contactForm').addEventListener('submit', function(event) {
        event.preventDefault();

        // Get form values
        const firstName = document.getElementById('firstName').value;
        const email = document.getElementById('email').value;

        // In a real application, you would send this data to a server
        // For this example, we'll just show a success message
        alert(
            `Thank you ${firstName}! Your message has been received. We will contact you at ${email} shortly.`
            );

        // Reset the form
        document.getElementById('contactForm').reset();
    });

    // Update status badge based on current time
    function updateStatusBadge() {
        const now = new Date();
        const day = now.getDay(); // 0 = Sunday, 1 = Monday, etc.
        const hour = now.getHours();
        const badge = document.querySelector('.status-badge');

        // Check if it's a weekday (Mon-Sat) and between 8 AM and 8 PM
        if (day >= 1 && day <= 6 && hour >= 8 && hour < 20) {
            badge.textContent = 'Currently Open';
            badge.className = 'status-badge badge-open';
        } else {
            badge.textContent = 'Currently Closed';
            badge.className = 'status-badge badge-closed';
        }
    }

    // Initialize status badge
    updateStatusBadge();

    // Update status every minute
    setInterval(updateStatusBadge, 60000);
</script>
</body>

</html>
