<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentsRegistration extends Model
{
    protected $fillable = [
        'full_name',
        'email',
        'phone_number',
        'cnic',
        'department',
        'roll_no',
        'degree_program',
        'address',
        'country',
        'city',
        'state_province',
        'class_id',
        'user_id',
    ];

    public function image()
    {
        return $this->hasOne(StudentImage::class, 'student_id');
    }

    public function class()
    {
        return $this->belongsTo(Classes::class, 'class_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

