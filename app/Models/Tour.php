<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tour extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'duration_minutes',
        'pickup_included',
        'starting_price',
        'average_rating',
        'total_reviews',
        'tour_category_id',
        'main_image',
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
}