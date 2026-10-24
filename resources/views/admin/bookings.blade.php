@extends('layouts.app')

@section('title', 'Admin Concierge — Manajemen Reservasi Wisata | NusantaraWander')

@section('content')
<div class="pt-28 pb-24 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Header Page -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
        <div>
            <span class="inline-block px-3 py-1 rounded-full bg-brand-100 dark:bg-brand-900/50 text-brand-700 dark:text-brand-300 text-xs font-bold uppercase tracking-wider mb-2">
                Panel Manajemen Concierge
            </span>
            <h1 class="font-serif text-3xl font-bold text-slate-900 dark:text-white">
                Daftar Reservasi & Simulasi Pemesanan
            </h1>
            <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">
                Kelola status reservasi wisatawan, pantau total pendapatan simulasi, dan lihat e-tiket pelanggan.
            </p>
        </div>
        <div>
            <a href="{{ route('home') }}" class="px-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 text-xs font-bold hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors flex items-center gap-2">
                <i class="fa-solid fa-arrow-left"></i>
                <span>Kembali ke Website</span>
            </a>
        </div>
    </div>

    <!-- Quick Stats Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-8">
        <div class="p-6 rounded-3xl bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-slate-800 shadow-sm">
            <span class="text-xs text-slate-400 uppercase tracking-wider font-semibold">Total Reservasi Masuk</span>
            <p class="font-serif text-3xl font-bold text-slate-900 dark:text-white mt-1">{{ $bookings->total() }}</p>
        </div>
        <div class="p-6 rounded-3xl bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-slate-800 shadow-sm">
            <span class="text-xs text-emerald-600 dark:text-emerald-400 uppercase tracking-wider font-semibold">Terkonfirmasi</span>
            <p class="font-serif text-3xl font-bold text-emerald-600 dark:text-emerald-400 mt-1">{{ $totalConfirmed }}</p>
        </div>
        <div class="p-6 rounded-3xl bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-slate-800 shadow-sm">
            <span class="text-xs text-brand-600 dark:text-brand-400 uppercase tracking-wider font-semibold">Total Nilai Transaksi</span>
            <p class="font-serif text-2xl sm:text-3xl font-bold text-brand-700 dark:text-brand-400 mt-1">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</p>
        </div>
    </div>

    <!-- Filter & Search Bar -->
    <div class="bg-white dark:bg-slate-900 rounded-2xl p-4 mb-6 border border-slate-200 dark:border-slate-800 shadow-sm flex flex-col sm:flex-row gap-4 items-center justify-between">
        <form method="GET" action="{{ route('admin.bookings') }}" class="flex flex-col sm:flex-row gap-3 w-full sm:w-auto items-center">
            <div class="relative w-full sm:w-72">
                <i class="fa-solid fa-magnifying-glass absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                <input 
                    type="text" 
                    name="search" 
                    value="{{ request('search') }}" 
                    placeholder="Cari kode, nama, nomor HP..." 
                    class="w-full pl-9 pr-4 py-2 rounded-xl bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-xs focus:ring-2 focus:ring-brand-500 focus:outline-none"
                >
            </div>
            <select name="status" onchange="this.form.submit()" class="w-full sm:w-auto px-3.5 py-2 rounded-xl bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-xs font-semibold focus:ring-2 focus:ring-brand-500 focus:outline-none">
                <option value="all" {{ request('status') == 'all' ? 'selected' : '' }}>Semua Status</option>
                <option value="confirmed" {{ request('status') == 'confirmed' ? 'selected' : '' }}>Terkonfirmasi</option>
                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Menunggu Pembayaran</option>
                <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Selesai Berwisata</option>
                <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Dibatalkan</option>
            </select>
            <button type="submit" class="px-4 py-2 rounded-xl bg-brand-600 text-white text-xs font-bold hover:bg-brand-700">Cari</button>
            @if(request('search') || request('status'))
                <a href="{{ route('admin.bookings') }}" class="text-xs text-slate-500 hover:text-rose-500 font-semibold">Reset</a>
            @endif
        </form>
    </div>

    <!-- Bookings Table -->
    <div class="bg-white dark:bg-slate-900 rounded-3xl border border-slate-200/80 dark:border-slate-800 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs sm:text-sm">
                <thead class="bg-slate-50 dark:bg-slate-800/60 text-slate-500 uppercase tracking-wider text-[11px] font-bold border-b border-slate-200 dark:border-slate-800">
                    <tr>
                        <th class="py-4 px-6">Kode Booking</th>
                        <th class="py-4 px-6">Pelanggan</th>
                        <th class="py-4 px-6">Destinasi / Paket</th>
                        <th class="py-4 px-6">Tanggal & Pax</th>
                        <th class="py-4 px-6">Total Biaya</th>
                        <th class="py-4 px-6">Status</th>
                        <th class="py-4 px-6 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-slate-800 text-slate-700 dark:text-slate-300">
                    @forelse($bookings as $booking)
                        <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/40 transition-colors">
                            <td class="py-4 px-6 font-mono font-bold text-brand-600 dark:text-brand-400">
                                {{ $booking->booking_code }}
                            </td>
                            <td class="py-4 px-6">
                                <p class="font-bold text-slate-900 dark:text-white">{{ $booking->customer_name }}</p>
                                <p class="text-[11px] text-slate-400">{{ $booking->customer_phone }}</p>
                            </td>
                            <td class="py-4 px-6 max-w-xs truncate font-medium">
                                {{ $booking->item_name }}
                            </td>
                            <td class="py-4 px-6">
                                <p class="font-semibold">{{ $booking->travel_date->format('d M Y') }}</p>
                                <p class="text-[11px] text-slate-400">{{ $booking->pax }} Orang</p>
                            </td>
                            <td class="py-4 px-6 font-extrabold text-slate-900 dark:text-white">
                                {{ $booking->formatted_total_price }}
                                @if($booking->discount_amount > 0)
                                    <span class="block text-[10px] text-emerald-500 font-normal">Diskon 15%</span>
                                @endif
                            </td>
                            <td class="py-4 px-6">
                                <form method="POST" action="{{ route('admin.bookings.updateStatus', $booking->id) }}">
                                    @csrf
                                    @method('PATCH')
                                    <select name="status" onchange="this.form.submit()" class="px-2.5 py-1 rounded-lg text-xs font-bold border 
                                        {{ $booking->status === 'confirmed' ? 'bg-emerald-50 text-emerald-700 border-emerald-300 dark:bg-emerald-950/60 dark:text-emerald-300' : '' }}
                                        {{ $booking->status === 'pending' ? 'bg-amber-50 text-amber-700 border-amber-300 dark:bg-amber-950/60 dark:text-amber-300' : '' }}
                                        {{ $booking->status === 'completed' ? 'bg-sky-50 text-sky-700 border-sky-300 dark:bg-sky-950/60 dark:text-sky-300' : '' }}
                                        {{ $booking->status === 'cancelled' ? 'bg-rose-50 text-rose-700 border-rose-300 dark:bg-rose-950/60 dark:text-rose-300' : '' }}
                                    ">
                                        <option value="confirmed" {{ $booking->status === 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                        <option value="pending" {{ $booking->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="completed" {{ $booking->status === 'completed' ? 'selected' : '' }}>Completed</option>
                                        <option value="cancelled" {{ $booking->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                    </select>
                                </form>
                            </td>
                            <td class="py-4 px-6 text-right">
                                <a href="{{ route('bookings.receipt', $booking->booking_code) }}" target="_blank" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-slate-100 dark:bg-slate-800 hover:bg-brand-50 hover:text-brand-600 text-xs font-bold transition-colors">
                                    <i class="fa-solid fa-receipt"></i>
                                    <span>E-Tiket</span>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-12 text-center text-slate-400">
                                <i class="fa-solid fa-inbox text-3xl mb-2 block"></i>
                                Belum ada data reservasi yang sesuai kriteria pencarian.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($bookings->hasPages())
            <div class="p-6 border-t border-slate-100 dark:border-slate-800">
                {{ $bookings->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
