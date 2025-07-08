<?php

use Illuminate\Http\Request;
use App\Models\Tour;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/tours', function () {
    return Tour::select('id', 'name')->get();
});

//return available date
Route::get('/admin/tours/blocked-dates/{tour}', function($tourId) {
    $tour = \App\Models\Tour::findOrFail($tourId);
    return response()->json([
        'blocked_dates' => $tour->blocked_dates, // assuming this is an array of dates
    ]);
});