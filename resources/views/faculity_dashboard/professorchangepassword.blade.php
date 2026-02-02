<x-faculityheader/>

@if ($errors->any())
    <div class="alert alert-danger mx-auto my-4 w-75 rounded shadow-sm">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (session('success'))
    <div class="alert alert-success mx-auto my-4 w-75 rounded shadow-sm">
        {{ session('success') }}
    </div>
@endif

<div class="container my-5">
    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-header bg-dark text-white fw-bold fs-5 px-4 py-3">
            🔑 Update Password
        </div>

        <div class="card-body px-4 py-4">
            <div class="alert alert-info border border-primary shadow-sm mb-4">
                <h5 class="fw-bold text-primary">📌 Password Guidelines</h5>
                <ul class="mb-0">
                    <li>Use a strong password with at least 8 characters.</li>
                    <li>Include a mix of letters, numbers, and special characters.</li>
                    <li>Do not reuse your previous password.</li>
                </ul>
            </div>

            <form action="{{ route('faculty.password.update') }}" method="POST" id="updatePasswordForm">
                @csrf

                <!-- Previous Password -->
                <div class="mb-3">
                    <label for="current_password" class="form-label fw-semibold">Previous Password</label>
                    <input type="password" name="current_password" id="current_password" class="form-control rounded-3" required>
                </div>

                <!-- New Password -->
                <div class="mb-3">
                    <label for="new_password" class="form-label fw-semibold">New Password</label>
                    <input type="password" name="new_password" id="new_password" class="form-control rounded-3" required>
                    <div class="text-danger small mt-1 d-none" id="new_password_error">
                        Password must be at least 8 characters.
                    </div>
                </div>

                <!-- Confirm Password -->
               <div class="mb-3">
                    <label for="new_password_confirmation" class="form-label fw-semibold">Confirm New Password</label>
                    <input type="password" name="new_password_confirmation" id="new_password_confirmation" class="form-control rounded-3" required>
                    <div class="text-danger small mt-1 d-none" id="confirm_password_error">
                        Passwords do not match.
                    </div>
                </div>


                <div class="text-end">
                    <button type="submit" class="btn btn-success px-4 rounded-pill shadow-sm">Update Password</button>
                </div>
            </form>
        </div>
    </div>
</div>

<x-faculityfooter/>

<!-- ✅ Client-Side Validation Script -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const newPassword = document.getElementById('new_password');
    const confirmPassword = document.getElementById('new_password_confirmation');
    const newPasswordError = document.getElementById('new_password_error');
    const confirmPasswordError = document.getElementById('confirm_password_error');
    const form = document.getElementById('updatePasswordForm');

    // Validate new password length
    newPassword.addEventListener('input', function() {
        if (newPassword.value.length < 8) {
            newPassword.classList.add('is-invalid');
            newPasswordError.classList.remove('d-none');
        } else {
            newPassword.classList.remove('is-invalid');
            newPasswordError.classList.add('d-none');
        }
    });

    // Validate confirm password matches new password
    confirmPassword.addEventListener('input', function() {
        if (confirmPassword.value !== newPassword.value) {
            confirmPassword.classList.add('is-invalid');
            confirmPasswordError.classList.remove('d-none');
        } else {
            confirmPassword.classList.remove('is-invalid');
            confirmPasswordError.classList.add('d-none');
        }
    });

    // Prevent form submission if validations fail
    form.addEventListener('submit', function(e) {
        let hasError = false;

        if (newPassword.value.length < 8) {
            newPassword.classList.add('is-invalid');
            newPasswordError.classList.remove('d-none');
            hasError = true;
        }

        if (confirmPassword.value !== newPassword.value) {
            confirmPassword.classList.add('is-invalid');
            confirmPasswordError.classList.remove('d-none');
            hasError = true;
        }

        if (hasError) {
            e.preventDefault();
        }
    });
});
</script>
