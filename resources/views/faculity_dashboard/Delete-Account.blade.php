<x-registrationheader/>

<h2 class="main-title">Allocate Courses to Classes</h2>

<form action="" method="POST">
    @csrf
    <div class="bg-white card-box border-20">
        <h4 class="dash-title-three">Allocate Courses</h4>

        <div class="row">
            <div class="col-md-6">
                <div class="dash-input-wrapper mb-30">
                    <label for="">Select Professor*</label>
                    <select class="nice-select" name="professor_id" required>
                        <option value="" disabled selected>Select Professor</option>
                       
                    </select>
                </div>
            </div>

           
    <div class="button-group d-inline-flex align-items-center mt-30">
        <button type="submit" class="dash-btn-two tran3s me-3">Allocate Courses</button>
        <a href="#" class="dash-cancel-btn tran3s">Cancel</a>
    </div>

</form>

<x-registrationfooter/>
