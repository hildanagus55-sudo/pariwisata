@extends('layouts.app')

@section('title', 'DANWISATA | Portal Pariwisata Indonesia')
@section('meta_description', 'DANWISATA | Portal Pariwisata Indonesia resmi dan terpercaya. Jelajahi keindahan destinasi wisata alam, budaya nusantara, dan paket liburan impian terbaik.')

@section('content')
    <!-- ================= 2. HERO SECTION & INTERACTIVE SEARCH WIDGET (CINEMATIC PHOTO HERO) ================= -->
    <section id="beranda" class="relative min-h-[88dvh] sm:min-h-[92vh] pt-24 sm:pt-28 pb-14 sm:pb-20 flex items-center justify-center overflow-hidden">
        <!-- Background Video Loop / Playlist -->
        <video 
            id="heroVideo"
            autoplay 
            muted 
            playsinline 
            preload="auto"
            class="absolute inset-0 w-full h-full object-cover object-center scale-105 pointer-events-none transition-opacity duration-700 ease-in-out"
        >
            <source src="{{ asset('images/231170_medium.mp4') }}" type="video/mp4">
            Browser Anda tidak mendukung tag video latar belakang.
        </video>

        <!-- Cinematic Mist & Fog Transition Curtain (Awan & Kabut Menyapu dari Kanan ke Kiri) -->
        <div id="heroMistOverlay" class="absolute inset-0 pointer-events-none z-[2] overflow-hidden">
            <div id="heroMistCurtain" class="mist-sweep-wrapper">
                <div class="absolute inset-0 bg-gradient-to-l from-white/95 via-white/85 to-transparent dark:from-stone-900/95 dark:via-stone-950/85 dark:to-transparent backdrop-blur-md"></div>
                <div class="mist-layer mist-layer-1"></div>
                <div class="mist-layer mist-layer-2"></div>
                <div class="mist-leading-edge"></div>
            </div>
        </div>

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
            <div data-aos="fade-up" data-aos-delay="200" class="max-w-5xl mx-auto bg-white dark:bg-stone-900 rounded-2xl sm:rounded-3xl p-4 sm:p-6 shadow-2xl border border-stone-200/80 dark:border-stone-800">
                <form id="heroSearchForm" onsubmit="handleHeroSearch(event)" class="grid grid-cols-1 md:grid-cols-12 gap-3 sm:gap-4 items-end">
                    <!-- Lokasi Tujuan (Searchable Combobox for 38 Indonesian Provinces) -->
                    <div class="md:col-span-6 lg:col-span-4 relative" id="locationComboboxWrapper">
                        <label for="searchLocationInput" class="block text-[11px] sm:text-xs font-bold uppercase tracking-wider text-stone-500 dark:text-stone-400 mb-1.5 sm:mb-2 flex items-center justify-between">
                            <span>
                                <i class="fa-solid fa-map-location-dot text-amber-600 dark:text-amber-400 mr-1.5"></i>
                                <span data-i18n="heroFieldRegion">Provinsi Tujuan</span>
                            </span>
                            <span class="text-[10px] font-normal normal-case text-stone-400 dark:text-stone-500" data-i18n="heroLocHint">Bisa ketik nama provinsi</span>
                        </label>
                        <div class="relative group">
                            <input 
                                type="text" 
                                id="searchLocationInput"
                                autocomplete="off"
                                spellcheck="false"
                                data-i18n-placeholder="heroLocPlaceholder"
                                placeholder="Ketik atau pilih provinsi di Indonesia..."
                                class="w-full h-11 sm:h-12 pl-10 pr-14 rounded-xl bg-stone-50 dark:bg-stone-800 border border-stone-200 dark:border-stone-700 text-stone-800 dark:text-stone-100 font-medium text-xs sm:text-sm focus:ring-2 focus:ring-amber-500/50 focus:border-stone-900 dark:focus:border-stone-100 focus:bg-white dark:focus:bg-stone-900 focus:outline-none transition-all shadow-2xs"
                                onfocus="openLocationDropdown()"
                                oninput="handleLocationInput(event)"
                                onkeydown="handleLocationKeydown(event)"
                            >
                            <input type="hidden" id="searchLocation" value="">
                            <!-- Pin Search Icon on Left -->
                            <span class="absolute inset-y-0 left-3.5 flex items-center pointer-events-none text-stone-400 dark:text-stone-500 group-focus-within:text-amber-600 dark:group-focus-within:text-amber-400 transition-colors">
                                <i class="fa-solid fa-compass text-xs sm:text-sm"></i>
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
                                    title="Pilih dari daftar provinsi"
                                >
                                    <i id="locationDropdownChevron" class="fa-solid fa-chevron-down text-[10px] transition-transform duration-200"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Floating Searchable Suggestions Dropdown -->
                        <div 
                            id="locationDropdownList" 
                            class="hidden absolute left-0 right-0 top-full mt-2 z-50 bg-white/95 dark:bg-stone-900/95 backdrop-blur-md rounded-2xl shadow-2xl border border-stone-200/90 dark:border-stone-800 max-h-84 overflow-y-auto p-2.5 animate-fadeIn"
                        >
                            <!-- Header & Counter Badge -->
                            <div class="px-2.5 py-1.5 text-[10px] font-bold uppercase tracking-wider text-stone-400 dark:text-stone-500 border-b border-stone-100 dark:border-stone-800 mb-2 flex items-center justify-between">
                                <span data-i18n="heroLocAllHeader">38 Provinsi di Seluruh Indonesia</span>
                                <span id="locationCountBadge" class="font-mono text-[9px] px-2 py-0.5 rounded-full bg-stone-100 dark:bg-stone-800 text-stone-700 dark:text-stone-300 font-bold">38 Provinsi</span>
                            </div>

                            <!-- Island Category Filter Pills for Quick Browsing -->
                            <div id="islandFilterPills" class="flex items-center gap-1 overflow-x-auto no-scrollbar pb-2 mb-1 px-1">
                                <button type="button" onclick="setDropdownIslandFilter('Semua', event)" class="island-pill active px-2.5 py-1 rounded-full text-[10px] font-semibold bg-stone-900 text-white dark:bg-stone-100 dark:text-stone-900 shrink-0 transition-colors">Semua</button>
                                <button type="button" onclick="setDropdownIslandFilter('Sumatera', event)" class="island-pill px-2.5 py-1 rounded-full text-[10px] font-semibold bg-stone-100 dark:bg-stone-800 text-stone-600 dark:text-stone-300 hover:bg-stone-200 shrink-0 transition-colors">Sumatera</button>
                                <button type="button" onclick="setDropdownIslandFilter('Jawa', event)" class="island-pill px-2.5 py-1 rounded-full text-[10px] font-semibold bg-stone-100 dark:bg-stone-800 text-stone-600 dark:text-stone-300 hover:bg-stone-200 shrink-0 transition-colors">Jawa</button>
                                <button type="button" onclick="setDropdownIslandFilter('Bali & Nusa Tenggara', event)" class="island-pill px-2.5 py-1 rounded-full text-[10px] font-semibold bg-stone-100 dark:bg-stone-800 text-stone-600 dark:text-stone-300 hover:bg-stone-200 shrink-0 transition-colors">Bali & Nusa Tenggara</button>
                                <button type="button" onclick="setDropdownIslandFilter('Kalimantan', event)" class="island-pill px-2.5 py-1 rounded-full text-[10px] font-semibold bg-stone-100 dark:bg-stone-800 text-stone-600 dark:text-stone-300 hover:bg-stone-200 shrink-0 transition-colors">Kalimantan</button>
                                <button type="button" onclick="setDropdownIslandFilter('Sulawesi', event)" class="island-pill px-2.5 py-1 rounded-full text-[10px] font-semibold bg-stone-100 dark:bg-stone-800 text-stone-600 dark:text-stone-300 hover:bg-stone-200 shrink-0 transition-colors">Sulawesi</button>
                                <button type="button" onclick="setDropdownIslandFilter('Maluku', event)" class="island-pill px-2.5 py-1 rounded-full text-[10px] font-semibold bg-stone-100 dark:bg-stone-800 text-stone-600 dark:text-stone-300 hover:bg-stone-200 shrink-0 transition-colors">Maluku</button>
                                <button type="button" onclick="setDropdownIslandFilter('Papua', event)" class="island-pill px-2.5 py-1 rounded-full text-[10px] font-semibold bg-stone-100 dark:bg-stone-800 text-stone-600 dark:text-stone-300 hover:bg-stone-200 shrink-0 transition-colors">Papua</button>
                            </div>

                            <!-- Direct Select Match Banner (Dynamic on typing) -->
                            <div id="locationDirectSelectBanner" class="hidden"></div>

                            <!-- List of Provinces -->
                            <div id="locationOptionsContainer" class="space-y-1">
                                <!-- Generated by JS -->
                            </div>

                            <!-- Quick Keyboard Hint Footer -->
                            <div class="mt-2 pt-1.5 border-t border-stone-100 dark:border-stone-800 px-2 flex items-center justify-between text-[9px] text-stone-400 dark:text-stone-500">
                                <span><kbd class="px-1 py-0.5 rounded bg-stone-100 dark:bg-stone-800 font-mono">↑</kbd> <kbd class="px-1 py-0.5 rounded bg-stone-100 dark:bg-stone-800 font-mono">↓</kbd> Navigasi</span>
                                <span><kbd class="px-1 py-0.5 rounded bg-stone-100 dark:bg-stone-800 font-mono">Enter</kbd> Pilih langsung</span>
                                <span><kbd class="px-1 py-0.5 rounded bg-stone-100 dark:bg-stone-800 font-mono">Esc</kbd> Tutup</span>
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
        <div data-aos="fade-up" class="flex flex-col sm:flex-row sm:items-end justify-between mb-8 sm:mb-10 gap-4 sm:gap-5 pb-5 sm:pb-6 border-b border-stone-200/80 dark:border-stone-800">
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
        <div data-aos="fade-up" data-aos-delay="100" id="categoryButtons" class="flex items-center gap-2 overflow-x-auto pb-3 mb-6 sm:mb-8 no-scrollbar text-xs -mx-4 px-4 sm:mx-0 sm:px-0">
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
                    data-aos="fade-up" 
                    data-aos-delay="{{ ($loop->index % 3 + 1) * 100 }}"
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
            <div data-aos="fade-up" class="flex flex-col sm:flex-row sm:items-end justify-between mb-8 sm:mb-10 gap-4 pb-4 border-b border-stone-200/80 dark:border-stone-800">
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
                        data-aos="fade-up"
                        data-aos-delay="{{ ($idx + 1) * 100 }}"
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
            <div data-aos="fade-right" data-aos-duration="850" class="lg:col-span-5 relative">
                <div class="rounded-3xl overflow-hidden shadow-md border border-stone-200 dark:border-stone-800">
                    <video 
                        autoplay 
                        muted 
                        loop 
                        playsinline 
                        poster="https://images.unsplash.com/photo-1537996194471-e657df975ab4?auto=format&fit=crop&w=1000&q=80" 
                        class="w-full h-[420px] object-cover"
                    >
                        <source src="{{ asset('images/13021388_1920_1080_25fps.mp4') }}" type="video/mp4">
                        Browser Anda tidak mendukung tag video.
                    </video>
                    <div class="p-5 bg-white dark:bg-stone-900 border-t border-stone-200/80 dark:border-stone-800">
                        <p data-i18n="storyQuote" class="font-serif italic text-sm text-stone-700 dark:text-stone-300 leading-relaxed">
                            "Pariwisata yang baik bukan sekadar meninggalkan jejak langkah, melainkan membawa pulang rasa hormat pada tanah dan manusianya."
                        </p>
                        <span data-i18n="storyPrinciple" class="block text-[11px] text-stone-400 mt-2">— Prinsip Perjalanan DANWISATA</span>
                    </div>
                </div>
            </div>

            <!-- Right Story Content -->
            <div data-aos="fade-left" data-aos-duration="850" class="lg:col-span-7 space-y-6">
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
                            Bebas bertanya rute, opsi bawa anak/orang tua, atau request preferensi khusus kapan pun kepada tim concierge kami.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ================= 5. GALERI MIKRO-DOKUMENTASI ================= -->
    <section id="galeri" class="py-12 sm:py-20 bg-stone-100/70 dark:bg-stone-900 border-t border-stone-200/80 dark:border-stone-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div data-aos="fade-up" class="flex flex-col sm:flex-row sm:items-end justify-between mb-8 sm:mb-10 gap-3">
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
                    <div data-aos="fade-up" data-aos-delay="{{ ($loop->index % 4 + 1) * 75 }}" onclick="openLightbox('{{ $item->image_url }}', '{{ addslashes($item->title) }}', '{{ addslashes($item->sub_title) }}')" class="group relative h-44 sm:h-64 rounded-xl sm:rounded-2xl overflow-hidden cursor-pointer bg-stone-200 dark:bg-stone-800 active:scale-95 transition-transform">
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
        <div data-aos="fade-up" class="text-center max-w-2xl mx-auto mb-8 sm:mb-12">
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
                <div data-aos="fade-up" data-aos-delay="{{ ($loop->index + 1) * 100 }}" class="p-5 sm:p-6 rounded-2xl sm:rounded-3xl bg-white dark:bg-stone-900 border border-stone-200 dark:border-stone-800 shadow-xs flex flex-col justify-between">
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
        <div data-aos="zoom-in" data-aos-duration="850" class="mt-10 sm:mt-14 rounded-2xl sm:rounded-3xl bg-stone-900 text-white p-6 sm:p-10 flex flex-col sm:flex-row items-center justify-between gap-6 shadow-sm">
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

    // All 38 Official Provinces of Indonesia + Island Categories & Tourist Hotspots
    const INDONESIA_PROVINCES = [
        { id: 'Semua', name: 'Semua Provinsi di Indonesia', en: 'All Provinces in Indonesia', island: 'Nusantara', icon: 'fa-earth-asia', sub: 'Jelajahi seluruh 38 provinsi di Nusantara', keywords: 'semua all indonesia nusantara seluruh' },

        // SUMATERA (10 Provinsi)
        { id: 'Aceh', name: 'Aceh', en: 'Aceh', island: 'Sumatera', icon: 'fa-mosque', sub: 'Banda Aceh, Sabang, Pulau Weh, Titik 0 KM', keywords: 'aceh sabang weh iboih banda nad nanggroe sumatera' },
        { id: 'Sumatera Utara', name: 'Sumatera Utara', en: 'North Sumatra', island: 'Sumatera', icon: 'fa-water', sub: 'Medan, Danau Toba, Pulau Samosir, Berastagi', keywords: 'sumatera utara sumut toba samosir medan bakkara berastagi' },
        { id: 'Sumatera Barat', name: 'Sumatera Barat', en: 'West Sumatra', island: 'Sumatera', icon: 'fa-mountain-sun', sub: 'Padang, Bukittinggi, Lembah Harau, Ngarai Sianok', keywords: 'sumatera barat sumbar harau bukittinggi sianok padang mandeh' },
        { id: 'Riau', name: 'Riau', en: 'Riau', island: 'Sumatera', icon: 'fa-tree', sub: 'Pekanbaru, Candi Muara Takus, Siak Sri Indrapura', keywords: 'riau pekanbaru siak muara takus kampar' },
        { id: 'Kepulauan Riau', name: 'Kepulauan Riau', en: 'Riau Islands', island: 'Sumatera', icon: 'fa-anchor', sub: 'Batam, Bintan, Tanjung Pinang, Kepulauan Natuna', keywords: 'kepulauan riau kepri batam bintan natuna anambas' },
        { id: 'Jambi', name: 'Jambi', en: 'Jambi', island: 'Sumatera', icon: 'fa-mountain', sub: 'Gunung Kerinci, Danau Kaco, Candi Muaro Jambi', keywords: 'jambi kerinci kaco muaro jambi sumatera' },
        { id: 'Sumatera Selatan', name: 'Sumatera Selatan', en: 'South Sumatra', island: 'Sumatera', icon: 'fa-bridge', sub: 'Palembang, Jembatan Ampera, Danau Ranau, Pagar Alam', keywords: 'sumatera selatan sumsel palembang ampera ranau pagar alam' },
        { id: 'Kepulauan Bangka Belitung', name: 'Kepulauan Bangka Belitung', en: 'Bangka Belitung Islands', island: 'Sumatera', icon: 'fa-gem', sub: 'Pangkal Pinang, Belitung, Tanjung Tinggi, Pulau Lengkuas', keywords: 'bangka belitung babel tanjung tinggi lengkuas laskar pelangi' },
        { id: 'Bengkulu', name: 'Bengkulu', en: 'Bengkulu', island: 'Sumatera', icon: 'fa-seedling', sub: 'Benteng Marlborough, Danau Dendam Tak Sudah, Rafflesia', keywords: 'bengkulu rafflesia marlborough pantai panjang' },
        { id: 'Lampung', name: 'Lampung', en: 'Lampung', island: 'Sumatera', icon: 'fa-sun', sub: 'Bandar Lampung, TN Way Kambas, Pulau Pahawang, Teluk Kiluan', keywords: 'lampung way kambas pahawang kiluan krakatau' },

        // JAWA (6 Provinsi)
        { id: 'DKI Jakarta', name: 'DKI Jakarta', en: 'Jakarta (DKI)', island: 'Jawa', icon: 'fa-city', sub: 'Monas, Kota Tua, Kepulauan Seribu, Ancol, PIK', keywords: 'dki jakarta ibu kota monas kota tua seribu pik' },
        { id: 'Banten', name: 'Banten', en: 'Banten', island: 'Jawa', icon: 'fa-umbrella-beach', sub: 'Anyer, Tanjung Lesung, TN Ujung Kulon, Baduy', keywords: 'banten serang anyer tanjung lesung ujung kulon baduy' },
        { id: 'Jawa Barat', name: 'Jawa Barat', en: 'West Java', island: 'Jawa', icon: 'fa-leaf', sub: 'Bandung, Puncak Bogor, Kawah Putih, Pangandaran', keywords: 'jawa barat jabar bandung bogor puncak kawah putih ciletuh pangandaran' },
        { id: 'Jawa Tengah', name: 'Jawa Tengah', en: 'Central Java', island: 'Jawa', icon: 'fa-place-of-worship', sub: 'Candi Borobudur, Dataran Tinggi Dieng, Karimunjawa, Solo', keywords: 'jawa tengah jateng borobudur dieng karimunjawa magelang solo semarang' },
        { id: 'D.I. Yogyakarta', name: 'D.I. Yogyakarta', en: 'Special Region of Yogyakarta', island: 'Jawa', icon: 'fa-landmark', sub: 'Malioboro, Candi Prambanan, Keraton Jogja, Parangtritis', keywords: 'yogyakarta diy jogja yogya malioboro prambanan keraton kaliurang' },
        { id: 'Jawa Timur', name: 'Jawa Timur', en: 'East Java', island: 'Jawa', icon: 'fa-mountain', sub: 'Gunung Bromo, Kawah Ijen, Malang Batu, Banyuwangi', keywords: 'jawa timur jatim bromo ijen malang banyuwangi surabaya semeru' },

        // BALI & NUSA TENGGARA (3 Provinsi)
        { id: 'Bali', name: 'Bali', en: 'Bali', island: 'Bali & Nusa Tenggara', icon: 'fa-spa', sub: 'Denpasar, Ubud, Kuta, Nusa Penida, Uluwatu, Kintamani', keywords: 'bali denpasar ubud kuta kelingking nusa penida sanur canggu' },
        { id: 'Nusa Tenggara Barat', name: 'Nusa Tenggara Barat', en: 'West Nusa Tenggara (NTB)', island: 'Bali & Nusa Tenggara', icon: 'fa-volcano', sub: 'Mataram, Lombok, Gunung Rinjani, Gili Trawangan, Mandalika', keywords: 'nusa tenggara barat ntb lombok rinjani gili mandalika sumbawa segara anak' },
        { id: 'Nusa Tenggara Timur', name: 'Nusa Tenggara Timur', en: 'East Nusa Tenggara (NTT)', island: 'Bali & Nusa Tenggara', icon: 'fa-ship', sub: 'Kupang, Labuan Bajo, TN Komodo, Pulau Padar, Sumba, Wae Rebo', keywords: 'nusa tenggara timur ntt labuan bajo komodo padar sumba wae rebo flores kupang' },

        // KALIMANTAN (5 Provinsi)
        { id: 'Kalimantan Barat', name: 'Kalimantan Barat', en: 'West Kalimantan', island: 'Kalimantan', icon: 'fa-water', sub: 'Pontianak, Singkawang, Danau Sentarum, Sungai Kapuas', keywords: 'kalimantan barat kalbar pontianak singkawang kapuas sentarum' },
        { id: 'Kalimantan Tengah', name: 'Kalimantan Tengah', en: 'Central Kalimantan', island: 'Kalimantan', icon: 'fa-feather', sub: 'Palangkaraya, TN Tanjung Puting, Sungai Sekonyer', keywords: 'kalimantan tengah kalteng tanjung puting orangutan sekonyer pangkalan bun palangkaraya' },
        { id: 'Kalimantan Selatan', name: 'Kalimantan Selatan', en: 'South Kalimantan', island: 'Kalimantan', icon: 'fa-person-boating', sub: 'Banjarmasin, Pasar Terapung Lok Baintan, Pegunungan Meratus', keywords: 'kalimantan selatan kalsel banjarmasin lok baintan meratus martapura' },
        { id: 'Kalimantan Timur', name: 'Kalimantan Timur', en: 'East Kalimantan', island: 'Kalimantan', icon: 'fa-fish-fins', sub: 'Samarinda, Balikpapan, Kepulauan Derawan, Danau Kakaban, IKN', keywords: 'kalimantan timur kaltim derawan maratua kakaban berau ikn samarinda balikpapan' },
        { id: 'Kalimantan Utara', name: 'Kalimantan Utara', en: 'North Kalimantan', island: 'Kalimantan', icon: 'fa-tree', sub: 'Tanjung Selor, Tarakan, TN Kayan Mentarang', keywords: 'kalimantan utara kaltara tarakan kayan mentarang tanjung selor' },

        // SULAWESI (6 Provinsi)
        { id: 'Sulawesi Utara', name: 'Sulawesi Utara', en: 'North Sulawesi', island: 'Sulawesi', icon: 'fa-mask-snorkel', sub: 'Manado, Taman Nasional Bunaken, Likupang, Tomohon', keywords: 'sulawesi utara sulut manado bunaken likupang tomohon siladen' },
        { id: 'Gorontalo', name: 'Gorontalo', en: 'Gorontalo', island: 'Sulawesi', icon: 'fa-fish', sub: 'Kota Gorontalo, Hiu Paus Botubarani, Pulau Cinta', keywords: 'gorontalo hiu paus botubarani pulau cinta saronde' },
        { id: 'Sulawesi Tengah', name: 'Sulawesi Tengah', en: 'Central Sulawesi', island: 'Sulawesi', icon: 'fa-water', sub: 'Palu, Kepulauan Togean, Danau Poso, Banggai Laut', keywords: 'sulawesi tengah sulteng togean poso palu banggai' },
        { id: 'Sulawesi Barat', name: 'Sulawesi Barat', en: 'West Sulawesi', island: 'Sulawesi', icon: 'fa-sailboat', sub: 'Mamuju, Polewali Mandar, Pantai Manakarra', keywords: 'sulawesi barat sulbar mamuju mandar manakarra' },
        { id: 'Sulawesi Selatan', name: 'Sulawesi Selatan', en: 'South Sulawesi', island: 'Sulawesi', icon: 'fa-house-chimney', sub: 'Makassar, Tana Toraja, Lolai, Pantai Bira, Rammang-Rammang', keywords: 'sulawesi selatan sulsel makassar toraja lolai bira rammang rammang' },
        { id: 'Sulawesi Tenggara', name: 'Sulawesi Tenggara', en: 'Southeast Sulawesi', island: 'Sulawesi', icon: 'fa-water', sub: 'Kendari, TN Wakatobi, Pulau Labengki, Pulau Sombori', keywords: 'sulawesi tenggara sultra wakatobi labengki sombori kendari bau-bau' },

        // MALUKU (2 Provinsi)
        { id: 'Maluku', name: 'Maluku', en: 'Maluku', island: 'Maluku', icon: 'fa-monument', sub: 'Ambon, Banda Neira, Benteng Belgica, Pantai Ora, Kepulauan Kei', keywords: 'maluku ambon banda neira belgica ora kei ngurbloat tual' },
        { id: 'Maluku Utara', name: 'Maluku Utara', en: 'North Maluku', island: 'Maluku', icon: 'fa-volcano', sub: 'Ternate, Tidore, Pulau Morotai, Halmahera', keywords: 'maluku utara malut ternate tidore morotai halmahera' },

        // PAPUA (6 Provinsi)
        { id: 'Papua', name: 'Papua', en: 'Papua', island: 'Papua', icon: 'fa-dove', sub: 'Jayapura, Danau Sentani, Teluk Cenderawasih, Biak', keywords: 'papua jayapura sentani cenderawasih biak' },
        { id: 'Papua Barat', name: 'Papua Barat', en: 'West Papua', island: 'Papua', icon: 'fa-tree', sub: 'Manokwari, Pegunungan Arfak, Teluk Bintuni', keywords: 'papua barat manokwari arfak bintuni' },
        { id: 'Papua Selatan', name: 'Papua Selatan', en: 'South Papua', island: 'Papua', icon: 'fa-compass', sub: 'Merauke, Taman Nasional Wasur, Asmat', keywords: 'papua selatan merauke wasur asmat' },
        { id: 'Papua Tengah', name: 'Papua Tengah', en: 'Central Papua', island: 'Papua', icon: 'fa-mountain', sub: 'Nabire, Puncak Jaya Cartenz, Timika', keywords: 'papua tengah nabire cartenz puncak jaya timika' },
        { id: 'Papua Pegunungan', name: 'Papua Pegunungan', en: 'Highland Papua', island: 'Papua', icon: 'fa-campground', sub: 'Wamena, Lembah Baliem, Pegunungan Jayawijaya', keywords: 'papua pegunungan wamena baliem jayawijaya dani' },
        { id: 'Papua Barat Daya', name: 'Papua Barat Daya', en: 'Southwest Papua', island: 'Papua', icon: 'fa-crown', sub: 'Sorong, Kepulauan Raja Ampat, Wayag, Misool, Piaynemo', keywords: 'papua barat daya sorong raja ampat wayag misool piaynemo' }
    ];

    let currentDropdownIsland = 'Semua';
    let dropdownHighlightedIndex = -1;

    function getIslandBadgeClass(island) {
        switch (island) {
            case 'Sumatera':
                return 'bg-emerald-100 dark:bg-emerald-950/70 text-emerald-800 dark:text-emerald-300 border border-emerald-200 dark:border-emerald-800/60';
            case 'Jawa':
                return 'bg-blue-100 dark:bg-blue-950/70 text-blue-800 dark:text-blue-300 border border-blue-200 dark:border-blue-800/60';
            case 'Bali & Nusa Tenggara':
                return 'bg-amber-100 dark:bg-amber-950/70 text-amber-800 dark:text-amber-300 border border-amber-200 dark:border-amber-800/60';
            case 'Kalimantan':
                return 'bg-teal-100 dark:bg-teal-950/70 text-teal-800 dark:text-teal-300 border border-teal-200 dark:border-teal-800/60';
            case 'Sulawesi':
                return 'bg-indigo-100 dark:bg-indigo-950/70 text-indigo-800 dark:text-indigo-300 border border-indigo-200 dark:border-indigo-800/60';
            case 'Maluku':
                return 'bg-rose-100 dark:bg-rose-950/70 text-rose-800 dark:text-rose-300 border border-rose-200 dark:border-rose-800/60';
            case 'Papua':
                return 'bg-purple-100 dark:bg-purple-950/70 text-purple-800 dark:text-purple-300 border border-purple-200 dark:border-purple-800/60';
            default:
                return 'bg-stone-100 dark:bg-stone-800 text-stone-700 dark:text-stone-300 border border-stone-200 dark:border-stone-700';
        }
    }

    function highlightMatch(text, query) {
        if (!query) return text;
        const escaped = query.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
        const regex = new RegExp(`(${escaped})`, 'gi');
        return text.replace(regex, '<span class="text-amber-600 dark:text-amber-400 font-extrabold underline decoration-amber-400">$1</span>');
    }

    function setDropdownIslandFilter(islandName, e) {
        if (e) {
            e.stopPropagation();
            e.preventDefault();
        }
        currentDropdownIsland = islandName;

        // Update active class on pill buttons
        document.querySelectorAll('#islandFilterPills .island-pill').forEach(btn => {
            if (btn.textContent.trim() === islandName) {
                btn.className = "island-pill active px-2.5 py-1 rounded-full text-[10px] font-semibold bg-stone-900 text-white dark:bg-stone-100 dark:text-stone-900 shrink-0 transition-colors shadow-2xs";
            } else {
                btn.className = "island-pill px-2.5 py-1 rounded-full text-[10px] font-semibold bg-stone-100 dark:bg-stone-800 text-stone-600 dark:text-stone-300 hover:bg-stone-200 dark:hover:bg-stone-700 shrink-0 transition-colors";
            }
        });

        const input = document.getElementById('searchLocationInput');
        renderLocationDropdown(input ? input.value : '');
    }

    function renderLocationDropdown(filterText = '') {
        const container = document.getElementById('locationOptionsContainer');
        const badge = document.getElementById('locationCountBadge');
        const directBanner = document.getElementById('locationDirectSelectBanner');
        if (!container) return;

        dropdownHighlightedIndex = -1;
        const isEnglish = (typeof currentLang !== 'undefined' && currentLang === 'en');
        const query = filterText.toLowerCase().trim();

        const filtered = INDONESIA_PROVINCES.filter(item => {
            // Filter by Island Tab if selected
            if (currentDropdownIsland !== 'Semua' && item.id !== 'Semua' && item.island !== currentDropdownIsland) {
                return false;
            }

            if (!query) return true;
            return item.name.toLowerCase().includes(query) ||
                   item.en.toLowerCase().includes(query) ||
                   item.sub.toLowerCase().includes(query) ||
                   item.island.toLowerCase().includes(query) ||
                   item.keywords.toLowerCase().includes(query);
        });

        if (badge) {
            badge.textContent = `${filtered.length} ${isEnglish ? 'Provinces' : 'Provinsi'}`;
        }

        // Direct select banner when typing
        if (directBanner) {
            if (query && filtered.length > 0) {
                const top = filtered[0];
                const topTitle = isEnglish ? top.en : top.name;
                const topSafeName = top.id === 'Semua' ? '' : topTitle.replace(/'/g, "\\'");
                directBanner.innerHTML = `
                    <div 
                        onclick="selectLocationItem('${topSafeName}', '${top.id}')"
                        class="p-2.5 sm:p-3 mb-2 rounded-xl bg-gradient-to-r from-stone-900 via-stone-800 to-stone-900 dark:from-stone-100 dark:via-white dark:to-stone-100 text-white dark:text-stone-950 shadow-md flex items-center justify-between cursor-pointer hover:scale-[1.01] transition-transform border border-amber-500/30 group"
                    >
                        <div class="flex items-center gap-2.5 min-w-0">
                            <span class="w-7 h-7 rounded-lg bg-amber-400 text-stone-950 flex items-center justify-center font-bold text-xs shrink-0 shadow-sm">
                                <i class="fa-solid fa-bolt"></i>
                            </span>
                            <div class="truncate">
                                <div class="flex items-center gap-1.5">
                                    <span class="text-[9px] uppercase tracking-wider font-extrabold text-amber-300 dark:text-amber-700">Pilih Langsung</span>
                                    <span class="text-[9px] text-stone-300 dark:text-stone-600 font-mono">(Tekan Enter ↵)</span>
                                </div>
                                <p class="text-xs sm:text-sm font-bold truncate text-white dark:text-stone-900">${topTitle}</p>
                            </div>
                        </div>
                        <span class="px-2.5 py-1 rounded-lg bg-white/20 dark:bg-stone-900/10 text-xs font-bold tracking-wide shrink-0 group-hover:bg-amber-400 group-hover:text-stone-950 transition-colors">
                            Pilih Ini ➔
                        </span>
                    </div>
                `;
                directBanner.classList.remove('hidden');
            } else {
                directBanner.classList.add('hidden');
            }
        }

        if (filtered.length === 0) {
            const noMatchMsg = (typeof i18nDictionary !== 'undefined' && i18nDictionary[currentLang] && i18nDictionary[currentLang].heroLocNoMatch) 
                ? i18nDictionary[currentLang].heroLocNoMatch 
                : 'Tidak ada provinsi yang cocok dengan';
            const showAllText = (typeof i18nDictionary !== 'undefined' && i18nDictionary[currentLang] && i18nDictionary[currentLang].heroLocShowAll) 
                ? i18nDictionary[currentLang].heroLocShowAll 
                : 'Tampilkan Seluruh Provinsi';

            container.innerHTML = `
                <div class="p-4 text-center text-xs text-stone-500">
                    <div class="w-10 h-10 mx-auto rounded-full bg-stone-100 dark:bg-stone-800 flex items-center justify-center text-stone-400 mb-2">
                        <i class="fa-solid fa-map-location text-sm"></i>
                    </div>
                    <p>${noMatchMsg} "<strong>${filterText}</strong>"</p>
                    <button type="button" onclick="clearLocationInput(event)" class="mt-2 text-xs font-semibold text-amber-600 dark:text-amber-400 underline hover:opacity-80">
                        ${showAllText}
                    </button>
                </div>
            `;
            return;
        }

        container.innerHTML = filtered.map((item, index) => {
            const title = isEnglish ? item.en : item.name;
            const highlightedTitle = highlightMatch(title, query);
            const highlightedSub = highlightMatch(item.sub, query);
            const safeName = item.id === 'Semua' ? '' : title.replace(/'/g, "\\'");
            const isAll = item.id === 'Semua';

            return `
                <div 
                    id="prov-opt-${index}"
                    data-prov-name="${safeName}"
                    data-prov-id="${item.id}"
                    onclick="selectLocationItem('${safeName}', '${item.id}')"
                    class="prov-option-item p-2 sm:p-2.5 rounded-xl hover:bg-stone-100 dark:hover:bg-stone-800 transition-colors cursor-pointer flex items-center justify-between gap-2.5 group"
                >
                    <div class="flex items-center gap-2.5 min-w-0 flex-1">
                        <div class="w-7 h-7 sm:w-8 sm:h-8 rounded-lg ${isAll ? 'bg-amber-100 dark:bg-amber-900/40 text-amber-700 dark:text-amber-300' : 'bg-stone-100 dark:bg-stone-800 text-stone-700 dark:text-stone-300'} flex items-center justify-center shrink-0 group-hover:bg-stone-900 group-hover:text-white dark:group-hover:bg-white dark:group-hover:text-stone-900 transition-colors shadow-2xs">
                            <i class="fa-solid ${item.icon} text-xs"></i>
                        </div>
                        <div class="min-w-0 flex-1">
                            <div class="flex items-center gap-2">
                                <h4 class="text-xs font-semibold text-stone-900 dark:text-white truncate group-hover:text-amber-600 dark:group-hover:text-amber-400 transition-colors">${highlightedTitle}</h4>
                                <span class="text-[9px] px-1.5 py-0.5 rounded-full font-medium ${getIslandBadgeClass(item.island)} shrink-0">${item.island}</span>
                            </div>
                            <p class="text-[10px] text-stone-500 dark:text-stone-400 truncate mt-0.5">${highlightedSub}</p>
                        </div>
                    </div>
                    <div class="shrink-0 flex items-center gap-1.5">
                        <button 
                            type="button" 
                            class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg text-[10px] font-bold bg-stone-100 dark:bg-stone-800 text-stone-600 dark:text-stone-300 group-hover:bg-stone-900 group-hover:text-white dark:group-hover:bg-white dark:group-hover:text-stone-900 transition-all shadow-2xs"
                        >
                            <span>Pilih</span>
                            <i class="fa-solid fa-arrow-right text-[8px]"></i>
                        </button>
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
        dropdownHighlightedIndex = -1;
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

    function updateDropdownHighlight(items) {
        items.forEach((item, idx) => {
            if (idx === dropdownHighlightedIndex) {
                item.classList.add('bg-stone-100', 'dark:bg-stone-800', 'ring-1', 'ring-amber-500');
                item.scrollIntoView({ block: 'nearest', behavior: 'smooth' });
            } else {
                item.classList.remove('bg-stone-100', 'dark:bg-stone-800', 'ring-1', 'ring-amber-500');
            }
        });
    }

    function handleLocationKeydown(e) {
        const list = document.getElementById('locationDropdownList');
        if (!list || list.classList.contains('hidden')) {
            if (e.key === 'ArrowDown' || e.key === 'Enter') {
                openLocationDropdown();
                return;
            }
            return;
        }

        const items = list.querySelectorAll('.prov-option-item');
        if (e.key === 'ArrowDown') {
            e.preventDefault();
            if (items.length > 0) {
                dropdownHighlightedIndex = (dropdownHighlightedIndex + 1) % items.length;
                updateDropdownHighlight(items);
            }
        } else if (e.key === 'ArrowUp') {
            e.preventDefault();
            if (items.length > 0) {
                dropdownHighlightedIndex = (dropdownHighlightedIndex - 1 + items.length) % items.length;
                updateDropdownHighlight(items);
            }
        } else if (e.key === 'Enter') {
            e.preventDefault();
            if (dropdownHighlightedIndex >= 0 && dropdownHighlightedIndex < items.length) {
                items[dropdownHighlightedIndex].click();
            } else {
                const banner = document.getElementById('locationDirectSelectBanner');
                if (banner && !banner.classList.contains('hidden') && banner.firstElementChild) {
                    banner.firstElementChild.click();
                } else if (items.length > 0) {
                    items[0].click();
                } else {
                    closeLocationDropdown();
                }
            }
        } else if (e.key === 'Escape') {
            closeLocationDropdown();
        }
    }

    function selectLocationItem(displayName, provinceId) {
        const input = document.getElementById('searchLocationInput');
        const hiddenInput = document.getElementById('searchLocation');
        const clearBtn = document.getElementById('clearLocationBtn');

        if (input) {
            input.value = displayName;
        }
        if (hiddenInput) {
            hiddenInput.value = provinceId;
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

        // Langsung terapkan filter wilayah ke daftar destinasi secara interaktif
        activeRegionFilter = (provinceId === 'Semua' || !displayName) ? 'Semua' : displayName;
        renderDestinationsGrid();

        if (displayName) {
            showToast(`Memilih Provinsi: ${displayName}`, 'info');
        } else {
            showToast('Menampilkan Seluruh Provinsi di Nusantara', 'info');
        }
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
        currentDropdownIsland = 'Semua';
        document.querySelectorAll('#islandFilterPills .island-pill').forEach(btn => {
            if (btn.textContent.trim() === 'Semua') {
                btn.className = "island-pill active px-2.5 py-1 rounded-full text-[10px] font-semibold bg-stone-900 text-white dark:bg-stone-100 dark:text-stone-900 shrink-0 transition-colors shadow-2xs";
            } else {
                btn.className = "island-pill px-2.5 py-1 rounded-full text-[10px] font-semibold bg-stone-100 dark:bg-stone-800 text-stone-600 dark:text-stone-300 hover:bg-stone-200 dark:hover:bg-stone-700 shrink-0 transition-colors";
            }
        });

        renderLocationDropdown('');
        activeRegionFilter = 'Semua';
        renderDestinationsGrid();
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
            if (!activeRegionFilter || 
                activeRegionFilter === 'Semua' || 
                activeRegionFilter === 'Semua Provinsi di Indonesia' || 
                activeRegionFilter === 'All Provinces in Indonesia' ||
                activeRegionFilter === 'Semua Wilayah Nusantara' || 
                activeRegionFilter === 'All Indonesian Archipelago') {
                matchRegion = true;
            } else {
                const q = activeRegionFilter.toLowerCase().trim();
                
                // Lookup aliases for all provinces
                let terms = [q];
                if (q.includes('nusa tenggara timur') || q === 'ntt') terms.push('ntt', 'labuan bajo', 'komodo', 'padar', 'flores', 'sumba', 'wae rebo');
                if (q.includes('nusa tenggara barat') || q === 'ntb') terms.push('ntb', 'lombok', 'rinjani', 'mandalika', 'gili');
                if (q.includes('yogyakarta') || q.includes('jogja')) terms.push('yogyakarta', 'jogja', 'malioboro', 'prambanan');
                if (q.includes('jawa tengah')) terms.push('jawa tengah', 'borobudur', 'dieng', 'karimunjawa', 'magelang', 'jepara', 'solo');
                if (q.includes('jawa timur')) terms.push('jawa timur', 'bromo', 'ijen', 'banyuwangi', 'malang', 'surabaya');
                if (q.includes('jawa barat')) terms.push('jawa barat', 'bandung', 'bogor', 'puncak');
                if (q.includes('jakarta')) terms.push('jakarta', 'dki', 'monas', 'kepulauan seribu');
                if (q.includes('banten')) terms.push('banten', 'anyer', 'ujung kulon', 'tanjung lesung');
                if (q.includes('bali')) terms.push('bali', 'kelingking', 'nusa penida', 'ubud', 'kuta');
                if (q.includes('sumatera utara')) terms.push('sumatera utara', 'toba', 'samosir', 'medan');
                if (q.includes('sumatera barat')) terms.push('sumatera barat', 'harau', 'bukittinggi', 'sianok', 'padang');
                if (q.includes('aceh')) terms.push('aceh', 'sabang', 'weh');
                if (q.includes('sulawesi selatan')) terms.push('sulawesi selatan', 'toraja', 'lolai', 'makassar');
                if (q.includes('sulawesi utara')) terms.push('sulawesi utara', 'bunaken', 'manado');
                if (q.includes('kalimantan timur')) terms.push('kalimantan timur', 'maratua', 'derawan', 'kakaban', 'berau');
                if (q.includes('kalimantan tengah')) terms.push('kalimantan tengah', 'tanjung puting', 'sekonyer');
                if (q.includes('papua barat daya')) terms.push('papua barat daya', 'raja ampat', 'wayag', 'piaynemo', 'sorong');
                if (q.includes('papua pegunungan')) terms.push('papua pegunungan', 'baliem', 'wamena');
                if (q.includes('maluku')) terms.push('maluku', 'banda neira', 'ngurbloat', 'kei');

                matchRegion = terms.some(term => 
                    item.name.toLowerCase().includes(term) ||
                    item.location.toLowerCase().includes(term) ||
                    item.region.toLowerCase().includes(term) ||
                    (item.description && item.description.toLowerCase().includes(term))
                );

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

        grid.innerHTML = filtered.map((dest, idx) => {
            const isLiked = savedWishlist.has(dest.id);
            const safeName = dest.name.replace(/'/g, "\\'");
            return `
                <article data-aos="fade-up" data-aos-delay="${(idx % 3 + 1) * 75}" onclick="openDetailModal(${dest.id})" class="group bg-white dark:bg-stone-900 rounded-2xl sm:rounded-3xl overflow-hidden border border-stone-200/90 dark:border-stone-800 hover:border-stone-400 dark:hover:border-stone-600 hover:shadow-xl transition-all duration-300 flex flex-col cursor-pointer">
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

        if (typeof AOS !== 'undefined') {
            AOS.refresh();
        }
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

        // Playlist otomatis untuk video beranda utama dengan efek sapuan awan horizontal & paralaks sinematik
        const heroVid = document.getElementById('heroVideo');
        const heroMistCurtain = document.getElementById('heroMistCurtain');
        if (heroVid) {
            const heroPlaylist = [
                "{{ asset('images/231170_medium.mp4') }}",
                "{{ asset('images/16694704_2560_1440_30fps.mp4') }}"
            ];
            let currentVidIdx = 0;
            let isSwitching = false;

            const triggerSideCloudTransition = () => {
                if (isSwitching) return;
                isSwitching = true;

                // 1. Video 1 melanjutkan gerakan panning ke samping kiri
                heroVid.style.transition = 'transform 0.85s cubic-bezier(0.22, 1, 0.36, 1), opacity 0.85s ease';
                heroVid.style.transform = 'scale(1.08) translateX(-3.5%)';

                // 2. Sapuan awan & kabut berarak masuk dari samping kanan ke kiri
                if (heroMistCurtain) {
                    heroMistCurtain.classList.remove('mist-sweep-out');
                    heroMistCurtain.classList.add('mist-sweep-in');
                }

                // 3. Saat awan menutupi layar (setelah 700ms), muat video ke-2
                setTimeout(() => {
                    currentVidIdx = (currentVidIdx + 1) % heroPlaylist.length;
                    heroVid.src = heroPlaylist[currentVidIdx];
                    heroVid.load();

                    // Siapkan posisi awal video 2: mulai sedikit ke kanan sebelum zoom forward
                    heroVid.style.transition = 'none';
                    heroVid.style.transform = 'scale(1.02) translateX(3%)';

                    heroVid.play().then(() => {
                        // 4. Video 2 melakukan gerakan maju memusat (smooth push-in zoom)
                        setTimeout(() => {
                            heroVid.style.transition = 'transform 1.4s cubic-bezier(0.16, 1, 0.3, 1)';
                            heroVid.style.transform = 'scale(1.05) translateX(0%)';

                            // 5. Awan menyapu keluar terus ke arah kiri mengungkap video ke-2
                            if (heroMistCurtain) {
                                heroMistCurtain.classList.remove('mist-sweep-in');
                                heroMistCurtain.classList.add('mist-sweep-out');
                            }

                            // Selesai transisi, reset status
                            setTimeout(() => {
                                if (heroMistCurtain) {
                                    heroMistCurtain.classList.remove('mist-sweep-out');
                                }
                                isSwitching = false;
                            }, 1000);
                        }, 80);
                    }).catch(() => {
                        if (heroMistCurtain) {
                            heroMistCurtain.classList.remove('mist-sweep-in');
                            heroMistCurtain.classList.add('mist-sweep-out');
                        }
                        heroVid.style.transform = 'scale(1.05) translateX(0%)';
                        isSwitching = false;
                    });
                }, 700);
            };

            heroVid.addEventListener('ended', triggerSideCloudTransition);
            // Helper untuk preview langsung dari konsol kapan saja: previewMistTransition()
            window.previewMistTransition = triggerSideCloudTransition;
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
