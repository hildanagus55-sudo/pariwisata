<?php

use App\Http\Controllers\Admin\BookingController as AdminBookingController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\DestinationController as AdminDestinationController;
use App\Http\Controllers\Admin\NewsletterController as AdminNewsletterController;
use App\Http\Controllers\Admin\TourPackageController as AdminTourPackageController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\DestinationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\TourPackageController;
use Illuminate\Support\Facades\Route;

// ==========================================
// FRONTEND ROUTES (User & Public Visitors)
// ==========================================

// Home & Interactive Explorer
Route::get('/', [HomeController::class, 'index'])->name('home');

// Destinations
Route::get('/destinasi', [DestinationController::class, 'index'])->name('destinations.index');
Route::get('/destinasi/{slug}', [DestinationController::class, 'show'])->name('destinations.show');
Route::get('/api/destinations/{id}', [DestinationController::class, 'apiDetail'])->name('api.destinations.detail');

// Tour Packages
Route::get('/paket', [TourPackageController::class, 'index'])->name('packages.index');
Route::get('/paket/{slug}', [TourPackageController::class, 'show'])->name('packages.show');

// Bookings & Reservations
Route::post('/booking', [BookingController::class, 'store'])->name('bookings.store');
Route::get('/booking/tiket/{booking_code}', [BookingController::class, 'receipt'])->name('bookings.receipt');

// Newsletter Subscription
Route::post('/newsletter', [NewsletterController::class, 'subscribe'])->name('newsletter.subscribe');

// ==========================================
// BACKEND / ADMIN CONCIERGE ROUTES
// ==========================================

Route::prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard.index');

    // Manajemen Reservasi
    Route::get('/reservasi', [AdminBookingController::class, 'index'])->name('bookings');
    Route::patch('/reservasi/{id}/status', [AdminBookingController::class, 'updateStatus'])->name('bookings.updateStatus');
    Route::delete('/reservasi/{id}', [AdminBookingController::class, 'destroy'])->name('bookings.destroy');

    // Manajemen Destinasi (CRUD)
    Route::resource('destinasi', AdminDestinationController::class)->names('destinations');

    // Manajemen Paket Wisata (CRUD)
    Route::resource('paket', AdminTourPackageController::class)->names('packages');

    // Manajemen Warta / Newsletter
    Route::get('/newsletter', [AdminNewsletterController::class, 'index'])->name('newsletters.index');
    Route::delete('/newsletter/{id}', [AdminNewsletterController::class, 'destroy'])->name('newsletters.destroy');
});
