<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\TopupController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\ShareBranches;
use App\Http\Middleware\ShareEmployeeData;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/branches/{branch}/services', [BranchController::class, 'getServices']);

// Terapkan middleware ShareBranches di semua route di bawah ini
Route::middleware(['auth', 'verified', ShareBranches::class, ShareEmployeeData::class])->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    Route::get('/notif', function () {
        return view('notif.notif');
    });
    
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');

    // Menampilkan halaman cabang
    Route::get('/branch', [BranchController::class, 'index'])
        ->name('branch');
    Route::get('/branch/{branch_id}', [ServiceController::class, 'getServicesByBranch'])
        ->name('branch.services');

    Route::get('/top-up', [TopupController::class, 'index'])
        ->name('branch');

    Route::get('/book', [BookingController::class, 'index'])
        ->name('book');

    Route::post('/bookings/{booking}/accept', [BookingController::class, 'accept'])->name('bookings.accept');
    Route::post('/bookings/{booking}/cancel', [BookingController::class, 'cancel'])->name('bookings.cancel');
    Route::post('/bookings/{booking}/complete', [BookingController::class, 'complete'])->name('bookings.complete');


    Route::resource('branches', BranchController::class);
    Route::resource('services', ServiceController::class);
    Route::resource('topup', TopupController::class);
    Route::resource('bookings', BookingController::class);
    Route::resource('reviews', ReviewController::class);
});

require __DIR__.'/auth.php';
