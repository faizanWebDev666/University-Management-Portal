<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
     protected $fillable = [
        'student_registration_id', // ✅ correct column name (not just student_id)
        'offer_course_id',
        'status',
        'date',
        'time_slot',
    ];
}
