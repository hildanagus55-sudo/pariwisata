<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel | DANWISATA Concierge')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Google Fonts: Plus Jakarta Sans & Newsreader -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Newsreader:ital,opsz,wght@0,6..72,400;0,6..72,500;0,6..72,600;1,6..72,400&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome 6 Icons -->
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
                        amber: {
                            50: '#fffbeb',
                            100: '#fef3c7',
                            200: '#fde68a',
                            300: '#fcd34d',
                            400: '#fbbf24',
                            500: '#f59e0b',
                            600: '#d97706',
                            700: '#b45309',
                        }
                    }
                }
            }
        };

        // Dark mode initialization
        try {
            if (localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        } catch(e) {}
    </script>

    <style>
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }
        ::-webkit-scrollbar-track {
            background: #faf8f5;
        }
        .dark ::-webkit-scrollbar-track {
            background: #17130f;
        }
        ::-webkit-scrollbar-thumb {
            background: #d6cebf;
            border-radius: 9999px;
        }
        .dark ::-webkit-scrollbar-thumb {
            background: #3d3328;
        }
    </style>
</head>
<body class="bg-stone-50 dark:bg-stone-950 text-stone-800 dark:text-stone-100 font-sans antialiased min-h-screen flex flex-col selection:bg-amber-100 selection:text-stone-900">

    <div class="flex-1 flex overflow-hidden min-h-screen">
        <!-- ================= BACKDROP FOR MOBILE SIDEBAR ================= -->
        <div id="sidebarBackdrop" onclick="toggleAdminSidebar()" class="fixed inset-0 z-40 bg-stone-950/60 backdrop-blur-xs hidden lg:hidden transition-opacity"></div>

        <!-- ================= DEDICATED ADMIN SIDEBAR ================= -->
        <aside id="adminSidebar" class="fixed inset-y-0 left-0 z-50 w-64 bg-white dark:bg-stone-900 border-r border-stone-200/90 dark:border-stone-800 flex flex-col justify-between -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out shadow-xl lg:shadow-none">
            <!-- Sidebar Header & Brand -->
            <div>
                <div class="h-16 px-5 border-b border-stone-100 dark:border-stone-800/80 flex items-center justify-between">
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 group">
                        <div class="w-9 h-9 rounded-xl bg-gradient-to-tr from-amber-600 to-amber-400 flex items-center justify-center text-stone-950 font-serif font-black text-lg shadow-sm">
                            DW
                        </div>
                        <div>
                            <span class="font-serif text-base font-bold tracking-tight text-stone-900 dark:text-white block leading-tight">
                                DANWISATA
                            </span>
                            <span class="text-[9px] uppercase tracking-widest text-amber-700 dark:text-amber-400 font-semibold block">
                                Concierge Admin
                            </span>
                        </div>
                    </a>
                    <button onclick="toggleAdminSidebar()" class="lg:hidden text-stone-400 hover:text-stone-600 dark:hover:text-white p-1">
                        <i class="fa-solid fa-xmark text-lg"></i>
                    </button>
                </div>

                <!-- Navigation Links -->
                <div class="p-3 space-y-6">
                    <div>
                        <span class="px-3 text-[10px] font-bold uppercase tracking-wider text-stone-400 dark:text-stone-500 block mb-2">
                            Menu Utama
                        </span>
                        <nav class="space-y-1 text-xs">
                            <!-- 1. Dashboard -->
                            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl font-medium transition-all {{ request()->routeIs('admin.dashboard*') ? 'bg-stone-900 text-white dark:bg-stone-100 dark:text-stone-900 font-semibold shadow-xs' : 'text-stone-600 dark:text-stone-300 hover:bg-stone-100 dark:hover:bg-stone-800/60' }}">
                                <i class="fa-solid fa-gauge-high text-xs w-4 text-center"></i>
                                <span>Dashboard</span>
                            </a>

                            <!-- 2. Reservasi Tamu -->
                            <a href="{{ route('admin.bookings') }}" class="flex items-center justify-between px-3.5 py-2.5 rounded-xl font-medium transition-all {{ request()->routeIs('admin.bookings*') ? 'bg-stone-900 text-white dark:bg-stone-100 dark:text-stone-900 font-semibold shadow-xs' : 'text-stone-600 dark:text-stone-300 hover:bg-stone-100 dark:hover:bg-stone-800/60' }}">
                                <div class="flex items-center gap-3">
                                    <i class="fa-solid fa-calendar-check text-xs w-4 text-center"></i>
                                    <span>Reservasi Tamu</span>
                                </div>
                                @php
                                    $pendingCount = \App\Models\Booking::where('status', 'pending')->count();
                                @endphp
                                @if($pendingCount > 0)
                                    <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-amber-500 text-stone-950">
                                        {{ $pendingCount }}
                                    </span>
                                @endif
                            </a>

                            <!-- 3. Destinasi Wisata -->
                            <a href="{{ route('admin.destinations.index') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl font-medium transition-all {{ request()->routeIs('admin.destinations*') ? 'bg-stone-900 text-white dark:bg-stone-100 dark:text-stone-900 font-semibold shadow-xs' : 'text-stone-600 dark:text-stone-300 hover:bg-stone-100 dark:hover:bg-stone-800/60' }}">
                                <i class="fa-solid fa-map-location-dot text-xs w-4 text-center"></i>
                                <span>Destinasi Wisata</span>
                            </a>

                            <!-- 4. Paket Wisata -->
                            <a href="{{ route('admin.packages.index') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl font-medium transition-all {{ request()->routeIs('admin.packages*') ? 'bg-stone-900 text-white dark:bg-stone-100 dark:text-stone-900 font-semibold shadow-xs' : 'text-stone-600 dark:text-stone-300 hover:bg-stone-100 dark:hover:bg-stone-800/60' }}">
                                <i class="fa-solid fa-suitcase-rolling text-xs w-4 text-center"></i>
                                <span>Paket Perjalanan</span>
                            </a>

                            <!-- 5. Warta / Newsletter -->
                            <a href="{{ route('admin.newsletters.index') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl font-medium transition-all {{ request()->routeIs('admin.newsletters*') ? 'bg-stone-900 text-white dark:bg-stone-100 dark:text-stone-900 font-semibold shadow-xs' : 'text-stone-600 dark:text-stone-300 hover:bg-stone-100 dark:hover:bg-stone-800/60' }}">
                                <i class="fa-solid fa-envelope-open-text text-xs w-4 text-center"></i>
                                <span>Warta / Newsletter</span>
                            </a>
                        </nav>
                    </div>

                    <!-- Front Website Shortcut -->
                    <div>
                        <span class="px-3 text-[10px] font-bold uppercase tracking-wider text-stone-400 dark:text-stone-500 block mb-2">
                            Pintasan
                        </span>
                        <a href="{{ route('home') }}" target="_blank" class="flex items-center justify-between px-3.5 py-2.5 rounded-xl text-stone-600 dark:text-stone-300 hover:bg-stone-100 dark:hover:bg-stone-800/60 text-xs font-medium transition-colors group">
                            <div class="flex items-center gap-2.5">
                                <i class="fa-solid fa-globe text-stone-400 group-hover:text-amber-600 text-xs"></i>
                                <span>Lihat Website</span>
                            </div>
                            <i class="fa-solid fa-arrow-up-right-from-square text-[10px] text-stone-400"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Sidebar Footer / Admin Identity -->
            <div class="p-3 border-t border-stone-100 dark:border-stone-800/80">
                <div class="p-2.5 rounded-xl bg-stone-50 dark:bg-stone-800/60 flex items-center justify-between">
                    <div class="flex items-center gap-2.5">
                        <div class="w-8 h-8 rounded-full bg-stone-200 dark:bg-stone-700 flex items-center justify-center font-bold text-xs text-stone-700 dark:text-stone-200">
                            <i class="fa-solid fa-user-shield"></i>
                        </div>
                        <div class="min-w-0">
                            <p class="text-xs font-semibold text-stone-900 dark:text-white truncate">Concierge Admin</p>
                            <p class="text-[10px] text-stone-400 truncate">Super Admin</p>
                        </div>
                    </div>
                    <button onclick="toggleDarkMode()" class="w-7 h-7 rounded-lg text-stone-500 hover:text-stone-900 dark:text-stone-400 dark:hover:text-white flex items-center justify-center transition-colors" title="Toggle Tema Gelap/Terang">
                        <i id="themeIcon" class="fa-solid fa-moon text-xs"></i>
                    </button>
                </div>
            </div>
        </aside>

        <!-- ================= MAIN ADMIN CONTENT AREA ================= -->
        <div class="flex-1 flex flex-col min-w-0 lg:pl-64">
            <!-- Topbar Header -->
            <header class="h-16 bg-white/80 dark:bg-stone-900/80 backdrop-blur-md border-b border-stone-200/80 dark:border-stone-800 sticky top-0 z-30 px-4 sm:px-6 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <button onclick="toggleAdminSidebar()" class="lg:hidden p-2 rounded-xl text-stone-600 dark:text-stone-300 hover:bg-stone-100 dark:hover:bg-stone-800 focus:outline-none">
                        <i class="fa-solid fa-bars text-sm"></i>
                    </button>
                    <div>
                        <h2 class="text-sm sm:text-base font-bold text-stone-900 dark:text-white">
                            @yield('page_title', 'Admin Concierge Hub')
                        </h2>
                        <p class="text-[10px] text-stone-400 hidden sm:block">
                            @yield('page_description', 'Kelola destinasi, tiket reservasi tamu, dan konten portal DANWISATA.')
                        </p>
                    </div>
                </div>

                <div class="flex items-center gap-2.5">
                    @yield('header_actions')
                    <a href="{{ route('home') }}" target="_blank" class="hidden sm:inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full border border-stone-200 dark:border-stone-700 text-xs font-medium text-stone-700 dark:text-stone-300 hover:bg-stone-100 dark:hover:bg-stone-800 transition-colors">
                        <i class="fa-solid fa-arrow-up-right-from-square text-[10px]"></i>
                        <span>Website Utama</span>
                    </a>
                </div>
            </header>

            <!-- Flash Alerts -->
            <div class="px-4 sm:px-6 lg:px-8 pt-4">
                @if(session('success'))
                    <div class="p-3.5 mb-4 rounded-2xl bg-emerald-50 dark:bg-emerald-950/40 border border-emerald-200 dark:border-emerald-800/60 text-emerald-800 dark:text-emerald-300 text-xs flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <i class="fa-solid fa-circle-check text-emerald-600"></i>
                            <span>{{ session('success') }}</span>
                        </div>
                        <button onclick="this.parentElement.remove()" class="text-emerald-600 hover:opacity-75">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="p-3.5 mb-4 rounded-2xl bg-rose-50 dark:bg-rose-950/40 border border-rose-200 dark:border-rose-800/60 text-rose-800 dark:text-rose-300 text-xs flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <i class="fa-solid fa-circle-exclamation text-rose-600"></i>
                            <span>{{ session('error') }}</span>
                        </div>
                        <button onclick="this.parentElement.remove()" class="text-rose-600 hover:opacity-75">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </div>
                @endif

                @if($errors->any())
                    <div class="p-3.5 mb-4 rounded-2xl bg-amber-50 dark:bg-amber-950/40 border border-amber-200 dark:border-amber-800/60 text-amber-800 dark:text-amber-300 text-xs">
                        <div class="flex items-center gap-2 font-bold mb-1">
                            <i class="fa-solid fa-triangle-exclamation"></i>
                            <span>Mohon periksa formulir berikut:</span>
                        </div>
                        <ul class="list-disc list-inside space-y-0.5 text-[11px]">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>

            <!-- Page Content Injection -->
            <main class="flex-1 px-4 sm:px-6 lg:px-8 py-4 sm:py-6">
                @yield('content')
            </main>

            <!-- Admin Footer -->
            <footer class="h-12 border-t border-stone-200/80 dark:border-stone-800/80 px-4 sm:px-6 flex items-center justify-between text-[11px] text-stone-400">
                <p>&copy; {{ date('Y') }} DANWISATA Nusantara. Panel Manajemen Concierge.</p>
                <div class="flex items-center gap-3">
                    <span class="inline-flex items-center gap-1.5 text-emerald-600 dark:text-emerald-400">
                        <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                        <span>Sistem Aktif</span>
                    </span>
                </div>
            </footer>
        </div>
    </div>

    <!-- Scripts -->
    <script>
        function toggleAdminSidebar() {
            const sidebar = document.getElementById('adminSidebar');
            const backdrop = document.getElementById('sidebarBackdrop');
            if (sidebar.classList.contains('-translate-x-full')) {
                sidebar.classList.remove('-translate-x-full');
                backdrop.classList.remove('hidden');
            } else {
                sidebar.classList.add('-translate-x-full');
                backdrop.classList.add('hidden');
            }
        }

        function toggleDarkMode() {
            const isDark = document.documentElement.classList.toggle('dark');
            localStorage.setItem('theme', isDark ? 'dark' : 'light');
            updateThemeIcon();
        }

        function updateThemeIcon() {
            const icon = document.getElementById('themeIcon');
            if (!icon) return;
            if (document.documentElement.classList.contains('dark')) {
                icon.className = 'fa-solid fa-sun text-xs text-amber-400';
            } else {
                icon.className = 'fa-solid fa-moon text-xs text-stone-500';
            }
        }

        document.addEventListener('DOMContentLoaded', updateThemeIcon);
    </script>
    @stack('scripts')
</body>
</html>
