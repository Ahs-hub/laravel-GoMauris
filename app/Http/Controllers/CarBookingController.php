<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Log;

//For notification
use App\Models\AdminNotification;

use App\Models\Car;

class CarBookingController extends Controller
{
    public function store(Request $request)
    {
        //Log::info('CarBooking.store called', ['request' => $request->all()]);

        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'driver_age' => 'required|integer|min:16|max:100',
            'phone' => 'required|string',
            'email' => 'required|email',
            'pickup_location' => 'required|string',
            'pickup_date' => 'required|date',
            'return_location' => 'required|string',
            'return_date' => 'required|date|after:pickup_date',
            'car_id' => 'required|exists:cars,id',
            'has_driver' => 'boolean',
            'child_seats' => 'integer|min:0|max:3',
            // Optional:
            'special_requests' => 'nullable|string',
            'same_location' => 'boolean',
             
            // Optional latitude/longitude
            'pickup_latitude'  => 'nullable|numeric|between:-90,90',
            'pickup_longitude' => 'nullable|numeric|between:-180,180',
            'return_latitude'  => 'nullable|numeric|between:-90,90',
            'return_longitude' => 'nullable|numeric|between:-180,180',

        ]);

        
        //    Log::info('CarBooking.store validated data', $validated);

        // 1️⃣ Load the car
        $car = Car::findOrFail($validated['car_id']);

        // Log::info('Car found', $car->toArray());

        // 2️⃣ Default values
        $discountAmount = 0;

        // 3️⃣ Calculate discount (per day)
        if ($car->promotion_price_per_day > 0) {
            $discountAmount =  $car->promotion_price_per_day;
        }

        // 4️⃣ Create booking with discount
        $booking = new \App\Models\CarBooking($validated);
        $booking->discount_amount = $discountAmount;
        $booking->save();

       /// $booking = \App\Models\CarBooking::create($validated);

        //Notification
        AdminNotification::create([
            'type' => 'CarBooking',
            'related_id' => $booking->id, // ✅ Corrected here
        ]);

        return response()->json(['success' => true, 'message' => 'Quote received.']);

        // return response()->json(['success' => true, 'booking_id' => $booking->id]);
    }
}
