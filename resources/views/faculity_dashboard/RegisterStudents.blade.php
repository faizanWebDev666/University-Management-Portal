<x-registrationheader />
@if ($errors->any())
    <div class="alert alert-danger mx-auto my-4 w-75 rounded shadow-sm">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<h2 class="main-title">New Student Registration</h2>

<form action="{{ route('student.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="bg-white card-box border-20">
        <h4 class="dash-title-three">Student Information</h4>

        <div class="row">
            <div class="col-md-6">
                <div class="dash-input-wrapper mb-30">
                    <label for="">Full Name*</label>
                    <input type="text" name="full_name" placeholder="Student Full Name" required>
                </div>
            </div>

            <div class="col-md-6">
                <div class="dash-input-wrapper mb-30">
                    <label for="">Email Address*</label>
                    <input type="email" name="email" placeholder="student@example.com" required>
                </div>
            </div>

            <div class="col-md-6">
                <div class="dash-input-wrapper mb-30">
                    <label for="">Phone Number*</label>
                    <input type="text" name="phone_number" placeholder="03XXXXXXXXX" required>
                </div>
            </div>

            <div class="col-md-6">
                <div class="dash-input-wrapper mb-30">
                    <label for="">CNIC*</label>
                    <input type="text" name="cnic" placeholder="12345-1234567-1" required>
                </div>
            </div>



            <div class="col-md-4">
                <div class="dash-input-wrapper mb-30">
                    <label for="">Department*</label>
                    <select class="nice-select" name="department" required>
                        <option value="CS">Computer Science</option>
                        <option value="SE">Software Engineering</option>
                        <option value="EE">Electrical Engineering</option>
                        <option value="BBA">Business Administration</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="dash-input-wrapper mb-30">
                    <label for="">Class (Semester & Section)*</label>
                    <select class="nice-select" name="class_id" required>
                        @foreach ($classes as $class)
                            <option value="{{ $class->id }}">
                                {{ strtoupper(substr($class->semester, 0, 2)) }}{{ substr($class->year, -2) }}-{{ strtoupper(substr($class->degree_program, 0, 1)) }}{{ strtoupper($class->department) }}-{{ strtoupper($class->section) }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-md-4">
                <div class="dash-input-wrapper mb-30">
                    <label for="">Roll No*</label>
                    <input type="text" name="roll_no" placeholder="001" maxlength="3" required>
                    <small>Enter only numeric part (e.g., 001)</small>
                </div>
            </div>

            <div class="col-md-6">
                <div class="dash-input-wrapper mb-30">
                    <label for="">Degree Program*</label>
                    <select class="nice-select" name="degree_program" required>
                        <option value="BS">BS</option>
                        <option value="MS">MS</option>
                        <option value="PhD">PhD</option>
                    </select>
                </div>
            </div>

            <div class="col-md-6">
                <div class="dash-input-wrapper mb-30">
                    <label for="">Password*</label>
                    <input type="password" name="password" placeholder="Create a secure password" required>
                </div>
            </div>

            <div class="col-12">
                <div class="dash-input-wrapper mb-30">
                    <label for="">Complete Address*</label>
                    <input type="text" name="address" placeholder="House No, Street, City" required>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="dash-input-wrapper mb-30">
                    <label for="">Country*</label>
                    <select class="nice-select" name="country" required>
                        <option>Pakistan</option>
                        <option>USA</option>
                        <option>UK</option>
                    </select>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="dash-input-wrapper mb-30">
                    <label for="">City*</label>
                    <select class="nice-select" name="city" required>
                        <option>Lahore</option>
                        <option>Islamabad</option>
                        <option>Karachi</option>
                        <option>Peshawar</option>
                    </select>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="dash-input-wrapper mb-30">
                    <label for="">State/Province*</label>
                    <select class="nice-select" name="state_province" required>
                        <option>Punjab</option>
                        <option>Sindh</option>
                        <option>KPK</option>
                        <option>Balochistan</option>
                    </select>
                </div>
            </div>
        </div>

        <h4 class="dash-title-three pt-50 lg-pt-30">Upload Student Photo</h4>
        <div class="dash-input-wrapper mb-20">
            <label for="student_image">Upload Image*</label>
            <div class="dash-btn-one d-inline-block position-relative me-3">
                <i class="bi bi-plus"></i> Upload Image
                <input type="file" id="student_image" name="student_image" accept=".jpg, .jpeg, .png"
                    style="opacity: 0; position: absolute; top: 0; left: 0; width: 100%; height: 100%; cursor: pointer;">
            </div>
            <small>Allowed formats: .jpg, .png</small>
        </div>

        <div class="button-group d-inline-flex align-items-center mt-30">
            <button type="submit" class="dash-btn-two tran3s me-3">Submit Registration</button>
            <a href="#" class="dash-cancel-btn tran3s">Cancel</a>
        </div>

</form>

<x-registrationfooter />
