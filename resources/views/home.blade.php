@extends('layouts.app')

@section('title', 'NusantaraWander — Jelajahi Keajaiban Wisata Indonesia')
@section('meta_description', 'Temukan surga tersembunyi di Raja Ampat, Bromo, Labuan Bajo, Borobudur, dan ribuan pulau eksotis Indonesia dengan layanan tur all-inclusive terbaik.')

@section('content')
    <!-- ================= 2. HERO SECTION & INTERACTIVE SEARCH WIDGET ================= -->
    <section id="beranda" class="relative min-h-[92vh] pt-28 pb-20 flex items-center justify-center overflow-hidden">
        <!-- Background Image with Fallback -->
        <img 
            src="https://images.unsplash.com/photo-1518548419970-58e3b4079ab2?auto=format&fit=crop&w=2000&q=85" 
            onerror="this.src='https://placehold.co/1920x1080/0e4437/ffffff?text=Pesona+Alam+Indonesia'"
            alt="Pemandangan Alam Kepulauan Indonesia" 
            class="absolute inset-0 w-full h-full object-cover object-center scale-105 transition-transform duration-1000"
        >
        <div class="absolute inset-0 hero-gradient"></div>

        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
            <div class="max-w-3xl mx-auto text-center text-white">
                <!-- Pill Badge -->
                <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white/15 backdrop-blur-md border border-white/25 text-xs sm:text-sm font-medium mb-6 animate-float">
                    <span class="w-2 h-2 rounded-full bg-emerald-400 animate-ping"></span>
                    <span>Eksplorasi 17.000+ Pulau Eksotis di Zamrud Khatulistiwa</span>
                </div>

                <!-- Inspiring Headline -->
                <h1 class="font-serif text-4xl sm:text-5xl lg:text-6xl font-bold leading-tight tracking-tight mb-6">
                    Temukan Surga Tersembunyi di <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-300 via-teal-200 to-amber-200 italic">Bumi Nusantara</span>
                </h1>

                <p class="text-base sm:text-lg text-slate-200/90 leading-relaxed mb-10 max-w-2xl mx-auto">
                    Dari birunya perairan Raja Ampat, megahnya kabut pagi Borobudur, hingga hangatnya senja di Labuan Bajo. Wujudkan perjalanan impian Anda bersama pemandu lokal terbaik.
                </p>

                <!-- Quick Stats -->
                <div class="grid grid-cols-3 gap-4 max-w-lg mx-auto mb-12 text-center">
                    <div class="p-3 rounded-2xl bg-white/10 backdrop-blur-sm border border-white/15">
                        <p class="text-xl sm:text-2xl font-extrabold text-emerald-300">120+</p>
                        <p class="text-xs text-slate-200">Destinasi Unggulan</p>
                    </div>
                    <div class="p-3 rounded-2xl bg-white/10 backdrop-blur-sm border border-white/15">
                        <p class="text-xl sm:text-2xl font-extrabold text-amber-300">4.9/5</p>
                        <p class="text-xs text-slate-200">Rating Wisatawan</p>
                    </div>
                    <div class="p-3 rounded-2xl bg-white/10 backdrop-blur-sm border border-white/15">
                        <p class="text-xl sm:text-2xl font-extrabold text-teal-300">45K+</p>
                        <p class="text-xs text-slate-200">Pelanggan Puas</p>
                    </div>
                </div>
            </div>

            <!-- Interactive Search Widget -->
            <div class="max-w-5xl mx-auto bg-white dark:bg-slate-900 rounded-3xl p-4 sm:p-6 shadow-2xl border border-slate-100 dark:border-slate-800">
                <form id="heroSearchForm" onsubmit="handleHeroSearch(event)" class="grid grid-cols-1 md:grid-cols-12 gap-4 items-end">
                    <!-- Lokasi Tujuan -->
                    <div class="md:col-span-4">
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400 mb-2">
                            <i class="fa-solid fa-location-dot text-brand-600 mr-1.5"></i> Lokasi Tujuan
                        </label>
                        <select id="searchLocation" class="w-full px-4 py-3 rounded-xl bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-slate-800 dark:text-slate-100 font-medium text-sm focus:ring-2 focus:ring-brand-500 focus:outline-none">
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
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400 mb-2">
                            <i class="fa-regular fa-calendar-days text-brand-600 mr-1.5"></i> Tanggal Berangkat
                        </label>
                        <input type="date" id="searchDate" required class="w-full px-4 py-3 rounded-xl bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-slate-800 dark:text-slate-100 font-medium text-sm focus:ring-2 focus:ring-brand-500 focus:outline-none">
                    </div>

                    <!-- Jumlah Peserta -->
                    <div class="md:col-span-3">
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400 mb-2">
                            <i class="fa-solid fa-user-group text-brand-600 mr-1.5"></i> Jumlah Peserta
                        </label>
                        <select id="searchPax" class="w-full px-4 py-3 rounded-xl bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-slate-800 dark:text-slate-100 font-medium text-sm focus:ring-2 focus:ring-brand-500 focus:outline-none">
                            <option value="1">1 Orang (Solo Traveler)</option>
                            <option value="2" selected>2 Orang (Pasangan / Sahabat)</option>
                            <option value="4">4 Orang (Keluarga Kecil)</option>
                            <option value="6">6 Orang (Grup Privat)</option>
                            <option value="10">10+ Orang (Rombongan)</option>
                        </select>
                    </div>

                    <!-- Tombol Cari -->
                    <div class="md:col-span-2">
                        <button type="submit" class="w-full py-3.5 px-5 rounded-xl bg-gradient-to-r from-brand-600 to-teal-600 hover:from-brand-700 hover:to-teal-700 text-white font-bold text-sm shadow-lg shadow-brand-600/30 transition-all flex items-center justify-center gap-2 active:scale-95">
                            <i class="fa-solid fa-magnifying-glass"></i>
                            <span>Cari Wisata</span>
                        </button>
                    </div>
                </form>

                <!-- Popular Quick Tags -->
                <div class="mt-4 pt-3 border-t border-slate-100 dark:border-slate-800 flex flex-wrap items-center gap-2 text-xs text-slate-500 dark:text-slate-400">
                    <span class="font-semibold">Pencarian Populer:</span>
                    <button onclick="quickFilter('Pantai')" class="px-2.5 py-1 rounded-lg bg-slate-100 dark:bg-slate-800 hover:bg-brand-50 dark:hover:bg-brand-900/40 hover:text-brand-600 transition-colors">🏝️ Kepulauan Raja Ampat</button>
                    <button onclick="quickFilter('Pegunungan')" class="px-2.5 py-1 rounded-lg bg-slate-100 dark:bg-slate-800 hover:bg-brand-50 dark:hover:bg-brand-900/40 hover:text-brand-600 transition-colors">🌋 Sunrise Gunung Bromo</button>
                    <button onclick="quickFilter('Budaya')" class="px-2.5 py-1 rounded-lg bg-slate-100 dark:bg-slate-800 hover:bg-brand-50 dark:hover:bg-brand-900/40 hover:text-brand-600 transition-colors">🛕 Candi Borobudur</button>
                    <button onclick="quickFilter('Alam')" class="px-2.5 py-1 rounded-lg bg-slate-100 dark:bg-slate-800 hover:bg-brand-50 dark:hover:bg-brand-900/40 hover:text-brand-600 transition-colors">🐉 Taman Nasional Komodo</button>
                </div>
            </div>
        </div>
    </section>

    <!-- ================= 3. DESTINASI POPULER SECTION ================= -->
    <section id="destinasi" class="py-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Section Header -->
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-10 gap-6">
            <div>
                <span class="inline-block px-3.5 py-1 rounded-full bg-brand-100 dark:bg-brand-900/50 text-brand-700 dark:text-brand-300 text-xs font-bold uppercase tracking-wider mb-3">
                    Eksplorasi Nusantara
                </span>
                <h2 class="font-serif text-3xl sm:text-4xl font-bold text-slate-900 dark:text-white">
                    Destinasi Populer Pilihan
                </h2>
                <p class="mt-2 text-slate-600 dark:text-slate-400 max-w-xl text-sm sm:text-base">
                    Pilih kategori destinasi sesuai minat petualangan Anda, mulai dari wisata bahari kelas dunia hingga warisan budaya leluhur.
                </p>
            </div>

            <!-- Search Input & Sort inside Destination Section -->
            <div class="flex flex-col sm:flex-row gap-3">
                <div class="relative">
                    <i class="fa-solid fa-magnifying-glass absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-sm"></i>
                    <input 
                        type="text" 
                        id="destinationKeyword" 
                        oninput="filterAndRenderDestinations()" 
                        placeholder="Cari nama destinasi..." 
                        class="pl-9 pr-4 py-2.5 rounded-xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 text-sm focus:ring-2 focus:ring-brand-500 focus:outline-none w-full sm:w-56"
                    >
                </div>
                <select id="destinationSort" onchange="filterAndRenderDestinations()" class="px-4 py-2.5 rounded-xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 text-sm font-medium focus:ring-2 focus:ring-brand-500 focus:outline-none">
                    <option value="popular">Urutkan: Terpopuler</option>
                    <option value="price-asc">Harga: Terendah ke Tinggi</option>
                    <option value="price-desc">Harga: Tertinggi ke Rendah</option>
                    <option value="rating">Rating Tertinggi</option>
                </select>
            </div>
        </div>

        <!-- Category Filter Pills -->
        <div id="categoryButtons" class="flex items-center gap-2.5 overflow-x-auto pb-4 mb-8 no-scrollbar">
            <button onclick="setCategory('Semua')" data-cat="Semua" class="cat-btn px-5 py-2.5 rounded-xl text-sm font-bold transition-all whitespace-nowrap bg-brand-600 text-white shadow-md shadow-brand-600/25">
                <i class="fa-solid fa-border-all mr-1.5"></i> Semua Kategori
            </button>
            <button onclick="setCategory('Pantai')" data-cat="Pantai" class="cat-btn px-5 py-2.5 rounded-xl text-sm font-semibold transition-all whitespace-nowrap bg-white dark:bg-slate-900 text-slate-600 dark:text-slate-300 border border-slate-200 dark:border-slate-800 hover:border-brand-500">
                <i class="fa-solid fa-umbrella-beach mr-1.5 text-sky-500"></i> Pantai & Bahari
            </button>
            <button onclick="setCategory('Pegunungan')" data-cat="Pegunungan" class="cat-btn px-5 py-2.5 rounded-xl text-sm font-semibold transition-all whitespace-nowrap bg-white dark:bg-slate-900 text-slate-600 dark:text-slate-300 border border-slate-200 dark:border-slate-800 hover:border-brand-500">
                <i class="fa-solid fa-mountain-sun mr-1.5 text-emerald-500"></i> Pegunungan
            </button>
            <button onclick="setCategory('Budaya')" data-cat="Budaya" class="cat-btn px-5 py-2.5 rounded-xl text-sm font-semibold transition-all whitespace-nowrap bg-white dark:bg-slate-900 text-slate-600 dark:text-slate-300 border border-slate-200 dark:border-slate-800 hover:border-brand-500">
                <i class="fa-solid fa-gopuram mr-1.5 text-amber-500"></i> Budaya & Sejarah
            </button>
            <button onclick="setCategory('Alam')" data-cat="Alam" class="cat-btn px-5 py-2.5 rounded-xl text-sm font-semibold transition-all whitespace-nowrap bg-white dark:bg-slate-900 text-slate-600 dark:text-slate-300 border border-slate-200 dark:border-slate-800 hover:border-brand-500">
                <i class="fa-solid fa-tree mr-1.5 text-teal-500"></i> Eksotisme Alam
            </button>
        </div>

        <!-- Destinations Grid Container -->
        <div id="destinationsGrid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-7">
            @foreach($destinations as $dest)
                <article class="card-zoom group bg-white dark:bg-slate-900 rounded-3xl overflow-hidden border border-slate-200/80 dark:border-slate-800 shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col">
                    <!-- Image Header -->
                    <div class="relative h-60 overflow-hidden">
                        <img 
                            src="{{ $dest->image }}" 
                            onerror="this.src='https://placehold.co/600x400/148364/ffffff?text={{ urlencode($dest->name) }}'"
                            alt="{{ $dest->name }}" 
                            class="card-img w-full h-full object-cover transition-transform duration-500"
                        >
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-950/75 via-transparent to-transparent"></div>
                        
                        <!-- Category Badge -->
                        <span class="absolute top-4 left-4 px-3 py-1 rounded-full bg-slate-900/75 backdrop-blur-md text-white text-xs font-bold">
                            {{ $dest->category }}
                        </span>

                        <!-- Wishlist Heart Button -->
                        <button onclick="toggleWishlist({{ $dest->id }}, '{{ addslashes($dest->name) }}')" class="wishlist-btn absolute top-4 right-4 w-9 h-9 rounded-full bg-white/90 dark:bg-slate-900/90 flex items-center justify-center shadow-md hover:scale-110 transition-transform" data-id="{{ $dest->id }}" title="Simpan ke Favorit">
                            <i class="fa-regular text-slate-600 dark:text-slate-300 fa-heart"></i>
                        </button>

                        <!-- Location & Rating on Image Bottom -->
                        <div class="absolute bottom-3 left-4 right-4 flex items-center justify-between text-white text-xs">
                            <span class="flex items-center gap-1.5 font-medium truncate pr-2">
                                <i class="fa-solid fa-location-dot text-emerald-400"></i>
                                {{ $dest->location }}
                            </span>
                            <span class="px-2.5 py-1 rounded-lg bg-amber-400 text-slate-950 font-extrabold flex items-center gap-1 shrink-0">
                                <i class="fa-solid fa-star text-[10px]"></i> {{ number_format($dest->rating, 2) }}
                            </span>
                        </div>
                    </div>

                    <!-- Card Content -->
                    <div class="p-6 flex-1 flex flex-col justify-between">
                        <div>
                            <div class="flex items-center gap-2 text-xs text-slate-400 mb-1.5">
                                <span><i class="fa-regular fa-clock mr-1"></i> {{ $dest->duration }}</span>
                                <span>•</span>
                                <span>{{ $dest->reviews_count }} ulasan</span>
                            </div>
                            <h3 class="font-serif text-xl font-bold text-slate-900 dark:text-white group-hover:text-brand-600 dark:group-hover:text-brand-400 transition-colors">
                                <a href="{{ route('destinations.show', $dest->slug) }}">{{ $dest->name }}</a>
                            </h3>
                            <p class="mt-2 text-xs sm:text-sm text-slate-600 dark:text-slate-400 line-clamp-2 leading-relaxed">
                                {{ $dest->description }}
                            </p>
                        </div>

                        <!-- Price & Detail Button -->
                        <div class="mt-6 pt-4 border-t border-slate-100 dark:border-slate-800 flex items-center justify-between gap-2">
                            <div>
                                <p class="text-[11px] uppercase tracking-wider text-slate-400 font-semibold">Mulai dari</p>
                                <p class="text-lg font-extrabold text-brand-600 dark:text-brand-400">{{ $dest->formatted_price }}<span class="text-xs font-normal text-slate-400">/org</span></p>
                            </div>
                            <div class="flex items-center gap-1.5">
                                <button onclick="openDetailModal({{ $dest->id }})" class="px-3.5 py-2 rounded-xl bg-brand-50 dark:bg-brand-900/40 hover:bg-brand-600 text-brand-700 dark:text-brand-300 hover:text-white text-xs sm:text-sm font-bold transition-all flex items-center gap-1">
                                    <span>Detail</span>
                                    <i class="fa-solid fa-arrow-right text-xs"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>
    </section>

    <!-- ================= 4. PAKET WISATA UNGGULAN SECTION ================= -->
    <section id="paket" class="py-20 bg-slate-100/80 dark:bg-slate-900/60 border-y border-slate-200/70 dark:border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-2xl mx-auto mb-14">
                <span class="inline-block px-3.5 py-1 rounded-full bg-amber-100 dark:bg-amber-900/40 text-amber-700 dark:text-amber-300 text-xs font-bold uppercase tracking-wider mb-3">
                    Penawaran Terbaik
                </span>
                <h2 class="font-serif text-3xl sm:text-4xl font-bold text-slate-900 dark:text-white">
                    Paket Wisata All-Inclusive
                </h2>
                <p class="mt-3 text-slate-600 dark:text-slate-400 text-sm sm:text-base">
                    Nikmati liburan bebas repot. Seluruh akomodasi hotel berbintang, transportasi lokal, tiket masuk wisata, hingga dokumentasi drone sudah termasuk.
                </p>
            </div>

            <!-- Packages Grid -->
            <div id="packagesGrid" class="grid grid-cols-1 lg:grid-cols-3 gap-8">
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

                        <button onclick="openBookingModal('{{ addslashes($pkg->name) }}')" class="w-full py-3.5 px-5 rounded-xl {{ $idx === 0 ? 'bg-gradient-to-r from-brand-600 to-teal-600 text-white shadow-lg shadow-brand-600/25' : 'bg-slate-900 dark:bg-white text-white dark:text-slate-900' }} hover:opacity-95 font-bold text-sm transition-all flex items-center justify-center gap-2">
                            <span>Pilih Paket Wisata Ini</span>
                            <i class="fa-solid fa-arrow-right text-xs"></i>
                        </button>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- ================= 5. KEUNGGULAN LAYANAN (MENGAPA MEMILIH KAMI) ================= -->
    <section id="keunggulan" class="py-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            <!-- Left Visual Collage -->
            <div class="lg:col-span-5 relative">
                <div class="relative rounded-3xl overflow-hidden shadow-2xl border-4 border-white dark:border-slate-800">
                    <img 
                        src="https://images.unsplash.com/photo-1537996194471-e657df975ab4?auto=format&fit=crop&w=900&q=80" 
                        onerror="this.src='https://placehold.co/800x1000/148364/ffffff?text=Budaya+Bali'"
                        alt="Keindahan Budaya Indonesia" 
                        class="w-full h-[440px] object-cover"
                    >
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-transparent to-transparent flex items-end p-6">
                        <div class="text-white">
                            <p class="text-xs uppercase tracking-widest text-emerald-300 font-bold">Mitra Resmi Pariwisata</p>
                            <p class="text-lg font-serif font-semibold mt-1">"Setiap perjalanan dirancang dengan menghormati kelestarian alam & warga lokal."</p>
                        </div>
                    </div>
                </div>

                <!-- Floating Trust Card -->
                <div class="hidden sm:flex items-center gap-4 bg-white dark:bg-slate-800 p-4 rounded-2xl shadow-xl border border-slate-100 dark:border-slate-700 absolute -bottom-6 -right-6 max-w-xs">
                    <div class="w-12 h-12 rounded-xl bg-emerald-100 dark:bg-emerald-900/50 text-emerald-600 dark:text-emerald-400 flex items-center justify-center text-xl shrink-0">
                        <i class="fa-solid fa-shield-heart"></i>
                    </div>
                    <div>
                        <h4 class="font-bold text-sm text-slate-900 dark:text-white">Garansi Kepuasan 100%</h4>
                        <p class="text-xs text-slate-500 dark:text-slate-400">Reschedule fleksibel & asuransi perjalanan penuh.</p>
                    </div>
                </div>
            </div>

            <!-- Right Benefits Content -->
            <div class="lg:col-span-7">
                <span class="inline-block px-3.5 py-1 rounded-full bg-brand-100 dark:bg-brand-900/50 text-brand-700 dark:text-brand-300 text-xs font-bold uppercase tracking-wider mb-3">
                    Mengapa Memilih NusantaraWander?
                </span>
                <h2 class="font-serif text-3xl sm:text-4xl font-bold text-slate-900 dark:text-white leading-tight">
                    Pengalaman Perjalanan Autentik dengan Standar Kenyamanan Terbaik
                </h2>
                <p class="mt-4 text-slate-600 dark:text-slate-400 text-sm sm:text-base leading-relaxed">
                    Kami bukan sekadar agen perjalanan biasa. Tim kurator perjalanan kami terjun langsung ke setiap sudut kepulauan Indonesia untuk memastikan keamanan, kenyamanan, dan kehangatan lokal terbaik bagi Anda.
                </p>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mt-8">
                    <!-- Feature 1 -->
                    <div class="p-5 rounded-2xl bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-slate-800 shadow-sm hover:shadow-md transition-shadow">
                        <div class="w-11 h-11 rounded-xl bg-brand-50 dark:bg-brand-900/40 text-brand-600 dark:text-brand-400 flex items-center justify-center text-lg mb-4">
                            <i class="fa-solid fa-user-tie"></i>
                        </div>
                        <h3 class="font-bold text-base text-slate-900 dark:text-white mb-1.5">Pemandu Lokal Tersertifikasi</h3>
                        <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-400 leading-relaxed">
                            Didampingi pemandu asli daerah setempat yang ramah, menguasai cerita sejarah, serta spot foto tersembunyi.
                        </p>
                    </div>

                    <!-- Feature 2 -->
                    <div class="p-5 rounded-2xl bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-slate-800 shadow-sm hover:shadow-md transition-shadow">
                        <div class="w-11 h-11 rounded-xl bg-amber-50 dark:bg-amber-900/40 text-amber-600 dark:text-amber-400 flex items-center justify-center text-lg mb-4">
                            <i class="fa-solid fa-wallet"></i>
                        </div>
                        <h3 class="font-bold text-base text-slate-900 dark:text-white mb-1.5">Harga Transparan Tanpa Biaya Tersembunyi</h3>
                        <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-400 leading-relaxed">
                            Seluruh rincian biaya tiket, pajak konservasi, hingga makan tertera jelas sejak awal pemesanan.
                        </p>
                    </div>

                    <!-- Feature 3 -->
                    <div class="p-5 rounded-2xl bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-slate-800 shadow-sm hover:shadow-md transition-shadow">
                        <div class="w-11 h-11 rounded-xl bg-sky-50 dark:bg-sky-900/40 text-sky-600 dark:text-sky-400 flex items-center justify-center text-lg mb-4">
                            <i class="fa-solid fa-camera-retro"></i>
                        </div>
                        <h3 class="font-bold text-base text-slate-900 dark:text-white mb-1.5">Dokumentasi Foto & Drone Gratis</h3>
                        <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-400 leading-relaxed">
                            Abadikan momen liburan sinematik Anda dengan fotografer perjalanan dan pilot drone di paket unggulan.
                        </p>
                    </div>

                    <!-- Feature 4 -->
                    <div class="p-5 rounded-2xl bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-slate-800 shadow-sm hover:shadow-md transition-shadow">
                        <div class="w-11 h-11 rounded-xl bg-rose-50 dark:bg-rose-900/40 text-rose-600 dark:text-rose-400 flex items-center justify-center text-lg mb-4">
                            <i class="fa-solid fa-headset"></i>
                        </div>
                        <h3 class="font-bold text-base text-slate-900 dark:text-white mb-1.5">Layanan Darurat & Konsultasi 24/7</h3>
                        <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-400 leading-relaxed">
                            Tim bantuan perjalanan kami siap mendampingi Anda kapan pun selama berada di lokasi wisata.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ================= 6. GALERI NUSANTARA INTERAKTIF ================= -->
    <section id="galeri" class="py-20 bg-slate-900 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-4">
                <div>
                    <span class="inline-block px-3.5 py-1 rounded-full bg-teal-500/20 text-teal-300 border border-teal-500/30 text-xs font-bold uppercase tracking-wider mb-3">
                        Lensa Petualang
                    </span>
                    <h2 class="font-serif text-3xl sm:text-4xl font-bold">
                        Galeri Momen Nusantara
                    </h2>
                </div>
                <p class="text-slate-400 text-sm max-w-md">
                    Klik pada foto untuk melihat tampilan penuh dan informasi lokasi pengambilan gambar dari perjalanan wisatawan kami.
                </p>
            </div>

            <!-- Masonry-like Responsive Grid -->
            <div id="galleryGrid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
                @foreach($gallery as $item)
                    <div onclick="openLightbox('{{ $item->image_url }}', '{{ addslashes($item->title) }}', '{{ addslashes($item->sub_title) }}')" class="group relative h-72 rounded-2xl overflow-hidden cursor-pointer border border-white/10">
                        <img 
                            src="{{ $item->image_url }}" 
                            onerror="this.src='https://placehold.co/600x600/0e4437/ffffff?text=Galeri+Nusantara'"
                            alt="{{ $item->title }}" 
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                        >
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-950/90 via-slate-950/20 to-transparent opacity-80 group-hover:opacity-100 transition-opacity flex flex-col justify-end p-5">
                            <span class="w-8 h-8 rounded-full bg-white/20 backdrop-blur-md flex items-center justify-center text-white text-xs mb-2">
                                <i class="fa-solid fa-expand"></i>
                            </span>
                            <h4 class="font-bold text-sm text-white">{{ $item->title }}</h4>
                            <p class="text-[11px] text-slate-300 mt-0.5">{{ $item->sub_title }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- ================= 7. TESTIMONI WISATAWAN ================= -->
    <section id="testimoni" class="py-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-2xl mx-auto mb-14">
            <span class="inline-block px-3.5 py-1 rounded-full bg-brand-100 dark:bg-brand-900/50 text-brand-700 dark:text-brand-300 text-xs font-bold uppercase tracking-wider mb-3">
                Suara Wisatawan
            </span>
            <h2 class="font-serif text-3xl sm:text-4xl font-bold text-slate-900 dark:text-white">
                Cerita Mereka yang Telah Menjelajah
            </h2>
            <p class="mt-2 text-slate-600 dark:text-slate-400 text-sm sm:text-base">
                Lebih dari 45.000 wisatawan domestik dan mancanegara telah mempercayakan momen liburan mereka bersama NusantaraWander.
            </p>
        </div>

        <!-- Testimonials Grid -->
        <div id="testimonialGrid" class="grid grid-cols-1 md:grid-cols-3 gap-7">
            @foreach($testimonials as $t)
                <div class="p-6 sm:p-7 rounded-3xl bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-slate-800 shadow-sm flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex text-amber-400 text-xs gap-1">
                                @for($i = 0; $i < $t->rating; $i++)
                                    <i class="fa-solid fa-star"></i>
                                @endfor
                            </div>
                            <span class="px-2.5 py-1 rounded-lg bg-brand-50 dark:bg-brand-900/40 text-brand-700 dark:text-brand-300 text-[11px] font-bold">
                                {{ $t->trip }}
                            </span>
                        </div>
                        <p class="text-slate-600 dark:text-slate-300 text-sm leading-relaxed italic">
                            "{{ $t->comment }}"
                        </p>
                    </div>

                    <div class="flex items-center gap-3.5 mt-6 pt-4 border-t border-slate-100 dark:border-slate-800">
                        <img 
                            src="{{ $t->avatar }}" 
                            onerror="this.src='https://placehold.co/100x100/148364/ffffff?text=NW'"
                            alt="{{ $t->name }}" 
                            class="w-11 h-11 rounded-full object-cover"
                        >
                        <div>
                            <h4 class="font-bold text-sm text-slate-900 dark:text-white">{{ $t->name }}</h4>
                            <p class="text-xs text-slate-400">{{ $t->role }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Callout Banner -->
        <div class="mt-16 rounded-3xl bg-gradient-to-r from-brand-700 via-teal-700 to-emerald-800 p-8 sm:p-12 text-white shadow-2xl relative overflow-hidden">
            <div class="relative z-10 flex flex-col lg:flex-row items-center justify-between gap-8">
                <div class="max-w-xl text-center lg:text-left">
                    <span class="px-3 py-1 rounded-full bg-white/15 text-xs font-bold uppercase tracking-wider">Promo Spesial Bulan Ini</span>
                    <h3 class="font-serif text-2xl sm:text-4xl font-bold mt-3">
                        Diskon 15% untuk Pemesanan Grup & Keluarga!
                    </h3>
                    <p class="text-emerald-100 text-sm sm:text-base mt-2">
                        Gunakan kode voucher <strong class="bg-white/20 px-2 py-0.5 rounded font-mono text-amber-300">PESONAID</strong> saat melakukan simulasi pemesanan tiket atau paket wisata.
                    </p>
                </div>
                <div class="flex flex-col sm:flex-row gap-3 shrink-0">
                    <button onclick="copyVoucherCode()" class="px-6 py-3.5 rounded-xl bg-white/15 hover:bg-white/25 border border-white/30 font-bold text-sm transition-all flex items-center justify-center gap-2">
                        <i class="fa-regular fa-copy"></i>
                        <span>Salin Kode: PESONAID</span>
                    </button>
                    <button onclick="openBookingModal('Paket Eksplorasi Labuan Bajo Phinisi')" class="px-7 py-3.5 rounded-xl bg-amber-400 hover:bg-amber-300 text-slate-950 font-extrabold text-sm shadow-lg transition-all flex items-center justify-center gap-2">
                        <span>Rencanakan Liburan</span>
                        <i class="fa-solid fa-arrow-right"></i>
                    </button>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
<script>
    // All destinations dataset from Laravel
    const destinationsDatabase = @json($allDestinations);
    const bookingOptionsDatabase = @json($bookingOptions);

    let activeCategory = 'Semua';
    let activeRegionFilter = 'Semua';

    // Populate Booking Modal Select with Laravel Data
    function initBookingOptions() {
        const select = document.getElementById('bookItemSelect');
        if (!select) return;

        select.innerHTML = bookingOptionsDatabase.map(opt => `
            <option value="${opt.name}" data-price="${opt.price}">${opt.label}</option>
        `).join('');
    }

    function renderDestinationsGrid() {
        const grid = document.getElementById('destinationsGrid');
        const keyword = document.getElementById('destinationKeyword').value.toLowerCase().trim();
        const sortBy = document.getElementById('destinationSort').value;

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
                <div class="col-span-full py-16 text-center bg-white dark:bg-slate-900 rounded-3xl border border-slate-200 dark:border-slate-800 p-8 animate-fadeIn">
                    <i class="fa-solid fa-compass-drafting text-4xl text-brand-500 mb-3"></i>
                    <h3 class="text-lg font-bold text-slate-800 dark:text-white">Destinasi Tidak Ditemukan</h3>
                    <p class="text-sm text-slate-500 mt-1 mb-4">Coba gunakan kata kunci lain atau tampilkan seluruh kategori wisata.</p>
                    <button onclick="resetAllFilters()" class="px-5 py-2.5 rounded-xl bg-brand-600 text-white text-sm font-bold hover:bg-brand-700 transition-colors">Reset Filter</button>
                </div>
            `;
            return;
        }

        grid.innerHTML = filtered.map(dest => {
            const isLiked = savedWishlist.has(dest.id);
            const safeName = dest.name.replace(/'/g, "\\'");
            return `
                <article class="card-zoom group bg-white dark:bg-slate-900 rounded-3xl overflow-hidden border border-slate-200/80 dark:border-slate-800 shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col animate-fadeIn">
                    <!-- Image Header -->
                    <div class="relative h-60 overflow-hidden">
                        <img 
                            src="${dest.image}" 
                            onerror="this.src='https://placehold.co/600x400/148364/ffffff?text=${encodeURIComponent(dest.name)}'"
                            alt="${dest.name}" 
                            class="card-img w-full h-full object-cover transition-transform duration-500"
                        >
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-950/75 via-transparent to-transparent"></div>
                        
                        <!-- Category Badge -->
                        <span class="absolute top-4 left-4 px-3 py-1 rounded-full bg-slate-900/75 backdrop-blur-md text-white text-xs font-bold">
                            ${dest.category}
                        </span>

                        <!-- Wishlist Heart Button -->
                        <button onclick="toggleWishlist(${dest.id}, '${safeName}')" class="wishlist-btn absolute top-4 right-4 w-9 h-9 rounded-full bg-white/90 dark:bg-slate-900/90 flex items-center justify-center shadow-md hover:scale-110 transition-transform" data-id="${dest.id}" title="Simpan ke Favorit">
                            <i class="${isLiked ? 'fa-solid text-rose-500' : 'fa-regular text-slate-600 dark:text-slate-300'} fa-heart"></i>
                        </button>

                        <!-- Location & Rating on Image Bottom -->
                        <div class="absolute bottom-3 left-4 right-4 flex items-center justify-between text-white text-xs">
                            <span class="flex items-center gap-1.5 font-medium truncate pr-2">
                                <i class="fa-solid fa-location-dot text-emerald-400"></i>
                                ${dest.location}
                            </span>
                            <span class="px-2.5 py-1 rounded-lg bg-amber-400 text-slate-950 font-extrabold flex items-center gap-1 shrink-0">
                                <i class="fa-solid fa-star text-[10px]"></i> ${Number(dest.rating).toFixed(2)}
                            </span>
                        </div>
                    </div>

                    <!-- Card Content -->
                    <div class="p-6 flex-1 flex flex-col justify-between">
                        <div>
                            <div class="flex items-center gap-2 text-xs text-slate-400 mb-1.5">
                                <span><i class="fa-regular fa-clock mr-1"></i> ${dest.duration}</span>
                                <span>•</span>
                                <span>${dest.reviews_count} ulasan</span>
                            </div>
                            <h3 class="font-serif text-xl font-bold text-slate-900 dark:text-white group-hover:text-brand-600 dark:group-hover:text-brand-400 transition-colors">
                                <a href="/destinasi/${dest.slug}">${dest.name}</a>
                            </h3>
                            <p class="mt-2 text-xs sm:text-sm text-slate-600 dark:text-slate-400 line-clamp-2 leading-relaxed">
                                ${dest.description}
                            </p>
                        </div>

                        <!-- Price & Detail Button -->
                        <div class="mt-6 pt-4 border-t border-slate-100 dark:border-slate-800 flex items-center justify-between gap-2">
                            <div>
                                <p class="text-[11px] uppercase tracking-wider text-slate-400 font-semibold">Mulai dari</p>
                                <p class="text-lg font-extrabold text-brand-600 dark:text-brand-400">${formatRupiah(dest.price)}<span class="text-xs font-normal text-slate-400">/org</span></p>
                            </div>
                            <button onclick="openDetailModal(${dest.id})" class="px-3.5 py-2 rounded-xl bg-brand-50 dark:bg-brand-900/40 hover:bg-brand-600 text-brand-700 dark:text-brand-300 hover:text-white text-xs sm:text-sm font-bold transition-all flex items-center gap-1">
                                <span>Detail</span>
                                <i class="fa-solid fa-arrow-right text-xs"></i>
                            </button>
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
                btn.className = "cat-btn px-5 py-2.5 rounded-xl text-sm font-bold transition-all whitespace-nowrap bg-brand-600 text-white shadow-md shadow-brand-600/25";
            } else {
                btn.className = "cat-btn px-5 py-2.5 rounded-xl text-sm font-semibold transition-all whitespace-nowrap bg-white dark:bg-slate-900 text-slate-600 dark:text-slate-300 border border-slate-200 dark:border-slate-800 hover:border-brand-500";
            }
        });
        renderDestinationsGrid();
    }

    function quickFilter(cat) {
        setCategory(cat);
        document.getElementById('destinasi').scrollIntoView({ behavior: 'smooth' });
        showToast(`Menampilkan kategori wisata ${cat}`, 'info');
    }

    function resetAllFilters() {
        activeCategory = 'Semua';
        activeRegionFilter = 'Semua';
        document.getElementById('destinationKeyword').value = '';
        setCategory('Semua');
    }

    function handleHeroSearch(e) {
        e.preventDefault();
        const loc = document.getElementById('searchLocation').value;
        const date = document.getElementById('searchDate').value;
        const pax = document.getElementById('searchPax').value;

        activeRegionFilter = loc;
        setCategory('Semua');

        // Sync with booking modal defaults
        if (document.getElementById('bookDate')) document.getElementById('bookDate').value = date;
        if (document.getElementById('bookPax')) document.getElementById('bookPax').value = pax;

        document.getElementById('destinasi').scrollIntoView({ behavior: 'smooth' });
        showToast(`Menampilkan destinasi di ${loc} untuk ${pax} peserta`, 'success');
        renderDestinationsGrid();
    }

    // Initialize on page load
    document.addEventListener('DOMContentLoaded', () => {
        initBookingOptions();

        const searchDate = document.getElementById('searchDate');
        if (searchDate) {
            const nextWeek = new Date();
            nextWeek.setDate(nextWeek.getDate() + 7);
            searchDate.value = nextWeek.toISOString().split('T')[0];
        }

        // Apply wishlist initial state to rendered SSR cards
        document.querySelectorAll('.wishlist-btn').forEach(btn => {
            const id = parseInt(btn.dataset.id, 10);
            if (savedWishlist.has(id)) {
                btn.querySelector('i').className = 'fa-solid text-rose-500 fa-heart';
            }
        });
    });
</script>
@endpush
