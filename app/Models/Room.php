<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
      protected $fillable = [
        'hostel_id',
        'name',
        'persons',
        'beds',
        'washrooms',
        'type',
        'attached_bathroom',
    ];
    public function hostel()
    {
        return $this->belongsTo(Hostel::class);
    }

    public function allocations()
    {
        return $this->hasMany(RoomAllocation::class, 'room_id');
    }

    // Get occupied beds
    public function getOccupiedBeds()
    {
        return $this->allocations()
            ->where('status', 'allocated')
            ->pluck('bed_number')
            ->toArray();
    }

    // Get available beds
    public function getAvailableBeds()
    {
        $occupiedBeds = $this->getOccupiedBeds();
        $availableBeds = [];
        
        for ($i = 1; $i <= $this->beds; $i++) {
            if (!in_array($i, $occupiedBeds)) {
                $availableBeds[] = $i;
            }
        }
        
        return $availableBeds;
    }

    // Check if room has available beds
    public function hasAvailableBeds()
    {
        return count($this->getAvailableBeds()) > 0;
    }

    // Get available beds count
    public function getAvailableBedsCount()
    {
        return count($this->getAvailableBeds());
    }
}
