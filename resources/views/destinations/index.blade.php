@extends('layouts.app')

@section('title', 'Katalog Seluruh Destinasi Wisata Nusantara — NusantaraWander')
@section('meta_description', 'Jelajahi pilihan lengkap destinasi wisata terbaik di seluruh pulau Indonesia dengan filter kategori, wilayah, dan harga.')

@section('content')
<div class="pt-28 pb-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Header -->
    <div class="mb-10 text-center max-w-3xl mx-auto">
        <span class="inline-block px-3.5 py-1 rounded-full bg-brand-100 dark:bg-brand-900/50 text-brand-700 dark:text-brand-300 text-xs font-bold uppercase tracking-wider mb-3">
            Katalog Destinasi Lengkap
        </span>
        <h1 class="font-serif text-3xl sm:text-5xl font-bold text-slate-900 dark:text-white">
            Eksplorasi Keajaiban Nusantara
        </h1>
        <p class="mt-3 text-slate-600 dark:text-slate-400 text-sm sm:text-base">
            Temukan destinasi impian Anda, mulai dari pantai berpasir putih, puncak pegunungan berkabut, hingga warisan budaya bersejarah.
        </p>
    </div>

    <!-- Filter Form -->
    <div class="bg-white dark:bg-slate-900 rounded-3xl p-6 mb-10 border border-slate-200/80 dark:border-slate-800 shadow-md">
        <form method="GET" action="{{ route('destinations.index') }}" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <!-- Keyword -->
            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400 mb-1.5">Pencarian</label>
                <input 
                    type="text" 
                    name="keyword" 
                    value="{{ request('keyword') }}" 
                    placeholder="Nama destinasi / lokasi..." 
                    class="w-full px-4 py-2.5 rounded-xl bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-sm focus:ring-2 focus:ring-brand-500 focus:outline-none"
                >
            </div>

            <!-- Kategori -->
            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400 mb-1.5">Kategori</label>
                <select name="category" class="w-full px-4 py-2.5 rounded-xl bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-sm focus:ring-2 focus:ring-brand-500 focus:outline-none">
                    <option value="Semua" {{ request('category') == 'Semua' ? 'selected' : '' }}>Semua Kategori</option>
                    <option value="Pantai" {{ request('category') == 'Pantai' ? 'selected' : '' }}>Pantai & Bahari</option>
                    <option value="Pegunungan" {{ request('category') == 'Pegunungan' ? 'selected' : '' }}>Pegunungan</option>
                    <option value="Budaya" {{ request('category') == 'Budaya' ? 'selected' : '' }}>Budaya & Sejarah</option>
                    <option value="Alam" {{ request('category') == 'Alam' ? 'selected' : '' }}>Eksotisme Alam</option>
                </select>
            </div>

            <!-- Wilayah -->
            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400 mb-1.5">Wilayah</label>
                <select name="region" class="w-full px-4 py-2.5 rounded-xl bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-sm focus:ring-2 focus:ring-brand-500 focus:outline-none">
                    <option value="Semua" {{ request('region') == 'Semua' ? 'selected' : '' }}>Semua Wilayah</option>
                    <option value="Bali & Nusa Tenggara" {{ request('region') == 'Bali & Nusa Tenggara' ? 'selected' : '' }}>Bali & Nusa Tenggara</option>
                    <option value="Papua & Maluku" {{ request('region') == 'Papua & Maluku' ? 'selected' : '' }}>Papua & Maluku</option>
                    <option value="Jawa" {{ request('region') == 'Jawa' ? 'selected' : '' }}>Jawa</option>
                    <option value="Sumatera" {{ request('region') == 'Sumatera' ? 'selected' : '' }}>Sumatera</option>
                    <option value="Kalimantan & Sulawesi" {{ request('region') == 'Kalimantan & Sulawesi' ? 'selected' : '' }}>Kalimantan & Sulawesi</option>
                </select>
            </div>

            <!-- Sort & Button -->
            <div class="flex items-end gap-2">
                <div class="flex-1">
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400 mb-1.5">Urutan</label>
                    <select name="sort" class="w-full px-4 py-2.5 rounded-xl bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-sm focus:ring-2 focus:ring-brand-500 focus:outline-none">
                        <option value="popular" {{ request('sort') == 'popular' ? 'selected' : '' }}>Terpopuler</option>
                        <option value="price-asc" {{ request('sort') == 'price-asc' ? 'selected' : '' }}>Harga Terendah</option>
                        <option value="price-desc" {{ request('sort') == 'price-desc' ? 'selected' : '' }}>Harga Tertinggi</option>
                        <option value="rating" {{ request('sort') == 'rating' ? 'selected' : '' }}>Rating Tertinggi</option>
                    </select>
                </div>
                <button type="submit" class="px-5 py-2.5 rounded-xl bg-brand-600 hover:bg-brand-700 text-white font-bold text-sm h-[42px] transition-colors flex items-center gap-1.5">
                    <i class="fa-solid fa-filter"></i>
                    <span>Filter</span>
                </button>
            </div>
        </form>
    </div>

    <!-- Destinations Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-7">
        @forelse($destinations as $dest)
            <article class="card-zoom group bg-white dark:bg-slate-900 rounded-3xl overflow-hidden border border-slate-200/80 dark:border-slate-800 shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col">
                <div class="relative h-60 overflow-hidden">
                    <img 
                        src="{{ $dest->image }}" 
                        onerror="this.src='https://placehold.co/600x400/148364/ffffff?text={{ urlencode($dest->name) }}'"
                        alt="{{ $dest->name }}" 
                        class="card-img w-full h-full object-cover transition-transform duration-500"
                    >
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950/75 via-transparent to-transparent"></div>
                    <span class="absolute top-4 left-4 px-3 py-1 rounded-full bg-slate-900/75 backdrop-blur-md text-white text-xs font-bold">
                        {{ $dest->category }}
                    </span>
                    <button onclick="toggleWishlist({{ $dest->id }}, '{{ addslashes($dest->name) }}')" class="wishlist-btn absolute top-4 right-4 w-9 h-9 rounded-full bg-white/90 dark:bg-slate-900/90 flex items-center justify-center shadow-md hover:scale-110 transition-transform" data-id="{{ $dest->id }}" title="Simpan ke Favorit">
                        <i class="fa-regular text-slate-600 dark:text-slate-300 fa-heart"></i>
                    </button>
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

                    <div class="mt-6 pt-4 border-t border-slate-100 dark:border-slate-800 flex items-center justify-between gap-2">
                        <div>
                            <p class="text-[11px] uppercase tracking-wider text-slate-400 font-semibold">Mulai dari</p>
                            <p class="text-lg font-extrabold text-brand-600 dark:text-brand-400">{{ $dest->formatted_price }}<span class="text-xs font-normal text-slate-400">/org</span></p>
                        </div>
                        <div class="flex items-center gap-1.5">
                            <a href="{{ route('destinations.show', $dest->slug) }}" class="px-3.5 py-2 rounded-xl bg-brand-50 dark:bg-brand-900/40 hover:bg-brand-600 text-brand-700 dark:text-brand-300 hover:text-white text-xs sm:text-sm font-bold transition-all flex items-center gap-1">
                                <span>Detail</span>
                                <i class="fa-solid fa-arrow-right text-xs"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </article>
        @empty
            <div class="col-span-full py-16 text-center bg-white dark:bg-slate-900 rounded-3xl border border-slate-200 dark:border-slate-800 p-8">
                <i class="fa-solid fa-compass-drafting text-4xl text-brand-500 mb-3"></i>
                <h3 class="text-lg font-bold text-slate-800 dark:text-white">Tidak ada destinasi yang cocok</h3>
                <p class="text-sm text-slate-500 mt-1 mb-4">Coba sesuaikan kata kunci atau pilihan filter Anda.</p>
                <a href="{{ route('destinations.index') }}" class="px-5 py-2.5 rounded-xl bg-brand-600 text-white text-sm font-bold">Tampilkan Semua</a>
            </div>
        @endforelse
    </div>

    @if($destinations->hasPages())
        <div class="mt-10">
            {{ $destinations->links() }}
        </div>
    @endif
</div>
@endsection
