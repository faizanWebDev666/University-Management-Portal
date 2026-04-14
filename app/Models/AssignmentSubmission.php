<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssignmentSubmission extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'assignment_id',
        'student_id',
        'file_path',
        'marks',
        'submitted_at',
    ];

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function assignment()
    {
        return $this->belongsTo(Assignment::class);
    }

}
