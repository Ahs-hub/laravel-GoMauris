<?php

use Illuminate\Http\Request;
use App\Models\Tour;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\TourController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/tours', function () {
    return Tour::select('id', 'name')->get();
});


// Admin-only route (keep it if you need restricted access somewhere)
Route::get('/admin/tours/blocked-dates/{tour}', function($tourId) {
    $tour = Tour::findOrFail($tourId);
    return response()->json([
        'blocked_dates' => $tour->blocked_dates, // assuming this is an array of dates
    ]);
});

//return block-id without auth
Route::get('/public/tours/blocked-dates/{id}', [TourController::class, 'getBlockedDatesPublic']);

