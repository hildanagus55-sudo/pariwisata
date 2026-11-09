@extends('admin.layouts.app')

@section('title', 'Edit Destinasi: ' . $destination->name . ' | Admin DANWISATA')
@section('page_title', 'Perbarui Destinasi: ' . $destination->name)
@section('page_description', 'Ubah detail rute, harga, gambar, serta deskripsi destinasi.')

@section('header_actions')
    <a href="{{ route('admin.destinations.index') }}" class="px-3.5 py-1.5 rounded-full border border-stone-200 dark:border-stone-700 text-stone-600 dark:text-stone-300 text-xs font-semibold hover:bg-stone-100 dark:hover:bg-stone-800 transition-colors flex items-center gap-1.5">
        <i class="fa-solid fa-arrow-left text-[10px]"></i>
        <span>Kembali ke Daftar</span>
    </a>
@endsection

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white dark:bg-stone-900 rounded-3xl p-6 sm:p-8 border border-stone-200/90 dark:border-stone-800 shadow-sm">
        <form method="POST" action="{{ route('admin.destinations.update', $destination->id) }}" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Section 1: Informasi Dasar -->
            <div>
                <h3 class="font-serif text-base font-bold text-stone-900 dark:text-white mb-4 pb-2 border-b border-stone-100 dark:border-stone-800">
                    Informasi Destinasi
                </h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="sm:col-span-2">
                        <label class="block text-xs font-bold uppercase tracking-wider text-stone-600 dark:text-stone-300 mb-1.5">
                            Nama Destinasi <span class="text-rose-500">*</span>
                        </label>
                        <input 
                            type="text" 
                            name="name" 
                            value="{{ old('name', $destination->name) }}" 
                            required 
                            class="w-full px-4 py-2.5 rounded-xl bg-stone-50 dark:bg-stone-800 border border-stone-200 dark:border-stone-700 text-xs focus:ring-1 focus:ring-stone-900 focus:outline-none"
                        >
                    </div>

                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-stone-600 dark:text-stone-300 mb-1.5">
                            Wilayah / Provinsi <span class="text-rose-500">*</span>
                        </label>
                        <select name="region" required class="w-full px-4 py-2.5 rounded-xl bg-stone-50 dark:bg-stone-800 border border-stone-200 dark:border-stone-700 text-xs focus:ring-1 focus:ring-stone-900 focus:outline-none">
                            <option value="">Pilih Provinsi / Wilayah</option>
                            @foreach($regions as $reg)
                                <option value="{{ $reg }}" {{ old('region', $destination->region) == $reg ? 'selected' : '' }}>{{ $reg }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-stone-600 dark:text-stone-300 mb-1.5">
                            Kategori Wisata <span class="text-rose-500">*</span>
                        </label>
                        <select name="category" required class="w-full px-4 py-2.5 rounded-xl bg-stone-50 dark:bg-stone-800 border border-stone-200 dark:border-stone-700 text-xs focus:ring-1 focus:ring-stone-900 focus:outline-none">
                            <option value="">Pilih Kategori</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat }}" {{ old('category', $destination->category) == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="sm:col-span-2">
                        <label class="block text-xs font-bold uppercase tracking-wider text-stone-600 dark:text-stone-300 mb-1.5">
                            Lokasi Lengkap <span class="text-rose-500">*</span>
                        </label>
                        <input 
                            type="text" 
                            name="location" 
                            value="{{ old('location', $destination->location) }}" 
                            required 
                            class="w-full px-4 py-2.5 rounded-xl bg-stone-50 dark:bg-stone-800 border border-stone-200 dark:border-stone-700 text-xs focus:ring-1 focus:ring-stone-900 focus:outline-none"
                        >
                    </div>
                </div>
            </div>

            <!-- Section 2: Biaya & Waktu -->
            <div>
                <h3 class="font-serif text-base font-bold text-stone-900 dark:text-white mb-4 pb-2 border-b border-stone-100 dark:border-stone-800">
                    Biaya & Waktu Perjalanan
                </h3>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-stone-600 dark:text-stone-300 mb-1.5">
                            Harga per Orang (Rp) <span class="text-rose-500">*</span>
                        </label>
                        <input 
                            type="number" 
                            name="price" 
                            value="{{ old('price', $destination->price) }}" 
                            required 
                            min="0" 
                            step="50000" 
                            class="w-full px-4 py-2.5 rounded-xl bg-stone-50 dark:bg-stone-800 border border-stone-200 dark:border-stone-700 text-xs focus:ring-1 focus:ring-stone-900 focus:outline-none"
                        >
                    </div>

                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-stone-600 dark:text-stone-300 mb-1.5">
                            Durasi Trip <span class="text-rose-500">*</span>
                        </label>
                        <input 
                            type="text" 
                            name="duration" 
                            value="{{ old('duration', $destination->duration) }}" 
                            required 
                            class="w-full px-4 py-2.5 rounded-xl bg-stone-50 dark:bg-stone-800 border border-stone-200 dark:border-stone-700 text-xs focus:ring-1 focus:ring-stone-900 focus:outline-none"
                        >
                    </div>

                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-stone-600 dark:text-stone-300 mb-1.5">
                            Waktu Terbaik Berkunjung <span class="text-rose-500">*</span>
                        </label>
                        <input 
                            type="text" 
                            name="best_time" 
                            value="{{ old('best_time', $destination->best_time) }}" 
                            required 
                            class="w-full px-4 py-2.5 rounded-xl bg-stone-50 dark:bg-stone-800 border border-stone-200 dark:border-stone-700 text-xs focus:ring-1 focus:ring-stone-900 focus:outline-none"
                        >
                    </div>
                </div>
            </div>

            <!-- Section 3: Gambar & Konten -->
            <div>
                <h3 class="font-serif text-base font-bold text-stone-900 dark:text-white mb-4 pb-2 border-b border-stone-100 dark:border-stone-800">
                    Media & Narasi Destinasi
                </h3>
                <div class="space-y-4">
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-stone-600 dark:text-stone-300 mb-1.5">
                            URL Gambar Sampul <span class="text-rose-500">*</span>
                        </label>
                        <input 
                            type="url" 
                            name="image" 
                            id="imageUrlInput"
                            value="{{ old('image', $destination->image) }}" 
                            required 
                            class="w-full px-4 py-2.5 rounded-xl bg-stone-50 dark:bg-stone-800 border border-stone-200 dark:border-stone-700 text-xs focus:ring-1 focus:ring-stone-900 focus:outline-none"
                            onchange="previewImage(this.value)"
                        >
                        <div id="imagePreviewContainer" class="mt-2">
                            <img id="imagePreview" src="{{ $destination->image }}" alt="Pratinjau Gambar" class="h-40 rounded-xl object-cover border border-stone-200 dark:border-stone-700">
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-stone-600 dark:text-stone-300 mb-1.5">
                            Deskripsi Destinasi <span class="text-rose-500">*</span>
                        </label>
                        <textarea 
                            name="description" 
                            rows="4" 
                            required 
                            class="w-full px-4 py-2.5 rounded-xl bg-stone-50 dark:bg-stone-800 border border-stone-200 dark:border-stone-700 text-xs focus:ring-1 focus:ring-stone-900 focus:outline-none leading-relaxed"
                        >{{ old('description', $destination->description) }}</textarea>
                    </div>

                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-stone-600 dark:text-stone-300 mb-1.5">
                            Highlights Wisata (Pisahkan dengan baris baru / Enter)
                        </label>
                        @php
                            $highlightsText = is_array($destination->highlights) ? implode("\n", $destination->highlights) : ($destination->highlights ?? '');
                        @endphp
                        <textarea 
                            name="highlights" 
                            rows="3" 
                            class="w-full px-4 py-2.5 rounded-xl bg-stone-50 dark:bg-stone-800 border border-stone-200 dark:border-stone-700 text-xs focus:ring-1 focus:ring-stone-900 focus:outline-none leading-relaxed"
                        >{{ old('highlights', $highlightsText) }}</textarea>
                    </div>

                    <div class="flex items-center gap-2 pt-2">
                        <input type="checkbox" id="is_featured" name="is_featured" value="1" {{ old('is_featured', $destination->is_featured) ? 'checked' : '' }} class="w-4 h-4 rounded text-stone-900 border-stone-300 dark:border-stone-700 focus:ring-stone-900">
                        <label for="is_featured" class="text-xs font-semibold text-stone-800 dark:text-stone-200 cursor-pointer">
                            Tandai sebagai Destinasi Unggulan (Tampil di Beranda Utama)
                        </label>
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="pt-5 border-t border-stone-100 dark:border-stone-800 flex items-center justify-end gap-3">
                <a href="{{ route('admin.destinations.index') }}" class="px-5 py-2.5 rounded-xl border border-stone-200 dark:border-stone-700 text-xs font-semibold text-stone-600 dark:text-stone-300 hover:bg-stone-50 dark:hover:bg-stone-800 transition-colors">
                    Batal
                </a>
                <button type="submit" class="px-6 py-2.5 rounded-xl bg-stone-900 text-white dark:bg-stone-100 dark:text-stone-900 text-xs font-bold hover:opacity-90 shadow-sm transition-opacity flex items-center gap-2">
                    <i class="fa-solid fa-check text-xs"></i>
                    <span>Perbarui Destinasi</span>
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function previewImage(url) {
        const container = document.getElementById('imagePreviewContainer');
        const img = document.getElementById('imagePreview');
        if (url && url.startsWith('http')) {
            img.src = url;
            container.classList.remove('hidden');
        } else {
            container.classList.add('hidden');
        }
    }
</script>
@endsection
