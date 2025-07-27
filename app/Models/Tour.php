<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tour extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'full_title',
        'slug',
        'description',
        'duration_minutes',
        'pickup_available',
        'starting_price',
        'average_rating',
        'total_reviews',
        'tour_category_id',
        'main_image',
        'is_group_priced',
        'group_price',
        'group_size',
        'location',
        'number_of_pictures',
    ];

    // Relationships

    public function category()
    {
        return $this->belongsTo(TourCategory::class, 'tour_category_id');
    }

    public function photos()
    {
        return $this->hasMany(ActivityPhoto::class);
    }
    public function blockedDates()
    {
        return $this->hasMany(TourBlockedDate::class);
    }
    
    // Relationship: A tour has many bookings
    public function bookings()
    {
        return $this->hasMany(TourBooking::class);
    }
}