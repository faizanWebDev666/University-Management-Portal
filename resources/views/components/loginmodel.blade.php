
<!-- Login Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered pgu-modal-dialog">
        <div class="modal-content pgu-modal-content border-0 rounded-4 overflow-hidden">
            
            <!-- Modal Header -->
            <div class="pgu-modal-header p-4 text-center">
                <div class="pgu-modal-header-content">
                    <button type="button" class="btn-close pgu-close-btn position-absolute" data-bs-dismiss="modal" aria-label="Close"></button>
                    <h3 class="pgu-modal-title mb-1">Account Access</h3>
                    <p class="pgu-modal-subtitle">Sign in to continue to your dashboard</p>
                </div>
            </div>
             @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <!-- Modal Body -->
            <div class="pgu-modal-body p-4 pt-3">
                <form action="{{ route('loginUser') }}" method="POST" class="pgu-login-form" id="loginForm">
                    @csrf
                    
                    <!-- Email Field -->
                    <div class="pgu-form-group mb-4">
                        <label for="loginEmail" class="pgu-form-label">Email Address</label>
                        <div class="pgu-input-group">
                            <span class="pgu-input-icon">
                                <i class="bi bi-envelope"></i>
                            </span>
                            <input type="email" 
                                   class="pgu-form-control" 
                                   id="loginEmail" 
                                   name="email" 
                                   placeholder="example@gmail.com"
                                   required>
                        </div>
                        <div class="pgu-form-text">Enter your registered university email address</div>
                    </div>

                    <!-- Hidden Field -->
                    <input type="hidden" name="requested_type" id="requested_type" value="">

                    <!-- Password Field -->
                    <div class="pgu-form-group mb-4">
                        <label for="loginPassword" class="pgu-form-label">Password</label>
                        <div class="pgu-input-group">
                            <span class="pgu-input-icon">
                                <i class="bi bi-lock"></i>
                            </span>
                            <input type="password" 
                                   class="pgu-form-control" 
                                   id="loginPassword" 
                                   name="password" 
                                   placeholder="Enter your password" 
                                   required>
                            <button type="button" 
                                    class="pgu-password-toggle"
                                    id="toggleLoginPassword"
                                    aria-label="Toggle password visibility">
                                <i class="bi bi-eye-slash"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Remember & Forgot -->
                    <div class="pgu-remember-forgot d-flex justify-content-between align-items-center mb-4">
                        <div class="pgu-checkbox-group">
                            <input class="pgu-checkbox" type="checkbox" id="rememberMe" name="remember">
                            <label class="pgu-checkbox-label" for="rememberMe">
                                Remember this device
                            </label>
                        </div>
                    </div>

                    <!-- reCAPTCHA -->
                    @php
                        use Anhskohbo\NoCaptcha\Facades\NoCaptcha;
                    @endphp
                    <div class="pgu-captcha-container mb-4">
                        {!! NoCaptcha::renderJs() !!}
                        {!! NoCaptcha::display(['data-theme' => 'light', 'class' => 'pgu-captcha']) !!}
                        @error('g-recaptcha-response')
                            <div class="pgu-alert-error mt-2">
                                <i class="bi bi-exclamation-circle me-1"></i>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <div class="pgu-submit-container">
                        <button type="submit" class="pgu-submit-btn">
                            <i class="bi bi-box-arrow-in-right me-2"></i>
                            Sign In to Portal
                        </button>
                    </div>
                </form>

                <!-- Divider -->
                <div class="pgu-divider my-4">
                    <span class="pgu-divider-text">OR</span>
                </div>

                <!-- Registration Option -->
                

                <!-- Security Footer -->
                <div class="pgu-security-footer mt-4 pt-3 border-top">
                    <div class="d-flex align-items-center justify-content-center">
                        <i class="bi bi-shield-check pgu-security-icon me-2"></i>
                        <span class="pgu-security-text">Your credentials are encrypted and securely transmitted</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Custom CSS -->
<style>
/* Modal Container */
.pgu-modal-dialog {
    max-width: 420px;
    margin: 1rem;
}

.pgu-modal-content {
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
    border: 1px solid rgba(46, 90, 62, 0.1);
}

/* Header */
.pgu-modal-header {
    background: linear-gradient(135deg, rgba(46, 90, 62, 0.95), rgba(33, 68, 45, 0.95));
    padding: 2rem 1.5rem;
    position: relative;
}

.pgu-modal-header-content {
    position: relative;
}

.pgu-close-btn {
    top: 1rem;
    right: 1rem;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 50%;
    padding: 0.5rem;
    opacity: 0.8;
    transition: all 0.2s ease;
}

.pgu-close-btn:hover {
    opacity: 1;
    background: rgba(255, 255, 255, 0.2);
}

.pgu-logo {
    filter: brightness(0) invert(1);
    opacity: 0.9;
}

.pgu-modal-title {
    font-size: 1.5rem;
    font-weight: 600;
    color: white;
    letter-spacing: 0.5px;
}

.pgu-modal-subtitle {
    font-size: 0.875rem;
    color: rgba(255, 255, 255, 0.85);
    margin: 0;
}

/* Form Elements */
.pgu-form-group {
    position: relative;
}

.pgu-form-label {
    font-weight: 500;
    color: #2c3e50;
    margin-bottom: 0.5rem;
    font-size: 0.9rem;
    display: block;
}

.pgu-input-group {
    position: relative;
    display: flex;
    align-items: center;
}

.pgu-input-icon {
    position: absolute;
    left: 0.75rem;
    color: rgba(46, 90, 62, 0.6);
    z-index: 10;
}

.pgu-form-control {
    width: 100%;
    padding: 0.75rem 0.75rem 0.75rem 2.5rem;
    border: 1px solid #e0e6ed;
    border-radius: 8px;
    font-size: 0.95rem;
    transition: all 0.2s ease;
    background: #fff;
}

.pgu-form-control:focus {
    outline: none;
    border-color: rgba(46, 90, 62, 0.5);
    box-shadow: 0 0 0 3px rgba(46, 90, 62, 0.1);
}

.pgu-form-text {
    font-size: 0.8rem;
    color: #6c757d;
    margin-top: 0.25rem;
    margin-left: 0.25rem;
}

/* Password Toggle */
.pgu-password-toggle {
    position: absolute;
    right: 0.75rem;
    background: transparent;
    border: none;
    color: #6c757d;
    cursor: pointer;
    padding: 0.25rem;
    transition: color 0.2s ease;
}

.pgu-password-toggle:hover {
    color: rgba(46, 90, 62, 0.8);
}

/* Remember & Forgot */
.pgu-checkbox-group {
    display: flex;
    align-items: center;
}

.pgu-checkbox {
    margin-right: 0.5rem;
    accent-color: rgba(46, 90, 62, 0.9);
    width: 1.1rem;
    height: 1.1rem;
    cursor: pointer;
}

.pgu-checkbox-label {
    font-size: 0.875rem;
    color: #5a6c7d;
    cursor: pointer;
}

.pgu-forgot-link {
    font-size: 0.875rem;
    color: rgba(46, 90, 62, 0.9);
    text-decoration: none;
    font-weight: 500;
    transition: color 0.2s ease;
}

.pgu-forgot-link:hover {
    color: rgba(33, 68, 45, 0.9);
    text-decoration: underline;
}

/* reCAPTCHA */
.pgu-captcha-container {
    background: #f8f9fa;
    padding: 1rem;
    border-radius: 8px;
    border: 1px solid #e9ecef;
}

.pgu-captcha {
    transform: scale(0.95);
    transform-origin: 0 0;
}

.pgu-alert-error {
    font-size: 0.8rem;
    color: #dc3545;
    display: flex;
    align-items: center;
}

/* Submit Button */
.pgu-submit-container {
    margin: 1.5rem 0;
}

.pgu-submit-btn {
    width: 100%;
    padding: 0.875rem 1.5rem;
    background: linear-gradient(135deg, rgba(46, 90, 62, 0.9), rgba(33, 68, 45, 0.9));
    color: white;
    border: none;
    border-radius: 8px;
    font-weight: 600;
    font-size: 1rem;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
}

.pgu-submit-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(46, 90, 62, 0.2);
}

.pgu-submit-btn:active {
    transform: translateY(0);
}

/* Divider */
.pgu-divider {
    position: relative;
    text-align: center;
}

.pgu-divider::before {
    content: '';
    position: absolute;
    top: 50%;
    left: 0;
    right: 0;
    height: 1px;
    background: #e0e6ed;
}

.pgu-divider-text {
    position: relative;
    background: white;
    padding: 0 1rem;
    color: #6c757d;
    font-size: 0.875rem;
    font-weight: 500;
}

/* Registration Option */
.pgu-registration-option {
    padding: 1rem 0;
}

.pgu-register-text {
    color: #5a6c7d;
    font-size: 0.9rem;
    margin: 0;
}

.pgu-register-btn {
    padding: 0.75rem 2rem;
    background: transparent;
    border: 2px solid rgba(46, 90, 62, 0.3);
    color: rgba(46, 90, 62, 0.9);
    border-radius: 8px;
    font-weight: 600;
    font-size: 0.9rem;
    cursor: pointer;
    transition: all 0.3s ease;
}

.pgu-register-btn:hover {
    background: rgba(46, 90, 62, 0.05);
    border-color: rgba(46, 90, 62, 0.5);
}

/* Security Footer */
.pgu-security-footer {
    background: #f8f9fa;
    margin: 0 -1.5rem -1.5rem;
    padding: 1rem 1.5rem;
    border-radius: 0 0 8px 8px;
}

.pgu-security-icon {
    color: rgba(46, 90, 62, 0.8);
    font-size: 1rem;
}

.pgu-security-text {
    font-size: 0.8rem;
    color: #6c757d;
}

/* Responsive Design */
@media (max-width: 576px) {
    .pgu-modal-dialog {
        margin: 0.5rem;
        max-width: calc(100vw - 1rem);
    }
    
    .pgu-modal-header,
    .pgu-modal-body {
        padding: 1.5rem;
    }
    
    .pgu-submit-btn {
        padding: 0.75rem 1rem;
    }
}

/* Loading State */
.pgu-submit-btn.loading {
    opacity: 0.8;
    cursor: not-allowed;
}

.pgu-submit-btn.loading::after {
    content: '';
    width: 1rem;
    height: 1rem;
    border: 2px solid white;
    border-radius: 50%;
    border-top-color: transparent;
    animation: spin 1s linear infinite;
    margin-left: 0.5rem;
}

@keyframes spin {
    to { transform: rotate(360deg); }
}
</style>

<!-- JavaScript -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Password Toggle
    const toggleBtn = document.getElementById('toggleLoginPassword');
    const passwordInput = document.getElementById('loginPassword');
    const eyeIcon = toggleBtn.querySelector('i');
    
    toggleBtn.addEventListener('click', function() {
        const type = passwordInput.type === 'password' ? 'text' : 'password';
        passwordInput.type = type;
        eyeIcon.className = type === 'password' ? 'bi bi-eye-slash' : 'bi bi-eye';
        toggleBtn.setAttribute('aria-label', type === 'password' ? 'Show password' : 'Hide password');
    });
    
    // Form Submission
    const loginForm = document.getElementById('loginForm');
    const submitBtn = loginForm.querySelector('.pgu-submit-btn');
    
    loginForm.addEventListener('submit', function(e) {
        // Add loading state
        submitBtn.classList.add('loading');
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="bi bi-box-arrow-in-right me-2"></i>Signing In...';
        
  
        setTimeout(() => {
            submitBtn.classList.remove('loading');
            submitBtn.disabled = false;
            submitBtn.innerHTML = '<i class="bi bi-box-arrow-in-right me-2"></i>Sign In to Portal';
        }, 2000);
    });
});
</script>