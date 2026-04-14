<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfessorPermission extends Model
{
    protected $fillable = [
        'professor_id',
        'can_edit_marked_attendance',
    ];

    protected $casts = [
        'can_edit_marked_attendance' => 'boolean',
    ];

    public function professor()
    {
        return $this->belongsTo(User::class, 'professor_id');
    }
}
