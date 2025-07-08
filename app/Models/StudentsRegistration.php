<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentsRegistration extends Model
{
    public function image()
{
    return $this->hasOne(StudentImage::class, 'student_id');
}
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
];

}
