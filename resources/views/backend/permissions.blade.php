<x-admin-header/>

<div class="section-body">
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center">
            <div class="header-action">
                <h1 class="page-title">Permissions</h1>
                <ol class="breadcrumb page-breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Ericsson</a></li>
                    <li class="breadcrumb-item"><a href="#">Admin</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Permissions</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="section-body mt-4">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Professor Attendance Permissions</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.permissions.update') }}" method="POST">
                    @csrf
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th class="text-center">Can Edit Marked Attendance</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($professors as $professor)
                                    <tr>
                                        <td>{{ $professor->name }}</td>
                                        <td>{{ $professor->email }}</td>
                                        <td class="text-center">
                                            <input type="hidden" name="permissions[{{ $professor->id }}]" value="0">
                                            <input
                                                type="checkbox"
                                                name="permissions[{{ $professor->id }}]"
                                                value="1"
                                                {{ !empty($permissions[$professor->id]) ? 'checked' : '' }}
                                            >
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center text-muted">No professors found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <button type="submit" class="btn btn-primary">Save Permissions</button>
                </form>
            </div>
        </div>
    </div>
</div>

<x-admin-footer/>
