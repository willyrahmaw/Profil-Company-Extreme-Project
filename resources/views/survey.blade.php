@extends('layouts.app')

@section('content')
<!-- Header / Navbar back to home -->
<header class="sticky top-0 z-50 bg-white/85 dark:bg-black/85 backdrop-blur-md border-b border-zinc-200 dark:border-zinc-900 transition-colors duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
        <a href="{{ route('home') }}" class="flex items-center gap-2 group text-[10px] font-bold uppercase tracking-widest text-zinc-550 dark:text-zinc-400 hover:text-industrial-orange transition-colors">
            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
            </svg>
            KEMBALI KE BERANDA
        </a>
        <span class="text-[9px] font-bold text-industrial-orange uppercase tracking-widest font-mono bg-white dark:bg-zinc-950 px-3 py-1 border border-zinc-200 dark:border-zinc-800 shadow-sm dark:shadow-none">
            RESEARCH_PORTAL
        </span>
    </div>
</header>

<main class="flex-grow py-12 px-4 sm:px-6 lg:px-8 relative overflow-hidden">
    <!-- Background blueprint pattern -->
    <div class="absolute inset-0 opacity-[0.02] dark:opacity-[0.04] pointer-events-none z-0">
        <svg class="w-full h-full" viewBox="0 0 100 100" fill="none" stroke="currentColor">
            <pattern id="grid" width="10" height="10" patternUnits="userSpaceOnUse">
                <path d="M 10 0 L 0 0 0 10" fill="none" stroke-width="0.5"/>
            </pattern>
            <rect width="100%" height="100%" fill="url(#grid)" />
        </svg>
    </div>

    <div class="max-w-3xl mx-auto relative z-10" x-data="{
        currentStep: {{
            $errors->hasAny(['answers.Q1', 'answers.Q2', 'answers.Q3']) ? 0 : (
            $errors->hasAny(['answers.Q4', 'answers.Q5', 'answers.Q6', 'answers.Q7']) ? 1 : (
            $errors->hasAny(['answers.Q8', 'answers.Q9', 'answers.Q10', 'answers.Q11']) ? 2 : (
            $errors->hasAny(['answers.Q12', 'answers.Q13']) ? 3 : (
            $errors->hasAny(['answers.Q14', 'answers.Q15', 'answers.Q16']) ? 4 : (
            $errors->hasAny(['answers.Q17']) ? 5 : (
            $errors->hasAny(['answers.Q18', 'answers.Q19', 'answers.Q20']) ? 6 : (
            $errors->hasAny(['answers.Q21', 'answers.Q21.*']) ? 7 : (
            $errors->hasAny(['answers.Q22', 'answers.Q23']) ? 8 : 0
            ))))))))
        }},
        totalSteps: 9,
        answers: @json(old('answers') ?: new \stdClass())
    }">

        <!-- Banner Sukses Pengisian -->
        @if(session('success_survey'))
        <div class="stealth-card p-8 bg-white dark:bg-zinc-950/80 border border-industrial-orange/30 rounded-2xl shadow-xl text-center space-y-6 animate-coil-glow">
            <div class="w-16 h-16 bg-industrial-orange/10 border border-industrial-orange/30 rounded-full flex items-center justify-center mx-auto text-industrial-orange">
                <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <h2 class="text-2xl font-black tracking-tight text-slate-900 dark:text-white font-display uppercase">TERIMA KASIH!</h2>
            <p class="text-zinc-650 dark:text-zinc-400 text-sm leading-relaxed max-w-md mx-auto font-sans font-light">
                {{ session('success_survey') }}
            </p>
            <div class="pt-4">
                <a href="{{ route('home') }}" class="stealth-btn-primary px-8 py-3.5 text-xs font-bold uppercase tracking-widest inline-block shadow-md">
                    KEMBALI KE BERANDA
                </a>
            </div>
        </div>
        @else

        <!-- Questionnaire Title -->
        <div class="space-y-4 mb-8 text-center sm:text-left border-b border-zinc-200 dark:border-zinc-900 pb-8 transition-colors duration-300">
            <h1 class="text-3xl sm:text-4xl font-black tracking-tight text-slate-900 dark:text-white font-display uppercase leading-tight">
                {{ $survey['research_title'] }}
            </h1>
            <p class="text-zinc-550 dark:text-zinc-400 text-xs sm:text-sm leading-relaxed font-sans font-light">
                {{ $survey['description'] }}
            </p>
        </div>

        <!-- Wizard Progress Bar -->
        <div class="bg-zinc-200 dark:bg-zinc-900 h-1.5 w-full rounded-full overflow-hidden mb-8 transition-all duration-300">
            <div class="bg-industrial-orange h-full transition-all duration-300 shadow-[0_0_8px_#FF4081]" :style="'width: ' + (((currentStep + 1) / totalSteps) * 100) + '%'"></div>
        </div>

        <!-- Main Form -->
        <form action="{{ route('research.store') }}" method="POST" class="space-y-6">
            @csrf

            <!-- Section Loop -->
            @foreach($survey['sections'] as $sIndex => $section)
            <div x-show="currentStep === {{ $sIndex }}" x-cloak class="space-y-8"
                x-transition:enter="transition ease-out duration-250 transform"
                x-transition:enter-start="opacity-0 translate-y-4"
                x-transition:enter-end="opacity-100 translate-y-0">
                
                <!-- Section Title -->
                <div class="flex items-center gap-3 border-b border-zinc-200 dark:border-zinc-900 pb-3 transition-colors">
                    <span class="text-xs font-mono font-bold text-industrial-orange">0{{ $sIndex + 1 }}_</span>
                    <h2 class="text-xl font-bold tracking-wider text-slate-900 dark:text-white uppercase font-display">
                        {{ $section['title'] }}
                    </h2>
                </div>

                <!-- Questions Loop -->
                @foreach($section['questions'] as $qIndex => $question)
                <div class="space-y-3 p-6 sm:p-8 bg-white/40 dark:bg-zinc-950/20 border border-zinc-200 dark:border-zinc-900 rounded-2xl transition-all">
                    <div class="flex justify-between items-start gap-4">
                        <label class="text-sm font-bold text-slate-900 dark:text-white leading-normal uppercase font-display">
                            {{ $question['question'] }}
                            @if($question['required'])
                            <span class="text-industrial-orange ml-0.5">*</span>
                            @endif
                        </label>
                        <span class="text-[9px] font-mono text-zinc-400 dark:text-zinc-650 tracking-wider">REF: {{ $question['id'] }}</span>
                    </div>

                    <!-- Error Alert -->
                    @error('answers.' . $question['id'])
                    <div class="text-[10px] font-mono text-red-500 font-bold uppercase tracking-wider flex items-center gap-1.5 mt-1">
                        <span class="w-1.5 h-1.5 bg-red-500 rounded-full animate-ping"></span>
                        <span>{{ $message }}</span>
                    </div>
                    @enderror

                    <!-- Question Input Render by Type -->
                    <div class="mt-4">
                        @if($question['type'] === 'single_choice')
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                @foreach($question['options'] as $option)
                                <label class="stealth-card p-4 rounded-xl border flex items-center gap-3 cursor-pointer transition-all duration-200"
                                    :class="answers['{{ $question['id'] }}'] === '{{ $option }}' ? 'border-industrial-orange/60 bg-industrial-orange/5 text-slate-950 dark:text-white' : 'border-zinc-200 dark:border-zinc-850 hover:border-zinc-300 dark:hover:border-zinc-800 text-zinc-600 dark:text-zinc-400'">
                                    <input type="radio" name="answers[{{ $question['id'] }}]" value="{{ $option }}" 
                                        x-model="answers['{{ $question['id'] }}']" class="sr-only" @if($question['required']) required @endif>
                                    <span class="w-4 h-4 rounded-full border flex-shrink-0 flex items-center justify-center transition-all"
                                        :class="answers['{{ $question['id'] }}'] === '{{ $option }}' ? 'border-industrial-orange bg-industrial-orange' : 'border-zinc-400 dark:border-zinc-700 bg-transparent'">
                                        <span class="w-1.5 h-1.5 rounded-full bg-white transition-transform" :class="answers['{{ $question['id'] }}'] === '{{ $option }}' ? 'scale-100' : 'scale-0'"></span>
                                    </span>
                                    <span class="text-xs font-semibold uppercase tracking-wider font-mono">{{ $option }}</span>
                                </label>
                                @endforeach
                            </div>

                        @elseif($question['type'] === 'multiple_choice')
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3" x-data="{ 
                                selectedValues: answers['{{ $question['id'] }}'] || [] 
                            }" x-init="$watch('selectedValues', val => answers['{{ $question['id'] }}'] = val)">
                                @foreach($question['options'] as $option)
                                <label class="stealth-card p-4 rounded-xl border flex items-center gap-3 cursor-pointer transition-all duration-200"
                                    :class="selectedValues.includes('{{ $option }}') ? 'border-industrial-orange/60 bg-industrial-orange/5 text-slate-950 dark:text-white' : 'border-zinc-200 dark:border-zinc-850 hover:border-zinc-300 dark:hover:border-zinc-800 text-zinc-600 dark:text-zinc-400'">
                                    <input type="checkbox" name="answers[{{ $question['id'] }}][]" value="{{ $option }}" 
                                        x-model="selectedValues" class="sr-only">
                                    <span class="w-4 h-4 border flex-shrink-0 flex items-center justify-center transition-all"
                                        :class="selectedValues.includes('{{ $option }}') ? 'border-industrial-orange bg-industrial-orange' : 'border-zinc-400 dark:border-zinc-700 bg-transparent'">
                                        <svg class="h-3 w-3 text-white transition-transform" :class="selectedValues.includes('{{ $option }}') ? 'scale-100' : 'scale-0'" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                        </svg>
                                    </span>
                                    <span class="text-xs font-semibold uppercase tracking-wider font-mono">{{ $option }}</span>
                                </label>
                                @endforeach
                            </div>

                        @elseif($question['type'] === 'rating')
                            <div class="space-y-4">
                                <div class="flex flex-wrap gap-2 justify-between">
                                    @for($rVal = $question['scale']['min']; $rVal <= $question['scale']['max']; $rVal++)
                                    <button type="button" @click="answers['{{ $question['id'] }}'] = '{{ $rVal }}'"
                                        class="w-10 h-10 rounded-xl border text-xs font-mono font-bold flex items-center justify-center transition-all duration-150 focus:outline-none"
                                        :class="answers['{{ $question['id'] }}'] == '{{ $rVal }}' ? 'border-industrial-orange bg-industrial-orange text-white shadow-[0_0_8px_rgba(255,64,129,0.5)]' : 'border-zinc-200 dark:border-zinc-850 hover:border-zinc-300 dark:hover:border-zinc-800 text-zinc-600 dark:text-zinc-400 bg-white dark:bg-zinc-950'">
                                        {{ $rVal }}
                                    </button>
                                    @endfor
                                </div>
                                <div class="flex justify-between text-[9px] font-mono uppercase tracking-widest text-zinc-500 pt-1">
                                    <span>&larr; {{ $question['scale']['minLabel'] }}</span>
                                    <span>{{ $question['scale']['maxLabel'] }} &rarr;</span>
                                </div>
                                <input type="hidden" name="answers[{{ $question['id'] }}]" x-model="answers['{{ $question['id'] }}']" @if($question['required']) required @endif>
                            </div>

                        @elseif($question['type'] === 'long_text')
                            <textarea name="answers[{{ $question['id'] }}]" x-model="answers['{{ $question['id'] }}']" rows="4"
                                @if($question['required']) required @endif
                                class="block w-full rounded-xl bg-zinc-50 dark:bg-black border border-zinc-200 dark:border-zinc-850 text-zinc-900 dark:text-slate-100 px-4 py-3.5 text-xs focus:outline-none focus:ring-1 focus:ring-industrial-orange focus:border-transparent transition-all placeholder-zinc-400 dark:placeholder-zinc-700 font-semibold"
                                placeholder="Masukkan masukan/pendapat Anda secara lengkap..."></textarea>

                        @elseif($question['type'] === 'matrix_rating')
                            <div class="space-y-6 overflow-x-auto">
                                <table class="hidden md:table w-full font-mono text-[10px]">
                                    <thead>
                                        <tr class="border-b border-zinc-250 dark:border-zinc-900/60 pb-2">
                                            <th class="text-left py-3 text-zinc-550 font-bold uppercase tracking-wider w-1/3">Kategori</th>
                                            @for($scale = $question['scale']['min']; $scale <= $question['scale']['max']; $scale++)
                                            <th class="text-center py-3 text-zinc-550 font-bold w-12">{{ $scale }}</th>
                                            @endfor
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-zinc-200 dark:divide-zinc-900/40">
                                        @foreach($question['rows'] as $row)
                                        @php $rowKey = str_replace(' ', '_', $row); @endphp
                                        <tr>
                                            <td class="py-4 text-slate-800 dark:text-zinc-355 font-bold uppercase tracking-wider">{{ $row }}</td>
                                            @for($scale = $question['scale']['min']; $scale <= $question['scale']['max']; $scale++)
                                            <td class="text-center py-4">
                                                <label class="inline-flex items-center justify-center p-2 cursor-pointer group">
                                                    <input type="radio" name="answers[{{ $question['id'] }}][{{ $rowKey }}]" value="{{ $scale }}"
                                                        x-model="answers['{{ $question['id'] }}']['{{ $rowKey }}']" class="sr-only" @if($question['required']) required @endif>
                                                    <span class="w-4.5 h-4.5 rounded-full border flex-shrink-0 flex items-center justify-center transition-all group-hover:border-industrial-orange"
                                                        :class="answers['{{ $question['id'] }}']['{{ $rowKey }}'] == '{{ $scale }}' ? 'border-industrial-orange bg-industrial-orange' : 'border-zinc-400 dark:border-zinc-750 bg-transparent'">
                                                        <span class="w-1.5 h-1.5 rounded-full bg-white transition-transform" :class="answers['{{ $question['id'] }}']['{{ $rowKey }}'] == '{{ $scale }}' ? 'scale-100' : 'scale-0'"></span>
                                                    </span>
                                                </label>
                                            </td>
                                            @endfor
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                <!-- Mobile matrix view (list view) -->
                                <div class="block md:hidden space-y-4 divide-y divide-zinc-200 dark:divide-zinc-900/60">
                                    @foreach($question['rows'] as $rIdx => $row)
                                    @php $rowKey = str_replace(' ', '_', $row); @endphp
                                    <div class="space-y-2.5 pt-4 {{ $rIdx === 0 ? 'pt-0' : '' }}">
                                        <div class="text-xs font-bold text-slate-800 dark:text-white uppercase tracking-wider">{{ $row }}</div>
                                        <div class="flex flex-wrap gap-1.5 justify-between">
                                            @for($scale = $question['scale']['min']; $scale <= $question['scale']['max']; $scale++)
                                            <button type="button" @click="answers['{{ $question['id'] }}']['{{ $rowKey }}'] = '{{ $scale }}'"
                                                class="w-7 h-7 rounded border text-[9px] font-mono font-bold flex items-center justify-center transition-all duration-150 focus:outline-none"
                                                :class="answers['{{ $question['id'] }}']['{{ $rowKey }}'] == '{{ $scale }}' ? 'border-industrial-orange bg-industrial-orange text-white' : 'border-zinc-200 dark:border-zinc-850 text-zinc-550 dark:text-zinc-500 bg-white dark:bg-zinc-950'">
                                                {{ $scale }}
                                            </button>
                                            @endfor
                                        </div>
                                        <input type="hidden" name="answers[{{ $question['id'] }}][{{ $rowKey }}]" x-model="answers['{{ $question['id'] }}']['{{ $rowKey }}']" @if($question['required']) required @endif>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                @endforeach

            </div>
            @endforeach

            <!-- Navigation Controls -->
            <div class="flex items-center justify-between pt-6 border-t border-zinc-200 dark:border-zinc-900 transition-colors mt-8">
                <!-- Back Button -->
                <button type="button" @click="currentStep--" x-show="currentStep > 0"
                    class="px-6 py-3.5 text-xs font-bold uppercase tracking-widest text-zinc-500 hover:text-zinc-900 dark:text-zinc-400 dark:hover:text-white transition-colors font-display">
                    &larr; KEMBALI
                </button>
                <div x-show="currentStep === 0"></div>

                <!-- Next / Submit Button -->
                <button type="button" @click="currentStep++" x-show="currentStep < totalSteps - 1"
                    class="stealth-btn-primary px-8 py-3.5 text-xs font-bold uppercase tracking-widest font-display shadow-md">
                    BERIKUTNYA &rarr;
                </button>

                <button type="submit" x-show="currentStep === totalSteps - 1"
                    class="stealth-btn-primary px-8 py-3.5 text-xs font-bold uppercase tracking-widest font-display shadow-md">
                    KIRIM SURVEI
                </button>
            </div>

        </form>
        @endif

    </div>
</main>
@endsection
