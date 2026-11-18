<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Destination;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Tampilkan Portal & Dashboard Wisatawan
     */
    public function dashboard()
    {
        /** @var User $user */
        $user = Auth::user();

        // Ambil riwayat reservasi yang terhubung dengan email akun ini
        $bookings = Booking::where('customer_email', $user->email)
            ->latest()
            ->get();

        $totalBookings = $bookings->count();
        $confirmedBookings = $bookings->where('status', 'confirmed')->count();
        $pendingBookings = $bookings->where('status', 'pending')->count();

        // Rekomendasi destinasi untuk inspirasi perjalanan user
        $recommendedDestinations = Destination::where('is_featured', true)
            ->take(3)
            ->get();

        return view('user.dashboard', compact(
            'user',
            'bookings',
            'totalBookings',
            'confirmedBookings',
            'pendingBookings',
            'recommendedDestinations'
        ));
    }

    /**
     * Perbarui data profil akun wisatawan
     */
    public function updateProfile(Request $request)
    {
        /** @var User $user */
        $user = Auth::user();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:25'],
            'password' => ['nullable', 'string', 'min:6', 'confirmed'],
        ], [
            'name.required' => 'Nama lengkap wajib diisi.',
            'password.min' => 'Kata sandi baru minimal 6 karakter.',
            'password.confirmed' => 'Konfirmasi kata sandi baru tidak sesuai.',
        ]);

        $user->name = $validated['name'];
        $user->phone = $validated['phone'] ?? null;

        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        return back()->with('success', 'Data profil Anda berhasil diperbarui.');
    }
}
