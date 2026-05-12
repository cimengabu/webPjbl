<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EcoTrackController;
use Illuminate\Support\Facades\Route;

// Halaman Utama langsung ke EcoTrack
Route::get('/', [EcoTrackController::class, 'index'])->name('home');

Route::prefix('ecotrack')->group(function () {
    Route::get('/', [EcoTrackController::class, 'index'])->name('ecotrack.index');
    Route::post('/store', [EcoTrackController::class, 'store'])->name('ecotrack.store');
    Route::delete('/delete/{id}', [EcoTrackController::class, 'destroy'])->name('ecotrack.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::delete('/ecotrack/{id}', [EcoTrackController::class, 'destroy'])->name('ecotrack.destroy.auth');
    Route::post('/reports/store', [App\Http\Controllers\ReportController::class, 'store'])->name('reports.store');
});

require __DIR__.'/auth.php';
