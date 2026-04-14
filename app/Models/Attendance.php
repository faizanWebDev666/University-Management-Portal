<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $fillable = [
        'offer_course_id',
        'date',
        'time_slot',
        'attendance_data',
    ];

    protected $casts = [
        'attendance_data' => 'array',
        'date' => 'date',
    ];

    // ✅ Define relationships (best practice)
    public function offerCourse()
    {
        return $this->belongsTo(OfferCourse::class, 'offer_course_id', 'id');
    }

    /**
     * Helper to get status for a specific student
     */
    public function getStatusForStudent($studentRegistrationId)
    {
        return $this->attendance_data[$studentRegistrationId] ?? null;
    }
}
