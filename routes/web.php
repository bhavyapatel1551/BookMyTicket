<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\EventController;

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

Route::get('/', function () {
    return redirect('/dashboard');
})->middleware('auth');

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard')->middleware('auth');

Route::post('/dashboard', function () {
    return view('dashboard');
})->name('dashboard')->middleware('auth');

Route::get('/event', function () {
    return view('events.event');
})->name('event')->middleware('auth');

Route::get('/cart', function () {
    return view('cart');
})->name('cart')->middleware('auth');

Route::get('/userticket', function () {
    return view('userticket');
})->name('userticket')->middleware('auth');

Route::get('/ticketinfo', function () {
    return view('ticketinfo');
})->name('ticketinfo')->middleware('auth');

Route::get('/profile', function () {
    return view('account-pages.profile');
})->name('profile')->middleware('auth');

Route::get('/event/create', function () {
    return view('events.createevent');
})->name('create.event')->middleware('auth');

Route::post('/event/create', [EventController::class, 'create'])->name('create.event')->middleware('auth');

Route::get('/signin', function () {
    return view('account-pages.signin');
})->name('signin');

Route::get('/signup', function () {
    return view('account-pages.signup');
})->name('signup')->middleware('guest');

Route::get('/sign-up', [RegisterController::class, 'create'])
    ->middleware('guest')
    ->name('sign-up');

Route::post('/sign-up', [RegisterController::class, 'store'])
    ->middleware('guest');


Route::get('/sign-in', [LoginController::class, 'create'])
    ->middleware('guest')
    ->name('sign-in');

Route::post('/sign-in', [LoginController::class, 'store'])
    ->middleware('guest');

Route::get('/logout', [LoginController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

Route::get('/forgot-password', [ForgotPasswordController::class, 'create'])
    ->middleware('guest')
    ->name('password.request');

Route::post('/forgot-password', [ForgotPasswordController::class, 'store'])
    ->middleware('guest')
    ->name('password.email');

Route::get('/reset-password/{token}', [ResetPasswordController::class, 'create'])
    ->middleware('guest')
    ->name('password.reset');

Route::post('/reset-password', [ResetPasswordController::class, 'store'])
    ->middleware('guest');

Route::get('/user-profile', [ProfileController::class, 'index'])->name('users.profile')->middleware('auth');
Route::put('/user-profile/update', [ProfileController::class, 'update'])->name('users.update')->middleware('auth');
Route::get('/users-management', [UserController::class, 'index'])->name('users-management')->middleware('auth');


Route::get('/user-update-profilephoto', [ProfileController::class, 'showprofilephotoform'])->name('update.profilephoto')->middleware('auth');
Route::post('/user-update-profilephoto', [ProfileController::class, 'updateprofilephoto'])->name('update.profilephoto')->middleware('auth');

Route::get('/new', function () {
    return view('new');
});

Route::get('/verify-otp', [RegisterController::class, 'showOtpForm'])->name('showOtpForm');

Route::post('/verify-otp', [RegisterController::class, 'verifyOtp']);

//.kznvkzd
Route::get('/mailform', function () {
    return view('mail.test');
});
