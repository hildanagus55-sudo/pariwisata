<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'NusantaraWander — Kurasi Perjalanan & Wisata Alam Indonesia')</title>
    <meta name="description" content="@yield('meta_description', 'Boutique travel organizer untuk menjelajah pulau, budaya, dan alam tersembunyi di Indonesia bersama pemandu warga lokal.')">
    <meta name="csrf-token" content="{{ csrf_token() }}">

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
    </style>
    @stack('styles')
</head>
<body class="bg-white text-stone-900 dark:bg-stone-950 dark:text-stone-100 font-sans antialiased selection:bg-stone-900 selection:text-white transition-colors duration-200">

    <!-- Toast Notification Container -->
    <div id="toastContainer" class="fixed bottom-6 right-6 z-[100] flex flex-col gap-2.5 max-w-sm w-full pointer-events-none px-4 sm:px-0"></div>

    <!-- ================= 1. FLOATING GLASS ISLAND NAVIGATION BAR ================= -->
    <header id="navbar" class="fixed top-3 sm:top-5 left-0 right-0 z-50 px-3 sm:px-6 transition-all duration-300">
        <div id="navContainer" class="max-w-6xl mx-auto rounded-full px-4 sm:px-6 py-2.5 sm:py-3 transition-all duration-300 shadow-[0_8px_32px_rgba(0,0,0,0.08)] backdrop-blur-xl border border-stone-200/90 dark:border-stone-800 bg-white/90 dark:bg-stone-900/90 flex items-center justify-between">
            <!-- Brand Logo -->
            <a href="{{ route('home') }}" class="flex items-center gap-2.5 group">
                <div class="w-9 h-9 rounded-full bg-stone-900 dark:bg-stone-100 text-amber-300 dark:text-stone-900 flex items-center justify-center text-sm shadow-xs group-hover:rotate-45 transition-transform duration-500 shrink-0">
                    <i class="fa-solid fa-compass"></i>
                </div>
                <div class="flex items-baseline gap-1">
                    <span class="text-base font-serif font-bold tracking-tight text-stone-950 dark:text-white">Nusantara<span class="italic font-normal text-stone-500 dark:text-stone-400">Wander</span></span>
                    <span class="hidden sm:inline-block text-[9px] font-mono px-1.5 py-0.5 rounded bg-stone-100 dark:bg-stone-800 text-stone-500 font-semibold tracking-wider">ID</span>
                </div>
            </a>

            <!-- Desktop Navigation Links -->
            <nav class="hidden lg:flex items-center gap-1 text-xs font-semibold text-stone-600 dark:text-stone-300">
                <a href="{{ route('home') }}#beranda" class="px-3.5 py-1.5 rounded-full hover:bg-stone-100/90 dark:hover:bg-stone-800 hover:text-stone-950 dark:hover:text-white transition-all">Beranda</a>
                <a href="{{ route('home') }}#destinasi" class="px-3.5 py-1.5 rounded-full hover:bg-stone-100/90 dark:hover:bg-stone-800 hover:text-stone-950 dark:hover:text-white transition-all">Destinasi</a>
                <a href="{{ route('home') }}#paket" class="px-3.5 py-1.5 rounded-full hover:bg-stone-100/90 dark:hover:bg-stone-800 hover:text-stone-950 dark:hover:text-white transition-all">Paket Wisata</a>
                <a href="{{ route('home') }}#cerita" class="px-3.5 py-1.5 rounded-full hover:bg-stone-100/90 dark:hover:bg-stone-800 hover:text-stone-950 dark:hover:text-white transition-all">Filosofi</a>
                <a href="{{ route('home') }}#galeri" class="px-3.5 py-1.5 rounded-full hover:bg-stone-100/90 dark:hover:bg-stone-800 hover:text-stone-950 dark:hover:text-white transition-all">Galeri</a>
                <a href="{{ route('home') }}#testimoni" class="px-3.5 py-1.5 rounded-full hover:bg-stone-100/90 dark:hover:bg-stone-800 hover:text-stone-950 dark:hover:text-white transition-all">Testimoni</a>
                <a href="{{ route('admin.bookings') }}" class="px-2.5 py-1 rounded-full text-[11px] text-stone-400 hover:text-stone-800 dark:hover:text-stone-200 transition-colors flex items-center gap-1">
                    <i class="fa-regular fa-folder-open text-[10px]"></i>
                    <span>Admin</span>
                </a>
            </nav>

            <!-- Actions: Wishlist, Theme Toggle, WhatsApp, CTA -->
            <div class="hidden lg:flex items-center gap-2">
                <!-- Wishlist Button -->
                <button onclick="showSavedDestinations()" class="relative w-8 h-8 rounded-full border border-stone-200/80 dark:border-stone-700/80 flex items-center justify-center text-stone-600 dark:text-stone-300 hover:bg-stone-100 dark:hover:bg-stone-800 hover:text-rose-500 transition-colors" title="Destinasi Tersimpan">
                    <i class="fa-regular fa-heart text-xs"></i>
                    <span id="wishlistBadge" class="absolute -top-1 -right-1 w-4 h-4 rounded-full bg-stone-900 text-white text-[9px] font-bold flex items-center justify-center shadow-xs">0</span>
                </button>

                <!-- Theme Toggle Button -->
                <button onclick="toggleTheme()" class="w-8 h-8 rounded-full border border-stone-200/80 dark:border-stone-700/80 flex items-center justify-center text-stone-600 dark:text-stone-300 hover:bg-stone-100 dark:hover:bg-stone-800 transition-colors" title="Ubah Tema Tampilan">
                    <i id="themeIcon" class="fa-solid fa-moon text-xs"></i>
                </button>

                <!-- WhatsApp Concierge Quick Link -->
                <a href="https://wa.me/6281199887766" target="_blank" class="w-8 h-8 rounded-full border border-stone-200/80 dark:border-stone-700/80 flex items-center justify-center text-emerald-600 hover:bg-emerald-50 dark:hover:bg-stone-800 transition-colors" title="Hubungi WhatsApp Concierge">
                    <i class="fa-brands fa-whatsapp text-sm"></i>
                </a>

                <!-- CTA Button -->
                <button onclick="openBookingModal()" class="ml-1 px-4 sm:px-5 py-2.5 rounded-full bg-stone-900 hover:bg-stone-800 text-white dark:bg-stone-100 dark:text-stone-900 dark:hover:bg-white text-xs font-semibold tracking-wide transition-all shadow-sm active:scale-95 flex items-center gap-1.5 group">
                    <span>Rencanakan Trip</span>
                    <i class="fa-solid fa-arrow-right text-[10px] group-hover:translate-x-0.5 transition-transform"></i>
                </button>
            </div>

            <!-- Mobile Controls -->
            <div class="flex items-center gap-1.5 lg:hidden">
                <button onclick="toggleTheme()" class="w-8 h-8 rounded-full border border-stone-200 dark:border-stone-700 flex items-center justify-center text-stone-600 dark:text-stone-300">
                    <i id="themeIconMobile" class="fa-solid fa-moon text-xs"></i>
                </button>
                <button id="mobileMenuBtn" onclick="toggleMobileMenu()" class="w-8 h-8 rounded-full bg-stone-900 text-white dark:bg-stone-100 dark:text-stone-900 flex items-center justify-center focus:outline-none">
                    <i id="mobileMenuIcon" class="fa-solid fa-bars text-xs"></i>
                </button>
            </div>
        </div>

        <!-- Mobile Floating Drawer -->
        <div id="mobileMenu" class="hidden lg:hidden max-w-6xl mx-auto mt-2 rounded-3xl bg-white/95 dark:bg-stone-900/95 backdrop-blur-xl border border-stone-200/90 dark:border-stone-800 p-5 space-y-3 shadow-xl animate-fadeIn">
            <div class="flex flex-col space-y-2 text-xs font-semibold text-stone-700 dark:text-stone-200">
                <a href="{{ route('home') }}#beranda" onclick="toggleMobileMenu()" class="px-3 py-2 rounded-xl hover:bg-stone-100 dark:hover:bg-stone-800">Beranda</a>
                <a href="{{ route('home') }}#destinasi" onclick="toggleMobileMenu()" class="px-3 py-2 rounded-xl hover:bg-stone-100 dark:hover:bg-stone-800">Destinasi</a>
                <a href="{{ route('home') }}#paket" onclick="toggleMobileMenu()" class="px-3 py-2 rounded-xl hover:bg-stone-100 dark:hover:bg-stone-800">Paket Wisata</a>
                <a href="{{ route('home') }}#cerita" onclick="toggleMobileMenu()" class="px-3 py-2 rounded-xl hover:bg-stone-100 dark:hover:bg-stone-800">Filosofi</a>
                <a href="{{ route('home') }}#galeri" onclick="toggleMobileMenu()" class="px-3 py-2 rounded-xl hover:bg-stone-100 dark:hover:bg-stone-800">Galeri</a>
                <a href="{{ route('home') }}#testimoni" onclick="toggleMobileMenu()" class="px-3 py-2 rounded-xl hover:bg-stone-100 dark:hover:bg-stone-800">Testimoni</a>
                <a href="{{ route('admin.bookings') }}" onclick="toggleMobileMenu()" class="px-3 py-2 rounded-xl hover:bg-stone-100 dark:hover:bg-stone-800 text-stone-900 dark:text-white">Admin Reservasi</a>
            </div>
            <div class="pt-3 border-t border-stone-200 dark:border-stone-800 flex flex-col gap-2">
                <button onclick="toggleMobileMenu(); showSavedDestinations();" class="w-full py-2.5 px-4 rounded-xl border border-stone-200 dark:border-stone-700 font-semibold text-xs flex items-center justify-center gap-2">
                    <i class="fa-regular fa-heart text-stone-500"></i>
                    <span>Destinasi Tersimpan (<span id="wishlistBadgeMobile">0</span>)</span>
                </button>
                <button onclick="toggleMobileMenu(); openBookingModal();" class="w-full py-3 px-4 rounded-full bg-stone-900 text-white dark:bg-stone-100 dark:text-stone-900 font-semibold text-xs shadow-sm">
                    Rencanakan Trip Sekarang
                </button>
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
                        <div class="w-8 h-8 rounded-lg bg-stone-900 dark:bg-stone-100 dark:text-stone-900 flex items-center justify-center text-white text-xs">
                            <i class="fa-solid fa-compass"></i>
                        </div>
                        <span class="text-base font-serif font-semibold text-stone-900 dark:text-white">Nusantara<span class="italic font-normal text-stone-500">Wander</span></span>
                    </div>
                    <p class="text-xs leading-relaxed text-stone-500 dark:text-stone-400 max-w-sm mb-5">
                        Boutique trip curator berbasis di Indonesia. Kami menemani Anda menikmati keindahan pulau, rasa rempah, dan keramahan warga lokal secara bertanggung jawab dan tanpa tergesa-gesa.
                    </p>
                    <div class="flex items-center gap-2.5 text-xs text-stone-500">
                        <a href="https://wa.me/6281199887766" target="_blank" class="w-8 h-8 rounded-full border border-stone-300 dark:border-stone-700 hover:bg-stone-900 hover:text-white flex items-center justify-center transition-colors">
                            <i class="fa-brands fa-whatsapp"></i>
                        </a>
                        <a href="#footer" onclick="showToast('Instagram: @nusantarawander.trip', 'info')" class="w-8 h-8 rounded-full border border-stone-300 dark:border-stone-700 hover:bg-stone-900 hover:text-white flex items-center justify-center transition-colors">
                            <i class="fa-brands fa-instagram"></i>
                        </a>
                        <a href="#footer" onclick="showToast('YouTube: Dokumentasi Perjalanan Nusantara', 'info')" class="w-8 h-8 rounded-full border border-stone-300 dark:border-stone-700 hover:bg-stone-900 hover:text-white flex items-center justify-center transition-colors">
                            <i class="fa-brands fa-youtube"></i>
                        </a>
                    </div>
                </div>

                <!-- Col 2: Navigasi -->
                <div class="lg:col-span-2">
                    <h4 class="text-xs font-bold uppercase tracking-wider text-stone-900 dark:text-white mb-3.5">Eksplorasi</h4>
                    <ul class="space-y-2 text-xs text-stone-500 dark:text-stone-400">
                        <li><a href="{{ route('home') }}#beranda" class="hover:text-stone-900 dark:hover:text-white transition-colors">Beranda</a></li>
                        <li><a href="{{ route('home') }}#destinasi" class="hover:text-stone-900 dark:hover:text-white transition-colors">Destinasi</a></li>
                        <li><a href="{{ route('home') }}#paket" class="hover:text-stone-900 dark:hover:text-white transition-colors">Paket Wisata</a></li>
                        <li><a href="{{ route('home') }}#cerita" class="hover:text-stone-900 dark:hover:text-white transition-colors">Filosofi Perjalanan</a></li>
                        <li><a href="{{ route('home') }}#galeri" class="hover:text-stone-900 dark:hover:text-white transition-colors">Galeri Dokumentasi</a></li>
                    </ul>
                </div>

                <!-- Col 3: Kontak & Hub -->
                <div class="lg:col-span-2">
                    <h4 class="text-xs font-bold uppercase tracking-wider text-stone-900 dark:text-white mb-3.5">Kontak Tim</h4>
                    <ul class="space-y-2 text-xs text-stone-500 dark:text-stone-400">
                        <li>Jakarta & Denpasar, Indonesia</li>
                        <li><a href="https://wa.me/6281199887766" class="hover:underline">+62 811-9988-7766</a></li>
                        <li>halo@nusantarawander.id</li>
                        <li class="text-[11px] text-stone-400 pt-1">Balas cepat: 08.00 - 21.00 WIB</li>
                    </ul>
                </div>

                <!-- Col 4: Newsletter Sederhana -->
                <div class="lg:col-span-3">
                    <h4 class="text-xs font-bold uppercase tracking-wider text-stone-900 dark:text-white mb-2">Warta Perjalanan</h4>
                    <p class="text-xs text-stone-500 dark:text-stone-400 mb-3">
                        Kirimkan alamat surel Anda untuk menerima catatan destinasi baru dan promo open trip berkala.
                    </p>
                    <form onsubmit="handleNewsletter(event)" class="flex gap-1.5">
                        <input 
                            type="email" 
                            id="newsletterEmail"
                            required 
                            placeholder="Alamat surel Anda..." 
                            class="w-full px-3.5 py-2 rounded-xl bg-white dark:bg-stone-800 border border-stone-200 dark:border-stone-700 text-xs focus:ring-1 focus:ring-stone-900 focus:outline-none"
                        >
                        <button type="submit" class="px-4 py-2 rounded-xl bg-stone-900 hover:bg-stone-800 text-white text-xs font-semibold shrink-0 transition-colors">
                            Kirim
                        </button>
                    </form>
                </div>
            </div>

            <!-- Bottom -->
            <div class="pt-6 flex flex-col sm:flex-row items-center justify-between text-[11px] text-stone-600 dark:text-stone-300 gap-3">
                <p>&copy; {{ date('Y') }} PT Nusantara Wander Indonesia. Dikurasi dengan cinta di Bumi Nusantara.</p>
                <div class="flex gap-4">
                    <button onclick="showToast('Mitra terdaftar: ASITA & Komunitas Pemandu Lokal HPI', 'info')" class="hover:underline">Mitra Pemandu Lokal</button>
                    <button onclick="showToast('Kebijakan Privasi: Data Anda aman dan tidak pernah dijual.', 'info')" class="hover:underline">Privasi & Etika Perjalanan</button>
                </div>
            </div>
        </div>
    </footer>

    <!-- MODAL 1: DETAIL DESTINASI (CLEAN WHITE CARD) -->
    <div id="detailModal" class="fixed inset-0 z-50 hidden items-center justify-center p-4 bg-stone-950/60 backdrop-blur-xs overflow-y-auto">
        <div class="bg-white dark:bg-stone-900 rounded-3xl max-w-2xl w-full overflow-hidden shadow-xl border border-stone-200 dark:border-stone-800 my-8 animate-fadeIn">
            <div class="relative h-64 sm:h-72">
                <img id="modalDestImage" src="" alt="Detail Destinasi" class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-stone-950/85 via-stone-950/20 to-transparent"></div>
                
                <button onclick="closeDetailModal()" class="absolute top-4 right-4 w-9 h-9 rounded-full bg-stone-900/60 hover:bg-stone-900 text-white flex items-center justify-center text-sm transition-colors">
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
                    <h4 class="text-xs font-bold uppercase tracking-wider text-stone-400 mb-1.5">Catatan Perjalanan</h4>
                    <p id="modalDestDesc" class="text-stone-600 dark:text-stone-300 text-sm leading-relaxed"></p>
                </div>

                <div class="grid grid-cols-3 gap-3 p-3.5 rounded-2xl bg-stone-50 dark:bg-stone-800/60 border border-stone-200/60 dark:border-stone-700 text-xs">
                    <div>
                        <span class="text-stone-400 block">Waktu Cocok</span>
                        <span id="modalDestBestTime" class="font-semibold text-stone-800 dark:text-white mt-0.5 block"></span>
                    </div>
                    <div>
                        <span class="text-stone-400 block">Durasi Trip</span>
                        <span id="modalDestDuration" class="font-semibold text-stone-800 dark:text-white mt-0.5 block"></span>
                    </div>
                    <div>
                        <span class="text-stone-400 block">Perkiraan Biaya</span>
                        <span id="modalDestPrice" class="font-bold text-stone-900 dark:text-white mt-0.5 block"></span>
                    </div>
                </div>

                <div>
                    <h4 class="text-xs font-bold uppercase tracking-wider text-stone-400 mb-2">Yang Menanti di Sana</h4>
                    <div id="modalDestHighlights" class="space-y-1.5"></div>
                </div>

                <div class="pt-4 border-t border-stone-100 dark:border-stone-800 flex items-center justify-between gap-3">
                    <button onclick="closeDetailModal()" class="px-4 py-2.5 rounded-full border border-stone-200 dark:border-stone-700 text-xs font-semibold hover:bg-stone-50 dark:hover:bg-stone-800">
                        Tutup
                    </button>
                    <button id="modalBookNowBtn" class="px-6 py-2.5 rounded-full bg-stone-900 text-white dark:bg-stone-100 dark:text-stone-900 text-xs font-semibold shadow-sm hover:opacity-90 flex items-center gap-1.5">
                        <span>Pesan Trip Ini</span>
                        <i class="fa-solid fa-arrow-right text-[10px]"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL 2: FORMULIR PEMESANAN (NATURAL & CLEAN) -->
    <div id="bookingModal" class="fixed inset-0 z-50 hidden items-center justify-center p-4 bg-stone-950/60 backdrop-blur-xs overflow-y-auto">
        <div class="bg-white dark:bg-stone-900 rounded-3xl max-w-xl w-full overflow-hidden shadow-xl border border-stone-200 dark:border-stone-800 my-8">
            <div class="px-6 py-4 bg-stone-900 text-white dark:bg-stone-800 flex items-center justify-between">
                <div>
                    <span class="text-[10px] uppercase tracking-widest text-stone-400 font-medium">Boutique Booking Concierge</span>
                    <h3 class="font-serif text-lg font-semibold">Rencanakan Perjalanan Anda</h3>
                </div>
                <button onclick="closeBookingModal()" class="w-7 h-7 rounded-full bg-white/10 hover:bg-white/20 flex items-center justify-center text-xs">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>

            <form id="bookingForm" onsubmit="submitBookingForm(event)" class="p-6 max-h-[75vh] overflow-y-auto space-y-4 text-xs">
                @csrf
                <div>
                    <label class="block font-bold uppercase tracking-wider text-stone-500 dark:text-stone-400 mb-1">
                        Pilihan Destinasi / Paket
                    </label>
                    <select id="bookItemSelect" name="item_name" onchange="calculateSimulatedPrice()" class="w-full px-3.5 py-2.5 rounded-xl bg-stone-50 dark:bg-stone-800 border border-stone-200 dark:border-stone-700 font-medium text-stone-900 dark:text-white focus:ring-1 focus:ring-stone-900 focus:outline-none">
                    </select>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <label class="block font-bold uppercase tracking-wider text-stone-500 dark:text-stone-400 mb-1">Nama Lengkap</label>
                        <input type="text" id="bookName" name="customer_name" required placeholder="Nama Anda" class="w-full px-3.5 py-2 rounded-xl bg-stone-50 dark:bg-stone-800 border border-stone-200 dark:border-stone-700 focus:ring-1 focus:ring-stone-900 focus:outline-none">
                    </div>
                    <div>
                        <label class="block font-bold uppercase tracking-wider text-stone-500 dark:text-stone-400 mb-1">Nomor WhatsApp</label>
                        <input type="tel" id="bookPhone" name="customer_phone" required placeholder="08xxxxxxxx" class="w-full px-3.5 py-2 rounded-xl bg-stone-50 dark:bg-stone-800 border border-stone-200 dark:border-stone-700 focus:ring-1 focus:ring-stone-900 focus:outline-none">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <label class="block font-bold uppercase tracking-wider text-stone-500 dark:text-stone-400 mb-1">Rencana Berangkat</label>
                        <input type="date" id="bookDate" name="travel_date" required class="w-full px-3.5 py-2 rounded-xl bg-stone-50 dark:bg-stone-800 border border-stone-200 dark:border-stone-700 focus:ring-1 focus:ring-stone-900 focus:outline-none">
                    </div>
                    <div>
                        <label class="block font-bold uppercase tracking-wider text-stone-500 dark:text-stone-400 mb-1">Jumlah Peserta</label>
                        <input type="number" id="bookPax" name="pax" min="1" max="40" value="2" oninput="calculateSimulatedPrice()" required class="w-full px-3.5 py-2 rounded-xl bg-stone-50 dark:bg-stone-800 border border-stone-200 dark:border-stone-700 font-semibold focus:ring-1 focus:ring-stone-900 focus:outline-none">
                    </div>
                </div>

                <div>
                    <label class="block font-bold uppercase tracking-wider text-stone-500 dark:text-stone-400 mb-1.5">Opsi Layanan Tambahan</label>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-2.5">
                        <label class="flex items-start gap-2.5 p-2.5 rounded-xl border border-stone-200 dark:border-stone-700 cursor-pointer hover:bg-stone-50 dark:hover:bg-stone-800/40">
                            <input type="checkbox" id="addonDrone" name="addon_drone" value="1" onchange="calculateSimulatedPrice()" class="mt-0.5 accent-stone-900 rounded">
                            <div>
                                <p class="font-semibold text-stone-800 dark:text-stone-200">Dokumentasi Drone & Foto</p>
                                <p class="text-[10px] text-stone-400">+Rp 450.000 / grup</p>
                            </div>
                        </label>
                        <label class="flex items-start gap-2.5 p-2.5 rounded-xl border border-stone-200 dark:border-stone-700 cursor-pointer hover:bg-stone-50 dark:hover:bg-stone-800/40">
                            <input type="checkbox" id="addonVip" name="addon_vip" value="1" onchange="calculateSimulatedPrice()" class="mt-0.5 accent-stone-900 rounded">
                            <div>
                                <p class="font-semibold text-stone-800 dark:text-stone-200">Upgrade Private Villa</p>
                                <p class="text-[10px] text-stone-400">+Rp 650.000 / orang</p>
                            </div>
                        </label>
                    </div>
                </div>

                <div>
                    <label class="block font-bold uppercase tracking-wider text-stone-500 dark:text-stone-400 mb-1">Kode Voucher Promo (Coba: <span class="font-mono text-stone-900 dark:text-white underline">PESONAID</span>)</label>
                    <input type="text" id="bookPromo" name="promo_code" oninput="calculateSimulatedPrice()" placeholder="Ketik kode voucher..." class="w-full px-3.5 py-2 rounded-xl bg-stone-50 dark:bg-stone-800 border border-stone-200 dark:border-stone-700 uppercase focus:ring-1 focus:ring-stone-900 focus:outline-none">
                </div>

                <div>
                    <label class="block font-bold uppercase tracking-wider text-stone-500 dark:text-stone-400 mb-1">Catatan Tambahan (Opsional)</label>
                    <textarea id="bookNotes" name="notes" rows="2" placeholder="Makanan khusus, penjemputan bandara, atau preferensi kamar..." class="w-full px-3.5 py-1.5 rounded-xl bg-stone-50 dark:bg-stone-800 border border-stone-200 dark:border-stone-700 focus:ring-1 focus:ring-stone-900 focus:outline-none"></textarea>
                </div>

                <!-- Estimasi Ringkasan -->
                <div class="p-3.5 rounded-xl bg-stone-50 dark:bg-stone-800/80 border border-stone-200/70 dark:border-stone-700 space-y-1.5">
                    <div class="flex justify-between text-stone-500">
                        <span>Biaya Pokok (<span id="summaryPaxCount">2</span> Peserta)</span>
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
                    <button type="button" onclick="closeBookingModal()" class="px-4 py-2 rounded-full border border-stone-200 dark:border-stone-700 font-semibold">
                        Batal
                    </button>
                    <button type="submit" id="btnSubmitBooking" class="px-6 py-2 rounded-full bg-stone-900 text-white dark:bg-stone-100 dark:text-stone-900 font-semibold shadow-sm hover:opacity-90">
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
            <h3 class="font-serif text-xl font-bold text-stone-900 dark:text-white mt-2">Reservasi Terdaftar</h3>
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
                    <span>Buka Lembar E-Tiket Lengkap</span>
                </a>
                <button onclick="closeReceiptModal()" class="w-full py-2 rounded-full border border-stone-200 dark:border-stone-700 text-stone-600 dark:text-stone-400 text-xs hover:bg-stone-50 dark:hover:bg-stone-800">
                    Selesai
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
                <button onclick="closeLightbox(); openBookingModal();" class="px-4 py-1.5 rounded-full bg-white text-stone-950 text-xs font-semibold hover:bg-stone-100">
                    Kunjungi Tempat Ini
                </button>
            </div>
        </div>
    </div>

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

        function toggleTheme() {
            const htmlEl = document.documentElement;
            htmlEl.classList.toggle('dark');
            const isDark = htmlEl.classList.contains('dark');
            localStorage.setItem('theme', isDark ? 'dark' : 'light');
            const iconClass = isDark ? 'fa-solid fa-sun text-amber-400 text-sm' : 'fa-solid fa-moon text-sm';
            if (document.getElementById('themeIcon')) document.getElementById('themeIcon').className = iconClass;
            if (document.getElementById('themeIconMobile')) document.getElementById('themeIconMobile').className = iconClass;
        }

        (function() {
            const savedTheme = localStorage.getItem('theme');
            if (savedTheme === 'dark') {
                document.documentElement.classList.add('dark');
            }
        })();

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
            updateWishlistBadges();

            const dateInput = document.getElementById('bookDate');
            if (dateInput && !dateInput.value) {
                const nextWeek = new Date();
                nextWeek.setDate(nextWeek.getDate() + 7);
                dateInput.value = nextWeek.toISOString().split('T')[0];
            }

            // Dynamic Island Navbar Scroll Effect
            const navContainer = document.getElementById('navContainer');
            if (navContainer) {
                window.addEventListener('scroll', () => {
                    if (window.scrollY > 40) {
                        navContainer.classList.add('shadow-[0_12px_40px_rgba(0,0,0,0.14)]', 'bg-white/95', 'dark:bg-stone-900/95');
                        navContainer.classList.remove('bg-white/90', 'dark:bg-stone-900/90');
                    } else {
                        navContainer.classList.remove('shadow-[0_12px_40px_rgba(0,0,0,0.14)]', 'bg-white/95', 'dark:bg-stone-900/95');
                        navContainer.classList.add('bg-white/90', 'dark:bg-stone-900/90');
                    }
                });
            }
        });
    </script>
    @stack('scripts')
</body>
</html>
