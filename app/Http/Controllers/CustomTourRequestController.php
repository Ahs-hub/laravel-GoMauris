<?php

namespace App\Http\Controllers;

use App\Models\CustomTourRequest;

use Illuminate\Http\Request;

//For notification
use App\Models\AdminNotification;

class CustomTourRequestController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'vehicle_category' => 'required',
            'passengers'       => 'required|integer|min:1',
            'tour_date'        => 'required|date',
            'start_time'       => 'nullable',
            'hotel_name'       => 'nullable|string',
            'preferred_tour'   => 'nullable|string',
            'comments'         => 'nullable|string',

            'full_name'        => 'required|string',
            'email'            => 'required|email',
            'country'          => 'required|string',
            'mobile_number'    => 'required|string',
        ]);

        $booking = CustomTourRequest::create($validated);

        // Notification
        AdminNotification::create([
            'type' => 'CustomBooking',
            'related_id' => $booking->id, // ✅ Corrected here
        ]);

        return redirect()->route('thankyou', 'tour');
    }
}
