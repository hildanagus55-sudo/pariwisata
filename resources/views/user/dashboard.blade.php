@extends('layouts.app')

@section('title', 'Portal Wisatawan - ' . $user->name . ' | Danwisata Indonesia')

@section('content')
<div class="min-h-screen bg-stone-50/70 dark:bg-stone-950 py-10 sm:py-14 px-4 sm:px-6 lg:px-8">
    <div class="max-w-6xl mx-auto space-y-8">

        <!-- Flash Messages -->
        @if (session('success'))
            <div class="p-4 rounded-2xl bg-emerald-50 dark:bg-emerald-950/40 border border-emerald-200 dark:border-emerald-800 text-emerald-800 dark:text-emerald-200 text-xs sm:text-sm flex items-center justify-between shadow-xs">
                <div class="flex items-center gap-3">
                    <i class="fa-solid fa-circle-check text-emerald-600 text-base"></i>
                    <span class="font-medium">{{ session('success') }}</span>
                </div>
                <button type="button" onclick="this.parentElement.remove()" class="text-emerald-600 hover:text-emerald-900 text-xs">✕</button>
            </div>
        @endif

        @if ($errors->any())
            <div class="p-4 rounded-2xl bg-rose-50 dark:bg-rose-950/40 border border-rose-200 dark:border-rose-800 text-rose-800 dark:text-rose-200 text-xs sm:text-sm space-y-1 shadow-xs">
                <span class="font-bold flex items-center gap-2">
                    <i class="fa-solid fa-triangle-exclamation text-rose-500"></i> Perhatian:
                </span>
                <p>{{ $errors->first() }}</p>
            </div>
        @endif

        <!-- Profile Hero Banner -->
        <div class="relative bg-white dark:bg-stone-900 rounded-3xl border border-stone-200/90 dark:border-stone-800 p-6 sm:p-8 shadow-sm overflow-hidden">
            <div class="absolute -right-16 -top-16 w-64 h-64 bg-amber-500/5 rounded-full blur-3xl pointer-events-none"></div>
            <div class="absolute -left-16 -bottom-16 w-64 h-64 bg-emerald-500/5 rounded-full blur-3xl pointer-events-none"></div>

            <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
                <div class="flex items-center gap-4 sm:gap-5">
                    <!-- User Initial Avatar -->
                    <div class="w-16 h-16 sm:w-20 sm:h-20 rounded-2xl bg-gradient-to-br from-stone-800 to-stone-950 dark:from-stone-700 dark:to-stone-900 text-white font-bold text-xl sm:text-2xl flex items-center justify-center shadow-md border-2 border-stone-100 dark:border-stone-700">
                        {{ strtoupper(substr($user->name, 0, 2)) }}
                    </div>

                    <div class="space-y-1">
                        <div class="flex flex-wrap items-center gap-2 sm:gap-2.5">
                            <h1 class="text-xl sm:text-2xl font-bold text-stone-900 dark:text-white tracking-tight">{{ $user->name }}</h1>
                            @if ($user->isAdmin())
                                <span class="px-2.5 py-0.5 rounded-full bg-amber-100 dark:bg-amber-950/70 border border-amber-300 dark:border-amber-700 text-amber-800 dark:text-amber-300 text-[10px] font-bold uppercase tracking-wider flex items-center gap-1">
                                    <i class="fa-solid fa-shield-halved text-[9px]"></i>
                                    <span>{{ $user->isSuperAdmin() ? 'Super Admin' : 'Admin Concierge' }}</span>
                                </span>
                            @else
                                <span class="px-2.5 py-0.5 rounded-full bg-emerald-100 dark:bg-emerald-950/70 border border-emerald-300 dark:border-emerald-700 text-emerald-800 dark:text-emerald-300 text-[10px] font-bold uppercase tracking-wider flex items-center gap-1">
                                    <i class="fa-solid fa-award text-[9px]"></i>
                                    <span>Wisatawan Danwisata</span>
                                </span>
                            @endif
                        </div>
                        <div class="flex flex-wrap items-center gap-x-4 gap-y-1 text-xs text-stone-500 dark:text-stone-400">
                            <span class="flex items-center gap-1.5">
                                <i class="fa-regular fa-envelope text-stone-400"></i>
                                <span>{{ $user->email }}</span>
                            </span>
                            @if ($user->phone)
                                <span class="flex items-center gap-1.5">
                                    <i class="fa-brands fa-whatsapp text-emerald-500"></i>
                                    <span>{{ $user->phone }}</span>
                                </span>
                            @endif
                            <span class="flex items-center gap-1.5">
                                <i class="fa-regular fa-calendar-check text-stone-400"></i>
                                <span>Bergabung {{ $user->created_at ? $user->created_at->isoFormat('MMMM Y') : '2026' }}</span>
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Right Action Buttons -->
                <div class="flex flex-wrap items-center gap-2.5 pt-2 md:pt-0">
                    @if ($user->isAdmin())
                        <a href="{{ env('ADMIN_URL', 'http://localhost:8001') }}/dashboard" target="_blank" class="px-4 py-2.5 rounded-xl bg-amber-500 hover:bg-amber-600 text-white font-semibold text-xs tracking-wide shadow-xs flex items-center gap-2 transition active:scale-95">
                            <i class="fa-solid fa-shield-halved"></i>
                            <span>Buka Panel Admin (Port 8001)</span>
                        </a>
                    @endif

                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="px-4 py-2.5 rounded-xl border border-stone-200 dark:border-stone-700 hover:bg-rose-50 hover:text-rose-600 hover:border-rose-200 text-stone-600 dark:text-stone-300 font-semibold text-xs transition flex items-center gap-2 cursor-pointer">
                            <i class="fa-solid fa-arrow-right-from-bracket"></i>
                            <span>Keluar</span>
                        </button>
                    </form>
                </div>
            </div>

            <!-- Stats Bar -->
            <div class="grid grid-cols-2 sm:grid-cols-3 gap-3 pt-6 mt-6 border-t border-stone-100 dark:border-stone-800 text-xs">
                <div class="p-3.5 rounded-2xl bg-stone-50 dark:bg-stone-800/50 border border-stone-100 dark:border-stone-800 flex items-center justify-between">
                    <div>
                        <span class="text-stone-400 text-[11px] block font-medium">Total Reservasi</span>
                        <span class="text-lg font-extrabold text-stone-900 dark:text-white">{{ $totalBookings }} Tiket</span>
                    </div>
                    <div class="w-9 h-9 rounded-xl bg-stone-200/70 dark:bg-stone-700 flex items-center justify-center text-stone-700 dark:text-stone-200">
                        <i class="fa-solid fa-ticket"></i>
                    </div>
                </div>

                <div class="p-3.5 rounded-2xl bg-stone-50 dark:bg-stone-800/50 border border-stone-100 dark:border-stone-800 flex items-center justify-between">
                    <div>
                        <span class="text-stone-400 text-[11px] block font-medium">Tiket Terkonfirmasi</span>
                        <span class="text-lg font-extrabold text-emerald-600 dark:text-emerald-400">{{ $confirmedBookings }} Perjalanan</span>
                    </div>
                    <div class="w-9 h-9 rounded-xl bg-emerald-100 dark:bg-emerald-950 flex items-center justify-center text-emerald-600 dark:text-emerald-400">
                        <i class="fa-solid fa-circle-check"></i>
                    </div>
                </div>

                <div class="col-span-2 sm:col-span-1 p-3.5 rounded-2xl bg-stone-50 dark:bg-stone-800/50 border border-stone-100 dark:border-stone-800 flex items-center justify-between">
                    <div>
                        <span class="text-stone-400 text-[11px] block font-medium">Menunggu Konfirmasi</span>
                        <span class="text-lg font-extrabold text-amber-600 dark:text-amber-400">{{ $pendingBookings }} Menunggu</span>
                    </div>
                    <div class="w-9 h-9 rounded-xl bg-amber-100 dark:bg-amber-950 flex items-center justify-center text-amber-600 dark:text-amber-400">
                        <i class="fa-solid fa-clock"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tab Controls & Panels -->
        <div class="space-y-6">
            <!-- Nav Tabs -->
            <div class="flex items-center gap-2 border-b border-stone-200 dark:border-stone-800 pb-2 text-xs font-semibold overflow-x-auto">
                <button onclick="switchUserTab('reservasi')" id="btnTabReservasi" class="px-4 py-2 rounded-xl bg-stone-900 text-white dark:bg-white dark:text-stone-900 transition flex items-center gap-2 shadow-xs cursor-pointer">
                    <i class="fa-solid fa-ticket"></i>
                    <span>Riwayat Tiket & Reservasi ({{ $totalBookings }})</span>
                </button>
                <button onclick="switchUserTab('wishlist')" id="btnTabWishlist" class="px-4 py-2 rounded-xl text-stone-600 dark:text-stone-400 hover:text-stone-900 hover:bg-stone-100 dark:hover:bg-stone-800 transition flex items-center gap-2 cursor-pointer">
                    <i class="fa-regular fa-heart"></i>
                    <span>Destinasi Tersimpan</span>
                </button>
                <button onclick="switchUserTab('profil')" id="btnTabProfil" class="px-4 py-2 rounded-xl text-stone-600 dark:text-stone-400 hover:text-stone-900 hover:bg-stone-100 dark:hover:bg-stone-800 transition flex items-center gap-2 cursor-pointer">
                    <i class="fa-regular fa-user"></i>
                    <span>Pengaturan Akun</span>
                </button>
            </div>

            <!-- PANEL 1: RIWAYAT RESERVASI & TIKET -->
            <div id="userPanelReservasi" class="space-y-4">
                @if ($bookings->isEmpty())
                    <div class="bg-white dark:bg-stone-900 rounded-3xl border border-stone-200/80 dark:border-stone-800 p-10 text-center space-y-4">
                        <div class="w-16 h-16 rounded-2xl bg-stone-100 dark:bg-stone-800 text-stone-400 mx-auto flex items-center justify-center text-2xl">
                            <i class="fa-solid fa-plane-slash"></i>
                        </div>
                        <div class="space-y-1">
                            <h3 class="text-base font-bold text-stone-900 dark:text-white">Belum Ada Reservasi Aktif</h3>
                            <p class="text-xs text-stone-500 dark:text-stone-400 max-w-md mx-auto">
                                Semua tiket destinasi atau paket perjalanan yang Anda pesan menggunakan email <strong class="text-stone-700 dark:text-stone-300">{{ $user->email }}</strong> akan tercatat rapi di sini.
                            </p>
                        </div>
                        <div class="pt-2">
                            <a href="{{ route('destinations.index') }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-full bg-stone-900 dark:bg-white text-white dark:text-stone-900 font-semibold text-xs tracking-wide shadow-sm hover:scale-105 transition-all">
                                <span>Jelajahi Katalog Destinasi</span>
                                <i class="fa-solid fa-arrow-right text-[10px]"></i>
                            </a>
                        </div>
                    </div>
                @else
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach ($bookings as $booking)
                            <div class="bg-white dark:bg-stone-900 rounded-2xl border border-stone-200/90 dark:border-stone-800 p-5 shadow-2xs hover:shadow-md transition-all flex flex-col justify-between space-y-4">
                                <div class="space-y-3">
                                    <div class="flex items-center justify-between">
                                        <span class="font-mono text-[11px] font-bold text-stone-500 bg-stone-100 dark:bg-stone-800 px-2.5 py-1 rounded-md">
                                            {{ $booking->booking_code }}
                                        </span>
                                        @if ($booking->status === 'confirmed')
                                            <span class="px-2.5 py-1 rounded-full bg-emerald-100 dark:bg-emerald-950 text-emerald-800 dark:text-emerald-300 text-[10px] font-bold uppercase flex items-center gap-1">
                                                <i class="fa-solid fa-circle-check text-[9px]"></i> Terkonfirmasi
                                            </span>
                                        @elseif ($booking->status === 'cancelled')
                                            <span class="px-2.5 py-1 rounded-full bg-rose-100 dark:bg-rose-950 text-rose-800 dark:text-rose-300 text-[10px] font-bold uppercase flex items-center gap-1">
                                                <i class="fa-solid fa-circle-xmark text-[9px]"></i> Dibatalkan
                                            </span>
                                        @else
                                            <span class="px-2.5 py-1 rounded-full bg-amber-100 dark:bg-amber-950 text-amber-800 dark:text-amber-300 text-[10px] font-bold uppercase flex items-center gap-1">
                                                <i class="fa-solid fa-clock text-[9px]"></i> Menunggu Konfirmasi
                                            </span>
                                        @endif
                                    </div>

                                    <div>
                                        <h3 class="font-bold text-sm text-stone-900 dark:text-white line-clamp-1">
                                            {{ $booking->destination ? $booking->destination->name : ($booking->tourPackage ? $booking->tourPackage->name : 'Reservasi Perjalanan Privat') }}
                                        </h3>
                                        <p class="text-xs text-stone-500 dark:text-stone-400 mt-0.5">
                                            Tgl Perjalanan: <span class="font-semibold text-stone-700 dark:text-stone-300">{{ \Carbon\Carbon::parse($booking->visit_date)->isoFormat('dddd, D MMMM Y') }}</span>
                                        </p>
                                    </div>

                                    <div class="grid grid-cols-2 gap-2 text-xs pt-2 border-t border-stone-100 dark:border-stone-800">
                                        <div>
                                            <span class="text-[11px] text-stone-400 block">Jumlah Tamu</span>
                                            <span class="font-semibold text-stone-800 dark:text-stone-200">{{ $booking->tickets_count ?? $booking->guests_count ?? 1 }} Orang</span>
                                        </div>
                                        <div>
                                            <span class="text-[11px] text-stone-400 block">Total Biaya</span>
                                            <span class="font-bold text-emerald-700 dark:text-emerald-400">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="pt-3 border-t border-stone-100 dark:border-stone-800 flex items-center justify-between">
                                    <span class="text-[11px] text-stone-400">Dipesan {{ $booking->created_at ? $booking->created_at->diffForHumans() : 'Baru saja' }}</span>
                                    <a href="{{ route('bookings.receipt', $booking->booking_code) }}" target="_blank" class="px-3 py-1.5 rounded-lg bg-stone-900 hover:bg-stone-800 dark:bg-white dark:hover:bg-stone-100 text-white dark:text-stone-900 text-xs font-semibold flex items-center gap-1.5 transition">
                                        <i class="fa-solid fa-qrcode text-[10px]"></i>
                                        <span>Lihat E-Tiket</span>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- PANEL 2: DESTINASI TERSIMPAN (WISHLIST) -->
            <div id="userPanelWishlist" class="hidden space-y-4">
                <div class="bg-white dark:bg-stone-900 rounded-3xl border border-stone-200/80 dark:border-stone-800 p-6 sm:p-8 space-y-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-base font-bold text-stone-900 dark:text-white">Destinasi Pilihan Anda</h3>
                            <p class="text-xs text-stone-500 dark:text-stone-400">Daftar destinasi yang Anda simpan selama menjelajah Danwisata</p>
                        </div>
                        <button onclick="showSavedDestinations()" class="px-3.5 py-1.5 rounded-xl border border-stone-200 dark:border-stone-700 text-stone-700 dark:text-stone-300 text-xs font-semibold hover:bg-stone-50 flex items-center gap-1.5">
                            <i class="fa-regular fa-heart text-rose-500"></i>
                            <span>Buka Wishlist Drawer</span>
                        </button>
                    </div>

                    <div id="userWishlistListContainer" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 pt-2">
                        <!-- Populated by JS from LocalStorage -->
                    </div>
                </div>
            </div>

            <!-- PANEL 3: PENGATURAN PROFIL -->
            <div id="userPanelProfil" class="hidden space-y-4">
                <div class="max-w-2xl bg-white dark:bg-stone-900 rounded-3xl border border-stone-200/80 dark:border-stone-800 p-6 sm:p-8 space-y-6">
                    <div class="space-y-1">
                        <h3 class="text-base font-bold text-stone-900 dark:text-white">Perbarui Informasi Profil</h3>
                        <p class="text-xs text-stone-500 dark:text-stone-400">Kelola identitas akun dan kata sandi Anda</p>
                    </div>

                    <form action="{{ route('user.profile.update') }}" method="POST" class="space-y-4 text-xs">
                        @csrf

                        <div class="space-y-1.5 text-left">
                            <label class="block font-semibold text-stone-700 dark:text-stone-300">Nama Lengkap</label>
                            <input 
                                type="text" 
                                name="name" 
                                value="{{ old('name', $user->name) }}" 
                                required
                                class="w-full px-3.5 py-2.5 rounded-xl border border-stone-200 dark:border-stone-700 focus:border-stone-900 dark:focus:border-white focus:ring-2 focus:ring-stone-900/5 text-stone-900 dark:text-white bg-white dark:bg-stone-800 transition outline-none font-medium"
                            />
                        </div>

                        <div class="space-y-1.5 text-left">
                            <label class="block font-semibold text-stone-700 dark:text-stone-300">Alamat Email (Akun)</label>
                            <input 
                                type="email" 
                                value="{{ $user->email }}" 
                                disabled
                                class="w-full px-3.5 py-2.5 rounded-xl border border-stone-200 dark:border-stone-700 bg-stone-100 dark:bg-stone-800 text-stone-500 font-medium cursor-not-allowed"
                            />
                            <span class="text-[11px] text-stone-400">Email digunakan sebagai kunci identifikasi e-tiket reservasi.</span>
                        </div>

                        <div class="space-y-1.5 text-left">
                            <label class="block font-semibold text-stone-700 dark:text-stone-300">Nomor WhatsApp / Telepon</label>
                            <input 
                                type="text" 
                                name="phone" 
                                value="{{ old('phone', $user->phone) }}" 
                                placeholder="08123456789"
                                class="w-full px-3.5 py-2.5 rounded-xl border border-stone-200 dark:border-stone-700 focus:border-stone-900 dark:focus:border-white focus:ring-2 focus:ring-stone-900/5 text-stone-900 dark:text-white bg-white dark:bg-stone-800 transition outline-none font-medium"
                            />
                        </div>

                        <div class="pt-4 border-t border-stone-100 dark:border-stone-800 space-y-3">
                            <h4 class="font-bold text-stone-800 dark:text-stone-200 text-xs">Ubah Kata Sandi (Opsional)</h4>
                            
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                <div class="space-y-1.5 text-left">
                                    <label class="block font-semibold text-stone-700 dark:text-stone-300">Kata Sandi Baru</label>
                                    <input 
                                        type="password" 
                                        name="password" 
                                        placeholder="Kosongkan bila tidak diubah"
                                        class="w-full px-3.5 py-2.5 rounded-xl border border-stone-200 dark:border-stone-700 focus:border-stone-900 dark:focus:border-white focus:ring-2 focus:ring-stone-900/5 text-stone-900 dark:text-white bg-white dark:bg-stone-800 transition outline-none font-medium"
                                    />
                                </div>
                                <div class="space-y-1.5 text-left">
                                    <label class="block font-semibold text-stone-700 dark:text-stone-300">Ulangi Kata Sandi Baru</label>
                                    <input 
                                        type="password" 
                                        name="password_confirmation" 
                                        placeholder="Konfirmasi sandi baru"
                                        class="w-full px-3.5 py-2.5 rounded-xl border border-stone-200 dark:border-stone-700 focus:border-stone-900 dark:focus:border-white focus:ring-2 focus:ring-stone-900/5 text-stone-900 dark:text-white bg-white dark:bg-stone-800 transition outline-none font-medium"
                                    />
                                </div>
                            </div>
                        </div>

                        <div class="pt-3 flex justify-end">
                            <button type="submit" class="px-5 py-2.5 rounded-xl bg-stone-900 hover:bg-stone-800 dark:bg-white dark:hover:bg-stone-100 text-white dark:text-stone-900 font-semibold tracking-wide transition shadow-sm active:scale-95 cursor-pointer">
                                Simpan Perubahan Profil
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>

    </div>
</div>

<script>
    function switchUserTab(tab) {
        ['reservasi', 'wishlist', 'profil'].forEach(t => {
            const panel = document.getElementById('userPanel' + t.charAt(0).toUpperCase() + t.slice(1));
            const btn = document.getElementById('btnTab' + t.charAt(0).toUpperCase() + t.slice(1));
            
            if (t === tab) {
                panel.classList.remove('hidden');
                btn.className = 'px-4 py-2 rounded-xl bg-stone-900 text-white dark:bg-white dark:text-stone-900 transition flex items-center gap-2 shadow-xs cursor-pointer';
            } else {
                panel.classList.add('hidden');
                btn.className = 'px-4 py-2 rounded-xl text-stone-600 dark:text-stone-400 hover:text-stone-900 hover:bg-stone-100 dark:hover:bg-stone-800 transition flex items-center gap-2 cursor-pointer';
            }
        });

        if (tab === 'wishlist') {
            renderUserWishlist();
        }
    }

    function renderUserWishlist() {
        const container = document.getElementById('userWishlistListContainer');
        if (!container) return;

        let saved = [];
        try {
            saved = JSON.parse(localStorage.getItem('danwisata_wishlist') || '[]');
        } catch (e) {
            saved = [];
        }

        if (saved.length === 0) {
            container.innerHTML = `
                <div class="col-span-full py-8 text-center text-stone-400 space-y-2">
                    <i class="fa-regular fa-heart text-2xl text-stone-300"></i>
                    <p class="text-xs">Belum ada destinasi yang disimpan di wishlist Anda.</p>
                </div>
            `;
            return;
        }

        container.innerHTML = saved.map(item => `
            <div class="rounded-2xl border border-stone-200/80 dark:border-stone-800 overflow-hidden bg-white dark:bg-stone-800/60 p-3 space-y-2.5">
                <img src="${item.image || 'https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=400&q=80'}" alt="${item.name}" class="w-full h-28 object-cover rounded-xl" />
                <div>
                    <h4 class="font-bold text-xs text-stone-900 dark:text-white line-clamp-1">${item.name}</h4>
                    <p class="text-[11px] text-stone-400">${item.location || 'Indonesia'}</p>
                </div>
                <div class="flex items-center justify-between pt-1">
                    <span class="text-xs font-bold text-emerald-600">${item.price ? 'Rp ' + Number(item.price).toLocaleString('id-ID') : 'Rp 0'}</span>
                    <a href="/destinasi/${item.slug || ''}" class="text-[11px] font-semibold text-stone-800 dark:text-stone-200 hover:underline">Lihat →</a>
                </div>
            </div>
        `).join('');
    }

    // Check URL Hash on load
    document.addEventListener('DOMContentLoaded', () => {
        if (window.location.hash === '#reservasi') switchUserTab('reservasi');
        else if (window.location.hash === '#wishlist') switchUserTab('wishlist');
        else if (window.location.hash === '#profil') switchUserTab('profil');
    });
</script>
@endsection
