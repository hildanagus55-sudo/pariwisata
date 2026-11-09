@extends('admin.layouts.app')

@section('title', 'Dashboard Concierge | Admin DANWISATA')
@section('page_title', 'Ringkasan Dashboard')
@section('page_description', 'Pantau aktivitas pemesanan, perputaran reservasi, dan statistik destinasi wisata secara real-time.')

@section('header_actions')
    <a href="{{ route('admin.destinations.create') }}" class="px-3.5 py-1.5 rounded-full bg-stone-900 text-white dark:bg-stone-100 dark:text-stone-900 text-xs font-semibold hover:opacity-90 flex items-center gap-1.5 shadow-xs transition-opacity">
        <i class="fa-solid fa-plus text-[10px]"></i>
        <span>Tambah Destinasi</span>
    </a>
@endsection

@section('content')
<div class="space-y-6">
    <!-- Welcome Greeting Card -->
    <div class="relative overflow-hidden p-6 sm:p-8 rounded-3xl bg-gradient-to-r from-stone-900 via-stone-850 to-stone-900 text-white shadow-xl border border-stone-800">
        <div class="relative z-10 max-w-2xl">
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-amber-500/20 text-amber-300 text-[10px] font-bold uppercase tracking-wider mb-3 border border-amber-500/30">
                <i class="fa-solid fa-crown text-[9px]"></i>
                <span>Concierge Command Center</span>
            </span>
            <h1 class="font-serif text-2xl sm:text-3xl font-bold tracking-tight">
                Selamat Datang di Panel Kelola DANWISATA
            </h1>
            <p class="mt-2 text-xs sm:text-sm text-stone-300 leading-relaxed">
                Kelola seluruh alur pariwisata nusantara: verifikasi pembayaran tiket tamu, terbitkan e-tiket resmi, serta perbarui rute dan paket wisata eksklusif.
            </p>
        </div>
        <div class="absolute right-0 bottom-0 translate-x-8 translate-y-8 opacity-10 pointer-events-none text-white text-9xl">
            <i class="fa-solid fa-compass"></i>
        </div>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <!-- Card 1: Total Reservasi -->
        <div class="p-5 rounded-2xl bg-white dark:bg-stone-900 border border-stone-200/80 dark:border-stone-800 shadow-xs flex items-center justify-between">
            <div>
                <span class="text-[10px] font-bold uppercase tracking-wider text-stone-400 block mb-1">Total Reservasi</span>
                <p class="font-serif text-2xl font-bold text-stone-900 dark:text-white">{{ $totalBookings }}</p>
                <div class="mt-1 flex items-center gap-2 text-[10px]">
                    <span class="text-emerald-600 font-semibold">{{ $confirmedBookings }} Terkonfirmasi</span>
                    <span class="text-stone-300 dark:text-stone-700">•</span>
                    <span class="text-amber-600 font-semibold">{{ $pendingBookings }} Menunggu</span>
                </div>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-stone-100 dark:bg-stone-800 text-stone-800 dark:text-stone-200 flex items-center justify-center text-lg">
                <i class="fa-solid fa-calendar-check"></i>
            </div>
        </div>

        <!-- Card 2: Total Pendapatan -->
        <div class="p-5 rounded-2xl bg-white dark:bg-stone-900 border border-stone-200/80 dark:border-stone-800 shadow-xs flex items-center justify-between">
            <div>
                <span class="text-[10px] font-bold uppercase tracking-wider text-stone-400 block mb-1">Nilai Perjalanan</span>
                <p class="font-serif text-2xl font-bold text-emerald-600 dark:text-emerald-400">
                    Rp {{ number_format($totalRevenue, 0, ',', '.') }}
                </p>
                <p class="mt-1 text-[10px] text-stone-400">Dari tiket valid & selesai</p>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-emerald-50 dark:bg-emerald-950/40 text-emerald-600 dark:text-emerald-400 flex items-center justify-center text-lg">
                <i class="fa-solid fa-wallet"></i>
            </div>
        </div>

        <!-- Card 3: Destinasi & Paket -->
        <div class="p-5 rounded-2xl bg-white dark:bg-stone-900 border border-stone-200/80 dark:border-stone-800 shadow-xs flex items-center justify-between">
            <div>
                <span class="text-[10px] font-bold uppercase tracking-wider text-stone-400 block mb-1">Destinasi Aktif</span>
                <p class="font-serif text-2xl font-bold text-stone-900 dark:text-white">{{ $totalDestinations }}</p>
                <p class="mt-1 text-[10px] text-stone-400">{{ $totalPackages }} Paket Tour Tersedia</p>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-stone-100 dark:bg-stone-800 text-stone-800 dark:text-stone-200 flex items-center justify-center text-lg">
                <i class="fa-solid fa-map-location-dot"></i>
            </div>
        </div>

        <!-- Card 4: Warta / Newsletter -->
        <div class="p-5 rounded-2xl bg-white dark:bg-stone-900 border border-stone-200/80 dark:border-stone-800 shadow-xs flex items-center justify-between">
            <div>
                <span class="text-[10px] font-bold uppercase tracking-wider text-stone-400 block mb-1">Pelanggan Warta</span>
                <p class="font-serif text-2xl font-bold text-stone-900 dark:text-white">{{ $totalSubscribers }}</p>
                <p class="mt-1 text-[10px] text-stone-400">Peminat trip & buletin</p>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-stone-100 dark:bg-stone-800 text-stone-800 dark:text-stone-200 flex items-center justify-center text-lg">
                <i class="fa-solid fa-envelope-open-text"></i>
            </div>
        </div>
    </div>

    <!-- Quick Action Shortcuts -->
    <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
        <a href="{{ route('admin.bookings') }}" class="p-4 rounded-2xl bg-white dark:bg-stone-900 border border-stone-200 dark:border-stone-800 hover:border-amber-500/50 hover:shadow-md transition-all group flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-amber-50 dark:bg-amber-950/40 text-amber-600 dark:text-amber-400 flex items-center justify-center text-sm group-hover:scale-110 transition-transform">
                <i class="fa-solid fa-list-check"></i>
            </div>
            <div class="min-w-0">
                <h4 class="text-xs font-bold text-stone-900 dark:text-white truncate">Daftar Reservasi</h4>
                <p class="text-[10px] text-stone-400 truncate">Verifikasi tiket tamu</p>
            </div>
        </a>

        <a href="{{ route('admin.destinations.create') }}" class="p-4 rounded-2xl bg-white dark:bg-stone-900 border border-stone-200 dark:border-stone-800 hover:border-amber-500/50 hover:shadow-md transition-all group flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-blue-50 dark:bg-blue-950/40 text-blue-600 dark:text-blue-400 flex items-center justify-center text-sm group-hover:scale-110 transition-transform">
                <i class="fa-solid fa-plus"></i>
            </div>
            <div class="min-w-0">
                <h4 class="text-xs font-bold text-stone-900 dark:text-white truncate">Tambah Rute</h4>
                <p class="text-[10px] text-stone-400 truncate">Destinasi wisata baru</p>
            </div>
        </a>

        <a href="{{ route('admin.packages.create') }}" class="p-4 rounded-2xl bg-white dark:bg-stone-900 border border-stone-200 dark:border-stone-800 hover:border-amber-500/50 hover:shadow-md transition-all group flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-emerald-50 dark:bg-emerald-950/40 text-emerald-600 dark:text-emerald-400 flex items-center justify-center text-sm group-hover:scale-110 transition-transform">
                <i class="fa-solid fa-suitcase-rolling"></i>
            </div>
            <div class="min-w-0">
                <h4 class="text-xs font-bold text-stone-900 dark:text-white truncate">Buat Paket Tour</h4>
                <p class="text-[10px] text-stone-400 truncate">Paket liburan baru</p>
            </div>
        </a>

        <a href="{{ route('admin.newsletters.index') }}" class="p-4 rounded-2xl bg-white dark:bg-stone-900 border border-stone-200 dark:border-stone-800 hover:border-amber-500/50 hover:shadow-md transition-all group flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-purple-50 dark:bg-purple-950/40 text-purple-600 dark:text-purple-400 flex items-center justify-center text-sm group-hover:scale-110 transition-transform">
                <i class="fa-solid fa-envelope"></i>
            </div>
            <div class="min-w-0">
                <h4 class="text-xs font-bold text-stone-900 dark:text-white truncate">Daftar Surel</h4>
                <p class="text-[10px] text-stone-400 truncate">Pelanggan warta</p>
            </div>
        </a>
    </div>

    <!-- Two Columns: Recent Bookings & Destinations -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Left: Recent Bookings (2 Cols) -->
        <div class="lg:col-span-2 bg-white dark:bg-stone-900 rounded-3xl border border-stone-200/90 dark:border-stone-800 shadow-xs overflow-hidden">
            <div class="p-5 border-b border-stone-100 dark:border-stone-800 flex items-center justify-between">
                <div>
                    <h3 class="font-serif text-base font-bold text-stone-900 dark:text-white">Reservasi Terbaru</h3>
                    <p class="text-[10px] text-stone-400">Pemesanan tiket yang baru saja masuk ke sistem</p>
                </div>
                <a href="{{ route('admin.bookings') }}" class="text-xs font-semibold text-amber-700 dark:text-amber-400 hover:underline flex items-center gap-1">
                    <span>Lihat Semua</span>
                    <i class="fa-solid fa-arrow-right text-[10px]"></i>
                </a>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead class="bg-stone-50 dark:bg-stone-800/60 text-stone-400 uppercase tracking-wider text-[10px] font-bold border-b border-stone-100 dark:border-stone-800">
                        <tr>
                            <th class="py-3 px-4">Kode & Tamu</th>
                            <th class="py-3 px-4">Tujuan</th>
                            <th class="py-3 px-4">Tanggal</th>
                            <th class="py-3 px-4">Total</th>
                            <th class="py-3 px-4">Status</th>
                            <th class="py-3 px-4 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-stone-100 dark:divide-stone-800 text-stone-700 dark:text-stone-300">
                        @forelse($recentBookings as $booking)
                            <tr class="hover:bg-stone-50/80 dark:hover:bg-stone-800/40 transition-colors">
                                <td class="py-3 px-4">
                                    <span class="font-mono font-bold text-stone-900 dark:text-white block">{{ $booking->booking_code }}</span>
                                    <span class="text-[11px] text-stone-500">{{ $booking->customer_name }}</span>
                                </td>
                                <td class="py-3 px-4 max-w-[140px] truncate">
                                    {{ $booking->item_name }}
                                </td>
                                <td class="py-3 px-4 whitespace-nowrap">
                                    <p class="font-medium text-stone-900 dark:text-stone-200">{{ $booking->travel_date->format('d M Y') }}</p>
                                    <p class="text-[10px] text-stone-400">{{ $booking->pax }} Tamu</p>
                                </td>
                                <td class="py-3 px-4 font-bold text-stone-900 dark:text-white whitespace-nowrap">
                                    {{ $booking->formatted_total_price }}
                                </td>
                                <td class="py-3 px-4 whitespace-nowrap">
                                    <form method="POST" action="{{ route('admin.bookings.updateStatus', $booking->id) }}">
                                        @csrf
                                        @method('PATCH')
                                        <select name="status" onchange="this.form.submit()" class="px-2 py-1 rounded-lg text-[10px] font-bold border border-stone-200 dark:border-stone-700 bg-white dark:bg-stone-800 cursor-pointer {{ $booking->status === 'confirmed' ? 'text-emerald-700 bg-emerald-50 dark:bg-emerald-950/40' : ($booking->status === 'pending' ? 'text-amber-700 bg-amber-50 dark:bg-amber-950/40' : 'text-stone-600') }}">
                                            <option value="confirmed" {{ $booking->status === 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                            <option value="pending" {{ $booking->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="completed" {{ $booking->status === 'completed' ? 'selected' : '' }}>Completed</option>
                                            <option value="cancelled" {{ $booking->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                        </select>
                                    </form>
                                </td>
                                <td class="py-3 px-4 text-right whitespace-nowrap">
                                    <a href="{{ route('bookings.receipt', $booking->booking_code) }}" target="_blank" class="p-1.5 rounded-lg bg-stone-100 hover:bg-stone-200 dark:bg-stone-800 dark:hover:bg-stone-700 text-stone-700 dark:text-stone-300 text-xs transition-colors" title="Lihat E-Tiket">
                                        <i class="fa-solid fa-receipt"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="py-8 text-center text-xs text-stone-400">Belum ada reservasi masuk.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Right: Recent Destinations & Subscribers (1 Col) -->
        <div class="space-y-6">
            <!-- Destinations Mini Card -->
            <div class="bg-white dark:bg-stone-900 rounded-3xl border border-stone-200/90 dark:border-stone-800 p-5 shadow-xs">
                <div class="flex items-center justify-between pb-3 mb-3 border-b border-stone-100 dark:border-stone-800">
                    <h3 class="font-serif text-sm font-bold text-stone-900 dark:text-white">Destinasi Unggulan</h3>
                    <a href="{{ route('admin.destinations.index') }}" class="text-[11px] font-semibold text-amber-700 dark:text-amber-400 hover:underline">Kelola</a>
                </div>
                <div class="space-y-3">
                    @forelse($recentDestinations as $dest)
                        <div class="flex items-center justify-between gap-3 p-2 rounded-xl hover:bg-stone-50 dark:hover:bg-stone-800/50 transition-colors">
                            <div class="flex items-center gap-3 min-w-0">
                                <img src="{{ $dest->image }}" alt="{{ $dest->name }}" class="w-10 h-10 rounded-xl object-cover shrink-0 bg-stone-100">
                                <div class="min-w-0">
                                    <h4 class="text-xs font-bold text-stone-900 dark:text-white truncate">{{ $dest->name }}</h4>
                                    <p class="text-[10px] text-stone-400 truncate">{{ $dest->region }} • {{ $dest->formatted_price }}</p>
                                </div>
                            </div>
                            <a href="{{ route('admin.destinations.edit', $dest->id) }}" class="p-1.5 text-stone-400 hover:text-stone-900 dark:hover:text-white text-xs">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                        </div>
                    @empty
                        <p class="text-xs text-stone-400 py-3 text-center">Belum ada destinasi.</p>
                    @endforelse
                </div>
            </div>

            <!-- Subscribers Mini Card -->
            <div class="bg-white dark:bg-stone-900 rounded-3xl border border-stone-200/90 dark:border-stone-800 p-5 shadow-xs">
                <div class="flex items-center justify-between pb-3 mb-3 border-b border-stone-100 dark:border-stone-800">
                    <h3 class="font-serif text-sm font-bold text-stone-900 dark:text-white">Warta Masuk Terbaru</h3>
                    <a href="{{ route('admin.newsletters.index') }}" class="text-[11px] font-semibold text-amber-700 dark:text-amber-400 hover:underline">Semua</a>
                </div>
                <div class="space-y-2">
                    @forelse($recentSubscribers as $sub)
                        <div class="flex items-center justify-between text-xs py-1.5 border-b border-stone-50 dark:border-stone-800/50 last:border-0">
                            <span class="font-medium text-stone-800 dark:text-stone-200 truncate">{{ $sub->email }}</span>
                            <span class="text-[10px] text-stone-400 shrink-0">{{ $sub->created_at->diffForHumans() }}</span>
                        </div>
                    @empty
                        <p class="text-xs text-stone-400 py-3 text-center">Belum ada pelanggan warta.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
