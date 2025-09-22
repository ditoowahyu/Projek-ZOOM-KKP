<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Admin\ZoomScheduleController;
use App\Http\Controllers\PublicScheduleController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\PerwiraController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Default → redirect ke login
Route::get('/', fn() => redirect()->route('login'));

// Dashboard default Breeze
Route::get('/dashboard', fn() => view('dashboard'))
    ->middleware(['auth'])
    ->name('dashboard');

// Setelah login → arahkan berdasarkan role
Route::get('/home', function () {
    return auth()->user()->role === 'admin'
        ? redirect()->route('admin.schedules.index')
        : redirect()->route('user.schedules');
})->middleware('auth')->name('home');

/*
|--------------------------------------------------------------------------
| User Routes
|--------------------------------------------------------------------------
*/
// User melihat jadwal Zoom
Route::get('/schedules', [PublicScheduleController::class, 'index'])
    ->middleware('auth')
    ->name('user.schedules');

// Authenticated user → profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Custom update profile
    Route::put('/profile/update', [UserController::class, 'updateProfile'])->name('profile.update.custom');
});

// User reports
Route::middleware(['auth'])->group(function () {
    Route::resource('reports', ReportController::class)->only(['index', 'create', 'store', 'show','update']);
});

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->middleware(['auth', 'admin'])->name('admin.')->group(function () {

    // Zoom Schedules (resource)
    Route::resource('schedules', ZoomScheduleController::class);

    // Anggota & Perwira (resource)
    Route::resources([
        'anggota' => AnggotaController::class,
        'perwira' => PerwiraController::class,
    ]);

    // Reports
    Route::resource('reports', ReportController::class)->except(['show', 'create', 'edit']);
});

/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
*/
require __DIR__ . '/auth.php';
