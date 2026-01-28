<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
protected $fillable = [
        'name',
        'email',
        'password',
        'type',
        'active_status',
    ];
    public function class()
    {
        return $this->belongsTo(Classes::class, 'class_id');
    }

    // Relationship: user can register many courses
    public function courses()
    {
        return $this->belongsToMany(Course::class, 'course_user', 'user_id', 'course_id')->withTimestamps();
    }   
    public function offeredCourses()
{
    return $this->hasMany(OfferCourse::class, 'professor_id');
}
public function studentRegistration()
{
    return $this->hasOne(StudentsRegistration::class, 'email', 'email'); // Assuming matching on email
}
public function offerCourses()
{
    return $this->belongsToMany(OfferCourse::class, 'offer_course_user', 'user_id', 'offer_courses_id');
}
public function registeredCourses()
{
    return $this->belongsToMany(OfferCourse::class, 'student_course_registrations', 'student_id', 'offered_course_id');
}
// In User.php
public function registration()
{
    return $this->hasOne(StudentsRegistration::class, 'email', 'email');
}

public function submissions()
{
    return $this->hasMany(StudentQuizSubmission::class, 'student_id');
}


}
