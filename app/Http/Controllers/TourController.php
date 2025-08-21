<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tour;
use App\Models\TourCategory;

class TourController extends Controller
{
    public function index(Request $request)
    {
        $categories = TourCategory::all();

        $query = Tour::with('category');
        ->where('is_active', true); // only active tours

        if ($request->has('category') && $request->category != 'all') {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        $tours = $query->get();

        return view('tourpage', compact('tours', 'categories'));

    }
    public function show($slug)
    {
        $tour = Tour::where('slug', $slug)->with('category')->firstOrFail();
    
        //$viewPath = "tours.{$tour->category->slug}.{$slug}";
    
        // Check if the specific blade file exists
        // if (view()->exists($viewPath)) {
        //     return view($viewPath, compact('tour'));
        // }
        return view('tours.viewtourpage', compact('tour'));
    
        // Fallback if the view doesn't exist
        return view('tours.show', compact('tour'));
    }

    // Return blocked dates without auth
    public function getBlockedDatesPublic($id)
    {
        $tour = \App\Models\Tour::with('blockedDates')->findOrFail($id);
    
        $dates = $tour->blockedDates->pluck('date')->toArray(); // assuming `date` column
    
        return response()->json([
            'blocked_dates' => $dates,
        ]);
    }
}
