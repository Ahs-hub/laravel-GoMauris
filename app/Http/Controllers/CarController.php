<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;

class CarController extends Controller
{
    public function index()
    {
        $cars = Car::all(); // Get all cars from the database
        return view('carsite.carhomepage', compact('cars')); // Return to Blade view
    }
    public function show($id)
    {
        $car = \App\Models\Car::findOrFail($id);
        return view('carsite.carreservationpage', compact('car'));
    }
    public function reservationPage()
    {

        $cars = \App\Models\Car::all()->map(function ($car) {
            return [
                'id' => $car->id,
                'name' => $car->name,
                'type' => $car->type,
                'fuel_type' => $car->fuel_type,
                'transmission' => $car->transmission,
                'price_per_day' => $car->price_per_day,
                'promotion_price_per_day' => $car-> promotion_price_per_day,

                'image_url' => asset($car->image_path),
                'detail_url' => route('rentcar.show', $car->id),

                'is_active' => $car -> is_active,

                
                // ➕ Add these extra fields
                'seats' => $car->seats,
                'doors' => $car->doors,
                'model_years' => $car->model_years, // ← Correct field name
                'colors' => json_decode($car->available_colors), // ← Decode JSON array
                'engine' => $car->engine, // e.g., 1500
                'consumption' => $car->consumption, // e.g., 5.5
                'policy' => $car->policy, // e.g., "Same to same"

                // ✅ Add translated fields
                'translated_type' => __('messages.' . strtolower($car->type)),
                'translated_fuel_type' => __('messages.' . strtolower($car->fuel_type)),
                'translated_transmission' => __('messages.' . strtolower($car->transmission)),
                // ✅ Translate each color
                'translated_colors' => collect(json_decode($car->available_colors))
                ->map(fn($color) => __('messages.' . strtolower($color)))
                ->toArray(),
                
                ];
        });
        return view('carsite.carreservationpage', compact('cars'));
    }

    public function showFleetPage()
    {
        $cars = \App\Models\Car::all()->map(function ($car) {
            return [
                'id' => $car->id,
                'name' => $car->name,
                'type' => $car->type,
                'fuel_type' => $car->fuel_type,
                'transmission' => $car->transmission,
                'price_per_day' => $car->price_per_day,
                'promotion_price_per_day' => $car-> promotion_price_per_day,
                'image_url' => asset($car->image_path),
                'detail_url' => route('rentcar.show', $car->id),

                'is_active' => $car -> is_active,

                
                // ➕ Add these extra fields
                'seats' => $car->seats,
                'doors' => $car->doors,
                'model_years' => $car->model_years, // ← Correct field name
                'colors' => json_decode($car->available_colors), // ← Decode JSON array
                'engine' => $car->engine, // e.g., 1500
                'consumption' => $car->consumption, // e.g., 5.5
                'policy' => $car->policy, // e.g., "Same to same"

                // ✅ Add translated fields
                'translated_type' => __('messages.' . strtolower($car->type)),
                'translated_fuel_type' => __('messages.' . strtolower($car->fuel_type)),
                'translated_transmission' => __('messages.' . strtolower($car->transmission)),
            ];
        });

        return view('carsite.carfleetpage', compact('cars'));
    }
}
