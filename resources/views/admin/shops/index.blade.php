@extends('layouts.admin')

@section('title', 'Kelola Toko')

@section('content')
<div class="space-y-8" x-data="{ activeDeleteId: null }">
    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold tracking-tight text-slate-100 font-display">KELOLA TOKO</h1>
            <p class="text-xs text-slate-400">Tambah, ubah, atau hapus link toko TikTok Shop / channel eksternal lainnya.</p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.shops.create') }}" 
               class="stealth-btn-primary px-5 py-3 text-xs uppercase font-bold tracking-widest rounded-none">
                [ + TAMBAH TOKO BARU ]
            </a>
        </div>
    </div>

    <!-- Shops Table -->
    <div class="stealth-card rounded-none overflow-hidden relative">
        <div class="overflow-x-auto">
            @if ($shops->isEmpty())
                <div class="py-16 text-center">
                    <svg class="mx-auto h-12 w-12 text-slate-700 animate-pulse" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                    </svg>
                    <h3 class="mt-4 text-slate-350 font-bold uppercase tracking-wider text-xs font-display">Belum Ada Toko Terdaftar</h3>
                    <p class="mt-1 text-slate-500 text-xs">Daftarkan toko pertama Anda untuk ditampilkan di halaman depan.</p>
                    <a href="{{ route('admin.shops.create') }}" class="mt-6 inline-flex items-center px-4 py-2 border border-industrial-orange text-xs font-bold uppercase tracking-widest rounded-none text-industrial-orange hover:bg-industrial-orange hover:text-white transition-all font-mono">
                        [ TULIS TOKO PERTAMA ]
                    </a>
                </div>
            @else
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-zinc-950/80 border-b border-zinc-800 text-slate-400 text-[10px] uppercase tracking-widest font-mono">
                            <th class="py-4 px-6">Nama Toko</th>
                            <th class="py-4 px-6">Platform</th>
                            <th class="py-4 px-6">Tautan (URL)</th>
                            <th class="py-4 px-6">Status</th>
                            <th class="py-4 px-6 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-zinc-800/50 text-xs text-slate-300">
                        @foreach ($shops as $shop)
                            <tr class="hover:bg-zinc-900/30 transition-colors">
                                <td class="py-4 px-6">
                                    <div class="font-semibold text-slate-200 text-sm">{{ $shop->name }}</div>
                                </td>
                                <td class="py-4 px-6">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-none text-[8px] font-bold tracking-widest bg-black border border-industrial-orange/20 text-industrial-orange uppercase font-display">
                                        {{ $shop->platform }}
                                    </span>
                                </td>
                                <td class="py-4 px-6 font-mono text-slate-400 max-w-xs truncate">
                                    <a href="{{ $shop->url }}" target="_blank" class="hover:text-industrial-orange transition-colors">
                                        {{ $shop->url }}
                                    </a>
                                </td>
                                <td class="py-4 px-6 font-semibold uppercase tracking-wider text-[9px]">
                                    @if ($shop->is_active)
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-none bg-black border border-emerald-500/25 text-emerald-400">
                                            Aktif
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-none bg-black border border-zinc-800 text-slate-500">
                                            Non-Aktif
                                        </span>
                                    @endif
                                </td>
                                <td class="py-4 px-6 text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        <!-- Edit Link -->
                                        <a href="{{ route('admin.shops.edit', $shop->id) }}" 
                                           class="p-2 rounded bg-black hover:bg-zinc-900 border border-zinc-800 hover:border-industrial-orange text-slate-400 hover:text-industrial-orange transition-all"
                                           title="Ubah Toko">
                                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                            </svg>
                                        </a>

                                         <!-- Delete Button -->
                                         <button type="button" 
                                                 @click="activeDeleteId = {{ $shop->id }}"
                                                 class="p-2 rounded bg-black hover:bg-zinc-900 border border-zinc-800 hover:border-red-500/45 text-slate-400 hover:text-red-400 transition-all"
                                                 title="Hapus Toko">
                                             <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                             </svg>
                                         </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
        @include('admin.partials.pagination', ['paginator' => $shops])
    </div>

    <!-- Delete Confirmation Modal -->
    <div x-show="activeDeleteId !== null" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/90 backdrop-blur-sm" style="display: none;">
        <div class="bg-zinc-950 border border-zinc-800 rounded-none p-6 max-w-sm w-full shadow-2xl relative" @click.away="activeDeleteId = null">
            
            <div class="text-center">
                <h3 class="text-sm font-bold tracking-wider text-slate-200 uppercase font-display">Konfirmasi Hapus</h3>
                <p class="text-xs text-slate-400 mt-3 leading-relaxed">Apakah Anda yakin ingin menghapus toko ini secara permanen? Pilihan ini tidak akan muncul lagi di halaman depan.</p>
            </div>
            
            <div class="flex items-center gap-3 mt-6">
                <button type="button" @click="activeDeleteId = null" 
                        class="flex-1 py-2 text-xs font-bold uppercase tracking-widest text-slate-450 hover:text-zinc-200 bg-zinc-900 border border-zinc-800 rounded-none transition-all">
                    Batal
                </button>
                <!-- Form submission -->
                <form :action="'{{ url('admin/shops') }}/' + activeDeleteId" method="POST" class="flex-1">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            class="w-full py-2 text-xs font-bold uppercase tracking-widest text-white bg-red-600 hover:bg-red-700 rounded-none transition-all">
                        Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
