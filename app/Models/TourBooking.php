<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TourBooking extends Model
{
    // Allow mass assignment for these fields
    protected $fillable = [
        'tour_id',
        'tour_type',
        'tour_date',
        'adults',
        'children',
        'transport_required',
        'hotel_name',
        'room_number',
        'lunch_non_veg',
        'lunch_veg',
        'special_requests',
        'full_name',
        'email',
        'country',
        'phone',
        'status',
        'payment_status',
        'admin_comment'

    ];
    
    // Relationship: A booking belongs to a tour
    public function tour()
    {
        return $this->belongsTo(Tour::class);
    }
}