<x-admin-header/>
        <div class="section-body">
            <div class="container-fluid">
                <div class="d-flex justify-content-between align-items-center ">
                    <div class="header-action">
                        <h1 class="page-title">Professors</h1>
                        <ol class="breadcrumb page-breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Courses</li>
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
                        <th>semester</th>
                        
                        <th>year</th>
                        <th>department</th>
                        <th>degree_program</th>
                        <th>section</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($classes as $class)
                        <tr>
                            <td>{{ $class->id }}</td>
                             <td>{{ $class->semester }}</td>
                            <td>{{ $class->year }}</td>
                            <td>( {{ $class->department }} )</td>
                            <td>{{ $class->degree_program }}</td>
                            <td>{{ $class->section }}</td>
                            <td>{{ $class->created_at->format('d M Y') }}</td>
                           <td>
    <a href="{{ route('courses.show', $class->id) }}" class="btn btn-sm btn-outline-primary" title="View">
        <i class="fa fa-eye"></i>
    </a>
    <a href="{{ route('courses.edit', $class->id) }}" class="btn btn-sm btn-outline-secondary" title="Edit">
        <i class="fa fa-edit"></i>
    </a>
    <form action="{{ route('courses.destroy', $class->id) }}" method="POST" style="display:inline-block;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')" title="Delete">
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
<x-admin-footer/>