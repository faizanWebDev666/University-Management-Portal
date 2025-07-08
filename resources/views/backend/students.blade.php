<x-admin-header />
<div class="section-body">
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center ">
            <div class="header-action">
                <h1 class="page-title">Professors</h1>
                <ol class="breadcrumb page-breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Students</li>
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
                        <th>Email</th>
                        <th>Phone Number</th>
                        <th>CNIC</th>
                        <th>Department</th>
                        <th>Roll No</th>
                        <th>Degree Program</th>
                        <th>Address</th>
                        <th>Country</th>
                        <th>City</th>
                        <th>State/Province</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($students as $student)
                        <tr>
                            <td>{{ $student->id }}</td>
                            <td>{{ $student->full_name }}</td>
                            <td>{{ $student->email }}</td>
                            <td>{{ $student->phone_number }}</td>
                            <td>{{ $student->cnic }}</td>
                            <td>{{ $student->department }}</td>
                            <td>{{ $student->roll_no }}</td>
                            <td>{{ $student->degree_program }}</td>
                            <td>{{ $student->address }}</td>
                            <td>{{ $student->country }}</td>
                            <td>{{ $student->city }}</td>
                            <td>{{ $student->state_province }}</td>
                            <td>{{ $student->created_at->format('d M Y') }}</td>
                            <td>
                                <a href="{{ route('students.show', $student->id) }}"
                                    class="btn btn-sm btn-outline-primary" title="View">
                                    <i class="fa fa-eye"></i>
                                </a>
                                <a href="{{ route('students.edit', $student->id) }}"
                                    class="btn btn-sm btn-outline-secondary" title="Edit">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <form action="{{ route('students.destroy', $student->id) }}" method="POST"
                                    style="display:inline-block;" onsubmit="return confirm('Are you sure?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger" title="Delete">
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
