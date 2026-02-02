<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Course extends Model
{
    protected $table = 'courses';

    protected $fillable = [
        'uuid',
        'course_name',
        'course_code',
        'credit_hours',
        'description',
        'class_id',
    ];

    protected $casts = [
        'uuid' => 'string',
    ];

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->uuid)) {
                $model->uuid = (string) Str::uuid();
            }
        });
    }
  
    // Many-to-many relationship with users (professors)
    public function professors()
    {
        return $this->belongsToMany(User::class, 'course_user', 'course_id', 'user_id');
    }

    // Each course belongs to one class
    public function class()
    {
        return $this->belongsTo(Classes::class, 'class_id');
    }
    

public function students()
{
    return $this->belongsToMany(User::class)->withTimestamps();
}
public function offerCourses()
{
    return $this->hasMany(OfferCourse::class);
}
public function offeredCourses()
{
    return $this->hasMany(OfferCourse::class);
}
public function users()
{
    return $this->belongsToMany(User::class)->withTimestamps();
}
public function teacher()
{
    return $this->belongsTo(User::class, 'teacher_id'); // assuming courses table has teacher_id
}

}
