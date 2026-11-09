@extends('admin.layouts.app')

@section('title', 'Manajemen Destinasi Wisata | Admin DANWISATA')
@section('page_title', 'Kelola Destinasi Wisata')
@section('page_description', 'Tambah, edit, dan perbarui destinasi eksotis di seluruh 38 provinsi Indonesia.')

@section('header_actions')
    <a href="{{ route('admin.destinations.create') }}" class="px-3.5 py-1.5 rounded-full bg-stone-900 text-white dark:bg-stone-100 dark:text-stone-900 text-xs font-semibold hover:opacity-90 flex items-center gap-1.5 shadow-xs transition-opacity">
        <i class="fa-solid fa-plus text-[10px]"></i>
        <span>Tambah Destinasi Baru</span>
    </a>
@endsection

@section('content')
<div class="space-y-6">
    <!-- Filter & Search Bar -->
    <div class="bg-white dark:bg-stone-900 rounded-2xl p-4 border border-stone-200/90 dark:border-stone-800 shadow-xs">
        <form method="GET" action="{{ route('admin.destinations.index') }}" class="grid grid-cols-1 sm:grid-cols-12 gap-3 items-center">
            <div class="sm:col-span-5 relative">
                <i class="fa-solid fa-magnifying-glass absolute left-3.5 top-1/2 -translate-y-1/2 text-stone-400 text-xs"></i>
                <input 
                    type="text" 
                    name="search" 
                    value="{{ request('search') }}" 
                    placeholder="Cari destinasi, lokasi, atau wilayah..." 
                    class="w-full pl-9 pr-3 py-2 rounded-xl bg-stone-50 dark:bg-stone-800 border border-stone-200 dark:border-stone-700 text-xs focus:ring-1 focus:ring-stone-900 focus:outline-none"
                >
            </div>
            <div class="sm:col-span-3">
                <select name="category" onchange="this.form.submit()" class="w-full px-3 py-2 rounded-xl bg-stone-50 dark:bg-stone-800 border border-stone-200 dark:border-stone-700 text-xs font-semibold focus:ring-1 focus:ring-stone-900 focus:outline-none">
                    <option value="all">Semua Kategori</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                    @endforeach
                </select>
            </div>
            <div class="sm:col-span-3">
                <select name="region" onchange="this.form.submit()" class="w-full px-3 py-2 rounded-xl bg-stone-50 dark:bg-stone-800 border border-stone-200 dark:border-stone-700 text-xs font-semibold focus:ring-1 focus:ring-stone-900 focus:outline-none">
                    <option value="all">Semua Wilayah</option>
                    @foreach($regions as $reg)
                        <option value="{{ $reg }}" {{ request('region') == $reg ? 'selected' : '' }}>{{ $reg }}</option>
                    @endforeach
                </select>
            </div>
            <div class="sm:col-span-1 flex items-center gap-1.5">
                <button type="submit" class="w-full py-2 rounded-xl bg-stone-900 text-white dark:bg-stone-100 dark:text-stone-900 text-xs font-semibold hover:opacity-90">
                    Cari
                </button>
            </div>
        </form>
    </div>

    <!-- Destinations Grid / Table -->
    <div class="bg-white dark:bg-stone-900 rounded-3xl border border-stone-200/90 dark:border-stone-800 shadow-xs overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="bg-stone-50 dark:bg-stone-800/60 text-stone-400 uppercase tracking-wider text-[10px] font-bold border-b border-stone-200 dark:border-stone-800">
                    <tr>
                        <th class="py-3.5 px-5">Destinasi</th>
                        <th class="py-3.5 px-5">Wilayah & Lokasi</th>
                        <th class="py-3.5 px-5">Kategori</th>
                        <th class="py-3.5 px-5">Biaya / Durasi</th>
                        <th class="py-3.5 px-5">Rating & Review</th>
                        <th class="py-3.5 px-5">Status</th>
                        <th class="py-3.5 px-5 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-stone-100 dark:divide-stone-800 text-stone-700 dark:text-stone-300">
                    @forelse($destinations as $dest)
                        <tr class="hover:bg-stone-50/70 dark:hover:bg-stone-800/40 transition-colors">
                            <td class="py-3.5 px-5">
                                <div class="flex items-center gap-3">
                                    <img 
                                        src="{{ $dest->image }}" 
                                        alt="{{ $dest->name }}" 
                                        onerror="this.src='https://placehold.co/100x100/262019/ffffff?text=DW'" 
                                        class="w-12 h-12 rounded-xl object-cover shrink-0 bg-stone-100"
                                    >
                                    <div class="min-w-0 max-w-xs">
                                        <p class="font-bold text-stone-900 dark:text-white truncate">{{ $dest->name }}</p>
                                        <p class="text-[10px] text-stone-400 truncate">Waktu: {{ $dest->best_time }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="py-3.5 px-5 max-w-xs">
                                <p class="font-semibold text-stone-900 dark:text-stone-200 truncate">{{ $dest->region }}</p>
                                <p class="text-[10px] text-stone-400 truncate">{{ $dest->location }}</p>
                            </td>
                            <td class="py-3.5 px-5 whitespace-nowrap">
                                <span class="px-2 py-0.5 rounded-full text-[10px] font-semibold bg-stone-100 dark:bg-stone-800 text-stone-700 dark:text-stone-300 border border-stone-200 dark:border-stone-700">
                                    {{ $dest->category }}
                                </span>
                            </td>
                            <td class="py-3.5 px-5 whitespace-nowrap">
                                <p class="font-bold text-stone-900 dark:text-white">{{ $dest->formatted_price }}</p>
                                <p class="text-[10px] text-stone-400">{{ $dest->duration }}</p>
                            </td>
                            <td class="py-3.5 px-5 whitespace-nowrap">
                                <span class="font-bold text-stone-900 dark:text-white flex items-center gap-1">
                                    <i class="fa-solid fa-star text-amber-400 text-[10px]"></i>
                                    <span>{{ number_format($dest->rating, 2) }}</span>
                                </span>
                                <span class="text-[10px] text-stone-400">{{ $dest->reviews_count }} catatan</span>
                            </td>
                            <td class="py-3.5 px-5 whitespace-nowrap">
                                @if($dest->is_featured)
                                    <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-amber-100 text-amber-800 dark:bg-amber-950/60 dark:text-amber-300">
                                        Unggulan
                                    </span>
                                @else
                                    <span class="px-2 py-0.5 rounded-full text-[10px] font-medium bg-stone-100 text-stone-500 dark:bg-stone-800 dark:text-stone-400">
                                        Standar
                                    </span>
                                @endif
                            </td>
                            <td class="py-3.5 px-5 text-right whitespace-nowrap">
                                <div class="flex items-center justify-end gap-1.5">
                                    <a href="{{ route('destinations.show', $dest->slug) }}" target="_blank" class="p-2 rounded-lg bg-stone-100 hover:bg-stone-200 dark:bg-stone-800 dark:hover:bg-stone-700 text-stone-600 dark:text-stone-300 text-xs transition-colors" title="Lihat di Web">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.destinations.edit', $dest->id) }}" class="p-2 rounded-lg bg-amber-50 hover:bg-amber-100 dark:bg-amber-950/40 dark:hover:bg-amber-900/60 text-amber-700 dark:text-amber-300 text-xs transition-colors" title="Edit Destinasi">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <form method="POST" action="{{ route('admin.destinations.destroy', $dest->id) }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus destinasi {{ $dest->name }}?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 rounded-lg text-stone-400 hover:text-rose-600 hover:bg-rose-50 dark:hover:bg-rose-950/40 text-xs transition-colors" title="Hapus Destinasi">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-12 text-center text-stone-400 text-xs">
                                <p class="font-medium">Tidak ada destinasi yang sesuai.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($destinations->hasPages())
            <div class="p-4 border-t border-stone-100 dark:border-stone-800">
                {{ $destinations->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
