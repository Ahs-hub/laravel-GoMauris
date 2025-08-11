<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\CustomTourRequest;

use Illuminate\Support\Carbon;

class AdminCustomBookingController extends Controller
{
    // Stat 
    public function customStats()
    {
        $totalBooks = CustomTourRequest::count();
        $reserveBooks = CustomTourRequest::where('status', 'confirmed')->count();
        $pendingBooks = CustomTourRequest::where('status', 'pending')->count();
        $todayBooks = CustomTourRequest::whereDate('created_at', Carbon::today())->count();

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
        $custom = CustomTourRequest::orderBy('created_at', 'desc')->paginate(20);
        return response()->json($custom);
    }

    //delete 
    public function destroy($id)
    {
        $custom = CustomTourRequest::find($id);

        if (!$custom) {
            return response()->json(['message' => 'Rental not found'], 404);
        }

        $custom->delete();

        return response()->json(['message' => 'Rental deleted successfully']);
    }
    
    public function update(Request $request, $id)
    {
        $booking = CustomTourRequest::find($id);
    
        if (!$booking) {
            return response()->json(['message' => 'Tour booking not found'], 404);
        }
    
        // Validate only the fillable fields
        $validated = $request->validate([
            'vehicle_category'  => 'sometimes|string',
            'passengers'        => 'sometimes|integer|min:1',
            'tour_date'         => 'sometimes|date',
            'start_time'        => 'sometimes|string',
            'hotel_name'        => 'sometimes|string',
            'preferred_tour'    => 'sometimes|string',
            'comments'          => 'nullable|string',
            'full_name'         => 'sometimes|string',
            'email'             => 'sometimes|email',
            'country'           => 'sometimes|string',
            'mobile_number'     => 'sometimes|string',
            'status'            => 'sometimes|in:pending,confirmed,cancelled',
            'payment_status'    => 'sometimes|in:paid,unpaid',
            'admin_comment'     => 'nullable|string',
    
        ]);
    
        // Fill only the allowed fields
        $booking->fill(collect($validated)->only($booking->getFillable())->toArray());
    
    
        $booking->save();
    
        return response()->json($booking);
    }
     
    
}
