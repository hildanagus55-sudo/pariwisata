@extends('admin.layouts.app')

@section('title', 'Tambah Paket Tour Baru | Admin DANWISATA')
@section('page_title', 'Tambah Paket Tour Baru')
@section('page_description', 'Rancang paket liburan all-inclusive, open trip, atau luxury voyage baru.')

@section('header_actions')
    <a href="{{ route('admin.packages.index') }}" class="px-3.5 py-1.5 rounded-full border border-stone-200 dark:border-stone-700 text-stone-600 dark:text-stone-300 text-xs font-semibold hover:bg-stone-100 dark:hover:bg-stone-800 transition-colors flex items-center gap-1.5">
        <i class="fa-solid fa-arrow-left text-[10px]"></i>
        <span>Kembali ke Daftar</span>
    </a>
@endsection

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="bg-white dark:bg-stone-900 rounded-3xl p-6 sm:p-8 border border-stone-200/90 dark:border-stone-800 shadow-sm">
        <form method="POST" action="{{ route('admin.packages.store') }}" class="space-y-6">
            @csrf

            <div>
                <h3 class="font-serif text-base font-bold text-stone-900 dark:text-white mb-4 pb-2 border-b border-stone-100 dark:border-stone-800">
                    Informasi Paket Wisata
                </h3>
                <div class="space-y-4">
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-stone-600 dark:text-stone-300 mb-1.5">
                            Nama Paket Tour <span class="text-rose-500">*</span>
                        </label>
                        <input 
                            type="text" 
                            name="name" 
                            value="{{ old('name') }}" 
                            required 
                            placeholder="Contoh: Ekspedisi Komodo Phinisi Luxury" 
                            class="w-full px-4 py-2.5 rounded-xl bg-stone-50 dark:bg-stone-800 border border-stone-200 dark:border-stone-700 text-xs focus:ring-1 focus:ring-stone-900 focus:outline-none"
                        >
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-stone-600 dark:text-stone-300 mb-1.5">
                                Label / Badge Highlight <span class="text-rose-500">*</span>
                            </label>
                            <input 
                                type="text" 
                                name="badge" 
                                value="{{ old('badge', 'Best Seller') }}" 
                                required 
                                placeholder="Contoh: Best Seller, Signature Trip, Private Yacht" 
                                class="w-full px-4 py-2.5 rounded-xl bg-stone-50 dark:bg-stone-800 border border-stone-200 dark:border-stone-700 text-xs focus:ring-1 focus:ring-stone-900 focus:outline-none"
                            >
                        </div>

                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-stone-600 dark:text-stone-300 mb-1.5">
                                Durasi Tour <span class="text-rose-500">*</span>
                            </label>
                            <input 
                                type="text" 
                                name="duration" 
                                value="{{ old('duration', '3H2M') }}" 
                                required 
                                placeholder="Contoh: 3H2M atau 4 Hari 3 Malam" 
                                class="w-full px-4 py-2.5 rounded-xl bg-stone-50 dark:bg-stone-800 border border-stone-200 dark:border-stone-700 text-xs focus:ring-1 focus:ring-stone-900 focus:outline-none"
                            >
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-stone-600 dark:text-stone-300 mb-1.5">
                            Akomodasi / Penginapan <span class="text-rose-500">*</span>
                        </label>
                        <input 
                            type="text" 
                            name="hotel" 
                            value="{{ old('hotel', 'Kapal Phinisi AC Privat & Resort') }}" 
                            required 
                            placeholder="Contoh: Resort Bintang 5 / Luxury Phinisi Cabin" 
                            class="w-full px-4 py-2.5 rounded-xl bg-stone-50 dark:bg-stone-800 border border-stone-200 dark:border-stone-700 text-xs focus:ring-1 focus:ring-stone-900 focus:outline-none"
                        >
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-stone-600 dark:text-stone-300 mb-1.5">
                                Harga Promo / Paket (Rp) <span class="text-rose-500">*</span>
                            </label>
                            <input 
                                type="number" 
                                name="price" 
                                value="{{ old('price', 4850000) }}" 
                                required 
                                min="0" 
                                step="50000" 
                                class="w-full px-4 py-2.5 rounded-xl bg-stone-50 dark:bg-stone-800 border border-stone-200 dark:border-stone-700 text-xs focus:ring-1 focus:ring-stone-900 focus:outline-none"
                            >
                        </div>

                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-stone-600 dark:text-stone-300 mb-1.5">
                                Harga Coret / Normal (Rp) <span class="text-stone-400 font-normal">(Opsional)</span>
                            </label>
                            <input 
                                type="number" 
                                name="original_price" 
                                value="{{ old('original_price', 6500000) }}" 
                                min="0" 
                                step="50000" 
                                class="w-full px-4 py-2.5 rounded-xl bg-stone-50 dark:bg-stone-800 border border-stone-200 dark:border-stone-700 text-xs focus:ring-1 focus:ring-stone-900 focus:outline-none"
                            >
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-stone-600 dark:text-stone-300 mb-1.5">
                            Fasilitas Termasuk (Pisahkan dengan baris baru / Enter) <span class="text-rose-500">*</span>
                        </label>
                        <textarea 
                            name="facilities" 
                            rows="4" 
                            required 
                            placeholder="Tiket Masuk & Konservasi TN Komodo&#10;Kapal Phinisi Cabin AC & Dokumentasi Drone&#10;Makan 3x Sehari Ala Chef Lokal&#10;Peralatan Snorkeling Lengkap" 
                            class="w-full px-4 py-2.5 rounded-xl bg-stone-50 dark:bg-stone-800 border border-stone-200 dark:border-stone-700 text-xs focus:ring-1 focus:ring-stone-900 focus:outline-none leading-relaxed"
                        >{{ old('facilities') }}</textarea>
                    </div>

                    <div class="flex items-center gap-2 pt-2">
                        <input type="checkbox" id="is_featured" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }} class="w-4 h-4 rounded text-stone-900 border-stone-300 dark:border-stone-700 focus:ring-stone-900">
                        <label for="is_featured" class="text-xs font-semibold text-stone-800 dark:text-stone-200 cursor-pointer">
                            Tandai sebagai Paket Unggulan (Tampil di Beranda Utama)
                        </label>
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="pt-5 border-t border-stone-100 dark:border-stone-800 flex items-center justify-end gap-3">
                <a href="{{ route('admin.packages.index') }}" class="px-5 py-2.5 rounded-xl border border-stone-200 dark:border-stone-700 text-xs font-semibold text-stone-600 dark:text-stone-300 hover:bg-stone-50 dark:hover:bg-stone-800 transition-colors">
                    Batal
                </a>
                <button type="submit" class="px-6 py-2.5 rounded-xl bg-stone-900 text-white dark:bg-stone-100 dark:text-stone-900 text-xs font-bold hover:opacity-90 shadow-sm transition-opacity flex items-center gap-2">
                    <i class="fa-solid fa-check text-xs"></i>
                    <span>Simpan Paket Tour</span>
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
