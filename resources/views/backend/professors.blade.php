<x-admin-header />
<div class="section-body">
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center ">
            <div class="header-action">
                <h1 class="page-title">Professors</h1>
                <ol class="breadcrumb page-breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Professors</li>
                </ol>
            </div>
            <ul class="nav nav-tabs page-header-tab">
                <li class="nav-item"><a class="nav-link active"data-toggle="tab" href="#pro-all">List View</a></li>
                <li class="nav-item"><a class="nav-link"data-toggle="tab" href="#pro-grid">Grid View</a></li>
                <li class="nav-item"><a class="nav-link"data-toggle="tab" href="#pro-profile">Profile</a></li>
                <li class="nav-item"><a class="nav-link"data-toggle="tab" href="#pro-add">Add</a></li>
            </ul>
        </div>
    </div>
</div>
<div class="section-body mt-4">
    <div class="container-fluid">
        <div class="table-responsive">
            <table class="table table-hover table-vcenter text-nowrap mb-0">
                <thead class="bg-light">
                    <tr>
                        <th>ID</th>
                        <th>Full Name</th>
                        <th>Father Name</th>
                        <th>CNIC</th>
                        <th>Date of Birth</th>
                        <th>Gender</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Salary Type</th>
                        <th>Salary</th>
                        <th>Qualification</th>
                        <th>Specialization</th>
                        <th>Department ID</th>
                        <th>Designation</th>
                        <th>Joining Date</th>
                        <th>Username</th>
                        <th>Role</th>
                        <th>Resume</th>
                        <th>Address</th>
                        <th>Country</th>
                        <th>City</th>
                        <th>State</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
               <tbody id="professorsTableBody">
    @include('backend.partials.professors-rows', ['professors' => $teachers])
                    @foreach ($teachers as $teacher)
                        <tr>
                            <td>{{ $teacher->id }}</td>
                            <td>{{ $teacher->full_name }}</td>
                            <td>{{ $teacher->father_name }}</td>
                            <td>{{ $teacher->cnic }}</td>
                            <td>{{ \Carbon\Carbon::parse($teacher->dob)->format('d M Y') }}</td>
                            <td>{{ $teacher->gender }}</td>
                            <td>{{ $teacher->email }}</td>
                            <td>{{ $teacher->phone }}</td>
                            <td>{{ ucfirst($teacher->salary_type) }}</td>
                            <td>{{ number_format($teacher->salary, 2) }}</td>
                            <td>{{ $teacher->qualification }}</td>
                            <td>{{ $teacher->specialization }}</td>
                            <td>{{ $teacher->department_id }}</td>
                            <td>{{ $teacher->designation }}</td>
                            <td>{{ \Carbon\Carbon::parse($teacher->joining_date)->format('d M Y') }}</td>
                            <td>{{ $teacher->username }}</td>
                            <td>{{ $teacher->role }}</td>
                            <td>
                                @if ($teacher->resume)
                                    <a href="{{ asset('storage/' . $teacher->resume) }}" target="_blank">View</a>
                                @else
                                    N/A
                                @endif
                            </td>
                            <td>{{ $teacher->address }}</td>
                            <td>{{ $teacher->country }}</td>
                            <td>{{ $teacher->city }}</td>
                            <td>{{ $teacher->state }}</td>
                            <td>{{ $teacher->created_at->format('d M Y') }}</td>
                            <td>
                                <a href="{{ route('admin.teachers.show', $teacher->id) }}"
                                    class="btn btn-sm btn-outline-primary" title="View">
                                    <i class="fa fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.teachers.edit', $teacher->id) }}"
                                    class="btn btn-sm btn-outline-secondary" title="Edit">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.teachers.destroy', $teacher->id) }}" method="POST"
                                    style="display:inline-block;" onsubmit="return confirm('Are you sure?');">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete">
                                        <i class="fa fa-trash-o"></i>
                                    </button>
                                </form>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>




<x-admin-footer />
