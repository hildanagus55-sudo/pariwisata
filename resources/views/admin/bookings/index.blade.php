@extends('admin.layouts.app')

@section('title', 'Manajemen Reservasi Tamu | Admin DANWISATA')
@section('page_title', 'Daftar Reservasi & E-Tiket')
@section('page_description', 'Kelola jadwal perjalanan, periksa status reservasi, dan terbitkan e-tiket resmi wisatawan.')

@section('content')
<div class="space-y-6">
    <!-- Quick Stats -->
    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
        <div class="p-4 sm:p-5 rounded-2xl bg-white dark:bg-stone-900 border border-stone-200/80 dark:border-stone-800 shadow-xs">
            <span class="text-[10px] text-stone-400 uppercase tracking-wider font-bold block mb-1">Total Reservasi</span>
            <p class="font-serif text-2xl sm:text-3xl font-bold text-stone-900 dark:text-white">{{ $bookings->total() }}</p>
        </div>
        <div class="p-4 sm:p-5 rounded-2xl bg-white dark:bg-stone-900 border border-stone-200/80 dark:border-stone-800 shadow-xs">
            <span class="text-[10px] text-emerald-600 uppercase tracking-wider font-bold block mb-1">Terkonfirmasi</span>
            <p class="font-serif text-2xl sm:text-3xl font-bold text-emerald-700 dark:text-emerald-400">{{ $totalConfirmed }}</p>
        </div>
        <div class="p-4 sm:p-5 rounded-2xl bg-white dark:bg-stone-900 border border-stone-200/80 dark:border-stone-800 shadow-xs">
            <span class="text-[10px] text-amber-600 uppercase tracking-wider font-bold block mb-1">Menunggu Bayar</span>
            <p class="font-serif text-2xl sm:text-3xl font-bold text-amber-700 dark:text-amber-400">{{ $totalPending }}</p>
        </div>
        <div class="p-4 sm:p-5 rounded-2xl bg-white dark:bg-stone-900 border border-stone-200/80 dark:border-stone-800 shadow-xs">
            <span class="text-[10px] text-stone-400 uppercase tracking-wider font-bold block mb-1">Total Nilai Trip</span>
            <p class="font-serif text-xl sm:text-2xl font-bold text-stone-900 dark:text-white truncate">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</p>
        </div>
    </div>

    <!-- Search & Filter Bar -->
    <div class="bg-white dark:bg-stone-900 rounded-2xl p-4 border border-stone-200/90 dark:border-stone-800 shadow-xs">
        <form method="GET" action="{{ route('admin.bookings') }}" class="flex flex-col md:flex-row gap-3 items-stretch md:items-center justify-between">
            <div class="flex-1 flex flex-col sm:flex-row gap-2.5">
                <div class="relative flex-1">
                    <i class="fa-solid fa-magnifying-glass absolute left-3.5 top-1/2 -translate-y-1/2 text-stone-400 text-xs"></i>
                    <input 
                        type="text" 
                        name="search" 
                        value="{{ request('search') }}" 
                        placeholder="Cari kode tiket, nama tamu, whatsapp, email..." 
                        class="w-full pl-9 pr-3 py-2 rounded-xl bg-stone-50 dark:bg-stone-800 border border-stone-200 dark:border-stone-700 text-xs focus:ring-1 focus:ring-stone-900 focus:outline-none"
                    >
                </div>
                <select name="status" onchange="this.form.submit()" class="px-3.5 py-2 rounded-xl bg-stone-50 dark:bg-stone-800 border border-stone-200 dark:border-stone-700 text-xs font-semibold focus:ring-1 focus:ring-stone-900 focus:outline-none">
                    <option value="all" {{ request('status') == 'all' ? 'selected' : '' }}>Semua Status Reservasi</option>
                    <option value="confirmed" {{ request('status') == 'confirmed' ? 'selected' : '' }}>Terkonfirmasi (Confirmed)</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Menunggu Bayar (Pending)</option>
                    <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Selesai Trip (Completed)</option>
                    <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Dibatalkan (Cancelled)</option>
                </select>
            </div>
            <div class="flex items-center gap-2">
                <button type="submit" class="px-5 py-2 rounded-xl bg-stone-900 text-white dark:bg-stone-100 dark:text-stone-900 text-xs font-semibold hover:opacity-90 transition-opacity">
                    Cari
                </button>
                @if(request('search') || request('status'))
                    <a href="{{ route('admin.bookings') }}" class="px-3 py-2 rounded-xl border border-stone-200 dark:border-stone-700 text-xs font-semibold text-stone-500 hover:text-stone-900 dark:hover:text-white transition-colors">
                        Reset
                    </a>
                @endif
            </div>
        </form>
    </div>

    <!-- Table Card -->
    <div class="bg-white dark:bg-stone-900 rounded-3xl border border-stone-200/90 dark:border-stone-800 shadow-xs overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="bg-stone-50 dark:bg-stone-800/60 text-stone-400 uppercase tracking-wider text-[10px] font-bold border-b border-stone-200 dark:border-stone-800">
                    <tr>
                        <th class="py-3.5 px-5">Kode Reservasi</th>
                        <th class="py-3.5 px-5">Nama Tamu & Kontak</th>
                        <th class="py-3.5 px-5">Destinasi / Paket</th>
                        <th class="py-3.5 px-5">Jadwal & Tamu</th>
                        <th class="py-3.5 px-5">Biaya Total</th>
                        <th class="py-3.5 px-5">Status Tiket</th>
                        <th class="py-3.5 px-5 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-stone-100 dark:divide-stone-800 text-stone-700 dark:text-stone-300">
                    @forelse($bookings as $booking)
                        <tr class="hover:bg-stone-50/70 dark:hover:bg-stone-800/40 transition-colors">
                            <td class="py-4 px-5">
                                <span class="font-mono font-bold text-stone-900 dark:text-white block">{{ $booking->booking_code }}</span>
                                <span class="text-[10px] text-stone-400">{{ $booking->created_at->format('d/m/Y H:i') }}</span>
                            </td>
                            <td class="py-4 px-5">
                                <p class="font-bold text-stone-900 dark:text-white">{{ $booking->customer_name }}</p>
                                <p class="text-[11px] text-stone-500 flex items-center gap-1 mt-0.5">
                                    <i class="fa-brands fa-whatsapp text-emerald-600"></i>
                                    <span>{{ $booking->customer_phone }}</span>
                                </p>
                                @if($booking->customer_email)
                                    <p class="text-[10px] text-stone-400 truncate">{{ $booking->customer_email }}</p>
                                @endif
                            </td>
                            <td class="py-4 px-5 max-w-xs">
                                <p class="font-semibold text-stone-900 dark:text-white truncate">{{ $booking->item_name }}</p>
                                @if($booking->addon_drone || $booking->addon_vip)
                                    <div class="flex gap-1 mt-1">
                                        @if($booking->addon_drone)
                                            <span class="px-1.5 py-0.5 rounded text-[9px] bg-stone-100 dark:bg-stone-800 text-stone-600 dark:text-stone-300">Drone</span>
                                        @endif
                                        @if($booking->addon_vip)
                                            <span class="px-1.5 py-0.5 rounded text-[9px] bg-amber-100 dark:bg-amber-950/60 text-amber-700 dark:text-amber-300">VIP</span>
                                        @endif
                                    </div>
                                @endif
                            </td>
                            <td class="py-4 px-5">
                                <p class="font-medium text-stone-900 dark:text-white">{{ $booking->travel_date->format('d M Y') }}</p>
                                <p class="text-[11px] text-stone-400">{{ $booking->pax }} Orang</p>
                            </td>
                            <td class="py-4 px-5 whitespace-nowrap">
                                <p class="font-bold text-stone-900 dark:text-white">{{ $booking->formatted_total_price }}</p>
                                @if($booking->discount_amount > 0)
                                    <span class="text-[10px] text-emerald-600 font-medium block">Hemat {{ $booking->formatted_discount }}</span>
                                @endif
                            </td>
                            <td class="py-4 px-5">
                                <form method="POST" action="{{ route('admin.bookings.updateStatus', $booking->id) }}">
                                    @csrf
                                    @method('PATCH')
                                    <select name="status" onchange="this.form.submit()" class="px-2.5 py-1 rounded-xl text-xs font-bold border border-stone-200 dark:border-stone-700 bg-white dark:bg-stone-800 cursor-pointer {{ $booking->status === 'confirmed' ? 'text-emerald-700 bg-emerald-50 dark:bg-emerald-950/50' : ($booking->status === 'pending' ? 'text-amber-700 bg-amber-50 dark:bg-amber-950/50' : ($booking->status === 'cancelled' ? 'text-rose-700 bg-rose-50 dark:bg-rose-950/50' : 'text-stone-600')) }}">
                                        <option value="confirmed" {{ $booking->status === 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                        <option value="pending" {{ $booking->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="completed" {{ $booking->status === 'completed' ? 'selected' : '' }}>Completed</option>
                                        <option value="cancelled" {{ $booking->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                    </select>
                                </form>
                            </td>
                            <td class="py-4 px-5 text-right whitespace-nowrap">
                                <div class="flex items-center justify-end gap-1.5">
                                    <a href="{{ route('bookings.receipt', $booking->booking_code) }}" target="_blank" class="px-3 py-1.5 rounded-lg bg-stone-100 hover:bg-stone-200 dark:bg-stone-800 dark:hover:bg-stone-700 text-stone-700 dark:text-stone-300 font-semibold text-xs transition-colors inline-flex items-center gap-1.5" title="Lihat E-Tiket Tamu">
                                        <i class="fa-solid fa-receipt text-[11px]"></i>
                                        <span>E-Tiket</span>
                                    </a>
                                    <form method="POST" action="{{ route('admin.bookings.destroy', $booking->id) }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus reservasi #{{ $booking->booking_code }}?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-1.5 rounded-lg text-stone-400 hover:text-rose-600 hover:bg-rose-50 dark:hover:bg-rose-950/40 text-xs transition-colors" title="Hapus Reservasi">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-12 text-center text-stone-400 text-xs">
                                <div class="w-12 h-12 rounded-full bg-stone-100 dark:bg-stone-800 flex items-center justify-center mx-auto mb-2 text-stone-400">
                                    <i class="fa-solid fa-calendar-xmark text-base"></i>
                                </div>
                                <p class="font-medium">Tidak ada reservasi yang sesuai dengan kriteria pencarian.</p>
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
