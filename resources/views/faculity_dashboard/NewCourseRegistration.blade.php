<x-registrationheader/>

<h2 class="main-title">New Course Registration</h2>

<form action="{{ route('course.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="bg-white card-box border-20">
        <h4 class="dash-title-three">Course Information</h4>

        <div class="row">
            <div class="col-md-6">
                <div class="dash-input-wrapper mb-30">
                    <label for="">Course Name*</label>
                    <input type="text" name="course_name" placeholder="Enter Course Name" required>
                </div>
            </div>

            <div class="col-md-6">
                <div class="dash-input-wrapper mb-30">
                    <label for="">Course Code*</label>
                    <input type="text" name="course_code" placeholder="Enter Course Code" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="dash-input-wrapper mb-30">
                    <label for="">Credit Hours*</label>
                    <select name="credit_hours" class="nice-select" required>
                        <option value="" disabled selected>Select Credit Hours</option>
                        <option value="3,1">3,1</option>
                        <option value="4,1">4,1</option>
                        <option value="3,0">3,0</option>
                        <option value="2,1">2,1</option>
                        <option value="4,0">4,0</option>
                    </select>
                </div>
            </div>
            
            
            <div class="col-12">
                <div class="dash-input-wrapper mb-30">
                    <label for="">Description*</label>
                    <textarea name="description" placeholder="Enter Course Description" rows="4" required></textarea>
                </div>
            </div>
        </div>
    </div>

    <div class="button-group d-inline-flex align-items-center mt-30">
        <button type="submit" class="dash-btn-two tran3s me-3">Submit Course</button>
        <a href="#" class="dash-cancel-btn tran3s">Cancel</a>
    </div>
</form>

<x-registrationfooter/>
