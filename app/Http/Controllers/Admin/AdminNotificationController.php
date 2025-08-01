<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminNotificationController extends Controller
{
    public function count()
    {
        // Assumes you added a 'seen' column to the admin_notifications table
        $count = DB::table('admin_notifications')->where('seen', false)->count();

        return response()->json(['count' => $count]);
    }
}
