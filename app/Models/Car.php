<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $fillable = [
        'name',
        'transmission',
        'type',
        'fuel_type',
        'seats',
        'doors',
        'model_years',
        'available_colors',
        'engine',
        'consumption',
        'policy',
        'price_per_day',
        'climate_control',
        'image_path',
    ];

    public function type()
    {
        return $this->belongsTo(CarType::class); // assuming your car types are in a `car_types` table
    }
}
