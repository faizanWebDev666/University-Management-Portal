<x-admin-header/>

<div class="section-body">
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center">
            <div class="header-action">
                <h1 class="page-title">Finance Dashboard</h1>
                <ol class="breadcrumb page-breadcrumb">
                    <li class="breadcrumb-item"><a href="#">University</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Finance Dashboard</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="section-body mt-4">
    <div class="container-fluid">
        <div class="row clearfix row-deck">
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="card overflow-hidden">
                    <div class="card-body">
                        <div class="mb-2 h6">Total Students</div>
                        <div><span class="h4 font700">{{ $totalStudents }}</span></div>
                        <small class="text-muted">Students available for fee management</small>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="card overflow-hidden">
                    <div class="card-body">
                        <div class="mb-2 h6">Fee Collections</div>
                        <div><span class="h4 font700">0</span></div>
                        <small class="text-muted">Collected fees will appear here</small>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="card overflow-hidden">
                    <div class="card-body">
                        <div class="mb-2 h6">Pending Fees</div>
                        <div><span class="h4 font700">0</span></div>
                        <small class="text-muted">Pending payments by students</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="row clearfix row-deck">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Student Fee Records</h3>
                    </div>
                    <div class="table-responsive">
                        <table class="table card-table table-vcenter text-nowrap table-striped mb-0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Department</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($students as $student)
                                    <tr>
                                        <td>{{ $loop->iteration + ($students->currentPage() - 1) * $students->perPage() }}</td>
                                        <td>{{ $student->name }}</td>
                                        <td>{{ $student->email }}</td>
                                        <td>{{ $student->department ?? 'N/A' }}</td>
                                        <td><span class="badge badge-warning">Pending</span></td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">No students found yet.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer d-flex justify-content-end">
                        {{ $students->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<x-admin-footer/>
