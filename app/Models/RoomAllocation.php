<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomAllocation extends Model
{
    use HasFactory;

    protected $fillable = [
        'hostel_request_id',
        'room_id',
        'student_id',
        'bed_number',
        'status',
        'allocated_at',
        'vacated_at',
        'notes'
    ];

    protected $dates = [
        'allocated_at',
        'vacated_at'
    ];

    protected $casts = [
        'allocated_at' => 'datetime',
        'vacated_at' => 'datetime'
    ];

    // Relationships
    public function hostelRequest()
    {
        return $this->belongsTo(HostelRequest::class, 'hostel_request_id');
    }

    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id');
    }

    public function student()
    {
        return $this->belongsTo(StudentsRegistration::class, 'student_id');
    }
}
