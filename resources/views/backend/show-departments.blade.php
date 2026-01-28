<x-admin-header />

<div class="container mt-5">
    <h2 class="mb-4">Department: {{ $name }}</h2>

    {{-- Summary Section --}}
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Total Classes</h5>
                    <h3 class="text-primary">{{ count($classes) }}
</h3>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Total Students</h5>
                    <h3 class="text-success">{{ count($students) }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Total Teachers</h5>
                    <h3 class="text-dark"> {{ count($teachers) }}</h3>
                </div>
            </div>
        </div>
    </div>

    {{-- Classes Table --}}
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            Classes in {{ $name }} ({{ count($classes) }}
)
        </div>
        <div class="card-body">
            @if($classes->isEmpty())
                <p>No classes found for this department.</p>
            @else
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead class="table-primary">
                            <tr>
                                <th>#</th>
                                <th>Semester</th>
                                <th>Year</th>
                                <th>Section</th>
                                <th>Degree Program</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($classes as $index => $class)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $class->semester }}</td>
                                    <td>{{ $class->year }}</td>
                                    <td>{{ $class->section }}</td>
                                    <td>{{ $class->degree_program }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>

    {{-- Students Table --}}
    <div class="card mb-4">
        <div class="card-header bg-success text-white">
            Students in {{ $name }} ({{ count($students) }})
        </div>
        <div class="card-body">
            @if($students->isEmpty())
                <p>No students found for this department.</p>
            @else
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead class="table-success">
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Roll No</th>
                                <th>Degree Program</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($students as $index => $student)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $student->full_name }}</td>
                                    <td>{{ $student->roll_no }}</td>
                                    <td>{{ $student->degree_program }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>

    {{-- Teachers Table --}}
    <div class="card mb-4">
        <div class="card-header bg-dark text-white">
            Teachers in {{ $name }} ( {{ count($teachers) }})
        </div>
        <div class="card-body">
            @if($teachers->isEmpty())
                <p>No teachers found linked to this department.</p>
            @else
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead class="table-dark text-white">
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Designation</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($teachers as $index => $teacher)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $teacher->full_name }}</td>
                                    <td>{{ $teacher->designation }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>

    {{-- Back Button --}}
    <a href="{{ route('admin.department') }}" class="btn btn-secondary mt-3">Back to Departments</a>
</div>

<x-admin-footer />
