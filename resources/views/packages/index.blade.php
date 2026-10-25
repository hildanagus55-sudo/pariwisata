@extends('layouts.app')

@section('title', 'DANWISATA | Koleksi Paket Wisata Nusantara')
@section('meta_description', 'DANWISATA | Paket perjalanan terkurasi ke Labuan Bajo, Bromo, Ijen, dan Bali resmi di Portal Pariwisata Indonesia.')

@section('content')
<div class="pt-28 pb-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Top Navigation -->
    <div class="mb-6">
        <a href="{{ route('home') }}#paket" class="inline-flex items-center gap-2 px-4 py-2 rounded-full border border-stone-200 dark:border-stone-800 bg-white dark:bg-stone-900 text-xs font-semibold text-stone-700 dark:text-stone-300 hover:bg-stone-100 dark:hover:bg-stone-800 hover:text-stone-950 dark:hover:text-white transition-all shadow-xs group">
            <i class="fa-solid fa-arrow-left text-[11px] group-hover:-translate-x-0.5 transition-transform"></i>
            <span data-i18n="catPkgBack">Kembali ke Beranda</span>
        </a>
    </div>

    <div class="text-center max-w-2xl mx-auto mb-14">
        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-stone-100 dark:bg-stone-800 text-stone-700 dark:text-stone-300 text-xs font-semibold mb-3 border border-stone-200/80 dark:border-stone-700">
            <i class="fa-solid fa-compass text-amber-600 dark:text-amber-400"></i>
            <span data-i18n="catPkgBadge">{{ $packages->count() }} Pilihan Paket Lengkap & All-Inclusive</span>
        </div>
        <h1 data-i18n="catPkgTitle" class="font-serif text-3xl sm:text-5xl font-normal text-stone-950 dark:text-white">
            Koleksi Paket Perjalanan Terkurasi
        </h1>
        <p data-i18n="catPkgDesc" class="mt-2.5 text-stone-600 dark:text-stone-400 text-xs sm:text-sm leading-relaxed">
            Menikmati keindahan alam nusantara tanpa repot. Kami mengatur transportasi privat, kabin kapal/villa terbaik, dan perizinan resmi.
        </p>
    </div>

    <!-- Filter Form (Otomatis Filter Tanpa Tombol Submit) -->
    <div class="bg-white dark:bg-stone-900 rounded-3xl p-5 mb-10 border border-stone-200/90 dark:border-stone-800 shadow-xs">
        <form id="packageFilterForm" method="GET" action="{{ route('packages.index') }}" class="grid grid-cols-1 sm:grid-cols-3 gap-4 text-xs">
            <div>
                <label class="block font-bold uppercase tracking-wider text-stone-400 mb-1.5 flex items-center gap-1.5">
                    <i class="fa-solid fa-magnifying-glass text-[10px]"></i>
                    <span data-i18n="catPkgSearch">Cari Paket / Penginapan</span>
                </label>
                <input 
                    type="text" 
                    name="keyword" 
                    value="{{ request('keyword') }}" 
                    oninput="autoFilterPackages(this.form)"
                    data-i18n-placeholder="catPkgSearchPlaceholder"
                    placeholder="Contoh: Phinisi, Bromo, Toraja, Villa..." 
                    class="w-full px-3.5 py-2.5 rounded-xl bg-stone-50 dark:bg-stone-800 border border-stone-200 dark:border-stone-700 focus:ring-1 focus:ring-stone-900 focus:outline-none"
                >
            </div>

            <div>
                <label class="block font-bold uppercase tracking-wider text-stone-400 mb-1.5 flex items-center gap-1.5">
                    <i class="fa-regular fa-clock text-[10px]"></i>
                    <span data-i18n="catPkgDuration">Durasi Perjalanan</span>
                </label>
                <select name="duration" onchange="this.form.submit()" class="w-full px-3.5 py-2.5 rounded-xl bg-stone-50 dark:bg-stone-800 border border-stone-200 dark:border-stone-700 focus:ring-1 focus:ring-stone-900 focus:outline-none cursor-pointer">
                    <option value="Semua" {{ request('duration') == 'Semua' ? 'selected' : '' }}>Semua Durasi</option>
                    <option value="3 Hari" {{ request('duration') == '3 Hari' ? 'selected' : '' }}>3 Hari 2 Malam (Weekend Trip)</option>
                    <option value="4 Hari" {{ request('duration') == '4 Hari' ? 'selected' : '' }}>4 Hari 3 Malam</option>
                    <option value="5 Hari" {{ request('duration') == '5 Hari' ? 'selected' : '' }}>5 Hari 4 Malam</option>
                    <option value="6 Hari" {{ request('duration') == '6 Hari' ? 'selected' : '' }}>6 Hari 5 Malam (Ekspedisi Panjang)</option>
                </select>
            </div>

            <div>
                <label class="block font-bold uppercase tracking-wider text-stone-400 mb-1.5 flex items-center gap-1.5">
                    <i class="fa-solid fa-arrow-down-wide-short text-[10px]"></i>
                    <span data-i18n="catPkgSort">Urutkan Paket</span>
                </label>
                <select name="sort" onchange="this.form.submit()" class="w-full px-3.5 py-2.5 rounded-xl bg-stone-50 dark:bg-stone-800 border border-stone-200 dark:border-stone-700 focus:ring-1 focus:ring-stone-900 focus:outline-none cursor-pointer">
                    <option value="rekomendasi" {{ request('sort') == 'rekomendasi' ? 'selected' : '' }}>Rekomendasi Terbaik</option>
                    <option value="price-asc" {{ request('sort') == 'price-asc' ? 'selected' : '' }}>Tarif Terendah</option>
                    <option value="price-desc" {{ request('sort') == 'price-desc' ? 'selected' : '' }}>Tarif Tertinggi</option>
                </select>
            </div>
        </form>

        @if(request('keyword') || (request('duration') && request('duration') !== 'Semua') || (request('sort') && request('sort') !== 'rekomendasi'))
            <div class="mt-4 pt-3.5 border-t border-stone-100 dark:border-stone-800 flex items-center justify-between text-xs text-stone-500">
                <span class="flex items-center gap-1.5">
                    <i class="fa-solid fa-bolt text-amber-500 text-[11px]"></i>
                    <span data-i18n="autoFilterPkgNotice">Menampilkan paket hasil filter otomatis</span>
                </span>
                <a href="{{ route('packages.index') }}" class="inline-flex items-center gap-1 px-3 py-1 rounded-full bg-stone-100 dark:bg-stone-800 hover:bg-stone-200 dark:hover:bg-stone-700 text-stone-800 dark:text-stone-200 font-semibold transition-colors">
                    <i class="fa-solid fa-rotate-left text-[10px]"></i>
                    <span data-i18n="catPkgReset">Reset Filter</span>
                </a>
            </div>
        @endif
    </div>

    <div id="packagesGrid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse($packages as $idx => $pkg)
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
        @empty
            <div class="col-span-full py-14 text-center bg-white dark:bg-stone-900 rounded-3xl border border-stone-200 dark:border-stone-800 p-8">
                <p class="text-sm font-serif text-stone-800 dark:text-stone-200">Belum ada paket wisata yang cocok dengan pencarian Anda</p>
                <p class="text-xs text-stone-400 mt-1 mb-4">Coba atur ulang kata kunci atau lihat seluruh paket perjalanan.</p>
                <a href="{{ route('packages.index') }}" class="px-4 py-2 rounded-full bg-stone-900 text-white text-xs font-semibold">Tampilkan Semua Paket</a>
            </div>
        @endforelse
    </div>

    <!-- Bottom Navigation & CTA -->
    <div class="mt-16 pt-8 border-t border-stone-200 dark:border-stone-800 flex flex-col sm:flex-row items-center justify-between gap-4">
        <a href="{{ route('home') }}#paket" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-full border border-stone-300 dark:border-stone-700 hover:bg-stone-100 dark:hover:bg-stone-800 text-stone-800 dark:text-stone-200 text-xs font-semibold transition-all">
            <i class="fa-solid fa-arrow-left text-[10px]"></i>
            <span data-i18n="catPkgBack">Kembali ke Beranda</span>
        </a>
        <a href="{{ route('destinations.index') }}" class="inline-flex items-center gap-2 px-6 py-2.5 rounded-full bg-stone-900 text-white dark:bg-stone-100 dark:text-stone-900 text-xs font-semibold shadow-sm hover:opacity-90 transition-all">
            <span data-i18n="catPkgToDest">Jelajahi Seluruh Destinasi (20 Lokasi)</span>
            <i class="fa-solid fa-arrow-right text-[10px]"></i>
        </a>
    </div>
</div>

@push('scripts')
<script>
    let pkgFilterTimer;
    function autoFilterPackages(form) {
        clearTimeout(pkgFilterTimer);
        pkgFilterTimer = setTimeout(() => {
            form.submit();
        }, 450);
    }
</script>
@endpush
@endsection
