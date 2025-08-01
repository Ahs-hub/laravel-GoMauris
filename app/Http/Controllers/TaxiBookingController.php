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
            'mobile' => 'required|string',
            'comments' => 'nullable|string',
        ]);

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
