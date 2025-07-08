<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeacherImage extends Model
{
    protected $fillable = [
        'Teacher_id',
        'image_path',
    ];
}
