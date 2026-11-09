<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\DestinationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\TourPackageController;
use Illuminate\Support\Facades\Route;

// ==========================================
// FRONTEND & LANDING PAGE ROUTES
// (Khusus Website Publik DANWISATA)
// ==========================================

// Beranda & Interactive Explorer
Route::get('/', [HomeController::class, 'index'])->name('home');

// Destinasi Wisata
Route::get('/destinasi', [DestinationController::class, 'index'])->name('destinations.index');
Route::get('/destinasi/{slug}', [DestinationController::class, 'show'])->name('destinations.show');
Route::get('/api/destinations/{id}', [DestinationController::class, 'apiDetail'])->name('api.destinations.detail');

// Paket Perjalanan
Route::get('/paket', [TourPackageController::class, 'index'])->name('packages.index');
Route::get('/paket/{slug}', [TourPackageController::class, 'show'])->name('packages.show');

// Reservasi & E-Tiket Tamu
Route::post('/booking', [BookingController::class, 'store'])->name('bookings.store');
Route::get('/booking/tiket/{booking_code}', [BookingController::class, 'receipt'])->name('bookings.receipt');

// Berlangganan Warta / Newsletter
Route::post('/newsletter', [NewsletterController::class, 'subscribe'])->name('newsletter.subscribe');

// Pengalihan ke Aplikasi Admin Terpisah (d:\admin pariwisata pada port 8001)
Route::get('/admin', function () {
    return redirect()->away(env('ADMIN_URL', 'http://localhost:8001'));
})->name('admin.redirect');
Route::get('/admin/{any}', function () {
    return redirect()->away(env('ADMIN_URL', 'http://localhost:8001'));
})->where('any', '.*');
