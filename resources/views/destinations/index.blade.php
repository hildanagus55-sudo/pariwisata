@extends('layouts.app')

@section('title', 'DANWISATA | Katalog Destinasi Wisata Nusantara')
@section('meta_description', 'DANWISATA | Jelajahi pilihan lengkap destinasi wisata alam dan budaya Indonesia resmi di Portal Pariwisata.')

@section('content')
<div class="pt-24 sm:pt-28 pb-16 sm:pb-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Top Navigation -->
    <div class="mb-4 sm:mb-6">
        <a href="{{ route('home') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-full border border-stone-200 dark:border-stone-800 bg-white dark:bg-stone-900 text-xs font-semibold text-stone-700 dark:text-stone-300 hover:bg-stone-100 dark:hover:bg-stone-800 hover:text-stone-950 dark:hover:text-white transition-all shadow-xs group">
            <i class="fa-solid fa-arrow-left text-[11px] group-hover:-translate-x-0.5 transition-transform"></i>
            <span data-i18n="catDestBack">Kembali ke Beranda</span>
        </a>
    </div>

    <!-- Header -->
    <div class="mb-8 sm:mb-10 text-center max-w-3xl mx-auto">
        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-stone-100 dark:bg-stone-800 text-stone-700 dark:text-stone-300 text-xs font-semibold mb-3 border border-stone-200/80 dark:border-stone-700">
            <i class="fa-solid fa-map-location-dot text-amber-600 dark:text-amber-400"></i>
            <span data-i18n="catDestBadge">{{ $destinations->total() }} Destinasi Terkurasi di 6 Wilayah Nusantara</span>
        </div>
        <h1 data-i18n="catDestTitle" class="font-serif text-2xl sm:text-5xl font-normal text-stone-950 dark:text-white">
            Eksplorasi Seluruh Penjuru Nusantara
        </h1>
        <p data-i18n="catDestDesc" class="mt-2.5 text-stone-600 dark:text-stone-400 text-xs sm:text-sm leading-relaxed px-2">
            Pilih perjalanan sesuai musim dan minat Anda: dari perairan tenang kepulauan timur hingga kaldera sejuk pegunungan Jawa.
        </p>
    </div>

    <!-- Filter Form (Otomatis Filter Tanpa Tombol Submit) -->
    <div class="bg-white dark:bg-stone-900 rounded-2xl sm:rounded-3xl p-4 sm:p-5 mb-8 sm:mb-10 border border-stone-200/90 dark:border-stone-800 shadow-xs">
        <form id="destinationFilterForm" method="GET" action="{{ route('destinations.index') }}" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 text-xs">
            <div>
                <label class="block font-bold uppercase tracking-wider text-stone-400 mb-1.5 flex items-center gap-1.5">
                    <i class="fa-solid fa-magnifying-glass text-[10px]"></i>
                    <span data-i18n="catDestSearch">Pencarian Cepat</span>
                </label>
                <input 
                    type="text" 
                    name="keyword" 
                    value="{{ request('keyword') }}" 
                    oninput="autoFilterDestinations(this.form)"
                    data-i18n-placeholder="catSearchPlaceholder"
                    placeholder="Ketik nama lokasi / wilayah..." 
                    class="w-full px-3.5 py-2.5 rounded-xl bg-stone-50 dark:bg-stone-800 border border-stone-200 dark:border-stone-700 focus:ring-1 focus:ring-stone-900 focus:outline-none"
                >
            </div>

            <div>
                <label class="block font-bold uppercase tracking-wider text-stone-400 mb-1.5 flex items-center gap-1.5">
                    <i class="fa-solid fa-tags text-[10px]"></i>
                    <span data-i18n="catDestCategory">Kategori</span>
                </label>
                <select name="category" onchange="this.form.submit()" class="w-full px-3.5 py-2.5 rounded-xl bg-stone-50 dark:bg-stone-800 border border-stone-200 dark:border-stone-700 focus:ring-1 focus:ring-stone-900 focus:outline-none cursor-pointer">
                    <option value="Semua" {{ request('category') == 'Semua' ? 'selected' : '' }}>Semua Kategori</option>
                    <option value="Pantai" {{ request('category') == 'Pantai' ? 'selected' : '' }}>Pantai & Perairan Karst</option>
                    <option value="Pegunungan" {{ request('category') == 'Pegunungan' ? 'selected' : '' }}>Puncak & Kaldera</option>
                    <option value="Budaya" {{ request('category') == 'Budaya' ? 'selected' : '' }}>Desa & Sejarah Budaya</option>
                    <option value="Alam" {{ request('category') == 'Alam' ? 'selected' : '' }}>Eksotisme Satwa & Rimba</option>
                </select>
            </div>

            <div>
                <label class="block font-bold uppercase tracking-wider text-stone-400 mb-1.5 flex items-center gap-1.5">
                    <i class="fa-solid fa-map text-[10px]"></i>
                    <span data-i18n="catDestRegion">Wilayah</span>
                </label>
                <select name="region" onchange="this.form.submit()" class="w-full px-3.5 py-2.5 rounded-xl bg-stone-50 dark:bg-stone-800 border border-stone-200 dark:border-stone-700 focus:ring-1 focus:ring-stone-900 focus:outline-none cursor-pointer">
                    <option value="Semua" {{ request('region') == 'Semua' ? 'selected' : '' }}>Semua Wilayah</option>
                    <option value="Bali & Nusa Tenggara" {{ request('region') == 'Bali & Nusa Tenggara' ? 'selected' : '' }}>Bali & Nusa Tenggara</option>
                    <option value="Papua & Maluku" {{ request('region') == 'Papua & Maluku' ? 'selected' : '' }}>Papua & Maluku</option>
                    <option value="Jawa" {{ request('region') == 'Jawa' ? 'selected' : '' }}>Jawa</option>
                    <option value="Sumatera" {{ request('region') == 'Sumatera' ? 'selected' : '' }}>Sumatera</option>
                    <option value="Kalimantan & Sulawesi" {{ request('region') == 'Kalimantan & Sulawesi' ? 'selected' : '' }}>Kalimantan & Sulawesi</option>
                </select>
            </div>

            <div>
                <label class="block font-bold uppercase tracking-wider text-stone-400 mb-1.5 flex items-center gap-1.5">
                    <i class="fa-solid fa-arrow-down-wide-short text-[10px]"></i>
                    <span data-i18n="catDestSort">Urutkan</span>
                </label>
                <select name="sort" onchange="this.form.submit()" class="w-full px-3.5 py-2.5 rounded-xl bg-stone-50 dark:bg-stone-800 border border-stone-200 dark:border-stone-700 focus:ring-1 focus:ring-stone-900 focus:outline-none cursor-pointer">
                    <option value="popular" {{ request('sort') == 'popular' ? 'selected' : '' }}>Rekomendasi Terbaik</option>
                    <option value="price-asc" {{ request('sort') == 'price-asc' ? 'selected' : '' }}>Biaya Terendah</option>
                    <option value="price-desc" {{ request('sort') == 'price-desc' ? 'selected' : '' }}>Biaya Tertinggi</option>
                    <option value="rating" {{ request('sort') == 'rating' ? 'selected' : '' }}>Ulasan Terbaik</option>
                </select>
            </div>
        </form>

        @if(request('keyword') || (request('category') && request('category') !== 'Semua') || (request('region') && request('region') !== 'Semua') || (request('sort') && request('sort') !== 'popular'))
            <div class="mt-4 pt-3.5 border-t border-stone-100 dark:border-stone-800 flex items-center justify-between text-xs text-stone-500">
                <span class="flex items-center gap-1.5">
                    <i class="fa-solid fa-bolt text-amber-500 text-[11px]"></i>
                    <span data-i18n="autoFilterNotice">Menampilkan hasil filter otomatis</span>
                </span>
                <a href="{{ route('destinations.index') }}" class="inline-flex items-center gap-1 px-3 py-1 rounded-full bg-stone-100 dark:bg-stone-800 hover:bg-stone-200 dark:hover:bg-stone-700 text-stone-800 dark:text-stone-200 font-semibold transition-colors">
                    <i class="fa-solid fa-rotate-left text-[10px]"></i>
                    <span data-i18n="catDestReset">Reset Filter</span>
                </a>
            </div>
        @endif
    </div>

    <!-- Destinations Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5 sm:gap-8">
        @forelse($destinations as $dest)
            <article 
                onclick="openDetailModal({{ $dest->id }})" 
                class="group bg-white dark:bg-stone-900 rounded-2xl sm:rounded-3xl overflow-hidden border border-stone-200/90 dark:border-stone-800 hover:border-stone-400 dark:hover:border-stone-600 hover:shadow-xl transition-all duration-300 flex flex-col cursor-pointer active:scale-98"
            >
                <div class="relative h-52 sm:h-64 overflow-hidden bg-stone-100">
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
                    <button onclick="event.stopPropagation(); toggleWishlist({{ $dest->id }}, '{{ addslashes($dest->name) }}')" class="wishlist-btn absolute top-4 right-4 w-8 h-8 rounded-full bg-white/90 dark:bg-stone-900/90 text-stone-600 dark:text-stone-300 flex items-center justify-center hover:scale-110 transition-transform shadow-xs" data-id="{{ $dest->id }}" title="Simpan ke Jurnal">
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
                            {{ $dest->name }}
                        </h3>
                        <p class="mt-2 text-xs text-stone-600 dark:text-stone-400 line-clamp-2 leading-relaxed">
                            {{ $dest->description }}
                        </p>
                    </div>

                    <div class="mt-6 pt-4 border-t border-stone-100 dark:border-stone-800 flex items-center justify-between gap-2">
                        <div>
                            <span data-i18n="cardStartingFrom" class="text-[10px] text-stone-400 uppercase tracking-wider block">Mulai dari</span>
                            <p class="text-base font-serif font-bold text-stone-900 dark:text-white">{{ $dest->formatted_price }}<span data-i18n="cardPerPerson" class="text-[11px] font-sans font-normal text-stone-400">/org</span></p>
                        </div>
                        <span data-i18n="cardRouteNotes" class="px-4 py-2 rounded-full border border-stone-200 dark:border-stone-700 group-hover:bg-stone-900 group-hover:text-white dark:group-hover:bg-stone-100 dark:group-hover:text-stone-900 text-stone-800 dark:text-stone-200 text-xs font-semibold transition-all">
                            Catatan Rute
                        </span>
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

    <!-- Bottom Navigation & CTA -->
    <div class="mt-16 pt-8 border-t border-stone-200 dark:border-stone-800 flex flex-col sm:flex-row items-center justify-between gap-4">
        <a href="{{ route('home') }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-full border border-stone-300 dark:border-stone-700 hover:bg-stone-100 dark:hover:bg-stone-800 text-stone-800 dark:text-stone-200 text-xs font-semibold transition-all">
            <i class="fa-solid fa-arrow-left text-[10px]"></i>
            <span data-i18n="catDestBack">Kembali ke Beranda</span>
        </a>
        <a href="{{ route('packages.index') }}" class="inline-flex items-center gap-2 px-6 py-2.5 rounded-full bg-stone-900 text-white dark:bg-stone-100 dark:text-stone-900 text-xs font-semibold shadow-sm hover:opacity-90 transition-all">
            <span data-i18n="catDestToPkg">Lihat Paket Perjalanan Terkurasi (9 Paket)</span>
            <i class="fa-solid fa-arrow-right text-[10px]"></i>
        </a>
    </div>
</div>

@push('scripts')
<script>
    let destFilterTimer;
    function autoFilterDestinations(form) {
        clearTimeout(destFilterTimer);
        destFilterTimer = setTimeout(() => {
            form.submit();
        }, 450);
    }
</script>
@endpush
@endsection
