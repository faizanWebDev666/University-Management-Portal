<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OfferCourse extends Model
{
   
        protected $table = 'offer_courses';
        protected $fillable = ['course_id', 'class_id', 'professor_id'];

public function professor()
{
    return $this->belongsTo(User::class, 'professor_id')->where('type', 'professor');
}

public function students()
{
    return $this->belongsToMany(User::class, 'offer_course_user')->where('type', 'student');
}
public function course()
{
    return $this->belongsTo(Course::class, 'course_id');
}

public function class()
{
    return $this->belongsTo(Classes::class, 'class_id');
}

public function registrations()
{
    return $this->hasMany(StudentCourseRegistration::class, 'offered_course_id');
}






}
