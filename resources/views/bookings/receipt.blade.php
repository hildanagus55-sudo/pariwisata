@extends('layouts.app')

@section('title', 'DANWISATA | E-Tiket Reservasi #' . $booking->booking_code)

@section('content')
<div class="pt-28 pb-24 max-w-2xl mx-auto px-4 sm:px-6">
    <!-- Top Action Nav -->
    <div class="flex items-center justify-between mb-6">
        <a href="{{ route('home') }}" class="text-xs font-medium text-stone-500 hover:text-stone-900 flex items-center gap-1.5 transition-colors">
            <i class="fa-solid fa-arrow-left"></i>
            <span>Kembali ke Beranda</span>
        </a>
        <button onclick="window.print()" class="px-4 py-2 rounded-full bg-stone-900 text-white dark:bg-stone-100 dark:text-stone-900 text-xs font-semibold shadow-xs hover:opacity-90 flex items-center gap-1.5 transition-all">
            <i class="fa-solid fa-print"></i>
            <span>Cetak Dokumen</span>
        </button>
    </div>

    <!-- Clean Printable Card -->
    <div class="bg-white dark:bg-stone-900 rounded-3xl overflow-hidden shadow-sm border border-stone-200 dark:border-stone-800 printable-card">
        <!-- Header -->
        <div class="p-6 sm:p-8 bg-stone-900 text-white relative flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div class="flex items-center gap-3">
                <img src="{{ asset('images/logo.png') }}" alt="DANWISATA" class="h-9 w-auto object-contain bg-white rounded-xl px-2.5 py-1 shadow-xs">
            </div>

            <div class="sm:text-right">
                <span class="inline-block px-2.5 py-0.5 rounded-full bg-stone-800 text-stone-200 text-[10px] font-mono tracking-wider mb-1">
                    {{ strtoupper($booking->status) }}
                </span>
                <p class="font-mono text-xs text-stone-300">Kode: {{ $booking->booking_code }}</p>
            </div>
        </div>

        <!-- Body -->
        <div class="p-6 sm:p-8 space-y-6 text-xs">
            <!-- Destinasi & Tanggal Strip -->
            <div class="p-4 rounded-2xl bg-stone-50 dark:bg-stone-800/60 border border-stone-200/70 dark:border-stone-700/70 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                <div>
                    <span class="text-[10px] uppercase tracking-wider text-stone-400 font-semibold">Tujuan / Paket Perjalanan</span>
                    <h3 class="font-serif text-lg font-semibold text-stone-950 dark:text-white mt-0.5">
                        {{ $booking->item_name }}
                    </h3>
                </div>
                <div class="sm:text-right">
                    <span class="text-[10px] uppercase tracking-wider text-stone-400 font-semibold">Jadwal Keberangkatan</span>
                    <p class="font-medium text-stone-800 dark:text-stone-200 mt-0.5">
                        {{ $booking->travel_date->isoFormat('dddd, D MMMM Y') }}
                    </p>
                </div>
            </div>

            <!-- Customer Details -->
            <div>
                <span class="text-[10px] font-bold uppercase tracking-wider text-stone-400 block mb-2">Informasi Tamu</span>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                    <div class="p-3 rounded-xl bg-stone-50 dark:bg-stone-800/40">
                        <span class="text-[10px] text-stone-400 block">Nama Tamu</span>
                        <span class="font-semibold text-stone-800 dark:text-white block mt-0.5">{{ $booking->customer_name }}</span>
                    </div>
                    <div class="p-3 rounded-xl bg-stone-50 dark:bg-stone-800/40">
                        <span class="text-[10px] text-stone-400 block">WhatsApp</span>
                        <span class="font-semibold text-stone-800 dark:text-white block mt-0.5">{{ $booking->customer_phone }}</span>
                    </div>
                    <div class="p-3 rounded-xl bg-stone-50 dark:bg-stone-800/40">
                        <span class="text-[10px] text-stone-400 block">Jumlah Tamu</span>
                        <span class="font-semibold text-stone-800 dark:text-white block mt-0.5">{{ $booking->pax }} Orang</span>
                    </div>
                </div>
            </div>

            <!-- Add-ons -->
            <div>
                <span class="text-[10px] font-bold uppercase tracking-wider text-stone-400 block mb-2">Rincian Layanan</span>
                <div class="space-y-1.5 border-t border-stone-100 dark:border-stone-800 pt-2 text-stone-600 dark:text-stone-400">
                    <div class="flex justify-between py-1 border-b border-stone-100 dark:border-stone-800">
                        <span>Tiket & Pemandu Lokal ({{ $booking->pax }} Tamu)</span>
                        <span class="font-medium text-stone-900 dark:text-white">Termasuk</span>
                    </div>
                    <div class="flex justify-between py-1 border-b border-stone-100 dark:border-stone-800">
                        <span>Dokumentasi Drone & Foto</span>
                        <span class="font-medium text-stone-900 dark:text-white">{{ $booking->addon_drone ? 'Ya (+Rp 450.000)' : 'Tidak' }}</span>
                    </div>
                    <div class="flex justify-between py-1 border-b border-stone-100 dark:border-stone-800">
                        <span>Upgrade Private Villa</span>
                        <span class="font-medium text-stone-900 dark:text-white">{{ $booking->addon_vip ? 'Ya (+Rp 650.000/org)' : 'Standar' }}</span>
                    </div>
                    @if($booking->promo_code)
                        <div class="flex justify-between py-1 text-emerald-600 font-medium">
                            <span>Voucher Diskon ({{ $booking->promo_code }})</span>
                            <span>-{{ $booking->formatted_discount }}</span>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Total Price -->
            <div class="p-4 rounded-2xl bg-stone-50 dark:bg-stone-800/80 border border-stone-200/70 dark:border-stone-700 flex items-center justify-between">
                <div>
                    <span class="text-[10px] uppercase tracking-wider text-stone-400 font-semibold block">Total Biaya Perjalanan</span>
                    <span class="text-[11px] text-stone-400">Termasuk pajak & asuransi</span>
                </div>
                <span class="font-serif text-2xl font-bold text-stone-950 dark:text-white">
                    {{ $booking->formatted_total_price }}
                </span>
            </div>

            <!-- Notes -->
            <div class="pt-3 text-[11px] text-stone-400 space-y-1 border-t border-stone-100 dark:border-stone-800 leading-relaxed">
                <p>• Pemandu lokal kami akan menghubungi nomor WhatsApp Anda 24 jam sebelum jadwal keberangkatan untuk koordinasi penjemputan.</p>
                <p>• Bantuan pertanyaan atau penyesuaian jadwal: WhatsApp Concierge +62 895-1980-8548.</p>
            </div>
        </div>

        <!-- Footer -->
        <div class="px-6 py-3.5 bg-stone-50 dark:bg-stone-950 border-t border-stone-200 dark:border-stone-800 flex items-center justify-between text-[11px] text-stone-400">
            <span class="font-mono">DANWISATA CONFIRMED • {{ now()->format('d/m/Y') }}</span>
            <span class="font-mono tracking-widest text-stone-600 dark:text-stone-300">||| |||| | || ||||| |</span>
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
