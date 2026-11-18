@extends('layouts.app')

@section('title', 'Masuk Akun Wisatawan - Danwisata Indonesia')

@section('content')
<section class="min-h-[85vh] py-16 sm:py-24 px-4 sm:px-6 lg:px-8 flex items-center justify-center bg-gradient-to-b from-stone-100/60 via-stone-50 to-white dark:from-stone-950 dark:via-stone-900 dark:to-stone-950">
    <div class="w-full max-w-4xl bg-white dark:bg-stone-900 rounded-3xl border border-stone-200/80 dark:border-stone-800 shadow-[0_20px_50px_rgba(28,25,23,0.08)] overflow-hidden grid grid-cols-1 md:grid-cols-12">
        
        <!-- Kolom Kiri: Visual Editorial Nusantara -->
        <div class="md:col-span-5 relative bg-stone-900 overflow-hidden flex flex-col justify-between p-8 text-white min-h-[260px] md:min-h-full">
            <img 
                src="https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=1000&q=80" 
                alt="Wisata Nusantara" 
                class="absolute inset-0 w-full h-full object-cover filter brightness-[0.82] transition-transform duration-1000 hover:scale-105"
            />
            <div class="absolute inset-0 bg-gradient-to-t from-stone-950/90 via-stone-950/40 to-stone-950/20"></div>

            <div class="relative z-10 flex items-center justify-between">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-white/10 backdrop-blur-md border border-white/15 text-[11px] font-semibold tracking-wider uppercase">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span>
                    <span>Portal Wisatawan</span>
                </span>
            </div>

            <div class="relative z-10 space-y-2 pt-16">
                <span class="text-[11px] text-amber-300 font-mono tracking-widest uppercase">Eksplorasi Pribadi</span>
                <h2 class="text-2xl font-bold tracking-tight text-white leading-snug">
                    Simpan Jejak Petualangan Anda.
                </h2>
                <p class="text-xs text-stone-300 leading-relaxed font-normal">
                    Masuk untuk mengakses E-Tiket reservasi, daftar destinasi tersimpan, dan kurasi perjalanan eksklusif.
                </p>
            </div>
        </div>

        <!-- Kolom Kanan: Formulir Masuk -->
        <div class="md:col-span-7 p-8 sm:p-10 flex flex-col justify-center">
            <div class="w-full max-w-sm mx-auto space-y-6">
                
                <div class="space-y-1">
                    <h1 class="text-2xl font-extrabold text-stone-900 dark:text-white tracking-tight">Masuk ke Danwisata</h1>
                    <p class="text-xs text-stone-500 dark:text-stone-400">Gunakan akun Anda untuk mengelola perjalanan</p>
                </div>

                <!-- Alert Messages -->
                @if (session('success'))
                    <div class="p-3.5 rounded-2xl bg-emerald-50 dark:bg-emerald-950/40 border border-emerald-200 dark:border-emerald-800 text-emerald-800 dark:text-emerald-200 text-xs flex items-center gap-2.5">
                        <i class="fa-solid fa-circle-check text-emerald-500"></i>
                        <span>{{ session('success') }}</span>
                    </div>
                @endif

                @if (session('info'))
                    <div class="p-3.5 rounded-2xl bg-sky-50 dark:bg-sky-950/40 border border-sky-200 dark:border-sky-800 text-sky-800 dark:text-sky-200 text-xs flex items-center gap-2.5">
                        <i class="fa-solid fa-circle-info text-sky-500"></i>
                        <span>{{ session('info') }}</span>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="p-3.5 rounded-2xl bg-rose-50 dark:bg-rose-950/40 border border-rose-200 dark:border-rose-800 text-rose-800 dark:text-rose-200 text-xs space-y-1">
                        <span class="font-semibold flex items-center gap-1.5">
                            <i class="fa-solid fa-triangle-exclamation text-rose-500"></i> Gagal masuk:
                        </span>
                        <p>{{ $errors->first() }}</p>
                    </div>
                @endif

                <form action="{{ route('login.post') }}" method="POST" class="space-y-4">
                    @csrf

                    <div class="space-y-1.5 text-left">
                        <label for="loginEmail" class="block text-xs font-semibold text-stone-700 dark:text-stone-300">Alamat Email</label>
                        <div class="relative">
                            <i class="fa-regular fa-envelope absolute left-3.5 top-1/2 -translate-y-1/2 text-stone-400 text-xs"></i>
                            <input 
                                type="email" 
                                name="email" 
                                id="loginEmail" 
                                value="{{ old('email') }}" 
                                required 
                                autofocus
                                placeholder="nama@email.com" 
                                class="w-full pl-9 pr-3.5 py-2.5 rounded-xl border border-stone-200 dark:border-stone-700 hover:border-stone-300 focus:border-stone-900 dark:focus:border-stone-100 focus:ring-4 focus:ring-stone-900/5 text-xs text-stone-900 dark:text-white placeholder:text-stone-400 bg-white dark:bg-stone-800 transition outline-none font-medium"
                            />
                        </div>
                    </div>

                    <div class="space-y-1.5 text-left">
                        <div class="flex items-center justify-between">
                            <label for="loginPassword" class="block text-xs font-semibold text-stone-700 dark:text-stone-300">Kata Sandi</label>
                            <span class="text-[11px] text-stone-400">Min. 6 Karakter</span>
                        </div>
                        <div class="relative">
                            <i class="fa-solid fa-lock absolute left-3.5 top-1/2 -translate-y-1/2 text-stone-400 text-xs"></i>
                            <input 
                                type="password" 
                                name="password" 
                                id="loginPassword" 
                                required 
                                placeholder="••••••••••••" 
                                class="w-full pl-9 pr-10 py-2.5 rounded-xl border border-stone-200 dark:border-stone-700 hover:border-stone-300 focus:border-stone-900 dark:focus:border-stone-100 focus:ring-4 focus:ring-stone-900/5 text-xs text-stone-900 dark:text-white placeholder:text-stone-400 bg-white dark:bg-stone-800 transition outline-none font-medium"
                            />
                            <button 
                                type="button" 
                                onclick="togglePasswordVisibility('loginPassword', 'eyeIconLogin')" 
                                class="absolute inset-y-0 right-0 pr-3 flex items-center text-stone-400 hover:text-stone-700 dark:hover:text-stone-200 transition cursor-pointer"
                            >
                                <i id="eyeIconLogin" class="fa-regular fa-eye text-xs"></i>
                            </button>
                        </div>
                    </div>

                    <div class="flex items-center justify-between pt-1">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" name="remember" checked class="w-3.5 h-3.5 rounded border-stone-300 text-stone-900 focus:ring-0 cursor-pointer">
                            <span class="text-xs text-stone-600 dark:text-stone-400">Ingat Saya</span>
                        </label>
                    </div>

                    <button 
                        type="submit" 
                        class="w-full py-2.5 px-4 rounded-xl bg-stone-900 hover:bg-stone-800 dark:bg-white dark:hover:bg-stone-100 text-white dark:text-stone-900 font-semibold text-xs tracking-wide shadow-sm hover:shadow active:scale-[0.99] transition-all flex items-center justify-center gap-2 cursor-pointer"
                    >
                        <span>Masuk ke Akun Wisatawan</span>
                        <i class="fa-solid fa-arrow-right text-[10px]"></i>
                    </button>
                </form>

                <div class="text-center pt-2 text-xs text-stone-600 dark:text-stone-400">
                    <span>Belum memiliki akun?</span>
                    <a href="{{ route('register') }}" class="font-bold text-stone-900 dark:text-white hover:underline ml-1">
                        Daftar sekarang
                    </a>
                </div>

                <!-- Admin Link Notice -->
                <div class="pt-4 border-t border-stone-100 dark:border-stone-800 flex items-center justify-between text-[11px] text-stone-500">
                    <span class="flex items-center gap-1.5">
                        <i class="fa-solid fa-shield-halved text-stone-400"></i>
                        <span>Pengelola Sistem?</span>
                    </span>
                    <a href="{{ env('ADMIN_URL', 'http://localhost:8001') }}/login" target="_blank" class="font-semibold text-emerald-600 dark:text-emerald-400 hover:underline">
                        Masuk Portal Admin →
                    </a>
                </div>

            </div>
        </div>

    </div>
</section>

<script>
    function togglePasswordVisibility(inputId, iconId) {
        const input = document.getElementById(inputId);
        const icon = document.getElementById(iconId);
        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            input.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    }
</script>
@endsection
