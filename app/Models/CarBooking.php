<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CarBooking extends Model
{
    protected $fillable = [
        'first_name', 'last_name', 'driver_age', 'mobile', 'email', 'special_requests',
        'pickup_location', 'pickup_date', 'return_location', 'return_date', 'same_location',
        'car_id', 'has_driver', 'child_seats',
        'base_price', 'addons_price', 'total_price', 'status'
    ];
    
    public function car()
    {
        return $this->belongsTo(Car::class);
    }
}
