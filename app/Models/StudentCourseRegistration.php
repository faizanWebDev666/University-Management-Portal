<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentCourseRegistration extends Model
{

protected $fillable = [
    'student_id',
    'offered_course_id',
    'status',
];


public function student()
    {
        return $this->belongsTo(User::class, 'student_id')
                    ->where('type', 'student'); // Ensures only actual students are retrieved
    }

    public function offeredCourse()
    {
        return $this->belongsTo(OfferCourse::class, 'offered_course_id');
    }
    // Add this method
public function attendances()
{
    return $this->hasMany(\App\Models\Attendance::class, 'student_registration_id');
}

}
