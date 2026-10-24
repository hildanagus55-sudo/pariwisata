<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\DestinationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\TourPackageController;
use Illuminate\Support\Facades\Route;

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

// Admin / Concierge Management
Route::get('/admin/reservasi', [BookingController::class, 'index'])->name('admin.bookings');
Route::patch('/admin/reservasi/{id}/status', [BookingController::class, 'updateStatus'])->name('admin.bookings.updateStatus');

// Newsletter Subscription
Route::post('/newsletter', [NewsletterController::class, 'subscribe'])->name('newsletter.subscribe');
