<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\StoryController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Models\Slider;

use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

Route::get('/',[HomeController::class, 'home'])->name('home');
Route::get('/show-room',[RoomController::class, 'showRoom'])->name('rooms');
Route::get('/booking/{room_type}/{price}', [BookingController::class, 'showForm'])->name('booking.form');
Route::post('booking-form', [BookingController::class, 'submitForm'])->name('booking.submit');

Route::get('/stripe/payment/{bookingId}', [StripeController::class, 'payment'])->name('stripe.payment');

Route::get('stripe/success', [StripeController::class, 'success'])->name('stripe.success');
Route::get('stripe/cancel', [StripeController::class, 'cancel'])->name('stripe.cancel');



Route::get('/admin', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/slider', [SliderController::class, 'index'])->name('slider.index');
    Route::get('/slider/create', [SliderController::class, 'create'])->name('slider.create');
    Route::post('/slider', [SliderController::class, 'store'])->name('slider.store');
    Route::get('/slider/{slider}/edit', [SliderController::class, 'edit'])->name('slider.edit');
    Route::put('/slider/{slider}/update', [SliderController::class, 'update'])->name('slider.update');
    Route::delete('/slider/{slider}/delete', [SliderController::class, 'delete'])->name('slider.delete');


    Route::get('/about', [StoryController::class, 'index'])->name('about.index');
    Route::get('/about/create', [StoryController::class, 'create'])->name('about.create');
    Route::post('/about', [StoryController::class, 'store'])->name('about.store');
    Route::get('/about/{story}/edit', [StoryController::class, 'edit'])->name('about.edit');
    Route::put('/about/{story}/update', [StoryController::class, 'update'])->name('about.update');
    Route::delete('/about/{story}/delete', [StoryController::class, 'delete'])->name('about.delete');

    Route::get('/rooms', [RoomController::class, 'index'])->name('rooms.index');
    Route::get('/rooms/create', [RoomController::class, 'create'])->name('rooms.create');
    Route::post('/rooms', [RoomController::class, 'store'])->name('rooms.store');
    Route::get('/rooms/{room}/edit', [RoomController::class, 'edit'])->name('rooms.edit');
    Route::put('/rooms/{room}/update', [RoomController::class, 'update'])->name('rooms.update');
    Route::delete('/rooms/{room}/delete', [RoomController::class, 'delete'])->name('rooms.delete');

    Route::get('/bookings', [BookingController::class, 'index'])->name('bookings.index');

    Route::get('/predictions', [BookingController::class, 'PredictionIndex'])->name('predictions.index');


    

});






require __DIR__ . '/auth.php';
