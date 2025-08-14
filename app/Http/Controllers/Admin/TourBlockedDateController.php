<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TourBlockedDate;
use App\Models\Tour;

class TourBlockedDateController extends Controller
{
    public function getBlockedDates($id)
    {
        $dates = TourBlockedDate::where('tour_id', $id)->pluck('date');
        return response()->json(['blocked_dates' => $dates]);
    }

    public function saveBlockedDates(Request $request)
    {
        $request->validate([
            'tour_id' => 'required|integer',
            'blocked_dates' => 'required|array'
        ]);

        $tourId = $request->tour_id;
        $dates = $request->blocked_dates;

        // Remove old
        TourBlockedDate::where('tour_id', $tourId)->delete();

        // Save new
        foreach ($dates as $date) {
            TourBlockedDate::create([
                'tour_id' => $tourId,
                'date' => $date
            ]);
        }

        return response()->json(['message' => 'Tour blocked dates updated']);
    }
    
    public function showBlockTourDatesPage()
    {
        $tours = Tour::select('id', 'name')->orderBy('name')->get();
        return view('admin.adminpanel', compact('tours'));
    }
}

