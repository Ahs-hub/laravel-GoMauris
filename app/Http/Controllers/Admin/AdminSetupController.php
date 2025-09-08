<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\SiteSetting;

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
            'custom_booking' => \App\Models\CustomTourRequest::class,
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

    public function previewDelete(Request $request)
    {
        // 1. Validate admin role (no password check yet)
        $user = Auth::user();
        if (!$user || $user->role !== 'admin') {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }

        // 2. Map table keys to models
        $tableModelMap = [
            'custom_booking' => \App\Models\CustomTourRequest::class,
            'tour_booking'   => \App\Models\TourBooking::class,
            'car_booking'    => \App\Models\CarBooking::class,
            'taxi_booking'   => \App\Models\TaxiBooking::class,
            'contact'        => \App\Models\Contact::class,
        ];

        $counts = [];
        $total = 0;

        // 3. Loop through selected tables
        foreach ($request->tables as $tableKey) {
            if (!isset($tableModelMap[$tableKey])) continue;

            $model = $tableModelMap[$tableKey];
            $query = $model::query();

            // 4. Apply status filter
            if ($request->status) {
                $query->where('status', $request->status);
            }

            // 5. Apply age filter
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

            // 6. Count instead of delete
            $count = $query->count();
            $counts[$tableKey] = $count;
            $total += $count;
        }

        return response()->json([
            'success' => true,
            'total'   => $total,
            'perTable'=> $counts,
        ]);
    }


    public function getDatabaseUsage()
    {
        try {
            $dbName = DB::getDatabaseName();
    
            // Get DB size (bytes) for MySQL
            $result = DB::selectOne("
                SELECT SUM(data_length + index_length) AS size
                FROM information_schema.tables
                WHERE table_schema = ?
            ", [$dbName]);
    
            $usedBytes = $result->size ?? 0;
            $usedMB = round($usedBytes / 1024 / 1024, 2);
    
            // Example limit: 1 GB (you should set this according to your hosting plan)
            $limitMB = 1024;
            $remainingMB = max($limitMB - $usedMB, 0);
    
            return response()->json([
                'database' => $dbName,
                'used_mb' => $usedMB,
                'limit_mb' => $limitMB,
                'remaining_mb' => $remainingMB
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }

    //return to view
    public function getSettings()
    {
        $admin = SiteSetting::firstOrNew([]);
        return response()->json($admin);
    }
   //update setting
   public function updatesetting(Request $request)
   {
       $admin = SiteSetting::firstOrNew(['id' => 1]); // or just ->first()
   
       $admin->fill($request->only([
           'contact_email',
           'whatsapp',
           'facebook',
           'instagram',
           'twitter',
           'notification_emails',
           'notification_phones',
           'email_notifications_enabled',
           'sms_notifications_enabled',
       ]));
   
       $admin->save();
   
       return response()->json([
           'message' => 'Settings updated successfully!',
           'admin' => $admin
       ]);
   }

//    public function showChangePasswordForm()
//    {
//        return view('admin.change-password');
//    }

   public function updatePassword(Request $request)
   {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
            'g-recaptcha-response' => 'required|captcha'
        ]);

        $user = Auth::user();

        // Check current password
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Your current password is incorrect.']);
        }

        // Update password
        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect()->route('admin.profilepanel')->with('success', 'Password updated successfully!');
   }
}
