<x-hostel-heaser />

<style>
    .allocation-container {
        background: #f8f9fa;
        border-radius: 12px;
        padding: 30px;
        margin-bottom: 30px;
    }

    .section-header {
        font-size: 24px;
        font-weight: 700;
        color: #3f634d;
        margin-bottom: 25px;
        display: flex;
        align-items: center;
        gap: 12px;
        padding-bottom: 15px;
        border-bottom: 3px solid #3f634d;
    }

    .section-header::before {
        font-size: 28px;
    }

    .pending-requests-section .section-header::before {
        content: "📝";
    }

    .active-allocations-section .section-header::before {
        content: "✅";
    }

    .request-card {
        background: white;
        border: 2px solid #e8f4f1;
        border-radius: 10px;
        padding: 20px;
        margin-bottom: 18px;
        transition: all 0.3s ease;
    }

    .request-card:hover {
        border-color: #3f634d;
        box-shadow: 0 4px 12px rgba(63, 99, 77, 0.1);
    }

    .request-header {
        display: flex;
        justify-content: space-between;
        align-items: start;
        margin-bottom: 15px;
    }

    .student-name {
        font-size: 18px;
        font-weight: 700;
        color: #3f634d;
        margin-bottom: 8px;
    }

    .request-details {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 12px;
        margin-bottom: 15px;
        font-size: 14px;
    }

    .detail-item {
        background: #f9fdfb;
        padding: 10px 12px;
        border-radius: 6px;
        border-left: 3px solid #3f634d;
    }

    .detail-label {
        color: #666;
        font-weight: 600;
        margin-bottom: 4px;
    }

    .detail-value {
        color: #3f634d;
        font-weight: 700;
    }

    .allocation-form {
        background: #f0f7f4;
        padding: 15px;
        border-radius: 8px;
        margin-top: 15px;
    }

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr 1fr auto;
        gap: 12px;
        align-items: flex-end;
    }

    .hostel-select, .room-select, .bed-select {
        width: 100%;
    }

    .bed-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(80px, 1fr));
        gap: 10px;
        margin-top: 10px;
    }

    .bed-option {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .bed-radio {
        cursor: pointer;
        accent-color: #3f634d;
        width: 18px;
        height: 18px;
    }

    .bed-label {
        cursor: pointer;
        padding: 8px 12px;
        border: 2px solid #e8f4f1;
        border-radius: 6px;
        background: white;
        font-weight: 600;
        color: #3f634d;
        transition: all 0.3s ease;
        user-select: none;
        width: 100%;
        text-align: center;
    }

    .bed-option input[type="radio"]:checked + .bed-label {
        background-color: #3f634d;
        color: white;
        border-color: #3f634d;
    }

    .bed-label:hover {
        border-color: #3f634d;
        background-color: #f9fdfb;
    }

    .bed-option input[type="radio"]:disabled + .bed-label {
        background-color: #f0f0f0;
        color: #999;
        border-color: #ccc;
        cursor: not-allowed;
    }

    .allocate-btn {
        background-color: #3f634d;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 6px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .allocate-btn:hover {
        background-color: #2d4a37;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(63, 99, 77, 0.2);
    }

    .allocate-btn:disabled {
        background-color: #ccc;
        cursor: not-allowed;
        transform: none;
    }

    .room-option {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 8px 0;
    }

    .room-availability {
        font-size: 12px;
        color: #666;
        margin-left: 10px;
    }

    .availability-full {
        color: #dc3545;
        font-weight: 600;
    }

    .availability-available {
        color: #28a745;
        font-weight: 600;
    }

    .allocated-card {
        background: white;
        border: 2px solid #d4edda;
        border-radius: 10px;
        padding: 20px;
        margin-bottom: 18px;
        display: grid;
        grid-template-columns: 1fr 1fr auto;
        gap: 20px;
        align-items: center;
    }

    .allocated-info {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 15px;
    }

    .info-block {
        font-size: 14px;
    }

    .info-label {
        color: #666;
        font-weight: 600;
        margin-bottom: 4px;
    }

    .info-value {
        color: #3f634d;
        font-weight: 700;
        font-size: 15px;
    }

    .status-badge {
        display: inline-block;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        background-color: #d4edda;
        color: #155724;
    }

    .remove-btn {
        background-color: #dc3545;
        color: white;
        border: none;
        padding: 8px 16px;
        border-radius: 6px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .remove-btn:hover {
        background-color: #c82333;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(220, 53, 69, 0.2);
    }

    .empty-state {
        text-align: center;
        padding: 40px;
        color: #999;
        background: white;
        border-radius: 8px;
        border: 2px dashed #e8f4f1;
    }

    .empty-icon {
        font-size: 50px;
        margin-bottom: 15px;
        opacity: 0.5;
    }

    .alert {
        border-radius: 8px;
        padding: 15px 20px;
        margin-bottom: 20px;
    }

    .alert-success {
        background-color: #d4edda;
        border: 2px solid #c3e6cb;
        color: #155724;
    }

    .alert-error {
        background-color: #f8d7da;
        border: 2px solid #f5c6cb;
        color: #721c24;
    }

    .stats-row {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }

    .stat-card {
        background: white;
        border-left: 4px solid #3f634d;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    }

    .stat-label {
        color: #666;
        font-size: 14px;
        margin-bottom: 8px;
    }

    .stat-value {
        font-size: 28px;
        font-weight: 700;
        color: #3f634d;
    }
</style>

<div class="container my-5">
    {{-- Success/Error Messages --}}
    @if (session('success'))
        <div class="alert alert-success">
            ✓ {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-error">
            ✗ {{ session('error') }}
        </div>
    @endif

    {{-- Stats --}}
    <div class="stats-row">
        <div class="stat-card">
            <div class="stat-label">📋 Pending Requests</div>
            <div class="stat-value">{{ $pendingRequests->count() }}</div>
        </div>
        <div class="stat-card">
            <div class="stat-label">✅ Allocated Students</div>
            <div class="stat-value">{{ $allocations->where('status', 'allocated')->count() }}</div>
        </div>
        <div class="stat-card">
            <div class="stat-label">🏢 Available Rooms</div>
            <div class="stat-value">
                @php
                    $totalRooms = 0;
                    foreach ($hostels as $hostel) {
                        $totalRooms += $hostel->rooms->count();
                    }
                @endphp
                {{ $totalRooms }}
            </div>
        </div>
    </div>

    {{-- Pending Requests Section --}}
    <div class="allocation-container pending-requests-section">
        <div class="section-header">Pending Hostel Requests</div>

        @if ($pendingRequests->count() > 0)
            @foreach ($pendingRequests as $request)
                <div class="request-card">
                    <div class="request-header">
                        <div>
                            <div class="student-name">
                                {{ $request->student->name ?? 'N/A' }} {{ $request->student->last_name ?? 'N/A' }}
                            </div>
                            <span class="badge bg-warning">Pending</span>
                        </div>
                    </div>

                    <div class="request-details">
                        <div class="detail-item">
                            <div class="detail-label">👤 Student ID</div>
                            <div class="detail-value">{{ $request->student_id }}</div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-label">🏘️ Hostel Type</div>
                            <div class="detail-value">{{ $request->hostel_type }}</div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-label">🛏️ Room Type</div>
                            <div class="detail-value">{{ $request->room_type }}</div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-label">📅 Semester</div>
                            <div class="detail-value">{{ $request->semester }}</div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-label">📞 Emergency Contact</div>
                            <div class="detail-value">{{ $request->emergency_number }}</div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-label">⏱️ Duration</div>
                            <div class="detail-value">{{ $request->duration }} Semester{{ $request->duration > 1 ? 's' : '' }}</div>
                        </div>
                    </div>

                    {{-- Allocation Form --}}
                    <form action="{{ route('hostel.allocate') }}" method="POST" class="allocation-form">
                        @csrf
                        <input type="hidden" name="hostel_request_id" value="{{ $request->id }}">

                        <div class="form-row">
                            <div>
                                <label class="form-label fw-semibold">Select Hostel</label>
                                <select name="hostel_id" class="form-control hostel-select" required onchange="updateRoomOptions(this, {{ $request->id }})">
                                    <option value="">-- Select Hostel --</option>
                                    @foreach ($hostels as $hostel)
                                        @if ($hostel->type === $request->hostel_type)
                                            <option value="{{ $hostel->id }}">{{ $hostel->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label class="form-label fw-semibold">Select Room</label>
                                <select name="room_id" class="form-control room-select" id="rooms-{{ $request->id }}" required onchange="updateBedOptions(this, {{ $request->id }}, '{{ $request->room_type }}')">
                                    <option value="">-- Select Room --</option>
                                </select>
                            </div>

                            <div>
                                <label class="form-label fw-semibold">Select Bed</label>
                                <select name="bed_number" class="form-control bed-select" id="beds-{{ $request->id }}" required>
                                    <option value="">-- Select Bed --</option>
                                </select>
                            </div>

                            <div>
                                <button type="submit" class="allocate-btn">Allocate</button>
                            </div>
                        </div>
                    </form>
                </div>
            @endforeach
        @else
            <div class="empty-state">
                <div class="empty-icon">✅</div>
                <h4>No Pending Requests</h4>
                <p>All hostel requests have been processed!</p>
            </div>
        @endif
    </div>

    {{-- Allocated Students Section --}}
    <div class="allocation-container active-allocations-section">
        <div class="section-header">Currently Allocated Students</div>

        @if ($allocations->where('status', 'allocated')->count() > 0)
            @foreach ($allocations->where('status', 'allocated') as $allocation)
                <div class="allocated-card">
                    <div class="allocated-info">
                        <div class="info-block">
                            <div class="info-label">👤 Student Name</div>
                            <div class="info-value">{{ $allocation->student->first_name ?? 'N/A' }} {{ $allocation->student->last_name ?? 'N/A' }}</div>
                        </div>
                        <div class="info-block">
                            <div class="info-label">🏢 Hostel</div>
                            <div class="info-value">{{ $allocation->room->hostel->name ?? 'N/A' }}</div>
                        </div>
                    </div>

                    <div class="allocated-info">
                        <div class="info-block">
                            <div class="info-label">🚪 Room</div>
                            <div class="info-value">{{ $allocation->room->name ?? 'N/A' }} - Bed #{{ $allocation->bed_number }}</div>
                        </div>
                        <div class="info-block">
                            <div class="info-label">📅 Allocated On</div>
                            <div class="info-value">
                                @if ($allocation->allocated_at)
                                    {{ is_string($allocation->allocated_at) ? \Carbon\Carbon::parse($allocation->allocated_at)->format('M d, Y') : $allocation->allocated_at->format('M d, Y') }}
                                @else
                                    N/A
                                @endif
                            </div>
                        </div>
                    </div>

                    <div style="display: flex; gap: 10px; align-items: center;">
                        <span class="status-badge">✓ Allocated</span>
                        <form action="{{ route('hostel.allocation.remove', $allocation->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to remove this allocation?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="remove-btn">Remove</button>
                        </form>
                    </div>
                </div>
            @endforeach
        @else
            <div class="empty-state">
                <div class="empty-icon">📭</div>
                <h4>No Allocations Yet</h4>
                <p>No students have been allocated rooms yet.</p>
            </div>
        @endif
    </div>
</div>

<script>
    function updateRoomOptions(hostelSelect, requestId) {
        const hostelId = hostelSelect.value;
        const roomSelect = document.getElementById(`rooms-${requestId}`);
        const bedSelect = document.getElementById(`beds-${requestId}`);
        
        // Find hostel data
        const hostels = {!! json_encode($hostels->map(fn($h) => [
            'id' => $h->id,
            'rooms' => $h->rooms->map(fn($r) => [
                'id' => $r->id,
                'name' => $r->name,
                'beds' => $r->beds,
                'persons' => $r->persons,
                'type' => $r->type
            ])
        ])->keyBy('id')) !!};

        // Get allocated beds
        const allocatedBeds = {!! json_encode($allocations->where('status', 'allocated')->groupBy('room_id')->map(function($group) {
            return $group->groupBy('bed_number')->map(fn($beds) => $beds->first()->bed_number)->values();
        })) !!};

        roomSelect.innerHTML = '<option value="">-- Select Room --</option>';
        bedSelect.innerHTML = '<option value="">-- Select Bed --</option>';

        if (hostelId && hostels[hostelId]) {
            const hostel = hostels[hostelId];
            hostel.rooms.forEach(room => {
                const roomOccupiedBeds = allocatedBeds[room.id] || [];
                const availableBeds = room.beds - roomOccupiedBeds.length;
                const isAvailable = availableBeds > 0;

                const option = document.createElement('option');
                option.value = room.id;
                option.textContent = `${room.name} (${room.type}) - ${room.beds} Beds - ${availableBeds} Available`;
                option.disabled = !isAvailable;
                roomSelect.appendChild(option);
            });
        }
    }

    function updateBedOptions(roomSelect, requestId, roomType) {
        const roomId = roomSelect.value;
        const bedSelect = document.getElementById(`beds-${requestId}`);
        
        // Find room data
        const allRooms = {!! json_encode($hostels->flatMap(fn($h) => $h->rooms->map(fn($r) => [
            'id' => $r->id,
            'beds' => $r->beds,
            'name' => $r->name
        ]))->keyBy('id')) !!};

        // Get allocated beds for this room
        const allocations = {!! json_encode($allocations->where('status', 'allocated')->map(fn($a) => [
            'room_id' => $a->room_id,
            'bed_number' => $a->bed_number
        ])) !!};

        bedSelect.innerHTML = '<option value="">-- Select Bed --</option>';

        if (roomId && allRooms[roomId]) {
            const room = allRooms[roomId];
            const occupiedBeds = allocations
                .filter(a => a.room_id == roomId)
                .map(a => a.bed_number);

            for (let bed = 1; bed <= room.beds; bed++) {
                const isOccupied = occupiedBeds.includes(bed);
                
                const option = document.createElement('option');
                option.value = bed;
                option.textContent = `Bed #${bed} ${isOccupied ? '(Occupied)' : '(Available)'}`;
                option.disabled = isOccupied;
                bedSelect.appendChild(option);
            }
        }
    }
</script>
