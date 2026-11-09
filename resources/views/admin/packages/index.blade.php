@extends('admin.layouts.app')

@section('title', 'Manajemen Paket Perjalanan | Admin DANWISATA')
@section('page_title', 'Kelola Paket Perjalanan')
@section('page_description', 'Atur penawaran open trip, private yacht trip, dan paket liburan nusantara.')

@section('header_actions')
    <a href="{{ route('admin.packages.create') }}" class="px-3.5 py-1.5 rounded-full bg-stone-900 text-white dark:bg-stone-100 dark:text-stone-900 text-xs font-semibold hover:opacity-90 flex items-center gap-1.5 shadow-xs transition-opacity">
        <i class="fa-solid fa-plus text-[10px]"></i>
        <span>Tambah Paket Baru</span>
    </a>
@endsection

@section('content')
<div class="space-y-6">
    <!-- Search Bar -->
    <div class="bg-white dark:bg-stone-900 rounded-2xl p-4 border border-stone-200/90 dark:border-stone-800 shadow-xs flex flex-col sm:flex-row items-center justify-between gap-3">
        <form method="GET" action="{{ route('admin.packages.index') }}" class="flex-1 flex gap-2.5 w-full sm:w-auto">
            <div class="relative flex-1 max-w-md">
                <i class="fa-solid fa-magnifying-glass absolute left-3.5 top-1/2 -translate-y-1/2 text-stone-400 text-xs"></i>
                <input 
                    type="text" 
                    name="search" 
                    value="{{ request('search') }}" 
                    placeholder="Cari nama paket, hotel, badge..." 
                    class="w-full pl-9 pr-3 py-2 rounded-xl bg-stone-50 dark:bg-stone-800 border border-stone-200 dark:border-stone-700 text-xs focus:ring-1 focus:ring-stone-900 focus:outline-none"
                >
            </div>
            <button type="submit" class="px-5 py-2 rounded-xl bg-stone-900 text-white dark:bg-stone-100 dark:text-stone-900 text-xs font-semibold hover:opacity-90 transition-opacity">
                Cari
            </button>
            @if(request('search'))
                <a href="{{ route('admin.packages.index') }}" class="px-3 py-2 rounded-xl border border-stone-200 dark:border-stone-700 text-xs font-semibold text-stone-500 hover:text-stone-900 dark:hover:text-white transition-colors">
                    Reset
                </a>
            @endif
        </form>
    </div>

    <!-- Table Card -->
    <div class="bg-white dark:bg-stone-900 rounded-3xl border border-stone-200/90 dark:border-stone-800 shadow-xs overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="bg-stone-50 dark:bg-stone-800/60 text-stone-400 uppercase tracking-wider text-[10px] font-bold border-b border-stone-200 dark:border-stone-800">
                    <tr>
                        <th class="py-3.5 px-5">Nama Paket Tour</th>
                        <th class="py-3.5 px-5">Badge Tag</th>
                        <th class="py-3.5 px-5">Durasi & Hotel</th>
                        <th class="py-3.5 px-5">Harga Paket</th>
                        <th class="py-3.5 px-5">Fasilitas Utama</th>
                        <th class="py-3.5 px-5">Status</th>
                        <th class="py-3.5 px-5 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-stone-100 dark:divide-stone-800 text-stone-700 dark:text-stone-300">
                    @forelse($packages as $package)
                        <tr class="hover:bg-stone-50/70 dark:hover:bg-stone-800/40 transition-colors">
                            <td class="py-4 px-5">
                                <p class="font-bold text-stone-900 dark:text-white">{{ $package->name }}</p>
                                <span class="text-[10px] text-stone-400 font-mono">/paket/{{ $package->slug }}</span>
                            </td>
                            <td class="py-4 px-5 whitespace-nowrap">
                                <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-amber-100 dark:bg-amber-950/60 text-amber-800 dark:text-amber-300 border border-amber-200 dark:border-amber-800/60">
                                    {{ $package->badge }}
                                </span>
                            </td>
                            <td class="py-4 px-5">
                                <p class="font-semibold text-stone-900 dark:text-stone-200">{{ $package->duration }}</p>
                                <p class="text-[10px] text-stone-400 truncate">{{ $package->hotel }}</p>
                            </td>
                            <td class="py-4 px-5 whitespace-nowrap">
                                <p class="font-bold text-stone-900 dark:text-white">{{ $package->formatted_price }}</p>
                                @if($package->original_price)
                                    <p class="text-[10px] text-stone-400 line-through">{{ $package->formatted_original_price }}</p>
                                @endif
                            </td>
                            <td class="py-4 px-5 max-w-xs">
                                @if(is_array($package->facilities))
                                    <p class="text-[11px] text-stone-600 dark:text-stone-300 truncate">
                                        {{ implode(', ', $package->facilities) }}
                                    </p>
                                @else
                                    <p class="text-[11px] text-stone-400">-</p>
                                @endif
                            </td>
                            <td class="py-4 px-5 whitespace-nowrap">
                                @if($package->is_featured)
                                    <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-800 dark:bg-emerald-950/60 dark:text-emerald-300">
                                        Unggulan
                                    </span>
                                @else
                                    <span class="px-2 py-0.5 rounded-full text-[10px] font-medium bg-stone-100 text-stone-500 dark:bg-stone-800 dark:text-stone-400">
                                        Reguler
                                    </span>
                                @endif
                            </td>
                            <td class="py-4 px-5 text-right whitespace-nowrap">
                                <div class="flex items-center justify-end gap-1.5">
                                    <a href="{{ route('packages.show', $package->slug) }}" target="_blank" class="p-2 rounded-lg bg-stone-100 hover:bg-stone-200 dark:bg-stone-800 dark:hover:bg-stone-700 text-stone-600 dark:text-stone-300 text-xs transition-colors" title="Lihat di Web">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.packages.edit', $package->id) }}" class="p-2 rounded-lg bg-amber-50 hover:bg-amber-100 dark:bg-amber-950/40 dark:hover:bg-amber-900/60 text-amber-700 dark:text-amber-300 text-xs transition-colors" title="Edit Paket">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <form method="POST" action="{{ route('admin.packages.destroy', $package->id) }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus paket {{ $package->name }}?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 rounded-lg text-stone-400 hover:text-rose-600 hover:bg-rose-50 dark:hover:bg-rose-950/40 text-xs transition-colors" title="Hapus Paket">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-12 text-center text-stone-400 text-xs">
                                <p class="font-medium">Tidak ada paket perjalanan yang sesuai.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($packages->hasPages())
            <div class="p-4 border-t border-stone-100 dark:border-stone-800">
                {{ $packages->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
