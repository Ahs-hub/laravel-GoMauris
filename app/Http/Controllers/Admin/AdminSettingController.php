<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminSettingController extends Controller
{
    public function deleteData(Request $request)
    {
        $user = Auth::user();

        // Check if user is admin (optional)
        if (!$user || $user->role !== 'admin') {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }

        // Verify password
        if (!Hash::check($request->password, $user->password)) {
            return response()->json(['success' => false, 'message' => 'Incorrect password'], 401);
        }

        // Delete logic
        foreach ($request->tables as $table) {
            $query = DB::table($table);

            if ($request->status) {
                $query->where('status', strtolower($request->status));
            }

            if ($request->age) {
                $months = match ($request->age) {
                    '6months' => 6,
                    '1year' => 12,
                    '2years' => 24,
                    '5years' => 60,
                    default => 0
                };
                if ($months > 0) {
                    $query->where('created_at', '<', now()->subMonths($months));
                }
            }

            $query->delete();
        }

        return response()->json(['success' => true, 'message' => 'Data deleted successfully']);
    }
}
