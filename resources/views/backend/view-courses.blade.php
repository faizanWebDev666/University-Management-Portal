<x-admin-header/>

<div class="container mt-5">
    <h2>Course Details</h2>
    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <td>{{ $course->id }}</td>
        </tr>
        <tr>
            <th>Course Name</th>
            <td>{{ $course->course_name }}</td>
        </tr>
        <tr>
            <th>Course Code</th>
            <td>{{ $course->course_code }}</td>
        </tr>
        <tr>
            <th>Credit Hours</th>
            <td>{{ $course->credit_hours }}</td>
        </tr>
        <tr>
            <th>Description</th>
            <td>{{ $course->description }}</td>
        </tr>
        <tr>
            <th>Created At</th>
            <td>{{ $course->created_at->format('d M Y') }}</td>
        </tr>
    </table>
    <a href="{{ route('display.Courses') }}" class="btn btn-secondary">Back to List</a>
</div>

<x-admin-footer/>
