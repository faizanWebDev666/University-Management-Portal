<x-admin-header/>

<div class="container mt-5">
    <h2>Teacher Details</h2>

    <table class="table table-bordered">
        <tr><th>ID</th><td>{{ $teacher->id }}</td></tr>

        {{-- Professor Image --}}
       <tr>
    <th>Photo(s)</th>
    <td>
        @if($teacher->images->count())
            @foreach($teacher->images as $image)
                <img src="{{ asset('storage/' . $image->image_path) }}" 
                     alt="Professor Image" 
                     class="img-thumbnail rounded me-2 mb-2" 
                     style="max-width: 120px; height: auto;">
            @endforeach
        @else
            <span class="text-muted">N/A</span>
        @endif
    </td>
</tr>


        <tr><th>Full Name</th><td>{{ $teacher->full_name }}</td></tr>
        <tr><th>Father Name</th><td>{{ $teacher->father_name }}</td></tr>
        <tr><th>CNIC</th><td>{{ $teacher->cnic }}</td></tr>
        <tr><th>Date of Birth</th><td>{{ \Carbon\Carbon::parse($teacher->dob)->format('d M Y') }}</td></tr>
        <tr><th>Gender</th><td>{{ $teacher->gender }}</td></tr>
        <tr><th>Email</th><td>{{ $teacher->email }}</td></tr>
        <tr><th>Phone</th><td>{{ $teacher->phone }}</td></tr>
        <tr><th>Salary Type</th><td>{{ ucfirst($teacher->salary_type) }}</td></tr>
        <tr><th>Salary</th><td>{{ number_format($teacher->salary, 2) }}</td></tr>
        <tr><th>Qualification</th><td>{{ $teacher->qualification }}</td></tr>
        <tr><th>Specialization</th><td>{{ $teacher->specialization }}</td></tr>
        <tr><th>Department ID</th><td>{{ $teacher->department_id }}</td></tr>
        <tr><th>Designation</th><td>{{ $teacher->designation }}</td></tr>
        <tr><th>Joining Date</th><td>{{ \Carbon\Carbon::parse($teacher->joining_date)->format('d M Y') }}</td></tr>
        <tr><th>Username</th><td>{{ $teacher->username }}</td></tr>
        <tr><th>Role</th><td>{{ $teacher->role }}</td></tr>

        {{-- Resume --}}
        <tr>
            <th>Resume</th>
            <td>
                @if($teacher->resume)
                    <a href="{{ asset('storage/' . $teacher->resume) }}" target="_blank" class="btn btn-primary btn-sm">
                        📄 View Resume
                    </a>
                @else
                    N/A
                @endif
            </td>
        </tr>

        <tr><th>Address</th><td>{{ $teacher->address }}</td></tr>
        <tr><th>Country</th><td>{{ $teacher->country }}</td></tr>
        <tr><th>City</th><td>{{ $teacher->city }}</td></tr>
        <tr><th>State</th><td>{{ $teacher->state }}</td></tr>
        <tr><th>Created At</th><td>{{ $teacher->created_at->format('d M Y h:i A') }}</td></tr>
        <tr><th>Updated At</th><td>{{ $teacher->updated_at->format('d M Y h:i A') }}</td></tr>
    </table>

    <a href="{{ route('display.professors') }}" class="btn btn-secondary">Back to List</a>
</div>

<x-admin-footer/>
