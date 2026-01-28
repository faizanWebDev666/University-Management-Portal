<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $fillable = [
        'student_registration_id', // ✅ Matches your column name
        'offer_course_id',
        'status',
        'date',
        'time_slot',
    ];

    // (Optional) If your table name is not 'attendances', explicitly define it:
    // protected $table = 'attendance';

    // (Optional) Disable timestamps if your table doesn't have created_at & updated_at
    // public $timestamps = false;

    // ✅ Define relationships (best practice)
    public function student()
    {
        return $this->belongsTo(User::class, 'student_registration_id', 'id');
    }

    public function offerCourse()
    {
        return $this->belongsTo(OfferCourse::class, 'offer_course_id', 'id');
    }
}
