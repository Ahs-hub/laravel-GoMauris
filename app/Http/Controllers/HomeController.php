<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tour;
use App\Models\TourCategory;


class HomeController extends Controller
{
    public function index(Request $request)
    {
        $categories = TourCategory::all();

        $query = Tour::with('category');

        if ($request->has('category') && $request->category != 'all') {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        $tours = $query->get();

        return view('home', compact('tours', 'categories'));
    }
}
