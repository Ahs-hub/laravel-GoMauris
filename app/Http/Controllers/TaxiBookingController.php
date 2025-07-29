<?php

namespace App\Http\Controllers;
use App\Models\TaxiBooking;

use Illuminate\Http\Request;

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

        TaxiBooking::create($validated);

        // Instead of redirect(), return JSON with redirect URL
        return response()->json([
            'success' => true,
            'redirect' => route('thankyou', ['type' => 'tour']),
        ]);
    }
}
