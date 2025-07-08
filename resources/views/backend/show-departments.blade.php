<x-admin-header />

<div class="container mt-5">
    <h2 class="mb-4">Department: {{ $name }}</h2>

    {{-- Classes --}}
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">Classes in {{ $name }}</div>
        <div class="card-body">
            @if($classes->isEmpty())
                <p>No classes found for this department.</p>
            @else
                <ul class="list-group">
                    @foreach($classes as $class)
                        <li class="list-group-item">
                            {{ $class->semester }} {{ $class->year }} - Section {{ $class->section }} ({{ $class->degree_program }})
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>

    {{-- Students --}}
    <div class="card mb-4">
        <div class="card-header bg-success text-white">Students in {{ $name }}</div>
        <div class="card-body">
            @if($students->isEmpty())
                <p>No students found for this department.</p>
            @else
                <ul class="list-group">
                    @foreach($students as $student)
                        <li class="list-group-item">
                            {{ $student->full_name }} ({{ $student->roll_no }}) - {{ $student->degree_program }}
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>

    {{-- Teachers --}}
    <div class="card mb-4">
        <div class="card-header bg-dark text-white">Teachers (Linked by ID)</div>
        <div class="card-body">
            @if($teachers->isEmpty())
                <p>No teachers found linked to this department.</p>
            @else
                <ul class="list-group">
                    @foreach($teachers as $teacher)
                        <li class="list-group-item">
                            {{ $teacher->full_name }} - {{ $teacher->designation }}
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>

    {{-- Back Button --}}
    <a href="{{ route('admin.department') }}" class="btn btn-secondary mt-3">Back to Departments</a>
</div>

<x-admin-footer />
