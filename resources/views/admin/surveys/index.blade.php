@extends('layouts.admin')

@section('title', 'Hasil Survei & Kuis')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between border-b border-industrial-border pb-5 gap-4">
        <div>
            <h1 class="text-2xl font-black text-slate-100 uppercase tracking-tight font-display">Hasil Survei & Kuis</h1>
            <p class="text-xs text-slate-500 font-mono mt-1">Daftar kiriman kuesioner pengalaman pelanggan (Customer Experience & Website Research)</p>
        </div>
    </div>

    <!-- Table Card -->
    <div class="stealth-card rounded-xl overflow-hidden border border-zinc-800 bg-zinc-950/40">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-zinc-900/60 font-mono text-[11px] text-slate-300">
                <thead>
                    <tr class="bg-industrial-black text-slate-500 uppercase tracking-wider text-left">
                        <th class="px-6 py-4">Waktu Kirim</th>
                        <th class="px-6 py-4">IP Address</th>
                        <th class="px-6 py-4">Lama Vaping (Q1)</th>
                        <th class="px-6 py-4">Atomizer (Q2)</th>
                        <th class="px-6 py-4 text-center">Tertarik Membeli? (Q14)</th>
                        <th class="px-6 py-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-900/30">
                    @forelse($responses as $response)
                    <tr class="hover:bg-zinc-900/20 transition-all">
                        <td class="px-6 py-4 font-semibold whitespace-nowrap text-slate-400">
                            {{ $response->created_at->timezone('Asia/Jakarta')->format('d M Y, H:i') }} WIB
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-slate-500">
                            {{ $response->ip_address ?: 'Unknown' }}
                        </td>
                        <td class="px-6 py-4 font-semibold whitespace-nowrap text-slate-350">
                            {{ $response->answers['Q1'] ?? '-' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-slate-400">
                            {{ $response->answers['Q2'] ?? '-' }}
                        </td>
                        <td class="px-6 py-4 text-center whitespace-nowrap">
                            <span class="inline-flex items-center px-2 py-0.5 text-[9px] font-bold border rounded uppercase tracking-wider
                                @if(($response->answers['Q14'] ?? '') === 'Sangat Tertarik')
                                    bg-emerald-500/10 border-emerald-500/30 text-emerald-450
                                @elseif(($response->answers['Q14'] ?? '') === 'Mungkin')
                                    bg-sky-500/10 border-sky-500/30 text-sky-400
                                @elseif(($response->answers['Q14'] ?? '') === 'Belum Yakin')
                                    bg-amber-500/10 border-amber-500/30 text-amber-450
                                @else
                                    bg-zinc-500/10 border-zinc-500/30 text-zinc-500
                                @endif">
                                {{ $response->answers['Q14'] ?? 'Unknown' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-xs font-sans">
                            <div class="flex items-center justify-end gap-2.5">
                                <a href="{{ route('admin.surveys.show', $response->id) }}"
                                    class="text-indigo-400 hover:text-white transition-all uppercase font-bold tracking-wider text-[10px] hover:underline">
                                    Detail
                                </a>
                                <form action="{{ route('admin.surveys.destroy', $response->id) }}" method="POST"
                                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus hasil survei ini secara permanen?');" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="text-red-500 hover:text-red-400 transition-all uppercase font-bold tracking-wider text-[10px] hover:underline">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center text-slate-500 uppercase tracking-widest font-bold">
                            Belum ada jawaban survei yang masuk.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($responses->hasPages())
        <div class="px-6 py-4 border-t border-industrial-border bg-industrial-black/50 font-sans text-xs">
            {{ $responses->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
