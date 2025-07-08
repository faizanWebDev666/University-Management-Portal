<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    protected $table = 'classes'; 

    protected $fillable = [
        'semester',
        'year',
        'section',
        'department',
        'degree_program',
    ];

    public function courses()
    {
        return $this->hasMany(Course::class, 'class_id');
    }
    public function users()
{
    return $this->hasMany(User::class, 'class_id');
}
public function offerCourses()
{
    return $this->hasMany(OfferCourse::class, 'class_id');
}
public function offeredCourses()
{
    return $this->hasMany(OfferCourse::class);
}
// App\Models\Classroom.php

public function getFormattedSemesterAttribute()
{
    $map = [
        'Fall' => 'FA',
        'Spring' => 'SP',
        'Summer' => 'SU',
    ];

    $abbr = $map[$this->semester] ?? strtoupper(substr($this->semester, 0, 2));
    $year = $this->year ? substr($this->year, -2) : 'NA';

    return $abbr . $year;
}


}
