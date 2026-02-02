<x-hostel-heaser />

<style>
    /* Custom header color for room cards */
    .room-header {
        background-color: #3f634d;
        color: white;
        font-weight: 600;
    }
</style>

<div class="container my-5">
    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-header text-white fw-bold fs-5 px-4 py-3" style="background-color: #3f634d;">
            ➕ Add New Hostel
        </div>


        <div class="card-body px-4 py-4">

            @if (session('success'))
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

                {{-- Hostel Basic Info --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">Hostel Name</label>
                    <input type="text" name="name" class="form-control rounded-3" placeholder="e.g. Boys Hostel A"
                        required>
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
                    <label class="form-label fw-semibold">Address</label>
                    <textarea name="address" class="form-control rounded-3" rows="2" placeholder="Optional address of the hostel"></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Description</label>
                    <textarea name="description" class="form-control rounded-3" rows="3" placeholder="Optional description or notes"></textarea>
                </div>

                {{-- Hostel-wide Facilities --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">Facilities</label>
                    <div class="form-check">
                        <input type="checkbox" name="facilities[internet]" class="form-check-input" id="internet">
                        <label class="form-check-label" for="internet">Internet Available</label>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" name="facilities[laundry]" class="form-check-input" id="laundry">
                        <label class="form-check-label" for="laundry">Laundry Service</label>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" name="facilities[mess]" class="form-check-input" id="mess">
                        <label class="form-check-label" for="mess">Mess Facility</label>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" name="facilities[parking]" class="form-check-input" id="parking">
                        <label class="form-check-label" for="parking">Parking Available</label>
                    </div>
                </div>

                {{-- Enter Room Names --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">Rooms (Enter names separated by comma)</label>
                    <input type="text" id="roomNamesInput" class="form-control rounded-3"
                        placeholder="e.g. 201,202,203">
                </div>

                {{-- Dynamic Room Cards --}}
                <div id="roomsContainer" class="row g-3 mb-3"></div>

                {{-- Submit Button --}}
                <div class="text-end">
                    <button type="submit" class="btn btn-success px-4 rounded-pill shadow-sm">Add Hostel</button>
                </div>
            </form>
        </div>
    </div>
</div>

<x-hostel-footer />

{{-- JavaScript for Dynamic Rooms --}}
<script>
    document.getElementById('roomNamesInput').addEventListener('input', function() {
        const names = this.value.split(',').map(n => n.trim()).filter(n => n !== '');
        const container = document.getElementById('roomsContainer');
        container.innerHTML = '';

        names.forEach(name => {
            container.innerHTML += `
            <div class="col-md-6">
                <div class="card shadow-sm border-0 rounded-4">
                    <div class="card-header room-header">
                        Room ${name}
                    </div>
                    <div class="card-body">
                        <div class="mb-2">
                            <label class="form-label">Number of Persons</label>
                            <input type="number" name="rooms[${name}][persons]" class="form-control" min="1" required>
                        </div>

                        <div class="mb-2">
                            <label class="form-label">Number of Beds</label>
                            <input type="number" name="rooms[${name}][beds]" class="form-control" min="1" required>
                        </div>

                        <div class="mb-2">
                            <label class="form-label">Number of Washrooms</label>
                            <input type="number" name="rooms[${name}][washrooms]" class="form-control" min="0" required>
                        </div>

                        <div class="mb-2">
                            <label class="form-label">Room Type</label>
                            <select name="rooms[${name}][type]" class="form-select" required>
                                <option value="">Select Type</option>
                                <option value="AC">AC</option>
                                <option value="Non-AC">Non-AC</option>
                            </select>
                        </div>

                        <div class="form-check">
                            <input type="checkbox" name="rooms[${name}][attached_bathroom]" class="form-check-input" id="attached${name}">
                            <label class="form-check-label" for="attached${name}">Attached Bathroom</label>
                        </div>
                    </div>
                </div>
            </div>
        `;
        });
    });
</script>
