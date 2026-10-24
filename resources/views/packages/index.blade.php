@extends('layouts.app')

@section('title', 'Koleksi Paket Wisata Nusantara — NusantaraWander')
@section('meta_description', 'Paket perjalanan terkurasi ke Labuan Bajo, Bromo, Ijen, dan Bali bersama pemandu warga lokal.')

@section('content')
<div class="pt-28 pb-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center max-w-2xl mx-auto mb-14">
        <span class="text-xs font-semibold text-stone-500 uppercase tracking-wider block mb-1">
            Boutique Itinerary
        </span>
        <h1 class="font-serif text-3xl sm:text-5xl font-normal text-stone-950 dark:text-white">
            Koleksi Paket Perjalanan Terkurasi
        </h1>
        <p class="mt-2.5 text-stone-600 dark:text-stone-400 text-xs sm:text-sm leading-relaxed">
            Menikmati keindahan alam nusantara tanpa repot. Kami mengatur transportasi privat, kabin kapal/villa terbaik, dan perizinan resmi.
        </p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        @foreach($packages as $idx => $pkg)
            <div class="bg-white dark:bg-stone-900 rounded-3xl border {{ $idx === 0 ? 'border-stone-900 dark:border-stone-200 ring-1 ring-stone-900/10' : 'border-stone-200 dark:border-stone-800' }} p-7 shadow-xs flex flex-col justify-between">
                <div>
                    <div class="flex items-center justify-between gap-2 mb-4">
                        <span class="px-2.5 py-0.5 rounded-full {{ $idx === 0 ? 'bg-stone-900 text-white dark:bg-white dark:text-stone-900' : 'bg-stone-100 dark:bg-stone-800 text-stone-700 dark:text-stone-300' }} text-[11px] font-semibold tracking-wide">
                            {{ $pkg->badge }}
                        </span>
                        <span class="text-xs text-stone-500">
                            <i class="fa-regular fa-clock mr-1"></i> {{ $pkg->duration }}
                        </span>
                    </div>

                    <h3 class="font-serif text-xl font-semibold text-stone-900 dark:text-white leading-snug">
                        <a href="{{ route('packages.show', $pkg->slug) }}" class="hover:underline">{{ $pkg->name }}</a>
                    </h3>
                    <p class="mt-1.5 text-xs text-stone-500 dark:text-stone-400 flex items-center gap-1.5">
                        <i class="fa-solid fa-bed text-[11px]"></i> {{ $pkg->hotel }}
                    </p>

                    <div class="my-6 p-4 rounded-2xl bg-stone-50 dark:bg-stone-800/60 border border-stone-200/60 dark:border-stone-700/60">
                        @if($pkg->formatted_original_price)
                            <span class="text-xs text-stone-400 line-through block">{{ $pkg->formatted_original_price }}</span>
                        @endif
                        <div class="flex items-baseline gap-1 mt-0.5">
                            <span class="font-serif text-2xl sm:text-3xl font-bold text-stone-950 dark:text-white">{{ $pkg->formatted_price }}</span>
                            <span class="text-xs text-stone-400">/ tamu</span>
                        </div>
                    </div>

                    <span class="text-[11px] font-bold uppercase tracking-wider text-stone-400 block mb-2.5">Sudah Termasuk:</span>
                    <ul class="space-y-2 text-xs text-stone-600 dark:text-stone-300 mb-8">
                        @foreach($pkg->facilities ?? [] as $f)
                            <li class="flex items-start gap-2">
                                <i class="fa-solid fa-check text-stone-900 dark:text-stone-100 mt-0.5 shrink-0 text-xs"></i>
                                <span class="leading-relaxed">{{ $f }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="space-y-2">
                    <button onclick="openBookingModal('{{ addslashes($pkg->name) }}')" class="w-full py-3 px-5 rounded-full {{ $idx === 0 ? 'bg-stone-900 text-white dark:bg-stone-100 dark:text-stone-900' : 'border border-stone-300 dark:border-stone-700 hover:bg-stone-100 text-stone-800 dark:text-stone-200' }} font-semibold text-xs tracking-wide transition-all flex items-center justify-center gap-1.5">
                        <span>Pilih Paket Ini</span>
                        <i class="fa-solid fa-arrow-right text-[10px]"></i>
                    </button>
                    <a href="{{ route('packages.show', $pkg->slug) }}" class="block text-center text-xs text-stone-500 hover:text-stone-900 py-1">
                        Lihat Itinerary Lengkap
                    </a>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
