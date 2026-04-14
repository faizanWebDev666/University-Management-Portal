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

    // Access course through the offered course
    public function course()
    {
        return $this->hasOneThrough(
            Course::class,
            OfferCourse::class,
            'id',            // OfferCourse.id
            'id',            // Course.id
            'offered_course_id', // StudentCourseRegistration.offered_course_id
            'course_id'      // OfferCourse.course_id
        );
    }

    // Access professor through the offered course
    public function professor()
    {
        return $this->hasOneThrough(
            User::class,
            OfferCourse::class,
            'id',
            'id',
            'offered_course_id',
            'professor_id'
        );
    }

    // Access class through the offered course
    public function class()
    {
        return $this->hasOneThrough(
            Classes::class,
            OfferCourse::class,
            'id',
            'id',
            'offered_course_id',
            'class_id'
        );
    }

    // Accessor for course_id (used in controller filtering)
    public function getCourseIdAttribute()
    {
        return $this->offeredCourse?->course_id;
    }

    // Accessor for class_id (used in controller filtering)
    public function getClassIdAttribute()
    {
        return $this->offeredCourse?->class_id;
    }

    // Add this method
    public function attendances()
    {
        return $this->hasMany(\App\Models\Attendance::class, 'student_registration_id');
    }

}
