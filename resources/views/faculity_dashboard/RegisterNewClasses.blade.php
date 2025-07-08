<x-registrationheader/>

<h2 class="main-title">Register New Class</h2>

<form action="{{ route('registerNewclasses') }}" method="POST">
    @csrf

    <div class="bg-white card-box border-20">
        <h4 class="dash-title-three">Allocate Courses</h4>

        <div class="row">
           
            <!-- Semester (Fall/Spring) -->
            <div class="col-md-4">
                <div class="dash-input-wrapper mb-30">
                    <label for="">Select Semester*</label>
                    <select class="nice-select" name="semester" required>
                        <option value="" disabled selected>Select Semester</option>
                        <option value="Fall">Fall</option>
                        <option value="Spring">Spring</option>
                    </select>
                </div>
            </div>

            <!-- Year -->
            <div class="col-md-4">
                <div class="dash-input-wrapper mb-30">
                    <label for="">Select Year*</label>
                    <select class="nice-select" name="year" required>
                        <option value="" disabled selected>Select Year</option>
                        @for ($y = 2020; $y <= now()->year + 2; $y++)
                            <option value="{{ $y }}">{{ $y }}</option>
                        @endfor
                    </select>
                </div>
            </div>

            <!-- Section -->
            <div class="col-md-4">
                <div class="dash-input-wrapper mb-30">
                    <label for="">Select Section*</label>
                    <select class="nice-select" name="section" required>
                        <option value="" disabled selected>Select Section</option>
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="C">C</option>
                        <option value="D">D</option>
                        <option value="E">E</option>
                    </select>
                </div>
            </div>

            <!-- Department -->
            <div class="col-md-6">
                <div class="dash-input-wrapper mb-30">
                    <label for="">Select Department*</label>
                    <select class="nice-select" name="department" required>
                        <option value="" disabled selected>Select Department</option>
                        <option value="CS">Computer Science (CS)</option>
                        <option value="ME">Mechanical Engineering (ME)</option>
                        <option value="CVE">Civil Engineering (CVE)</option>
                        <option value="EE">Electrical Engineering (EE)</option>
                        <option value="SE">Software Engineering (SE)</option>
                    </select>
                </div>
            </div>

            <!-- Degree Program -->
            <div class="col-md-6">
                <div class="dash-input-wrapper mb-30">
                    <label for="">Select Degree Program*</label>
                    <select class="nice-select" name="degree_program" required>
                        <option value="" disabled selected>Select Degree Program</option>
                        <option value="BS">Bachelor (BS)</option>
                        <option value="MS">Master (MS)</option>
                        <option value="PhD">Doctorate (PhD)</option>
                    </select>
                </div>
            </div>

        </div>
    </div>

    <div class="button-group d-inline-flex align-items-center mt-30">
        <button type="submit" class="dash-btn-two tran3s me-3">Register Class</button>
        <a href="#" class="dash-cancel-btn tran3s">Cancel</a>
    </div>

</form>

<x-registrationfooter/>
