<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Tour;

class AdminTourController extends Controller
{
    // AdminTourController.php
    public function json()
    {
        $tours = Tour::orderBy('id', 'asc')->get(); // fetch all tours or use ->paginate()
        return response()->json($tours);
    }

  
    // Update from modal form
    public function update(Request $request, Tour $tour)
    {
        $tour->update($request->all());
        return response()->json($tour); // send back updated tour
    }

}
