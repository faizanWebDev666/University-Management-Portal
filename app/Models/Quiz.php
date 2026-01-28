<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    protected $fillable = [
    'course_id',
    'class_id',
    'quiz_title',
    'quiz_type',
    'quiz_file',
    'quiz_data',
    'written_questions',
    'deadline',
    'deadline_time',
    'teacher_id'
];


public function course()
{
    return $this->belongsTo(Course::class, 'course_id');
}

public function class()
{
    return $this->belongsTo(Classes::class, 'class_id');
}

public function submissions()
{
    return $this->hasMany(StudentQuizSubmission::class, 'quiz_id');
}

}
