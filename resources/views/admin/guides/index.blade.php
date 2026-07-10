@extends('layouts.admin')

@section('title', 'Kelola Panduan Edukasi')

@section('content')
<div class="space-y-8" x-data="{ activeDeleteId: null }">
    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold tracking-tight text-slate-100 font-display">KELOLA PANDUAN EDUKASI</h1>
            <p class="text-xs text-slate-400">Tambah, ubah, atau hapus panduan edukasi pelanggan yang tampil di portal belajar.</p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.guides.create') }}" 
               class="stealth-btn-primary px-5 py-3 text-xs uppercase font-bold tracking-widest rounded-none">
                [ + TAMBAH PANDUAN BARU ]
            </a>
        </div>
    </div>

    <!-- Guides Table -->
    <div class="stealth-card rounded-none overflow-hidden relative">
        <div class="overflow-x-auto">
            @if ($guides->isEmpty())
                <div class="py-16 text-center">
                    <svg class="mx-auto h-12 w-12 text-slate-700 animate-pulse" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                    <h3 class="mt-4 text-slate-350 font-bold uppercase tracking-wider text-xs font-display">Belum Ada Panduan Terdaftar</h3>
                    <p class="mt-1 text-slate-500 text-xs">Buat panduan pertama Anda untuk ditampilkan di portal belajar.</p>
                    <a href="{{ route('admin.guides.create') }}" class="mt-6 inline-flex items-center px-4 py-2 border border-industrial-orange text-xs font-bold uppercase tracking-widest rounded-none text-industrial-orange hover:bg-industrial-orange hover:text-white transition-all font-mono">
                        [ TULIS PANDUAN PERTAMA ]
                    </a>
                </div>
            @else
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-zinc-950/80 border-b border-zinc-800 text-slate-400 text-[10px] uppercase tracking-widest font-mono">
                            <th class="py-4 px-6">Judul Panduan</th>
                            <th class="py-4 px-6">Slug</th>
                            <th class="py-4 px-6">Urutan Posisi</th>
                            <th class="py-4 px-6">Status</th>
                            <th class="py-4 px-6 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-zinc-800/50 text-xs text-slate-300">
                        @foreach ($guides as $guide)
                            <tr class="hover:bg-zinc-900/30 transition-colors">
                                <td class="py-4 px-6">
                                    <div class="font-semibold text-slate-200 text-sm">{{ $guide->title }}</div>
                                </td>
                                <td class="py-4 px-6 font-mono text-zinc-400">
                                    {{ $guide->slug }}
                                </td>
                                <td class="py-4 px-6 font-mono text-slate-300">
                                    {{ $guide->order_position }}
                                </td>
                                <td class="py-4 px-6 font-semibold uppercase tracking-wider text-[9px]">
                                    @if ($guide->is_active)
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
                                        <a href="{{ route('admin.guides.edit', $guide->id) }}" 
                                           class="p-2 rounded bg-black hover:bg-zinc-900 border border-zinc-800 hover:border-industrial-orange text-slate-400 hover:text-industrial-orange transition-all"
                                           title="Ubah Panduan">
                                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                            </svg>
                                        </a>

                                         <!-- Delete Button -->
                                         <button type="button" 
                                                 @click="activeDeleteId = {{ $guide->id }}"
                                                 class="p-2 rounded bg-black hover:bg-zinc-900 border border-zinc-800 hover:border-red-500/45 text-slate-400 hover:text-red-400 transition-all"
                                                 title="Hapus Panduan">
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
    </div>

    <!-- Pagination -->
    @if ($guides->hasPages())
        <div class="mt-4">
            {{ $guides->links() }}
        </div>
    @endif

    <!-- Delete Confirmation Modal -->
    <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/80 backdrop-blur-sm px-4"
         x-show="activeDeleteId !== null"
         x-transition
         x-cloak
         style="display: none;">
        <div class="bg-zinc-950 border border-zinc-850 p-6 sm:p-8 max-w-md w-full rounded-none space-y-6">
            <div class="space-y-2">
                <h3 class="text-base font-bold text-slate-100 font-display uppercase tracking-widest">[ HAPUS_PANDUAN ]</h3>
                <p class="text-xs text-slate-400 leading-relaxed font-sans">Apakah Anda yakin ingin menghapus panduan ini secara permanen dari database? Aksi ini tidak dapat dibatalkan.</p>
            </div>
            <div class="flex items-center justify-end gap-4 font-mono text-[10px]">
                <button type="button" 
                        @click="activeDeleteId = null" 
                        class="px-5 py-3 border border-zinc-800 hover:border-zinc-650 text-slate-400 hover:text-slate-200 transition-colors uppercase font-bold tracking-widest rounded-none">
                    [ BATAL ]
                </button>
                <form :action="'/admin/guides/' + activeDeleteId" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            class="px-5 py-3 bg-red-650 hover:bg-red-700 text-white border-2 border-transparent hover:border-red-950 transition-colors uppercase font-bold tracking-widest rounded-none">
                        [ YA, HAPUS ]
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
