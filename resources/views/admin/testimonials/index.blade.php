@extends('layouts.admin')

@section('title', 'Kelola Testimoni')

@section('content')
<div class="space-y-8" x-data="{ activeDeleteId: null }">
    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold tracking-tight text-slate-100 font-display">KELOLA TESTIMONI</h1>
            <p class="text-xs text-slate-400">Tambah, ubah, atau hapus testimoni pelanggan yang tampil di halaman utama.</p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.testimonials.create') }}" 
               class="stealth-btn-primary px-5 py-3 text-xs uppercase font-bold tracking-widest rounded-none">
                [ + TAMBAH TESTIMONI BARU ]
            </a>
        </div>
    </div>

    <!-- Testimonials Table -->
    <div class="stealth-card rounded-none overflow-hidden relative">
        <div class="overflow-x-auto">
            @if ($testimonials->isEmpty())
                <div class="py-16 text-center">
                    <svg class="mx-auto h-12 w-12 text-slate-700 animate-pulse" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                    </svg>
                    <h3 class="mt-4 text-slate-350 font-bold uppercase tracking-wider text-xs font-display">Belum Ada Testimoni Terdaftar</h3>
                    <p class="mt-1 text-slate-500 text-xs">Buat testimoni pertama Anda untuk ditampilkan di halaman depan.</p>
                    <a href="{{ route('admin.testimonials.create') }}" class="mt-6 inline-flex items-center px-4 py-2 border border-industrial-orange text-xs font-bold uppercase tracking-widest rounded-none text-industrial-orange hover:bg-industrial-orange hover:text-white transition-all font-mono">
                        [ TULIS TESTIMONI PERTAMA ]
                    </a>
                </div>
            @else
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-zinc-950/80 border-b border-zinc-800 text-slate-400 text-[10px] uppercase tracking-widest font-mono">
                            <th class="py-4 px-6">Nama Pelanggan</th>
                            <th class="py-4 px-6">Avatar</th>
                            <th class="py-4 px-6">Isi Testimoni</th>
                            <th class="py-4 px-6">Rating Bintang</th>
                            <th class="py-4 px-6">Status</th>
                            <th class="py-4 px-6 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-zinc-800/50 text-xs text-slate-300">
                        @foreach ($testimonials as $testimonial)
                            <tr class="hover:bg-zinc-900/30 transition-colors">
                                <td class="py-4 px-6">
                                    <div class="font-semibold text-slate-200 text-sm">{{ $testimonial->name }}</div>
                                </td>
                                <td class="py-4 px-6 font-mono text-zinc-400">
                                    <span class="inline-flex items-center justify-center w-7 h-7 bg-industrial-orange/10 border border-industrial-orange/20 text-industrial-orange rounded text-xs font-bold font-display">
                                        {{ $testimonial->avatar_initial }}
                                    </span>
                                </td>
                                <td class="py-4 px-6 text-slate-400 max-w-sm truncate" title="{{ $testimonial->content }}">
                                    {{ $testimonial->content }}
                                </td>
                                <td class="py-4 px-6 font-mono text-industrial-orange">
                                    @for($i=1; $i<=5; $i++)
                                        <span>{{ $i <= $testimonial->stars ? '★' : '☆' }}</span>
                                    @endfor
                                </td>
                                <td class="py-4 px-6 font-semibold uppercase tracking-wider text-[9px]">
                                    @if ($testimonial->is_active)
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
                                        <a href="{{ route('admin.testimonials.edit', $testimonial->id) }}" 
                                           class="p-2 rounded bg-black hover:bg-zinc-900 border border-zinc-800 hover:border-industrial-orange text-slate-400 hover:text-industrial-orange transition-all"
                                           title="Ubah Testimoni">
                                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                            </svg>
                                        </a>

                                         <!-- Delete Button -->
                                         <button type="button" 
                                                 @click="activeDeleteId = {{ $testimonial->id }}"
                                                 class="p-2 rounded bg-black hover:bg-zinc-900 border border-zinc-800 hover:border-red-500/45 text-slate-400 hover:text-red-400 transition-all"
                                                 title="Hapus Testimoni">
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
    @if ($testimonials->hasPages())
        <div class="mt-4">
            {{ $testimonials->links() }}
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
                <h3 class="text-base font-bold text-slate-100 font-display uppercase tracking-widest">[ HAPUS_TESTIMONI ]</h3>
                <p class="text-xs text-slate-400 leading-relaxed font-sans">Apakah Anda yakin ingin menghapus testimoni ini secara permanen dari database lab? Aksi ini tidak dapat dibatalkan.</p>
            </div>
            <div class="flex items-center justify-end gap-4 font-mono text-[10px]">
                <button type="button" 
                        @click="activeDeleteId = null" 
                        class="px-5 py-3 border border-zinc-800 hover:border-zinc-600 text-slate-400 hover:text-slate-200 transition-colors uppercase font-bold tracking-widest rounded-none">
                    [ BATAL ]
                </button>
                <form :action="'/admin/testimonials/' + activeDeleteId" method="POST">
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
