<?php

use Illuminate\Http\Request;
use App\Models\Tour;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\TourController;

use App\Http\Controllers\Admin\AdminNotificationController;
use App\Http\Controllers\Admin\AdminContactController;
use App\Http\Controllers\Admin\AdminCarBookingController;
use App\Http\Controllers\Admin\AdminTaxiBookingController;
use App\Http\Controllers\Admin\AdminCustomBookingController;
use App\Http\Controllers\Admin\AdminTourBookingController;
use App\Http\Controllers\Admin\AdminSetupController;

use App\Http\Controllers\Admin\TourBlockedDateController;
use App\Http\Controllers\TourBookingController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/optiontours', function () {
    return Tour::select('id', 'name')->get();
});

// Admin-only route (keep it if you need restricted access somewhere)
Route::get('/admin/optiontours/blocked-dates/{tour}', function($tourId) {
    $tour = Tour::findOrFail($tourId);
    return response()->json([
        'blocked_dates' => $tour->blocked_dates, // assuming this is an array of dates
    ]);
});

Route::get('/admin/optiontours/blockedd-dates/{id}', [TourBlockedDateController::class, 'getBlockedDates']);
Route::post('/admin/optiontours/block-dates', [TourBlockedDateController::class, 'saveBlockedDates']);

//Search booktour to display in panel
Route::get('/admin/optiontours/bookings/{tourId}/{date}', [TourBookingController::class, 'getBookingsForDate']);

//return block-id without auth !important for client to see what date is blocked
Route::get('/public/tours/blocked-dates/{id}', [TourController::class, 'getBlockedDatesPublic']);

//Admin receive notification 
Route::get('/admin/notifications-count', [AdminNotificationController::class, 'count']);




//fetch notification page
Route::prefix('admin/notifications')->group(function () {
    Route::get('/', [AdminNotificationController::class, 'index']);
    Route::get('/latest', [AdminNotificationController::class, 'latest']);  
    Route::delete('/clear-all', [AdminNotificationController::class, 'clearAll']);
    Route::delete('/{id}', [AdminNotificationController::class, 'destroy']);
});

//-----------------------------
// Get number of Tours, status
Route::get('/admin/tour-stats', [AdminTourBookingController::class, 'tourStats'])
->name('admin.tourstats');

//fetching tour block of 20
Route::get('/tours', [AdminTourBookingController::class, 'fetchPaginated']);

//delete tour
Route::delete('/tours/{id}', [AdminTourBookingController::class, 'destroy']);

//Update all field
Route::put('/tours/{id}/update-data', [AdminTourBookingController::class, 'update']);

//------------------------------

// Get number of carrental, status
Route::get('/admin/carrental-stats', [AdminCarBookingController::class, 'carrentalStats'])
->name('admin.carrentalstats');

//fetching carrental block of 20
Route::get('/carrentals', [AdminCarBookingController::class, 'fetchPaginated']);

//delete carrental 
Route::delete('/carrentals/{id}', [AdminCarBookingController::class, 'destroy']);

//Update all field
Route::put('/carrentals/{id}/update-data', [AdminCarBookingController::class, 'update']);


//Add comment to carrental
Route::put('/carrentals/{id}/update-comment', [AdminCarBookingController::class, 'updateComment']);

//-----------------------
// Get number of taxi book, status
Route::get('/admin/taxi-stats', [AdminTaxiBookingController::class, 'taxiStats'])
->name('admin.taxistats');

//fetching taxi block of 20
Route::get('/taxi', [AdminTaxiBookingController::class, 'fetchPaginated']);

//delete taxi 
Route::delete('/taxi/{id}', [AdminTaxiBookingController::class, 'destroy']);

//Update all field
Route::put('/taxi/{id}/update-data', [AdminTaxiBookingController::class, 'update']);

//----------------------------------
// Get number of custom book, status
Route::get('/admin/custom-stats', [AdminCustomBookingController::class, 'customStats'])
->name('admin.customstats');

//fetching custom block of 20
Route::get('/custom', [AdminCustomBookingController::class, 'fetchPaginated']);

//delete custom
Route::delete('/custom/{id}', [AdminCustomBookingController::class, 'destroy']);

//Update all field
Route::put('/custom/{id}/update-data', [AdminCustomBookingController::class, 'update']);

//-----------------------

// Get number of contact, status
Route::get('/admin/contact-stats', [AdminContactController::class, 'contactStats'])
->name('admin.contactstats');

//fetching contact block of 20
Route::get('/contacts', [AdminContactController::class, 'fetchPaginated']);

//delete contact 
Route::delete('/contacts/{id}', [AdminContactController::class, 'destroy']);

//change status to contact
Route::put('/contacts/{id}/update-status', [AdminContactController::class, 'updateStatus']);

//Add comment to contact
Route::put('/contacts/{id}/update-comment', [AdminContactController::class, 'updateComment']);

//----------------------------

//Get database size
Route::get('/db-size', [AdminSetupController::class, 'getDatabaseSize']);