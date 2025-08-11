<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\TaxiBooking;

use Illuminate\Support\Carbon;

class AdminTaxiBookingController extends Controller
{

    // Stat 
    public function taxiStats()
    {
        $totalBooks = TaxiBooking::count();
        $reserveBooks = TaxiBooking::where('status', 'confirmed')->count();
        $pendingBooks = TaxiBooking::where('status', 'pending')->count();
        $todayBooks = TaxiBooking::whereDate('created_at', Carbon::today())->count();

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
        $taxi = TaxiBooking::orderBy('created_at', 'desc')->paginate(20);
        return response()->json($taxi);
    }

    //delete 
    public function destroy($id)
    {
        $taxis = TaxiBooking::find($id);

        if (!$taxis) {
            return response()->json(['message' => 'Rental not found'], 404);
        }

        $taxis->delete();

        return response()->json(['message' => 'Rental deleted successfully']);
    }
    
    public function update(Request $request, $id)
    {
        $booking = TaxiBooking::find($id);
    
        if (!$booking) {
            return response()->json(['message' => 'Taxi booking not found'], 404);
        }
    
        $validated = $request->validate([
            'pickup' => 'sometimes|string',
            'destination' => 'sometimes|string',
            'date' => 'sometimes|date',
            'time' => 'sometimes|string',
            'passengers' => 'sometimes|integer|min:1',
            'category' => 'sometimes|string',
            'name' => 'sometimes|string',
            'email' => 'sometimes|email',
            'country' => 'sometimes|string',
            'mobile' => 'sometimes|string',
            'comments' => 'nullable|string',
            'status' => 'sometimes|in:pending,confirmed,cancelled',
            'payment_status' => 'sometimes|in:unpaid,paid',
            'admin_comment' => 'nullable|string',
            'pickup_latitude' => 'nullable|numeric',
            'pickup_longitude' => 'nullable|numeric',
            'destination_latitude' => 'nullable|numeric',
            'destination_longitude' => 'nullable|numeric'
        ]);
    
        $booking->fill($validated);
        $booking->save();
    
        return response()->json($booking);
    }
    

}
