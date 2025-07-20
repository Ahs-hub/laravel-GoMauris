<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CarBookingController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'driver_age' => 'required|integer|min:16|max:100',
            'mobile' => 'required|string',
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
            'same_location' => 'boolean'
        ]);

        $booking = \App\Models\CarBooking::create($validated);

        return response()->json(['success' => true, 'message' => 'Quote received.']);

        // return response()->json(['success' => true, 'booking_id' => $booking->id]);
    }
}
