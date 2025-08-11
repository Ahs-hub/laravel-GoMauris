<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TourController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\DB;

//admin connection
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\TourBlockedDateController;
use App\Http\Controllers\Admin\AdminController;


use App\Http\Controllers\TourBookingController;
use App\Http\Controllers\WishlistController;

use App\Http\Controllers\ContactController;

use App\Http\Controllers\TaxiBookingController;

use App\Http\Controllers\CarController;

use App\Http\Controllers\CarBookingController;

use App\Http\Controllers\CustomTourRequestController;

// Route::get('/', function () {
//     return view('home');
// })->name('home');

//admin login to form 
// Show login form
Route::get('/admin/login', [AuthController::class, 'showLoginForm'])->name('admin.login');

// Handle login POST
Route::post('/admin/login', [AuthController::class, 'login']);

// Protected dashboard (only logged-in users can access)
Route::middleware('auth')->get('/admin/dashboard', function () {
    return view('admin.dashboardpanel');
})->name('admin.dashboard');


// Go to Book Tour panel
Route::middleware('auth')->get('/admin/booktour', function () {
    return view('admin.tourpanel');
})->name('admin.tourpanel');

// Go to contact panel
Route::middleware('auth')->get('/admin/contactpanel', function () {
    return view('admin.contactpanel');
})->name('admin.contactpanel');


// Go to notification panel
Route::middleware('auth')->get('/admin/notificationpanel', function () {
    return view('admin.notificationpanel');
})->name('admin.notificationpanel');

// Go to car rental panel
Route::middleware('auth')->get('/admin/carrentalpanel', function () {
    return view('admin.rentalpanel');
})->name('admin.carrentalpanel');

// Go to taxi panel
Route::middleware('auth')->get('/admin/taxipanel', function () {
    return view('admin.taxipanel');
})->name('admin.taxipanel');


Route::get('/rent-cars', [CarController::class, 'index'])->name('cars.home');
Route::get('/rentcar/{id}', [CarController::class, 'show'])->name('rentcar.show');

Route::get('/reservation', [CarController::class, 'reservationPage'])->name('reservation');

//save booking tour
// Route::post('/tour-bookings', [TourBookingController::class, 'store'])->name('tour.bookings.store');


Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::get('/tours/blocked-dates/{id}', [TourBlockedDateController::class, 'getBlockedDates']);
    Route::post('/tours/block-dates', [TourBlockedDateController::class, 'saveBlockedDates']);
});

// In web.php (with auth middleware) show tour in admin panel
// Route::get('/admin/tours/block-dates', [TourBlockedDateController::class, 'showBlockTourDatesPage'])->middleware('auth');


Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/db-check', function () {
    try {
        DB::connection()->getPdo();
        $dbName = DB::connection()->getDatabaseName();
        return "✅ Connected to database: <strong>$dbName</strong>";
    } catch (\Exception $e) {
        return "❌ Could not connect to the database. <br>Error: " . $e->getMessage();
    }
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//Go to Contact page
Route::get('/contact', function (Illuminate\Http\Request $request) {
    return view('contactpage', ['type' => $request->query('type')]);
})->name('contact');

//Send contact to email
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');

//Go to Wishlist page
Route::get('/wishlist', [WishlistController::class, 'showWishlistPage'])->name('wishlist');

//Go to Service page
Route::get('/service', function () {
    return view('servicepage');
})->name('service'); 

//Go to Customize Tour page
Route::get('/customizeTour', [HomeController::class, 'customTour'])->name('customizeTour');

//Go to car Fleet
Route::get('/fleet', [CarController::class, 'showFleetPage'])->name('fleet');

//Go to Car Faq page
Route::get('/faq', function () {
    return view('carsite.faqpage');
})->name('faq'); 

//Go to Taxi Page
Route::get('/taxi', function () {
    return view('taxipage');
})->name('taxi'); 

//Go to Luxury taxi page
Route::get('/luxurytransfer', function () {
    return view('luxurytransfer');
})->name('luxurytransfer'); 

//Go to privacy policy
Route::get('/privacypolicy', function () {
    return view('privacypolicy');
})->name('privacypolicy'); 

//Go to refund policy
Route::get('/refundpolicy', function () {
    return view('refundpolicy');
})->name('refundpolicy');

//Go to cancellation policy
Route::get('/cancellationpolicy', function () {
    return view('carsite.cancellationpolicy');
})->name('cancellationpolicy');

//Go to rental policy
Route::get('/rentalpolicy', function () {
    return view('carsite.rentalpolicy');
})->name('rentalpolicy');


//tours
Route::get('/tours', [TourController::class, 'index'])->name('tours.index');

Route::get('/north-coast', function () {
    return view('north-coast-sightseeing');
})->name('north-coast');


//go to tour page
Route::get('/tours', [TourController::class, 'index'])->name('tours.index');

//go to correspond tour page
Route::get('/tours/{slug}', [TourController::class, 'show'])->name('tours.show');

//Save the tour in database
Route::post('/tour-bookings', [TourBookingController::class, 'store']);

//Save custom tour
Route::post('/custom-tour', [CustomTourRequestController::class, 'store'])->name('custom-tour.store');

Route::view('/thank-you', 'thankyou')->name('thankyou');




//Search booktour to display in panel
Route::get('/admin/tours/bookings/{tourId}/{date}', [TourBookingController::class, 'getBookingsForDate']);



//Send booking of car
Route::post('/send-quote', [CarBookingController::class, 'store']);

//Sent booking of taxi
Route::post('/taxi-booking-submit', [TaxiBookingController::class, 'store'])->name('taxi.booking.submit');



require __DIR__.'/auth.php';
