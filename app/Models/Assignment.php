<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    protected $fillable = [
    'assignment_title',
    'assignment_file',
    'deadline',
    'teacher_id',
    'course_id',
    'class_id',
    'total_marks',
];
public function submissions()
{
    return $this->hasMany(AssignmentSubmission::class);
}

public function teacher()
{
    return $this->belongsTo(User::class, 'teacher_id');
}
// Assignment.php
public function class()
{
    return $this->belongsTo(Classes::class, 'class_id'); // adjust class name and key
}

public function course()
{
    return $this->belongsTo(Course::class, 'course_id');
}

}
