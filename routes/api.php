<?php

use Illuminate\Http\Request;
use App\Models\Tour;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\TourController;

use App\Http\Controllers\Admin\AdminNotificationController;
use App\Http\Controllers\Admin\AdminContactController;

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


//fetch notification page
Route::prefix('admin/notifications')->group(function () {
    Route::get('/', [AdminNotificationController::class, 'index']);
    Route::delete('/{id}', [AdminNotificationController::class, 'destroy']);
    Route::delete('/clear-all', [AdminNotificationController::class, 'clearAll']);
});


//fetching contact block of 20
Route::get('/contacts', [AdminContactController::class, 'fetchPaginated']);

//delete contact 
Route::delete('/contacts/{id}', [AdminContactController::class, 'destroy']);

//change status to contact
Route::put('/contacts/{id}/update-status', [AdminContactController::class, 'updateStatus']);

//Add comment to contact
Route::put('/contacts/{id}/update-comment', [AdminContactController::class, 'updateComment']);

