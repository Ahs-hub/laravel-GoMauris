<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Car;

class CarSeeder extends Seeder
{
    public function run()
    {
        Car::create([
            'name' => 'Suzuki Celerio',
            'transmission' => 'Automatic',
            'type' => 'Compact Car',
            'fuel_type' => 'Gasoline',
            'seats' => 5,
            'doors' => 4,
            'model_years' => '2022 - 2025',
            'available_colors' => json_encode(['black']),
            'engine' => '1500 cc',
            'consumption' => '5.5 L / 100km',
            'policy' => 'Same to same',
            'price_per_day' => 35.00,
            'climate_control' => true,
            'image_path' => 'images/cars/suzuki_celerio.jpg',
        ]);

        Car::create([
            'name' => 'Suzuki Spresso',
            'transmission' => 'Automatic',
            'type' => 'Compact Car',
            'fuel_type' => 'Gasoline',
            'seats' => 5,
            'doors' => 4,
            'model_years' => '2022 - 2025',
            'available_colors' => json_encode(['black', 'grey']),
            'engine' => '1000 cc',
            'consumption' => '4.5 L / 100km',
            'policy' => 'Same to same',
            'price_per_day' => 35.00,
            'climate_control' => true,
            'image_path' => 'images/cars/suzuki_spresso.jpg',
        ]);

        
        Car::create([
            'name' => 'Suzuki Swift',
            'transmission' => 'Automatic',
            'type' => 'Compact Car',
            'fuel_type' => 'Gasoline',
            'seats' => 5,
            'doors' => 4,
            'model_years' => '2021 - 2024',
            'available_colors' => json_encode(['Blue']),
            'engine' => '1000 cc',
            'consumption' => '4.5 L / 100km',
            'policy' => 'Same to same',
            'price_per_day' => 40.00,
            'climate_control' => true,
            'image_path' => 'images/cars/suzuki_swift.jpg',
        ]);
    }
}
