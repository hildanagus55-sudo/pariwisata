@extends('layouts.app')

@section('title', $destination->name . ' — Wisata ' . $destination->location . ' | NusantaraWander')
@section('meta_description', Str::limit(strip_tags($destination->description), 160))

@section('content')
    <div class="pt-24 pb-20">
        <!-- Breadcrumb -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <nav class="flex items-center gap-2 text-xs text-slate-500 dark:text-slate-400">
                <a href="{{ route('home') }}" class="hover:text-brand-600 transition-colors">Beranda</a>
                <i class="fa-solid fa-chevron-right text-[10px]"></i>
                <a href="{{ route('home') }}#destinasi" class="hover:text-brand-600 transition-colors">Destinasi</a>
                <i class="fa-solid fa-chevron-right text-[10px]"></i>
                <span class="text-slate-800 dark:text-slate-200 font-semibold truncate">{{ $destination->name }}</span>
            </nav>
        </div>

        <!-- Hero Destination Banner -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-10">
            <div class="relative h-[380px] sm:h-[480px] rounded-3xl overflow-hidden shadow-2xl">
                <img 
                    src="{{ $destination->image }}" 
                    alt="{{ $destination->name }}" 
                    class="w-full h-full object-cover"
                >
                <div class="absolute inset-0 bg-gradient-to-t from-slate-950/95 via-slate-950/40 to-transparent"></div>

                <div class="absolute bottom-8 left-6 sm:left-10 right-6 sm:right-10 text-white">
                    <div class="flex flex-wrap items-center gap-3 mb-3">
                        <span class="px-3.5 py-1 rounded-full bg-brand-600 text-xs font-bold uppercase tracking-wider">
                            {{ $destination->category }}
                        </span>
                        <span class="px-3 py-1 rounded-full bg-white/20 backdrop-blur-md text-xs font-semibold flex items-center gap-1.5">
                            <i class="fa-solid fa-star text-amber-400"></i>
                            <span>{{ number_format($destination->rating, 2) }} ({{ $destination->reviews_count }} ulasan)</span>
                        </span>
                        <span class="px-3 py-1 rounded-full bg-white/20 backdrop-blur-md text-xs font-semibold">
                            <i class="fa-solid fa-map-pin mr-1 text-emerald-400"></i> {{ $destination->region }}
                        </span>
                    </div>

                    <h1 class="font-serif text-3xl sm:text-5xl font-bold leading-tight">
                        {{ $destination->name }}
                    </h1>
                    <p class="text-sm sm:text-base text-slate-200 mt-2 flex items-center gap-2">
                        <i class="fa-solid fa-location-dot text-emerald-400"></i>
                        <span>{{ $destination->location }}</span>
                    </p>
                </div>
            </div>
        </div>

        <!-- Main Details Grid -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
                <!-- Left Content Column -->
                <div class="lg:col-span-8 space-y-8">
                    <!-- Overview Card -->
                    <div class="bg-white dark:bg-slate-900 rounded-3xl p-6 sm:p-8 border border-slate-200/80 dark:border-slate-800 shadow-sm">
                        <h2 class="font-serif text-2xl font-bold text-slate-900 dark:text-white mb-4">
                            Tentang Destinasi
                        </h2>
                        <p class="text-slate-600 dark:text-slate-300 leading-relaxed text-base sm:text-lg">
                            {{ $destination->description }}
                        </p>

                        <!-- Key Facts Grid -->
                        <div class="grid grid-cols-2 sm:grid-cols-3 gap-4 mt-8 pt-6 border-t border-slate-100 dark:border-slate-800">
                            <div class="p-4 rounded-2xl bg-slate-50 dark:bg-slate-800/60">
                                <span class="text-xs text-slate-400 uppercase tracking-wider block font-semibold">Waktu Terbaik</span>
                                <span class="font-bold text-sm sm:text-base text-slate-800 dark:text-white mt-1 block">
                                    <i class="fa-regular fa-sun text-amber-500 mr-1.5"></i> {{ $destination->best_time }}
                                </span>
                            </div>
                            <div class="p-4 rounded-2xl bg-slate-50 dark:bg-slate-800/60">
                                <span class="text-xs text-slate-400 uppercase tracking-wider block font-semibold">Durasi Tur Ideal</span>
                                <span class="font-bold text-sm sm:text-base text-slate-800 dark:text-white mt-1 block">
                                    <i class="fa-regular fa-clock text-brand-500 mr-1.5"></i> {{ $destination->duration }}
                                </span>
                            </div>
                            <div class="col-span-2 sm:col-span-1 p-4 rounded-2xl bg-brand-50/70 dark:bg-brand-900/30 border border-brand-200/50 dark:border-brand-800/50">
                                <span class="text-xs text-brand-700 dark:text-brand-300 uppercase tracking-wider block font-semibold">Mulai Dari</span>
                                <span class="font-extrabold text-lg sm:text-xl text-brand-600 dark:text-brand-400 mt-0.5 block">
                                    {{ $destination->formatted_price }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Highlights & Activities -->
                    <div class="bg-white dark:bg-slate-900 rounded-3xl p-6 sm:p-8 border border-slate-200/80 dark:border-slate-800 shadow-sm">
                        <h2 class="font-serif text-2xl font-bold text-slate-900 dark:text-white mb-4">
                            Daya Tarik & Aktivitas Unggulan
                        </h2>
                        <p class="text-slate-500 dark:text-slate-400 text-sm mb-6">
                            Pengalaman berharga yang akan Anda dapatkan selama menjelajah lokasi ini bersama pemandu resmi kami:
                        </p>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            @foreach($destination->highlights ?? [] as $index => $highlight)
                                <div class="flex items-start gap-3.5 p-4 rounded-2xl bg-slate-50 dark:bg-slate-800/80 border border-slate-200/60 dark:border-slate-700">
                                    <div class="w-8 h-8 rounded-xl bg-brand-500 text-white flex items-center justify-center text-xs font-bold shrink-0 mt-0.5">
                                        {{ $index + 1 }}
                                    </div>
                                    <span class="text-sm font-semibold text-slate-700 dark:text-slate-200 leading-snug">
                                        {{ $highlight }}
                                    </span>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Related Destinations -->
                    @if($relatedDestinations->count())
                        <div>
                            <h3 class="font-serif text-2xl font-bold text-slate-900 dark:text-white mb-6">
                                Destinasi Menarik Lainnya
                            </h3>
                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                                @foreach($relatedDestinations as $rel)
                                    <a href="{{ route('destinations.show', $rel->slug) }}" class="group block bg-white dark:bg-slate-900 rounded-2xl overflow-hidden border border-slate-200 dark:border-slate-800 shadow-sm hover:shadow-md transition-all">
                                        <div class="h-36 overflow-hidden relative">
                                            <img src="{{ $rel->image }}" alt="{{ $rel->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                            <span class="absolute top-2 left-2 px-2.5 py-0.5 rounded-md bg-slate-900/80 text-white text-[10px] font-bold">
                                                {{ $rel->category }}
                                            </span>
                                        </div>
                                        <div class="p-4">
                                            <h4 class="font-bold text-sm text-slate-900 dark:text-white group-hover:text-brand-600 transition-colors line-clamp-1">
                                                {{ $rel->name }}
                                            </h4>
                                            <p class="text-xs text-brand-600 dark:text-brand-400 font-bold mt-1">
                                                {{ $rel->formatted_price }}
                                            </p>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Right Sidebar Sticky Booking Card -->
                <div class="lg:col-span-4">
                    <div class="sticky top-28 bg-white dark:bg-slate-900 rounded-3xl p-6 sm:p-7 border border-slate-200/80 dark:border-slate-800 shadow-xl space-y-6">
                        <div>
                            <span class="text-xs font-bold uppercase tracking-wider text-slate-400">Harga Paket Tur Mulai Dari</span>
                            <div class="flex items-baseline gap-1 mt-1">
                                <span class="font-serif text-3xl font-extrabold text-brand-600 dark:text-brand-400">{{ $destination->formatted_price }}</span>
                                <span class="text-xs text-slate-400">/ orang</span>
                            </div>
                        </div>

                        <div class="space-y-3 pt-4 border-t border-slate-100 dark:border-slate-800 text-xs text-slate-600 dark:text-slate-400">
                            <div class="flex items-center gap-2.5">
                                <i class="fa-solid fa-circle-check text-brand-500 text-sm"></i>
                                <span>Pemandu lokal bersertifikat HPI</span>
                            </div>
                            <div class="flex items-center gap-2.5">
                                <i class="fa-solid fa-circle-check text-brand-500 text-sm"></i>
                                <span>Tiket masuk kawasan konservasi</span>
                            </div>
                            <div class="flex items-center gap-2.5">
                                <i class="fa-solid fa-circle-check text-brand-500 text-sm"></i>
                                <span>Transportasi lokal & asuransi perjalanan</span>
                            </div>
                            <div class="flex items-center gap-2.5">
                                <i class="fa-solid fa-circle-check text-brand-500 text-sm"></i>
                                <span>Gratis pembatalan s/d 7 hari sebelum trip</span>
                            </div>
                        </div>

                        <div class="space-y-3 pt-2">
                            <button onclick="openBookingModal('{{ addslashes($destination->name) }}')" class="w-full py-3.5 px-6 rounded-xl bg-gradient-to-r from-brand-600 to-teal-600 hover:from-brand-700 hover:to-teal-700 text-white font-bold text-sm shadow-lg shadow-brand-600/30 transition-all flex items-center justify-center gap-2">
                                <i class="fa-solid fa-paper-plane text-xs"></i>
                                <span>Pesan Perjalanan Ini</span>
                            </button>
                            <a href="https://wa.me/6281199887766?text=Halo%20NusantaraWander,%20saya%20tertarik%20dengan%20destinasi%20{{ urlencode($destination->name) }}" target="_blank" class="w-full py-3 px-6 rounded-xl border border-slate-200 dark:border-slate-700 hover:bg-slate-50 dark:hover:bg-slate-800 text-slate-700 dark:text-slate-300 font-semibold text-xs transition-colors flex items-center justify-center gap-2">
                                <i class="fa-brands fa-whatsapp text-emerald-500 text-sm"></i>
                                <span>Konsultasi Via WhatsApp</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
