
		<div class="footer-one">
			<div class="container">
				<div class="inner-wrapper">
					<div class="row">
						<div class="col-lg-2 col-md-3 footer-intro mb-15">
							<div class="logo mb-15">
								<a href="index.html" class="d-flex align-items-center">
									<img src="'frontend/images/logo/logo_01.png" alt="">
								</a>
							</div> 
							<img src="frontend/images/logo/logo_01_whitebg.png">
							<!-- logo -->
						</div>
						<div class="col-lg-2 col-md-3 col-sm-4 mb-20">
							<h5 class="footer-title">Services​</h5>
							<ul class="footer-nav-link style-none">
								<li><a href="job-grid-v2.html">Browse Jobs</a></li>
								<li><a href="company-v1.html">Companies</a></li>
								<li><a href="candidates-v1.html">Candidates</a></li>
								<li><a href="pricing.html">Pricing</a></li>
							</ul>
						</div>
						<div class="col-lg-2 col-md-3 col-sm-4 mb-20">
							<h5 class="footer-title">Company</h5>
							<ul class="footer-nav-link style-none">
								<li><a href="about-us.html">About us</a></li>
								<li><a href="blog-v2.html">Blogs</a></li>
								<li><a href="faq.html">FAQ’s</a></li>
								<li><a href="contact.html">Contact</a></li>
							</ul>
						</div>
						<div class="col-lg-2 col-md-3 col-sm-4 mb-20">
							<h5 class="footer-title">Support</h5>
							<ul class="footer-nav-link style-none">
								<li><a href="contact.html">Terms of use</a></li>
								<li><a href="contact.html">Terms & conditions</a></li>
								<li><a href="contact.html">Privacy</a></li>
								<li><a href="contact.html">Cookie policy</a></li>
							</ul>
						</div>
						<div class="col-lg-4 mb-20 footer-newsletter">
							<h5 class="footer-title">Newsletter</h5>
							<p>Join & get important new regularly</p>
							<form action="#" class="d-flex">
								<input type="email" placeholder="Enter your email*">
								<button>Send</button>
							</form>
							<p class="note">We only send interesting and relevant emails.</p>
						</div>
					</div>
				</div> <!-- /.inner-wrapper -->
			</div>
			<div class="bottom-footer">
				<div class="container">
					<div class="row align-items-center">
						<div class="col-lg-4 order-lg-3 mb-15">
							<ul class="style-none d-flex order-lg-last justify-content-center justify-content-lg-end social-icon">
								<li><a href="#"><i class="bi bi-whatsapp"></i></a></li>
								<li><a href="#"><i class="bi bi-dribbble"></i></a></li>
								<li><a href="#"><i class="bi bi-google"></i></a></li>
								<li><a href="#"><i class="bi bi-instagram"></i></a></li>
							</ul>
						</div>
						
						<div class="col-lg-4 order-lg-2">
							<p class="text-center mb-15">Copyright @2025 UNIVERSITY Of ALBOURNE.</p>
						</div>
					</div>
				</div>
			</div>
		</div> <!-- /.footer-one -->


	<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-fullscreen modal-dialog-centered">
    <div class="modal-content">
      <div class="container py-5 px-md-5">
        <button type="button" class="btn-close ms-auto" data-bs-dismiss="modal" aria-label="Close"></button>

        <div class="text-center mb-4">
          <h2 id="loginModalLabel">Hi, Welcome Back!</h2>
          <p>Don't have an account? <a href="#" class="fw-semibold">Sign up</a></p>
        </div>

        <div class="form-wrapper mx-auto" style="max-width: 450px;">
          <form action="#" method="POST" class="needs-validation" novalidate>
            <div class="mb-3">
              <label for="loginEmail" class="form-label">Email address*</label>
              <input type="email" class="form-control" id="loginEmail" name="email" placeholder="you@example.com" required autofocus>
              <div class="invalid-feedback">Please enter a valid email address.</div>
            </div>

            <div class="mb-3 position-relative">
              <label for="loginPassword" class="form-label">Password*</label>
              <input type="password" class="form-control" id="loginPassword" name="password" placeholder="Enter Password" required>
              <div class="invalid-feedback">Password is required.</div>
              <span class="position-absolute end-0 top-50 translate-middle-y pe-3" style="cursor: pointer;" onclick="togglePassword()">
                <img src="frontend/images/icon/icon_60.svg" alt="Toggle visibility" width="20">
              </span>
            </div>

            <div class="d-flex justify-content-between align-items-center mb-3">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="rememberMe">
                <label class="form-check-label" for="rememberMe">Keep me logged in</label>
              </div>
              <a href="#" class="text-decoration-none">Forgot Password?</a>
            </div>

            <button type="submit" class="btn btn-primary w-100 fw-semibold">Login</button>

            <div class="text-center my-4 position-relative">
              <span class="bg-white px-3 position-relative z-1">OR</span>
              <hr class="position-absolute top-50 start-0 w-100 border-secondary" style="z-index: 0;">
            </div>

            <div class="row g-2 mb-4">
              <div class="col-md-6">
                <a href="#" class="btn btn-outline-secondary w-100 d-flex align-items-center justify-content-center">
                  <img src="frontend/images/icon/google.png" alt="Google" width="20">
                  <span class="ms-2">Login with Google</span>
                </a>
              </div>
              <div class="col-md-6">
                <a href="#" class="btn btn-outline-primary w-100 d-flex align-items-center justify-content-center">
                  <img src="frontend/images/icon/facebook.png" alt="Facebook" width="20">
                  <span class="ms-2">Login with Facebook</span>
                </a>
              </div>
            </div>

            <p class="text-center mt-3 mb-0">Don't have an account? <a href="#" class="fw-semibold">Sign up</a></p>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Scroll to Top Button -->
<button class="scroll-top position-fixed bottom-0 end-0 m-4 btn btn-secondary rounded-circle" onclick="window.scrollTo({top: 0, behavior: 'smooth'});">
  <i class="bi bi-arrow-up-short fs-4"></i>
</button>

<!-- JavaScript: Password Toggle + Form Validation -->
<script>
  function togglePassword() {
    const password = document.getElementById("loginPassword");
    password.type = password.type === "password" ? "text" : "password";
  }

  // Bootstrap 5 form validation
  (() => {
    'use strict';
    const forms = document.querySelectorAll('.needs-validation');
    Array.from(forms).forEach(form => {
      form.addEventListener('submit', event => {
        if (!form.checkValidity()) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  })();
</script>





		
	    <!-- jQuery -->
    <script src="{{ asset('frontend/vendor/jquery.min.js') }}"></script>

    <!-- Bootstrap Bundle JS -->
    <script src="{{ asset('frontend/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- WOW JS -->
    <script src="{{ asset('frontend/vendor/wow/wow.min.js') }}"></script>

    <!-- Slick Slider -->
    <script src="{{ asset('frontend/vendor/slick/slick.min.js') }}"></script>

    <!-- Fancybox -->
    <script src="{{ asset('frontend/vendor/fancybox/dist/jquery.fancybox.min.js') }}"></script>

    <!-- Lazy Load -->
    <script src="{{ asset('frontend/vendor/jquery.lazy.min.js') }}"></script>

    <!-- Counter JS -->
    <script src="{{ asset('frontend/vendor/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('frontend/vendor/jquery.waypoints.min.js') }}"></script>

    <!-- Nice Select -->
    <script src="{{ asset('frontend/vendor/nice-select/jquery.nice-select.min.js') }}"></script>

    <!-- Validator JS -->
    <script src="{{ asset('frontend/vendor/validator.js') }}"></script>

    <!-- Theme JS -->
    <script src="{{ asset('frontend/js/theme.js') }}"></script>
</body>
</html>
