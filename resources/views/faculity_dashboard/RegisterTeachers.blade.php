<x-registrationheader/>
@if ($errors->any())
    <div class="alert alert-danger mx-auto my-4 w-75 rounded shadow-sm">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<h2 class="main-title">Add New Professor</h2>

<form action="{{ route('register.teacher') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="bg-white card-box border-20">
        <h4 class="dash-title-three">Personal Information</h4>


 <h4 class="dash-title-three pt-50 lg-pt-30">Upload Photo</h4>
        <div class="dash-input-wrapper mb-20">
            <div class="dash-btn-one d-inline-block position-relative me-3">
                <i class="bi bi-plus"></i> Upload Image
                <input type="file" id="teacher_image" name="teacher_image" accept=".jpg, .jpeg, .png"
                    style="opacity: 0; position: absolute; top: 0; left: 0; width: 100%; height: 100%; cursor: pointer;">
            </div>
            <small>Allowed formats: .jpg, .png</small>
        </div>

        <div class="dash-input-wrapper mb-30">
            <label for="">Full Name*</label>
            <input type="text" name="full_name" placeholder="Ex: Dr. Ahmad Khan" required>
        </div>

        <div class="dash-input-wrapper mb-30">
            <label for="">Father's Name*</label>
            <input type="text" name="father_name" placeholder="Ex: Mr. Muhammad Khan" required>
        </div>

        <div class="dash-input-wrapper mb-30">
            <label for="">CNIC*</label>
            <input type="text" name="cnic" placeholder="12345-6789012-3" required>
        </div>

        <div class="dash-input-wrapper mb-30">
            <label for="">Date of Birth*</label>
            <input type="date" name="dob" required>
        </div>

        <div class="dash-input-wrapper mb-30">
            <label for="">Gender*</label>
            <select class="nice-select" name="gender" required>
                <option>Male</option>
                <option>Female</option>
                <option>Other</option>
            </select>
        </div>

        <div class="dash-input-wrapper mb-30">
            <label for="">Email Address*</label>
            <input type="email" name="email" placeholder="example@university.edu" required>
        </div>

        <div class="dash-input-wrapper mb-30">
            <label for="">Phone Number*</label>
            <input type="text" name="phone" placeholder="+92-300-1234567" required>
        </div>

        <div class="col-md-6">
            <div class="dash-input-wrapper mb-30">
                <label for="">Salary Type*</label>
                <select class="nice-select" name="salary_type" required>
                    <option value="monthly">Monthly</option>
                    <option value="weekly">Weekly</option>
                    <option value="hourly">Hourly</option>
                </select>
            </div>
        </div>

        <div class="col-md-6">
            <div class="dash-input-wrapper mb-30">
                <label for="">Salary Amount*</label>
                <input type="number" name="salary" placeholder="Enter exact salary amount" required>
            </div>
        </div>

        <h4 class="dash-title-three pt-50">Academic & Professional Information</h4>

        <div class="dash-input-wrapper mb-30">
            <label for="">Highest Qualification*</label>
            <input type="text" name="qualification" placeholder="Ex: PhD in Computer Science" required>
        </div>

        <div class="dash-input-wrapper mb-30">
            <label for="">Specialization*</label>
            <input type="text" name="specialization" placeholder="Ex: Machine Learning" required>
        </div>

       <div class="dash-input-wrapper mb-30">
    <label for="">Department*</label>
    <select class="nice-select" name="department_id" required>
        <option value="">Select Department</option>
        @foreach($departments as $department)
            <option value="{{ $department->id }}">{{ $department->name }}</option>
        @endforeach
    </select>
</div>

        <div class="dash-input-wrapper mb-30">
            <label for="">Designation*</label>
            <select class="nice-select" name="designation" required>
                <option>Lecturer</option>
                <option>Assistant Professor</option>
                <option>Associate Professor</option>
                <option>Professor</option>
            </select>
        </div>

        <div class="dash-input-wrapper mb-30">
            <label for="">Joining Date*</label>
            <input type="date" name="joining_date" required>
        </div>

        <h4 class="dash-title-three pt-50">System Login Info</h4>

        <div class="dash-input-wrapper mb-30">
            <label for="">Username*</label>
            <input type="text" name="username" placeholder="Ex: ahmad.khan" required>
        </div>

       <div class="dash-input-wrapper mb-30">
    <label for="">Password*</label>
    <input type="password" id="password" name="password" placeholder="••••••••" required>
</div>

<script>
    const passwordInput = document.getElementById("password");

    passwordInput.addEventListener("input", function () {
        if (passwordInput.value.length < 6) {
            passwordInput.style.border = "2px solid red"; // box red
            passwordInput.style.backgroundColor = "#ffe6e6"; // light red background
        } else {
            passwordInput.style.border = "2px solid green"; // valid -> green
            passwordInput.style.backgroundColor = "white";
        }
    });
</script>
        <div class="dash-input-wrapper mb-30">
            <label for="">Role*</label>
            <select class="nice-select" name="role" required>
                <option selected>Professor</option>
            </select>
        </div>

        <h4 class="dash-title-three pt-50">Resume / Documents</h4>

        <div class="dash-btn-one d-inline-block position-relative me-3">
            <i class="bi bi-plus"></i>
            Upload Resume
            <input type="file" name="resume" accept=".pdf,.doc,.docx">
        </div>
        <small>Upload .pdf, .doc, .docx only</small>

        <h4 class="dash-title-three pt-50">Address & Location</h4>

        <div class="dash-input-wrapper mb-30">
            <label for="">Address*</label>
            <input type="text" name="address" placeholder="House no, Street, City" required>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="dash-input-wrapper mb-30">
                    <label for="">Country</label>
                    <select class="nice-select" name="country" required>
                        <option>Pakistan</option>
                        <option>Other</option>
                    </select>
                </div>
            </div>

            <div class="col-md-4">
                <div class="dash-input-wrapper mb-30">
                    <label for="">City</label>
                    <input type="text" name="city" placeholder="Lahore" required>
                </div>
            </div>

            <div class="col-md-4">
                <div class="dash-input-wrapper mb-30">
                    <label for="">State</label>
                    <input type="text" name="state" placeholder="Punjab" required>
                </div>
            </div>
        </div>

        <div class="button-group d-inline-flex align-items-center mt-30">
            <button type="submit" class="dash-btn-two tran3s me-3">Submit</button>
            <a href="#" class="dash-cancel-btn tran3s">Cancel</a>
        </div>
    </div>
</form>

<x-registrationfooter/>
