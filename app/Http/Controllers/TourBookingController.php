<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TourBooking;

class TourBookingController extends Controller
{
    public function store(Request $request)
    {
        // Validate incoming request data
        $validated = $request->validate([
            'tour_id' => 'required|exists:tours,id',
            'tour_type' => 'required|string|max:255',
            'tour_date' => 'required|date|after_or_equal:today',
            'adults' => 'required|integer|min:1',
            'children' => 'nullable|integer|min:0',
            'transport_required' => 'required|in:yes,no',
            'hotel_name' => 'nullable|string|max:255',
            'room_number' => 'nullable|string|max:50',
            'lunch_non_veg' => 'nullable|integer|min:0',
            'lunch_veg' => 'nullable|integer|min:0',
            'special_requests' => 'nullable|string',
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'country' => 'required|string|max:100',
            'mobile_number' => 'required|string|max:50',
        ]);

        $validated['status'] = 'proceed';

        // Create booking using mass assignment
        TourBooking::create($validated);

        return redirect()->route('thankyou');
    }
    public function getBookingsForDate($tourId, $date)
    {
        try {
            $bookings = \App\Models\TourBooking::where('tour_id', $tourId)
                ->where('tour_date', $date) // ✅ use correct column name
                ->where('status', 'reserved')
                ->select('full_name', 'adults', 'children')
                ->get();
    
            return response()->json($bookings);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}