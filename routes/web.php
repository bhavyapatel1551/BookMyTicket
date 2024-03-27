<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\TicketController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
// Home Page
Route::get('/', function () {
    return redirect('/dashboard');
})->middleware('auth');

// Events Related Routes --------------------------------------------------------------------------------------------------------

// Show Event in my Event page

Route::prefix('event')->group(function () {
    Route::get('/', [EventController::class, 'ShowAllEvents'])->name('event')->middleware('auth');

    // Show Event Statistics
    Route::get('/statistic', [EventController::class, 'ShowStatisticPage'])->name('event.statistic')->middleware('auth');

    // Add New Event
    Route::get('/create', [EventController::class, 'ShowCreateEventPage'])->name('event.create')->middleware('auth');
    Route::post('/create', [EventController::class, 'createEvent'])->name('event.create')->middleware('auth');

    // Show Update Page
    Route::get('/update/{id}', [EventController::class, 'ShowUpdateEventPage'])->name('events.update')->middleware('auth');
    Route::post('/update/{id}', [EventController::class, 'UpdateEvent'])->name('events.update')->middleware('auth');
});



// Tickets Related Routes -------------------------------------------------------------------------------------------------------

// Show All Tickets in Dashboard
Route::get('/dashboard', [TicketController::class, 'ShowAllTickets'])->name('dashboard')->middleware('auth');

// Show Purchased Ticket of User
Route::get('/userticket', function () {
    return view('tickets.userticket');
})->name('userticket')->middleware('auth');

// Show Single Ticket Info
Route::get('/ticketinfo/{id}', [TicketController::class, 'TicketInfo'])->name('ticketinfo')->middleware('auth');




// User Profile Related Route----------------------------------------------------------------------------------------------------

// Show User PRofile
Route::get('/user-profile', [ProfileController::class, 'index'])->name('users.profile')->middleware('auth');

// Update User Profile
Route::put('/user-profile/update', [ProfileController::class, 'update'])->name('users.update')->middleware('auth');

// Upload Profile Photo
Route::get('/user-update-profilephoto', [ProfileController::class, 'showprofilephotoform'])->name('update.profilephoto')->middleware('auth');
Route::post('/user-update-profilephoto', [ProfileController::class, 'updateprofilephoto'])->name('update.profilephoto')->middleware('auth');

// Show Add To Cart Page
Route::get('/cart', function () {
    return view('userProfile.cart');
})->name('cart')->middleware('auth');





// Auth Related Routes ----------------------------------------------------------------------------------------------------------

// Sign up page
Route::get('/sign-up', [RegisterController::class, 'create'])
    ->middleware('guest')
    ->name('sign-up');
Route::post('/sign-up', [RegisterController::class, 'store'])
    ->middleware('guest');

// Sign in Page
Route::get('/sign-in', [LoginController::class, 'create'])
    ->middleware('guest')
    ->name('sign-in');
Route::post('/sign-in', [LoginController::class, 'store'])
    ->middleware('guest');

// Log out route
Route::get('/logout', [LoginController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

// Show Forget Password Page
Route::get('/forgot-password', [ForgotPasswordController::class, 'create'])
    ->middleware('guest')
    ->name('password.request');
Route::post('/forgot-password', [ForgotPasswordController::class, 'store'])
    ->middleware('guest')
    ->name('password.email');

// Show Reset Password Page 
Route::get('/reset-password/{token}', [ResetPasswordController::class, 'create'])
    ->middleware('guest')
    ->name('password.reset');
Route::post('/reset-password', [ResetPasswordController::class, 'store'])
    ->middleware('guest');

// Show OTP Verification PAge
Route::get('/verify-otp', [RegisterController::class, 'showOtpForm'])->name('showOtpForm');
Route::post('/verify-otp', [RegisterController::class, 'verifyOtp']);





// Testing Route-----------------------------------------------------------------------------------------------------------------
Route::get('/mailform', function () {
    return view('mail.test');
});

// Show all user for admin 
Route::get('/users-management', [UserController::class, 'index'])->name('users-management')->middleware('auth');
