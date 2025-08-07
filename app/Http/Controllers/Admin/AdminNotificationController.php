<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\AdminNotification;

class AdminNotificationController extends Controller
{
    public function count()
    {
        // Assumes you added a 'seen' column to the admin_notifications table
        $count = AdminNotification::where('seen', false)->count();

        return response()->json(['count' => $count]);
        
    }

    public function latest(Request $request)
    {
        // Get the 'limit' from the query string (?limit=3), default to 5
        $limit = (int) $request->input('limit', 20); // fallback if not passed
    
        $latest = AdminNotification::orderBy('id', 'desc')
            ->take($limit)
            ->get(['id', 'type','related_id']);
    
        return response()->json([
            'data' => $latest
        ]);
    }

    // List all notifications, newest first
    public function index()
    {
        return AdminNotification::orderBy('created_at', 'desc')->get();
    }


    // ✅ Delete a single notification
    public function destroy($id)
    {
        $notification = AdminNotification::findOrFail($id);
        $notification->delete();

        return response()->json(['message' => 'Notification deleted']);
    }

    // ✅ Clear all notifications
    public function clearAll()
    {
        AdminNotification::query()->delete(); // Soft delete
        \Log::info('[clearAll] Route hit');
        return response()->json(['message' => 'All notifications cleared']);
    }


}
