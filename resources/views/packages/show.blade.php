@extends('layouts.app')

@section('title', $package->name . ' — Paket Wisata NusantaraWander')
@section('meta_description', 'Pesan ' . $package->name . ' durasi ' . $package->duration . ' dengan akomodasi ' . $package->hotel . '. Fasilitas all-inclusive dan garansi kepuasan 100%.')

@section('content')
    <div class="pt-24 pb-20">
        <!-- Breadcrumb -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <nav class="flex items-center gap-2 text-xs text-slate-500 dark:text-slate-400">
                <a href="{{ route('home') }}" class="hover:text-brand-600 transition-colors">Beranda</a>
                <i class="fa-solid fa-chevron-right text-[10px]"></i>
                <a href="{{ route('home') }}#paket" class="hover:text-brand-600 transition-colors">Paket Wisata</a>
                <i class="fa-solid fa-chevron-right text-[10px]"></i>
                <span class="text-slate-800 dark:text-slate-200 font-semibold truncate">{{ $package->name }}</span>
            </nav>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
                <!-- Package Detail Content -->
                <div class="lg:col-span-8 space-y-8">
                    <div class="bg-white dark:bg-slate-900 rounded-3xl p-6 sm:p-10 border border-slate-200/80 dark:border-slate-800 shadow-sm">
                        <div class="flex items-center gap-3 mb-4">
                            <span class="px-3.5 py-1 rounded-full bg-brand-600 text-white text-xs font-bold uppercase tracking-wider">
                                {{ $package->badge }}
                            </span>
                            <span class="text-xs font-semibold text-slate-500 dark:text-slate-400 flex items-center gap-1.5">
                                <i class="fa-regular fa-clock text-brand-600"></i> {{ $package->duration }}
                            </span>
                        </div>

                        <h1 class="font-serif text-3xl sm:text-4xl font-bold text-slate-900 dark:text-white leading-tight">
                            {{ $package->name }}
                        </h1>

                        <div class="mt-4 flex items-center gap-2 text-sm font-semibold text-brand-600 dark:text-brand-400">
                            <i class="fa-solid fa-hotel"></i>
                            <span>Akomodasi: {{ $package->hotel }}</span>
                        </div>

                        <!-- Price Tag -->
                        <div class="my-8 p-6 rounded-2xl bg-slate-50 dark:bg-slate-800/60 border border-slate-200/60 dark:border-slate-700/60 flex flex-wrap items-center justify-between gap-4">
                            <div>
                                @if($package->formatted_original_price)
                                    <p class="text-xs text-slate-400 line-through">{{ $package->formatted_original_price }}</p>
                                @endif
                                <div class="flex items-baseline gap-2 mt-1">
                                    <span class="font-serif text-3xl sm:text-4xl font-extrabold text-slate-900 dark:text-white">{{ $package->formatted_price }}</span>
                                    <span class="text-xs text-slate-500">/ orang (All-Inclusive)</span>
                                </div>
                            </div>
                            <button onclick="openBookingModal('{{ addslashes($package->name) }}')" class="px-7 py-3 rounded-xl bg-gradient-to-r from-brand-600 to-teal-600 text-white font-bold text-sm shadow-md hover:shadow-lg transition-all flex items-center gap-2">
                                <i class="fa-solid fa-calendar-check"></i>
                                <span>Pesan Sekarang</span>
                            </button>
                        </div>

                        <!-- Inclusions List -->
                        <div class="pt-2">
                            <h3 class="font-serif text-xl font-bold text-slate-900 dark:text-white mb-4">
                                Fasilitas & Layanan Termasuk
                            </h3>
                            <ul class="grid grid-cols-1 sm:grid-cols-2 gap-3 text-sm text-slate-600 dark:text-slate-300">
                                @foreach($package->facilities ?? [] as $facility)
                                    <li class="flex items-start gap-3 p-3 rounded-xl bg-slate-50 dark:bg-slate-800/80 border border-slate-200/40 dark:border-slate-800">
                                        <i class="fa-solid fa-circle-check text-brand-500 mt-1 shrink-0"></i>
                                        <span class="leading-relaxed">{{ $facility }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <!-- Travel Security Guarantee -->
                        <div class="mt-10 p-6 rounded-2xl bg-brand-50/60 dark:bg-brand-900/20 border border-brand-200/50 dark:border-brand-800/40 flex items-start gap-4">
                            <div class="w-12 h-12 rounded-xl bg-brand-600 text-white flex items-center justify-center text-xl shrink-0">
                                <i class="fa-solid fa-shield-halved"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-slate-900 dark:text-white text-base">Jaminan Wisata Aman & Bebas Cemas</h4>
                                <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-400 mt-1 leading-relaxed">
                                    Paket ini mencakup asuransi perjalanan komprehensif, pemandu bersertifikat, dan opsi reschedule gratis apabila terjadi cuaca buruk atau force majeure.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Sidebar Booking & Other Packages -->
                <div class="lg:col-span-4 space-y-6">
                    <div class="bg-white dark:bg-slate-900 rounded-3xl p-6 sm:p-7 border border-slate-200/80 dark:border-slate-800 shadow-xl space-y-5">
                        <h3 class="font-serif text-xl font-bold text-slate-900 dark:text-white">
                            Siap Memulai Liburan?
                        </h3>
                        <p class="text-xs text-slate-500 leading-relaxed">
                            Pesan sekarang dan amankan slot kabin/kamar favorit Anda. Tersedia diskon tambahan 15% dengan kode promo <strong>PESONAID</strong>.
                        </p>
                        <button onclick="openBookingModal('{{ addslashes($package->name) }}')" class="w-full py-3.5 px-6 rounded-xl bg-brand-600 hover:bg-brand-700 text-white font-bold text-sm shadow-md transition-colors flex items-center justify-center gap-2">
                            <i class="fa-solid fa-paper-plane"></i>
                            <span>Buka Formulir Reservasi</span>
                        </button>
                        <a href="https://wa.me/6281199887766?text=Halo%20NusantaraWander,%20saya%20tertarik%20dengan%20{{ urlencode($package->name) }}" target="_blank" class="w-full py-2.5 px-6 rounded-xl border border-slate-200 dark:border-slate-700 hover:bg-slate-50 dark:hover:bg-slate-800 text-slate-700 dark:text-slate-300 font-semibold text-xs transition-colors flex items-center justify-center gap-2">
                            <i class="fa-brands fa-whatsapp text-emerald-500"></i>
                            <span>Tanya Concierge 24/7</span>
                        </a>
                    </div>

                    @if($otherPackages->count())
                        <div class="bg-white dark:bg-slate-900 rounded-3xl p-6 border border-slate-200 dark:border-slate-800 shadow-sm">
                            <h4 class="font-serif text-lg font-bold text-slate-900 dark:text-white mb-4">
                                Paket Wisata Terkait
                            </h4>
                            <div class="space-y-4">
                                @foreach($otherPackages as $other)
                                    <a href="{{ route('packages.show', $other->slug) }}" class="block p-3 rounded-2xl border border-slate-100 dark:border-slate-800 hover:bg-slate-50 dark:hover:bg-slate-800/60 transition-colors">
                                        <div class="flex items-center justify-between text-xs text-slate-400 mb-1">
                                            <span>{{ $other->duration }}</span>
                                            <span class="text-brand-600 dark:text-brand-400 font-bold">{{ $other->badge }}</span>
                                        </div>
                                        <p class="font-bold text-sm text-slate-900 dark:text-white line-clamp-1">{{ $other->name }}</p>
                                        <p class="text-xs font-extrabold text-brand-600 dark:text-brand-400 mt-1">{{ $other->formatted_price }}</p>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
