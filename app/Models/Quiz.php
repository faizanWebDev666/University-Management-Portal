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
];
public function course()
{
    return $this->belongsTo(Course::class);
}

public function class()
{
    return $this->belongsTo(Classes::class); // Use your correct class model name
}

}
