<x-admin-header/>

<div class="section-body mt-4">
    <div class="container-fluid">
        <div class="table-responsive">
            <table class="table table-hover table-vcenter text-nowrap mb-0">
                <thead class="bg-light">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Roles</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>

               <tbody id="usersTableBody">
    @include('backend.partials.users-rows', ['users' => $users])
                </tbody>

            </table>
        </div>
    </div>
</div>


<x-admin-footer/>
