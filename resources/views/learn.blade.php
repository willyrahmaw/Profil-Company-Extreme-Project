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
            EDUCATION_HUB
        </span>
    </div>
</header>

<main class="flex-grow py-12 px-4 sm:px-6 lg:px-8 relative overflow-hidden" x-data="{ activeTab: 0 }">
    <!-- Background blueprint pattern -->
    <div class="absolute inset-0 opacity-[0.02] dark:opacity-[0.04] pointer-events-none z-0">
        <svg class="w-full h-full" viewBox="0 0 100 100" fill="none" stroke="currentColor">
            <pattern id="grid" width="10" height="10" patternUnits="userSpaceOnUse">
                <path d="M 10 0 L 0 0 0 10" fill="none" stroke-width="0.5" />
            </pattern>
            <rect width="100%" height="100%" fill="url(#grid)" />
        </svg>
    </div>

    <div class="max-w-7xl mx-auto relative z-10">
        <!-- Title Header -->
        <div class="text-center md:text-left space-y-4 mb-12 border-b border-zinc-200 dark:border-zinc-900 pb-8 transition-colors duration-300">
            <h1 class="text-3xl sm:text-5xl font-black tracking-tight text-slate-900 dark:text-white font-display uppercase leading-tight">
                CUSTOMER EDUCATION HUB
            </h1>
            <p class="text-zinc-550 dark:text-zinc-400 text-xs sm:text-sm leading-relaxed max-w-2xl font-sans font-light">
                Selamat datang di laboratorium edukasi EXTREME PROJECT. Pelajari cara memaksimalkan ekstraksi rasa, merawat kawat coil handmade, dan memperpanjang umur build atomizer Anda.
            </p>
        </div>

        <!-- 2-Column Tab Layout -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">

            <!-- Left Navigation Menu (Desktop Sidebar / Mobile Horizontal Scroller) -->
            <div class="lg:col-span-4 space-y-2.5">
                <span class="hidden lg:block text-[8px] font-bold text-zinc-450 dark:text-zinc-550 uppercase tracking-widest font-mono mb-4">[ GUIDES_NAVIGATION ]</span>

                <!-- Desktop Sidebar list -->
                <div class="hidden lg:flex flex-col gap-2">
                    @foreach($guides as $idx => $guideItem)
                    <button type="button" @click="activeTab = {{ $idx }}"
                        class="w-full text-left p-4 border transition-all duration-200 font-display text-[10px] font-bold uppercase tracking-wider flex items-center justify-between group"
                        :class="activeTab === {{ $idx }} ? 'border-industrial-orange bg-industrial-orange/5 text-industrial-orange shadow-[inset_4px_0_12px_rgba(255,85,0,0.05)]' : 'border-zinc-200 dark:border-zinc-900 text-zinc-650 dark:text-zinc-500 hover:text-slate-900 dark:hover:text-white bg-zinc-950/10 hover:border-zinc-400 dark:hover:border-zinc-800'">
                        <span>0{{ $idx + 1 }}_ {{ $guideItem->title }}</span>
                        <svg class="h-3 w-3 opacity-0 group-hover:opacity-100 transition-opacity" :class="activeTab === {{ $idx }} ? 'opacity-100 text-industrial-orange' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>
                    @endforeach
                </div>

                <!-- Mobile Navigation Selector Dropdown -->
                <div class="block lg:hidden">
                    <label for="mobile-tabs-selector" class="block text-[8px] font-bold text-zinc-550 uppercase tracking-widest font-mono mb-2">Pilih Panduan:</label>
                    <select id="mobile-tabs-selector" x-model.number="activeTab"
                        class="block w-full rounded-xl bg-zinc-50 dark:bg-zinc-950 border border-zinc-200 dark:border-zinc-900 text-slate-800 dark:text-zinc-200 px-4 py-3 text-xs focus:outline-none focus:ring-1 focus:ring-industrial-orange font-bold uppercase font-mono cursor-pointer">
                        @foreach($guides as $idx => $guideItem)
                        <option value="{{ $idx }}">0{{ $idx + 1 }}_ {{ $guideItem->title }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Right Reading Content Area -->
            <div class="lg:col-span-8 bg-white/40 dark:bg-zinc-950/10 border border-zinc-250 dark:border-zinc-900 rounded-2xl p-6 sm:p-10 shadow-sm transition-all duration-300 min-h-[500px]">
                @if($guides->isEmpty())
                <div class="py-16 text-center">
                    <svg class="mx-auto h-12 w-12 text-slate-500 animate-pulse" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                    <h3 class="mt-4 text-slate-400 font-bold uppercase tracking-wider text-xs font-display">Belum Ada Panduan</h3>
                    <p class="mt-1 text-slate-500 text-xs">Silakan hubungi administrator untuk mengisi panduan edukasi.</p>
                </div>
                @else
                @foreach($guides as $idx => $guideItem)
                <div x-show="activeTab === {{ $idx }}" class="space-y-6 animate-fade-in" x-cloak>
                    <h2 class="text-2xl font-black text-slate-900 dark:text-white uppercase font-display border-b border-zinc-250 dark:border-zinc-900 pb-4 tracking-wider">
                        {{ $guideItem->title }}
                    </h2>
                    <div class="text-zinc-650 dark:text-zinc-400 text-xs sm:text-sm font-sans font-light leading-relaxed space-y-4">
                        {!! $guideItem->content !!}
                    </div>
                </div>
                @endforeach
                @endif
            </div>
        </div>

    </div>
</main>
@endsection