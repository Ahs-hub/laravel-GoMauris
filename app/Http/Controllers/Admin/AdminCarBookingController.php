<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Car;
use App\Models\CarBooking;

use Illuminate\Support\Carbon;

class AdminCarBookingController extends Controller
{

    public function carrentalStats()
    {
        $totalRentals = CarBooking::count();
        $reserveRentals = CarBooking::where('status', 'confirmed')->count();
        $pendingRentals = CarBooking::where('status', 'pending')->count();
        $todayRentals = CarBooking::whereDate('created_at', Carbon::today())->count();

        return response()->json([
            'total' => $totalRentals,
            'reserve' => $reserveRentals,
            'proceed' => $pendingRentals,
            'today' => $todayRentals,
        ]);
    }

    // Fetch car rentals with pagination (20 per page)
    public function fetchPaginated(Request $request)
    {
        $carrentals = CarBooking::with('car') // eager load car to avoid N+1 queries
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        // Transform each item to include full booking data
        $carrentals->getCollection()->transform(function ($rental) {
            return [
                'id' => $rental->id,
                'first_name' => $rental->first_name,
                'last_name' => $rental->last_name,
                'driver_age' => $rental->driver_age,
                'email' => $rental->email,
                'phone' => $rental->phone,
                'special_requests' => $rental->special_requests,
                
                // Booking info
                'pickup_location' => $rental->pickup_location,
                'pickup_date' => $rental->pickup_date,
                'return_location' => $rental->return_location,
                'return_date' => $rental->return_date,
                'same_location' => $rental->same_location,

                // Car info
                'car_id' => $rental->car_id,
                'car_name' => $rental->car->name ?? '',

                // Addons
                'has_driver' => $rental->has_driver,
                'child_seats' => $rental->child_seats,

                // Status
                'status' => $rental->status,
                'payment_status' => $rental->payment_status,

                // Admin note
                'admin_comment' => $rental->admin_comment,

                // In fetchPaginated()
                'pickup_latitude' => $rental->pickup_latitude,
                'pickup_longitude' => $rental->pickup_longitude,
                'return_latitude' => $rental->return_latitude,
                'return_longitude' => $rental->return_longitude,

                // Timestamps
                'created_at' => $rental->created_at,
                'updated_at' => $rental->updated_at,
            ];
        });

        return response()->json($carrentals);
    }

    //delete 
    public function destroy($id)
    {
        $carrentals = CarBooking::find($id);

        if (!$carrentals) {
            return response()->json(['message' => 'Rental not found'], 404);
        }

        $carrentals->delete();

        return response()->json(['message' => 'Rental deleted successfully']);
    }

    //Update all
    public function update(Request $request, $id)
    {
        $rental = CarBooking::find($id);

        if (!$rental) {
            return response()->json(['message' => 'Rental not found'], 404);
        }

        $validated = $request->validate([
            'first_name' => 'sometimes|string',
            'last_name' => 'sometimes|string',
            'email' => 'sometimes|email',
            'phone' => 'sometimes|string',
            'status' => 'sometimes|in:pending,confirmed,cancelled',
            'pickup_location' => 'sometimes|string',
            'pickup_date' => 'sometimes|date',
            'return_location' => 'sometimes|string',
            'return_date' => 'sometimes|date',
            'has_driver' => 'sometimes|boolean',
            'child_seats' => 'sometimes|integer|min:0',
            'admin_comment' => 'nullable|string',
            'payment_status' => 'sometimes|in:unpaid,paid',
            // Add other fields if needed
        ]);

        $rental->fill($validated);
        $rental->save();

        // Load car relationship to get car_name
        $rental->load('car');

        return response()->json([
            'id' => $rental->id,
            'first_name' => $rental->first_name,
            'last_name' => $rental->last_name,
            'driver_age' => $rental->driver_age,
            'email' => $rental->email,
            'phone' => $rental->phone,
            'special_requests' => $rental->special_requests,
            
            // Booking info
            'pickup_location' => $rental->pickup_location,
            'pickup_date' => $rental->pickup_date,
            'return_location' => $rental->return_location,
            'return_date' => $rental->return_date,
            'same_location' => $rental->same_location,

            // Car info
            'car_id' => $rental->car_id,
            'car_name' => $rental->car->name ?? '',

            // Addons
            'has_driver' => $rental->has_driver,
            'child_seats' => $rental->child_seats,

            // Status
            'status' => $rental->status,
            'payment_status' => $rental->payment_status,

            // Admin note
            'admin_comment' => $rental->admin_comment,

            // In fetchPaginated()
            'pickup_latitude' => $rental->pickup_latitude,
            'pickup_longitude' => $rental->pickup_longitude,
            'return_latitude' => $rental->return_latitude,
            'return_longitude' => $rental->return_longitude,

            // Timestamps
            'created_at' => $rental->created_at,
            'updated_at' => $rental->updated_at
        ]);

        // return response()->json($rental);
    }


    public function getRentals()
    {
        $rentals = CarBooking::with('car') // assuming 'car' has 'type' relationship
            ->get()
            ->map(function ($rental) {
                return [
                    'id' => $rental->id,
                    'first_name' => $rental->first_name,
                    'last_name' => $rental->last_name,
                    'email' => $rental->email,
                    'phone' => $rental->phone,
                    'status' => $rental->status,
                    'service' => $rental->service,
                    'car_name' => $rental->car->name ?? '', // Add car type name here
                ];
            });

        return response()->json($rentals);
    }
}
