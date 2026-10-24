@extends('layouts.app')

@section('title', 'Daftar Paket Wisata All-Inclusive — NusantaraWander')
@section('meta_description', 'Pilihan paket liburan komprehensif ke Labuan Bajo, Bromo Ijen, dan Bali dengan akomodasi hotel berbintang dan dokumentasi drone.')

@section('content')
<div class="pt-28 pb-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center max-w-2xl mx-auto mb-14">
        <span class="inline-block px-3.5 py-1 rounded-full bg-amber-100 dark:bg-amber-900/40 text-amber-700 dark:text-amber-300 text-xs font-bold uppercase tracking-wider mb-3">
            Paket Eksklusif
        </span>
        <h1 class="font-serif text-3xl sm:text-5xl font-bold text-slate-900 dark:text-white">
            Paket Wisata All-Inclusive
        </h1>
        <p class="mt-3 text-slate-600 dark:text-slate-400 text-sm sm:text-base">
            Nikmati liburan bebas repot. Seluruh akomodasi hotel berbintang, transportasi lokal, tiket masuk wisata, hingga dokumentasi drone sudah termasuk.
        </p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        @foreach($packages as $idx => $pkg)
            <div class="relative rounded-3xl bg-white dark:bg-slate-900 border {{ $idx === 0 ? 'border-brand-500 ring-2 ring-brand-500/20' : 'border-slate-200 dark:border-slate-800' }} p-7 shadow-lg flex flex-col justify-between">
                <div>
                    <div class="flex items-center justify-between gap-2 mb-4">
                        <span class="px-3 py-1 rounded-full {{ $idx === 0 ? 'bg-brand-600 text-white' : 'bg-amber-100 dark:bg-amber-900/40 text-amber-800 dark:text-amber-300' }} text-xs font-bold uppercase tracking-wider">
                            {{ $pkg->badge }}
                        </span>
                        <span class="text-xs font-semibold text-slate-500 dark:text-slate-400">
                            <i class="fa-regular fa-clock mr-1 text-brand-600"></i> {{ $pkg->duration }}
                        </span>
                    </div>

                    <h3 class="font-serif text-xl font-bold text-slate-900 dark:text-white leading-snug">
                        <a href="{{ route('packages.show', $pkg->slug) }}" class="hover:text-brand-600 transition-colors">{{ $pkg->name }}</a>
                    </h3>
                    <p class="mt-2 text-xs font-semibold text-brand-600 dark:text-brand-400 flex items-center gap-1.5">
                        <i class="fa-solid fa-hotel"></i> {{ $pkg->hotel }}
                    </p>

                    <div class="my-6 p-4 rounded-2xl bg-slate-50 dark:bg-slate-800/60 border border-slate-100 dark:border-slate-800">
                        @if($pkg->formatted_original_price)
                            <p class="text-xs text-slate-400 line-through">{{ $pkg->formatted_original_price }}</p>
                        @endif
                        <div class="flex items-baseline gap-1 mt-0.5">
                            <span class="text-2xl sm:text-3xl font-extrabold text-slate-900 dark:text-white">{{ $pkg->formatted_price }}</span>
                            <span class="text-xs text-slate-500">/ peserta</span>
                        </div>
                    </div>

                    <p class="text-xs font-bold uppercase tracking-wider text-slate-400 mb-3">Fasilitas Termasuk:</p>
                    <ul class="space-y-2.5 text-xs sm:text-sm text-slate-600 dark:text-slate-300 mb-8">
                        @foreach($pkg->facilities ?? [] as $f)
                            <li class="flex items-start gap-2.5">
                                <i class="fa-solid fa-circle-check text-brand-500 mt-1 shrink-0"></i>
                                <span>{{ $f }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="space-y-2.5">
                    <button onclick="openBookingModal('{{ addslashes($pkg->name) }}')" class="w-full py-3.5 px-5 rounded-xl {{ $idx === 0 ? 'bg-gradient-to-r from-brand-600 to-teal-600 text-white shadow-lg shadow-brand-600/25' : 'bg-slate-900 dark:bg-white text-white dark:text-slate-900' }} hover:opacity-95 font-bold text-sm transition-all flex items-center justify-center gap-2">
                        <span>Pilih Paket Wisata Ini</span>
                        <i class="fa-solid fa-arrow-right text-xs"></i>
                    </button>
                    <a href="{{ route('packages.show', $pkg->slug) }}" class="block text-center text-xs font-semibold text-brand-600 hover:underline">
                        Lihat Rincian Paket & Jadwal
                    </a>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
