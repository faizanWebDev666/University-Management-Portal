<x-admin-header />

<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-1" style="color: #f35d85;">{{ $department->name }} ({{ $department->code }})</h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('departments.index') }}" style="color: #188ccc;">Departments</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Details</li>
                </ol>
            </nav>
        </div>
        <div class="btn-group">
            <a href="{{ route('departments.edit', $department->name) }}" class="btn btn-outline-info rounded-pill px-4 me-2">
                <i class="fa fa-edit mr-1"></i> Edit
            </a>
            <form action="{{ route('departments.destroy', $department->id) }}" method="POST" onsubmit="return confirm('Are you sure?');" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-outline-danger rounded-pill px-4">
                    <i class="fa fa-trash mr-1"></i> Delete
                </button>
            </form>
        </div>
    </div>

    <div class="row">
        <!-- Teachers Column -->
        <div class="col-md-4">
            <div class="card shadow-sm border-0 rounded-4 mb-4">
                <div class="card-header border-0 bg-light py-3">
                    <h5 class="mb-0 fw-bold text-dark"><i class="fa fa-user-md mr-2" style="color: #188ccc;"></i> Teachers</h5>
                </div>
                <div class="card-body p-0">
                    <ul class="list-group list-group-flush">
                        @forelse($teachers as $teacher)
                            <li class="list-group-item px-4 py-3 border-0 border-bottom">
                                <div class="fw-bold text-dark">{{ $teacher->full_name }}</div>
                                <small class="text-muted">{{ $teacher->email }}</small>
                            </li>
                        @empty
                            <li class="list-group-item px-4 py-4 text-center text-muted border-0">No teachers assigned.</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>

        <!-- Classes Column -->
        <div class="col-md-4">
            <div class="card shadow-sm border-0 rounded-4 mb-4">
                <div class="card-header border-0 bg-light py-3">
                    <h5 class="mb-0 fw-bold text-dark"><i class="fa fa-building mr-2" style="color: #188ccc;"></i> Classes</h5>
                </div>
                <div class="card-body p-0">
                    <ul class="list-group list-group-flush">
                        @forelse($classes as $class)
                            <li class="list-group-item px-4 py-3 border-0 border-bottom">
                                <div class="fw-bold text-dark">{{ $class->degree_program }} - {{ $class->semester }}</div>
                                <small class="text-muted">Section: {{ $class->section }}</small>
                            </li>
                        @empty
                            <li class="list-group-item px-4 py-4 text-center text-muted border-0">No classes registered.</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>

        <!-- Students Column -->
        <div class="col-md-4">
            <div class="card shadow-sm border-0 rounded-4 mb-4">
                <div class="card-header border-0 bg-light py-3">
                    <h5 class="mb-0 fw-bold text-dark"><i class="fa fa-graduation-cap mr-2" style="color: #188ccc;"></i> Students</h5>
                </div>
                <div class="card-body p-0">
                    <ul class="list-group list-group-flush">
                        @forelse($students as $student)
                            <li class="list-group-item px-4 py-3 border-0 border-bottom">
                                <div class="fw-bold text-dark">{{ $student->full_name }}</div>
                                <small class="text-muted">Roll No: {{ $student->roll_no }}</small>
                            </li>
                        @empty
                            <li class="list-group-item px-4 py-4 text-center text-muted border-0">No students enrolled.</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<x-admin-footer />
