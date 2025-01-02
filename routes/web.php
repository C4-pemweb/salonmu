<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\ShareBranches;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/book', function () {
    return view('book.book');
});

Route::get('/topup', function () {
    return view('topup.topup');
});

Route::get('/notif', function () {
    return view('notif.notif');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Terapkan middleware ShareBranches di semua route di bawah ini
Route::middleware(['auth', 'verified', ShareBranches::class])->group(function () {

    // Menampilkan halaman cabang
    Route::get('/branch', [BranchController::class, 'index'])
        ->name('branch');

    Route::resource('branches', BranchController::class);
    Route::resource('services', ServiceController::class);
});

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
