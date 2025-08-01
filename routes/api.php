<?php

use Illuminate\Http\Request;
use App\Models\Tour;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\TourController;

use App\Http\Controllers\Admin\AdminNotificationController;
use App\Http\Controllers\Admin\AdminController;

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

//Admin receive notification 
Route::get('/admin/notifications-count', [AdminNotificationController::class, 'count']);

//return block-id without auth
Route::get('/public/tours/blocked-dates/{id}', [TourController::class, 'getBlockedDatesPublic']);

//fetching contact block of 20
Route::get('/contacts', [AdminController::class, 'fetchPaginated']);

//delete contact 
Route::delete('/contacts/{id}', [AdminController::class, 'destroy']);

//change status
Route::put('/contacts/{id}/update-status', [AdminController::class, 'updateStatus']);

