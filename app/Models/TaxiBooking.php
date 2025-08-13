<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TaxiBooking extends Model
{
    protected $fillable = [
        'pickup',
        'destination', 
        'date', 
        'time', 
        'passengers', 
        'category',
        'name', 
        'email', 
        'country', 
        'phone', 
        'comments',
        'status', // ✅ Add this
        'payment_status',
        'admin_comment',

        'has_return_ride',
        'return_date',
        'return_time',
        'child_seat',
        
        'pickup_latitude',
        'pickup_longitude',
        'destination_latitude',
        'destination_longitude'
    ];
    
    protected $casts = [
        'has_return_ride' => 'boolean', // ✅ ensures true/false in PHP
        'child_seat'      => 'integer', // ✅ ensures numeric value
        'date'            => 'date',
        'return_date'     => 'date',
        'time'            => 'string',
        'return_time'     => 'string',
        'pickup_latitude' => 'float',
        'pickup_longitude'=> 'float',
        'destination_latitude' => 'float',
        'destination_longitude'=> 'float',
    ];
}
