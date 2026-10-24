<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'NusantaraWander — Jelajahi Keajaiban Wisata Indonesia')</title>
    <meta name="description" content="@yield('meta_description', 'Platform perjalanan wisata terpadu menghadirkan kurasi destinasi terbaik di seluruh Indonesia dengan kenyamanan dan pemandu lokal profesional.')">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Google Fonts: Plus Jakarta Sans & Playfair Display -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;0,700;1,600&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                        serif: ['"Playfair Display"', 'serif'],
                    },
                    colors: {
                        brand: {
                            50: '#eefbf6',
                            100: '#d6f5e8',
                            200: '#b0ead4',
                            300: '#7cd8b8',
                            400: '#45bf98',
                            500: '#21a37d',
                            600: '#148364',
                            700: '#116952',
                            800: '#105342',
                            900: '#0e4437',
                        },
                        sand: {
                            50: '#fdfaf6',
                            100: '#f9f1e7',
                            200: '#f1dfca',
                            500: '#d49b54',
                            600: '#be803b',
                        }
                    }
                }
            }
        }
    </script>

    <style>
        ::-webkit-scrollbar {
            width: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #f1f5f9;
        }
        ::-webkit-scrollbar-thumb {
            background: #148364;
            border-radius: 9999px;
        }
        .glass-nav {
            background: rgba(255, 255, 255, 0.90);
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
        }
        .dark .glass-nav {
            background: rgba(15, 23, 42, 0.90);
        }
        .hero-gradient {
            background: linear-gradient(180deg, rgba(15, 23, 42, 0.45) 0%, rgba(15, 23, 42, 0.65) 55%, rgba(15, 23, 42, 0.92) 100%);
        }
        .card-zoom:hover .card-img {
            transform: scale(1.08);
        }
        @keyframes floatSlow {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-6px); }
        }
        .animate-float {
            animation: floatSlow 4s ease-in-out infinite;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: scale(0.96); }
            to { opacity: 1; transform: scale(1); }
        }
        .animate-fadeIn {
            animation: fadeIn 0.25s ease-out forwards;
        }
    </style>
    @stack('styles')
</head>
<body class="bg-slate-50 text-slate-800 dark:bg-slate-950 dark:text-slate-100 font-sans antialiased selection:bg-brand-500 selection:text-white transition-colors duration-300">

    <!-- ================= TOAST NOTIFICATION CONTAINER ================= -->
    <div id="toastContainer" class="fixed bottom-5 right-5 z-[100] flex flex-col gap-3 max-w-sm w-full pointer-events-none px-4 sm:px-0"></div>

    <!-- ================= 1. NAVIGATION BAR ================= -->
    <header id="navbar" class="fixed top-0 left-0 right-0 z-50 transition-all duration-300 glass-nav border-b border-slate-200/70 dark:border-slate-800/80">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                <!-- Brand Logo -->
                <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                    <div class="w-11 h-11 rounded-2xl bg-gradient-to-br from-brand-500 to-teal-700 flex items-center justify-center text-white shadow-lg shadow-brand-500/30 group-hover:scale-105 transition-transform">
                        <i class="fa-solid fa-compass text-xl"></i>
                    </div>
                    <div>
                        <span class="text-xl font-extrabold tracking-tight text-slate-900 dark:text-white">Nusantara<span class="text-brand-600 dark:text-brand-400">Wander</span></span>
                        <p class="text-[11px] font-medium text-slate-500 dark:text-slate-400 -mt-1 tracking-wider uppercase">Pesona Indonesia</p>
                    </div>
                </a>

                <!-- Desktop Navigation Links -->
                <nav class="hidden lg:flex items-center gap-7 text-sm font-semibold text-slate-600 dark:text-slate-300">
                    <a href="{{ route('home') }}#beranda" class="hover:text-brand-600 dark:hover:text-brand-400 transition-colors">Beranda</a>
                    <a href="{{ route('home') }}#destinasi" class="hover:text-brand-600 dark:hover:text-brand-400 transition-colors">Destinasi</a>
                    <a href="{{ route('home') }}#paket" class="hover:text-brand-600 dark:hover:text-brand-400 transition-colors">Paket Wisata</a>
                    <a href="{{ route('home') }}#keunggulan" class="hover:text-brand-600 dark:hover:text-brand-400 transition-colors">Keunggulan</a>
                    <a href="{{ route('home') }}#galeri" class="hover:text-brand-600 dark:hover:text-brand-400 transition-colors">Galeri</a>
                    <a href="{{ route('home') }}#testimoni" class="hover:text-brand-600 dark:hover:text-brand-400 transition-colors">Testimoni</a>
                    <a href="{{ route('admin.bookings') }}" class="text-xs px-2.5 py-1 rounded-lg bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-300 hover:text-brand-600 dark:hover:text-brand-400 border border-slate-200 dark:border-slate-700 flex items-center gap-1.5 transition-colors">
                        <i class="fa-solid fa-clipboard-list text-brand-600"></i>
                        <span>Admin Reservasi</span>
                    </a>
                </nav>

                <!-- Action Buttons (Wishlist, Theme, CTA) -->
                <div class="hidden lg:flex items-center gap-3">
                    <!-- Wishlist Counter Button -->
                    <button onclick="showSavedDestinations()" class="relative p-2.5 rounded-xl text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors" title="Destinasi Tersimpan">
                        <i class="fa-regular fa-heart text-lg"></i>
                        <span id="wishlistBadge" class="absolute -top-1 -right-1 w-5 h-5 rounded-full bg-rose-500 text-white text-[11px] font-bold flex items-center justify-center">0</span>
                    </button>

                    <!-- Dark Mode Toggle -->
                    <button onclick="toggleTheme()" class="p-2.5 rounded-xl text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors" title="Ubah Tema Tampilan">
                        <i id="themeIcon" class="fa-solid fa-moon text-lg"></i>
                    </button>

                    <!-- Pesan Sekarang CTA -->
                    <button onclick="openBookingModal()" class="ml-2 px-5 py-2.5 rounded-xl bg-gradient-to-r from-brand-600 to-teal-600 hover:from-brand-700 hover:to-teal-700 text-white font-semibold text-sm shadow-lg shadow-brand-600/25 hover:shadow-brand-600/40 transition-all flex items-center gap-2 active:scale-95">
                        <i class="fa-solid fa-paper-plane text-xs"></i>
                        <span>Pesan Sekarang</span>
                    </button>
                </div>

                <!-- Mobile Hamburger Button -->
                <div class="flex items-center gap-2 lg:hidden">
                    <button onclick="toggleTheme()" class="p-2.5 rounded-xl text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800">
                        <i id="themeIconMobile" class="fa-solid fa-moon text-lg"></i>
                    </button>
                    <button id="mobileMenuBtn" onclick="toggleMobileMenu()" class="p-2.5 rounded-xl text-slate-700 dark:text-slate-200 hover:bg-slate-100 dark:hover:bg-slate-800 focus:outline-none">
                        <i id="mobileMenuIcon" class="fa-solid fa-bars text-xl"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu Drawer -->
        <div id="mobileMenu" class="hidden lg:hidden bg-white dark:bg-slate-900 border-b border-slate-200 dark:border-slate-800 px-4 pt-3 pb-6 space-y-3 shadow-xl">
            <div class="flex flex-col space-y-2 text-sm font-semibold text-slate-700 dark:text-slate-200">
                <a href="{{ route('home') }}#beranda" onclick="toggleMobileMenu()" class="px-3 py-2.5 rounded-xl hover:bg-brand-50 dark:hover:bg-slate-800 hover:text-brand-600">Beranda</a>
                <a href="{{ route('home') }}#destinasi" onclick="toggleMobileMenu()" class="px-3 py-2.5 rounded-xl hover:bg-brand-50 dark:hover:bg-slate-800 hover:text-brand-600">Destinasi Populer</a>
                <a href="{{ route('home') }}#paket" onclick="toggleMobileMenu()" class="px-3 py-2.5 rounded-xl hover:bg-brand-50 dark:hover:bg-slate-800 hover:text-brand-600">Paket Wisata</a>
                <a href="{{ route('home') }}#keunggulan" onclick="toggleMobileMenu()" class="px-3 py-2.5 rounded-xl hover:bg-brand-50 dark:hover:bg-slate-800 hover:text-brand-600">Keunggulan Layanan</a>
                <a href="{{ route('home') }}#galeri" onclick="toggleMobileMenu()" class="px-3 py-2.5 rounded-xl hover:bg-brand-50 dark:hover:bg-slate-800 hover:text-brand-600">Galeri Nusantara</a>
                <a href="{{ route('home') }}#testimoni" onclick="toggleMobileMenu()" class="px-3 py-2.5 rounded-xl hover:bg-brand-50 dark:hover:bg-slate-800 hover:text-brand-600">Testimoni</a>
                <a href="{{ route('admin.bookings') }}" onclick="toggleMobileMenu()" class="px-3 py-2.5 rounded-xl hover:bg-brand-50 dark:hover:bg-slate-800 hover:text-brand-600 text-brand-600">Admin Reservasi</a>
            </div>
            <div class="pt-3 border-t border-slate-200 dark:border-slate-800 flex flex-col gap-2.5">
                <button onclick="toggleMobileMenu(); showSavedDestinations();" class="w-full py-2.5 px-4 rounded-xl border border-slate-200 dark:border-slate-700 font-semibold text-sm flex items-center justify-center gap-2">
                    <i class="fa-regular fa-heart text-rose-500"></i>
                    <span>Destinasi Favorit (<span id="wishlistBadgeMobile">0</span>)</span>
                </button>
                <button onclick="toggleMobileMenu(); openBookingModal();" class="w-full py-3 px-4 rounded-xl bg-gradient-to-r from-brand-600 to-teal-600 text-white font-semibold text-sm shadow-md flex items-center justify-center gap-2">
                    <i class="fa-solid fa-paper-plane"></i>
                    <span>Pesan Sekarang</span>
                </button>
            </div>
        </div>
    </header>

    <!-- Flash message from session -->
    @if(session('success'))
        <div class="fixed top-24 left-1/2 -translate-x-1/2 z-50 bg-emerald-600 text-white px-6 py-3 rounded-2xl shadow-xl flex items-center gap-3 text-sm font-semibold animate-fadeIn">
            <i class="fa-solid fa-circle-check text-lg"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <main class="min-h-screen">
        @yield('content')
    </main>

    <!-- ================= 8. FOOTER LENGKAP ================= -->
    <footer class="bg-slate-950 text-slate-300 pt-16 pb-10 border-t border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-10 pb-12 border-b border-slate-800">
                <!-- Column 1: Brand Info -->
                <div class="lg:col-span-4">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-brand-500 to-teal-700 flex items-center justify-center text-white">
                            <i class="fa-solid fa-compass text-lg"></i>
                        </div>
                        <span class="text-xl font-extrabold text-white">Nusantara<span class="text-brand-400">Wander</span></span>
                    </div>
                    <p class="text-sm text-slate-400 leading-relaxed mb-6">
                        Platform perjalanan wisata terpadu yang menghadirkan kurasi destinasi terbaik di seluruh Indonesia dengan mengedepankan pariwisata berkelanjutan dan pemberdayaan komunitas lokal.
                    </p>
                    <div class="flex items-center gap-3">
                        <a href="#footer" onclick="showToast('Membuka halaman Instagram NusantaraWander', 'info')" class="w-10 h-10 rounded-xl bg-slate-900 hover:bg-brand-600 text-slate-300 hover:text-white flex items-center justify-center transition-colors">
                            <i class="fa-brands fa-instagram"></i>
                        </a>
                        <a href="#footer" onclick="showToast('Membuka kanal YouTube NusantaraWander', 'info')" class="w-10 h-10 rounded-xl bg-slate-900 hover:bg-brand-600 text-slate-300 hover:text-white flex items-center justify-center transition-colors">
                            <i class="fa-brands fa-youtube"></i>
                        </a>
                        <a href="#footer" onclick="showToast('Membuka TikTok NusantaraWander', 'info')" class="w-10 h-10 rounded-xl bg-slate-900 hover:bg-brand-600 text-slate-300 hover:text-white flex items-center justify-center transition-colors">
                            <i class="fa-brands fa-tiktok"></i>
                        </a>
                        <a href="https://wa.me/6281199887766" target="_blank" class="w-10 h-10 rounded-xl bg-slate-900 hover:bg-brand-600 text-slate-300 hover:text-white flex items-center justify-center transition-colors">
                            <i class="fa-brands fa-whatsapp"></i>
                        </a>
                    </div>
                </div>

                <!-- Column 2: Tautan Cepat -->
                <div class="lg:col-span-2">
                    <h4 class="text-white font-bold text-sm uppercase tracking-wider mb-4">Tautan Cepat</h4>
                    <ul class="space-y-2.5 text-sm text-slate-400">
                        <li><a href="{{ route('home') }}#beranda" class="hover:text-brand-400 transition-colors">Beranda</a></li>
                        <li><a href="{{ route('home') }}#destinasi" class="hover:text-brand-400 transition-colors">Destinasi Populer</a></li>
                        <li><a href="{{ route('home') }}#paket" class="hover:text-brand-400 transition-colors">Paket Wisata</a></li>
                        <li><a href="{{ route('home') }}#keunggulan" class="hover:text-brand-400 transition-colors">Tentang Kami</a></li>
                        <li><a href="{{ route('home') }}#galeri" class="hover:text-brand-400 transition-colors">Galeri Foto</a></li>
                        <li><a href="{{ route('home') }}#testimoni" class="hover:text-brand-400 transition-colors">Ulasan Wisatawan</a></li>
                    </ul>
                </div>

                <!-- Column 3: Kontak Kami -->
                <div class="lg:col-span-3">
                    <h4 class="text-white font-bold text-sm uppercase tracking-wider mb-4">Hubungi Kami</h4>
                    <ul class="space-y-3 text-sm text-slate-400">
                        <li class="flex items-start gap-3">
                            <i class="fa-solid fa-location-dot text-brand-400 mt-1"></i>
                            <span>Gedung Pesona Nusantara Lt. 12, Jl. Jenderal Sudirman Kav. 52, Jakarta Selatan 12190</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <i class="fa-solid fa-phone text-brand-400"></i>
                            <span>+62 (21) 5098-7788 / 0811-9988-7766</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <i class="fa-solid fa-envelope text-brand-400"></i>
                            <span>halo@nusantarawander.id</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <i class="fa-solid fa-clock text-brand-400"></i>
                            <span>Senin - Minggu (08.00 - 22.00 WIB)</span>
                        </li>
                    </ul>
                </div>

                <!-- Column 4: Newsletter -->
                <div class="lg:col-span-3">
                    <h4 class="text-white font-bold text-sm uppercase tracking-wider mb-4">Berlangganan Newsletter</h4>
                    <p class="text-sm text-slate-400 mb-4">
                        Dapatkan inspirasi destinasi rahasia dan info promo tiket pesawat & paket tur setiap minggu.
                    </p>
                    <form onsubmit="handleNewsletter(event)" class="space-y-2.5">
                        <input 
                            type="email" 
                            id="newsletterEmail"
                            required 
                            placeholder="Masukkan alamat email Anda..." 
                            class="w-full px-4 py-3 rounded-xl bg-slate-900 border border-slate-800 text-sm text-white placeholder-slate-500 focus:ring-2 focus:ring-brand-500 focus:outline-none"
                        >
                        <button type="submit" class="w-full py-3 px-4 rounded-xl bg-brand-600 hover:bg-brand-500 text-white font-bold text-sm transition-colors flex items-center justify-center gap-2">
                            <span>Berlangganan Sekarang</span>
                            <i class="fa-solid fa-paper-plane text-xs"></i>
                        </button>
                    </form>
                </div>
            </div>

            <!-- Bottom Copyright -->
            <div class="pt-8 flex flex-col sm:flex-row items-center justify-between text-xs text-slate-500 gap-4">
                <p>&copy; {{ date('Y') }} PT Nusantara Wander Indonesia. Powered by Laravel 12.</p>
                <div class="flex gap-6">
                    <button onclick="showToast('Membuka Syarat & Ketentuan Perjalanan', 'info')" class="hover:text-slate-300">Syarat & Ketentuan</button>
                    <button onclick="showToast('Membuka Kebijakan Privasi', 'info')" class="hover:text-slate-300">Kebijakan Privasi</button>
                    <button onclick="showToast('Membuka Panduan Keamanan Wisata', 'info')" class="hover:text-slate-300">Panduan Wisata Aman</button>
                </div>
            </div>
        </div>
    </footer>

    <!-- ================= MODAL 1: DETAIL DESTINASI ================= -->
    <div id="detailModal" class="fixed inset-0 z-50 hidden items-center justify-center p-4 bg-slate-950/75 backdrop-blur-sm overflow-y-auto">
        <div class="bg-white dark:bg-slate-900 rounded-3xl max-w-3xl w-full overflow-hidden shadow-2xl border border-slate-200 dark:border-slate-800 my-8 animate-fadeIn">
            <!-- Modal Image Header -->
            <div class="relative h-64 sm:h-80">
                <img id="modalDestImage" src="" alt="Detail Destinasi" class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-slate-950/90 via-slate-950/30 to-transparent"></div>
                
                <!-- Close Button -->
                <button onclick="closeDetailModal()" class="absolute top-4 right-4 w-10 h-10 rounded-full bg-slate-900/60 hover:bg-slate-900 text-white flex items-center justify-center transition-colors">
                    <i class="fa-solid fa-xmark text-lg"></i>
                </button>

                <div class="absolute bottom-5 left-6 right-6 text-white">
                    <div class="flex flex-wrap items-center gap-2 mb-2">
                        <span id="modalDestCategory" class="px-3 py-1 rounded-full bg-brand-600 text-xs font-bold uppercase tracking-wider"></span>
                        <span class="px-3 py-1 rounded-full bg-white/20 backdrop-blur-md text-xs font-semibold flex items-center gap-1">
                            <i class="fa-solid fa-star text-amber-400"></i>
                            <span id="modalDestRating"></span>
                        </span>
                    </div>
                    <h3 id="modalDestTitle" class="font-serif text-2xl sm:text-3xl font-bold"></h3>
                    <p id="modalDestLocation" class="text-sm text-slate-200 flex items-center gap-1.5 mt-1"></p>
                </div>
            </div>

            <!-- Modal Body -->
            <div class="p-6 sm:p-8 max-h-[65vh] overflow-y-auto space-y-6">
                <div>
                    <h4 class="text-xs font-bold uppercase tracking-wider text-slate-400 mb-2">Tentang Destinasi</h4>
                    <p id="modalDestDesc" class="text-slate-600 dark:text-slate-300 text-sm sm:text-base leading-relaxed"></p>
                </div>

                <!-- Highlights & Info Grid -->
                <div class="grid grid-cols-2 sm:grid-cols-3 gap-4 p-4 rounded-2xl bg-slate-50 dark:bg-slate-800/60 border border-slate-200/60 dark:border-slate-800">
                    <div>
                        <p class="text-xs text-slate-400">Waktu Terbaik</p>
                        <p id="modalDestBestTime" class="text-sm font-bold text-slate-800 dark:text-white mt-0.5"></p>
                    </div>
                    <div>
                        <p class="text-xs text-slate-400">Durasi Ideal</p>
                        <p id="modalDestDuration" class="text-sm font-bold text-slate-800 dark:text-white mt-0.5"></p>
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <p class="text-xs text-slate-400">Harga Mulai Dari</p>
                        <p id="modalDestPrice" class="text-base font-extrabold text-brand-600 dark:text-brand-400 mt-0.5"></p>
                    </div>
                </div>

                <!-- Aktivitas Unggulan -->
                <div>
                    <h4 class="text-xs font-bold uppercase tracking-wider text-slate-400 mb-3">Aktivitas & Daya Tarik Utama</h4>
                    <div id="modalDestHighlights" class="grid grid-cols-1 sm:grid-cols-2 gap-2.5"></div>
                </div>

                <!-- Action Footer -->
                <div class="pt-4 border-t border-slate-200 dark:border-slate-800 flex flex-col sm:flex-row items-center justify-between gap-4">
                    <div class="text-center sm:text-left">
                        <p class="text-xs text-slate-400">Termasuk pemandu lokal, tiket konservasi & transport lokal</p>
                    </div>
                    <div class="flex items-center gap-3 w-full sm:w-auto">
                        <button onclick="closeDetailModal()" class="w-1/2 sm:w-auto px-5 py-3 rounded-xl border border-slate-200 dark:border-slate-700 text-sm font-semibold hover:bg-slate-100 dark:hover:bg-slate-800">
                            Tutup
                        </button>
                        <button id="modalBookNowBtn" class="w-1/2 sm:w-auto px-6 py-3 rounded-xl bg-gradient-to-r from-brand-600 to-teal-600 hover:from-brand-700 hover:to-teal-700 text-white text-sm font-bold shadow-lg shadow-brand-600/25 flex items-center justify-center gap-2">
                            <i class="fa-solid fa-calendar-check"></i>
                            <span>Pesan Destinasi Ini</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ================= MODAL 2: SIMULASI PEMESANAN TIKET / PAKET WISATA ================= -->
    <div id="bookingModal" class="fixed inset-0 z-50 hidden items-center justify-center p-4 bg-slate-950/75 backdrop-blur-sm overflow-y-auto">
        <div class="bg-white dark:bg-slate-900 rounded-3xl max-w-2xl w-full overflow-hidden shadow-2xl border border-slate-200 dark:border-slate-800 my-8">
            <!-- Header -->
            <div class="px-6 py-5 bg-gradient-to-r from-brand-700 to-teal-700 text-white flex items-center justify-between">
                <div>
                    <span class="text-[11px] uppercase tracking-widest text-emerald-200 font-bold">Reservasi Online Instan • Laravel Backend</span>
                    <h3 class="font-serif text-xl sm:text-2xl font-bold">Formulir Simulasi Pemesanan Wisata</h3>
                </div>
                <button onclick="closeBookingModal()" class="w-9 h-9 rounded-full bg-white/15 hover:bg-white/25 flex items-center justify-center text-white">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>

            <!-- Form Body -->
            <form id="bookingForm" onsubmit="submitBookingForm(event)" class="p-6 sm:p-8 max-h-[78vh] overflow-y-auto space-y-5">
                @csrf
                <!-- Pilih Destinasi / Paket -->
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400 mb-2">
                        Pilih Destinasi / Paket Wisata
                    </label>
                    <select id="bookItemSelect" name="item_name" onchange="calculateSimulatedPrice()" class="w-full px-4 py-3 rounded-xl bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-sm font-semibold focus:ring-2 focus:ring-brand-500 focus:outline-none">
                        <!-- Populated dynamically via JS or server -->
                    </select>
                </div>

                <!-- Data Pemesan -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400 mb-1.5">Nama Lengkap</label>
                        <input type="text" id="bookName" name="customer_name" required placeholder="Contoh: Budi Santoso" class="w-full px-4 py-2.5 rounded-xl bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-sm focus:ring-2 focus:ring-brand-500 focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400 mb-1.5">Nomor WhatsApp</label>
                        <input type="tel" id="bookPhone" name="customer_phone" required placeholder="0812xxxx" class="w-full px-4 py-2.5 rounded-xl bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-sm focus:ring-2 focus:ring-brand-500 focus:outline-none">
                    </div>
                </div>

                <!-- Tanggal & Jumlah Peserta -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400 mb-1.5">Tanggal Keberangkatan</label>
                        <input type="date" id="bookDate" name="travel_date" required class="w-full px-4 py-2.5 rounded-xl bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-sm focus:ring-2 focus:ring-brand-500 focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400 mb-1.5">Jumlah Peserta (Orang)</label>
                        <input type="number" id="bookPax" name="pax" min="1" max="50" value="2" oninput="calculateSimulatedPrice()" required class="w-full px-4 py-2.5 rounded-xl bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-sm font-bold focus:ring-2 focus:ring-brand-500 focus:outline-none">
                    </div>
                </div>

                <!-- Layanan Tambahan (Add-ons) -->
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400 mb-2">Layanan Tambahan Opsional</label>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 text-sm">
                        <label class="flex items-center gap-3 p-3 rounded-xl border border-slate-200 dark:border-slate-700 cursor-pointer hover:bg-slate-50 dark:hover:bg-slate-800/50">
                            <input type="checkbox" id="addonDrone" name="addon_drone" value="1" onchange="calculateSimulatedPrice()" class="w-4 h-4 accent-brand-600 rounded">
                            <div>
                                <p class="font-semibold text-slate-800 dark:text-slate-200">Paket Dokumentasi Drone</p>
                                <p class="text-xs text-slate-500">+Rp 450.000 / grup</p>
                            </div>
                        </label>
                        <label class="flex items-center gap-3 p-3 rounded-xl border border-slate-200 dark:border-slate-700 cursor-pointer hover:bg-slate-50 dark:hover:bg-slate-800/50">
                            <input type="checkbox" id="addonVip" name="addon_vip" value="1" onchange="calculateSimulatedPrice()" class="w-4 h-4 accent-brand-600 rounded">
                            <div>
                                <p class="font-semibold text-slate-800 dark:text-slate-200">Upgrade Hotel Bintang 5</p>
                                <p class="text-xs text-slate-500">+Rp 650.000 / orang</p>
                            </div>
                        </label>
                    </div>
                </div>

                <!-- Kode Promo -->
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400 mb-1.5">Kode Promo (Ketik: <span class="text-brand-600 font-bold">PESONAID</span> untuk diskon 15%)</label>
                    <div class="flex gap-2">
                        <input type="text" id="bookPromo" name="promo_code" oninput="calculateSimulatedPrice()" placeholder="Masukkan kode voucher..." class="w-full px-4 py-2.5 rounded-xl bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-sm uppercase focus:ring-2 focus:ring-brand-500 focus:outline-none">
                    </div>
                </div>

                <!-- Catatan Khusus -->
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400 mb-1.5">Catatan Perjalanan (Opsional)</label>
                    <textarea id="bookNotes" name="notes" rows="2" placeholder="Contoh: Permintaan makanan vegetarian, penjemputan khusus hotel, dsb..." class="w-full px-4 py-2 rounded-xl bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-sm focus:ring-2 focus:ring-brand-500 focus:outline-none"></textarea>
                </div>

                <!-- Ringkasan Estimasi Biaya -->
                <div class="p-4 rounded-2xl bg-brand-50/80 dark:bg-slate-800 border border-brand-200 dark:border-slate-700 space-y-2">
                    <div class="flex justify-between text-xs text-slate-600 dark:text-slate-400">
                        <span>Harga Dasar (<span id="summaryPaxCount">2</span> Peserta)</span>
                        <span id="summaryBasePrice" class="font-semibold">Rp 0</span>
                    </div>
                    <div class="flex justify-between text-xs text-slate-600 dark:text-slate-400">
                        <span>Layanan Tambahan</span>
                        <span id="summaryAddonPrice" class="font-semibold">Rp 0</span>
                    </div>
                    <div id="summaryDiscountRow" class="hidden justify-between text-xs text-emerald-600 dark:text-emerald-400 font-semibold">
                        <span>Potongan Kode Promo (15%)</span>
                        <span id="summaryDiscountPrice">-Rp 0</span>
                    </div>
                    <div class="pt-2 border-t border-brand-200 dark:border-slate-700 flex justify-between items-center">
                        <span class="text-sm font-bold text-slate-800 dark:text-white">Total Estimasi Pembayaran</span>
                        <span id="summaryTotalPrice" class="text-xl font-extrabold text-brand-700 dark:text-brand-400">Rp 0</span>
                    </div>
                </div>

                <div class="flex items-center justify-end gap-3 pt-2">
                    <button type="button" onclick="closeBookingModal()" class="px-5 py-3 rounded-xl border border-slate-200 dark:border-slate-700 text-sm font-semibold hover:bg-slate-100 dark:hover:bg-slate-800">
                        Batal
                    </button>
                    <button type="submit" id="btnSubmitBooking" class="px-7 py-3 rounded-xl bg-gradient-to-r from-brand-600 to-teal-600 hover:from-brand-700 hover:to-teal-700 text-white font-bold text-sm shadow-lg shadow-brand-600/30 flex items-center gap-2">
                        <i class="fa-solid fa-check-circle"></i>
                        <span>Konfirmasi Pesanan</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- ================= MODAL 3: BUKTI KONFIRMASI PEMESANAN ================= -->
    <div id="receiptModal" class="fixed inset-0 z-50 hidden items-center justify-center p-4 bg-slate-950/75 backdrop-blur-sm">
        <div class="bg-white dark:bg-slate-900 rounded-3xl max-w-md w-full p-6 sm:p-8 shadow-2xl border border-slate-200 dark:border-slate-800 text-center animate-fadeIn">
            <div class="w-16 h-16 rounded-full bg-emerald-100 dark:bg-emerald-900/40 text-emerald-600 dark:text-emerald-400 flex items-center justify-center text-3xl mx-auto mb-4">
                <i class="fa-solid fa-circle-check"></i>
            </div>
            <span class="px-3 py-1 rounded-full bg-emerald-50 dark:bg-emerald-950 text-emerald-700 dark:text-emerald-300 text-xs font-bold">Kode Booking: <span id="receiptCode">NW-88291</span></span>
            <h3 class="font-serif text-2xl font-bold text-slate-900 dark:text-white mt-3">Simulasi Pemesanan Berhasil!</h3>
            <p class="text-xs sm:text-sm text-slate-500 dark:text-slate-400 mt-1">
                Terima kasih <strong id="receiptName" class="text-slate-800 dark:text-slate-200"></strong>, reservasi Anda telah tersimpan di database Laravel.
            </p>

            <div class="mt-5 p-4 rounded-2xl bg-slate-50 dark:bg-slate-800/70 text-left text-xs space-y-2 border border-slate-200/70 dark:border-slate-700">
                <div class="flex justify-between">
                    <span class="text-slate-400">Paket / Destinasi:</span>
                    <span id="receiptItem" class="font-bold text-slate-800 dark:text-white text-right"></span>
                </div>
                <div class="flex justify-between">
                    <span class="text-slate-400">Tanggal Berangkat:</span>
                    <span id="receiptDate" class="font-semibold text-slate-700 dark:text-slate-200"></span>
                </div>
                <div class="flex justify-between">
                    <span class="text-slate-400">Jumlah Peserta:</span>
                    <span id="receiptPax" class="font-semibold text-slate-700 dark:text-slate-200"></span>
                </div>
                <div class="pt-2 border-t border-slate-200 dark:border-slate-700 flex justify-between text-sm">
                    <span class="font-bold text-slate-700 dark:text-slate-200">Total Biaya:</span>
                    <span id="receiptTotal" class="font-extrabold text-brand-600 dark:text-brand-400"></span>
                </div>
            </div>

            <div class="mt-6 flex flex-col gap-2.5">
                <a id="receiptPrintLink" href="#" class="w-full py-3 rounded-xl bg-brand-600 hover:bg-brand-700 text-white font-bold text-sm transition-colors flex items-center justify-center gap-2">
                    <i class="fa-solid fa-receipt"></i>
                    <span>Buka Lembar E-Tiket Digital</span>
                </a>
                <button onclick="closeReceiptModal()" class="w-full py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 text-slate-600 dark:text-slate-300 font-semibold text-xs hover:bg-slate-100 dark:hover:bg-slate-800">
                    Tutup & Lanjutkan Menjelajah
                </button>
            </div>
        </div>
    </div>

    <!-- ================= MODAL 4: LIGHTBOX GALERI ================= -->
    <div id="lightboxModal" onclick="closeLightbox()" class="fixed inset-0 z-50 hidden items-center justify-center p-4 bg-slate-950/90 backdrop-blur-md">
        <div class="max-w-4xl w-full relative" onclick="event.stopPropagation()">
            <button onclick="closeLightbox()" class="absolute -top-12 right-0 text-white/80 hover:text-white text-2xl">
                <i class="fa-solid fa-xmark"></i>
            </button>
            <img id="lightboxImg" src="" alt="Galeri Nusantara" class="w-full max-h-[78vh] object-cover rounded-2xl shadow-2xl border border-white/15">
            <div class="mt-4 flex items-center justify-between text-white">
                <div>
                    <h4 id="lightboxCaption" class="font-serif text-xl font-bold"></h4>
                    <p id="lightboxSub" class="text-xs text-slate-300"></p>
                </div>
                <button onclick="closeLightbox(); openBookingModal();" class="px-4 py-2 rounded-xl bg-brand-600 hover:bg-brand-500 text-xs font-bold">
                    Kunjungi Lokasi Ini
                </button>
            </div>
        </div>
    </div>

    <!-- Global Application Scripts -->
    <script>
        // Setup CSRF Token for AJAX
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        // Helper Format Rupiah
        function formatRupiah(num) {
            return 'Rp ' + Number(num).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }

        // Custom Toast Notification
        function showToast(message, type = 'success') {
            const container = document.getElementById('toastContainer');
            const toast = document.createElement('div');
            const icon = type === 'success' 
                ? '<i class="fa-solid fa-circle-check text-emerald-400 text-lg"></i>' 
                : '<i class="fa-solid fa-circle-info text-sky-400 text-lg"></i>';

            toast.className = 'pointer-events-auto flex items-center gap-3 px-4 py-3.5 rounded-2xl bg-slate-900/95 dark:bg-slate-800 text-white text-xs sm:text-sm font-medium shadow-xl border border-slate-700/80 transition-all duration-300 animate-fadeIn';
            toast.innerHTML = `${icon}<span>${message}</span>`;

            container.appendChild(toast);
            setTimeout(() => {
                toast.style.opacity = '0';
                toast.style.transform = 'translateY(10px)';
                setTimeout(() => toast.remove(), 300);
            }, 3400);
        }

        // Dark / Light Mode Toggle
        function toggleTheme() {
            const htmlEl = document.documentElement;
            htmlEl.classList.toggle('dark');
            const isDark = htmlEl.classList.contains('dark');
            localStorage.setItem('theme', isDark ? 'dark' : 'light');
            const iconClass = isDark ? 'fa-solid fa-sun text-amber-400 text-lg' : 'fa-solid fa-moon text-lg';
            if (document.getElementById('themeIcon')) document.getElementById('themeIcon').className = iconClass;
            if (document.getElementById('themeIconMobile')) document.getElementById('themeIconMobile').className = iconClass;
        }

        // Initialize Theme from localStorage
        (function() {
            const savedTheme = localStorage.getItem('theme');
            if (savedTheme === 'dark' || (!savedTheme && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark');
            }
        })();

        // Mobile Menu Toggle
        function toggleMobileMenu() {
            const menu = document.getElementById('mobileMenu');
            const icon = document.getElementById('mobileMenuIcon');
            menu.classList.toggle('hidden');
            if (menu.classList.contains('hidden')) {
                icon.className = 'fa-solid fa-bars text-xl';
            } else {
                icon.className = 'fa-solid fa-xmark text-xl';
            }
        }

        // Wishlist
        let savedWishlist = new Set(JSON.parse(localStorage.getItem('nw_wishlist') || '[1, 3]'));

        function updateWishlistBadges() {
            if (document.getElementById('wishlistBadge')) document.getElementById('wishlistBadge').textContent = savedWishlist.size;
            if (document.getElementById('wishlistBadgeMobile')) document.getElementById('wishlistBadgeMobile').textContent = savedWishlist.size;
            localStorage.setItem('nw_wishlist', JSON.stringify(Array.from(savedWishlist)));
        }

        function toggleWishlist(id, name = 'Destinasi') {
            if (savedWishlist.has(id)) {
                savedWishlist.delete(id);
                showToast(`${name} dihapus dari daftar favorit`, 'info');
            } else {
                savedWishlist.add(id);
                showToast(`${name} disimpan ke daftar favorit!`, 'success');
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
            showToast(`Anda memiliki ${savedWishlist.size} destinasi favorit tersimpan!`, 'success');
            const destSection = document.getElementById('destinasi');
            if (destSection) destSection.scrollIntoView({ behavior: 'smooth' });
        }

        // Lightbox Galeri
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

        // Voucher Copy
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
            showToast('Kode voucher PESONAID berhasil disalin (Diskon 15%)!', 'success');
        }

        // Newsletter form
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
                showToast(`Terima kasih! Inspirasi wisata akan dikirim ke ${email}`, 'success');
                input.value = '';
            });
        }

        // Modal Detail Destinasi via AJAX
        function openDetailModal(id) {
            fetch(`/api/destinations/${id}`)
                .then(res => res.json())
                .then(dest => {
                    document.getElementById('modalDestImage').src = dest.image;
                    document.getElementById('modalDestCategory').textContent = dest.category;
                    document.getElementById('modalDestRating').textContent = `${dest.rating} (${dest.reviews_count} ulasan)`;
                    document.getElementById('modalDestTitle').textContent = dest.name;
                    document.getElementById('modalDestLocation').innerHTML = `<i class="fa-solid fa-location-dot text-emerald-400"></i> ${dest.location}`;
                    document.getElementById('modalDestDesc').textContent = dest.description;
                    document.getElementById('modalDestBestTime').textContent = dest.best_time;
                    document.getElementById('modalDestDuration').textContent = dest.duration;
                    document.getElementById('modalDestPrice').textContent = `${dest.formatted_price} / org`;

                    const highlights = dest.highlights || [];
                    document.getElementById('modalDestHighlights').innerHTML = highlights.map(h => `
                        <div class="flex items-center gap-2.5 p-3 rounded-xl bg-slate-50 dark:bg-slate-800/90 text-xs sm:text-sm font-medium text-slate-700 dark:text-slate-200">
                            <i class="fa-solid fa-compass text-brand-600 dark:text-brand-400"></i>
                            <span>${h}</span>
                        </div>
                    `).join('');

                    document.getElementById('modalBookNowBtn').onclick = () => {
                        closeDetailModal();
                        openBookingModal(dest.name);
                    };

                    const modal = document.getElementById('detailModal');
                    modal.classList.remove('hidden');
                    modal.classList.add('flex');
                })
                .catch(err => {
                    showToast('Gagal memuat detail destinasi', 'info');
                });
        }

        function closeDetailModal() {
            const modal = document.getElementById('detailModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        // Booking Modal Logic
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
            submitBtn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Menyimpan...';

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
                submitBtn.innerHTML = '<i class="fa-solid fa-check-circle"></i> Konfirmasi Pesanan';
                
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
                    showToast('Reservasi berhasil disimpan ke database!', 'success');
                } else {
                    showToast(data.message || 'Terjadi kesalahan saat memproses pesanan', 'info');
                }
            })
            .catch(err => {
                submitBtn.disabled = false;
                submitBtn.innerHTML = '<i class="fa-solid fa-check-circle"></i> Konfirmasi Pesanan';
                showToast('Gagal memproses data. Silakan coba kembali.', 'info');
            });
        }

        function closeReceiptModal() {
            const modal = document.getElementById('receiptModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        document.addEventListener('DOMContentLoaded', () => {
            updateWishlistBadges();

            // Set default dates
            const dateInput = document.getElementById('bookDate');
            if (dateInput && !dateInput.value) {
                const nextWeek = new Date();
                nextWeek.setDate(nextWeek.getDate() + 7);
                dateInput.value = nextWeek.toISOString().split('T')[0];
            }
        });
    </script>
    @stack('scripts')
</body>
</html>
