<x-admin-header />

<div class="container mt-5">
    <h2>Edit Student</h2>

    <form action="{{ route('students.update', $student->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-md-6 mb-3">
                <label>Full Name</label>
                <input type="text" name="full_name" class="form-control" value="{{ $student->full_name }}" required>
            </div>

            <div class="col-md-6 mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" value="{{ $student->email }}" required>
            </div>

            <div class="col-md-6 mb-3">
                <label>Phone Number</label>
                <input type="text" name="phone_number" class="form-control" value="{{ $student->phone_number }}" required>
            </div>

            <div class="col-md-6 mb-3">
                <label>CNIC</label>
                <input type="text" name="cnic" class="form-control" value="{{ $student->cnic }}" required>
            </div>

            <div class="col-md-6 mb-3">
                <label>Department</label>
                <input type="text" name="department" class="form-control" value="{{ $student->department }}" required>
            </div>

            <div class="col-md-6 mb-3">
                <label>Roll No</label>
                <input type="text" name="roll_no" class="form-control" value="{{ $student->roll_no }}" required maxlength="3">
            </div>

            <div class="col-md-6 mb-3">
                <label>Degree Program</label>
                <input type="text" name="degree_program" class="form-control" value="{{ $student->degree_program }}" required>
            </div>

            <div class="col-md-6 mb-3">
                <label>Address</label>
                <textarea name="address" class="form-control" required>{{ $student->address }}</textarea>
            </div>

            <div class="col-md-4 mb-3">
                <label>Country</label>
                <input type="text" name="country" class="form-control" value="{{ $student->country }}" required>
            </div>

            <div class="col-md-4 mb-3">
                <label>City</label>
                <input type="text" name="city" class="form-control" value="{{ $student->city }}" required>
            </div>

            <div class="col-md-4 mb-3">
                <label>State / Province</label>
                <input type="text" name="state_province" class="form-control" value="{{ $student->state_province }}" required>
            </div>

            <div class="col-12 mt-3">
                <button type="submit" class="btn btn-primary">Update Student</button>
                <a href="{{ route('display.students') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </div>
    </form>
</div>

<x-admin-footer />
