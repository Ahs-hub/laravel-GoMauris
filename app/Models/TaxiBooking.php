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
        'mobile', 
        'comments',
        'status' // ✅ Add this
    ];
}
