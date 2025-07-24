<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TourController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\DB;

//admin connection
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\TourBlockedDateController;


use App\Http\Controllers\TourBookingController;
use App\Http\Controllers\WishlistController;

use App\Http\Controllers\ContactController;

use App\Http\Controllers\CarController;

use App\Http\Controllers\CarBookingController;

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
    return view('admin.adminpanel');
})->name('admin.dashboard');


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
Route::view('/thank-you', 'thankyou')->name('thankyou');

//Search booktour to display in panel
Route::get('/admin/tours/bookings/{tourId}/{date}', [TourBookingController::class, 'getBookingsForDate']);



//Send booking of car
Route::post('/send-quote', [CarBookingController::class, 'store']);



require __DIR__.'/auth.php';
