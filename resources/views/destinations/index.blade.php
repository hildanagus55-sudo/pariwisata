@extends('layouts.app')

@section('title', 'Katalog Lengkap Destinasi Wisata — NusantaraWander')
@section('meta_description', 'Jelajahi pilihan lengkap destinasi wisata alam dan budaya Indonesia yang dikurasi bersama pemandu lokal.')

@section('content')
<div class="pt-28 pb-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Header -->
    <div class="mb-10 text-center max-w-3xl mx-auto">
        <span class="text-xs font-semibold text-stone-500 uppercase tracking-wider block mb-1">
            Katalog Destinasi
        </span>
        <h1 class="font-serif text-3xl sm:text-5xl font-normal text-stone-950 dark:text-white">
            Eksplorasi Seluruh Penjuru Nusantara
        </h1>
        <p class="mt-2.5 text-stone-600 dark:text-stone-400 text-xs sm:text-sm leading-relaxed">
            Pilih perjalanan sesuai musim dan minat Anda: dari perairan tenang kepulauan timur hingga kaldera sejuk pegunungan Jawa.
        </p>
    </div>

    <!-- Filter Form -->
    <div class="bg-white dark:bg-stone-900 rounded-3xl p-5 mb-10 border border-stone-200/90 dark:border-stone-800 shadow-xs">
        <form method="GET" action="{{ route('destinations.index') }}" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3 text-xs">
            <div>
                <label class="block font-bold uppercase tracking-wider text-stone-400 mb-1">Pencarian</label>
                <input 
                    type="text" 
                    name="keyword" 
                    value="{{ request('keyword') }}" 
                    placeholder="Nama lokasi / wilayah..." 
                    class="w-full px-3.5 py-2 rounded-xl bg-stone-50 dark:bg-stone-800 border border-stone-200 dark:border-stone-700 focus:ring-1 focus:ring-stone-900 focus:outline-none"
                >
            </div>

            <div>
                <label class="block font-bold uppercase tracking-wider text-stone-400 mb-1">Kategori</label>
                <select name="category" class="w-full px-3.5 py-2 rounded-xl bg-stone-50 dark:bg-stone-800 border border-stone-200 dark:border-stone-700 focus:ring-1 focus:ring-stone-900 focus:outline-none">
                    <option value="Semua" {{ request('category') == 'Semua' ? 'selected' : '' }}>Semua Kategori</option>
                    <option value="Pantai" {{ request('category') == 'Pantai' ? 'selected' : '' }}>Pantai & Perairan Karst</option>
                    <option value="Pegunungan" {{ request('category') == 'Pegunungan' ? 'selected' : '' }}>Puncak & Kaldera</option>
                    <option value="Budaya" {{ request('category') == 'Budaya' ? 'selected' : '' }}>Desa & Sejarah Budaya</option>
                    <option value="Alam" {{ request('category') == 'Alam' ? 'selected' : '' }}>Eksotisme Satwa & Rimba</option>
                </select>
            </div>

            <div>
                <label class="block font-bold uppercase tracking-wider text-stone-400 mb-1">Wilayah</label>
                <select name="region" class="w-full px-3.5 py-2 rounded-xl bg-stone-50 dark:bg-stone-800 border border-stone-200 dark:border-stone-700 focus:ring-1 focus:ring-stone-900 focus:outline-none">
                    <option value="Semua" {{ request('region') == 'Semua' ? 'selected' : '' }}>Semua Wilayah</option>
                    <option value="Bali & Nusa Tenggara" {{ request('region') == 'Bali & Nusa Tenggara' ? 'selected' : '' }}>Bali & Nusa Tenggara</option>
                    <option value="Papua & Maluku" {{ request('region') == 'Papua & Maluku' ? 'selected' : '' }}>Papua & Maluku</option>
                    <option value="Jawa" {{ request('region') == 'Jawa' ? 'selected' : '' }}>Jawa</option>
                    <option value="Sumatera" {{ request('region') == 'Sumatera' ? 'selected' : '' }}>Sumatera</option>
                    <option value="Kalimantan & Sulawesi" {{ request('region') == 'Kalimantan & Sulawesi' ? 'selected' : '' }}>Kalimantan & Sulawesi</option>
                </select>
            </div>

            <div class="flex items-end gap-2">
                <div class="flex-1">
                    <label class="block font-bold uppercase tracking-wider text-stone-400 mb-1">Urutan</label>
                    <select name="sort" class="w-full px-3.5 py-2 rounded-xl bg-stone-50 dark:bg-stone-800 border border-stone-200 dark:border-stone-700 focus:ring-1 focus:ring-stone-900 focus:outline-none">
                        <option value="popular" {{ request('sort') == 'popular' ? 'selected' : '' }}>Rekomendasi</option>
                        <option value="price-asc" {{ request('sort') == 'price-asc' ? 'selected' : '' }}>Biaya Terendah</option>
                        <option value="price-desc" {{ request('sort') == 'price-desc' ? 'selected' : '' }}>Biaya Tertinggi</option>
                        <option value="rating" {{ request('sort') == 'rating' ? 'selected' : '' }}>Ulasan Terbaik</option>
                    </select>
                </div>
                <button type="submit" class="px-5 py-2 rounded-xl bg-stone-900 text-white dark:bg-stone-100 dark:text-stone-900 font-semibold h-[36px] transition-colors">
                    Filter
                </button>
            </div>
        </form>
    </div>

    <!-- Destinations Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse($destinations as $dest)
            <article class="group bg-white dark:bg-stone-900 rounded-3xl overflow-hidden border border-stone-200/90 dark:border-stone-800 hover:shadow-lg transition-all duration-300 flex flex-col">
                <div class="relative h-64 overflow-hidden bg-stone-100">
                    <img 
                        src="{{ $dest->image }}" 
                        onerror="this.src='https://placehold.co/600x400/262019/ffffff?text={{ urlencode($dest->name) }}'"
                        alt="{{ $dest->name }}" 
                        class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                    >
                    <div class="absolute inset-0 bg-gradient-to-t from-stone-950/70 via-transparent to-transparent"></div>
                    <span class="absolute top-4 left-4 px-2.5 py-0.5 rounded-full bg-white/90 dark:bg-stone-900/90 text-stone-800 dark:text-stone-200 text-[11px] font-medium tracking-wide shadow-xs">
                        {{ $dest->category }}
                    </span>
                    <button onclick="toggleWishlist({{ $dest->id }}, '{{ addslashes($dest->name) }}')" class="wishlist-btn absolute top-4 right-4 w-8 h-8 rounded-full bg-white/90 dark:bg-stone-900/90 text-stone-600 dark:text-stone-300 flex items-center justify-center hover:scale-110 transition-transform shadow-xs" data-id="{{ $dest->id }}" title="Simpan ke Jurnal">
                        <i class="fa-regular text-xs fa-heart"></i>
                    </button>
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

                <div class="p-6 flex-1 flex flex-col justify-between">
                    <div>
                        <div class="flex items-center gap-2 text-[11px] text-stone-400 mb-1.5">
                            <span><i class="fa-regular fa-clock mr-1"></i> {{ $dest->duration }}</span>
                            <span>•</span>
                            <span>{{ $dest->reviews_count }} catatan</span>
                        </div>
                        <h3 class="font-serif text-xl font-semibold text-stone-900 dark:text-white group-hover:text-stone-600 dark:group-hover:text-stone-300 transition-colors leading-snug">
                            <a href="{{ route('destinations.show', $dest->slug) }}">{{ $dest->name }}</a>
                        </h3>
                        <p class="mt-2 text-xs text-stone-600 dark:text-stone-400 line-clamp-2 leading-relaxed">
                            {{ $dest->description }}
                        </p>
                    </div>

                    <div class="mt-6 pt-4 border-t border-stone-100 dark:border-stone-800 flex items-center justify-between gap-2">
                        <div>
                            <span class="text-[10px] text-stone-400 uppercase tracking-wider block">Mulai dari</span>
                            <p class="text-base font-serif font-bold text-stone-900 dark:text-white">{{ $dest->formatted_price }}<span class="text-[11px] font-sans font-normal text-stone-400">/org</span></p>
                        </div>
                        <a href="{{ route('destinations.show', $dest->slug) }}" class="px-4 py-2 rounded-full border border-stone-200 dark:border-stone-700 hover:bg-stone-100 dark:hover:bg-stone-800 text-stone-800 dark:text-stone-200 text-xs font-semibold transition-colors">
                            Catatan Rute
                        </a>
                    </div>
                </div>
            </article>
        @empty
            <div class="col-span-full py-14 text-center bg-white dark:bg-stone-900 rounded-3xl border border-stone-200 dark:border-stone-800 p-8">
                <p class="text-sm font-serif text-stone-800 dark:text-stone-200">Belum ada rute yang cocok dengan pencarian Anda</p>
                <p class="text-xs text-stone-400 mt-1 mb-4">Coba atur ulang kata kunci atau lihat seluruh destinasi.</p>
                <a href="{{ route('destinations.index') }}" class="px-4 py-2 rounded-full bg-stone-900 text-white text-xs font-semibold">Tampilkan Semua</a>
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
