<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminNotification extends Model
{
    protected $fillable = [
        'type',
        'related_id',
        'seen',
    ];

    // Optional: If you want to cast 'seen' to boolean
    protected $casts = [
        'seen' => 'boolean',
    ];

    // Optional: If you plan to relate to bookings (you'll need to define this properly)
    public function related()
    {
        // Example: You can customize based on type
        if ($this->type === 'TourBooking') {
            return $this->belongsTo(TourBooking::class, 'related_id');
        }

        if ($this->type === 'CarBooking') {
            return $this->belongsTo(CarBooking::class, 'related_id');
        }

        return null;
    }
}
