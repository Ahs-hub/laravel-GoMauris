<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Car;

class AdminCarController extends Controller
{
    // AdminTourController.php
    public function json()
    {
        $cars = Car::orderBy('id', 'asc')->get(); // fetch all cars or use ->paginate()
        return response()->json($cars);
    }

    
    // Update from modal form
    public function update(Request $request, Car $car)
    {
        $car->update($request->all());
        return response()->json($car); // send back updated tour
    }

}
