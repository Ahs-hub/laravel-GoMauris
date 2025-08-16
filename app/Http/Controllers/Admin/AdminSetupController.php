<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash; // if you plan to check password later

//Get database space
use Illuminate\Support\Facades\DB;

class AdminSetupController extends Controller
{
    public function deleteData(Request $request)
    {
        // 1. Validate admin password
       $user = Auth::user();

        if (!$user || $user->role !== 'admin') {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }
        if (!Hash::check($request->password, $user->password)) {
            return response()->json(['success' => false, 'message' => 'Password incorrect']);
        }

            // Log that the route is accessed
        Log::info('Delete data route accessed.', [
            'tables' => $request->tables ?? null,
            'status' => $request->status ?? null,
            'age' => $request->age ?? null,
        ]);
    
        // 2. Map table keys to models
        $tableModelMap = [
            'custom_booking' => \App\Models\CustomBooking::class,
            'tour_booking'   => \App\Models\TourBooking::class,
            'car_booking'    => \App\Models\CarBooking::class,
            'taxi_booking'   => \App\Models\TaxiBooking::class,
            'contact'        => \App\Models\Contact::class,
        ];
    
        // 3. Loop through selected tables
        foreach ($request->tables as $tableKey) {
            if (!isset($tableModelMap[$tableKey])) continue;
    
            $model = $tableModelMap[$tableKey];
            $query = $model::query();
    
            // 4. Filter by status
            if ($request->status) {
                $query->where('status', $request->status);
            }
    
            // 5. Filter by age
            if ($request->age) {
                $date = match ($request->age) {
                    '6months' => now()->subMonths(6),
                    '1year'   => now()->subYear(),
                    '2years'  => now()->subYears(2),
                    default   => null
                };
                if ($date) {
                    $query->where('created_at', '<', $date);
                }
            }
    
            // 6. Delete
            $query->delete();
        }
    
        return response()->json(['success' => 'Data deleted successfully']);
    }

    public function getDatabaseSize()
    {
        $dbName = DB::getDatabaseName();
    
        $size = DB::selectOne("SELECT pg_database_size(?) AS size_bytes", [DB::getDatabaseName()]);

        $size_mb = round($size->size_bytes / 1024 / 1024, 2);
        
        return response()->json([
            'database' => DB::getDatabaseName(),
            'size_mb' => $size_mb
        ]);
    }
}
