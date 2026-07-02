<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\VenueController;
use App\Http\Controllers\SeatController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ShowController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserEventController;
use App\Http\Controllers\AdminManagementController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';



// Registration Pages
Route::view('/register/user', 'auth.register')->name('register.user');
Route::view('/register/admin', 'auth.admin-register')->name('register.admin');

// User Events
// Route::get('/events', [EventController::class, 'userIndex'])
// ->name('events.index');

// Admin Routes
Route::middleware(['auth', 'admin'])
->prefix('admin')
->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('admin.dashboard');

    // Events
    Route::resource('events', EventController::class)
        ->names('admin.events');

    Route::get('/events/{event}/shows', [ShowController::class, 'eventShows'])
        ->name('admin.events.shows');
    // Venues
    Route::resource('/venues', VenueController::class)
        ->names('admin.venues');

    // Seats
    Route::resource('seats', SeatController::class)
        ->names('admin.seats');

    Route::get('/seats/{id}/layout',
        [SeatController::class, 'layout'])
        ->name('admin.seats.layout');

    // Shows
    Route::resource('shows', ShowController::class)
        ->names('admin.shows');
    
    Route::resource('users', UserController::class)
    ->names('admin.users');

    Route::patch('/users/{user}/status', [UserController::class, 'updateStatus'])
    ->name('admin.users.updateStatus');

    // Admin Bookings
    Route::get('/bookings',
        [BookingController::class, 'index'])
        ->name('admin.bookings.index');
});


//super admin

Route::middleware(['auth', 'super_admin'])->group(function () {
    Route::resource('admins', AdminManagementController::class);
});

Route::patch('/admins/{admin}/status',[AdminManagementController::class, 'updateStatus'])->name('admins.updateStatus');
Route::get('/admins/{admin}/edit', [AdminManagementController::class, 'edit'])->name('admins.edit');
Route::put('/admins/{admin}', [AdminManagementController::class, 'update'])->name('admins.update');
Route::middleware(['auth','super_admin'])
    ->prefix('superadmin')
    ->group(function () {

        Route::get('/dashboard',
            [SuperAdminController::class,'index'])
            ->name('superadmin.dashboard');

        Route::resource('admins', AdminManagementController::class);
});

Route::middleware(['auth', 'super_admin'])->group(function () {
    Route::get('/superadmin/search', [SuperAdminController::class, 'search'])
        ->name('superadmin.search');
});



Route::get('/events', [UserEventController::class, 'index'])->name('events.index');
Route::get('/events/{id}', [UserEventController::class, 'details'])->name('events.details');




//user booking 

Route::middleware('auth')->group(function () {
    Route::get('/bookings/{id}', [BookingController::class,'layout'])->name('bookings.layout');
    Route::post('/bookings/store', [BookingController::class,'store']) ->name('bookings.store');
    Route::get('/ticket/{id}', [BookingController::class,'ticket']) ->name('bookings.ticket');
    Route::get('/booking-history', [BookingController::class,'history'])->name('bookings.history');
});

// admin booking

Route::get('/admin/bookings',[BookingController::class,'index'])->name('admin.bookings.index');


//landing page
Route::get('/home', [HomeController::class, 'index'])->name('home.index');
Route::post('/payment/{bookingId}',[PaymentController::class, 'store'])->name('payment.store');
Route::post('/acknowledgement',[BookingController::class, 'ackn'])->name('bookings.ackn');