<x-hostel-heaser />

<style>
    .hostel-card {
        border: none;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        margin-bottom: 30px;
    }

    .hostel-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
    }

    .hostel-header {
        background: linear-gradient(135deg, #3f634d 0%, #2d4a37 100%);
        color: white;
        padding: 25px;
        border-radius: 12px 12px 0 0;
    }

    .hostel-title {
        font-size: 24px;
        font-weight: 700;
        margin-bottom: 10px;
    }

    .hostel-info {
        display: flex;
        gap: 20px;
        flex-wrap: wrap;
        font-size: 14px;
    }

    .info-item {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .info-badge {
        background-color: rgba(255, 255, 255, 0.2);
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 13px;
    }

    .rooms-container {
        padding: 25px;
    }

    .rooms-title {
        font-size: 18px;
        font-weight: 600;
        color: #3f634d;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .rooms-title::before {
        content: "🚪";
        font-size: 22px;
    }

    .room-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 18px;
    }

    .room-card {
        border: 2px solid #e8f4f1;
        border-radius: 10px;
        padding: 18px;
        background-color: #f9fdfb;
        transition: all 0.3s ease;
    }

    .room-card:hover {
        border-color: #3f634d;
        background-color: #f0f7f4;
        box-shadow: 0 4px 12px rgba(63, 99, 77, 0.1);
    }

    .room-name {
        font-size: 16px;
        font-weight: 700;
        color: #3f634d;
        margin-bottom: 12px;
    }

    .room-detail {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 8px 0;
        font-size: 13px;
        border-bottom: 1px solid #e8f4f1;
    }

    .room-detail:last-child {
        border-bottom: none;
    }

    .detail-label {
        color: #666;
        font-weight: 600;
    }

    .detail-value {
        color: #3f634d;
        font-weight: 700;
    }

    .room-type-badge {
        display: inline-block;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        margin-top: 10px;
    }

    .type-ac {
        background-color: #d4edda;
        color: #155724;
    }

    .type-nonac {
        background-color: #fff3cd;
        color: #856404;
    }

    .bathroom-badge {
        display: inline-block;
        margin-left: 8px;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
    }

    .bathroom-yes {
        background-color: #cfe2ff;
        color: #084298;
    }

    .bathroom-no {
        background-color: #f8d7da;
        color: #842029;
    }

    .empty-state {
        text-align: center;
        padding: 60px 20px;
        color: #999;
    }

    .empty-icon {
        font-size: 60px;
        margin-bottom: 20px;
        opacity: 0.5;
    }

    .hostel-description {
        color: rgba(255, 255, 255, 0.9);
        font-size: 14px;
        margin-top: 10px;
    }

    .no-rooms {
        text-align: center;
        padding: 30px;
        color: #999;
        font-style: italic;
    }

    .container-header {
        margin-bottom: 30px;
        padding-bottom: 20px;
        border-bottom: 3px solid #3f634d;
    }

    .page-title {
        font-size: 32px;
        font-weight: 700;
        color: #3f634d;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .page-title::before {
        content: "🏢";
        font-size: 36px;
    }

    .page-subtitle {
        color: #666;
        font-size: 14px;
        margin-top: 8px;
    }
</style>

<div class="container my-5">
    <div class="container-header">
        <h1 class="page-title">Available Hostels</h1>
        <p class="page-subtitle">Browse all available hostels and their rooms</p>
    </div>

    @if ($hostels->count() > 0)
        @foreach ($hostels as $hostel)
            <div class="card hostel-card">
                {{-- Hostel Header --}}
                <div class="hostel-header">
                    <div class="hostel-title">{{ $hostel->name }}</div>
                    <div class="hostel-info">
                        <div class="info-item">
                            <span>📍</span>
                            <span>{{ $hostel->address ?? 'Location not specified' }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-badge">{{ $hostel->type }}</span>
                        </div>
                        <div class="info-item">
                            <span>🛏️</span>
                            <span>{{ $hostel->rooms->count() }} Room{{ $hostel->rooms->count() !== 1 ? 's' : '' }}</span>
                        </div>
                    </div>
                    @if ($hostel->description)
                        <div class="hostel-description">
                            {{ $hostel->description }}
                        </div>
                    @endif
                </div>

                {{-- Rooms Section --}}
                <div class="rooms-container">
                    @if ($hostel->rooms->count() > 0)
                        <div class="rooms-title">Available Rooms</div>
                        <div class="room-grid">
                            @foreach ($hostel->rooms as $room)
                                <div class="room-card">
                                    <div class="room-name">{{ $room->name }}</div>

                                    <div class="room-detail">
                                        <span class="detail-label">Capacity:</span>
                                        <span class="detail-value">{{ $room->persons }} Person{{ $room->persons !== 1 ? 's' : '' }}</span>
                                    </div>

                                    <div class="room-detail">
                                        <span class="detail-label">Beds:</span>
                                        <span class="detail-value">{{ $room->beds }}</span>
                                    </div>

                                    <div class="room-detail">
                                        <span class="detail-label">Washrooms:</span>
                                        <span class="detail-value">{{ $room->washrooms }}</span>
                                    </div>

                                    <div class="room-detail">
                                        <span class="detail-label">Type:</span>
                                        <span class="detail-value">
                                            <span class="room-type-badge type-{{ $room->type === 'AC' ? 'ac' : 'nonac' }}">
                                                {{ $room->type }}
                                            </span>
                                        </span>
                                    </div>

                                    <div class="room-detail">
                                        <span class="detail-label">Bathroom:</span>
                                        <span class="detail-value">
                                            <span class="bathroom-badge bathroom-{{ $room->attached_bathroom ? 'yes' : 'no' }}">
                                                {{ $room->attached_bathroom ? '✓ Attached' : '✗ Common' }}
                                            </span>
                                        </span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="no-rooms">
                            <p>No rooms available for this hostel yet.</p>
                        </div>
                    @endif
                </div>
            </div>
        @endforeach
    @else
        <div class="empty-state">
            <div class="empty-icon">🏢</div>
            <h3>No Hostels Available</h3>
            <p>No hostels have been added yet. Please check back later!</p>
        </div>
    @endif
</div>
