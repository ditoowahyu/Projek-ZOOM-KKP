<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ZoomScheduleController;
use App\Http\Controllers\PublicScheduleController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ✅ default langsung ke login
Route::get('/', function () {
    return redirect()->route('login');
});

// ✅ dashboard default Breeze (biar navigation.blade tidak error)
Route::get('/dashboard', function () {
    return view('dashboard'); // resources/views/dashboard.blade.php
})->middleware(['auth'])->name('dashboard');

// ✅ setelah login, arahkan berdasarkan role
Route::get('/home', function () {
    if (auth()->user()->role === 'admin') {
        return redirect()->route('admin.schedules.index');
    }
    return redirect()->route('user.schedules');
})->middleware('auth')->name('home');

// ✅ user melihat jadwal zoom
Route::get('/schedules', [PublicScheduleController::class, 'index'])
    ->middleware('auth')
    ->name('user.schedules');

// ✅ hanya admin bisa kelola jadwal
Route::middleware(['auth','admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::resource('schedules', ZoomScheduleController::class);
    });

// ✅ profile bawaan Breeze
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ✅ custom update profile (kalau memang perlu override)
Route::put('/profile/update', [UserController::class, 'updateProfile'])
    ->middleware('auth')
    ->name('profile.update.custom');

// ✅ auth routes dari Breeze
require __DIR__.'/auth.php';
