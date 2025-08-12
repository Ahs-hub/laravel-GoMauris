<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomTourRequest extends Model
{
    protected $fillable = [
        'vehicle_category',
        'passengers',
        'tour_date',
        'start_time',
        'hotel_name',
        'preferred_tour',
        'comments',
        'full_name',
        'email',
        'country',
        'phone',
        'status', // ✅ Add this
        'payment_status',
        'admin_comment'
    ];
}
