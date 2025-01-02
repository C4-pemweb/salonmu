<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BranchController;
use Illuminate\Support\Facades\Route;

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

Route::get('/branch', [BranchController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('branch');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // branch
    Route::resource('branches', BranchController::class);
});

require __DIR__.'/auth.php';
