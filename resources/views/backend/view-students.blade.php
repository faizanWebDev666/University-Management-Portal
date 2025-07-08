<x-admin-header />

<div class="container mt-5">
    <h2>Student Details</h2>
    <table class="table table-bordered">
        <tr><th>ID</th><td>{{ $student->id }}</td></tr>
        <tr><th>Full Name</th><td>{{ $student->full_name }}</td></tr>
        <tr><th>Email</th><td>{{ $student->email }}</td></tr>
        <tr><th>Phone Number</th><td>{{ $student->phone_number }}</td></tr>
        <tr><th>CNIC</th><td>{{ $student->cnic }}</td></tr>
        <tr><th>Department</th><td>{{ $student->department }}</td></tr>
        <tr><th>Roll No</th><td>{{ $student->roll_no }}</td></tr>
        <tr><th>Degree Program</th><td>{{ $student->degree_program }}</td></tr>
        <tr><th>Address</th><td>{{ $student->address }}</td></tr>
        <tr><th>Country</th><td>{{ $student->country }}</td></tr>
        <tr><th>City</th><td>{{ $student->city }}</td></tr>
        <tr><th>State/Province</th><td>{{ $student->state_province }}</td></tr>
        <tr><th>Created At</th><td>{{ $student->created_at->format('d M Y') }}</td></tr>
    </table>
    <a href="{{ route('display.students') }}" class="btn btn-secondary">Back to List</a>
</div>

<x-admin-footer />
