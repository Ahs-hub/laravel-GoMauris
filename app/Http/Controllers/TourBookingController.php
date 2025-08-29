<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TourBooking;
use App\Models\Tour;

//For notification
use App\Models\AdminNotification;

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
            'phone' => 'required|string|max:50',
        ]);

        // 2️⃣ Load tour from DB
        $tour = Tour::findOrFail($validated['tour_id']);

        // 👇 Only check if promo exists
        $promotionType = 'none';
        $discountAmount = 0;

        if ($tour->is_group_priced && $tour->group_price_promotion_price) {
            $promotionType = 'group';
            $discountAmount =  $tour->group_price_promotion_price;
        } elseif ($validated['transport_required'] === 'yes' && $tour->transfer_promotion_price) {
            $promotionType = 'transfer';
            $discountAmount =  $tour->transfer_promotion_price;
        } elseif ($tour->starting_promotion_price) {
            $promotionType = 'starting';
            $discountAmount = $tour->starting_promotion_price;
        }

        // ✅ Save booking once, with discount info
        $booking = new TourBooking($validated);
        $booking->promotion_type = $promotionType;
        $booking->discount_amount = $discountAmount;

        // \Log::info('Promotion check:', [
        //     'is_group_priced' => $tour->is_group_priced,
        //     'transport_required' => $validated['transport_required'],
        //     'starting_promotion_price' => $tour->starting_promotion_price,
        //     'transfer_promotion_price' => $tour->transfer_promotion_price,
        //     'group_price_promotion_price' => $tour->group_price_promotion_price,
        //     'promotion_type' => $promotionType,
        //     'discount_amount' => $discountAmount,
        // ]);


        $booking->save();

        // ✅ Store the new booking
       /// $booking = TourBooking::create($validated);

        AdminNotification::create([
            'type' => 'TourBooking',
            'related_id' => $booking->id, // ✅ Corrected here
        ]);
    

        return redirect()->route('thankyou');
    }

    public function getBookingsForDate($tourId, $date)
    {
        try {

            $bookings = \App\Models\TourBooking::where('tour_id', $tourId)
                ->where('tour_date', $date) // ✅ use correct column name
                ->where('status', 'confirmed')
                ->select('full_name', 'adults', 'children')
                ->get();
    
            return response()->json($bookings);
        } catch (\Exception $e) {

            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}