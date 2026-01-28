<x-hostel-heaser/>

<div class="container my-5">
    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-header bg-dark text-white fw-bold fs-5 px-4 py-3">
            ➕ Add New Hostel
        </div>

        <div class="card-body px-4 py-4">

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('hostel.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label fw-semibold">Hostel Name</label>
                    <input type="text" name="name" class="form-control rounded-3" placeholder="e.g. Boys Hostel A" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Hostel Type</label>
                    <select name="type" class="form-select rounded-3" required>
                        <option value="">Select Type</option>
                        <option value="Boys">Boys</option>
                        <option value="Girls">Girls</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Capacity</label>
                    <input type="number" name="capacity" class="form-control rounded-3" placeholder="Total number of students/rooms" min="1" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Address</label>
                    <textarea name="address" class="form-control rounded-3" rows="2" placeholder="Optional address of the hostel"></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Description</label>
                    <textarea name="description" class="form-control rounded-3" rows="3" placeholder="Optional description or notes"></textarea>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-success px-4 rounded-pill shadow-sm">Add Hostel</button>
                </div>
            </form>
        </div>
    </div>
</div>

<x-hostel-footer/>
