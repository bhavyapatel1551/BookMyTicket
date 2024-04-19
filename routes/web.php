<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\OrderController;
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


// Web Page
Route::get('/', function () {
    return redirect('/dashboard');
})->middleware('auth');


/**
 * Authentication Related Routes-------------------------------------------------------------------------------------------------
 * Sign-up User route 
 */
Route::get('/sign-up', [RegisterController::class, 'create'])->middleware('guest')->name('sign-up');
Route::post('/sign-up', [RegisterController::class, 'store'])->middleware('guest');

/**
 * User Sign-in Route 
 */
Route::get('/sign-in', [LoginController::class, 'create'])->middleware('guest')->name('sign-in');
Route::post('/sign-in', [LoginController::class, 'store'])->middleware('guest');

/**
 * User Logout Route 
 */
Route::get('/logout', [LoginController::class, 'destroy'])->middleware('auth')->name('logout');

/**
 * Forget Password Routes
 */
Route::get('/forgot-password', [ForgotPasswordController::class, 'create'])->middleware('guest')->name('password.request');
Route::post('/forgot-password', [ForgotPasswordController::class, 'store'])->middleware('guest')->name('password.email');

// Show Reset Password Page 
/**
 * Reset Password Routes 
 */
Route::get('/reset-password/{token}', [ResetPasswordController::class, 'create'])->middleware('guest')->name('password.reset');
Route::post('/reset-password', [ResetPasswordController::class, 'store'])->middleware('guest');

/**
 * OTP Verification Routes 
 */
Route::get('/verify-otp', [RegisterController::class, 'showOtpForm'])->name('showOtpForm')->middleware('guest');
Route::post('/verify-otp', [RegisterController::class, 'verifyOtp'])->name('verifyOtp')->middleware('guest');
Route::get('/verify-otp-google', [RegisterController::class, 'GoogleOTP'])->name('showOtpFormGoogle')->middleware('guest');

/**
 * Google Sign-in API Routes
 */
Route::get('auth/google', [GoogleController::class, 'loginwithgoogle'])->name('login')->middleware('guest');
Route::any('auth/google/callback', [GoogleController::class, 'callbackFromGoogle'])->name('callback')->middleware('guest');

/**
 * User Registration Fees Routes 
 */
Route::get('/registrationFees', [RegisterController::class, 'RegistrationFees'])->name('Registration.Fees')->middleware('guest');
Route::get('/SuccessfullPayment', [RegisterController::class, 'SuccessfullPayment'])->name('SuccessfullPayment')->middleware('guest');

/**
 * Terms And Conditions Routes 
 */
Route::get('/terms-and-conditions', function () {
    return view('terms&conditions');
})->name('t&c');

/**
 * About Us Routes 
 */
Route::get('/about-us', function () {
    return view('AboutUs');
})->name('about-us');


/**
 * User Profle Related Routes ---------------------------------------------------------------------------------------------------
 * User Profile / Update Routes 
 */
Route::prefix('user')->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('user.profile')->middleware('auth');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('user.update')->middleware('auth');

    Route::get('/PhotoUpdate', [ProfileController::class, 'showprofilephotoform'])->name('user.PhotoUpdate')->middleware('auth');
    Route::put('/PhotoUpdate', [ProfileController::class, 'updateprofilephoto'])->name('user.PhotoUpdate')->middleware('auth');
});


/**
 * Events Releated Routes--------------------------------------------------------------------------------------------------------
 * 
 * Show All Events in My Event PAge
 */
Route::get('/event', [EventController::class, 'ShowAllEvents'])->name('event')->middleware('auth');

/**
 * Create Event Routes
 */
Route::get('/event/create', [EventController::class, 'ShowCreateEventPage'])->name('event.create')->middleware('auth');
Route::post('/event/create', [EventController::class, 'createEvent'])->name('event.create')->middleware('auth');

/**
 * Update Event Routes
 */
Route::get('/eventUpdate/{id}', [EventController::class, 'ShowUpdateEventPage'])->name('events.update')->middleware('auth');
Route::post('/eventUpdate/{id}', [EventController::class, 'UpdateEvent'])->name('events.update')->middleware('auth');

/**
 * Delete Event 
 */
Route::get('/eventDelete/{id}', [EventController::class, 'deleteEvent'])->name('eventDelete')->middleware('auth');



/**
 * Ticket Related Routes --------------------------------------------------------------------------------------------------------
 * 
 * Show All Ticket to user's Dashboard
 */
Route::get('/dashboard', [TicketController::class, 'ShowAllTickets'])->name('dashboard')->middleware('auth');

/**
 * Show Single Ticket Info
 * *** Currently Unavaible***
 */
Route::get('/ticket/{id}', [TicketController::class, 'TicketInfo'])->name('ticket.info')->middleware('auth');



// Show Cart Page 
/**
 * Cart Related Routes-----------------------------------------------------------------------------------------------------------
 * 
 * Show Cart Page
 */
Route::get('/cart', [CartController::class, 'ShowCart'])->name('cart')->middleware('auth');

/**
 * Add Item to Cart
 */
Route::get('/addtoCart/{id}', [CartController::class, 'AddtoCart'])->name('addtocart')->middleware('auth');

/**
 * Delete Item From Cart
 */
Route::get('/deleteFromCart/{id}', [CartController::class, 'DeleteFromCart'])->name('deleteFromCart')->middleware('auth');

/**
 * Cart Checkout and Payment Gateway Routes 
 */
Route::post('/paymentGateway', [CartController::class, 'paymentGateway'])->name('paymentGateway')->middleware('auth');
Route::get('/Checkoutorder', [CartController::class, 'CheckOutOrder'])->name('CheckOutOrder')->middleware('auth');

/**
 * Increase / Decrease Quantity of cart item
 */
Route::post('/increaseQuantity/{id}', [CartController::class, 'increaseQuantity'])->name('increaseQuantity')->middleware('auth');
Route::post('/decreaseQuantity/{id}', [CartController::class, 'decreaseQuantity'])->name('decreaseQuantity')->middleware('auth');


/**
 * Purchase Order Related Route -------------------------------------------------------------------------------------------------
 * 
 * Show all purchased order to the user
 */
Route::get('/userPurchaseOrder', [OrderController::class, 'UserPurchaseOrder'])->name('userPurchaseOrder')->middleware('auth');

/**
 * Show all purchased order to the organizer
 */
Route::get('/organizerOrderDetails', [OrderController::class, 'OrganizerOrderDetails'])->name('OrganizerOrderDetails')->middleware('auth');

/*
 * Show purchased ticket to the user
 */
Route::get('/PurchasedTicket/{id}', [OrderController::class, 'PurchasedTicket'])->name('PurchasedTicket')->middleware('auth');

/**
 * Show Today's sales for organizer
 */
Route::get('/todaysales', [OrderController::class, 'TodaySales'])->name('TodaySale')->middleware('auth');




/*
 * Admin MAnagement Related Routes --------------------------------------------------------------------------------------------  
 */
Route::get('/users-management', [UserController::class, 'index'])->name('users-management')->middleware('auth');
Route::get('/userDelete/{id}', [UserController::class, 'destroy'])->name('user.delete');
Route::get('/viewEventsByUserId/{id}', [UserController::class, 'tickets'])->name('ticket-management')->middleware('auth');
Route::get('/purchasedBy/{id}', [UserController::class, 'purchasedBy'])->name('purchasedBy')->middleware('auth');
Route::get('/UserDetails', [UserController::class, 'UserStatistics'])->name('UserStatistics')->middleware('auth');



/**
 * Testing Routes----------------------------------------------------------------------------------------------------------------
 */

Route::get('/mailform', function () {
    return view('mail.test');
});

Route::get('/test', function () {
    return view('tickets.TicketInfo');
});
