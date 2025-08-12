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
        
        'pickup_latitude',
        'pickup_longitude',
        'destination_latitude',
        'destination_longitude'
    ];
}
