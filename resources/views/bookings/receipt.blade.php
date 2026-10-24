@extends('layouts.app')

@section('title', 'E-Tiket Reservasi #' . $booking->booking_code . ' — NusantaraWander')

@section('content')
<div class="pt-28 pb-24 max-w-3xl mx-auto px-4 sm:px-6">
    <!-- Top Action Nav -->
    <div class="flex items-center justify-between mb-6">
        <a href="{{ route('home') }}" class="text-xs font-semibold text-slate-500 hover:text-brand-600 flex items-center gap-1.5 transition-colors">
            <i class="fa-solid fa-arrow-left"></i>
            <span>Kembali ke Beranda</span>
        </a>
        <div class="flex items-center gap-2">
            <button onclick="window.print()" class="px-4 py-2 rounded-xl bg-slate-900 dark:bg-white text-white dark:text-slate-900 text-xs font-bold shadow hover:opacity-90 flex items-center gap-2 transition-all">
                <i class="fa-solid fa-print"></i>
                <span>Cetak E-Tiket</span>
            </button>
        </div>
    </div>

    <!-- Printable E-Ticket Container -->
    <div class="bg-white dark:bg-slate-900 rounded-3xl overflow-hidden shadow-2xl border border-slate-200 dark:border-slate-800 printable-card">
        <!-- Ticket Header Banner -->
        <div class="p-6 sm:p-8 bg-gradient-to-r from-brand-700 via-teal-700 to-emerald-800 text-white relative">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 rounded-2xl bg-white/20 backdrop-blur-md flex items-center justify-center text-white text-2xl shadow-inner">
                        <i class="fa-solid fa-compass"></i>
                    </div>
                    <div>
                        <h2 class="font-extrabold text-xl tracking-tight">Nusantara<span class="text-amber-300">Wander</span></h2>
                        <p class="text-xs text-emerald-200 uppercase tracking-widest font-semibold">Digital Travel Boarding Pass</p>
                    </div>
                </div>

                <div class="sm:text-right">
                    <span class="inline-block px-3 py-1 rounded-full bg-emerald-400 text-slate-950 text-xs font-extrabold uppercase tracking-wider mb-1">
                        {{ strtoupper($booking->status) }}
                    </span>
                    <p class="font-mono text-sm tracking-wider font-bold text-emerald-100">Kode: {{ $booking->booking_code }}</p>
                </div>
            </div>
        </div>

        <!-- Ticket Body -->
        <div class="p-6 sm:p-8 space-y-6">
            <!-- Destinasi & Tanggal Hero Strip -->
            <div class="p-5 rounded-2xl bg-slate-50 dark:bg-slate-800/80 border border-slate-200/80 dark:border-slate-700/80 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div>
                    <span class="text-xs uppercase tracking-wider text-slate-400 font-bold">Paket / Destinasi Pilihan</span>
                    <h3 class="font-serif text-xl sm:text-2xl font-bold text-slate-900 dark:text-white mt-1">
                        {{ $booking->item_name }}
                    </h3>
                </div>
                <div class="sm:text-right">
                    <span class="text-xs uppercase tracking-wider text-slate-400 font-bold">Jadwal Keberangkatan</span>
                    <p class="text-sm sm:text-base font-bold text-brand-600 dark:text-brand-400 mt-1 flex items-center sm:justify-end gap-1.5">
                        <i class="fa-regular fa-calendar-check"></i>
                        {{ $booking->travel_date->isoFormat('dddd, D MMMM Y') }}
                    </p>
                </div>
            </div>

            <!-- Traveler Details Grid -->
            <div>
                <h4 class="text-xs font-bold uppercase tracking-wider text-slate-400 mb-3">Informasi Pelanggan</h4>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 text-sm">
                    <div class="p-3.5 rounded-xl bg-slate-50 dark:bg-slate-800/50">
                        <span class="text-xs text-slate-400 block">Nama Lengkap</span>
                        <span class="font-bold text-slate-800 dark:text-white mt-0.5 block">{{ $booking->customer_name }}</span>
                    </div>
                    <div class="p-3.5 rounded-xl bg-slate-50 dark:bg-slate-800/50">
                        <span class="text-xs text-slate-400 block">Nomor WhatsApp</span>
                        <span class="font-bold text-slate-800 dark:text-white mt-0.5 block">{{ $booking->customer_phone }}</span>
                    </div>
                    <div class="p-3.5 rounded-xl bg-slate-50 dark:bg-slate-800/50">
                        <span class="text-xs text-slate-400 block">Jumlah Peserta</span>
                        <span class="font-bold text-slate-800 dark:text-white mt-0.5 block">{{ $booking->pax }} Orang</span>
                    </div>
                </div>
            </div>

            <!-- Layanan Tambahan -->
            <div>
                <h4 class="text-xs font-bold uppercase tracking-wider text-slate-400 mb-3">Rincian Layanan & Add-Ons</h4>
                <div class="space-y-2 text-xs sm:text-sm">
                    <div class="flex justify-between py-2 border-b border-slate-100 dark:border-slate-800">
                        <span class="text-slate-600 dark:text-slate-300">Tiket Masuk & Layanan Pemandu Lokal ({{ $booking->pax }} Pax)</span>
                        <span class="font-semibold text-slate-800 dark:text-white">Termasuk</span>
                    </div>
                    <div class="flex justify-between py-2 border-b border-slate-100 dark:border-slate-800">
                        <span class="text-slate-600 dark:text-slate-300">Dokumentasi Drone & Kamera</span>
                        <span class="font-semibold {{ $booking->addon_drone ? 'text-brand-600' : 'text-slate-400' }}">
                            {{ $booking->addon_drone ? 'Aktif (+Rp 450.000)' : 'Tidak Dipilih' }}
                        </span>
                    </div>
                    <div class="flex justify-between py-2 border-b border-slate-100 dark:border-slate-800">
                        <span class="text-slate-600 dark:text-slate-300">Upgrade Hotel Bintang 5</span>
                        <span class="font-semibold {{ $booking->addon_vip ? 'text-brand-600' : 'text-slate-400' }}">
                            {{ $booking->addon_vip ? 'Aktif (+Rp 650.000/org)' : 'Standar Resort' }}
                        </span>
                    </div>
                    @if($booking->promo_code)
                        <div class="flex justify-between py-2 border-b border-slate-100 dark:border-slate-800 text-emerald-600 dark:text-emerald-400 font-semibold">
                            <span>Voucher Diskon ({{ $booking->promo_code }})</span>
                            <span>-{{ $booking->formatted_discount }}</span>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Total Payment Summary -->
            <div class="p-5 rounded-2xl bg-brand-50/70 dark:bg-slate-800 border border-brand-200 dark:border-slate-700 flex items-center justify-between">
                <div>
                    <span class="text-xs uppercase tracking-wider text-slate-500 dark:text-slate-400 font-bold">Total Biaya Reservasi</span>
                    <p class="text-xs text-slate-400">Pajak pemerintah & asuransi telah termasuk</p>
                </div>
                <div class="text-right">
                    <span class="font-serif text-2xl sm:text-3xl font-extrabold text-brand-700 dark:text-brand-400">
                        {{ $booking->formatted_total_price }}
                    </span>
                </div>
            </div>

            <!-- Notes & Instructions -->
            <div class="pt-2 text-xs text-slate-500 space-y-1.5 border-t border-slate-100 dark:border-slate-800">
                <p><strong>Catatan Penting:</strong></p>
                <p>1. Tunjukkan e-tiket digital atau salinan cetak ini kepada tim pemandu saat penjemputan di bandara/titik kumpul.</p>
                <p>2. Konfirmasi jadwal penjemputan detail akan dikirimkan via WhatsApp 24 jam sebelum tanggal keberangkatan.</p>
                <p>3. Untuk bantuan darurat selama perjalanan, hubungi Concierge NusantaraWander di WhatsApp 0811-9988-7766.</p>
            </div>
        </div>

        <!-- Ticket Footer Barcode Simulation -->
        <div class="px-6 py-4 bg-slate-100 dark:bg-slate-950 border-t border-slate-200 dark:border-slate-800 flex flex-col sm:flex-row items-center justify-between text-xs text-slate-400 gap-2">
            <span class="font-mono">VERIFIED BY NUSANTARAWANDER SYSTEM • {{ now()->format('d/m/Y H:i') }}</span>
            <div class="flex items-center gap-1 font-mono tracking-widest text-slate-700 dark:text-slate-300 font-bold">
                ||| | |||| | ||| || |||||| | ||
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    @media print {
        header, footer, nav, button, a {
            display: none !important;
        }
        body {
            background: white !important;
            color: black !important;
        }
        .printable-card {
            border: 1px solid #ccc !important;
            box-shadow: none !important;
        }
    }
</style>
@endpush
