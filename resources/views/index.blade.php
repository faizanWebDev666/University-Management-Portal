<x-indexheader />


 @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
<section class="hero-section">
    <div class="container">
        <h1>Welcome to Punjab Global University Portal</h1>
        <p>Your gateway to academic resources, student services, and faculty tools.</p>
         @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        <div>
            <a href="#" class="btn btn-custom" data-bs-toggle="modal" data-bs-target="#loginModal"
                data-role="student">Student Login</a>
            <a href="#" class="btn btn-custom" data-bs-toggle="modal" data-bs-target="#loginModal"
                data-role="professor">Faculty Login</a>
            <a href="#" class="btn btn-custom" data-bs-toggle="modal" data-bs-target="#loginModal"
                data-role="registrationoffice">Registration Office</a>
            <a href="#" class="btn btn-custom" data-bs-toggle="modal" data-bs-target="#loginModal"
                data-role="admin">Admin / HOD</a>

        </div>
</section>
<script>
    //important script that sees the user role and sets it in the hidden input field of login modal
    document.querySelectorAll('[data-bs-toggle="modal"]').forEach(button => {
        button.addEventListener('click', function() {
            const role = this.getAttribute('data-role');
            document.getElementById('requested_type').value = role;
            console.log('Role set to:', role);
        });
    });
</script>

<x-loginmodel />
<x-indexfooter />
