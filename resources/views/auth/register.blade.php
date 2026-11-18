@extends('layouts.app')

@section('title', 'Daftar Akun Wisatawan - Danwisata Indonesia')

@section('content')
<section class="min-h-[85vh] py-16 sm:py-24 px-4 sm:px-6 lg:px-8 flex items-center justify-center bg-gradient-to-b from-stone-100/60 via-stone-50 to-white dark:from-stone-950 dark:via-stone-900 dark:to-stone-950">
    <div class="w-full max-w-4xl bg-white dark:bg-stone-900 rounded-3xl border border-stone-200/80 dark:border-stone-800 shadow-[0_20px_50px_rgba(28,25,23,0.08)] overflow-hidden grid grid-cols-1 md:grid-cols-12">
        
        <!-- Kolom Kiri: Visual Editorial Nusantara -->
        <div class="md:col-span-5 relative bg-stone-900 overflow-hidden flex flex-col justify-between p-8 text-white min-h-[260px] md:min-h-full">
            <img 
                src="https://images.unsplash.com/photo-1518548419970-58e3b4079ab2?auto=format&fit=crop&w=1000&q=80" 
                alt="Eksplorasi Danwisata" 
                class="absolute inset-0 w-full h-full object-cover filter brightness-[0.80] transition-transform duration-1000 hover:scale-105"
            />
            <div class="absolute inset-0 bg-gradient-to-t from-stone-950/90 via-stone-950/40 to-stone-950/20"></div>

            <div class="relative z-10 flex items-center justify-between">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-white/10 backdrop-blur-md border border-white/15 text-[11px] font-semibold tracking-wider uppercase">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span>
                    <span>Registrasi Wisatawan</span>
                </span>
            </div>

            <div class="relative z-10 space-y-2 pt-16">
                <span class="text-[11px] text-amber-300 font-mono tracking-widest uppercase">Keanggotaan Tamu</span>
                <h2 class="text-2xl font-bold tracking-tight text-white leading-snug">
                    Mulai Perjalanan Istimewa Anda.
                </h2>
                <p class="text-xs text-stone-300 leading-relaxed font-normal">
                    Bergabung bersama ribuan wisatawan yang menikmati kemudahan pemesanan tiket privat, rekomendasi kurasi, dan riwayat perjalanan dalam genggaman.
                </p>
                <div class="pt-3 border-t border-white/15 text-[11px] text-stone-300/90 flex items-center gap-2">
                    <i class="fa-solid fa-lock text-amber-300"></i>
                    <span>Akun Administrator hanya dapat dibuat oleh Super Admin.</span>
                </div>
            </div>
        </div>

        <!-- Kolom Kanan: Formulir Pendaftaran -->
        <div class="md:col-span-7 p-8 sm:p-10 flex flex-col justify-center">
            <div class="w-full max-w-sm mx-auto space-y-5">
                
                <div class="space-y-1">
                    <h1 class="text-2xl font-extrabold text-stone-900 dark:text-white tracking-tight">Buat Akun Wisatawan</h1>
                    <p class="text-xs text-stone-500 dark:text-stone-400">Lengkapi data Anda untuk mendaftar akun baru</p>
                </div>

                @if ($errors->any())
                    <div class="p-3.5 rounded-2xl bg-rose-50 dark:bg-rose-950/40 border border-rose-200 dark:border-rose-800 text-rose-800 dark:text-rose-200 text-xs space-y-1">
                        <span class="font-semibold flex items-center gap-1.5">
                            <i class="fa-solid fa-triangle-exclamation text-rose-500"></i> Pendaftaran belum berhasil:
                        </span>
                        <p>{{ $errors->first() }}</p>
                    </div>
                @endif

                <form action="{{ route('register.post') }}" method="POST" class="space-y-3.5">
                    @csrf

                    <!-- Nama Lengkap -->
                    <div class="space-y-1 text-left">
                        <label for="regName" class="block text-xs font-semibold text-stone-700 dark:text-stone-300">Nama Lengkap</label>
                        <div class="relative">
                            <i class="fa-regular fa-user absolute left-3.5 top-1/2 -translate-y-1/2 text-stone-400 text-xs"></i>
                            <input 
                                type="text" 
                                name="name" 
                                id="regName" 
                                value="{{ old('name') }}" 
                                required 
                                autofocus
                                placeholder="Contoh: Arya Danendra" 
                                class="w-full pl-9 pr-3.5 py-2.5 rounded-xl border border-stone-200 dark:border-stone-700 hover:border-stone-300 focus:border-stone-900 dark:focus:border-stone-100 focus:ring-4 focus:ring-stone-900/5 text-xs text-stone-900 dark:text-white placeholder:text-stone-400 bg-white dark:bg-stone-800 transition outline-none font-medium"
                            />
                        </div>
                    </div>

                    <!-- Alamat Email -->
                    <div class="space-y-1 text-left">
                        <label for="regEmail" class="block text-xs font-semibold text-stone-700 dark:text-stone-300">Alamat Email</label>
                        <div class="relative">
                            <i class="fa-regular fa-envelope absolute left-3.5 top-1/2 -translate-y-1/2 text-stone-400 text-xs"></i>
                            <input 
                                type="email" 
                                name="email" 
                                id="regEmail" 
                                value="{{ old('email') }}" 
                                required 
                                placeholder="nama@email.com" 
                                class="w-full pl-9 pr-3.5 py-2.5 rounded-xl border border-stone-200 dark:border-stone-700 hover:border-stone-300 focus:border-stone-900 dark:focus:border-stone-100 focus:ring-4 focus:ring-stone-900/5 text-xs text-stone-900 dark:text-white placeholder:text-stone-400 bg-white dark:bg-stone-800 transition outline-none font-medium"
                            />
                        </div>
                    </div>

                    <!-- Nomor WhatsApp / Telepon -->
                    <div class="space-y-1 text-left">
                        <label for="regPhone" class="block text-xs font-semibold text-stone-700 dark:text-stone-300">Nomor WhatsApp / Kontak (Opsional)</label>
                        <div class="relative">
                            <i class="fa-brands fa-whatsapp absolute left-3.5 top-1/2 -translate-y-1/2 text-stone-400 text-xs"></i>
                            <input 
                                type="text" 
                                name="phone" 
                                id="regPhone" 
                                value="{{ old('phone') }}" 
                                placeholder="Contoh: 081234567890" 
                                class="w-full pl-9 pr-3.5 py-2.5 rounded-xl border border-stone-200 dark:border-stone-700 hover:border-stone-300 focus:border-stone-900 dark:focus:border-stone-100 focus:ring-4 focus:ring-stone-900/5 text-xs text-stone-900 dark:text-white placeholder:text-stone-400 bg-white dark:bg-stone-800 transition outline-none font-medium"
                            />
                        </div>
                    </div>

                    <!-- Kata Sandi -->
                    <div class="space-y-1 text-left">
                        <label for="regPassword" class="block text-xs font-semibold text-stone-700 dark:text-stone-300">Kata Sandi</label>
                        <div class="relative">
                            <i class="fa-solid fa-lock absolute left-3.5 top-1/2 -translate-y-1/2 text-stone-400 text-xs"></i>
                            <input 
                                type="password" 
                                name="password" 
                                id="regPassword" 
                                required 
                                placeholder="Minimal 6 karakter" 
                                class="w-full pl-9 pr-3.5 py-2.5 rounded-xl border border-stone-200 dark:border-stone-700 hover:border-stone-300 focus:border-stone-900 dark:focus:border-stone-100 focus:ring-4 focus:ring-stone-900/5 text-xs text-stone-900 dark:text-white placeholder:text-stone-400 bg-white dark:bg-stone-800 transition outline-none font-medium"
                            />
                        </div>
                    </div>

                    <!-- Konfirmasi Kata Sandi -->
                    <div class="space-y-1 text-left">
                        <label for="regPasswordConfirmation" class="block text-xs font-semibold text-stone-700 dark:text-stone-300">Konfirmasi Kata Sandi</label>
                        <div class="relative">
                            <i class="fa-solid fa-shield-halved absolute left-3.5 top-1/2 -translate-y-1/2 text-stone-400 text-xs"></i>
                            <input 
                                type="password" 
                                name="password_confirmation" 
                                id="regPasswordConfirmation" 
                                required 
                                placeholder="Ulangi kata sandi Anda" 
                                class="w-full pl-9 pr-3.5 py-2.5 rounded-xl border border-stone-200 dark:border-stone-700 hover:border-stone-300 focus:border-stone-900 dark:focus:border-stone-100 focus:ring-4 focus:ring-stone-900/5 text-xs text-stone-900 dark:text-white placeholder:text-stone-400 bg-white dark:bg-stone-800 transition outline-none font-medium"
                            />
                        </div>
                    </div>

                    <div class="pt-1">
                        <button 
                            type="submit" 
                            class="w-full py-2.5 px-4 rounded-xl bg-stone-900 hover:bg-stone-800 dark:bg-white dark:hover:bg-stone-100 text-white dark:text-stone-900 font-semibold text-xs tracking-wide shadow-sm hover:shadow active:scale-[0.99] transition-all flex items-center justify-center gap-2 cursor-pointer"
                        >
                            <span>Daftar Akun Wisatawan</span>
                            <i class="fa-solid fa-arrow-right text-[10px]"></i>
                        </button>
                    </div>
                </form>

                <div class="text-center pt-2 text-xs text-stone-600 dark:text-stone-400">
                    <span>Sudah memiliki akun?</span>
                    <a href="{{ route('login') }}" class="font-bold text-stone-900 dark:text-white hover:underline ml-1">
                        Masuk di sini
                    </a>
                </div>

            </div>
        </div>

    </div>
</section>
@endsection
