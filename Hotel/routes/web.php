<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\StoryController;
use App\Http\Controllers\RoomController;
use Illuminate\Support\Facades\Route;
use App\Models\Slider;

use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

Route::get('/',[HomeController::class, 'home'])->name('home');


Route::get('/admin', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

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
});


Route::get('/bookings', function () {
    return view('dashboard');
})->name('bookings');

Route::get('/predictions', function () {
    return view('dashboard');
})->name('predictions');



require __DIR__ . '/auth.php';
