<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HostelRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'hostel_type',
        'room_type',
        'duration',
        'semester',
        'emergency_name',
        'emergency_number',
        'medical_info',
        'address',
        'reason',
        'status'
    ];

    // Optional: relationship with student
    public function student()
    {
        return $this->belongsTo(StudentsRegistration::class, 'student_id');
    }
}
