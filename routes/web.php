<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EcoTrackController;
use App\Http\Controllers\RecyclingCenterController;
use Illuminate\Support\Facades\Route;

// Halaman Utama langsung ke EcoTrack
Route::get('/', [EcoTrackController::class, 'index'])->name('home');
Route::get('/ecotrack', [EcoTrackController::class, 'index'])->name('ecotrack.index');

// Halaman Peta dan Artikel (publik)
Route::get('/recycling-centers', [RecyclingCenterController::class, 'index'])->name('recycling-centers.index');
Route::get('/api/recycling-centers/nearby', [RecyclingCenterController::class, 'nearby'])->name('api.recycling-centers.nearby');
Route::get('/articles/{id}', [App\Http\Controllers\ArticleController::class, 'show'])->name('articles.show');

Route::get('/photo-viewer', function () {
    return view('photo-viewer');
})->name('photo.viewer');

// Semua route yang memerlukan login
Route::middleware('auth')->group(function () {

    // EcoTrack Deposit (hanya user login)
    Route::post('/ecotrack/store', [EcoTrackController::class, 'store'])->name('ecotrack.store');
    Route::delete('/ecotrack/delete/{id}', [EcoTrackController::class, 'destroy'])->name('ecotrack.destroy');
    Route::delete('/ecotrack/{id}', [EcoTrackController::class, 'destroy'])->name('ecotrack.destroy.auth');

    // Dashboard User
    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/photos', [ProfileController::class, 'updatePhotos'])->name('profile.photos.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Laporan, Penarikan, Penjemputan
    Route::post('/reports/store', [App\Http\Controllers\ReportController::class, 'store'])->name('reports.store');
    Route::post('/withdraws', [\App\Http\Controllers\WithdrawController::class, 'store'])->name('withdraws.store');
    Route::post('/pickups', [\App\Http\Controllers\PickupController::class, 'store'])->name('pickups.store');

    // Admin Group
    Route::prefix('admin')->group(function () {
        Route::get('/', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.dashboard');
        Route::patch('/pickups/{pickup}/status', [App\Http\Controllers\AdminController::class, 'updatePickupStatus'])->name('admin.pickups.status');
        Route::patch('/withdraws/{withdraw}/status', [App\Http\Controllers\AdminController::class, 'updateWithdrawStatus'])->name('admin.withdraws.status');
        Route::patch('/reports/{report}/status', [App\Http\Controllers\AdminController::class, 'updateReportStatus'])->name('admin.reports.status');
        Route::patch('/deposits/{ecotrack}/status', [App\Http\Controllers\AdminController::class, 'updateDepositStatus'])->name('admin.deposits.status');
    });
});

require __DIR__.'/auth.php';
