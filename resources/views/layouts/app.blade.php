<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'DANWISATA | Portal Pariwisata Indonesia')</title>
    <meta name="description" content="@yield('meta_description', 'DANWISATA | Portal Pariwisata Indonesia resmi dan terpercaya untuk menjelajahi keindahan destinasi wisata alam, budaya, dan paket liburan terbaik di Nusantara.')">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Google Fonts: Plus Jakarta Sans & Newsreader / Playfair Display -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Newsreader:ital,opsz,wght@0,6..72,400;0,6..72,500;0,6..72,600;1,6..72,400&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'system-ui', '-apple-system', 'sans-serif'],
                        serif: ['"Newsreader"', 'Georgia', 'serif'],
                    },
                    colors: {
                        stone: {
                            25: '#fdfcfb',
                            50: '#faf8f5',
                            100: '#f5f2ec',
                            150: '#ede8e1',
                            200: '#e4ddd3',
                            300: '#cfc4b4',
                            400: '#a89882',
                            500: '#857560',
                            600: '#685947',
                            700: '#524536',
                            800: '#3d3328',
                            900: '#262019',
                            950: '#17130f',
                        },
                        forest: {
                            50: '#f2f7f4',
                            100: '#e1ede6',
                            200: '#c5dcce',
                            600: '#245a43',
                            700: '#1c4634',
                            800: '#153629',
                            900: '#0e241c',
                        },
                        clay: {
                            50: '#faf5f0',
                            100: '#f4e9dd',
                            500: '#bd6a3f',
                            600: '#9d522c',
                        }
                    }
                }
            }
        }
    </script>
    <script>
        try {
            localStorage.removeItem('theme');
            document.documentElement.classList.remove('dark');
        } catch(e) {}
    </script>

    <style>
        ::-webkit-scrollbar {
            width: 7px;
        }
        ::-webkit-scrollbar-track {
            background: #faf8f5;
        }
        ::-webkit-scrollbar-thumb {
            background: #d6cebf;
            border-radius: 9999px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #a89882;
        }
        .clean-nav {
            background: rgba(255, 255, 255, 0.94);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
        }
        .dark .clean-nav {
            background: rgba(23, 19, 15, 0.94);
        }
        .hero-gradient {
            background: linear-gradient(180deg, rgba(15, 23, 42, 0.40) 0%, rgba(15, 23, 42, 0.62) 55%, rgba(15, 23, 42, 0.92) 100%);
        }
        @keyframes floatSlow {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-6px); }
        }
        .animate-float {
            animation: floatSlow 4s ease-in-out infinite;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(6px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fadeIn {
            animation: fadeIn 0.22s ease-out forwards;
        }
        .blur-mask-curtain {
            backdrop-filter: blur(22px);
            -webkit-backdrop-filter: blur(22px);
            mask-image: linear-gradient(to bottom, rgba(0,0,0,1) 0%, rgba(0,0,0,0.9) 65%, rgba(0,0,0,0) 100%);
            -webkit-mask-image: linear-gradient(to bottom, rgba(0,0,0,1) 0%, rgba(0,0,0,0.9) 65%, rgba(0,0,0,0) 100%);
            background: linear-gradient(to bottom, rgba(255, 255, 255, 0.72) 0%, rgba(255, 255, 255, 0.35) 65%, rgba(255, 255, 255, 0) 100%);
        }
        .dark .blur-mask-curtain {
            background: linear-gradient(to bottom, rgba(12, 10, 9, 0.78) 0%, rgba(12, 10, 9, 0.40) 65%, rgba(12, 10, 9, 0) 100%);
        }
        /* Mobile Bottom Dock & Touch Optimization */
        .mobile-bottom-dock {
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
        }
        @supports (padding-bottom: env(safe-area-inset-bottom)) {
            #mobileBottomDock {
                padding-bottom: env(safe-area-inset-bottom);
            }
            body {
                padding-bottom: calc(5rem + env(safe-area-inset-bottom));
            }
        }
        @media (min-width: 640px) {
            body {
                padding-bottom: 0 !important;
            }
        }
        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }
        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
            -webkit-overflow-scrolling: touch;
        }
        * {
            -webkit-tap-highlight-color: transparent;
        }
        @media (prefers-reduced-motion: reduce) {
            #scrollBlurVeil, #navContainer {
                transition: none !important;
            }
        }
    </style>
    @stack('styles')
</head>
<body class="bg-white text-stone-900 dark:bg-stone-950 dark:text-stone-100 font-sans antialiased selection:bg-stone-900 selection:text-white transition-colors duration-200 pb-20 sm:pb-0">

    <!-- Toast Notification Container -->
    <div id="toastContainer" class="fixed bottom-24 sm:bottom-6 right-4 sm:right-6 left-4 sm:left-auto z-[100] flex flex-col gap-2.5 max-w-sm w-auto sm:w-full pointer-events-none"></div>

    <!-- ================= TOP PROGRESSIVE SCROLL BLUR CURTAIN (EFEK BUREM WAKTU SCROLL) ================= -->
    <div id="scrollBlurVeil" class="fixed top-0 left-0 right-0 h-28 sm:h-32 pointer-events-none z-40 blur-mask-curtain transition-opacity duration-300 opacity-0"></div>

    <!-- ================= 1. FLOATING GLASS ISLAND NAVIGATION BAR ================= -->
    <header id="navbar" class="fixed top-3 sm:top-5 left-0 right-0 z-50 px-3 sm:px-6 transition-all duration-300">
        <div id="navContainer" class="max-w-6xl mx-auto rounded-full px-4 sm:px-6 py-2.5 sm:py-3 transition-all duration-300 shadow-[0_8px_32px_rgba(0,0,0,0.06)] backdrop-blur-xl border border-stone-200/90 dark:border-stone-800 bg-white/85 dark:bg-stone-900/85 flex items-center justify-between">
            <!-- Brand Logo: DANWISATA -->
            <a href="{{ route('home') }}" class="flex items-center gap-2 group shrink-0">
                <img src="{{ asset('images/logo.png') }}" alt="DANWISATA | Portal Pariwisata Indonesia" class="h-8 sm:h-9 w-auto object-contain transition-transform duration-300 group-hover:scale-105">
            </a>

            <!-- Desktop Navigation Links -->
            <nav class="hidden lg:flex items-center gap-1 text-xs font-semibold text-stone-600">
                <a href="{{ route('home') }}#beranda" data-i18n="navHome" class="px-3.5 py-1.5 rounded-full hover:bg-stone-100 hover:text-stone-950 transition-all {{ request()->routeIs('home') ? 'text-stone-950 font-bold bg-stone-100/60' : '' }}">Beranda</a>
                <a href="{{ route('destinations.index') }}" data-i18n="navDest" class="px-3.5 py-1.5 rounded-full hover:bg-stone-100 hover:text-stone-950 transition-all {{ request()->routeIs('destinations.*') ? 'text-stone-950 font-bold bg-stone-100/80' : '' }}">Destinasi</a>
                <a href="{{ route('packages.index') }}" data-i18n="navPkg" class="px-3.5 py-1.5 rounded-full hover:bg-stone-100 hover:text-stone-950 transition-all {{ request()->routeIs('packages.*') ? 'text-stone-950 font-bold bg-stone-100/80' : '' }}">Paket Wisata</a>
                <a href="{{ route('home') }}#cerita" data-i18n="navStory" class="px-3.5 py-1.5 rounded-full hover:bg-stone-100 hover:text-stone-950 transition-all">Filosofi</a>
                <a href="{{ route('home') }}#galeri" data-i18n="navGallery" class="px-3.5 py-1.5 rounded-full hover:bg-stone-100 hover:text-stone-950 transition-all">Galeri</a>
                <a href="{{ route('home') }}#testimoni" data-i18n="navTesti" class="px-3.5 py-1.5 rounded-full hover:bg-stone-100 hover:text-stone-950 transition-all">Testimoni</a>
            </nav>

            <!-- Actions: Wishlist, Language Switcher (ID/EN), Admin Login, CTA (WhatsApp icon removed) -->
            <div class="hidden lg:flex items-center gap-2">
                <!-- Wishlist Button -->
                <button onclick="showSavedDestinations()" class="relative w-8 h-8 rounded-full border border-stone-200/80 flex items-center justify-center text-stone-600 hover:bg-stone-100 hover:text-rose-500 transition-colors cursor-pointer" title="Destinasi Tersimpan">
                    <i class="fa-regular fa-heart text-xs"></i>
                    <span id="wishlistBadge" class="absolute -top-1 -right-1 w-4 h-4 rounded-full bg-stone-900 text-white text-[9px] font-bold flex items-center justify-center shadow-xs">0</span>
                </button>

                <!-- Language Switcher Button (ID / EN) -->
                <button onclick="toggleLanguage()" id="langToggleBtn" class="h-8 px-2.5 rounded-full border border-stone-200 hover:border-stone-400 bg-stone-50 hover:bg-stone-100 text-stone-700 text-[11px] font-semibold transition-all flex items-center gap-1.5 shadow-xs cursor-pointer" title="Ganti Bahasa / Switch Language (ID / EN)">
                    <i class="fa-solid fa-globe text-stone-500 text-xs"></i>
                    <span id="langLabel" class="tracking-wider font-mono">ID</span>
                </button>

                <!-- Admin Login Button -->
                <a href="{{ env('ADMIN_URL', 'http://localhost:8001') }}/login" target="_blank" class="h-8 px-3 rounded-full border border-stone-200 hover:border-stone-400 bg-white hover:bg-stone-50 text-stone-700 hover:text-stone-950 text-[11px] font-semibold transition-all flex items-center gap-1.5 shadow-2xs" title="Masuk ke Panel Admin (SkyTour Concierge)">
                    <i class="fa-solid fa-shield-halved text-stone-500 text-xs"></i>
                    <span>Masuk</span>
                </a>

                <!-- CTA Button -->
                <button onclick="openBookingModal()" class="ml-1 px-4 sm:px-5 py-2.5 rounded-full bg-stone-900 hover:bg-stone-800 text-white text-xs font-semibold tracking-wide transition-all shadow-sm active:scale-95 flex items-center gap-1.5 group cursor-pointer">
                    <span data-i18n="navPlanTrip">Rencanakan Trip</span>
                    <i class="fa-solid fa-arrow-right text-[10px] group-hover:translate-x-0.5 transition-transform"></i>
                </button>
            </div>

            <!-- Mobile Controls -->
            <div class="flex items-center gap-2 lg:hidden">
                <!-- Mobile Language Switcher Button -->
                <button onclick="toggleLanguage()" id="langToggleBtnMobile" class="h-8 px-2.5 rounded-full border border-stone-200 dark:border-stone-700 bg-stone-50 dark:bg-stone-800 text-stone-700 dark:text-stone-200 text-[11px] font-semibold flex items-center gap-1 shadow-xs font-mono active:scale-95 transition-all" title="Ganti Bahasa / Switch Language">
                    <i class="fa-solid fa-globe text-xs"></i>
                    <span id="langLabelMobile">ID</span>
                </button>
                <button id="mobileMenuBtn" onclick="toggleMobileMenu()" class="w-8 h-8 rounded-full bg-stone-900 dark:bg-white text-white dark:text-stone-900 flex items-center justify-center focus:outline-none active:scale-95 transition-transform shadow-xs" aria-label="Menu Navigasi">
                    <i id="mobileMenuIcon" class="fa-solid fa-bars text-xs"></i>
                </button>
            </div>
        </div>

        <!-- Mobile Floating Drawer -->
        <div id="mobileMenu" class="hidden lg:hidden max-w-6xl mx-auto mt-2 rounded-3xl bg-white/95 dark:bg-stone-900/95 backdrop-blur-2xl border border-stone-200/90 dark:border-stone-800 p-5 space-y-3 shadow-2xl animate-fadeIn">
            <div class="grid grid-cols-2 gap-2 text-xs font-semibold text-stone-700 dark:text-stone-200">
                <a href="{{ route('home') }}#beranda" onclick="toggleMobileMenu()" class="px-3 py-2.5 rounded-xl hover:bg-stone-100 dark:hover:bg-stone-800 flex items-center gap-2 {{ request()->routeIs('home') ? 'bg-stone-100 dark:bg-stone-800 text-stone-950 dark:text-white font-bold' : '' }}">
                    <i class="fa-solid fa-house text-stone-400"></i>
                    <span data-i18n="navHome">Beranda</span>
                </a>
                <a href="{{ route('destinations.index') }}" onclick="toggleMobileMenu()" class="px-3 py-2.5 rounded-xl hover:bg-stone-100 dark:hover:bg-stone-800 flex items-center gap-2 {{ request()->routeIs('destinations.*') ? 'bg-stone-100 dark:bg-stone-800 text-stone-950 dark:text-white font-bold' : '' }}">
                    <i class="fa-solid fa-compass text-stone-400"></i>
                    <span data-i18n="navDest">Destinasi</span>
                </a>
                <a href="{{ route('packages.index') }}" onclick="toggleMobileMenu()" class="px-3 py-2.5 rounded-xl hover:bg-stone-100 dark:hover:bg-stone-800 flex items-center gap-2 {{ request()->routeIs('packages.*') ? 'bg-stone-100 dark:bg-stone-800 text-stone-950 dark:text-white font-bold' : '' }}">
                    <i class="fa-solid fa-suitcase-rolling text-stone-400"></i>
                    <span data-i18n="navPkg">Paket Wisata</span>
                </a>
                <a href="{{ route('home') }}#cerita" onclick="toggleMobileMenu()" class="px-3 py-2.5 rounded-xl hover:bg-stone-100 dark:hover:bg-stone-800 flex items-center gap-2">
                    <i class="fa-solid fa-book-open text-stone-400"></i>
                    <span data-i18n="navStory">Filosofi</span>
                </a>
                <a href="{{ route('home') }}#galeri" onclick="toggleMobileMenu()" class="px-3 py-2.5 rounded-xl hover:bg-stone-100 dark:hover:bg-stone-800 flex items-center gap-2">
                    <i class="fa-solid fa-images text-stone-400"></i>
                    <span data-i18n="navGallery">Galeri</span>
                </a>
                <a href="{{ route('home') }}#testimoni" onclick="toggleMobileMenu()" class="px-3 py-2.5 rounded-xl hover:bg-stone-100 dark:hover:bg-stone-800 flex items-center gap-2">
                    <i class="fa-solid fa-star text-stone-400"></i>
                    <span data-i18n="navTesti">Testimoni</span>
                </a>
            </div>

            <div class="pt-3 border-t border-stone-200 dark:border-stone-800 flex flex-col gap-2">
                <!-- Mobile Language Selector Row -->
                <button onclick="toggleLanguage()" class="w-full py-2.5 px-4 rounded-xl border border-stone-200 dark:border-stone-700 font-semibold text-xs flex items-center justify-between text-stone-700 dark:text-stone-200 bg-stone-50 dark:bg-stone-800">
                    <span class="flex items-center gap-2">
                        <i class="fa-solid fa-globe text-stone-500"></i>
                        <span>Bahasa / Language</span>
                    </span>
                    <span id="langDrawerLabel" class="px-2 py-0.5 rounded-md bg-stone-200 dark:bg-stone-700 font-mono font-bold text-[10px]">ID (Bahasa Indonesia)</span>
                </button>
                <div class="grid grid-cols-1 gap-2">
                    <button onclick="toggleMobileMenu(); showSavedDestinations();" class="w-full py-2.5 px-3 rounded-xl border border-stone-200 dark:border-stone-700 font-semibold text-xs flex items-center justify-center gap-1.5 text-stone-700 dark:text-stone-200 hover:bg-stone-50 dark:hover:bg-stone-800 transition-colors">
                        <i class="fa-regular fa-heart text-rose-500"></i>
                        <span class="truncate"><span data-i18n="wishlistSavedTitle">Tersimpan</span> (<span id="wishlistBadgeMobile">0</span>)</span>
                    </button>
                </div>
                <button onclick="toggleMobileMenu(); openBookingModal();" class="w-full py-3 px-4 rounded-full bg-stone-900 dark:bg-white text-white dark:text-stone-900 font-semibold text-xs shadow-sm active:scale-98 transition-transform">
                    <span data-i18n="navPlanTrip">Rencanakan Trip Sekarang</span>
                </button>
                <a href="{{ env('ADMIN_URL', 'http://localhost:8001') }}/login" target="_blank" onclick="toggleMobileMenu()" class="w-full py-2.5 px-4 rounded-full border border-stone-200 dark:border-stone-700 text-stone-600 dark:text-stone-300 font-semibold text-xs flex items-center justify-center gap-2 hover:bg-stone-50 dark:hover:bg-stone-800 transition-colors">
                    <i class="fa-solid fa-shield-halved text-xs"></i>
                    <span>Masuk ke Panel Admin</span>
                </a>
            </div>
        </div>
    </header>

    @if(session('success'))
        <div class="fixed top-24 left-1/2 -translate-x-1/2 z-50 bg-stone-900 text-white px-5 py-2.5 rounded-full shadow-lg flex items-center gap-2.5 text-xs font-medium animate-fadeIn">
            <i class="fa-solid fa-check text-emerald-400"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <main class="min-h-screen">
        @yield('content')
    </main>

    <!-- Footer: Clean, Minimalist, Transparent Editorial -->
    <footer class="bg-stone-50 dark:bg-stone-900 text-stone-700 dark:text-stone-300 pt-16 pb-12 border-t border-stone-200/80 dark:border-stone-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-10 pb-12 border-b border-stone-200 dark:border-stone-800">
                <!-- Col 1: Bio -->
                <div class="lg:col-span-5">
                    <div class="flex items-center gap-2.5 mb-3.5">
                        <img src="{{ asset('images/logo.png') }}" alt="DANWISATA | Portal Pariwisata Indonesia" class="h-9 w-auto object-contain">
                    </div>
                    <p data-i18n="footerDesc" class="text-xs leading-relaxed text-stone-500 dark:text-stone-400 max-w-sm mb-5">
                        Portal Pariwisata Indonesia terpercaya. Kami menemani Anda menjelajahi keindahan nusantara, ragam budaya, dan paket liburan impian terbaik dengan pengalaman berkesan.
                    </p>
                    <div class="flex items-center gap-2.5 text-xs text-stone-500">
                        <a href="mailto:halo@danwisata.id" class="w-8 h-8 rounded-full border border-stone-300 dark:border-stone-700 hover:bg-stone-900 hover:text-white flex items-center justify-center transition-colors" title="Kirim Pesan / Email">
                            <i class="fa-regular fa-envelope"></i>
                        </a>
                        <a href="#footer" onclick="showToast('Instagram: @danwisata.id', 'info')" class="w-8 h-8 rounded-full border border-stone-300 dark:border-stone-700 hover:bg-stone-900 hover:text-white flex items-center justify-center transition-colors" title="Instagram Resmi">
                            <i class="fa-brands fa-instagram"></i>
                        </a>
                        <a href="#footer" onclick="showToast('YouTube: DANWISATA Portal Pariwisata', 'info')" class="w-8 h-8 rounded-full border border-stone-300 dark:border-stone-700 hover:bg-stone-900 hover:text-white flex items-center justify-center transition-colors" title="YouTube Resmi">
                            <i class="fa-brands fa-youtube"></i>
                        </a>
                    </div>
                </div>

                <!-- Col 2: Navigasi -->
                <div class="lg:col-span-2">
                    <h4 data-i18n="footerExplore" class="text-xs font-bold uppercase tracking-wider text-stone-900 dark:text-white mb-3.5">Eksplorasi</h4>
                    <ul class="space-y-2 text-xs text-stone-500 dark:text-stone-400">
                        <li><a href="{{ route('home') }}#beranda" data-i18n="navHome" class="hover:text-stone-900 dark:hover:text-white transition-colors">Beranda</a></li>
                        <li><a href="{{ route('destinations.index') }}" data-i18n="navDest" class="hover:text-stone-900 dark:hover:text-white transition-colors">Destinasi</a></li>
                        <li><a href="{{ route('packages.index') }}" data-i18n="navPkg" class="hover:text-stone-900 dark:hover:text-white transition-colors">Paket Wisata</a></li>
                        <li><a href="{{ route('home') }}#cerita" data-i18n="navStory" class="hover:text-stone-900 dark:hover:text-white transition-colors">Filosofi</a></li>
                        <li><a href="{{ route('home') }}#galeri" data-i18n="navGallery" class="hover:text-stone-900 dark:hover:text-white transition-colors">Galeri</a></li>
                    </ul>
                </div>

                <!-- Col 3: Kontak & Hub -->
                <div class="lg:col-span-2">
                    <h4 data-i18n="footerContact" class="text-xs font-bold uppercase tracking-wider text-stone-900 dark:text-white mb-3.5">Kontak Tim</h4>
                    <ul class="space-y-2 text-xs text-stone-500 dark:text-stone-400">
                        <li>Jakarta & Denpasar, Indonesia</li>
                        <li>halo@danwisata.id</li>
                        <li class="text-[11px] text-stone-400 pt-1">Layanan tamu: 08.00 - 21.00 WIB</li>
                    </ul>
                </div>

                <!-- Col 4: Newsletter Sederhana -->
                <div class="lg:col-span-3">
                    <h4 data-i18n="footerGazette" class="text-xs font-bold uppercase tracking-wider text-stone-900 dark:text-white mb-2">Warta Perjalanan</h4>
                    <p data-i18n="footerGazetteDesc" class="text-xs text-stone-500 dark:text-stone-400 mb-3">
                        Kirimkan alamat surel Anda untuk menerima catatan destinasi baru dan promo open trip berkala.
                    </p>
                    <form onsubmit="handleNewsletter(event)" class="flex gap-1.5">
                        <input 
                            type="email" 
                            id="newsletterEmail"
                            required 
                            data-i18n-placeholder="newsletterPlaceholder"
                            placeholder="Alamat surel Anda..." 
                            class="w-full px-3.5 py-2 rounded-xl bg-white dark:bg-stone-800 border border-stone-200 dark:border-stone-700 text-xs focus:ring-1 focus:ring-stone-900 focus:outline-none"
                        >
                        <button type="submit" data-i18n="footerSubBtn" class="px-4 py-2 rounded-xl bg-stone-900 hover:bg-stone-800 text-white text-xs font-semibold shrink-0 transition-colors">
                            Kirim
                        </button>
                    </form>
                </div>
            </div>

            <!-- Bottom -->
            <div class="pt-6 flex flex-col sm:flex-row items-center justify-between text-[11px] text-stone-600 dark:text-stone-300 gap-3">
                <p data-i18n="footerCopyright">&copy; {{ date('Y') }} PT Nusantara Wander Indonesia. Dikurasi dengan cinta di Bumi Nusantara.</p>
                <div class="flex items-center gap-4">
                    <button onclick="showToast('Mitra terdaftar: ASITA & Komunitas Pemandu Lokal HPI', 'info')" class="hover:underline">Mitra Pemandu Lokal</button>
                    <button onclick="showToast('Kebijakan Privasi: Data Anda aman dan tidak pernah dijual.', 'info')" class="hover:underline">Privasi & Etika Perjalanan</button>
                    <a href="{{ env('ADMIN_URL', 'http://localhost:8001') }}" target="_blank" class="inline-flex items-center gap-1 text-stone-400 hover:text-stone-900 dark:hover:text-white transition-colors" title="Panel Concierge Admin (D:\admin pariwisata)">
                        <i class="fa-solid fa-lock text-[10px]"></i>
                        <span>Admin</span>
                    </a>
                </div>
            </div>
        </div>
    </footer>

    <!-- MODAL 1: DETAIL DESTINASI (CLEAN WHITE CARD / BOTTOM SHEET ON MOBILE) -->
    <div id="detailModal" class="fixed inset-0 z-50 hidden items-end sm:items-center justify-center p-0 sm:p-4 bg-stone-950/60 backdrop-blur-xs overflow-y-auto">
        <div class="bg-white dark:bg-stone-900 rounded-t-3xl sm:rounded-3xl max-w-2xl w-full overflow-hidden shadow-2xl border border-stone-200 dark:border-stone-800 my-0 sm:my-8 animate-fadeIn max-h-[90dvh] flex flex-col">
            <!-- Mobile Pull Drag Bar Indicator -->
            <div class="w-12 h-1.5 rounded-full bg-stone-300 dark:bg-stone-700 mx-auto my-2.5 sm:hidden shrink-0"></div>

            <div class="relative h-56 sm:h-72 shrink-0">
                <img id="modalDestImage" src="" alt="Detail Destinasi" class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-stone-950/85 via-stone-950/20 to-transparent"></div>
                
                <button onclick="closeDetailModal()" class="absolute top-4 right-4 w-9 h-9 rounded-full bg-stone-900/60 hover:bg-stone-900 text-white flex items-center justify-center text-sm transition-colors" title="Tutup">
                    <i class="fa-solid fa-xmark"></i>
                </button>

                <div class="absolute bottom-5 left-6 right-6 text-white">
                    <div class="flex items-center gap-2 mb-1.5">
                        <span id="modalDestCategory" class="px-2.5 py-0.5 rounded-full bg-white/20 backdrop-blur-md text-[11px] font-medium tracking-wide"></span>
                        <span class="text-xs text-stone-200 flex items-center gap-1">
                            <i class="fa-solid fa-star text-amber-300 text-[10px]"></i>
                            <span id="modalDestRating"></span>
                        </span>
                    </div>
                    <h3 id="modalDestTitle" class="font-serif text-2xl font-bold"></h3>
                    <p id="modalDestLocation" class="text-xs text-stone-200 flex items-center gap-1.5 mt-0.5"></p>
                </div>
            </div>

            <div class="p-6 sm:p-7 max-h-[60vh] overflow-y-auto space-y-5">
                <div>
                    <h4 data-i18n="cardRouteNotes" class="text-xs font-bold uppercase tracking-wider text-stone-400 mb-1.5">Catatan Perjalanan</h4>
                    <p id="modalDestDesc" class="text-stone-600 dark:text-stone-300 text-sm leading-relaxed"></p>
                </div>

                <div class="grid grid-cols-3 gap-3 p-3.5 rounded-2xl bg-stone-50 dark:bg-stone-800/60 border border-stone-200/60 dark:border-stone-700 text-xs">
                    <div>
                        <span data-i18n="modalDestBestTimeLabel" class="text-stone-400 block">Waktu Cocok</span>
                        <span id="modalDestBestTime" class="font-semibold text-stone-800 dark:text-white mt-0.5 block"></span>
                    </div>
                    <div>
                        <span data-i18n="modalDestDurationLabel" class="text-stone-400 block">Durasi Trip</span>
                        <span id="modalDestDuration" class="font-semibold text-stone-800 dark:text-white mt-0.5 block"></span>
                    </div>
                    <div>
                        <span data-i18n="modalDestPriceLabel" class="text-stone-400 block">Perkiraan Biaya</span>
                        <span id="modalDestPrice" class="font-bold text-stone-900 dark:text-white mt-0.5 block"></span>
                    </div>
                </div>

                <div>
                    <h4 data-i18n="modalDestHighlightsLabel" class="text-xs font-bold uppercase tracking-wider text-stone-400 mb-2">Yang Menanti di Sana</h4>
                    <div id="modalDestHighlights" class="space-y-1.5"></div>
                </div>

                <div class="pt-4 border-t border-stone-100 dark:border-stone-800 flex items-center justify-between gap-3">
                    <button onclick="closeDetailModal()" data-i18n="modalClose" class="px-5 py-2.5 rounded-full border border-stone-200 dark:border-stone-700 text-xs font-semibold hover:bg-stone-100 dark:hover:bg-stone-800 text-stone-700 dark:text-stone-300 transition-colors">
                        Tutup
                    </button>
                    <div class="flex items-center gap-2">
                        <a id="modalFullPageBtn" href="#" data-i18n="modalFullPage" class="px-4 py-2.5 rounded-full border border-stone-200 dark:border-stone-700 text-xs font-semibold hover:bg-stone-100 dark:hover:bg-stone-800 text-stone-700 dark:text-stone-300 transition-colors">
                            Buka Halaman Lengkap
                        </a>
                        <button id="modalBookNowBtn" class="px-6 py-2.5 rounded-full bg-stone-900 text-white dark:bg-stone-100 dark:text-stone-900 text-xs font-semibold shadow-sm hover:opacity-90 flex items-center gap-1.5">
                            <span data-i18n="modalPlanThis">Pesan Trip Ini</span>
                            <i class="fa-solid fa-arrow-right text-[10px]"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL 2: FORMULIR PEMESANAN (NATURAL & CLEAN / BOTTOM SHEET ON MOBILE) -->
    <div id="bookingModal" class="fixed inset-0 z-50 hidden items-end sm:items-center justify-center p-0 sm:p-4 bg-stone-950/60 backdrop-blur-xs overflow-y-auto">
        <div class="bg-white dark:bg-stone-900 rounded-t-3xl sm:rounded-3xl max-w-xl w-full overflow-hidden shadow-2xl border border-stone-200 dark:border-stone-800 my-0 sm:my-8 max-h-[92dvh] flex flex-col">
            <!-- Mobile Pull Drag Bar Indicator -->
            <div class="w-12 h-1.5 rounded-full bg-stone-300 dark:bg-stone-700 mx-auto my-2.5 sm:hidden shrink-0"></div>

            <div class="px-6 py-4 bg-stone-900 text-white dark:bg-stone-800 flex items-center justify-between shrink-0">
                <div>
                    <span data-i18n="modalBookConcierge" class="text-[10px] uppercase tracking-widest text-stone-400 font-medium">Boutique Booking Concierge</span>
                    <h3 data-i18n="modalBookTitle" class="font-serif text-lg font-semibold">Rencanakan Perjalanan Anda</h3>
                </div>
                <button onclick="closeBookingModal()" class="px-3 py-1 rounded-full bg-white/10 hover:bg-white/20 flex items-center gap-1.5 text-xs text-stone-200 hover:text-white transition-colors">
                    <i class="fa-solid fa-arrow-left text-[10px]"></i>
                    <span data-i18n="modalBookBack">Kembali</span>
                </button>
            </div>

            <form id="bookingForm" onsubmit="submitBookingForm(event)" class="p-6 max-h-[75vh] overflow-y-auto space-y-4 text-xs">
                @csrf
                <div>
                    <label data-i18n="modalBookSelectLabel" class="block font-bold uppercase tracking-wider text-stone-500 dark:text-stone-400 mb-1">
                        Pilihan Destinasi / Paket
                    </label>
                    <select id="bookItemSelect" name="item_name" onchange="calculateSimulatedPrice()" class="w-full px-3.5 py-2.5 rounded-xl bg-stone-50 dark:bg-stone-800 border border-stone-200 dark:border-stone-700 font-medium text-stone-900 dark:text-white focus:ring-1 focus:ring-stone-900 focus:outline-none">
                    </select>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <label data-i18n="modalBookNameLabel" class="block font-bold uppercase tracking-wider text-stone-500 dark:text-stone-400 mb-1">Nama Lengkap</label>
                        <input type="text" id="bookName" name="customer_name" required placeholder="Nama Anda" class="w-full px-3.5 py-2 rounded-xl bg-stone-50 dark:bg-stone-800 border border-stone-200 dark:border-stone-700 focus:ring-1 focus:ring-stone-900 focus:outline-none">
                    </div>
                    <div>
                        <label data-i18n="modalBookPhoneLabel" class="block font-bold uppercase tracking-wider text-stone-500 dark:text-stone-400 mb-1">Nomor WhatsApp</label>
                        <input type="tel" id="bookPhone" name="customer_phone" required placeholder="08xxxxxxxx" class="w-full px-3.5 py-2 rounded-xl bg-stone-50 dark:bg-stone-800 border border-stone-200 dark:border-stone-700 focus:ring-1 focus:ring-stone-900 focus:outline-none">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <label data-i18n="modalBookDateLabel" class="block font-bold uppercase tracking-wider text-stone-500 dark:text-stone-400 mb-1">Rencana Berangkat</label>
                        <input type="date" id="bookDate" name="travel_date" required class="w-full px-3.5 py-2 rounded-xl bg-stone-50 dark:bg-stone-800 border border-stone-200 dark:border-stone-700 focus:ring-1 focus:ring-stone-900 focus:outline-none">
                    </div>
                    <div>
                        <label data-i18n="modalBookPaxLabel" class="block font-bold uppercase tracking-wider text-stone-500 dark:text-stone-400 mb-1">Jumlah Peserta</label>
                        <input type="number" id="bookPax" name="pax" min="1" max="40" value="1" oninput="calculateSimulatedPrice()" required class="w-full px-3.5 py-2 rounded-xl bg-stone-50 dark:bg-stone-800 border border-stone-200 dark:border-stone-700 font-semibold focus:ring-1 focus:ring-stone-900 focus:outline-none">
                    </div>
                </div>

                <div>
                    <label data-i18n="modalBookAddonLabel" class="block font-bold uppercase tracking-wider text-stone-500 dark:text-stone-400 mb-1.5">Opsi Layanan Tambahan</label>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-2.5">
                        <label class="flex items-start gap-2.5 p-2.5 rounded-xl border border-stone-200 dark:border-stone-700 cursor-pointer hover:bg-stone-50 dark:hover:bg-stone-800/40">
                            <input type="checkbox" id="addonDrone" name="addon_drone" value="1" onchange="calculateSimulatedPrice()" class="mt-0.5 accent-stone-900 rounded">
                            <div>
                                <p data-i18n="modalBookDrone" class="font-semibold text-stone-800 dark:text-stone-200">Dokumentasi Drone & Foto</p>
                                <p class="text-[10px] text-stone-400">+Rp 450.000 / grup</p>
                            </div>
                        </label>
                        <label class="flex items-start gap-2.5 p-2.5 rounded-xl border border-stone-200 dark:border-stone-700 cursor-pointer hover:bg-stone-50 dark:hover:bg-stone-800/40">
                            <input type="checkbox" id="addonVip" name="addon_vip" value="1" onchange="calculateSimulatedPrice()" class="mt-0.5 accent-stone-900 rounded">
                            <div>
                                <p data-i18n="modalBookVilla" class="font-semibold text-stone-800 dark:text-stone-200">Upgrade Private Villa</p>
                                <p class="text-[10px] text-stone-400">+Rp 650.000 / orang</p>
                            </div>
                        </label>
                    </div>
                </div>

                <div>
                    <label data-i18n="modalBookVoucherLabel" class="block font-bold uppercase tracking-wider text-stone-500 dark:text-stone-400 mb-1">Kode Voucher Promo (Coba: <span class="font-mono text-stone-900 dark:text-white underline">PESONAID</span>)</label>
                    <input type="text" id="bookPromo" name="promo_code" oninput="calculateSimulatedPrice()" placeholder="Ketik kode voucher..." class="w-full px-3.5 py-2 rounded-xl bg-stone-50 dark:bg-stone-800 border border-stone-200 dark:border-stone-700 uppercase focus:ring-1 focus:ring-stone-900 focus:outline-none">
                </div>

                <div>
                    <label data-i18n="modalBookNotesLabel" class="block font-bold uppercase tracking-wider text-stone-500 dark:text-stone-400 mb-1">Catatan Tambahan (Opsional)</label>
                    <textarea id="bookNotes" name="notes" rows="2" placeholder="Makanan khusus, penjemputan bandara, atau preferensi kamar..." class="w-full px-3.5 py-1.5 rounded-xl bg-stone-50 dark:bg-stone-800 border border-stone-200 dark:border-stone-700 focus:ring-1 focus:ring-stone-900 focus:outline-none"></textarea>
                </div>

                <!-- Estimasi Ringkasan -->
                <div class="p-3.5 rounded-xl bg-stone-50 dark:bg-stone-800/80 border border-stone-200/70 dark:border-stone-700 space-y-1.5">
                    <div class="flex justify-between text-stone-500">
                        <span>Biaya Pokok (<span id="summaryPaxCount">1</span> Peserta)</span>
                        <span id="summaryBasePrice" class="font-medium text-stone-800 dark:text-white">Rp 0</span>
                    </div>
                    <div class="flex justify-between text-stone-500">
                        <span>Layanan Tambahan</span>
                        <span id="summaryAddonPrice" class="font-medium text-stone-800 dark:text-white">Rp 0</span>
                    </div>
                    <div id="summaryDiscountRow" class="hidden justify-between text-emerald-600 font-semibold">
                        <span>Potongan Voucher (15%)</span>
                        <span id="summaryDiscountPrice">-Rp 0</span>
                    </div>
                    <div class="pt-2 border-t border-stone-200 dark:border-stone-700 flex justify-between items-center text-sm">
                        <span class="font-bold text-stone-800 dark:text-white">Total Perkiraan Biaya</span>
                        <span id="summaryTotalPrice" class="font-serif font-bold text-stone-950 dark:text-white text-base">Rp 0</span>
                    </div>
                </div>

                <div class="flex items-center justify-end gap-2.5 pt-2">
                    <button type="button" onclick="closeBookingModal()" class="px-4 py-2 rounded-full border border-stone-200 dark:border-stone-700 font-semibold hover:bg-stone-50 dark:hover:bg-stone-800 flex items-center gap-1.5 text-stone-700 dark:text-stone-300 transition-colors">
                        <i class="fa-solid fa-arrow-left text-[10px]"></i>
                        <span data-i18n="modalBookCancel">Kembali</span>
                    </button>
                    <button type="submit" id="btnSubmitBooking" data-i18n="modalBookConfirm" class="px-6 py-2 rounded-full bg-stone-900 text-white dark:bg-stone-100 dark:text-stone-900 font-semibold shadow-sm hover:opacity-90">
                        Konfirmasi Reservasi
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- MODAL 3: BUKTI RESERVASI (E-TIKET RINGKAS) -->
    <div id="receiptModal" class="fixed inset-0 z-50 hidden items-center justify-center p-4 bg-stone-950/60 backdrop-blur-xs">
        <div class="bg-white dark:bg-stone-900 rounded-3xl max-w-sm w-full p-6 shadow-xl border border-stone-200 dark:border-stone-800 text-center animate-fadeIn">
            <div class="w-12 h-12 rounded-full bg-stone-100 dark:bg-stone-800 text-stone-900 dark:text-white flex items-center justify-center text-xl mx-auto mb-3">
                <i class="fa-solid fa-check"></i>
            </div>
            <span class="px-2.5 py-0.5 rounded-full bg-stone-100 dark:bg-stone-800 text-stone-700 dark:text-stone-300 text-[10px] font-mono font-semibold">Kode: <span id="receiptCode">NW-88291</span></span>
            <h3 data-i18n="receiptTitle" class="font-serif text-xl font-bold text-stone-900 dark:text-white mt-2">Reservasi Terdaftar</h3>
            <p class="text-xs text-stone-500 mt-1">
                Terima kasih <strong id="receiptName" class="text-stone-800 dark:text-stone-200"></strong>, rincian perjalanan Anda telah tersimpan di sistem kami.
            </p>

            <div class="mt-4 p-3 rounded-2xl bg-stone-50 dark:bg-stone-800/60 text-left text-xs space-y-1.5 border border-stone-200/60 dark:border-stone-700">
                <div class="flex justify-between">
                    <span class="text-stone-400">Pilihan:</span>
                    <span id="receiptItem" class="font-semibold text-stone-800 dark:text-white truncate max-w-[170px]"></span>
                </div>
                <div class="flex justify-between">
                    <span class="text-stone-400">Jadwal:</span>
                    <span id="receiptDate" class="text-stone-700 dark:text-stone-300"></span>
                </div>
                <div class="flex justify-between">
                    <span class="text-stone-400">Peserta:</span>
                    <span id="receiptPax" class="text-stone-700 dark:text-stone-300"></span>
                </div>
                <div class="pt-1.5 border-t border-stone-200 dark:border-stone-700 flex justify-between font-bold">
                    <span>Total:</span>
                    <span id="receiptTotal" class="text-stone-900 dark:text-white"></span>
                </div>
            </div>

            <div class="mt-5 flex flex-col gap-2">
                <a id="receiptPrintLink" href="#" class="w-full py-2.5 rounded-full bg-stone-900 text-white dark:bg-stone-100 dark:text-stone-900 font-semibold text-xs transition-opacity hover:opacity-90 flex items-center justify-center gap-1.5">
                    <i class="fa-solid fa-receipt text-[11px]"></i>
                    <span data-i18n="receiptPrint">Buka Lembar E-Tiket Lengkap</span>
                </a>
                <button onclick="closeReceiptModal()" class="w-full py-2 rounded-full border border-stone-200 dark:border-stone-700 text-stone-600 dark:text-stone-300 text-xs hover:bg-stone-100 dark:hover:bg-stone-800 flex items-center justify-center gap-1.5 transition-colors">
                    <i class="fa-solid fa-arrow-left text-[10px]"></i>
                    <span data-i18n="receiptBack">Kembali ke Beranda</span>
                </button>
            </div>
        </div>
    </div>

    <!-- MODAL 4: LIGHTBOX GALERI FOTO -->
    <div id="lightboxModal" onclick="closeLightbox()" class="fixed inset-0 z-50 hidden items-center justify-center p-4 bg-stone-950/85 backdrop-blur-sm">
        <div class="max-w-3xl w-full relative" onclick="event.stopPropagation()">
            <button onclick="closeLightbox()" class="absolute -top-10 right-0 text-white/80 hover:text-white text-xl">
                <i class="fa-solid fa-xmark"></i>
            </button>
            <img id="lightboxImg" src="" alt="Galeri Nusantara" class="w-full max-h-[75vh] object-cover rounded-2xl shadow-2xl">
            <div class="mt-3 flex items-center justify-between text-white">
                <div>
                    <h4 id="lightboxCaption" class="font-serif text-lg font-bold"></h4>
                    <p id="lightboxSub" class="text-xs text-stone-300"></p>
                </div>
                <button onclick="closeLightbox(); openBookingModal();" data-i18n="lightboxVisitBtn" class="px-4 py-1.5 rounded-full bg-white text-stone-950 text-xs font-semibold hover:bg-stone-100">
                    Kunjungi Tempat Ini
                </button>
            </div>
        </div>
    </div>

    <!-- ================= FLOATING GLASS MOBILE DOCK (HP ONLY) ================= -->
    <nav id="mobileBottomDock" class="fixed bottom-3 inset-x-3 sm:hidden z-40 transition-all duration-300">
        <div class="mobile-bottom-dock max-w-md mx-auto rounded-2xl bg-white/92 dark:bg-stone-900/92 border border-stone-200/90 dark:border-stone-800 shadow-[0_12px_40px_rgba(0,0,0,0.18)] px-2.5 py-1.5 flex items-center justify-between">
            <a href="{{ route('home') }}#beranda" class="flex flex-col items-center justify-center py-1 px-2.5 rounded-xl {{ request()->routeIs('home') ? 'text-stone-950 dark:text-white font-bold' : 'text-stone-600 dark:text-stone-300' }} hover:text-stone-950 dark:hover:text-white transition-colors active:scale-95 group">
                <i class="fa-solid fa-house text-base group-hover:scale-110 transition-transform"></i>
                <span data-i18n="navHome" class="text-[10px] font-medium tracking-tight mt-0.5">Beranda</span>
            </a>
            <a href="{{ route('destinations.index') }}" class="flex flex-col items-center justify-center py-1 px-2.5 rounded-xl {{ request()->routeIs('destinations.*') ? 'text-stone-950 dark:text-white font-bold' : 'text-stone-600 dark:text-stone-300' }} hover:text-stone-950 dark:hover:text-white transition-colors active:scale-95 group">
                <i class="fa-solid fa-compass text-base group-hover:scale-110 transition-transform"></i>
                <span data-i18n="navDest" class="text-[10px] font-medium tracking-tight mt-0.5">Destinasi</span>
            </a>
            <!-- Central Action: Quick Trip Planner -->
            <button onclick="openBookingModal()" class="flex flex-col items-center justify-center -mt-6 p-3 rounded-full bg-gradient-to-tr from-stone-950 via-stone-850 to-stone-700 dark:from-stone-100 dark:via-stone-200 dark:to-stone-300 text-white dark:text-stone-900 shadow-lg shadow-stone-900/40 active:scale-90 transition-transform ring-4 ring-white dark:ring-stone-900" title="Rencanakan Trip">
                <i class="fa-solid fa-paper-plane text-sm"></i>
            </button>
            <a href="{{ route('packages.index') }}" class="flex flex-col items-center justify-center py-1 px-2.5 rounded-xl {{ request()->routeIs('packages.*') ? 'text-stone-950 dark:text-white font-bold' : 'text-stone-600 dark:text-stone-300' }} hover:text-stone-950 dark:hover:text-white transition-colors active:scale-95 group">
                <i class="fa-solid fa-suitcase-rolling text-base group-hover:scale-110 transition-transform"></i>
                <span data-i18n="navPkg" class="text-[10px] font-medium tracking-tight mt-0.5">Paket</span>
            </a>
            <button onclick="showSavedDestinations()" class="relative flex flex-col items-center justify-center py-1 px-2.5 rounded-xl text-stone-600 dark:text-stone-300 hover:text-stone-950 dark:hover:text-white transition-colors active:scale-95 group" title="Destinasi Tersimpan">
                <i class="fa-regular fa-heart text-base group-hover:scale-110 transition-transform"></i>
                <span id="wishlistBadgeDock" class="absolute top-0 right-2 w-3.5 h-3.5 rounded-full bg-rose-500 text-white text-[8px] font-bold flex items-center justify-center">0</span>
                <span data-i18n="navWishlist" class="text-[10px] font-medium tracking-tight mt-0.5">Favorit</span>
            </button>
        </div>
    </nav>

    <!-- Global Application Scripts -->
    <script>
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        function formatRupiah(num) {
            return 'Rp ' + Number(num).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }

        function showToast(message, type = 'success') {
            const container = document.getElementById('toastContainer');
            const toast = document.createElement('div');
            const icon = type === 'success' 
                ? '<i class="fa-solid fa-check text-stone-900 dark:text-stone-100 text-sm"></i>' 
                : '<i class="fa-solid fa-info text-stone-500 text-sm"></i>';

            toast.className = 'pointer-events-auto flex items-center gap-3 px-4 py-3 rounded-2xl bg-white dark:bg-stone-900 text-stone-900 dark:text-stone-100 text-xs font-medium shadow-md border border-stone-200 dark:border-stone-800 transition-all duration-200 animate-fadeIn';
            toast.innerHTML = `${icon}<span>${message}</span>`;

            container.appendChild(toast);
            setTimeout(() => {
                toast.style.opacity = '0';
                toast.style.transform = 'translateY(6px)';
                setTimeout(() => toast.remove(), 250);
            }, 3200);
        }

        // Remove dark mode permanently and reset to light aesthetic
        (function() {
            try {
                localStorage.removeItem('theme');
                document.documentElement.classList.remove('dark');
            } catch(e) {}
        })();

        // Multi-Language System (Bahasa Indonesia & English)
        let currentLang = localStorage.getItem('nw_lang') || 'id';

        const i18nDictionary = {
            id: {
                brandTag: 'ID',
                navHome: 'Beranda',
                navDest: 'Destinasi',
                navPkg: 'Paket Wisata',
                navAbout: 'Tentang',
                navAboutUs: 'Tentang Kami',
                navVisiMisi: 'Visi & Misi',
                navArticle: 'Artikel & Tips',
                navStory: 'Filosofi',
                navGallery: 'Galeri',
                navTesti: 'Testimoni',
                navAdmin: 'Admin Reservasi',
                navPlanTrip: 'Rencanakan Trip',
                navWishlist: 'Favorit',
                wishlistSavedTitle: 'Destinasi Tersimpan',
                langDrawerName: 'ID (Bahasa Indonesia)',

                // Hero
                heroBadge: 'Eksplorasi 17.000+ Pulau Eksotis di Zamrud Khatulistiwa',
                heroTitle: 'Temukan Surga Tersembunyi di <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-300 via-teal-200 to-amber-200 italic">Bumi Nusantara</span>',
                heroDesc: 'Dari birunya perairan Raja Ampat, megahnya kabut pagi Borobudur, hingga hangatnya senja di Labuan Bajo. Wujudkan perjalanan impian Anda bersama pemandu lokal terbaik.',
                heroStatDest: 'Destinasi Unggulan',
                heroStatGuide: 'Rating Wisatawan',
                heroStatSat: 'Pelanggan Puas',
                heroFieldRegion: 'Lokasi Tujuan',
                heroFieldDate: 'Tanggal Berangkat',
                heroFieldPax: 'Jumlah Peserta',
                heroBtnSearch: 'Cari Wisata',
                heroPopSearch: 'Pencarian Populer:',

                heroLocPlaceholder: 'Ketik atau pilih provinsi di Indonesia...',
                heroLocHint: 'Bisa ketik nama provinsi',
                heroLocAllHeader: '38 Provinsi di Seluruh Indonesia',
                heroLocNoMatch: 'Tidak ada provinsi yang cocok dengan',
                heroLocShowAll: 'Tampilkan Seluruh Provinsi',
                heroLocDirectSelect: 'Pilih Langsung',

                heroLocAll: 'Semua Destinasi Nusantara',
                heroLocBali: 'Bali & Labuan Bajo (NTT)',
                heroLocPapua: 'Raja Ampat, Papua Barat',
                heroLocJava: 'Bromo, Ijen & Borobudur (Jawa)',
                heroLocSumatra: 'Danau Toba & Pulau Weh (Sumatera)',
                heroLocBorneo: 'Derawan & Tana Toraja',

                heroPax1: '1 Orang (Solo Traveler)',
                heroPax2: '2 Orang (Pasangan / Sahabat)',
                heroPax4: '4 Orang (Keluarga Kecil)',
                heroPax6: '6 Orang (Grup Privat)',
                heroPax10: '10+ Orang (Rombongan)',

                // Destinations Section
                destSubtitle: 'Jurnal Destinasi',
                destTitle: 'Tempat-Tempat Istimewa di Bumi Pertiwi',
                destDesc: 'Setiap lokasi dikurasi dengan cermat: memilih musim terbaik, penginapan berkarakter, dan rute santai yang bersahabat dengan alam.',
                destBtnViewAll: 'Lihat Halaman Destinasi',
                catAll: 'Semua Koleksi',
                catBeach: 'Pantai & Perairan Karst',
                catMountain: 'Puncak & Kaldera Dingin',
                catCulture: 'Sejarah & Perkampungan Adat',
                catNature: 'Eksotisme Rimba & Satwa',
                cardStartingFrom: 'Mulai dari',
                cardRouteNotes: 'Catatan Rute',
                cardPerPerson: '/org',

                // Packages Section
                pkgSubtitle: 'Boutique Itinerary',
                pkgTitle: 'Paket Perjalanan Terkurasi',
                pkgDesc: 'Sudah mencakup kabin/hotel yang bersih dan estetik, transportasi darat & laut privat, tiket kawasan konservasi, serta santap hidangan lokal segar.',
                pkgHeaderBtn: 'Lihat Seluruh Paket Wisata',
                pkgBottomBtn: 'Lihat Seluruh Pilihan Paket Wisata (9 Rute Lengkap)',
                pkgBottomSub: 'Halaman lengkap mencakup sailing phinisi privat, overland kawah, slow living, jalur rempah, dan glamping.',
                pkgIncluded: 'Sudah Termasuk:',
                pkgSelectBtn: 'Pilih Paket Ini',
                pkgSeeMore: 'Lihat Selengkapnya',
                pkgPerGuest: '/ tamu',

                // Story / Philosophy
                storySubtitle: 'Kenapa Berkelana Bersama Kami?',
                storyTitle: 'Sebuah Perjalanan yang Bernapas, Menghargai Waktu & Warga Lokal',
                storyDesc: 'Kami mendirikan DANWISATA sebagai portal pariwisata Indonesia untuk menghadirkan rute perjalanan yang autentik, menghormati alam, dan mendekatkan Anda dengan kehangatan warga lokal.',
                storyQuote: '"Pariwisata yang baik bukan sekadar meninggalkan jejak langkah, melainkan membawa pulang rasa hormat pada tanah dan manusianya."',
                storyPrinciple: '— Prinsip Perjalanan DANWISATA',

                // Gallery
                gallerySubtitle: 'Dokumentasi Asli',
                galleryTitle: 'Cerita Visual dari Para Tamu',
                galleryDesc: 'Potret heningnya pagi di bukit karst, kehangatan seduhan teh warga desa, dan laut biru toska tanpa filter buatan.',

                // Testimonials
                testiSubtitle: 'Cerita Para Penjelajah',
                testiTitle: 'Jejak Langkah & Kesan Hangat',
                testiDesc: 'Cerita jujur dari mereka yang telah merasakan ritme perjalanan santai bersama warga lokal kami.',
                promoHeader: 'Rencana Liburan Bareng Sahabat atau Keluarga?',
                promoTitle: 'Gunakan Kode Voucher <span class="underline decoration-stone-500 font-mono text-amber-200">PESONAID</span> untuk Diskon 15%',
                promoDesc: 'Berlaku untuk simulasi dan pemesanan seluruh rute private tour dan open trip kami bulan ini.',
                promoCopy: 'Salin Kode',
                promoPlan: 'Rencanakan Trip',

                // Footer
                footerDesc: 'Portal Pariwisata Indonesia terpercaya. Kami menemani Anda menjelajahi keindahan nusantara, ragam budaya, dan paket liburan impian terbaik dengan pengalaman berkesan.',
                footerExplore: 'Eksplorasi',
                footerContact: 'Kontak Tim',
                footerGazette: 'Warta Perjalanan',
                footerGazetteDesc: 'Kirimkan alamat surel Anda untuk menerima catatan destinasi baru dan promo open trip berkala.',
                footerSubBtn: 'Daftar',
                footerCopyright: '© 2026 PT DANWISATA Indonesia — Portal Pariwisata Indonesia. Hak cipta dilindungi.',

                // Modals
                modalDetailTitle: 'Catatan Destinasi & Panduan Musim',
                modalFullPage: 'Buka Halaman Lengkap',
                modalClose: 'Tutup',
                modalPlanThis: 'Pesan Trip Ini',
                modalBookTitle: 'Rencanakan Perjalanan Anda',
                modalBookConcierge: 'Boutique Booking Concierge',
                modalBookBack: 'Kembali',
                modalBookSelectLabel: 'Pilihan Destinasi / Paket',
                modalBookNameLabel: 'Nama Lengkap',
                modalBookPhoneLabel: 'Nomor WhatsApp',
                modalBookDateLabel: 'Rencana Berangkat',
                modalBookPaxLabel: 'Jumlah Peserta',
                modalBookAddonLabel: 'Opsi Layanan Tambahan',
                modalBookDrone: 'Dokumentasi Drone & Foto',
                modalBookVilla: 'Upgrade Private Villa',
                modalBookVoucherLabel: 'Kode Voucher Promo',
                modalBookNotesLabel: 'Catatan Khusus atau Permintaan Rute',
                modalBookCancel: 'Batal',
                modalBookConfirm: 'Konfirmasi Reservasi',
                receiptTitle: 'Reservasi Berhasil Dicatat!',
                receiptPrint: 'Buka Lembar E-Tiket Lengkap',
                receiptBack: 'Kembali ke Beranda',

                // Catalog Pages
                catDestBadge: 'Destinasi Terkurasi di 6 Wilayah Nusantara',
                catDestTitle: 'Eksplorasi Seluruh Penjuru Nusantara',
                catDestDesc: 'Pilih perjalanan sesuai musim dan minat Anda: dari perairan tenang kepulauan timur hingga kaldera sejuk pegunungan Jawa.',
                catDestSearch: 'Pencarian Cepat',
                catDestCategory: 'Kategori',
                catDestRegion: 'Wilayah',
                catDestSort: 'Urutkan',
                catDestReset: 'Reset Filter',
                catDestBack: 'Kembali ke Beranda',
                catDestToPkg: 'Lihat Paket Perjalanan Terkurasi (9 Paket)',

                catPkgBadge: 'Pilihan Paket Lengkap & All-Inclusive',
                catPkgTitle: 'Koleksi Paket Perjalanan Terkurasi',
                catPkgDesc: 'Menikmati keindahan alam nusantara tanpa repot. Kami mengatur transportasi privat, kabin kapal/villa terbaik, dan perizinan resmi.',
                catPkgSearch: 'Cari Paket / Penginapan',
                catPkgDuration: 'Durasi Perjalanan',
                catPkgSort: 'Urutkan Paket',
                catPkgReset: 'Reset Filter',
                catPkgBack: 'Kembali ke Beranda',
                catPkgToDest: 'Jelajahi Seluruh Destinasi (20 Lokasi)',

                newsletterPlaceholder: 'Alamat surel Anda...',
                modalDestBestTimeLabel: 'Waktu Cocok',
                modalDestDurationLabel: 'Durasi Trip',
                modalDestPriceLabel: 'Perkiraan Biaya',
                modalDestHighlightsLabel: 'Yang Menanti di Sana',
                lightboxVisitBtn: 'Kunjungi Tempat Ini',
                heroPopRajaAmpat: '🏝️ Kepulauan Raja Ampat',
                heroPopBromo: '🌋 Sunrise Gunung Bromo',
                heroPopBorobudur: '🛕 Candi Borobudur',
                heroPopKomodo: '🐉 Taman Nasional Komodo',
                catSearchPlaceholder: 'Ketik nama lokasi / wilayah...',
                catPkgSearchPlaceholder: 'Contoh: Phinisi, Bromo, Toraja, Villa...',
                autoFilterNotice: 'Menampilkan hasil filter otomatis',
                autoFilterPkgNotice: 'Menampilkan paket hasil filter otomatis',

                catOptAllCat: 'Semua Kategori',
                catOptBeach: 'Pantai & Perairan Karst',
                catOptMountain: 'Puncak & Kaldera',
                catOptCulture: 'Desa & Sejarah Budaya',
                catOptNature: 'Eksotisme Satwa & Rimba',

                catOptAllRegion: 'Semua Wilayah',
                catOptBali: 'Bali & Nusa Tenggara',
                catOptPapua: 'Papua & Maluku',
                catOptJava: 'Jawa',
                catOptSumatra: 'Sumatera',
                catOptBorneo: 'Kalimantan & Sulawesi',

                catOptSortPopular: 'Rekomendasi Terbaik',
                catOptSortPriceAsc: 'Biaya Terendah',
                catOptSortPriceDesc: 'Biaya Tertinggi',
                catOptSortRating: 'Ulasan Terbaik',

                pkgOptAllDuration: 'Semua Durasi',
                pkgOpt3D: '3 Hari 2 Malam (Weekend Trip)',
                pkgOpt4D: '4 Hari 3 Malam',
                pkgOpt5D: '5 Hari 4 Malam',
                pkgOpt6D: '6 Hari 5 Malam (Ekspedisi Panjang)',

                pkgOptSortRec: 'Rekomendasi Terbaik',
                pkgOptSortLow: 'Tarif Terendah',
                pkgOptSortHigh: 'Tarif Tertinggi',

                toastLangChanged: 'Bahasa diubah ke Bahasa Indonesia'
            },
            en: {
                brandTag: 'EN',
                navHome: 'Home',
                navDest: 'Destinations',
                navPkg: 'Tour Packages',
                navAbout: 'About',
                navAboutUs: 'About Us',
                navVisiMisi: 'Vision & Mission',
                navArticle: 'Articles & Tips',
                navStory: 'Philosophy',
                navGallery: 'Gallery',
                navTesti: 'Reviews',
                navAdmin: 'Bookings Admin',
                navPlanTrip: 'Plan a Trip',
                navWishlist: 'Saved',
                wishlistSavedTitle: 'Saved Destinations',
                langDrawerName: 'EN (English)',

                // Hero
                heroBadge: 'Exploring 17,000+ Exotic Islands in the Equatorial Emerald',
                heroTitle: 'Discover Hidden Paradises Across the <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-300 via-teal-200 to-amber-200 italic">Indonesian Archipelago</span>',
                heroDesc: 'From the turquoise waters of Raja Ampat and misty mornings at Borobudur, to golden sunsets in Labuan Bajo. Craft your dream escape with our trusted local hosts.',
                heroStatDest: 'Curated Destinations',
                heroStatGuide: 'Traveler Rating',
                heroStatSat: 'Delighted Travelers',
                heroFieldRegion: 'Target Region',
                heroFieldDate: 'Departure Date',
                heroFieldPax: 'Guest Count',
                heroBtnSearch: 'Search Trips',
                heroPopSearch: 'Popular Searches:',

                heroLocPlaceholder: 'Type or select an Indonesian province...',
                heroLocHint: 'You can type any province name',
                heroLocAllHeader: 'All 38 Indonesian Provinces',
                heroLocNoMatch: 'No provinces matching',
                heroLocShowAll: 'Show All Provinces',
                heroLocDirectSelect: 'Direct Select',

                heroLocAll: 'All Destinations (Archipelago)',
                heroLocBali: 'Bali & Labuan Bajo (NTT)',
                heroLocPapua: 'Raja Ampat, West Papua',
                heroLocJava: 'Bromo, Ijen & Borobudur (Java)',
                heroLocSumatra: 'Lake Toba & Weh Island (Sumatra)',
                heroLocBorneo: 'Derawan & Tana Toraja',

                heroPax1: '1 Guest (Solo Traveler)',
                heroPax2: '2 Guests (Couple / Friends)',
                heroPax4: '4 Guests (Small Family)',
                heroPax6: '6 Guests (Private Group)',
                heroPax10: '10+ Guests (Tour Group)',

                // Destinations Section
                destSubtitle: 'Travel Journal',
                destTitle: 'Extraordinary Sanctuaries Across the Archipelago',
                destDesc: 'Every location is thoughtfully handpicked: prime traveling seasons, boutique character stays, and gentle routes respectful to nature.',
                destBtnViewAll: 'View All Destinations',
                catAll: 'All Collections',
                catBeach: 'Beaches & Karst Waters',
                catMountain: 'Volcanic Peaks & Calderas',
                catCulture: 'Heritage & Traditional Villages',
                catNature: 'Rainforest & Wildlife',
                cardStartingFrom: 'Starting from',
                cardRouteNotes: 'Route Notes',
                cardPerPerson: '/guest',

                // Packages Section
                pkgSubtitle: 'Boutique Itinerary',
                pkgTitle: 'Curated Tour Packages',
                pkgDesc: 'Fully inclusive of aesthetic villas/cabins, private land & marine charters, conservation permits, and fresh regional dining.',
                pkgHeaderBtn: 'View All Tour Packages',
                pkgBottomBtn: 'Explore All Tour Packages (9 Complete Routes)',
                pkgBottomSub: 'Complete catalog featuring private phinisi charters, caldera overlands, slow living, spice trails, and glamping.',
                pkgIncluded: 'All Inclusions:',
                pkgSelectBtn: 'Select This Package',
                pkgSeeMore: 'View Details',
                pkgPerGuest: '/ guest',

                // Story / Philosophy
                storySubtitle: 'Why Travel With Us?',
                storyTitle: 'A Breathing Journey that Honors Time and Local Communities',
                storyDesc: 'We founded DANWISATA as the official Indonesian tourism portal to craft authentic journeys that honor nature and connect you with local communities.',
                storyQuote: '"True travel does not merely leave footprints; it brings home heartfelt respect for the land and its people."',
                storyPrinciple: '— DANWISATA Travel Principles',

                // Gallery
                gallerySubtitle: 'Authentic Moments',
                galleryTitle: 'Visual Stories from Our Travelers',
                galleryDesc: 'Misty karst mornings, warm village herbal tea brewing, and turquoise lagoons with zero artificial filters.',

                // Testimonials
                testiSubtitle: 'Traveler Stories',
                testiTitle: 'Footsteps & Warm Memories',
                testiDesc: 'Genuine reflections from guests who experienced slow, mindful adventures guided by local community members.',
                promoHeader: 'Planning a Getaway with Friends or Family?',
                promoTitle: 'Apply Voucher <span class="underline decoration-stone-500 font-mono text-amber-200">PESONAID</span> for 15% Off',
                promoDesc: 'Valid for all private tours and open trips simulations booked this month.',
                promoCopy: 'Copy Code',
                promoPlan: 'Plan Your Trip',

                // Footer
                footerDesc: 'Trusted Indonesia Tourism Portal. We accompany you to embrace pristine islands, historic spice heritage, and local hospitality responsibly and memorable.',
                footerExplore: 'Explore',
                footerContact: 'Contact Us',
                footerGazette: 'Travel Gazette',
                footerGazetteDesc: 'Enter your email to receive newly curated secret routes and seasonal promotions.',
                footerSubBtn: 'Subscribe',
                footerCopyright: '© 2026 PT DANWISATA Indonesia — Indonesia Tourism Portal. All rights reserved.',

                // Modals
                modalDetailTitle: 'Destination Notes & Seasonal Guide',
                modalFullPage: 'View Complete Page',
                modalClose: 'Close',
                modalPlanThis: 'Book This Trip',
                modalBookTitle: 'Your Travel Reservation',
                modalBookConcierge: 'Boutique Booking Concierge',
                modalBookBack: 'Back',
                modalBookSelectLabel: 'Destination / Tour Package Choice',
                modalBookNameLabel: 'Full Name',
                modalBookPhoneLabel: 'WhatsApp Number',
                modalBookDateLabel: 'Departure Date',
                modalBookPaxLabel: 'Number of Guests',
                modalBookAddonLabel: 'Additional Curated Services',
                modalBookDrone: 'Aerial Drone & Photo Service',
                modalBookVilla: 'Private Villa Upgrade',
                modalBookVoucherLabel: 'Promo Voucher Code',
                modalBookNotesLabel: 'Special Requests or Custom Route Needs',
                modalBookCancel: 'Cancel',
                modalBookConfirm: 'Confirm Reservation',
                receiptTitle: 'Reservation Confirmed!',
                receiptPrint: 'Open Full E-Ticket Sheet',
                receiptBack: 'Back to Home',

                // Catalog Pages
                catDestBadge: 'Curated Destinations Across 6 Regions',
                catDestTitle: 'Explore Every Corner of the Archipelago',
                catDestDesc: 'Choose your journey by season and interest: from tranquil eastern waters to cool Javanese volcanic calderas.',
                catDestSearch: 'Quick Search',
                catDestCategory: 'Category',
                catDestRegion: 'Region',
                catDestSort: 'Sort By',
                catDestReset: 'Reset Filters',
                catDestBack: 'Back to Home',
                catDestToPkg: 'Explore Curated Packages (9 Packages)',

                catPkgBadge: 'All-Inclusive Boutique Journeys',
                catPkgTitle: 'Curated Tour Packages Collection',
                catPkgDesc: 'Experience the beauty of the Indonesian archipelago seamlessly. We handle private transport, top cabins, and permits.',
                catPkgSearch: 'Search Packages / Lodging',
                catPkgDuration: 'Trip Duration',
                catPkgSort: 'Sort Packages',
                catPkgReset: 'Reset Filters',
                catPkgBack: 'Back to Home',
                catPkgToDest: 'Explore All Destinations (20 Locations)',

                newsletterPlaceholder: 'Your email address...',
                modalDestBestTimeLabel: 'Best Season',
                modalDestDurationLabel: 'Trip Duration',
                modalDestPriceLabel: 'Estimated Cost',
                modalDestHighlightsLabel: 'What Awaits You',
                lightboxVisitBtn: 'Explore This Place',
                heroPopRajaAmpat: '🏝️ Raja Ampat Islands',
                heroPopBromo: '🌋 Mount Bromo Sunrise',
                heroPopBorobudur: '🛕 Borobudur Sanctuary',
                heroPopKomodo: '🐉 Komodo National Park',
                catSearchPlaceholder: 'Type location or region name...',
                catPkgSearchPlaceholder: 'E.g. Phinisi, Bromo, Toraja, Villa...',
                autoFilterNotice: 'Displaying instant filtered results',
                autoFilterPkgNotice: 'Displaying instant filtered packages',

                catOptAllCat: 'All Categories',
                catOptBeach: 'Beaches & Karst Waters',
                catOptMountain: 'Peaks & Calderas',
                catOptCulture: 'Heritage & Culture',
                catOptNature: 'Wildlife & Rainforest',

                catOptAllRegion: 'All Regions',
                catOptBali: 'Bali & Nusa Tenggara',
                catOptPapua: 'Papua & Maluku',
                catOptJava: 'Java',
                catOptSumatra: 'Sumatra',
                catOptBorneo: 'Borneo & Sulawesi',

                catOptSortPopular: 'Top Recommended',
                catOptSortPriceAsc: 'Lowest Price',
                catOptSortPriceDesc: 'Highest Price',
                catOptSortRating: 'Highest Rated',

                pkgOptAllDuration: 'All Durations',
                pkgOpt3D: '3 Days 2 Nights (Weekend Trip)',
                pkgOpt4D: '4 Days 3 Nights',
                pkgOpt5D: '5 Days 4 Nights',
                pkgOpt6D: '6 Days 5 Nights (Long Expedition)',

                pkgOptSortRec: 'Top Recommended',
                pkgOptSortLow: 'Lowest Price',
                pkgOptSortHigh: 'Highest Price',

                toastLangChanged: 'Language changed to English'
            }
        };

        function applyTranslations() {
            const lang = currentLang;
            const dict = i18nDictionary[lang] || i18nDictionary['id'];

            const langLabel = document.getElementById('langLabel');
            if (langLabel) langLabel.textContent = lang.toUpperCase();
            const langLabelMobile = document.getElementById('langLabelMobile');
            if (langLabelMobile) langLabelMobile.textContent = lang.toUpperCase();
            const langDrawerLabel = document.getElementById('langDrawerLabel');
            if (langDrawerLabel) langDrawerLabel.textContent = dict.langDrawerName;
            const brandLangTag = document.getElementById('brandLangTag');
            if (brandLangTag) brandLangTag.textContent = dict.brandTag;

            document.querySelectorAll('[data-i18n]').forEach(el => {
                const key = el.getAttribute('data-i18n');
                if (dict[key]) {
                    if (el.tagName === 'OPTION') {
                        el.textContent = dict[key];
                    } else {
                        el.innerHTML = dict[key];
                    }
                }
            });

            document.querySelectorAll('[data-i18n-placeholder]').forEach(el => {
                const key = el.getAttribute('data-i18n-placeholder');
                if (dict[key]) {
                    el.placeholder = dict[key];
                }
            });

            document.querySelectorAll('[data-i18n-title]').forEach(el => {
                const key = el.getAttribute('data-i18n-title');
                if (dict[key]) {
                    el.title = dict[key];
                }
            });

            document.documentElement.lang = lang;
        }

        function toggleLanguage() {
            currentLang = currentLang === 'id' ? 'en' : 'id';
            localStorage.setItem('nw_lang', currentLang);
            applyTranslations();
            showToast(i18nDictionary[currentLang].toastLangChanged, 'info');
        }

        function toggleMobileMenu() {
            const menu = document.getElementById('mobileMenu');
            const icon = document.getElementById('mobileMenuIcon');
            menu.classList.toggle('hidden');
            if (menu.classList.contains('hidden')) {
                icon.className = 'fa-solid fa-bars text-lg';
            } else {
                icon.className = 'fa-solid fa-xmark text-lg';
            }
        }

        let savedWishlist = new Set(JSON.parse(localStorage.getItem('nw_wishlist') || '[1, 3]'));

        function updateWishlistBadges() {
            if (document.getElementById('wishlistBadge')) document.getElementById('wishlistBadge').textContent = savedWishlist.size;
            if (document.getElementById('wishlistBadgeMobile')) document.getElementById('wishlistBadgeMobile').textContent = savedWishlist.size;
            if (document.getElementById('wishlistBadgeDock')) document.getElementById('wishlistBadgeDock').textContent = savedWishlist.size;
            localStorage.setItem('nw_wishlist', JSON.stringify(Array.from(savedWishlist)));
        }

        function toggleWishlist(id, name = 'Destinasi') {
            if (savedWishlist.has(id)) {
                savedWishlist.delete(id);
                showToast(`${name} dihapus dari daftar tersimpan`, 'info');
            } else {
                savedWishlist.add(id);
                showToast(`${name} disimpan ke daftar impian`, 'success');
            }
            updateWishlistBadges();
            if (typeof renderDestinationsGrid === 'function') {
                renderDestinationsGrid();
            }
        }

        function showSavedDestinations() {
            if (savedWishlist.size === 0) {
                showToast('Belum ada destinasi favorit yang disimpan.', 'info');
                return;
            }
            showToast(`Anda memiliki ${savedWishlist.size} destinasi tersimpan di jurnal impian!`, 'success');
            const destSection = document.getElementById('destinasi');
            if (destSection) destSection.scrollIntoView({ behavior: 'smooth' });
        }

        function openLightbox(url, title, sub) {
            document.getElementById('lightboxImg').src = url;
            document.getElementById('lightboxCaption').textContent = title;
            document.getElementById('lightboxSub').textContent = sub;
            const modal = document.getElementById('lightboxModal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeLightbox() {
            const modal = document.getElementById('lightboxModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        function copyVoucherCode() {
            const code = 'PESONAID';
            const tempInput = document.createElement('input');
            tempInput.value = code;
            document.body.appendChild(tempInput);
            tempInput.select();
            document.execCommand('copy');
            document.body.removeChild(tempInput);

            if (document.getElementById('bookPromo')) {
                document.getElementById('bookPromo').value = code;
            }
            showToast('Kode voucher PESONAID diterapkan (Diskon 15%)', 'success');
        }

        function handleNewsletter(e) {
            e.preventDefault();
            const input = document.getElementById('newsletterEmail');
            const email = input.value;

            fetch("{{ route('newsletter.subscribe') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": csrfToken,
                    "Accept": "application/json"
                },
                body: JSON.stringify({ email: email })
            })
            .then(res => res.json())
            .then(data => {
                showToast(data.message, 'success');
                input.value = '';
            })
            .catch(() => {
                showToast(`Terima kasih! Warta perjalanan akan dikirim ke ${email}`, 'success');
                input.value = '';
            });
        }

        function openDetailModal(id) {
            fetch(`/api/destinations/${id}`)
                .then(res => res.json())
                .then(dest => {
                    document.getElementById('modalDestImage').src = dest.image;
                    document.getElementById('modalDestCategory').textContent = dest.category;
                    document.getElementById('modalDestRating').textContent = `${dest.rating} (${dest.reviews_count} ulasan)`;
                    document.getElementById('modalDestTitle').textContent = dest.name;
                    document.getElementById('modalDestLocation').innerHTML = `<i class="fa-solid fa-location-dot text-stone-300"></i> ${dest.location}`;
                    document.getElementById('modalDestDesc').textContent = dest.description;
                    document.getElementById('modalDestBestTime').textContent = dest.best_time;
                    document.getElementById('modalDestDuration').textContent = dest.duration;
                    document.getElementById('modalDestPrice').textContent = `${dest.formatted_price} / org`;

                    const highlights = dest.highlights || [];
                    document.getElementById('modalDestHighlights').innerHTML = highlights.map(h => `
                        <div class="flex items-center gap-2 p-2.5 rounded-xl bg-stone-50 dark:bg-stone-800 text-xs text-stone-700 dark:text-stone-300">
                            <span class="w-1.5 h-1.5 rounded-full bg-stone-900 dark:bg-white shrink-0"></span>
                            <span>${h}</span>
                        </div>
                    `).join('');

                    const fullPageBtn = document.getElementById('modalFullPageBtn');
                    if (fullPageBtn) fullPageBtn.href = '/destinasi/' + dest.slug;

                    document.getElementById('modalBookNowBtn').onclick = () => {
                        closeDetailModal();
                        openBookingModal(dest.name);
                    };

                    const modal = document.getElementById('detailModal');
                    modal.classList.remove('hidden');
                    modal.classList.add('flex');
                })
                .catch(() => {
                    showToast('Gagal memuat catatan destinasi', 'info');
                });
        }

        function closeDetailModal() {
            const modal = document.getElementById('detailModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        function selectPackageCard(target, event) {
            if (event && event.target && event.target.closest('a')) {
                return;
            }

            const card = target.closest('.package-card');
            if (!card) return;

            const parentGrid = card.closest('#packagesGrid') || card.parentElement;
            if (!parentGrid) return;

            const allCards = parentGrid.querySelectorAll('.package-card');

            allCards.forEach(c => {
                const badge = c.querySelector('.package-badge');
                const btn = c.querySelector('.package-btn');

                if (c === card) {
                    c.classList.add('is-active', 'border-stone-900', 'dark:border-stone-100', 'ring-2', 'ring-stone-900/10', 'dark:ring-stone-100/10', '-translate-y-1', 'shadow-xl');
                    c.classList.remove('border-stone-200', 'dark:border-stone-800', 'shadow-xs', 'translate-y-0');

                    if (badge) {
                        badge.classList.add('bg-stone-900', 'text-white', 'dark:bg-white', 'dark:text-stone-900');
                        badge.classList.remove('bg-stone-100', 'dark:bg-stone-800', 'text-stone-700', 'dark:text-stone-300');
                    }

                    if (btn) {
                        btn.classList.add('bg-stone-900', 'text-white', 'dark:bg-stone-100', 'dark:text-stone-900', 'shadow-md');
                        btn.classList.remove('border', 'border-stone-300', 'dark:border-stone-700', 'hover:bg-stone-100', 'dark:hover:bg-stone-800', 'text-stone-800', 'dark:text-stone-200', 'bg-transparent');
                    }
                } else {
                    c.classList.remove('is-active', 'border-stone-900', 'dark:border-stone-100', 'ring-2', 'ring-stone-900/10', 'dark:ring-stone-100/10', '-translate-y-1', 'shadow-xl');
                    c.classList.add('border-stone-200', 'dark:border-stone-800', 'shadow-xs', 'translate-y-0');

                    if (badge) {
                        badge.classList.remove('bg-stone-900', 'text-white', 'dark:bg-white', 'dark:text-stone-900');
                        badge.classList.add('bg-stone-100', 'dark:bg-stone-800', 'text-stone-700', 'dark:text-stone-300');
                    }

                    if (btn) {
                        btn.classList.remove('bg-stone-900', 'text-white', 'dark:bg-stone-100', 'dark:text-stone-900', 'shadow-md');
                        btn.classList.add('border', 'border-stone-300', 'dark:border-stone-700', 'hover:bg-stone-100', 'dark:hover:bg-stone-800', 'text-stone-800', 'dark:text-stone-200', 'bg-transparent');
                    }
                }
            });
        }

        function openBookingModal(preselectedName) {
            const select = document.getElementById('bookItemSelect');
            if (preselectedName) {
                for (let i = 0; i < select.options.length; i++) {
                    if (select.options[i].value === preselectedName) {
                        select.selectedIndex = i;
                        break;
                    }
                }
            }
            const paxInput = document.getElementById('bookPax');
            if (paxInput && (!paxInput.value || paxInput.value === '2')) {
                paxInput.value = '1';
            }
            calculateSimulatedPrice();
            const modal = document.getElementById('bookingModal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeBookingModal() {
            const modal = document.getElementById('bookingModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        function calculateSimulatedPrice() {
            const select = document.getElementById('bookItemSelect');
            const selectedOption = select.options[select.selectedIndex];
            const unitPrice = parseInt(selectedOption?.dataset?.price || 2500000, 10);
            const pax = Math.max(1, parseInt(document.getElementById('bookPax').value || 1, 10));
            const addonDrone = document.getElementById('addonDrone').checked ? 450000 : 0;
            const addonVip = document.getElementById('addonVip').checked ? (650000 * pax) : 0;
            const promoCode = document.getElementById('bookPromo').value.trim().toUpperCase();

            const baseTotal = unitPrice * pax;
            const addonTotal = addonDrone + addonVip;
            const subtotal = baseTotal + addonTotal;

            let discount = 0;
            const discountRow = document.getElementById('summaryDiscountRow');
            if (promoCode === 'PESONAID') {
                discount = Math.round(subtotal * 0.15);
                discountRow.classList.remove('hidden');
                discountRow.classList.add('flex');
            } else {
                discountRow.classList.add('hidden');
                discountRow.classList.remove('flex');
            }

            const finalTotal = Math.max(0, subtotal - discount);

            document.getElementById('summaryPaxCount').textContent = pax;
            document.getElementById('summaryBasePrice').textContent = formatRupiah(baseTotal);
            document.getElementById('summaryAddonPrice').textContent = formatRupiah(addonTotal);
            document.getElementById('summaryDiscountPrice').textContent = '-' + formatRupiah(discount);
            document.getElementById('summaryTotalPrice').textContent = formatRupiah(finalTotal);

            return finalTotal;
        }

        function submitBookingForm(e) {
            e.preventDefault();
            const form = document.getElementById('bookingForm');
            const submitBtn = document.getElementById('btnSubmitBooking');
            submitBtn.disabled = true;
            submitBtn.innerHTML = 'Memproses...';

            const formData = new FormData(form);

            fetch("{{ route('bookings.store') }}", {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": csrfToken,
                    "Accept": "application/json"
                },
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                submitBtn.disabled = false;
                submitBtn.innerHTML = 'Konfirmasi Reservasi';
                
                if (data.success) {
                    closeBookingModal();
                    document.getElementById('receiptCode').textContent = data.booking.code;
                    document.getElementById('receiptName').textContent = data.booking.customer_name;
                    document.getElementById('receiptItem').textContent = data.booking.item_name;
                    document.getElementById('receiptDate').textContent = data.booking.travel_date;
                    document.getElementById('receiptPax').textContent = `${data.booking.pax} Orang`;
                    document.getElementById('receiptTotal').textContent = data.booking.total_price;
                    document.getElementById('receiptPrintLink').href = data.booking.receipt_url;

                    const receiptModal = document.getElementById('receiptModal');
                    receiptModal.classList.remove('hidden');
                    receiptModal.classList.add('flex');
                    showToast('Reservasi berhasil disimpan ke sistem!', 'success');
                } else {
                    showToast(data.message || 'Terjadi kesalahan saat memproses pesanan', 'info');
                }
            })
            .catch(() => {
                submitBtn.disabled = false;
                submitBtn.innerHTML = 'Konfirmasi Reservasi';
                showToast('Gagal memproses data. Silakan coba kembali.', 'info');
            });
        }

        function closeReceiptModal() {
            const modal = document.getElementById('receiptModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        document.addEventListener('DOMContentLoaded', () => {
            applyTranslations();
            updateWishlistBadges();

            const dateInput = document.getElementById('bookDate');
            if (dateInput && !dateInput.value) {
                const nextWeek = new Date();
                nextWeek.setDate(nextWeek.getDate() + 7);
                dateInput.value = nextWeek.toISOString().split('T')[0];
            }

            // Dynamic Island Navbar & Progressive Top Scroll Blur Curtain Effect
            const navContainer = document.getElementById('navContainer');
            const scrollBlurVeil = document.getElementById('scrollBlurVeil');

            function handleNavbarScroll() {
                const scrolled = window.scrollY > 25;
                if (navContainer) {
                    if (scrolled) {
                        navContainer.classList.add('shadow-[0_12px_40px_rgba(0,0,0,0.12)]', 'bg-white/75', 'dark:bg-stone-900/75', 'backdrop-blur-2xl', 'border-stone-300/80', 'dark:border-stone-700/80');
                        navContainer.classList.remove('bg-white/85', 'dark:bg-stone-900/85', 'backdrop-blur-xl', 'border-stone-200/90', 'dark:border-stone-800');
                    } else {
                        navContainer.classList.remove('shadow-[0_12px_40px_rgba(0,0,0,0.12)]', 'bg-white/75', 'dark:bg-stone-900/75', 'backdrop-blur-2xl', 'border-stone-300/80', 'dark:border-stone-700/80');
                        navContainer.classList.add('bg-white/85', 'dark:bg-stone-900/85', 'backdrop-blur-xl', 'border-stone-200/90', 'dark:border-stone-800');
                    }
                }
                if (scrollBlurVeil) {
                    if (scrolled) {
                        scrollBlurVeil.classList.remove('opacity-0');
                        scrollBlurVeil.classList.add('opacity-100');
                    } else {
                        scrollBlurVeil.classList.remove('opacity-100');
                        scrollBlurVeil.classList.add('opacity-0');
                    }
                }
            }

            window.addEventListener('scroll', handleNavbarScroll, { passive: true });
            handleNavbarScroll();
        });
    </script>
    @stack('scripts')
</body>
</html>
