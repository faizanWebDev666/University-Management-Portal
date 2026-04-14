<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentQuizSubmission extends Model
{
    protected $fillable = [
        'quiz_id',
        'student_id',
        'answer_file',
        'mcq_answers',
        'written_answer',
        'marks',
        'submitted_at',
    ];

    protected $casts = [
        'mcq_answers' => 'array',
        'submitted_at' => 'datetime',
        'marks' => 'float',
    ];

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function studentRegistration()
    {
        return $this->hasOne(StudentsRegistration::class, 'user_id', 'student_id');
    }

    public function quiz()
    {
        return $this->belongsTo(Quiz::class, 'quiz_id');
    }

}
