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
        AdminNotification::truncate();
        return response()->json(['message' => 'All notifications cleared']);
    }


}
