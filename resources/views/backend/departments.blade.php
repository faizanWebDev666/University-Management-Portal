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
                'CS' => 'Computer Science',
                'Mechanical Engineering' => 'Mechanical Engineering',
                'EE' => 'Electrical Engineering',
                'Civil Engineering' => 'Civil Engineering',
                'Business Administration' => 'Business Administration',
                'Mathematics' => 'Mathematics',
                'Physics' => 'Physics',
                'Chemistry' => 'Chemistry'
            ];
        @endphp

        @foreach($departments as $key => $dept)
            <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-center"
                style="cursor: pointer; transition: background-color 0.2s;"
                onmouseover="this.style.backgroundColor='#f8f9fa';"
                onmouseout="this.style.backgroundColor='';"
            >
                <!-- Department Name (linked to details page) -->
                <a href="{{ url('/department/' . urlencode($key)) }}" class="text-decoration-none fw-bold text-dark">
                    {{ $dept }}
                </a>
            </li>
        @endforeach
    </ul>
</div>

<x-admin-footer />
