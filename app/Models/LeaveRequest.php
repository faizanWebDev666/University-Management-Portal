<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LeaveRequest extends Model
{
    protected $fillable = [
    'faculty_id',
    'leave_type',
    'from_date',
    'to_date',
    'reason',
    'status',
];
// app/Models/LeaveRequest.php

public function faculty()
{
    return $this->belongsTo(User::class, 'faculty_id');
}



}
