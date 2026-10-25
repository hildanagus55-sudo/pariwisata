@extends('layouts.app')

@section('title', 'DANWISATA | Admin Concierge Manajemen Reservasi')

@section('content')
<div class="pt-28 pb-24 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Header Page -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8 pb-5 border-b border-stone-200/80 dark:border-stone-800">
        <div>
            <span class="text-xs font-semibold text-stone-500 uppercase tracking-wider block mb-1">
                Panel Concierge
            </span>
            <h1 class="font-serif text-3xl font-normal text-stone-900 dark:text-white">
                Daftar Reservasi & Catatan Tamu
            </h1>
            <p class="text-xs text-stone-500 mt-1">
                Kelola jadwal perjalanan, periksa status reservasi, dan terbitkan e-tiket resmi wisatawan.
            </p>
        </div>
        <div>
            <a href="{{ route('home') }}" class="px-4 py-2 rounded-full border border-stone-200 dark:border-stone-700 text-xs font-semibold hover:bg-stone-50 dark:hover:bg-stone-800 transition-colors flex items-center gap-2">
                <i class="fa-solid fa-arrow-left text-[11px]"></i>
                <span>Kembali ke Website</span>
            </a>
        </div>
    </div>

    <!-- Quick Stats -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-5 mb-8">
        <div class="p-5 rounded-2xl bg-white dark:bg-stone-900 border border-stone-200/80 dark:border-stone-800 shadow-xs">
            <span class="text-[10px] text-stone-400 uppercase tracking-wider font-semibold block">Total Reservasi Terdaftar</span>
            <p class="font-serif text-3xl font-medium text-stone-900 dark:text-white mt-1">{{ $bookings->total() }}</p>
        </div>
        <div class="p-5 rounded-2xl bg-white dark:bg-stone-900 border border-stone-200/80 dark:border-stone-800 shadow-xs">
            <span class="text-[10px] text-emerald-600 uppercase tracking-wider font-semibold block">Terkonfirmasi</span>
            <p class="font-serif text-3xl font-medium text-emerald-700 dark:text-emerald-400 mt-1">{{ $totalConfirmed }}</p>
        </div>
        <div class="p-5 rounded-2xl bg-white dark:bg-stone-900 border border-stone-200/80 dark:border-stone-800 shadow-xs">
            <span class="text-[10px] text-stone-400 uppercase tracking-wider font-semibold block">Total Nilai Perjalanan</span>
            <p class="font-serif text-2xl font-bold text-stone-900 dark:text-white mt-1">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</p>
        </div>
    </div>

    <!-- Search & Filter -->
    <div class="bg-white dark:bg-stone-900 rounded-2xl p-3.5 mb-6 border border-stone-200 dark:border-stone-800 shadow-xs flex flex-col sm:flex-row gap-3 items-center justify-between">
        <form method="GET" action="{{ route('admin.bookings') }}" class="flex flex-col sm:flex-row gap-2.5 w-full sm:w-auto items-center">
            <div class="relative w-full sm:w-64">
                <i class="fa-solid fa-magnifying-glass absolute left-3.5 top-1/2 -translate-y-1/2 text-stone-400 text-xs"></i>
                <input 
                    type="text" 
                    name="search" 
                    value="{{ request('search') }}" 
                    placeholder="Cari kode, nama, nomor HP..." 
                    class="w-full pl-9 pr-3 py-1.5 rounded-full bg-stone-50 dark:bg-stone-800 border border-stone-200 dark:border-stone-700 text-xs focus:ring-1 focus:ring-stone-900 focus:outline-none"
                >
            </div>
            <select name="status" onchange="this.form.submit()" class="w-full sm:w-auto px-3 py-1.5 rounded-full bg-stone-50 dark:bg-stone-800 border border-stone-200 dark:border-stone-700 text-xs font-medium focus:ring-1 focus:ring-stone-900 focus:outline-none">
                <option value="all" {{ request('status') == 'all' ? 'selected' : '' }}>Semua Status</option>
                <option value="confirmed" {{ request('status') == 'confirmed' ? 'selected' : '' }}>Terkonfirmasi</option>
                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Menunggu Pembayaran</option>
                <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Selesai Berwisata</option>
                <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Dibatalkan</option>
            </select>
            <button type="submit" class="px-4 py-1.5 rounded-full bg-stone-900 text-white text-xs font-semibold hover:bg-stone-800">Cari</button>
            @if(request('search') || request('status'))
                <a href="{{ route('admin.bookings') }}" class="text-xs text-stone-500 hover:text-stone-900 underline">Reset</a>
            @endif
        </form>
    </div>

    <!-- Table -->
    <div class="bg-white dark:bg-stone-900 rounded-3xl border border-stone-200/90 dark:border-stone-800 shadow-xs overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="bg-stone-50 dark:bg-stone-800/60 text-stone-500 uppercase tracking-wider text-[10px] font-semibold border-b border-stone-200 dark:border-stone-800">
                    <tr>
                        <th class="py-3.5 px-5">Kode</th>
                        <th class="py-3.5 px-5">Nama Tamu</th>
                        <th class="py-3.5 px-5">Destinasi / Paket</th>
                        <th class="py-3.5 px-5">Jadwal & Tamu</th>
                        <th class="py-3.5 px-5">Biaya</th>
                        <th class="py-3.5 px-5">Status</th>
                        <th class="py-3.5 px-5 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-stone-100 dark:divide-stone-800 text-stone-700 dark:text-stone-300">
                    @forelse($bookings as $booking)
                        <tr class="hover:bg-stone-50 dark:hover:bg-stone-800/40 transition-colors">
                            <td class="py-3.5 px-5 font-mono font-medium text-stone-900 dark:text-stone-100">
                                {{ $booking->booking_code }}
                            </td>
                            <td class="py-3.5 px-5">
                                <p class="font-medium text-stone-900 dark:text-white">{{ $booking->customer_name }}</p>
                                <p class="text-[11px] text-stone-400">{{ $booking->customer_phone }}</p>
                            </td>
                            <td class="py-3.5 px-5 max-w-xs truncate">
                                {{ $booking->item_name }}
                            </td>
                            <td class="py-3.5 px-5">
                                <p class="font-medium">{{ $booking->travel_date->format('d M Y') }}</p>
                                <p class="text-[10px] text-stone-400">{{ $booking->pax }} Tamu</p>
                            </td>
                            <td class="py-3.5 px-5 font-bold text-stone-900 dark:text-white">
                                {{ $booking->formatted_total_price }}
                                @if($booking->discount_amount > 0)
                                    <span class="block text-[10px] text-emerald-600 font-normal">Diskon Voucher 15%</span>
                                @endif
                            </td>
                            <td class="py-3.5 px-5">
                                <form method="POST" action="{{ route('admin.bookings.updateStatus', $booking->id) }}">
                                    @csrf
                                    @method('PATCH')
                                    <select name="status" onchange="this.form.submit()" class="px-2 py-0.5 rounded-md text-[11px] font-medium border border-stone-200 dark:border-stone-700 bg-white dark:bg-stone-800">
                                        <option value="confirmed" {{ $booking->status === 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                        <option value="pending" {{ $booking->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="completed" {{ $booking->status === 'completed' ? 'selected' : '' }}>Completed</option>
                                        <option value="cancelled" {{ $booking->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                    </select>
                                </form>
                            </td>
                            <td class="py-3.5 px-5 text-right">
                                <a href="{{ route('bookings.receipt', $booking->booking_code) }}" target="_blank" class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-stone-100 dark:bg-stone-800 hover:bg-stone-200 text-[11px] font-medium transition-colors">
                                    <i class="fa-solid fa-receipt text-[10px]"></i>
                                    <span>E-Tiket</span>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-10 text-center text-stone-400 text-xs">
                                Belum ada data reservasi yang sesuai.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($bookings->hasPages())
            <div class="p-4 border-t border-stone-100 dark:border-stone-800">
                {{ $bookings->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
