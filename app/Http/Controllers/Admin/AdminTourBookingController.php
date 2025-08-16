<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\TourBooking;

use Illuminate\Support\Carbon;

class AdminTourBookingController extends Controller
{
    // Stat 
    public function tourStats()
    {
        $totalBooks = TourBooking::count();
        $reserveBooks = TourBooking::where('status', 'confirmed')->count();
        $pendingBooks = TourBooking::where('status', 'pending')->count();
        $todayBooks = TourBooking::whereDate('created_at', Carbon::today())->count();

        return response()->json([
            'total' => $totalBooks,
            'reserve' => $reserveBooks,
            'proceed' => $pendingBooks,
            'today' => $todayBooks,
        ]);
    }

       // Fetch taxi booking with pagination (20 per page)
    public function fetchPaginated(Request $request)
    {
        $tourd = TourBooking::orderBy('created_at', 'desc')->paginate(20);
        return response()->json($tourd);
    }

    //delete 
    public function destroy($id)
    {
        $tourd = TourBooking::find($id);

        if (!$tourd) {
            return response()->json(['message' => 'Rental not found'], 404);
        }

        $tourd->delete();

        return response()->json(['message' => 'Rental deleted successfully']);
    }
    
    public function update(Request $request, $id)
    {
        $booking = TourBooking::find($id);
    
        if (!$booking) {
            return response()->json(['message' => 'Tour booking not found'], 404);
        }
    
        $validated = $request->validate([
            'tour_type'         => 'sometimes|string',
            'tour_date'         => 'sometimes|date',
            'adults'            => 'sometimes|integer|min:0',
            'children'          => 'sometimes|integer|min:0',
            'tour_id'           => 'sometimes|exists:tours,id',
            'transport_required'=> 'sometimes|in:yes,no',
            'hotel_name'        => 'nullable|string',
            'room_number'       => 'nullable|string',
            'lunch_non_veg'     => 'sometimes|integer|min:0',
            'lunch_veg'         => 'sometimes|integer|min:0',
            'special_requests'  => 'nullable|string',
            'full_name'         => 'sometimes|string',
            'email'             => 'sometimes|email',
            'country'           => 'sometimes|string',
            'phone'             => 'sometimes|string',
            'status'            => 'sometimes|in:pending,confirmed,cancelled,completed', // ✅ must match enum
            'payment_status'    => 'sometimes|in:unpaid,paid,refund', // ✅ must match enum
            'admin_comment'     => 'nullable|string',
        ]);
    
        $booking->fill($validated);
        $booking->save();
    
        return response()->json($booking);
    }
}
