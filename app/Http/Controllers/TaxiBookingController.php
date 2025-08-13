<?php

namespace App\Http\Controllers;
use App\Models\TaxiBooking;

use Illuminate\Http\Request;

//For notification
use App\Models\AdminNotification;

class TaxiBookingController extends Controller
{

    public function store(Request $request)
    {
        // Validate incoming data
        $validated = $request->validate([
            'pickup' => 'required|string',
            'destination' => 'required|string',
            'date' => 'required|date',
            'time' => 'required',
            'passengers' => 'required|integer',
            'category' => 'required|string',
            'name' => 'required|string',
            'email' => 'required|email',
            'country' => 'required|string',
            'phone' => 'required|string',
            'comments' => 'nullable|string',

            'has_return_ride' => 'boolean',
            'return_date' => 'nullable|date|required_if:has_return_ride,true|after_or_equal:date',
            'return_time' => 'nullable|required_if:has_return_ride,true',
    
            'child_seat' => 'nullable|integer|min:0|max:5',

            // Optional latitude/longitude
            'pickup_latitude'  => 'nullable|numeric|between:-90,90',
            'pickup_longitude' => 'nullable|numeric|between:-180,180',
            'destination_latitude'  => 'nullable|numeric|between:-90,90',
            'destination_longitude' => 'nullable|numeric|between:-180,180'
        ]);

        // Normalize checkbox and child seat
        $validated['has_return_ride'] = (bool) $request->input('has_return_ride', false);
        $validated['child_seat'] = (int) $request->input('child_seat', 0);

        // ✅ Store the new booking
        $booking = TaxiBooking::create($validated);

        // Send Notification
        AdminNotification::create([
            'type' => 'TaxiBooking',
            'related_id' => $booking->id, // ✅ Corrected here
        ]);
            

        // Instead of redirect(), return JSON with redirect URL
        return response()->json([
            'success' => true,
            'redirect' => route('thankyou', ['type' => 'tour']),
        ]);
    }
}
