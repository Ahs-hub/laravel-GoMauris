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
        return match ($this->type) {
            'TourBooking' => $this->belongsTo(\App\Models\TourBooking::class, 'related_id'),
            'CarBooking' => $this->belongsTo(\App\Models\CarBooking::class, 'related_id'),
            'TaxiBooking' => $this->belongsTo(\App\Models\TaxiBooking::class, 'related_id'),
            default => null,
        };
    }
}
