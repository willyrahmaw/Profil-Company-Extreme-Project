    <!-- Header Navigation -->
    <header class="sticky top-0 z-50 bg-white/85 dark:bg-black/85 backdrop-blur-md border-b border-zinc-200 dark:border-zinc-900 transition-colors duration-300"
        x-data="{ mobileOpen: false }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">

            <!-- Logo -->
            <a href="#" class="flex items-center gap-2 group">
                @if($siteSettings && $siteSettings->logo_path)
                <img src="{{ $siteSettings->logo_path }}" alt="Logo" class="h-20 w-auto object-contain hidden dark:block" fetchpriority="high" loading="eager">
                @endif
                @if($siteSettings && ($siteSettings->logo_light_path || $siteSettings->logo_path))
                <img src="{{ $siteSettings->logo_light_path ?: $siteSettings->logo_path }}" alt="Logo" class="h-20 w-auto object-contain block dark:hidden" fetchpriority="high" loading="eager">
                @else
                <span class="pulse-dot"></span>
                @endif
            </a>

            <!-- Desktop Nav -->
            <nav class="hidden lg:flex items-center gap-8 text-[10px] font-bold uppercase tracking-widest text-zinc-550 dark:text-zinc-400 font-sans">
                <a href="{{ route('home') }}" class="hover:text-industrial-orange dark:hover:text-white transition-colors">HOME</a>
                <a href="{{ route('home') }}#products" class="hover:text-industrial-orange dark:hover:text-white transition-colors">PRODUCTS</a>
                <a href="{{ route('home') }}#compare-coils" class="hover:text-industrial-orange dark:hover:text-white transition-colors">COIL GUIDE</a>
                <a href="{{ route('home') }}#why-choose-me" class="hover:text-industrial-orange dark:hover:text-white transition-colors">Why Choose Me</a>
                <a href="{{ route('learn') }}" class="hover:text-industrial-orange dark:hover:text-white transition-colors">LEARN</a>
                <a href="{{ route('home') }}#faq" class="hover:text-industrial-orange dark:hover:text-white transition-colors">FAQ</a>
                <a href="{{ route('home') }}#ordering" class="hover:text-industrial-orange dark:hover:text-white transition-colors">CONTACT</a>
            </nav>

            <!-- Right Controls -->
            <div class="flex items-center gap-3">
                <!-- Theme Toggle -->
                <button @click="toggleTheme()"
                    class="p-2 rounded border transition-all focus:outline-none flex items-center justify-center bg-zinc-100 dark:bg-transparent border-zinc-300 dark:border-zinc-800 text-zinc-650 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-white"
                    title="Toggle Theme">
                    <svg x-show="isDark" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364-6.364l-.707.707M6.343 17.657l-.707.707m12.728 0l-.707-.707M6.343 6.343l-.707-.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                    <svg x-show="!isDark" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" x-cloak>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                    </svg>
                </button>

                <!-- Shopping Cart Button -->
                <button @click="orderModalOpen = true"
                    class="relative p-2.5 rounded border transition-all focus:outline-none flex items-center justify-center bg-zinc-100 dark:bg-transparent border-zinc-300 dark:border-zinc-800 text-zinc-650 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-white group"
                    title="Keranjang Belanja">
                    <svg class="h-5 w-5 group-hover:scale-105 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    <span x-show="cartCount > 0" class="absolute -top-1 -right-1 flex h-4 w-4" x-cloak>
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-industrial-orange opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-4 w-4 bg-industrial-orange text-[8px] font-black text-white items-center justify-center font-display leading-none" x-text="cartCount"></span>
                    </span>
                </button>

                <!-- Desktop: ORDER NOW button -->
                <a href="{{ route('home') }}#ordering" class="hidden lg:inline-flex stealth-btn-primary px-5 py-2.5 text-[10px] uppercase font-bold tracking-widest">
                    ORDER NOW
                </a>

                <!-- Mobile: Hamburger Button -->
                <button @click="mobileOpen = !mobileOpen"
                    class="lg:hidden p-2 rounded border transition-all focus:outline-none flex items-center justify-center bg-zinc-100 dark:bg-transparent border-zinc-300 dark:border-zinc-800 text-zinc-700 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-white"
                    :aria-expanded="mobileOpen"
                    aria-label="Toggle navigation">
                    <!-- Hamburger Icon -->
                    <svg x-show="!mobileOpen" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <!-- X Icon -->
                    <svg x-show="mobileOpen" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" x-cloak>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Menu Dropdown -->
        <div x-show="mobileOpen"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 -translate-y-2"
            x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 -translate-y-2"
            class="lg:hidden bg-white/95 dark:bg-black/95 backdrop-blur-md border-t border-zinc-200 dark:border-zinc-900"
            x-cloak>
            <nav class="max-w-7xl mx-auto px-4 py-4 flex flex-col gap-1">
                <a href="{{ route('home') }}"
                    @click="mobileOpen = false"
                    class="mobile-nav-item flex items-center gap-3 px-4 py-3 text-[11px] font-bold uppercase tracking-widest text-zinc-600 dark:text-zinc-400 hover:text-industrial-orange dark:hover:text-industrial-orange hover:bg-zinc-50 dark:hover:bg-zinc-900/50 rounded transition-all">
                    <span class="w-1 h-1 bg-industrial-orange rounded-full"></span>
                    HOME
                </a>
                <a href="{{ route('home') }}#products"
                    @click="mobileOpen = false"
                    class="mobile-nav-item flex items-center gap-3 px-4 py-3 text-[11px] font-bold uppercase tracking-widest text-zinc-600 dark:text-zinc-400 hover:text-industrial-orange dark:hover:text-industrial-orange hover:bg-zinc-50 dark:hover:bg-zinc-900/50 rounded transition-all">
                    <span class="w-1 h-1 bg-industrial-orange rounded-full"></span>
                    PRODUCTS
                </a>
                <a href="{{ route('home') }}#compare-coils"
                    @click="mobileOpen = false"
                    class="mobile-nav-item flex items-center gap-3 px-4 py-3 text-[11px] font-bold uppercase tracking-widest text-zinc-600 dark:text-zinc-400 hover:text-industrial-orange dark:hover:text-industrial-orange hover:bg-zinc-50 dark:hover:bg-zinc-900/50 rounded transition-all">
                    <span class="w-1 h-1 bg-industrial-orange rounded-full"></span>
                    COIL GUIDE
                </a>
                <a href="{{ route('home') }}#why-choose-me"
                    @click="mobileOpen = false"
                    class="mobile-nav-item flex items-center gap-3 px-4 py-3 text-[11px] font-bold uppercase tracking-widest text-zinc-600 dark:text-zinc-400 hover:text-industrial-orange dark:hover:text-industrial-orange hover:bg-zinc-50 dark:hover:bg-zinc-900/50 rounded transition-all">
                    <span class="w-1 h-1 bg-industrial-orange rounded-full"></span>
                    ABOUT
                </a>
                <a href="{{ route('learn') }}"
                    @click="mobileOpen = false"
                    class="mobile-nav-item flex items-center gap-3 px-4 py-3 text-[11px] font-bold uppercase tracking-widest text-zinc-600 dark:text-zinc-400 hover:text-industrial-orange dark:hover:text-industrial-orange hover:bg-zinc-50 dark:hover:bg-zinc-900/50 rounded transition-all">
                    <span class="w-1 h-1 bg-industrial-orange rounded-full"></span>
                    LEARN
                </a>
                <a href="{{ route('home') }}#faq"
                    @click="mobileOpen = false"
                    class="mobile-nav-item flex items-center gap-3 px-4 py-3 text-[11px] font-bold uppercase tracking-widest text-zinc-600 dark:text-zinc-400 hover:text-industrial-orange dark:hover:text-industrial-orange hover:bg-zinc-50 dark:hover:bg-zinc-900/50 rounded transition-all">
                    <span class="w-1 h-1 bg-industrial-orange rounded-full"></span>
                    FAQ
                </a>
                <a href="{{ route('home') }}#ordering"
                    @click="mobileOpen = false"
                    class="mobile-nav-item flex items-center gap-3 px-4 py-3 text-[11px] font-bold uppercase tracking-widest text-zinc-600 dark:text-zinc-400 hover:text-industrial-orange dark:hover:text-industrial-orange hover:bg-zinc-50 dark:hover:bg-zinc-900/50 rounded transition-all">
                    <span class="w-1 h-1 bg-industrial-orange rounded-full"></span>
                    CONTACT
                </a>

                <!-- Divider -->
                <div class="border-t border-zinc-200 dark:border-zinc-800 my-1"></div>

                <!-- ORDER NOW mobile CTA -->
                <a href="{{ route('home') }}#ordering"
                    @click="mobileOpen = false"
                    class="stealth-btn-primary mx-4 py-3.5 text-[11px] uppercase font-bold tracking-widest text-center mt-1">
                    ORDER NOW →
                </a>
            </nav>
        </div>
    </header>

    @if($hasActiveEvent)
    <div class="bg-industrial-orange text-white text-[10px] font-bold uppercase tracking-[0.2em] py-2.5 px-4 text-center font-display relative overflow-hidden shadow-inner flex items-center justify-center gap-2">
        <span class="w-1.5 h-1.5 bg-white rounded-full animate-ping"></span>
        <span>EVENT AKTIF: {{ $activeEvent->name }} - DISKON {{ $discountPercentage }}% UNTUK SEMUA PRODUK!</span>
        <span class="w-1.5 h-1.5 bg-white rounded-full animate-ping"></span>
    </div>
    @endif
