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
        'mobile_number',
        'status', // ✅ Add this
        'admin_comment'
    ];
}
