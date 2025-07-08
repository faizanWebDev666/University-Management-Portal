<x-admin-header />

<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Departments</h2>
        <!-- Add New Department -->
        <a href="{{ url('/department/create') }}" class="btn btn-success">+ Add New Department</a>
    </div>

    <ul class="list-group">
        @php
            $departments = [
                'Computer Science',
                'Mechanical Engineering',
                'Electrical Engineering',
                'Civil Engineering',
                'Business Administration',
                'Mathematics',
                'Physics',
                'Chemistry'
            ];
        @endphp

        @foreach($departments as $dept)
            <li class="list-group-item">
                <div class="d-flex justify-content-between align-items-center">
                    <!-- Department Name (linked to details page) -->
                    <a href="{{ url('/department/' . urlencode($dept)) }}" class="text-decoration-none fw-bold text-dark">
                        {{ $dept }}
                    </a>

                    <!-- Admin Actions -->
                    <div class="btn-group btn-group-sm" role="group">
                        <!-- View Details -->
                        <a href="{{ url('/department/' . urlencode($dept)) }}" class="btn btn-outline-primary" title="View Details">View</a>

                        <!-- Edit Department -->
                        <a href="{{ url('/department/' . urlencode($dept) . '/edit') }}" class="btn btn-outline-warning" title="Edit Department">Edit</a>

                        <!-- Delete Department -->
                        <form action="{{ url('/department/' . urlencode($dept)) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this department?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger" title="Delete Department">Delete</button>
                        </form>

                        <!-- Manage Faculty -->
                        <a href="{{ url('/department/' . urlencode($dept) . '/faculty') }}" class="btn btn-outline-info" title="Manage Faculty">Faculty</a>

                        <!-- Manage Courses -->
                        <a href="{{ url('/department/' . urlencode($dept) . '/courses') }}" class="btn btn-outline-secondary" title="Manage Courses">Courses</a>

                        <!-- Manage Students -->
                        <a href="{{ url('/department/' . urlencode($dept) . '/students') }}" class="btn btn-outline-dark" title="Manage Students">Students</a>
                    </div>
                </div>
            </li>
        @endforeach
    </ul>
</div>

<x-admin-footer />
