@extends('admin.layouts.app')

@section('title', 'Pelanggan Warta Perjalanan | Admin DANWISATA')
@section('page_title', 'Daftar Surel & Warta Perjalanan')
@section('page_description', 'Kelola daftar wisatawan dan calon tamu yang berlangganan kabar rute serta promo eksklusif.')

@section('content')
<div class="space-y-6">
    <!-- Quick Stat & Search -->
    <div class="flex flex-col sm:flex-row items-stretch sm:items-center justify-between gap-4">
        <div class="flex items-center gap-3">
            <div class="p-3.5 rounded-2xl bg-white dark:bg-stone-900 border border-stone-200/90 dark:border-stone-800 shadow-xs flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-purple-50 dark:bg-purple-950/40 text-purple-600 dark:text-purple-300 flex items-center justify-center text-base">
                    <i class="fa-solid fa-envelope-open-text"></i>
                </div>
                <div>
                    <span class="text-[10px] font-bold uppercase tracking-wider text-stone-400 block">Total Pelanggan</span>
                    <p class="font-serif text-xl font-bold text-stone-900 dark:text-white">{{ $totalSubscribers }} Alamat Surel</p>
                </div>
            </div>
        </div>

        <form method="GET" action="{{ route('admin.newsletters.index') }}" class="flex gap-2">
            <div class="relative w-full sm:w-72">
                <i class="fa-solid fa-magnifying-glass absolute left-3.5 top-1/2 -translate-y-1/2 text-stone-400 text-xs"></i>
                <input 
                    type="text" 
                    name="search" 
                    value="{{ request('search') }}" 
                    placeholder="Cari alamat surel..." 
                    class="w-full pl-9 pr-3 py-2 rounded-xl bg-white dark:bg-stone-900 border border-stone-200 dark:border-stone-800 text-xs focus:ring-1 focus:ring-stone-900 focus:outline-none shadow-xs"
                >
            </div>
            <button type="submit" class="px-4 py-2 rounded-xl bg-stone-900 text-white dark:bg-stone-100 dark:text-stone-900 text-xs font-semibold hover:opacity-90 transition-opacity">
                Cari
            </button>
            @if(request('search'))
                <a href="{{ route('admin.newsletters.index') }}" class="px-3 py-2 rounded-xl border border-stone-200 dark:border-stone-700 text-xs font-semibold text-stone-500 hover:text-stone-900 dark:hover:text-white transition-colors flex items-center">
                    Reset
                </a>
            @endif
        </form>
    </div>

    <!-- Table -->
    <div class="bg-white dark:bg-stone-900 rounded-3xl border border-stone-200/90 dark:border-stone-800 shadow-xs overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="bg-stone-50 dark:bg-stone-800/60 text-stone-400 uppercase tracking-wider text-[10px] font-bold border-b border-stone-200 dark:border-stone-800">
                    <tr>
                        <th class="py-3.5 px-5">No</th>
                        <th class="py-3.5 px-5">Alamat Surel (Email)</th>
                        <th class="py-3.5 px-5">Waktu Berlangganan</th>
                        <th class="py-3.5 px-5">Status</th>
                        <th class="py-3.5 px-5 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-stone-100 dark:divide-stone-800 text-stone-700 dark:text-stone-300">
                    @forelse($newsletters as $index => $sub)
                        <tr class="hover:bg-stone-50/70 dark:hover:bg-stone-800/40 transition-colors">
                            <td class="py-3.5 px-5 text-stone-400 font-mono text-[11px]">
                                {{ $newsletters->firstItem() + $index }}
                            </td>
                            <td class="py-3.5 px-5">
                                <span class="font-bold text-stone-900 dark:text-white text-xs">{{ $sub->email }}</span>
                            </td>
                            <td class="py-3.5 px-5 whitespace-nowrap">
                                <p class="font-medium text-stone-800 dark:text-stone-200">{{ $sub->created_at->format('d M Y, H:i') }} WIB</p>
                                <p class="text-[10px] text-stone-400">{{ $sub->created_at->diffForHumans() }}</p>
                            </td>
                            <td class="py-3.5 px-5 whitespace-nowrap">
                                <span class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded-full text-[10px] font-semibold bg-emerald-100 text-emerald-800 dark:bg-emerald-950/60 dark:text-emerald-300">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                    <span>Aktif Terdaftar</span>
                                </span>
                            </td>
                            <td class="py-3.5 px-5 text-right whitespace-nowrap">
                                <form method="POST" action="{{ route('admin.newsletters.destroy', $sub->id) }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus email {{ $sub->email }}?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 rounded-lg text-stone-400 hover:text-rose-600 hover:bg-rose-50 dark:hover:bg-rose-950/40 text-xs transition-colors" title="Hapus Email">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-12 text-center text-stone-400 text-xs">
                                <div class="w-12 h-12 rounded-full bg-stone-100 dark:bg-stone-800 flex items-center justify-center mx-auto mb-2 text-stone-400">
                                    <i class="fa-solid fa-envelope-circle-check text-base"></i>
                                </div>
                                <p class="font-medium">Belum ada alamat surel yang terdaftar.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($newsletters->hasPages())
            <div class="p-4 border-t border-stone-100 dark:border-stone-800">
                {{ $newsletters->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
