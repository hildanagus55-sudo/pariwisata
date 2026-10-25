@extends('layouts.app')

@section('title', 'ANWISATA — Portal Pariwisata Indonesia')
@section('meta_description', 'Portal Pariwisata Indonesia resmi dan terpercaya. Jelajahi keindahan destinasi wisata alam, budaya nusantara, dan paket liburan impian terbaik.')

@section('content')
    <!-- ================= 2. HERO SECTION & INTERACTIVE SEARCH WIDGET (CINEMATIC PHOTO HERO) ================= -->
    <section id="beranda" class="relative min-h-[92vh] pt-28 pb-20 flex items-center justify-center overflow-hidden">
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
                <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white/15 backdrop-blur-md border border-white/25 text-xs sm:text-sm font-medium mb-6 animate-float">
                    <span class="w-2 h-2 rounded-full bg-emerald-400 animate-ping"></span>
                    <span data-i18n="heroBadge">Eksplorasi 17.000+ Pulau Eksotis di Zamrud Khatulistiwa</span>
                </div>

                <!-- Inspiring Headline -->
                <h1 data-i18n="heroTitle" class="font-serif text-4xl sm:text-5xl lg:text-6xl font-bold leading-tight tracking-tight mb-6">
                    Temukan Surga Tersembunyi di <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-300 via-teal-200 to-amber-200 italic">Bumi Nusantara</span>
                </h1>

                <p data-i18n="heroDesc" class="text-base sm:text-lg text-slate-200/90 leading-relaxed mb-10 max-w-2xl mx-auto">
                    Dari birunya perairan Raja Ampat, megahnya kabut pagi Borobudur, hingga hangatnya senja di Labuan Bajo. Wujudkan perjalanan impian Anda bersama pemandu lokal terbaik.
                </p>

                <!-- Quick Stats Counter -->
                <div class="grid grid-cols-3 gap-4 max-w-lg mx-auto mb-12 text-center">
                    <div class="p-3.5 rounded-2xl bg-white/10 backdrop-blur-sm border border-white/15">
                        <p class="text-xl sm:text-2xl font-extrabold text-emerald-300">120+</p>
                        <p data-i18n="heroStatDest" class="text-xs text-slate-200">Destinasi Unggulan</p>
                    </div>
                    <div class="p-3.5 rounded-2xl bg-white/10 backdrop-blur-sm border border-white/15">
                        <p class="text-xl sm:text-2xl font-extrabold text-amber-300">4.9/5</p>
                        <p data-i18n="heroStatGuide" class="text-xs text-slate-200">Rating Wisatawan</p>
                    </div>
                    <div class="p-3.5 rounded-2xl bg-white/10 backdrop-blur-sm border border-white/15">
                        <p class="text-xl sm:text-2xl font-extrabold text-teal-300">45K+</p>
                        <p data-i18n="heroStatSat" class="text-xs text-slate-200">Pelanggan Puas</p>
                    </div>
                </div>
            </div>

            <!-- Interactive Search Widget Card -->
            <div class="max-w-5xl mx-auto bg-white dark:bg-stone-900 rounded-3xl p-4 sm:p-6 shadow-2xl border border-stone-200/80 dark:border-stone-800">
                <form id="heroSearchForm" onsubmit="handleHeroSearch(event)" class="grid grid-cols-1 md:grid-cols-12 gap-4 items-end">
                    <!-- Lokasi Tujuan -->
                    <div class="md:col-span-4">
                        <label class="block text-xs font-bold uppercase tracking-wider text-stone-500 dark:text-stone-400 mb-2">
                            <i class="fa-solid fa-location-dot text-stone-800 dark:text-stone-200 mr-1.5"></i> <span data-i18n="heroFieldRegion">Lokasi Tujuan</span>
                        </label>
                        <select id="searchLocation" class="w-full px-4 py-3 rounded-xl bg-stone-50 dark:bg-stone-800 border border-stone-200 dark:border-stone-700 text-stone-800 dark:text-stone-100 font-medium text-sm focus:ring-2 focus:ring-stone-900 focus:outline-none">
                            <option value="Semua">Semua Destinasi Nusantara</option>
                            <option value="Bali & Nusa Tenggara">Bali & Labuan Bajo (NTT)</option>
                            <option value="Papua & Maluku">Raja Ampat, Papua Barat</option>
                            <option value="Jawa">Bromo, Ijen & Borobudur (Jawa)</option>
                            <option value="Sumatera">Danau Toba & Pulau Weh (Sumatera)</option>
                            <option value="Kalimantan & Sulawesi">Derawan & Tana Toraja</option>
                        </select>
                    </div>

                    <!-- Tanggal Keberangkatan -->
                    <div class="md:col-span-3">
                        <label class="block text-xs font-bold uppercase tracking-wider text-stone-500 dark:text-stone-400 mb-2">
                            <i class="fa-regular fa-calendar-days text-stone-800 dark:text-stone-200 mr-1.5"></i> <span data-i18n="heroFieldDate">Tanggal Berangkat</span>
                        </label>
                        <input type="date" id="searchDate" required class="w-full px-4 py-3 rounded-xl bg-stone-50 dark:bg-stone-800 border border-stone-200 dark:border-stone-700 text-stone-800 dark:text-stone-100 font-medium text-sm focus:ring-2 focus:ring-stone-900 focus:outline-none">
                    </div>

                    <!-- Jumlah Peserta -->
                    <div class="md:col-span-3">
                        <label class="block text-xs font-bold uppercase tracking-wider text-stone-500 dark:text-stone-400 mb-2">
                            <i class="fa-solid fa-user-group text-stone-800 dark:text-stone-200 mr-1.5"></i> <span data-i18n="heroFieldPax">Jumlah Peserta</span>
                        </label>
                        <select id="searchPax" class="w-full px-4 py-3 rounded-xl bg-stone-50 dark:bg-stone-800 border border-stone-200 dark:border-stone-700 text-stone-800 dark:text-stone-100 font-medium text-sm focus:ring-2 focus:ring-stone-900 focus:outline-none">
                            <option value="1">1 Orang (Solo Traveler)</option>
                            <option value="2" selected>2 Orang (Pasangan / Sahabat)</option>
                            <option value="4">4 Orang (Keluarga Kecil)</option>
                            <option value="6">6 Orang (Grup Privat)</option>
                            <option value="10">10+ Orang (Rombongan)</option>
                        </select>
                    </div>

                    <!-- Tombol Cari -->
                    <div class="md:col-span-2">
                        <button type="submit" class="w-full py-3.5 px-5 rounded-xl bg-stone-900 hover:bg-stone-800 text-white dark:bg-stone-100 dark:text-stone-900 dark:hover:bg-white font-bold text-sm shadow-md transition-all flex items-center justify-center gap-2 active:scale-95">
                            <i class="fa-solid fa-magnifying-glass"></i>
                            <span data-i18n="heroBtnSearch">Cari Wisata</span>
                        </button>
                    </div>
                </form>

                <!-- Popular Quick Tags -->
                <div class="mt-4 pt-3 border-t border-stone-100 dark:border-stone-800 flex flex-wrap items-center gap-2 text-xs text-stone-500 dark:text-stone-400">
                    <span data-i18n="heroPopSearch" class="font-semibold">Pencarian Populer:</span>
                    <button onclick="quickFilter('Pantai')" data-i18n="heroPopRajaAmpat" class="px-2.5 py-1 rounded-lg bg-stone-100 dark:bg-stone-800 hover:bg-stone-200 dark:hover:bg-stone-700 text-stone-700 dark:text-stone-300 transition-colors">🏝️ Kepulauan Raja Ampat</button>
                    <button onclick="quickFilter('Pegunungan')" data-i18n="heroPopBromo" class="px-2.5 py-1 rounded-lg bg-stone-100 dark:bg-stone-800 hover:bg-stone-200 dark:hover:bg-stone-700 text-stone-700 dark:text-stone-300 transition-colors">🌋 Sunrise Gunung Bromo</button>
                    <button onclick="quickFilter('Budaya')" data-i18n="heroPopBorobudur" class="px-2.5 py-1 rounded-lg bg-stone-100 dark:bg-stone-800 hover:bg-stone-200 dark:hover:bg-stone-700 text-stone-700 dark:text-stone-300 transition-colors">🛕 Candi Borobudur</button>
                    <button onclick="quickFilter('Alam')" data-i18n="heroPopKomodo" class="px-2.5 py-1 rounded-lg bg-stone-100 dark:bg-stone-800 hover:bg-stone-200 dark:hover:bg-stone-700 text-stone-700 dark:text-stone-300 transition-colors">🐉 Taman Nasional Komodo</button>
                </div>
            </div>
        </div>
    </section>

    <!-- ================= 2. DESTINASI POPULER (CLEAN WHITE EDITORIAL CARDS) ================= -->
    <section id="destinasi" class="py-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Section Header -->
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-10 gap-5 pb-6 border-b border-stone-200/80 dark:border-stone-800">
            <div>
                <span data-i18n="destSubtitle" class="text-xs font-semibold text-stone-500 dark:text-stone-400 uppercase tracking-wider block mb-1">
                    Jurnal Destinasi
                </span>
                <h2 data-i18n="destTitle" class="font-serif text-3xl sm:text-4xl font-normal text-stone-950 dark:text-white tracking-tight">
                    Tempat-Tempat Istimewa di Bumi Pertiwi
                </h2>
                <p data-i18n="destDesc" class="mt-2 text-stone-600 dark:text-stone-400 max-w-xl text-xs sm:text-sm leading-relaxed">
                    Setiap lokasi dikurasi dengan cermat: memilih musim terbaik, penginapan berkarakter, dan rute santai yang bersahabat dengan alam.
                </p>
            </div>

            <!-- Tombol Lihat Halaman di Samping Judul -->
            <div class="shrink-0">
                <a href="{{ route('destinations.index') }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-full border border-stone-300 dark:border-stone-700 hover:border-stone-900 dark:hover:border-stone-200 bg-white dark:bg-stone-900 hover:bg-stone-900 hover:text-white dark:hover:bg-stone-100 dark:hover:text-stone-900 text-stone-800 dark:text-stone-200 text-xs font-semibold transition-all whitespace-nowrap shadow-xs group" title="Buka Halaman Lengkap Destinasi">
                    <span data-i18n="destBtnViewAll">Lihat Halaman Destinasi</span>
                    <i class="fa-solid fa-arrow-right text-[10px] group-hover:translate-x-1 transition-transform"></i>
                </a>
            </div>
        </div>

        <!-- Category Filter Pills -->
        <div id="categoryButtons" class="flex items-center gap-2 overflow-x-auto pb-4 mb-8 no-scrollbar text-xs">
            <button onclick="setCategory('Semua')" data-cat="Semua" data-i18n="catAll" class="cat-btn px-4 py-2 rounded-full font-semibold transition-all whitespace-nowrap bg-stone-900 text-white dark:bg-white dark:text-stone-900 shadow-sm">
                Semua Koleksi
            </button>
            <button onclick="setCategory('Pantai')" data-cat="Pantai" data-i18n="catBeach" class="cat-btn px-4 py-2 rounded-full font-medium transition-all whitespace-nowrap bg-stone-100 dark:bg-stone-900 text-stone-700 dark:text-stone-300 border border-stone-200/80 dark:border-stone-800 hover:border-stone-400">
                Pantai & Perairan Karst
            </button>
            <button onclick="setCategory('Pegunungan')" data-cat="Pegunungan" data-i18n="catMountain" class="cat-btn px-4 py-2 rounded-full font-medium transition-all whitespace-nowrap bg-stone-100 dark:bg-stone-900 text-stone-700 dark:text-stone-300 border border-stone-200/80 dark:border-stone-800 hover:border-stone-400">
                Puncak & Kaldera Dingin
            </button>
            <button onclick="setCategory('Budaya')" data-cat="Budaya" data-i18n="catCulture" class="cat-btn px-4 py-2 rounded-full font-medium transition-all whitespace-nowrap bg-stone-100 dark:bg-stone-900 text-stone-700 dark:text-stone-300 border border-stone-200/80 dark:border-stone-800 hover:border-stone-400">
                Sejarah & Perkampungan Adat
            </button>
            <button onclick="setCategory('Alam')" data-cat="Alam" data-i18n="catNature" class="cat-btn px-4 py-2 rounded-full font-medium transition-all whitespace-nowrap bg-stone-100 dark:bg-stone-900 text-stone-700 dark:text-stone-300 border border-stone-200/80 dark:border-stone-800 hover:border-stone-400">
                Eksotisme Rimba & Satwa
            </button>
        </div>

        <!-- Destinations Grid Container -->
        <div id="destinationsGrid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($destinations as $dest)
                <article 
                    onclick="openDetailModal({{ $dest->id }})" 
                    class="group bg-white dark:bg-stone-900 rounded-3xl overflow-hidden border border-stone-200/90 dark:border-stone-800 hover:border-stone-400 dark:hover:border-stone-600 hover:shadow-xl transition-all duration-300 flex flex-col cursor-pointer"
                >
                    <!-- Image Container with Natural Ratio -->
                    <div class="relative h-64 overflow-hidden bg-stone-100">
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
                    <div class="p-6 flex-1 flex flex-col justify-between">
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
    <section id="paket" class="py-20 bg-stone-50 dark:bg-stone-900/50 border-y border-stone-200/80 dark:border-stone-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-10 gap-4 pb-4 border-b border-stone-200/80 dark:border-stone-800">
                <div>
                    <span data-i18n="pkgSubtitle" class="text-xs font-semibold text-stone-500 uppercase tracking-wider block mb-1">
                        Boutique Itinerary
                    </span>
                    <h2 data-i18n="pkgTitle" class="font-serif text-3xl sm:text-4xl font-normal text-stone-950 dark:text-white tracking-tight">
                        Paket Perjalanan Terkurasi
                    </h2>
                    <p data-i18n="pkgDesc" class="mt-2 text-stone-600 dark:text-stone-400 text-xs sm:text-sm max-w-xl leading-relaxed">
                        Sudah mencakup kabin/hotel yang bersih dan estetik, transportasi darat & laut privat, tiket kawasan konservasi, serta santap hidangan lokal segar.
                    </p>
                </div>

                <!-- Tombol Lihat Halaman Paket di Samping Judul -->
                <div class="shrink-0">
                    <a href="{{ route('packages.index') }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-full border border-stone-300 dark:border-stone-700 hover:border-stone-900 dark:hover:border-stone-200 bg-white dark:bg-stone-900 hover:bg-stone-900 hover:text-white dark:hover:bg-stone-100 dark:hover:text-stone-900 text-stone-800 dark:text-stone-200 text-xs font-semibold transition-all whitespace-nowrap shadow-xs group" title="Buka Halaman Lengkap Paket Wisata">
                        <span data-i18n="pkgHeaderBtn">Lihat Seluruh Paket Wisata</span>
                        <i class="fa-solid fa-arrow-right text-[10px] group-hover:translate-x-1 transition-transform"></i>
                    </a>
                </div>
            </div>

            <!-- Packages Grid -->
            <div id="packagesGrid" class="grid grid-cols-1 lg:grid-cols-3 gap-8">
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
                        <span data-i18n="storyPrinciple" class="block text-[11px] text-stone-400 mt-2">— Prinsip Perjalanan ANWISATA</span>
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
                    Kami mendirikan ANWISATA sebagai portal pariwisata Indonesia untuk menghadirkan rute perjalanan yang autentik, menghormati alam, dan mendekatkan Anda dengan kehangatan warga lokal.
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
    <section id="galeri" class="py-20 bg-stone-100/70 dark:bg-stone-900 border-t border-stone-200/80 dark:border-stone-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-10 gap-3">
                <div>
                    <span data-i18n="gallerySubtitle" class="text-xs font-semibold text-stone-500 uppercase tracking-wider block mb-1">Lensa Perjalanan</span>
                    <h2 data-i18n="galleryTitle" class="font-serif text-3xl font-normal text-stone-950 dark:text-white">
                        Momen-Momen yang Tertangkap
                    </h2>
                </div>
                <p data-i18n="galleryDesc" class="text-xs text-stone-500 max-w-sm">
                    Klik pada foto untuk melihat catatan lokasi dan suasana perjalanan saat kamera merekamnya.
                </p>
            </div>

            <div id="galleryGrid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
                @foreach($gallery as $item)
                    <div onclick="openLightbox('{{ $item->image_url }}', '{{ addslashes($item->title) }}', '{{ addslashes($item->sub_title) }}')" class="group relative h-64 rounded-2xl overflow-hidden cursor-pointer bg-stone-200 dark:bg-stone-800">
                        <img 
                            src="{{ $item->image_url }}" 
                            alt="{{ $item->title }}" 
                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                        >
                        <div class="absolute inset-0 bg-stone-950/40 opacity-0 group-hover:opacity-100 transition-opacity flex flex-col justify-end p-4 text-white">
                            <span class="text-xs font-serif font-semibold">{{ $item->title }}</span>
                            <span class="text-[11px] text-stone-300 mt-0.5">{{ $item->sub_title }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- ================= 6. TESTIMONI CATATAN TAMU ================= -->
    <section id="testimoni" class="py-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-2xl mx-auto mb-12">
            <span data-i18n="testiSubtitle" class="text-xs font-semibold text-stone-500 uppercase tracking-wider block mb-1">
                Catatan Tamu
            </span>
            <h2 data-i18n="testiTitle" class="font-serif text-3xl sm:text-4xl font-normal text-stone-950 dark:text-white">
                Cerita dari Mereka yang Pernah Ikut
            </h2>
            <p data-i18n="testiDesc" class="mt-2 text-stone-600 dark:text-stone-400 text-xs sm:text-sm">
                Bukan ulasan palsu atau bintang buatan. Ini adalah pesan nyata yang kami terima dari teman-teman yang telah pulang dengan hati gembira.
            </p>
        </div>

        <div id="testimonialGrid" class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($testimonials as $t)
                <div class="p-6 rounded-3xl bg-white dark:bg-stone-900 border border-stone-200 dark:border-stone-800 shadow-xs flex flex-col justify-between">
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

                    <div class="flex items-center gap-3 mt-6 pt-4 border-t border-stone-100 dark:border-stone-800">
                        <img 
                            src="{{ $t->avatar }}" 
                            alt="{{ $t->name }}" 
                            class="w-10 h-10 rounded-full object-cover"
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
        <div class="mt-14 rounded-3xl bg-stone-900 text-white p-8 sm:p-10 flex flex-col sm:flex-row items-center justify-between gap-6 shadow-sm">
            <div class="max-w-xl text-center sm:text-left">
                <span data-i18n="promoHeader" class="text-[11px] uppercase tracking-wider text-stone-400 font-medium">Rencana Liburan Bareng Sahabat atau Keluarga?</span>
                <h3 data-i18n="promoTitle" class="font-serif text-2xl font-normal mt-1.5">
                    Gunakan Kode Voucher <span class="underline decoration-stone-500 font-mono text-amber-200">PESONAID</span> untuk Diskon 15%
                </h3>
                <p data-i18n="promoDesc" class="text-stone-400 text-xs mt-1 leading-relaxed">
                    Berlaku untuk simulasi dan pemesanan seluruh rute private tour dan open trip kami bulan ini.
                </p>
            </div>
            <div class="flex items-center gap-3 shrink-0">
                <button onclick="copyVoucherCode()" data-i18n="promoCopy" class="px-4 py-2.5 rounded-full border border-stone-700 hover:bg-stone-800 text-xs font-medium transition-colors">
                    Salin Kode
                </button>
                <button onclick="openBookingModal('Sailing Phinisi Labuan Bajo (Private Cabin)')" data-i18n="promoPlan" class="px-5 py-2.5 rounded-full bg-white text-stone-900 hover:bg-stone-100 text-xs font-semibold shadow-sm transition-all">
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

    function renderDestinationsGrid() {
        const grid = document.getElementById('destinationsGrid');
        if (!grid) return;
        const kwElem = document.getElementById('destinationKeyword');
        const keyword = kwElem ? kwElem.value.toLowerCase().trim() : '';
        const sortElem = document.getElementById('destinationSort');
        const sortBy = sortElem ? sortElem.value : 'popular';

        let filtered = destinationsDatabase.filter(item => {
            const matchCategory = activeCategory === 'Semua' || item.category === activeCategory;
            const matchRegion = activeRegionFilter === 'Semua' || item.region === activeRegionFilter;
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
                <article onclick="openDetailModal(${dest.id})" class="group bg-white dark:bg-stone-900 rounded-3xl overflow-hidden border border-stone-200/90 dark:border-stone-800 hover:border-stone-400 dark:hover:border-stone-600 hover:shadow-xl transition-all duration-300 flex flex-col cursor-pointer">
                    <div class="relative h-64 overflow-hidden bg-stone-100">
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

                    <div class="p-6 flex-1 flex flex-col justify-between">
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
        setCategory('Semua');
    }

    function handleHeroSearch(e) {
        e.preventDefault();
        const loc = document.getElementById('searchLocation').value;
        const date = document.getElementById('searchDate').value;
        const pax = document.getElementById('searchPax').value;

        activeRegionFilter = loc;
        setCategory('Semua');

        if (document.getElementById('bookDate')) document.getElementById('bookDate').value = date;
        if (document.getElementById('bookPax')) document.getElementById('bookPax').value = pax;

        document.getElementById('destinasi').scrollIntoView({ behavior: 'smooth' });
        showToast(`Mencari destinasi di ${loc}`, 'success');
        renderDestinationsGrid();
    }

    document.addEventListener('DOMContentLoaded', () => {
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
