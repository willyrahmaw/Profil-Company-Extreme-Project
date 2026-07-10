@extends('layouts.admin')

@section('title', 'Detail Jawaban Survei')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between border-b border-industrial-border pb-5 gap-4">
        <div>
            <div class="flex items-center gap-2">
                <a href="{{ route('admin.surveys.index') }}" class="text-[10px] font-bold uppercase tracking-widest text-slate-500 hover:text-industrial-orange transition-colors font-mono">
                    &larr; KEMBALI
                </a>
                <span class="text-zinc-700">|</span>
                <span class="text-[9px] font-mono text-zinc-500 uppercase tracking-widest">[ RESPONDENT_ID: {{ $survey->id }} ]</span>
            </div>
            <h1 class="text-2xl font-black text-slate-100 uppercase tracking-tight font-display mt-2">Detail Jawaban Responden</h1>
            <p class="text-xs text-slate-500 font-mono mt-1">Dikirim pada {{ $survey->created_at->timezone('Asia/Jakarta')->format('d M Y, H:i') }} WIB | IP: {{ $survey->ip_address }}</p>
        </div>

        <form action="{{ route('admin.surveys.destroy', $survey->id) }}" method="POST"
            onsubmit="return confirm('Apakah Anda yakin ingin menghapus hasil survei ini secara permanen?');" class="inline">
            @csrf
            @method('DELETE')
            <button type="submit"
                class="px-5 py-2.5 text-[10px] uppercase font-bold tracking-widest border border-red-500/30 text-red-500 bg-red-500/5 hover:bg-red-500/10 hover:border-red-500 transition-all font-display">
                HAPUS SURVEI
            </button>
        </form>
    </div>

    <!-- Answers Grouped by Section (Simulated structure matching the survey model structure) -->
    @php
    $sections = [
        "Profil Pengguna" => ["Q1", "Q2", "Q3"],
        "Pengalaman Menggunakan Website" => ["Q4", "Q5", "Q6", "Q7"],
        "Informasi Produk" => ["Q8", "Q9", "Q10", "Q11"],
        "Customer Education" => ["Q12", "Q13"],
        "Keputusan Membeli" => ["Q14", "Q15", "Q16"],
        "Kepercayaan Terhadap Brand" => ["Q17"],
        "Fitur Website" => ["Q18", "Q19", "Q20"],
        "Penilaian Website" => ["Q21"],
        "Masukan Terbuka" => ["Q22", "Q23"],
    ];
    @endphp

    <div class="space-y-8 font-sans">
        @foreach($sections as $sTitle => $qIds)
        <div class="stealth-card p-6 sm:p-8 rounded-xl border border-zinc-800 bg-zinc-950/20 space-y-6">
            <h2 class="text-sm font-bold text-industrial-orange uppercase tracking-widest border-b border-zinc-900 pb-3 font-display">
                // {{ $sTitle }}
            </h2>

            <div class="space-y-6 divide-y divide-zinc-900/40">
                @foreach($qIds as $qIdx => $qId)
                @php 
                    $answer = $survey->answers[$qId] ?? null; 
                    $qText = $questionsMap[$qId] ?? $qId;
                @endphp
                <div class="pt-6 {{ $qIdx === 0 ? 'pt-0' : '' }} space-y-3">
                    <div class="flex justify-between items-start gap-4 text-xs font-semibold text-slate-400 uppercase tracking-wide">
                        <span>Q. {{ $qText }}</span>
                        <span class="text-[9px] font-mono text-zinc-650 tracking-wider flex-shrink-0">REF: {{ $qId }}</span>
                    </div>

                    <!-- Output Format by Answer Type -->
                    <div class="mt-2 text-sm font-semibold">
                        @if(is_array($answer))
                            @if($qId === 'Q21')
                                <!-- Matrix Rating Render -->
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 pt-2 font-mono text-xs">
                                    @foreach($answer as $rowName => $ratingValue)
                                    <div class="p-3 bg-zinc-900/40 border border-zinc-800 rounded-lg flex items-center justify-between">
                                        <span class="text-slate-400 uppercase tracking-wider">{{ str_replace('_', ' ', $rowName) }}</span>
                                        <div class="flex items-center gap-2">
                                            <span class="text-industrial-orange font-bold font-display text-sm">{{ $ratingValue }}</span>
                                            <span class="text-slate-600">/ 10</span>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            @else
                                <!-- Multiple Choice Tags Render -->
                                <div class="flex flex-wrap gap-2 pt-1 font-mono text-[10px]">
                                    @foreach($answer as $opt)
                                    <span class="px-2.5 py-1 bg-industrial-orange/10 border border-industrial-orange/30 text-industrial-orange uppercase tracking-wider font-bold">
                                        {{ $opt }}
                                    </span>
                                    @endforeach
                                </div>
                            @endif
                        @elseif($qId === 'Q6' || $qId === 'Q7')
                            <!-- Single Rating Render -->
                            <div class="flex items-center gap-3 pt-1">
                                <div class="h-2.5 w-48 bg-zinc-900 border border-zinc-850 rounded-full overflow-hidden flex-shrink-0">
                                    <div class="bg-industrial-orange h-full shadow-[0_0_8px_#FF4081]" style="width: {{ $answer * 10 }}%"></div>
                                </div>
                                <span class="text-sm font-bold font-mono text-industrial-orange">{{ $answer }} <span class="text-xs text-slate-500 font-normal">/ 10</span></span>
                            </div>
                        @else
                            <!-- Plain Text Render -->
                            <p class="text-slate-100 font-sans leading-relaxed whitespace-pre-line bg-zinc-900/30 border border-zinc-900/50 p-4 rounded-lg font-light text-xs sm:text-sm">
                                {{ $answer ?: 'Tidak ada jawaban.' }}
                            </p>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
