<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeacherRegistration extends Model
{
    protected $fillable = [
        'full_name',
        'father_name',
        'cnic',
        'dob',
        'gender',
        'email',
        'phone',
        'salary_type',
        'salary',
        'qualification',
        'specialization',
        'department_id',
        'designation',
        'joining_date',
        'username',
        'password',
        'role',
        'resume',
        'address',
        'country',
        'city',
        'state',
    ];
    public function image()
{
    return $this->hasOne(TeacherImage::class, 'teacher_id', 'id');
}

}
