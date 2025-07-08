<x-admin-header />
<div class="section-body">
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center ">
            <div class="header-action">
                <h1 class="page-title">Leave Requests</h1>
                <ol class="breadcrumb page-breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Leave Requests</li>
                </ol>
            </div>
            <ul class="nav nav-tabs page-header-tab">
                <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#leave-all">List View</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#leave-grid">Grid View</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#leave-profile">Profile</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#leave-add">Add</a></li>
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
                        <th>Teacher Name</th>
                        <th>Leave Type</th>
                        <th>From</th>
                        <th>To</th>
                        <th>Status</th>
                        <th>Requested At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($leaveRequests as $request)
                        <tr>
                            <td>{{ $request->id }}</td>
                            <td>{{ $request->faculty->name ?? 'N/A' }}</td>
                            <td>{{ $request->leave_type }}</td>
                            <td>{{ $request->from_date }}</td>
                            <td>{{ $request->to_date }}</td>
                            <td>
                                <span
                                    class="badge 
                                    {{ $request->status == 'Approved' ? 'badge-success' : ($request->status == 'Rejected' ? 'badge-danger' : 'badge-warning') }}">
                                    {{ $request->status }}
                                </span>
                            </td>
                            <td>{{ $request->created_at->format('d M Y') }}</td>
                            <td>
                                <a href="{{ route('leaves.edit', $request->id) }}"
                                    class="btn btn-sm btn-outline-secondary" title="Edit">
                                    <i class="fa fa-edit"></i>
                                </a>

                                <form action="{{ route('leaves.destroy', $request->id) }}" method="POST"
                                    style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger"
                                        onclick="return confirm('Are you sure?')" title="Delete">
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
