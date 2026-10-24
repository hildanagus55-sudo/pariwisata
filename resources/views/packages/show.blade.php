@extends('layouts.app')

@section('title', $package->name . ' — Paket Terkurasi | ANWISATA')
@section('meta_description', 'Rincian paket perjalanan ' . $package->name . ' durasi ' . $package->duration . ' bersama pemandu lokal ANWISATA.')

@section('content')
    <div class="pt-28 pb-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Navigation & Breadcrumb -->
        <div class="flex flex-wrap items-center justify-between gap-4 mb-6">
            <a href="{{ route('packages.index') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-full border border-stone-200 dark:border-stone-800 bg-white dark:bg-stone-900 text-xs font-semibold text-stone-700 dark:text-stone-300 hover:bg-stone-100 dark:hover:bg-stone-800 hover:text-stone-950 dark:hover:text-white transition-all shadow-xs group">
                <i class="fa-solid fa-arrow-left text-[11px] group-hover:-translate-x-0.5 transition-transform"></i>
                <span>Kembali ke Seluruh Paket</span>
            </a>

            <!-- Breadcrumb -->
            <nav class="flex items-center gap-2 text-xs text-stone-500">
                <a href="{{ route('home') }}" class="hover:text-stone-900 dark:hover:text-stone-200 transition-colors">Beranda</a>
                <span class="text-stone-300 dark:text-stone-700">/</span>
                <a href="{{ route('packages.index') }}" class="hover:text-stone-900 dark:hover:text-stone-200 transition-colors">Paket Wisata</a>
                <span class="text-stone-300 dark:text-stone-700">/</span>
                <span class="text-stone-900 dark:text-stone-100 font-medium truncate max-w-[180px] sm:max-w-xs">{{ $package->name }}</span>
            </nav>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
            <!-- Package Content -->
            <div class="lg:col-span-8 space-y-8">
                <div class="bg-white dark:bg-stone-900 rounded-3xl p-6 sm:p-9 border border-stone-200/90 dark:border-stone-800 shadow-xs">
                    <div class="flex items-center gap-2.5 mb-3">
                        <span class="px-2.5 py-0.5 rounded-full bg-stone-100 dark:bg-stone-800 text-stone-800 dark:text-stone-200 text-xs font-medium">
                            {{ $package->badge }}
                        </span>
                        <span class="text-xs text-stone-500">
                            <i class="fa-regular fa-clock mr-1"></i> {{ $package->duration }}
                        </span>
                    </div>

                    <h1 class="font-serif text-3xl sm:text-4xl font-normal text-stone-950 dark:text-white leading-tight">
                        {{ $package->name }}
                    </h1>

                    <p class="mt-2 text-xs text-stone-500 flex items-center gap-1.5">
                        <i class="fa-solid fa-bed text-stone-400"></i>
                        <span>Akomodasi: {{ $package->hotel }}</span>
                    </p>

                    <!-- Price Card -->
                    <div class="my-8 p-6 rounded-2xl bg-stone-50 dark:bg-stone-800/60 border border-stone-200/70 dark:border-stone-700/60 flex flex-wrap items-center justify-between gap-4">
                        <div>
                            @if($package->formatted_original_price)
                                <span class="text-xs text-stone-400 line-through block">{{ $package->formatted_original_price }}</span>
                            @endif
                            <div class="flex items-baseline gap-1 mt-0.5">
                                <span class="font-serif text-3xl sm:text-4xl font-bold text-stone-950 dark:text-white">{{ $package->formatted_price }}</span>
                                <span class="text-xs text-stone-400">/ tamu (All-Inclusive)</span>
                            </div>
                        </div>
                        <button onclick="openBookingModal('{{ addslashes($package->name) }}')" class="px-6 py-2.5 rounded-full bg-stone-900 text-white dark:bg-stone-100 dark:text-stone-900 text-xs font-semibold shadow-sm hover:opacity-90 transition-all">
                            Rencanakan Perjalanan
                        </button>
                    </div>

                    <!-- Facilities -->
                    <div>
                        <h3 class="font-serif text-xl font-normal text-stone-900 dark:text-white mb-4">
                            Fasilitas yang Disiapkan
                        </h3>
                        <ul class="space-y-2.5 text-xs sm:text-sm text-stone-600 dark:text-stone-300">
                            @foreach($package->facilities ?? [] as $facility)
                                <li class="flex items-start gap-2.5 p-3 rounded-xl bg-stone-50 dark:bg-stone-800/70 border border-stone-200/50 dark:border-stone-700/50">
                                    <i class="fa-solid fa-check text-stone-900 dark:text-stone-100 mt-0.5 shrink-0 text-xs"></i>
                                    <span class="leading-relaxed">{{ $facility }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Right Sidebar -->
            <div class="lg:col-span-4 space-y-6">
                <div class="bg-white dark:bg-stone-900 rounded-3xl p-6 sm:p-7 border border-stone-200/90 dark:border-stone-800 shadow-xs space-y-4">
                    <h3 class="font-serif text-lg font-medium text-stone-900 dark:text-white">
                        Mulai Diskusi Rute
                    </h3>
                    <p class="text-xs text-stone-500 leading-relaxed">
                        Anda bisa menyesuaikan tanggal dan preferensi khusus bersama konsultan perjalanan kami.
                    </p>
                    <button onclick="openBookingModal('{{ addslashes($package->name) }}')" class="w-full py-3 px-5 rounded-full bg-stone-900 text-white dark:bg-stone-100 dark:text-stone-900 text-xs font-semibold shadow-sm hover:opacity-90 transition-all">
                        Isi Rencana Perjalanan
                    </button>
                    <a href="https://wa.me/6289519808548?text=Halo%20ANWISATA,%20saya%20tertarik%20dengan%20{{ urlencode($package->name) }}" target="_blank" class="w-full py-2.5 px-5 rounded-full border border-stone-300 dark:border-stone-700 text-stone-700 dark:text-stone-200 text-xs font-medium transition-colors flex items-center justify-center gap-2">
                        <i class="fa-brands fa-whatsapp text-emerald-600"></i>
                        <span>Diskusi via WhatsApp</span>
                    </a>
                </div>

                @if($otherPackages->count())
                    <div class="bg-white dark:bg-stone-900 rounded-3xl p-6 border border-stone-200/90 dark:border-stone-800 shadow-xs">
                        <h4 class="font-serif text-sm font-semibold text-stone-900 dark:text-white mb-3">
                            Paket Lain yang Mungkin Anda Suka
                        </h4>
                        <div class="space-y-3">
                            @foreach($otherPackages as $other)
                                <a href="{{ route('packages.show', $other->slug) }}" class="block p-3 rounded-xl border border-stone-100 dark:border-stone-800 hover:bg-stone-50 dark:hover:bg-stone-800/60 transition-colors">
                                    <span class="text-[10px] text-stone-400 block">{{ $other->duration }}</span>
                                    <p class="font-medium text-xs text-stone-900 dark:text-white mt-0.5 line-clamp-1">{{ $other->name }}</p>
                                    <p class="text-xs font-bold text-stone-800 dark:text-stone-200 mt-1">{{ $other->formatted_price }}</p>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <!-- Bottom Back & Action Bar -->
        <div class="mt-14 pt-8 border-t border-stone-200 dark:border-stone-800 flex flex-wrap items-center justify-between gap-4">
            <a href="{{ route('packages.index') }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-full border border-stone-300 dark:border-stone-700 hover:bg-stone-100 dark:hover:bg-stone-800 text-stone-800 dark:text-stone-200 text-xs font-semibold transition-all">
                <i class="fa-solid fa-arrow-left text-[10px]"></i>
                <span>Kembali ke Seluruh Paket</span>
            </a>
            <button onclick="openBookingModal('{{ addslashes($package->name) }}')" class="px-6 py-2.5 rounded-full bg-stone-900 text-white dark:bg-stone-100 dark:text-stone-900 text-xs font-semibold shadow-sm hover:opacity-90 transition-all flex items-center gap-1.5">
                <span>Rencanakan Perjalanan Ini</span>
                <i class="fa-solid fa-arrow-right text-[10px]"></i>
            </button>
        </div>
    </div>
@endsection
