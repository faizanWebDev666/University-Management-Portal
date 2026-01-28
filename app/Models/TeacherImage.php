<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeacherImage extends Model
{
    protected $fillable = [
        'Teacher_id',
        'image_path',
    ];
  
    public function teacher()
{
    return $this->belongsTo(TeacherRegistration::class, 'Teacher_id');
}
}


