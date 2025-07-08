<x-admin-header/>

<div class="container mt-5">
    <h2>Edit Teacher</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.teachers.update', $teacher->id) }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row">
            <div class="col-md-6 mb-3">
                <label>Full Name</label>
                <input type="text" name="full_name" class="form-control" value="{{ old('full_name', $teacher->full_name) }}">
            </div>

            <div class="col-md-6 mb-3">
                <label>Father Name</label>
                <input type="text" name="father_name" class="form-control" value="{{ old('father_name', $teacher->father_name) }}">
            </div>

            <div class="col-md-6 mb-3">
                <label>CNIC</label>
                <input type="text" name="cnic" class="form-control" value="{{ old('cnic', $teacher->cnic) }}">
            </div>

            <div class="col-md-6 mb-3">
                <label>Date of Birth</label>
                <input type="date" name="dob" class="form-control" value="{{ old('dob', $teacher->dob) }}">
            </div>

            <div class="col-md-6 mb-3">
                <label>Gender</label>
                <select name="gender" class="form-control">
                    <option value="Male" {{ $teacher->gender == 'Male' ? 'selected' : '' }}>Male</option>
                    <option value="Female" {{ $teacher->gender == 'Female' ? 'selected' : '' }}>Female</option>
                    <option value="Other" {{ $teacher->gender == 'Other' ? 'selected' : '' }}>Other</option>
                </select>
            </div>

            <div class="col-md-6 mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email', $teacher->email) }}">
            </div>

            <div class="col-md-6 mb-3">
                <label>Phone</label>
                <input type="text" name="phone" class="form-control" value="{{ old('phone', $teacher->phone) }}">
            </div>

            <div class="col-md-6 mb-3">
                <label>Salary Type</label>
                <select name="salary_type" class="form-control">
                    <option value="monthly" {{ $teacher->salary_type == 'monthly' ? 'selected' : '' }}>Monthly</option>
                    <option value="weekly" {{ $teacher->salary_type == 'weekly' ? 'selected' : '' }}>Weekly</option>
                    <option value="hourly" {{ $teacher->salary_type == 'hourly' ? 'selected' : '' }}>Hourly</option>
                </select>
            </div>

            <div class="col-md-6 mb-3">
                <label>Salary</label>
                <input type="number" step="0.01" name="salary" class="form-control" value="{{ old('salary', $teacher->salary) }}">
            </div>

            <div class="col-md-6 mb-3">
                <label>Qualification</label>
                <input type="text" name="qualification" class="form-control" value="{{ old('qualification', $teacher->qualification) }}">
            </div>

            <div class="col-md-6 mb-3">
                <label>Specialization</label>
                <input type="text" name="specialization" class="form-control" value="{{ old('specialization', $teacher->specialization) }}">
            </div>

            <div class="col-md-6 mb-3">
                <label>Department ID</label>
                <input type="text" name="department_id" class="form-control" value="{{ old('department_id', $teacher->department_id) }}">
            </div>

            <div class="col-md-6 mb-3">
                <label>Designation</label>
                <input type="text" name="designation" class="form-control" value="{{ old('designation', $teacher->designation) }}">
            </div>

            <div class="col-md-6 mb-3">
                <label>Joining Date</label>
                <input type="date" name="joining_date" class="form-control" value="{{ old('joining_date', $teacher->joining_date) }}">
            </div>

            <div class="col-md-6 mb-3">
                <label>Username</label>
                <input type="text" name="username" class="form-control" value="{{ old('username', $teacher->username) }}">
            </div>

            <div class="col-md-6 mb-3">
                <label>Password (Leave blank to keep current)</label>
                <input type="password" name="password" class="form-control">
            </div>

            <div class="col-md-6 mb-3">
                <label>Role</label>
                <input type="text" name="role" class="form-control" value="{{ old('role', $teacher->role) }}">
            </div>

            <div class="col-md-6 mb-3">
                <label>Resume (PDF only, optional)</label>
                <input type="file" name="resume" class="form-control">
                @if($teacher->resume)
                    <small>Current: <a href="{{ asset('storage/' . $teacher->resume) }}" target="_blank">View</a></small>
                @endif
            </div>

            <div class="col-md-6 mb-3">
                <label>Address</label>
                <input type="text" name="address" class="form-control" value="{{ old('address', $teacher->address) }}">
            </div>

            <div class="col-md-6 mb-3">
                <label>Country</label>
                <input type="text" name="country" class="form-control" value="{{ old('country', $teacher->country) }}">
            </div>

            <div class="col-md-6 mb-3">
                <label>City</label>
                <input type="text" name="city" class="form-control" value="{{ old('city', $teacher->city) }}">
            </div>

            <div class="col-md-6 mb-3">
                <label>State</label>
                <input type="text" name="state" class="form-control" value="{{ old('state', $teacher->state) }}">
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('display.professors') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>

<x-admin-footer/>

     
