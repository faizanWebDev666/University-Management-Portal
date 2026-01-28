<x-registrationheader/>

<h2 class="main-title">Register New Department</h2>
@if ($errors->any())
    <div class="alert alert-danger mx-auto my-4 w-75 rounded shadow-sm">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form action="{{ route('registerdepartments') }}" method="POST">
    @csrf

    <div class="bg-white card-box border-20">
        <h4 class="dash-title-three">Departments</h4>

        <div class="row">
           
          <div class="col-md-6">
                <div class="dash-input-wrapper mb-30">
                    <label for="">Enter Department Name*</label>
                    <input type="text" name="name" placeholder="Department Full Name" required>
                </div>
            </div>
             <div class="col-md-6">
                <div class="dash-input-wrapper mb-30">
                    <label for="">Enter Department Code*</label>
                    <input type="text" name="code" placeholder="Department Code" required>
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
