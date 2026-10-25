@extends('layouts.app')

@section('title', 'DANWISATA | ' . $destination->name . ' | Catatan Perjalanan')
@section('meta_description', Str::limit(strip_tags($destination->description), 160))

@section('content')
    <div class="pt-24 sm:pt-28 pb-16 sm:pb-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Navigation & Breadcrumb -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 mb-6">
            <a href="{{ route('home') }}#destinasi" class="inline-flex items-center gap-2 px-4 py-2 rounded-full border border-stone-200 dark:border-stone-800 bg-white dark:bg-stone-900 text-xs font-semibold text-stone-700 dark:text-stone-300 hover:bg-stone-100 dark:hover:bg-stone-800 hover:text-stone-950 dark:hover:text-white transition-all shadow-xs group w-fit">
                <i class="fa-solid fa-arrow-left text-[11px] group-hover:-translate-x-0.5 transition-transform"></i>
                <span>Kembali ke Destinasi</span>
            </a>

            <!-- Breadcrumb -->
            <nav class="flex items-center gap-2 text-xs text-stone-500 overflow-x-auto no-scrollbar py-1">
                <a href="{{ route('home') }}" class="hover:text-stone-900 dark:hover:text-stone-200 transition-colors shrink-0">Beranda</a>
                <span class="text-stone-300 dark:text-stone-700">/</span>
                <a href="{{ route('home') }}#destinasi" class="hover:text-stone-900 dark:hover:text-stone-200 transition-colors shrink-0">Destinasi</a>
                <span class="text-stone-300 dark:text-stone-700">/</span>
                <span class="text-stone-900 dark:text-stone-100 font-medium truncate max-w-[160px] sm:max-w-xs">{{ $destination->name }}</span>
            </nav>
        </div>

        <!-- Destination Hero Banner -->
        <div class="relative h-[280px] sm:h-[480px] rounded-2xl sm:rounded-3xl overflow-hidden shadow-sm mb-8 sm:mb-12 bg-stone-100">
            <img 
                src="{{ $destination->image }}" 
                alt="{{ $destination->name }}" 
                class="w-full h-full object-cover"
            >
            <div class="absolute inset-0 bg-gradient-to-t from-stone-950/80 via-stone-950/20 to-transparent"></div>

            <div class="absolute bottom-5 sm:bottom-8 left-4 sm:left-10 right-4 sm:right-10 text-white">
                <div class="flex flex-wrap items-center gap-2 mb-2">
                    <span class="px-2.5 sm:px-3 py-0.5 rounded-full bg-white/20 backdrop-blur-md text-[11px] sm:text-xs font-medium">
                        {{ $destination->category }}
                    </span>
                    <span class="text-xs text-stone-200 flex items-center gap-1">
                        <i class="fa-solid fa-star text-amber-300 text-[10px]"></i>
                        <span>{{ number_format($destination->rating, 2) }} ({{ $destination->reviews_count }} catatan tamu)</span>
                    </span>
                </div>

                <h1 class="font-serif text-2xl sm:text-5xl font-medium leading-tight">
                    {{ $destination->name }}
                </h1>
                <p class="text-xs sm:text-sm text-stone-200 mt-1 sm:mt-2 flex items-center gap-1.5">
                    <i class="fa-solid fa-location-dot text-xs text-stone-300"></i>
                    <span>{{ $destination->location }}</span>
                </p>
            </div>
        </div>

        <!-- Main Details Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
            <!-- Left Narrative Column -->
            <div class="lg:col-span-8 space-y-10">
                <!-- Description -->
                <div class="bg-white dark:bg-stone-900 rounded-3xl p-6 sm:p-8 border border-stone-200/90 dark:border-stone-800 shadow-xs">
                    <h2 class="font-serif text-2xl font-normal text-stone-900 dark:text-white mb-4">
                        Tentang Tempat Ini
                    </h2>
                    <p class="text-stone-600 dark:text-stone-300 leading-relaxed text-sm sm:text-base">
                        {{ $destination->description }}
                    </p>

                    <!-- Key Facts -->
                    <div class="grid grid-cols-3 gap-4 mt-8 pt-6 border-t border-stone-100 dark:border-stone-800 text-xs">
                        <div>
                            <span class="text-stone-400 block uppercase tracking-wider text-[10px] font-semibold">Musim Terbaik</span>
                            <span class="font-semibold text-stone-900 dark:text-white mt-1 block">
                                {{ $destination->best_time }}
                            </span>
                        </div>
                        <div>
                            <span class="text-stone-400 block uppercase tracking-wider text-[10px] font-semibold">Durasi Kunjungan</span>
                            <span class="font-semibold text-stone-900 dark:text-white mt-1 block">
                                {{ $destination->duration }}
                            </span>
                        </div>
                        <div>
                            <span class="text-stone-400 block uppercase tracking-wider text-[10px] font-semibold">Perkiraan Biaya</span>
                            <span class="font-serif font-bold text-stone-900 dark:text-white text-sm sm:text-base mt-1 block">
                                {{ $destination->formatted_price }} <span class="font-sans text-[11px] font-normal text-stone-400">/ org</span>
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Highlights -->
                <div class="bg-white dark:bg-stone-900 rounded-3xl p-6 sm:p-8 border border-stone-200/90 dark:border-stone-800 shadow-xs">
                    <h2 class="font-serif text-2xl font-normal text-stone-900 dark:text-white mb-4">
                        Yang Akan Anda Nikmati
                    </h2>

                    <div class="space-y-3">
                        @foreach($destination->highlights ?? [] as $index => $highlight)
                            <div class="flex items-start gap-3 p-3.5 rounded-2xl bg-stone-50 dark:bg-stone-800/60 border border-stone-200/60 dark:border-stone-700">
                                <span class="w-6 h-6 rounded-full bg-stone-900 text-white dark:bg-stone-100 dark:text-stone-900 flex items-center justify-center text-xs font-semibold shrink-0 mt-0.5">
                                    {{ $index + 1 }}
                                </span>
                                <span class="text-xs sm:text-sm font-medium text-stone-700 dark:text-stone-200 leading-relaxed">
                                    {{ $highlight }}
                                </span>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Related -->
                @if($relatedDestinations->count())
                    <div>
                        <h3 class="font-serif text-xl font-normal text-stone-900 dark:text-white mb-5">
                            Destinasi Lain di Wilayah Ini
                        </h3>
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
                            @foreach($relatedDestinations as $rel)
                                <a href="{{ route('destinations.show', $rel->slug) }}" class="group block bg-white dark:bg-stone-900 rounded-2xl overflow-hidden border border-stone-200/80 dark:border-stone-800 shadow-xs hover:border-stone-400 transition-all">
                                    <div class="h-36 overflow-hidden relative bg-stone-100">
                                        <img src="{{ $rel->image }}" alt="{{ $rel->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                    </div>
                                    <div class="p-3.5">
                                        <p class="font-serif font-medium text-xs sm:text-sm text-stone-900 dark:text-white line-clamp-1">
                                            {{ $rel->name }}
                                        </p>
                                        <p class="text-xs font-semibold text-stone-500 mt-1">
                                            {{ $rel->formatted_price }}
                                        </p>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            <!-- Right Sidebar Card -->
            <div class="lg:col-span-4">
                <div class="sticky top-28 bg-white dark:bg-stone-900 rounded-3xl p-6 sm:p-7 border border-stone-200/90 dark:border-stone-800 shadow-sm space-y-5">
                    <div>
                        <span class="text-[10px] uppercase tracking-wider text-stone-400 font-bold block">Biaya Perjalanan Mulai Dari</span>
                        <div class="flex items-baseline gap-1 mt-1">
                            <span class="font-serif text-3xl font-bold text-stone-950 dark:text-white">{{ $destination->formatted_price }}</span>
                            <span class="text-xs text-stone-400">/ tamu</span>
                        </div>
                    </div>

                    <div class="space-y-2.5 pt-4 border-t border-stone-100 dark:border-stone-800 text-xs text-stone-600 dark:text-stone-400">
                        <div class="flex items-center gap-2">
                            <i class="fa-solid fa-check text-stone-900 dark:text-stone-100 text-xs"></i>
                            <span>Didampingi pemandu warga lokal</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <i class="fa-solid fa-check text-stone-900 dark:text-stone-100 text-xs"></i>
                            <span>Tiket masuk & izin kawasan konservasi</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <i class="fa-solid fa-check text-stone-900 dark:text-stone-100 text-xs"></i>
                            <span>Transportasi lokal privat & asuransi</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <i class="fa-solid fa-check text-stone-900 dark:text-stone-100 text-xs"></i>
                            <span>Jadwal santai tanpa belanja paksaan</span>
                        </div>
                    </div>

                    <div class="space-y-2.5 pt-2">
                        <button onclick="openBookingModal('{{ addslashes($destination->name) }}')" class="w-full py-3 px-5 rounded-full bg-stone-900 hover:bg-stone-800 text-white dark:bg-stone-100 dark:text-stone-900 font-semibold text-xs transition-all shadow-sm">
                            Rencanakan Kunjungan
                        </button>
                        <a href="https://wa.me/6289519808548?text=Halo%20DANWISATA,%20saya%20tertarik%20dengan%20destinasi%20{{ urlencode($destination->name) }}" target="_blank" class="w-full py-2.5 px-5 rounded-full border border-stone-300 dark:border-stone-700 hover:bg-stone-50 dark:hover:bg-stone-800 text-stone-700 dark:text-stone-200 font-medium text-xs transition-colors flex items-center justify-center gap-2">
                            <i class="fa-brands fa-whatsapp text-emerald-600"></i>
                            <span>Tanya Rute di WhatsApp</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bottom Back & Action Bar -->
        <div class="mt-14 pt-8 border-t border-stone-200 dark:border-stone-800 flex flex-wrap items-center justify-between gap-4">
            <a href="{{ route('home') }}#destinasi" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-full border border-stone-300 dark:border-stone-700 hover:bg-stone-100 dark:hover:bg-stone-800 text-stone-800 dark:text-stone-200 text-xs font-semibold transition-all">
                <i class="fa-solid fa-arrow-left text-[10px]"></i>
                <span>Kembali ke Daftar Destinasi</span>
            </a>
            <div class="flex items-center gap-3">
                <button onclick="toggleWishlist({{ $destination->id }}, '{{ addslashes($destination->name) }}')" class="px-4 py-2.5 rounded-full border border-stone-300 dark:border-stone-700 text-xs font-semibold text-stone-700 dark:text-stone-300 hover:bg-stone-100 dark:hover:bg-stone-800 flex items-center gap-1.5 transition-colors">
                    <i class="fa-regular fa-heart text-xs"></i>
                    <span>Simpan</span>
                </button>
                <button onclick="openBookingModal('{{ addslashes($destination->name) }}')" class="px-6 py-2.5 rounded-full bg-stone-900 text-white dark:bg-stone-100 dark:text-stone-900 text-xs font-semibold shadow-sm hover:opacity-90 transition-all flex items-center gap-1.5">
                    <span>Rencanakan Kunjungan</span>
                    <i class="fa-solid fa-arrow-right text-[10px]"></i>
                </button>
            </div>
        </div>
    </div>
@endsection
