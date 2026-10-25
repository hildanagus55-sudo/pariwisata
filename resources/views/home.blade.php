@extends('layouts.app')

@section('title', 'DANWISATA | Portal Pariwisata Indonesia')
@section('meta_description', 'DANWISATA | Portal Pariwisata Indonesia resmi dan terpercaya. Jelajahi keindahan destinasi wisata alam, budaya nusantara, dan paket liburan impian terbaik.')

@section('content')
    <!-- ================= 2. HERO SECTION & INTERACTIVE SEARCH WIDGET (CINEMATIC PHOTO HERO) ================= -->
    <section id="beranda" class="relative min-h-[88dvh] sm:min-h-[92vh] pt-24 sm:pt-28 pb-14 sm:pb-20 flex items-center justify-center overflow-hidden">
        <!-- Background Video Loop -->
        <video 
            id="heroVideo"
            autoplay 
            muted 
            loop 
            playsinline 
            preload="auto"
            poster="https://images.unsplash.com/photo-1518548419970-58e3b4079ab2?auto=format&fit=crop&w=2000&q=85"
            class="absolute inset-0 w-full h-full object-cover object-center scale-105 pointer-events-none"
        >
            @if(file_exists(public_path('videos/hero.mp4')))
                <source src="{{ asset('videos/hero.mp4') }}" type="video/mp4">
            @endif
            @if(file_exists(public_path('videos/hero.webm')))
                <source src="{{ asset('videos/hero.webm') }}" type="video/webm">
            @endif
            <source src="https://assets.mixkit.co/videos/51791/51791-720.mp4" type="video/mp4">
            <source src="https://upload.wikimedia.org/wikipedia/commons/transcoded/8/82/Bromo_Java_Indonesia_20220820_055918.webm/Bromo_Java_Indonesia_20220820_055918.webm.1080p.vp9.webm" type="video/webm">
            <img 
                src="https://images.unsplash.com/photo-1518548419970-58e3b4079ab2?auto=format&fit=crop&w=2000&q=85" 
                onerror="this.src='https://placehold.co/1920x1080/0e4437/ffffff?text=Pesona+Alam+Indonesia'"
                alt="Pemandangan Alam Kepulauan Indonesia" 
                class="absolute inset-0 w-full h-full object-cover object-center scale-105 transition-transform duration-1000"
            >
        </video>
        <div class="absolute inset-0 hero-gradient"></div>

        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
            <div class="max-w-3xl mx-auto text-center text-white">
                <!-- Pill Badge with Ping Indicator -->
                <div class="inline-flex items-center gap-1.5 sm:gap-2 px-3 sm:px-4 py-1 sm:py-1.5 rounded-full bg-white/15 backdrop-blur-md border border-white/25 text-[11px] sm:text-sm font-medium mb-4 sm:mb-6 animate-float max-w-[92vw] truncate">
                    <span class="w-2 h-2 rounded-full bg-emerald-400 animate-ping shrink-0"></span>
                    <span data-i18n="heroBadge" class="truncate">Eksplorasi 17.000+ Pulau Eksotis di Zamrud Khatulistiwa</span>
                </div>

                <!-- Inspiring Headline -->
                <h1 data-i18n="heroTitle" class="font-serif text-3xl sm:text-5xl lg:text-6xl font-bold leading-tight tracking-tight mb-3 sm:mb-6">
                    Temukan Surga Tersembunyi di <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-300 via-teal-200 to-amber-200 italic">Bumi Nusantara</span>
                </h1>

                <p data-i18n="heroDesc" class="text-xs sm:text-lg text-slate-200/90 leading-relaxed mb-6 sm:mb-10 max-w-2xl mx-auto px-2">
                    Dari birunya perairan Raja Ampat, megahnya kabut pagi Borobudur, hingga hangatnya senja di Labuan Bajo. Wujudkan perjalanan impian Anda bersama pemandu lokal terbaik.
                </p>

                <!-- Quick Stats Counter -->
                <div class="grid grid-cols-3 gap-2 sm:gap-4 max-w-lg mx-auto mb-8 sm:mb-12 text-center">
                    <div class="p-2 sm:p-3.5 rounded-xl sm:rounded-2xl bg-white/10 backdrop-blur-sm border border-white/15">
                        <p class="text-lg sm:text-2xl font-extrabold text-emerald-300">120+</p>
                        <p data-i18n="heroStatDest" class="text-[10px] sm:text-xs text-slate-200 truncate">Destinasi Unggulan</p>
                    </div>
                    <div class="p-2 sm:p-3.5 rounded-xl sm:rounded-2xl bg-white/10 backdrop-blur-sm border border-white/15">
                        <p class="text-lg sm:text-2xl font-extrabold text-amber-300">4.9/5</p>
                        <p data-i18n="heroStatGuide" class="text-[10px] sm:text-xs text-slate-200 truncate">Rating Wisatawan</p>
                    </div>
                    <div class="p-2 sm:p-3.5 rounded-xl sm:rounded-2xl bg-white/10 backdrop-blur-sm border border-white/15">
                        <p class="text-lg sm:text-2xl font-extrabold text-teal-300">45K+</p>
                        <p data-i18n="heroStatSat" class="text-[10px] sm:text-xs text-slate-200 truncate">Pelanggan Puas</p>
                    </div>
                </div>
            </div>

            <!-- Interactive Search Widget Card -->
            <div class="max-w-5xl mx-auto bg-white dark:bg-stone-900 rounded-2xl sm:rounded-3xl p-4 sm:p-6 shadow-2xl border border-stone-200/80 dark:border-stone-800">
                <form id="heroSearchForm" onsubmit="handleHeroSearch(event)" class="grid grid-cols-1 md:grid-cols-12 gap-3 sm:gap-4 items-end">
                    <!-- Lokasi Tujuan (Searchable Combobox with Full Indonesia Regions) -->
                    <div class="md:col-span-6 lg:col-span-4 relative" id="locationComboboxWrapper">
                        <label for="searchLocationInput" class="block text-[11px] sm:text-xs font-bold uppercase tracking-wider text-stone-500 dark:text-stone-400 mb-1.5 sm:mb-2 flex items-center justify-between">
                            <span>
                                <i class="fa-solid fa-location-dot text-stone-800 dark:text-stone-200 mr-1.5"></i>
                                <span data-i18n="heroFieldRegion">Lokasi Tujuan</span>
                            </span>
                            <span class="text-[10px] font-normal normal-case text-stone-400 dark:text-stone-500" data-i18n="heroLocHint">Bisa ketik nama wilayah</span>
                        </label>
                        <div class="relative">
                            <input 
                                type="text" 
                                id="searchLocationInput"
                                autocomplete="off"
                                spellcheck="false"
                                data-i18n-placeholder="heroLocPlaceholder"
                                placeholder="Ketik atau pilih wilayah / destinasi..."
                                class="w-full h-11 sm:h-12 pl-10 pr-14 rounded-xl bg-stone-50 dark:bg-stone-800 border border-stone-200 dark:border-stone-700 text-stone-800 dark:text-stone-100 font-medium text-xs sm:text-sm focus:ring-2 focus:ring-stone-900 focus:bg-white dark:focus:bg-stone-900 focus:outline-none transition-all shadow-2xs"
                                onfocus="openLocationDropdown()"
                                oninput="handleLocationInput(event)"
                                onkeydown="handleLocationKeydown(event)"
                            >
                            <input type="hidden" id="searchLocation" value="">
                            <!-- Pin Search Icon on Left -->
                            <span class="absolute inset-y-0 left-3.5 flex items-center pointer-events-none text-stone-400 dark:text-stone-500">
                                <i class="fa-solid fa-magnifying-glass text-xs"></i>
                            </span>

                            <!-- Action Icons on Right: Clear & Dropdown Toggle -->
                            <div class="absolute inset-y-0 right-2 flex items-center gap-0.5">
                                <button 
                                    type="button" 
                                    id="clearLocationBtn"
                                    onclick="clearLocationInput(event)"
                                    class="hidden w-6 h-6 rounded-full hover:bg-stone-200 dark:hover:bg-stone-700 text-stone-400 hover:text-stone-700 dark:hover:text-stone-200 items-center justify-center transition-colors"
                                    title="Hapus input"
                                >
                                    <i class="fa-solid fa-xmark text-xs"></i>
                                </button>
                                <button 
                                    type="button"
                                    id="toggleLocationBtn"
                                    onclick="toggleLocationDropdown(event)"
                                    class="w-7 h-7 rounded-lg hover:bg-stone-200 dark:hover:bg-stone-700 text-stone-400 hover:text-stone-700 dark:hover:text-stone-200 flex items-center justify-center transition-colors"
                                    title="Pilih dari daftar wilayah"
                                >
                                    <i id="locationDropdownChevron" class="fa-solid fa-chevron-down text-[10px] transition-transform duration-200"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Floating Searchable Suggestions Dropdown -->
                        <div 
                            id="locationDropdownList" 
                            class="hidden absolute left-0 right-0 top-full mt-2 z-50 bg-white dark:bg-stone-900 rounded-2xl shadow-2xl border border-stone-200/90 dark:border-stone-800 max-h-72 overflow-y-auto no-scrollbar p-2 animate-fadeIn"
                        >
                            <div class="px-3 py-1.5 text-[10px] font-bold uppercase tracking-wider text-stone-400 dark:text-stone-500 border-b border-stone-100 dark:border-stone-800 mb-1 flex items-center justify-between">
                                <span data-i18n="heroLocAllHeader">Wilayah di Seluruh Indonesia</span>
                                <span id="locationCountBadge" class="font-mono text-[9px] px-1.5 py-0.5 rounded-md bg-stone-100 dark:bg-stone-800 text-stone-600 dark:text-stone-400">28 Wilayah</span>
                            </div>
                            <div id="locationOptionsContainer" class="space-y-1">
                                <!-- Generated by JS -->
                            </div>
                        </div>
                    </div>

                    <!-- Tanggal Keberangkatan -->
                    <div class="md:col-span-6 lg:col-span-3">
                        <label class="block text-[11px] sm:text-xs font-bold uppercase tracking-wider text-stone-500 dark:text-stone-400 mb-1.5 sm:mb-2">
                            <i class="fa-regular fa-calendar-days text-stone-800 dark:text-stone-200 mr-1.5"></i> <span data-i18n="heroFieldDate">Tanggal Berangkat</span>
                        </label>
                        <input type="date" id="searchDate" required class="w-full h-11 sm:h-12 px-3.5 sm:px-4 rounded-xl bg-stone-50 dark:bg-stone-800 border border-stone-200 dark:border-stone-700 text-stone-800 dark:text-stone-100 font-medium text-xs sm:text-sm focus:ring-2 focus:ring-stone-900 focus:outline-none transition-colors">
                    </div>

                    <!-- Jumlah Peserta -->
                    <div class="md:col-span-6 lg:col-span-3">
                        <label class="block text-[11px] sm:text-xs font-bold uppercase tracking-wider text-stone-500 dark:text-stone-400 mb-1.5 sm:mb-2">
                            <i class="fa-solid fa-user-group text-stone-800 dark:text-stone-200 mr-1.5"></i> <span data-i18n="heroFieldPax">Jumlah Peserta</span>
                        </label>
                        <select id="searchPax" class="w-full h-11 sm:h-12 px-3.5 sm:px-4 rounded-xl bg-stone-50 dark:bg-stone-800 border border-stone-200 dark:border-stone-700 text-stone-800 dark:text-stone-100 font-medium text-xs sm:text-sm focus:ring-2 focus:ring-stone-900 focus:outline-none transition-colors">
                            <option value="1" data-i18n="heroPax1" selected>1 Orang (Solo Traveler)</option>
                            <option value="2" data-i18n="heroPax2">2 Orang (Pasangan / Sahabat)</option>
                            <option value="4" data-i18n="heroPax4">4 Orang (Keluarga Kecil)</option>
                            <option value="6" data-i18n="heroPax6">6 Orang (Grup Privat)</option>
                            <option value="10" data-i18n="heroPax10">10+ Orang (Rombongan)</option>
                        </select>
                    </div>

                    <!-- Tombol Cari -->
                    <div class="md:col-span-6 lg:col-span-2">
                        <button type="submit" id="heroSearchBtn" class="group w-full h-11 sm:h-12 px-4 rounded-xl bg-gradient-to-r from-stone-950 via-stone-900 to-stone-800 hover:from-stone-900 hover:to-stone-700 dark:from-stone-100 dark:via-stone-200 dark:to-stone-300 text-white dark:text-stone-900 font-semibold text-xs sm:text-sm shadow-md hover:shadow-xl transition-all duration-300 flex items-center justify-center gap-2 active:scale-95 whitespace-nowrap cursor-pointer">
                            <i class="fa-solid fa-magnifying-glass text-[11px] sm:text-xs text-amber-300 dark:text-amber-600 group-hover:scale-110 transition-transform"></i>
                            <span data-i18n="heroBtnSearch" class="tracking-wide">Cari Wisata</span>
                        </button>
                    </div>
                </form>

                <!-- Popular Quick Tags (Swipeable on Mobile) -->
                <div class="mt-3.5 pt-3 border-t border-stone-100 dark:border-stone-800 flex items-center gap-2 text-xs text-stone-500 dark:text-stone-400 overflow-x-auto no-scrollbar pb-1">
                    <span data-i18n="heroPopSearch" class="font-semibold shrink-0 text-[11px] sm:text-xs">Pencarian Populer:</span>
                    <button onclick="quickFilter('Pantai')" data-i18n="heroPopRajaAmpat" class="shrink-0 px-2.5 py-1 rounded-lg bg-stone-100 dark:bg-stone-800 hover:bg-stone-200 dark:hover:bg-stone-700 text-stone-700 dark:text-stone-300 text-[11px] sm:text-xs transition-colors whitespace-nowrap">🏝️ Kepulauan Raja Ampat</button>
                    <button onclick="quickFilter('Pegunungan')" data-i18n="heroPopBromo" class="shrink-0 px-2.5 py-1 rounded-lg bg-stone-100 dark:bg-stone-800 hover:bg-stone-200 dark:hover:bg-stone-700 text-stone-700 dark:text-stone-300 text-[11px] sm:text-xs transition-colors whitespace-nowrap">🌋 Sunrise Gunung Bromo</button>
                    <button onclick="quickFilter('Budaya')" data-i18n="heroPopBorobudur" class="shrink-0 px-2.5 py-1 rounded-lg bg-stone-100 dark:bg-stone-800 hover:bg-stone-200 dark:hover:bg-stone-700 text-stone-700 dark:text-stone-300 text-[11px] sm:text-xs transition-colors whitespace-nowrap">🛕 Candi Borobudur</button>
                    <button onclick="quickFilter('Alam')" data-i18n="heroPopKomodo" class="shrink-0 px-2.5 py-1 rounded-lg bg-stone-100 dark:bg-stone-800 hover:bg-stone-200 dark:hover:bg-stone-700 text-stone-700 dark:text-stone-300 text-[11px] sm:text-xs transition-colors whitespace-nowrap">🐉 Taman Nasional Komodo</button>
                </div>
            </div>
        </div>
    </section>

    <!-- ================= 2. DESTINASI POPULER (CLEAN WHITE EDITORIAL CARDS) ================= -->
    <section id="destinasi" class="py-12 sm:py-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Section Header -->
        <div class="flex flex-col sm:flex-row sm:items-end justify-between mb-8 sm:mb-10 gap-4 sm:gap-5 pb-5 sm:pb-6 border-b border-stone-200/80 dark:border-stone-800">
            <div>
                <span data-i18n="destSubtitle" class="text-xs font-semibold text-stone-500 dark:text-stone-400 uppercase tracking-wider block mb-1">
                    Jurnal Destinasi
                </span>
                <h2 data-i18n="destTitle" class="font-serif text-2xl sm:text-4xl font-normal text-stone-950 dark:text-white tracking-tight">
                    Tempat-Tempat Istimewa di Bumi Pertiwi
                </h2>
                <p data-i18n="destDesc" class="mt-2 text-stone-600 dark:text-stone-400 max-w-xl text-xs sm:text-sm leading-relaxed">
                    Setiap lokasi dikurasi dengan cermat: memilih musim terbaik, penginapan berkarakter, dan rute santai yang bersahabat dengan alam.
                </p>
            </div>

            <!-- Tombol Lihat Halaman di Samping Judul -->
            <div class="shrink-0">
                <a href="{{ route('destinations.index') }}" class="inline-flex items-center justify-center gap-2 w-full sm:w-auto px-5 py-2.5 rounded-full border border-stone-300 dark:border-stone-700 hover:border-stone-900 dark:hover:border-stone-200 bg-white dark:bg-stone-900 hover:bg-stone-900 hover:text-white dark:hover:bg-stone-100 dark:hover:text-stone-900 text-stone-800 dark:text-stone-200 text-xs font-semibold transition-all whitespace-nowrap shadow-xs group" title="Buka Halaman Lengkap Destinasi">
                    <span data-i18n="destBtnViewAll">Lihat Halaman Destinasi</span>
                    <i class="fa-solid fa-arrow-right text-[10px] group-hover:translate-x-1 transition-transform"></i>
                </a>
            </div>
        </div>

        <!-- Category Filter Pills (Horizontal Momentum Scroll on Mobile) -->
        <div id="categoryButtons" class="flex items-center gap-2 overflow-x-auto pb-3 mb-6 sm:mb-8 no-scrollbar text-xs -mx-4 px-4 sm:mx-0 sm:px-0">
            <button onclick="setCategory('Semua')" data-cat="Semua" data-i18n="catAll" class="cat-btn shrink-0 px-4 py-2 rounded-full font-semibold transition-all whitespace-nowrap bg-stone-900 text-white dark:bg-white dark:text-stone-900 shadow-sm active:scale-95">
                Semua Koleksi
            </button>
            <button onclick="setCategory('Pantai')" data-cat="Pantai" data-i18n="catBeach" class="cat-btn shrink-0 px-4 py-2 rounded-full font-medium transition-all whitespace-nowrap bg-stone-100 dark:bg-stone-900 text-stone-700 dark:text-stone-300 border border-stone-200/80 dark:border-stone-800 hover:border-stone-400 active:scale-95">
                Pantai & Perairan Karst
            </button>
            <button onclick="setCategory('Pegunungan')" data-cat="Pegunungan" data-i18n="catMountain" class="cat-btn shrink-0 px-4 py-2 rounded-full font-medium transition-all whitespace-nowrap bg-stone-100 dark:bg-stone-900 text-stone-700 dark:text-stone-300 border border-stone-200/80 dark:border-stone-800 hover:border-stone-400 active:scale-95">
                Puncak & Kaldera Dingin
            </button>
            <button onclick="setCategory('Budaya')" data-cat="Budaya" data-i18n="catCulture" class="cat-btn shrink-0 px-4 py-2 rounded-full font-medium transition-all whitespace-nowrap bg-stone-100 dark:bg-stone-900 text-stone-700 dark:text-stone-300 border border-stone-200/80 dark:border-stone-800 hover:border-stone-400 active:scale-95">
                Sejarah & Perkampungan Adat
            </button>
            <button onclick="setCategory('Alam')" data-cat="Alam" data-i18n="catNature" class="cat-btn shrink-0 px-4 py-2 rounded-full font-medium transition-all whitespace-nowrap bg-stone-100 dark:bg-stone-900 text-stone-700 dark:text-stone-300 border border-stone-200/80 dark:border-stone-800 hover:border-stone-400 active:scale-95">
                Eksotisme Rimba & Satwa
            </button>
        </div>

        <!-- Destinations Grid Container -->
        <div id="destinationsGrid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5 sm:gap-8">
            @foreach($destinations as $dest)
                <article 
                    onclick="openDetailModal({{ $dest->id }})" 
                    class="group bg-white dark:bg-stone-900 rounded-2xl sm:rounded-3xl overflow-hidden border border-stone-200/90 dark:border-stone-800 hover:border-stone-400 dark:hover:border-stone-600 hover:shadow-xl transition-all duration-300 flex flex-col cursor-pointer"
                >
                    <!-- Image Container with Natural Ratio -->
                    <div class="relative h-56 sm:h-64 overflow-hidden bg-stone-100">
                        <img 
                            src="{{ $dest->image }}" 
                            onerror="this.src='https://placehold.co/600x400/262019/ffffff?text={{ urlencode($dest->name) }}'"
                            alt="{{ $dest->name }}" 
                            class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                        >
                        <div class="absolute inset-0 bg-gradient-to-t from-stone-950/70 via-transparent to-transparent"></div>
                        
                        <!-- Minimal Tag Badge -->
                        <span class="absolute top-4 left-4 px-2.5 py-0.5 rounded-full bg-white/90 dark:bg-stone-900/90 text-stone-800 dark:text-stone-200 text-[11px] font-medium tracking-wide shadow-xs">
                            {{ $dest->category }}
                        </span>

                        <!-- Wishlist Heart Button -->
                        <button onclick="event.stopPropagation(); toggleWishlist({{ $dest->id }}, '{{ addslashes($dest->name) }}')" class="wishlist-btn absolute top-4 right-4 w-8 h-8 rounded-full bg-white/90 dark:bg-stone-900/90 text-stone-600 dark:text-stone-300 flex items-center justify-center hover:scale-110 transition-transform shadow-xs" data-id="{{ $dest->id }}" title="Simpan ke Jurnal">
                            <i class="fa-regular text-xs fa-heart"></i>
                        </button>

                        <!-- Bottom Location Strip -->
                        <div class="absolute bottom-3 left-4 right-4 flex items-center justify-between text-white text-xs">
                            <span class="truncate pr-2 font-medium flex items-center gap-1.5 text-stone-200">
                                <i class="fa-solid fa-location-dot text-[11px]"></i>
                                {{ $dest->location }}
                            </span>
                            <span class="text-[11px] text-amber-300 flex items-center gap-1 font-semibold shrink-0">
                                <i class="fa-solid fa-star text-[10px]"></i> {{ number_format($dest->rating, 2) }}
                            </span>
                        </div>
                    </div>

                    <!-- Card Body -->
                    <div class="p-5 sm:p-6 flex-1 flex flex-col justify-between">
                        <div>
                            <div class="flex items-center gap-2 text-[11px] text-stone-400 mb-1.5">
                                <span><i class="fa-regular fa-clock mr-1"></i> {{ $dest->duration }}</span>
                                <span>•</span>
                                <span>{{ $dest->reviews_count }} catatan perjalanan</span>
                            </div>
                            <h3 class="font-serif text-xl font-semibold text-stone-900 dark:text-white group-hover:text-stone-600 dark:group-hover:text-stone-300 transition-colors leading-snug">
                                {{ $dest->name }}
                            </h3>
                            <p class="mt-2 text-xs text-stone-600 dark:text-stone-400 line-clamp-2 leading-relaxed">
                                {{ $dest->description }}
                            </p>
                        </div>

                        <!-- Price & Action -->
                        <div class="mt-6 pt-4 border-t border-stone-100 dark:border-stone-800 flex items-center justify-between gap-2">
                            <div>
                                <span data-i18n="cardStartingFrom" class="text-[10px] text-stone-400 uppercase tracking-wider block">Mulai dari</span>
                                <p class="text-base font-serif font-bold text-stone-900 dark:text-white">{{ $dest->formatted_price }}<span data-i18n="cardPerPerson" class="text-[11px] font-sans font-normal text-stone-400">/org</span></p>
                            </div>
                            <div class="flex items-center gap-2">
                                <span data-i18n="cardRouteNotes" class="px-4 py-2 rounded-full border border-stone-200 dark:border-stone-700 group-hover:bg-stone-900 group-hover:text-white dark:group-hover:bg-stone-100 dark:group-hover:text-stone-900 text-stone-800 dark:text-stone-200 text-xs font-semibold transition-all">
                                    Catatan Rute
                                </span>
                            </div>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>
    </section>

    <!-- ================= 3. PAKET PERJALANAN (CLEAN BOUTIQUE PACKAGES) ================= -->
    <!-- ================= 3. PAKET WISATA (BOUTIQUE ITINERARY) ================= -->
    <section id="paket" class="py-12 sm:py-20 bg-stone-50 dark:bg-stone-900/50 border-y border-stone-200/80 dark:border-stone-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col sm:flex-row sm:items-end justify-between mb-8 sm:mb-10 gap-4 pb-4 border-b border-stone-200/80 dark:border-stone-800">
                <div>
                    <span data-i18n="pkgSubtitle" class="text-xs font-semibold text-stone-500 uppercase tracking-wider block mb-1">
                        Boutique Itinerary
                    </span>
                    <h2 data-i18n="pkgTitle" class="font-serif text-2xl sm:text-4xl font-normal text-stone-950 dark:text-white tracking-tight">
                        Paket Perjalanan Terkurasi
                    </h2>
                    <p data-i18n="pkgDesc" class="mt-2 text-stone-600 dark:text-stone-400 text-xs sm:text-sm max-w-xl leading-relaxed">
                        Sudah mencakup kabin/hotel yang bersih dan estetik, transportasi darat & laut privat, tiket kawasan konservasi, serta santap hidangan lokal segar.
                    </p>
                </div>

                <!-- Tombol Lihat Halaman Paket di Samping Judul -->
                <div class="shrink-0">
                    <a href="{{ route('packages.index') }}" class="inline-flex items-center justify-center gap-2 w-full sm:w-auto px-5 py-2.5 rounded-full border border-stone-300 dark:border-stone-700 hover:border-stone-900 dark:hover:border-stone-200 bg-white dark:bg-stone-900 hover:bg-stone-900 hover:text-white dark:hover:bg-stone-100 dark:hover:text-stone-900 text-stone-800 dark:text-stone-200 text-xs font-semibold transition-all whitespace-nowrap shadow-xs group" title="Buka Halaman Lengkap Paket Wisata">
                        <span data-i18n="pkgHeaderBtn">Lihat Seluruh Paket Wisata</span>
                        <i class="fa-solid fa-arrow-right text-[10px] group-hover:translate-x-1 transition-transform"></i>
                    </a>
                </div>
            </div>

            <!-- Packages Grid -->
            <div id="packagesGrid" class="grid grid-cols-1 lg:grid-cols-3 gap-5 sm:gap-8">
                @foreach($packages as $idx => $pkg)
                    <div 
                        onclick="selectPackageCard(this, event)"
                        class="package-card group bg-white dark:bg-stone-900 rounded-3xl border-2 {{ $idx === 0 ? 'border-stone-900 dark:border-stone-100 ring-2 ring-stone-900/10 dark:ring-stone-100/10 -translate-y-1 shadow-xl is-active' : 'border-stone-200 dark:border-stone-800 hover:border-stone-300 dark:hover:border-stone-700 shadow-xs translate-y-0' }} p-7 flex flex-col justify-between transition-all duration-300 cursor-pointer"
                    >
                        <div>
                            <div class="flex items-center justify-between gap-2 mb-4">
                                <span class="package-badge px-2.5 py-0.5 rounded-full {{ $idx === 0 ? 'bg-stone-900 text-white dark:bg-white dark:text-stone-900' : 'bg-stone-100 dark:bg-stone-800 text-stone-700 dark:text-stone-300' }} text-[11px] font-semibold tracking-wide transition-all duration-300">
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

                            <!-- Price Card -->
                            <div class="my-6 p-4 rounded-2xl bg-stone-50 dark:bg-stone-800/60 border border-stone-200/60 dark:border-stone-700/60">
                                @if($pkg->formatted_original_price)
                                    <span class="text-xs text-stone-400 line-through block">{{ $pkg->formatted_original_price }}</span>
                                @endif
                                <div class="flex items-baseline gap-1 mt-0.5">
                                    <span class="font-serif text-2xl sm:text-3xl font-bold text-stone-950 dark:text-white">{{ $pkg->formatted_price }}</span>
                                    <span data-i18n="cardPerPerson" class="text-xs text-stone-400">/ tamu</span>
                                </div>
                            </div>

                            <span data-i18n="pkgIncluded" class="text-[11px] font-bold uppercase tracking-wider text-stone-400 block mb-2.5">Sudah Termasuk:</span>
                            <ul class="space-y-2 text-xs text-stone-600 dark:text-stone-300 mb-8">
                                @foreach($pkg->facilities ?? [] as $f)
                                    <li class="flex items-start gap-2">
                                        <i class="fa-solid fa-check text-stone-900 dark:text-stone-100 mt-0.5 shrink-0 text-xs"></i>
                                        <span class="leading-relaxed">{{ $f }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="space-y-2 pt-2">
                            <button 
                                type="button"
                                onclick="selectPackageCard(this, event); openBookingModal('{{ addslashes($pkg->name) }}');" 
                                class="package-btn w-full py-3 px-5 rounded-full {{ $idx === 0 ? 'bg-stone-900 text-white dark:bg-stone-100 dark:text-stone-900 shadow-md' : 'border border-stone-300 dark:border-stone-700 hover:bg-stone-100 dark:hover:bg-stone-800 text-stone-800 dark:text-stone-200 bg-transparent' }} font-semibold text-xs tracking-wide transition-all duration-300 flex items-center justify-center gap-1.5"
                            >
                                <span data-i18n="pkgSelectBtn">Pilih Paket Ini</span>
                                <i class="fa-solid fa-arrow-right text-[10px]"></i>
                            </button>
                            <a href="{{ route('packages.show', $pkg->slug) }}" class="block text-center text-xs text-stone-500 hover:text-stone-950 dark:hover:text-stone-100 transition-colors py-1">
                                <span data-i18n="pkgSeeMore">Lihat Selengkapnya</span> <i class="fa-solid fa-arrow-up-right-from-square text-[9px] ml-1"></i>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- ================= 4. FILOSOFI PERJALANAN (HUMAN & NATURAL STORIES) ================= -->
    <section id="cerita" class="py-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            <!-- Left Photo Canvas -->
            <div class="lg:col-span-5 relative">
                <div class="rounded-3xl overflow-hidden shadow-md border border-stone-200 dark:border-stone-800">
                    <img 
                        src="https://images.unsplash.com/photo-1537996194471-e657df975ab4?auto=format&fit=crop&w=1000&q=80" 
                        alt="Kehangatan Warga Lokal Indonesia" 
                        class="w-full h-[420px] object-cover"
                    >
                    <div class="p-5 bg-white dark:bg-stone-900 border-t border-stone-200/80 dark:border-stone-800">
                        <p data-i18n="storyQuote" class="font-serif italic text-sm text-stone-700 dark:text-stone-300 leading-relaxed">
                            "Pariwisata yang baik bukan sekadar meninggalkan jejak langkah, melainkan membawa pulang rasa hormat pada tanah dan manusianya."
                        </p>
                        <span data-i18n="storyPrinciple" class="block text-[11px] text-stone-400 mt-2">— Prinsip Perjalanan DANWISATA</span>
                    </div>
                </div>
            </div>

            <!-- Right Story Content -->
            <div class="lg:col-span-7 space-y-6">
                <div>
                    <span data-i18n="storySubtitle" class="text-xs font-semibold text-stone-500 uppercase tracking-wider block mb-1">
                        Kenapa Berkelana Bersama Kami?
                    </span>
                    <h2 data-i18n="storyTitle" class="font-serif text-3xl sm:text-4xl font-normal text-stone-950 dark:text-white tracking-tight leading-tight">
                        Sebuah Perjalanan yang Bernapas, Menghargai Waktu & Warga Lokal
                    </h2>
                </div>

                <p data-i18n="storyDesc" class="text-stone-600 dark:text-stone-400 text-xs sm:text-sm leading-relaxed">
                    Kami mendirikan DANWISATA sebagai portal pariwisata Indonesia untuk menghadirkan rute perjalanan yang autentik, menghormati alam, dan mendekatkan Anda dengan kehangatan warga lokal.
                </p>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 pt-2">
                    <div class="p-4 rounded-2xl bg-stone-50 dark:bg-stone-900 border border-stone-200/70 dark:border-stone-800">
                        <div class="w-8 h-8 rounded-lg bg-stone-200 dark:bg-stone-800 flex items-center justify-center text-stone-800 dark:text-stone-200 text-xs mb-3">
                            <i class="fa-solid fa-anchor"></i>
                        </div>
                        <h3 class="font-serif font-semibold text-sm text-stone-900 dark:text-white mb-1">Kapten & Pemandu Lokal Asli</h3>
                        <p class="text-xs text-stone-500 leading-relaxed">
                            Didampingi kapten kapal Phinisi dan pemandu warga setempat yang mengenal arus laut, cuaca, dan spot sepi.
                        </p>
                    </div>

                    <div class="p-4 rounded-2xl bg-stone-50 dark:bg-stone-900 border border-stone-200/70 dark:border-stone-800">
                        <div class="w-8 h-8 rounded-lg bg-stone-200 dark:bg-stone-800 flex items-center justify-center text-stone-800 dark:text-stone-200 text-xs mb-3">
                            <i class="fa-solid fa-scale-balanced"></i>
                        </div>
                        <h3 class="font-serif font-semibold text-sm text-stone-900 dark:text-white mb-1">Bagi Hasil yang Adil</h3>
                        <p class="text-xs text-stone-500 leading-relaxed">
                            Sebagian besar biaya tur langsung diterima keluarga nelayan, pemilik homestay, dan pengrajin lokal di desa.
                        </p>
                    </div>

                    <div class="p-4 rounded-2xl bg-stone-50 dark:bg-stone-900 border border-stone-200/70 dark:border-stone-800">
                        <div class="w-8 h-8 rounded-lg bg-stone-200 dark:bg-stone-800 flex items-center justify-center text-stone-800 dark:text-stone-200 text-xs mb-3">
                            <i class="fa-solid fa-camera"></i>
                        </div>
                        <h3 class="font-serif font-semibold text-sm text-stone-900 dark:text-white mb-1">Dokumentasi Hangat Bersahaja</h3>
                        <p class="text-xs text-stone-500 leading-relaxed">
                            Fotografer lokal kami mengambil momen candid natural Anda tanpa pose kaku, sehingga Anda bebas menikmati suasana.
                        </p>
                    </div>

                    <div class="p-4 rounded-2xl bg-stone-50 dark:bg-stone-900 border border-stone-200/70 dark:border-stone-800">
                        <div class="w-8 h-8 rounded-lg bg-stone-200 dark:bg-stone-800 flex items-center justify-center text-stone-800 dark:text-stone-200 text-xs mb-3">
                            <i class="fa-solid fa-comments"></i>
                        </div>
                        <h3 class="font-serif font-semibold text-sm text-stone-900 dark:text-white mb-1">Konsultasi Nyaman Tanpa Tekanan</h3>
                        <p class="text-xs text-stone-500 leading-relaxed">
                            Bebas bertanya rute, opsi bawa anak/orang tua, atau request menu makanan lewat WhatsApp kapan pun.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ================= 5. GALERI MIKRO-DOKUMENTASI ================= -->
    <section id="galeri" class="py-12 sm:py-20 bg-stone-100/70 dark:bg-stone-900 border-t border-stone-200/80 dark:border-stone-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col sm:flex-row sm:items-end justify-between mb-8 sm:mb-10 gap-3">
                <div>
                    <span data-i18n="gallerySubtitle" class="text-xs font-semibold text-stone-500 uppercase tracking-wider block mb-1">Lensa Perjalanan</span>
                    <h2 data-i18n="galleryTitle" class="font-serif text-2xl sm:text-3xl font-normal text-stone-950 dark:text-white">
                        Momen-Momen yang Tertangkap
                    </h2>
                </div>
                <p data-i18n="galleryDesc" class="text-xs text-stone-500 max-w-sm">
                    Klik pada foto untuk melihat catatan lokasi dan suasana perjalanan saat kamera merekamnya.
                </p>
            </div>

            <div id="galleryGrid" class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-4 gap-2.5 sm:gap-5">
                @foreach($gallery as $item)
                    <div onclick="openLightbox('{{ $item->image_url }}', '{{ addslashes($item->title) }}', '{{ addslashes($item->sub_title) }}')" class="group relative h-44 sm:h-64 rounded-xl sm:rounded-2xl overflow-hidden cursor-pointer bg-stone-200 dark:bg-stone-800 active:scale-95 transition-transform">
                        <img 
                            src="{{ $item->image_url }}" 
                            alt="{{ $item->title }}" 
                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                        >
                        <div class="absolute inset-0 bg-stone-950/40 opacity-0 group-hover:opacity-100 transition-opacity flex flex-col justify-end p-3 sm:p-4 text-white">
                            <span class="text-xs font-serif font-semibold truncate">{{ $item->title }}</span>
                            <span class="text-[10px] sm:text-[11px] text-stone-300 mt-0.5 truncate">{{ $item->sub_title }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- ================= 6. TESTIMONI CATATAN TAMU ================= -->
    <section id="testimoni" class="py-12 sm:py-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-2xl mx-auto mb-8 sm:mb-12">
            <span data-i18n="testiSubtitle" class="text-xs font-semibold text-stone-500 uppercase tracking-wider block mb-1">
                Catatan Tamu
            </span>
            <h2 data-i18n="testiTitle" class="font-serif text-2xl sm:text-4xl font-normal text-stone-950 dark:text-white">
                Cerita dari Mereka yang Pernah Ikut
            </h2>
            <p data-i18n="testiDesc" class="mt-2 text-stone-600 dark:text-stone-400 text-xs sm:text-sm">
                Bukan ulasan palsu atau bintang buatan. Ini adalah pesan nyata yang kami terima dari teman-teman yang telah pulang dengan hati gembira.
            </p>
        </div>

        <div id="testimonialGrid" class="grid grid-cols-1 md:grid-cols-3 gap-4 sm:gap-6">
            @foreach($testimonials as $t)
                <div class="p-5 sm:p-6 rounded-2xl sm:rounded-3xl bg-white dark:bg-stone-900 border border-stone-200 dark:border-stone-800 shadow-xs flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between mb-3.5">
                            <span class="text-amber-400 text-xs flex gap-0.5">
                                @for($i = 0; $i < $t->rating; $i++)
                                    <i class="fa-solid fa-star text-[11px]"></i>
                                @endfor
                            </span>
                            <span class="px-2.5 py-0.5 rounded-full bg-stone-100 dark:bg-stone-800 text-stone-600 dark:text-stone-300 text-[10px] font-medium">
                                {{ $t->trip }}
                            </span>
                        </div>
                        <p class="text-stone-600 dark:text-stone-300 text-xs sm:text-sm leading-relaxed italic">
                            "{{ $t->comment }}"
                        </p>
                    </div>

                    <div class="flex items-center gap-3 mt-5 pt-3.5 border-t border-stone-100 dark:border-stone-800">
                        <img 
                            src="{{ $t->avatar }}" 
                            alt="{{ $t->name }}" 
                            class="w-9 sm:w-10 h-9 sm:h-10 rounded-full object-cover shrink-0"
                        >
                        <div>
                            <h4 class="font-semibold text-xs text-stone-900 dark:text-white">{{ $t->name }}</h4>
                            <p class="text-[11px] text-stone-400">{{ $t->role }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Banner Bersahabat -->
        <div class="mt-10 sm:mt-14 rounded-2xl sm:rounded-3xl bg-stone-900 text-white p-6 sm:p-10 flex flex-col sm:flex-row items-center justify-between gap-6 shadow-sm">
            <div class="max-w-xl text-center sm:text-left">
                <span data-i18n="promoHeader" class="text-[10px] sm:text-[11px] uppercase tracking-wider text-stone-400 font-medium">Rencana Liburan Bareng Sahabat atau Keluarga?</span>
                <h3 data-i18n="promoTitle" class="font-serif text-xl sm:text-2xl font-normal mt-1.5">
                    Gunakan Kode Voucher <span class="underline decoration-stone-500 font-mono text-amber-200">PESONAID</span> untuk Diskon 15%
                </h3>
                <p data-i18n="promoDesc" class="text-stone-400 text-xs mt-1 leading-relaxed">
                    Berlaku untuk simulasi dan pemesanan seluruh rute private tour dan open trip kami bulan ini.
                </p>
            </div>
            <div class="flex flex-col sm:flex-row items-center gap-2.5 sm:gap-3 w-full sm:w-auto shrink-0">
                <button onclick="copyVoucherCode()" data-i18n="promoCopy" class="w-full sm:w-auto px-4 py-2.5 rounded-full border border-stone-700 hover:bg-stone-800 text-xs font-medium transition-colors text-center active:scale-95">
                    Salin Kode
                </button>
                <button onclick="openBookingModal('Sailing Phinisi Labuan Bajo (Private Cabin)')" data-i18n="promoPlan" class="w-full sm:w-auto px-5 py-2.5 rounded-full bg-white text-stone-900 hover:bg-stone-100 text-xs font-semibold shadow-sm transition-all text-center active:scale-95">
                    Rencanakan Trip
                </button>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
<script>
    const destinationsDatabase = @json($allDestinations);
    const bookingOptionsDatabase = @json($bookingOptions);

    let activeCategory = 'Semua';
    let activeRegionFilter = 'Semua';

    function initBookingOptions() {
        const select = document.getElementById('bookItemSelect');
        if (!select) return;

        select.innerHTML = bookingOptionsDatabase.map(opt => `
            <option value="${opt.name}" data-price="${opt.price}">${opt.label}</option>
        `).join('');
    }

    // Comprehensive List of All 28 Distinct Regions Across Indonesia
    const INDONESIA_REGIONS = [
        { id: 'Semua', name: 'Semua Wilayah Nusantara', en: 'All Indonesian Archipelago', icon: 'fa-earth-asia', sub: 'Seluruh 38 Provinsi & 17.000+ Pulau', keywords: 'semua all indonesia nusantara' },
        { id: 'Bali', name: 'Bali', en: 'Bali Island', icon: 'fa-umbrella-beach', sub: 'Nusa Penida, Ubud, Kuta, Uluwatu, Kintamani', keywords: 'bali nusa penida ubud kuta kelingking sanur canggu' },
        { id: 'Lombok', name: 'Lombok & NTB', en: 'Lombok & West Nusa Tenggara', icon: 'fa-volcano', sub: 'Gunung Rinjani, Gili Trawangan, Mandalika, Sumbawa', keywords: 'lombok ntb nusa tenggara barat rinjani gili mandalika sumbawa segara anak' },
        { id: 'Labuan Bajo', name: 'Labuan Bajo & Flores (NTT)', en: 'Labuan Bajo & Flores (NTT)', icon: 'fa-ship', sub: 'Taman Nasional Komodo, Pulau Padar, Wae Rebo', keywords: 'labuan bajo flores ntt komodo padar wae rebo nusa tenggara timur phinisi' },
        { id: 'Sumba', name: 'Sumba (NTT)', en: 'Sumba Island (NTT)', icon: 'fa-mountain-sun', sub: 'Bukit Wairinding, Savana Puru Kambera, Danau Weekuri', keywords: 'sumba wairinding puru kambera weekuri ntt nusa tenggara timur' },
        { id: 'Yogyakarta', name: 'D.I. Yogyakarta & Solo', en: 'Yogyakarta & Solo', icon: 'fa-landmark', sub: 'Malioboro, Kraton, Candi Prambanan, Kaliurang', keywords: 'jogja yogyakarta solo diy malioboro prambanan kraton' },
        { id: 'Jawa Tengah', name: 'Jawa Tengah', en: 'Central Java', icon: 'fa-place-of-worship', sub: 'Candi Borobudur, Dataran Tinggi Dieng, Karimunjawa', keywords: 'jawa tengah borobudur dieng karimunjawa magelang wonosobo jepara semarang' },
        { id: 'Jawa Timur', name: 'Jawa Timur', en: 'East Java', icon: 'fa-mountain', sub: 'Kaldera Bromo, Kawah Ijen, Malang, Banyuwangi', keywords: 'jawa timur jatim bromo ijen banyuwangi malang surabaya semeru' },
        { id: 'Jawa Barat', name: 'Jawa Barat & Banten', en: 'West Java & Banten', icon: 'fa-tree', sub: 'Bandung, Puncak, Kawah Putih, Ujung Kulon', keywords: 'jawa barat jabar bandung banten bogor ujung kulon ciletuh' },
        { id: 'Jakarta', name: 'DKI Jakarta & Kep. Seribu', en: 'Jakarta & Thousand Islands', icon: 'fa-city', sub: 'Kota Tua, Monas, Pulau Macan, Pulau Pari', keywords: 'jakarta dki kepulauan seribu kota tua monas' },
        { id: 'Sumatera Utara', name: 'Sumatera Utara', en: 'North Sumatra', icon: 'fa-water', sub: 'Danau Toba, Pulau Samosir, Lembah Bakkara, Medan', keywords: 'sumatera utara sumut toba samosir medan bakkara berastagi' },
        { id: 'Sumatera Barat', name: 'Sumatera Barat', en: 'West Sumatra', icon: 'fa-mountain-city', sub: 'Lembah Harau, Bukittinggi, Ngarai Sianok, Padang', keywords: 'sumatera barat sumbar harau bukittinggi sianok padang mandeh' },
        { id: 'Aceh', name: 'Aceh & Pulau Weh', en: 'Aceh & Weh Island', icon: 'fa-compass', sub: 'Sabang, Titik 0 KM, Pantai Iboih, Banda Aceh', keywords: 'aceh sabang weh iboih nol kilometer sumatera' },
        { id: 'Bangka Belitung', name: 'Bangka Belitung', en: 'Bangka Belitung Islands', icon: 'fa-gem', sub: 'Pantai Tanjung Tinggi, Belitung, Pulau Lengkuas', keywords: 'bangka belitung babel tanjung tinggi lengkuas laskar pelangi' },
        { id: 'Riau & Kepri', name: 'Kepulauan Riau & Riau', en: 'Riau & Riau Islands', icon: 'fa-anchor', sub: 'Pulau Bintan, Batam, Natuna, Kepulauan Anambas', keywords: 'kepri riau bintan batam natuna anambas' },
        { id: 'Sumatera Selatan & Lampung', name: 'Sumatera Selatan & Lampung', en: 'South Sumatra & Lampung', icon: 'fa-sun', sub: 'Palembang, Jembatan Ampera, TN Way Kambas, Pahawang', keywords: 'sumatera selatan lampung palembang way kambas pahawang' },
        { id: 'Kalimantan Timur', name: 'Kalimantan Timur', en: 'East Kalimantan', icon: 'fa-fish-fins', sub: 'Kepulauan Derawan, Pulau Maratua, Danau Kakaban, Berau', keywords: 'kalimantan timur kaltim derawan maratua kakaban berau ikn samarinda' },
        { id: 'Kalimantan Tengah', name: 'Kalimantan Tengah', en: 'Central Kalimantan', icon: 'fa-leaf', sub: 'TN Tanjung Puting, Sungai Sekonyer, Camp Leakey', keywords: 'kalimantan tengah kalteng tanjung puting sekonyer orangutan pangkalan bun' },
        { id: 'Kalimantan Barat & Selatan', name: 'Kalimantan Barat & Selatan', en: 'West & South Kalimantan', icon: 'fa-person-boating', sub: 'Pasar Terapung Lok Baintan, Singkawang, Pontianak', keywords: 'kalimantan barat kalbar kalsel banjarmasin pontianak singkawang' },
        { id: 'Sulawesi Selatan', name: 'Sulawesi Selatan', en: 'South Sulawesi', icon: 'fa-house-chimney', sub: 'Tana Toraja, Lolai Negeri di Atas Awan, Makassar, Bira', keywords: 'sulawesi selatan sulsel toraja lolai makassar bira tanjung bira' },
        { id: 'Sulawesi Utara', name: 'Sulawesi Utara', en: 'North Sulawesi', icon: 'fa-mask-snorkel', sub: 'Taman Nasional Bunaken, Manado, Likupang, Siladen', keywords: 'sulawesi utara sulut bunaken manado likupang siladen bunaken' },
        { id: 'Sulawesi Tenggara & Tengah', name: 'Sulawesi Tenggara & Tengah', en: 'Southeast & Central Sulawesi', icon: 'fa-water', sub: 'Taman Nasional Wakatobi, Labengki, Sombori, Kep. Togean', keywords: 'sulawesi tenggara sultra wakatobi labengki togean sombori bau-bau kendari' },
        { id: 'Maluku', name: 'Kepulauan Maluku & Banda Neira', en: 'Maluku & Banda Neira', icon: 'fa-monument', sub: 'Banda Neira, Benteng Belgica, Gunung Api Banda, Ambon', keywords: 'maluku banda neira belgica ambon pala rempah' },
        { id: 'Maluku Tenggara', name: 'Maluku Tenggara & Kei', en: 'Southeast Maluku & Kei Islands', icon: 'fa-feather', sub: 'Pantai Ngurbloat Pasir Halus, Pulau Bair, Tual', keywords: 'maluku tenggara kei ngurbloat pasir putih tual' },
        { id: 'Maluku Utara', name: 'Maluku Utara', en: 'North Maluku', icon: 'fa-volcano', sub: 'Ternate, Tidore, Pulau Morotai, Halmahera', keywords: 'maluku utara malut ternate tidore morotai halmahera' },
        { id: 'Papua Barat Daya', name: 'Papua Barat & Raja Ampat', en: 'West Papua & Raja Ampat', icon: 'fa-crown', sub: 'Kepulauan Wayag, Piaynemo, Misool, Sorong', keywords: 'papua barat daya raja ampat wayag piaynemo misool sorong' },
        { id: 'Papua Pegunungan', name: 'Papua Pegunungan & Lembah Baliem', en: 'Highland Papua & Baliem Valley', icon: 'fa-campground', sub: 'Lembah Baliem, Wamena, Suku Dani', keywords: 'papua pegunungan baliem wamena dani papua' },
        { id: 'Papua & Papua Tengah', name: 'Papua & Papua Tengah', en: 'Papua & Central Papua', icon: 'fa-dove', sub: 'Danau Sentani, Jayapura, Teluk Cenderawasih', keywords: 'papua sentani jayapura cenderawasih timika nabire' }
    ];

    function renderLocationDropdown(filterText = '') {
        const container = document.getElementById('locationOptionsContainer');
        const badge = document.getElementById('locationCountBadge');
        if (!container) return;

        const isEnglish = (typeof currentLang !== 'undefined' && currentLang === 'en');
        const query = filterText.toLowerCase().trim();

        const filtered = INDONESIA_REGIONS.filter(item => {
            if (!query) return true;
            return item.name.toLowerCase().includes(query) ||
                   item.en.toLowerCase().includes(query) ||
                   item.sub.toLowerCase().includes(query) ||
                   item.keywords.toLowerCase().includes(query);
        });

        if (badge) {
            badge.textContent = `${filtered.length} ${isEnglish ? 'Regions' : 'Wilayah'}`;
        }

        if (filtered.length === 0) {
            const noMatchMsg = (typeof i18nDictionary !== 'undefined' && i18nDictionary[currentLang] && i18nDictionary[currentLang].heroLocNoMatch) 
                ? i18nDictionary[currentLang].heroLocNoMatch 
                : 'Tidak ada wilayah yang cocok dengan';
            const showAllText = (typeof i18nDictionary !== 'undefined' && i18nDictionary[currentLang] && i18nDictionary[currentLang].heroLocShowAll) 
                ? i18nDictionary[currentLang].heroLocShowAll 
                : 'Tampilkan Semua Wilayah';

            container.innerHTML = `
                <div class="p-3.5 text-center text-xs text-stone-500">
                    <p>${noMatchMsg} "<strong>${filterText}</strong>"</p>
                    <button type="button" onclick="clearLocationInput(event)" class="mt-2 text-[11px] font-semibold text-stone-900 dark:text-stone-100 underline hover:opacity-80">
                        ${showAllText}
                    </button>
                </div>
            `;
            return;
        }

        container.innerHTML = filtered.map(item => {
            const title = isEnglish ? item.en : item.name;
            const safeName = item.id === 'Semua' ? '' : title.replace(/'/g, "\\'");
            return `
                <div 
                    onclick="selectLocationItem('${safeName}', '${item.id}')"
                    class="p-2 sm:p-2.5 rounded-xl hover:bg-stone-100 dark:hover:bg-stone-800 transition-colors cursor-pointer flex items-start gap-2.5 group"
                >
                    <div class="w-7 h-7 rounded-lg bg-stone-100 dark:bg-stone-800 text-stone-700 dark:text-stone-300 flex items-center justify-center shrink-0 mt-0.5 group-hover:bg-stone-900 group-hover:text-white dark:group-hover:bg-white dark:group-hover:text-stone-900 transition-colors">
                        <i class="fa-solid ${item.icon} text-xs"></i>
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="flex items-center justify-between">
                            <h4 class="text-xs font-semibold text-stone-900 dark:text-white truncate group-hover:text-stone-950 dark:group-hover:text-stone-100">${title}</h4>
                            ${item.id === 'Semua' ? '<span class="text-[9px] px-1.5 py-0.5 rounded bg-amber-100 dark:bg-amber-900/40 text-amber-800 dark:text-amber-300 font-semibold uppercase">Semua</span>' : ''}
                        </div>
                        <p class="text-[10px] text-stone-500 dark:text-stone-400 truncate mt-0.5">${item.sub}</p>
                    </div>
                </div>
            `;
        }).join('');
    }

    function openLocationDropdown() {
        const list = document.getElementById('locationDropdownList');
        const chevron = document.getElementById('locationDropdownChevron');
        const input = document.getElementById('searchLocationInput');
        if (!list) return;

        renderLocationDropdown(input ? input.value : '');
        list.classList.remove('hidden');
        if (chevron) chevron.style.transform = 'rotate(180deg)';
    }

    function closeLocationDropdown() {
        const list = document.getElementById('locationDropdownList');
        const chevron = document.getElementById('locationDropdownChevron');
        if (!list) return;

        list.classList.add('hidden');
        if (chevron) chevron.style.transform = 'rotate(0deg)';
    }

    function toggleLocationDropdown(e) {
        if (e) e.stopPropagation();
        const list = document.getElementById('locationDropdownList');
        if (list && list.classList.contains('hidden')) {
            openLocationDropdown();
            const input = document.getElementById('searchLocationInput');
            if (input) input.focus();
        } else {
            closeLocationDropdown();
        }
    }

    function handleLocationInput(e) {
        const val = e.target.value;
        const clearBtn = document.getElementById('clearLocationBtn');
        if (clearBtn) {
            if (val.trim()) {
                clearBtn.classList.remove('hidden');
                clearBtn.classList.add('flex');
            } else {
                clearBtn.classList.add('hidden');
                clearBtn.classList.remove('flex');
            }
        }
        openLocationDropdown();
    }

    function handleLocationKeydown(e) {
        if (e.key === 'Escape') {
            closeLocationDropdown();
        } else if (e.key === 'Enter') {
            closeLocationDropdown();
        }
    }

    function selectLocationItem(displayName, regionId) {
        const input = document.getElementById('searchLocationInput');
        const hiddenInput = document.getElementById('searchLocation');
        const clearBtn = document.getElementById('clearLocationBtn');

        if (input) {
            input.value = displayName;
        }
        if (hiddenInput) {
            hiddenInput.value = regionId;
        }
        if (clearBtn) {
            if (displayName) {
                clearBtn.classList.remove('hidden');
                clearBtn.classList.add('flex');
            } else {
                clearBtn.classList.add('hidden');
                clearBtn.classList.remove('flex');
            }
        }
        closeLocationDropdown();
    }

    function clearLocationInput(e) {
        if (e) e.stopPropagation();
        const input = document.getElementById('searchLocationInput');
        const hiddenInput = document.getElementById('searchLocation');
        const clearBtn = document.getElementById('clearLocationBtn');

        if (input) {
            input.value = '';
            input.focus();
        }
        if (hiddenInput) {
            hiddenInput.value = '';
        }
        if (clearBtn) {
            clearBtn.classList.add('hidden');
            clearBtn.classList.remove('flex');
        }
        renderLocationDropdown('');
    }

    function renderDestinationsGrid() {
        const grid = document.getElementById('destinationsGrid');
        if (!grid) return;
        const kwElem = document.getElementById('destinationKeyword');
        const keyword = kwElem ? kwElem.value.toLowerCase().trim() : '';
        const sortElem = document.getElementById('destinationSort');
        const sortBy = sortElem ? sortElem.value : 'popular';

        let filtered = destinationsDatabase.filter(item => {
            const matchCategory = activeCategory === 'Semua' || item.category === activeCategory;
            
            let matchRegion = false;
            if (!activeRegionFilter || activeRegionFilter === 'Semua' || activeRegionFilter === 'Semua Wilayah Nusantara' || activeRegionFilter === 'All Indonesian Archipelago') {
                matchRegion = true;
            } else {
                const q = activeRegionFilter.toLowerCase().trim();
                matchRegion = item.name.toLowerCase().includes(q) || 
                              item.location.toLowerCase().includes(q) ||
                              item.region.toLowerCase().includes(q) ||
                              (item.description && item.description.toLowerCase().includes(q));

                if (!matchRegion) {
                    const words = q.split(/[\s,&()/-]+/).filter(w => w.length > 2);
                    matchRegion = words.some(word => 
                        item.name.toLowerCase().includes(word) ||
                        item.location.toLowerCase().includes(word) ||
                        item.region.toLowerCase().includes(word)
                    );
                }
            }

            const matchKeyword = item.name.toLowerCase().includes(keyword) || 
                                 item.location.toLowerCase().includes(keyword) ||
                                 (item.description && item.description.toLowerCase().includes(keyword));
            return matchCategory && matchRegion && matchKeyword;
        });

        if (sortBy === 'price-asc') filtered.sort((a, b) => a.price - b.price);
        if (sortBy === 'price-desc') filtered.sort((a, b) => b.price - a.price);
        if (sortBy === 'rating') filtered.sort((a, b) => b.rating - a.rating);
        if (sortBy === 'popular') filtered.sort((a, b) => b.reviews_count - a.reviews_count);

        if (filtered.length === 0) {
            grid.innerHTML = `
                <div class="col-span-full py-14 text-center bg-white dark:bg-stone-900 rounded-3xl border border-stone-200 dark:border-stone-800 p-8">
                    <p class="text-sm font-serif text-stone-800 dark:text-stone-200">Belum ada rute yang cocok dengan pencarian Anda</p>
                    <p class="text-xs text-stone-400 mt-1 mb-4">Coba atur ulang kata kunci atau lihat seluruh destinasi.</p>
                    <button onclick="resetAllFilters()" class="px-4 py-2 rounded-full bg-stone-900 text-white text-xs font-semibold">Tampilkan Semua</button>
                </div>
            `;
            return;
        }

        grid.innerHTML = filtered.map(dest => {
            const isLiked = savedWishlist.has(dest.id);
            const safeName = dest.name.replace(/'/g, "\\'");
            return `
                <article onclick="openDetailModal(${dest.id})" class="group bg-white dark:bg-stone-900 rounded-2xl sm:rounded-3xl overflow-hidden border border-stone-200/90 dark:border-stone-800 hover:border-stone-400 dark:hover:border-stone-600 hover:shadow-xl transition-all duration-300 flex flex-col cursor-pointer">
                    <div class="relative h-56 sm:h-64 overflow-hidden bg-stone-100">
                        <img 
                            src="${dest.image}" 
                            onerror="this.src='https://placehold.co/600x400/262019/ffffff?text=${encodeURIComponent(dest.name)}'"
                            alt="${dest.name}" 
                            class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                        >
                        <div class="absolute inset-0 bg-gradient-to-t from-stone-950/70 via-transparent to-transparent"></div>
                        
                        <span class="absolute top-4 left-4 px-2.5 py-0.5 rounded-full bg-white/90 dark:bg-stone-900/90 text-stone-800 dark:text-stone-200 text-[11px] font-medium tracking-wide shadow-xs">
                            ${dest.category}
                        </span>

                        <button onclick="event.stopPropagation(); toggleWishlist(${dest.id}, '${safeName}')" class="wishlist-btn absolute top-4 right-4 w-8 h-8 rounded-full bg-white/90 dark:bg-stone-900/90 text-stone-600 dark:text-stone-300 flex items-center justify-center hover:scale-110 transition-transform shadow-xs" data-id="${dest.id}" title="Simpan ke Jurnal">
                            <i class="${isLiked ? 'fa-solid text-stone-900 dark:text-white' : 'fa-regular'} text-xs fa-heart"></i>
                        </button>

                        <div class="absolute bottom-3 left-4 right-4 flex items-center justify-between text-white text-xs">
                            <span class="truncate pr-2 font-medium flex items-center gap-1.5 text-stone-200">
                                <i class="fa-solid fa-location-dot text-[11px]"></i>
                                ${dest.location}
                            </span>
                            <span class="text-[11px] text-amber-300 flex items-center gap-1 font-semibold shrink-0">
                                <i class="fa-solid fa-star text-[10px]"></i> ${Number(dest.rating).toFixed(2)}
                            </span>
                        </div>
                    </div>

                    <div class="p-5 sm:p-6 flex-1 flex flex-col justify-between">
                        <div>
                            <div class="flex items-center gap-2 text-[11px] text-stone-400 mb-1.5">
                                <span><i class="fa-regular fa-clock mr-1"></i> ${dest.duration}</span>
                                <span>•</span>
                                <span>${dest.reviews_count} catatan</span>
                            </div>
                            <h3 class="font-serif text-xl font-semibold text-stone-900 dark:text-white group-hover:text-stone-600 dark:group-hover:text-stone-300 transition-colors leading-snug">
                                ${dest.name}
                            </h3>
                            <p class="mt-2 text-xs text-stone-600 dark:text-stone-400 line-clamp-2 leading-relaxed">
                                ${dest.description}
                            </p>
                        </div>

                        <div class="mt-6 pt-4 border-t border-stone-100 dark:border-stone-800 flex items-center justify-between gap-2">
                            <div>
                                <span data-i18n="cardStartingFrom" class="text-[10px] text-stone-400 uppercase tracking-wider block">${(i18nDictionary[currentLang] && i18nDictionary[currentLang].cardStartingFrom) ? i18nDictionary[currentLang].cardStartingFrom : 'Mulai dari'}</span>
                                <p class="text-base font-serif font-bold text-stone-900 dark:text-white">${formatRupiah(dest.price)}<span data-i18n="cardPerPerson" class="text-[11px] font-sans font-normal text-stone-400">${(i18nDictionary[currentLang] && i18nDictionary[currentLang].cardPerPerson) ? i18nDictionary[currentLang].cardPerPerson : '/org'}</span></p>
                            </div>
                            <span data-i18n="cardRouteNotes" class="px-4 py-2 rounded-full border border-stone-200 dark:border-stone-700 group-hover:bg-stone-900 group-hover:text-white dark:group-hover:bg-stone-100 dark:group-hover:text-stone-900 text-stone-800 dark:text-stone-200 text-xs font-semibold transition-all">
                                ${(i18nDictionary[currentLang] && i18nDictionary[currentLang].cardRouteNotes) ? i18nDictionary[currentLang].cardRouteNotes : 'Catatan Rute'}
                            </span>
                        </div>
                    </div>
                </article>
            `;
        }).join('');
    }

    function filterAndRenderDestinations() {
        renderDestinationsGrid();
    }

    function setCategory(cat) {
        activeCategory = cat;
        document.querySelectorAll('.cat-btn').forEach(btn => {
            if (btn.dataset.cat === cat) {
                btn.className = "cat-btn px-4 py-2 rounded-full font-semibold transition-all whitespace-nowrap bg-stone-900 text-white dark:bg-white dark:text-stone-900 shadow-sm";
            } else {
                btn.className = "cat-btn px-4 py-2 rounded-full font-medium transition-all whitespace-nowrap bg-stone-100 dark:bg-stone-900 text-stone-700 dark:text-stone-300 border border-stone-200/80 dark:border-stone-800 hover:border-stone-400";
            }
        });
        renderDestinationsGrid();
    }

    function quickFilter(cat) {
        setCategory(cat);
        document.getElementById('destinasi').scrollIntoView({ behavior: 'smooth' });
        showToast(`Menampilkan kategori ${cat}`, 'info');
    }

    function resetAllFilters() {
        activeCategory = 'Semua';
        activeRegionFilter = 'Semua';
        const kw = document.getElementById('destinationKeyword');
        if (kw) kw.value = '';
        const locInput = document.getElementById('searchLocationInput');
        if (locInput) locInput.value = '';
        const clearBtn = document.getElementById('clearLocationBtn');
        if (clearBtn) {
            clearBtn.classList.add('hidden');
            clearBtn.classList.remove('flex');
        }
        setCategory('Semua');
    }

    function handleHeroSearch(e) {
        e.preventDefault();
        closeLocationDropdown();

        const inputLoc = document.getElementById('searchLocationInput');
        const hiddenLoc = document.getElementById('searchLocation');
        const loc = (inputLoc ? inputLoc.value.trim() : '') || (hiddenLoc ? hiddenLoc.value.trim() : '');
        const date = document.getElementById('searchDate').value;
        const pax = document.getElementById('searchPax').value;

        activeRegionFilter = loc || 'Semua';
        setCategory('Semua');

        if (document.getElementById('bookDate')) document.getElementById('bookDate').value = date;
        if (document.getElementById('bookPax')) document.getElementById('bookPax').value = pax;

        document.getElementById('destinasi').scrollIntoView({ behavior: 'smooth' });
        showToast(loc ? `Mencari destinasi di ${loc}` : 'Menampilkan seluruh destinasi Nusantara', 'success');
        renderDestinationsGrid();
    }

    document.addEventListener('DOMContentLoaded', () => {
        // Inisialisasi daftar wilayah untuk combobox
        renderLocationDropdown('');

        // Tutup dropdown wilayah saat klik di luar combobox
        document.addEventListener('click', (e) => {
            const wrapper = document.getElementById('locationComboboxWrapper');
            if (wrapper && !wrapper.contains(e.target)) {
                closeLocationDropdown();
            }
        });

        // Pastikan video hero berputar secara otomatis
        const heroVid = document.getElementById('heroVideo');
        if (heroVid) {
            heroVid.muted = true;
            const playPromise = heroVid.play();
            if (playPromise !== undefined) {
                playPromise.catch(() => {
                    // Autoplay with sound or battery saver may defer, play on first user interaction
                    const startPlay = () => {
                        heroVid.play().catch(() => {});
                        window.removeEventListener('click', startPlay);
                        window.removeEventListener('touchstart', startPlay);
                        window.removeEventListener('scroll', startPlay);
                    };
                    window.addEventListener('click', startPlay, { once: true });
                    window.addEventListener('touchstart', startPlay, { once: true });
                    window.addEventListener('scroll', startPlay, { once: true });
                });
            }
        }

        initBookingOptions();

        const searchDate = document.getElementById('searchDate');
        if (searchDate) {
            const nextWeek = new Date();
            nextWeek.setDate(nextWeek.getDate() + 7);
            searchDate.value = nextWeek.toISOString().split('T')[0];
        }

        document.querySelectorAll('.wishlist-btn').forEach(btn => {
            const id = parseInt(btn.dataset.id, 10);
            if (savedWishlist.has(id)) {
                btn.querySelector('i').className = 'fa-solid text-stone-900 dark:text-white fa-heart text-xs';
            }
        });
    });
</script>
@endpush
