<!DOCTYPE html>
<html lang="id" class="h-full bg-black text-slate-100">
<head>
    <!-- Initial theme loader to prevent flash of dark/light -->
    <script>
        (function() {
            const theme = localStorage.getItem('theme') || 'dark';
            if (theme === 'light') {
                document.documentElement.classList.add('light');
            } else {
                document.documentElement.classList.remove('light');
            }
        })();
    </script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Dashboard') - Coil & Cotton Vape</title>
    
    <!-- Google Fonts: Space Grotesk & Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;600;700;900&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                        display: ['Space Grotesk', 'sans-serif'],
                    },
                    colors: {
                        industrial: {
                            black: '#000000',
                            dark: '#0a0a0c',
                            light: '#0f0f12',
                            orange: '#ff5500',
                            orangeHover: '#e04b00',
                            border: '#1c1c22',
                        }
                    }
                }
            }
        }
    </script>
    
    <!-- Alpine.js CDN -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #000000;
            background-image: radial-gradient(circle at top right, rgba(255, 85, 0, 0.05), transparent 450px),
                              radial-gradient(circle at bottom left, rgba(255, 85, 0, 0.02), transparent 450px);
        }
        h1, h2, h3, h4, h5, h6, .font-display {
            font-family: 'Space Grotesk', sans-serif;
            letter-spacing: -0.02em;
        }
        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
        }
        ::-webkit-scrollbar-track {
            background: #000000;
        }
        ::-webkit-scrollbar-thumb {
            background: #1c1c22;
            border-radius: 3px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #ff5500;
        }
        
        /* Stealth Layout styles */
        .stealth-card {
            background-color: rgba(9, 9, 11, 0.6);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(39, 39, 42, 0.8);
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .stealth-card:hover {
            border-color: rgba(255, 85, 0, 0.4);
            box-shadow: 0 10px 30px -15px rgba(255, 85, 0, 0.1);
        }

        .stealth-btn-primary {
            background-color: #ff5500;
            color: #ffffff;
            font-weight: 600;
            border: 1px solid transparent;
            transition: all 0.2s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .stealth-btn-primary:hover {
            background-color: #e04b00;
            box-shadow: 0 0 20px 0px rgba(255, 85, 0, 0.35);
            transform: scale(1.02);
        }
        .stealth-btn-primary:active {
            transform: scale(0.98);
        }

        .stealth-btn-secondary {
            background-color: transparent;
            color: #e4e4e7;
            border: 1px solid rgba(63, 63, 70, 1);
            transition: all 0.2s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .stealth-btn-secondary:hover {
            border-color: #ffffff;
            color: #ffffff;
            background-color: rgba(255, 255, 255, 0.03);
        }

        /* Light Theme Overrides */
        /* Fix: html root element itself has bg-black class — must override first */
        html.light {
            background-color: #fafafa !important;
        }
        html.light body {
            background-color: #fafafa;
            color: #18181b;
            background-image: radial-gradient(circle at top right, rgba(255, 85, 0, 0.03), transparent 450px),
                              radial-gradient(circle at bottom left, rgba(255, 85, 0, 0.01), transparent 450px);
        }
        html.light aside {
            background-color: rgba(255, 255, 255, 0.95);
            border-color: #e4e4e7;
        }
        html.light aside span, html.light aside p {
            color: #18181b !important;
        }
        html.light aside nav a {
            color: #71717a !important;
        }
        html.light aside nav a:hover {
            background-color: #f4f4f5;
            color: #18181b !important;
        }
        html.light aside nav a.bg-industrial-orange\/10 {
            background-color: rgba(255, 85, 0, 0.08) !important;
            color: #ff5500 !important;
        }
        html.light .stealth-card {
            background-color: rgba(255, 255, 255, 0.8);
            border-color: #e4e4e7;
            box-shadow: 0 4px 20px -10px rgba(0, 0, 0, 0.05);
        }
        html.light .stealth-card:hover {
            border-color: rgba(255, 85, 0, 0.3);
        }
        html.light .bg-zinc-950 {
            background-color: #f4f4f5 !important;
            border-color: #e4e4e7 !important;
        }
        html.light .bg-zinc-950\/80 {
            background-color: rgba(244, 244, 245, 0.9) !important;
            border-color: #e4e4e7 !important;
        }
        html.light .bg-zinc-950\/40 {
            background-color: rgba(255, 255, 255, 0.7) !important;
        }
        html.light h1, html.light h2, html.light h3, html.light h4, html.light h5, html.light h6 {
            color: #18181b !important;
        }
        html.light p {
            color: #52525b !important;
        }
        html.light th {
            color: #71717a !important;
        }
        html.light td {
            color: #18181b !important;
        }
        html.light td div.text-slate-500 {
            color: #a1a1aa !important;
        }
        html.light .border-zinc-800 {
            border-color: #e4e4e7 !important;
        }
        html.light .divide-zinc-800\/50 > * + * {
            border-color: #e4e4e7 !important;
        }
        html.light .divide-y > * + * {
            border-color: #e4e4e7 !important;
        }
        html.light header.md\:hidden {
            background-color: #ffffff !important;
            border-color: #e4e4e7 !important;
        }
        html.light header.md\:hidden span {
            color: #18181b !important;
        }
        html.light input, html.light textarea, html.light select {
            background-color: #ffffff !important;
            border-color: #d4d4d8 !important;
            color: #18181b !important;
        }
        html.light input[type="range"] {
            background-color: #d4d4d8 !important;
        }
        html.light input:focus, html.light textarea:focus, html.light select:focus {
            border-color: #ff5500 !important;
        }
        html.light .text-slate-205, html.light .text-slate-300, html.light .text-slate-200 {
            color: #18181b !important;
        }
        html.light .text-slate-400, html.light .text-slate-450 {
            color: #52525b !important;
        }
        html.light .text-slate-500, html.light .text-slate-600 {
            color: #71717a !important;
        }
        /* All black/dark backgrounds → white/light in light mode */
        html.light .bg-black {
            background-color: #ffffff !important;
            border-color: #e4e4e7 !important;
        }
        html.light .bg-zinc-900 {
            background-color: #f4f4f5 !important;
            border-color: #e4e4e7 !important;
        }
        html.light .bg-zinc-800 {
            background-color: #d4d4d8 !important;
            border-color: #d4d4d8 !important;
        }
        html.light .bg-slate-950 {
            background-color: #f4f4f5 !important;
            border-color: #e4e4e7 !important;
        }
        html.light .bg-slate-800 {
            background-color: #d4d4d8 !important;
        }
        html.light .bg-industrial-dark {
            background-color: #ffffff !important;
            border-color: #e4e4e7 !important;
        }
        html.light .border-industrial-border {
            border-color: #e4e4e7 !important;
        }
        html.light .border-r {
            border-color: #e4e4e7 !important;
        }
        html.light .border-t {
            border-color: #e4e4e7 !important;
        }
        html.light .border-b {
            border-color: #e4e4e7 !important;
        }
        html.light .bg-industrial-black {
            background-color: #fafafa !important;
            border-color: #e4e4e7 !important;
        }
        html.light aside div.h-8 {
            background-color: #f4f4f5 !important;
            border-color: #e4e4e7 !important;
            color: #18181b !important;
        }
        html.light aside nav a.text-slate-450, html.light aside nav a.text-slate-455 {
            color: #71717a !important;
        }
        html.light aside nav a.text-slate-450:hover, html.light aside nav a.text-slate-455:hover {
            color: #18181b !important;
        }
        html.light aside button.text-slate-550 {
            color: #71717a !important;
        }
        html.light aside button.text-slate-550:hover {
            color: #ff5500 !important;
        }
    </style>
</head>
<body class="h-full">
    <div class="min-h-full flex" x-data="{ theme: localStorage.getItem('theme') || 'dark', sidebarOpen: false }">
        <!-- Sidebar for Desktop -->
        <aside class="hidden md:flex md:w-64 md:flex-col md:fixed md:inset-y-0 z-20 border-r border-industrial-border bg-industrial-dark/95 backdrop-blur-md">
            <div class="flex flex-col flex-grow pt-5 overflow-y-auto">
                <div class="flex items-center justify-between flex-shrink-0 px-6 mb-10 w-full">
                    <span class="text-base font-black tracking-tighter text-slate-100 font-display flex items-center gap-1.5 uppercase">
                        <span class="w-2 h-2 bg-industrial-orange shadow-[0_0_8px_#ff5500]"></span>
                        EXTREME PROJECT
                    </span>
                    <!-- Theme Toggle Button -->
                    <button @click="theme = (theme === 'dark' ? 'light' : 'dark'); localStorage.setItem('theme', theme); document.documentElement.classList.toggle('light', theme === 'light')" 
                            class="p-1 rounded border transition-all focus:outline-none flex items-center justify-center"
                            :class="theme === 'light' ? 'border-zinc-300 text-zinc-600 hover:text-zinc-900 hover:border-zinc-400 bg-white' : 'border-zinc-800 text-zinc-500 hover:text-white hover:border-zinc-600 bg-transparent'"
                            title="Toggle Theme">
                        <!-- Sun Icon -->
                        <svg x-show="theme === 'dark'" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364-6.364l-.707.707M6.343 17.657l-.707.707m12.728 0l-.707-.707M6.343 6.343l-.707-.707M14 12a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                        <!-- Moon Icon -->
                        <svg x-show="theme === 'light'" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="display: none;">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
                        </svg>
                    </button>
                </div>
                <nav class="flex-1 px-4 space-y-2">
                    <a href="{{ route('admin.dashboard') }}" 
                       class="group flex items-center px-4 py-2.5 text-xs font-bold rounded transition-all duration-200 uppercase tracking-wider {{ request()->routeIs('admin.dashboard') ? 'bg-industrial-orange/10 text-industrial-orange border-l-2 border-industrial-orange shadow-[inset_4px_0_12px_rgba(255,85,0,0.05)]' : 'text-slate-450 hover:text-slate-205 hover:bg-zinc-900 border-l-2 border-transparent' }}">
                        <svg class="mr-3 h-4 w-4 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                        Dashboard
                    </a>

                    <a href="{{ route('admin.products.index') }}" 
                       class="group flex items-center px-4 py-2.5 text-xs font-bold rounded transition-all duration-200 uppercase tracking-wider {{ request()->routeIs('admin.products.*') ? 'bg-industrial-orange/10 text-industrial-orange border-l-2 border-industrial-orange shadow-[inset_4px_0_12px_rgba(255,85,0,0.05)]' : 'text-slate-455 hover:text-slate-205 hover:bg-zinc-900 border-l-2 border-transparent' }}">
                        <svg class="mr-3 h-4 w-4 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                        </svg>
                        Produk
                    </a>

                    <a href="{{ route('admin.shops.index') }}" 
                       class="group flex items-center px-4 py-2.5 text-xs font-bold rounded transition-all duration-200 uppercase tracking-wider {{ request()->routeIs('admin.shops.*') ? 'bg-industrial-orange/10 text-industrial-orange border-l-2 border-industrial-orange shadow-[inset_4px_0_12px_rgba(255,85,0,0.05)]' : 'text-slate-455 hover:text-slate-205 hover:bg-zinc-900 border-l-2 border-transparent' }}">
                        <svg class="mr-3 h-4 w-4 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                        </svg>
                        Toko
                    </a>

                    <a href="{{ route('admin.password.edit') }}" 
                       class="group flex items-center px-4 py-2.5 text-xs font-bold rounded transition-all duration-200 uppercase tracking-wider {{ request()->routeIs('admin.password.*') ? 'bg-industrial-orange/10 text-industrial-orange border-l-2 border-industrial-orange shadow-[inset_4px_0_12px_rgba(255,85,0,0.05)]' : 'text-slate-455 hover:text-slate-205 hover:bg-zinc-900 border-l-2 border-transparent' }}">
                        <svg class="mr-3 h-4 w-4 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                        Password
                    </a>
                    <a href="{{ route('home') }}" target="_blank"
                       class="group flex items-center px-4 py-2.5 text-xs font-bold text-slate-400 hover:text-slate-200 hover:bg-zinc-900 border-l-2 border-transparent rounded transition-all duration-200 uppercase tracking-wider">
                        <svg class="mr-3 h-4 w-4 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                        </svg>
                        Lihat Situs
                    </a>
                </nav>
            </div>
            
            <!-- User Context -->
            <div class="flex-shrink-0 flex border-t border-industrial-border p-4 bg-industrial-black">
                <div class="flex items-center justify-between w-full">
                    <div class="flex items-center">
                        <div class="h-8 w-8 rounded-none border border-industrial-orange/30 flex items-center justify-center font-bold text-industrial-orange text-xs font-display">
                            M
                        </div>
                        <div class="ml-3">
                            <p class="text-[11px] font-bold text-slate-300 leading-none uppercase tracking-wide">{{ Auth::user()->name ?? 'Manager' }}</p>
                            <p class="text-[9px] text-slate-500 mt-1">{{ Auth::user()->email ?? 'admin@vape.com' }}</p>
                        </div>
                    </div>
                    
                    <form action="{{ route('logout') }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin keluar dari panel admin?');">
                        @csrf
                        <button type="submit" class="p-1.5 rounded text-slate-550 hover:text-industrial-orange hover:bg-slate-900 transition-all duration-200">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        <!-- Mobile Layout Header -->
        <div class="flex-1 flex flex-col md:pl-64">
            <header class="md:hidden flex items-center justify-between h-16 bg-industrial-dark border-b border-industrial-border sticky top-0 z-30 px-4">
                <div class="flex items-center gap-3">
                    <span class="text-base font-black tracking-tighter text-slate-100 font-display flex items-center gap-1.5 uppercase">
                        <span class="w-1.5 h-1.5 bg-industrial-orange shadow-[0_0_8px_#ff5500]"></span>
                        EXTREME PROJECT
                    </span>
                    <!-- Theme Toggle Button -->
                    <button @click="theme = (theme === 'dark' ? 'light' : 'dark'); localStorage.setItem('theme', theme); document.documentElement.classList.toggle('light', theme === 'light')" 
                            class="p-1 rounded border transition-all focus:outline-none flex items-center justify-center"
                            :class="theme === 'light' ? 'border-zinc-300 text-zinc-600 hover:text-zinc-900 hover:border-zinc-400 bg-white' : 'border-zinc-800 text-zinc-500 hover:text-white hover:border-zinc-600 bg-transparent'"
                            title="Toggle Theme">
                        <!-- Sun Icon -->
                        <svg x-show="theme === 'dark'" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364-6.364l-.707.707M6.343 17.657l-.707.707m12.728 0l-.707-.707M6.343 6.343l-.707-.707M14 12a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                        <!-- Moon Icon -->
                        <svg x-show="theme === 'light'" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="display: none;">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
                        </svg>
                    </button>
                </div>
                
                <button type="button" @click="sidebarOpen = !sidebarOpen" class="p-2 text-slate-400 hover:text-slate-200 focus:outline-none">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </header>

            <!-- Backdrop -->
            <div class="fixed inset-0 z-40 md:hidden bg-black/90 backdrop-blur-sm" 
                 x-show="sidebarOpen" 
                 x-transition:enter="transition-opacity ease-linear duration-200"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="transition-opacity ease-linear duration-200"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 @click="sidebarOpen = false" style="display: none;"></div>

            <!-- Mobile Drawer -->
            <div class="fixed inset-y-0 left-0 flex flex-col max-w-xs w-full bg-industrial-black border-r border-industrial-border z-50 md:hidden"
                 x-show="sidebarOpen"
                 x-transition:enter="transition ease-in-out duration-250 transform"
                 x-transition:enter-start="-translate-x-full"
                 x-transition:enter-end="translate-x-0"
                 x-transition:leave="transition ease-in-out duration-250 transform"
                 x-transition:leave-start="translate-x-0"
                 x-transition:leave-end="-translate-x-full" style="display: none;">
                <div class="flex items-center justify-between h-16 px-4 border-b border-industrial-border">
                    <span class="text-sm font-black tracking-tighter text-slate-100 font-display">
                        ADMIN
                    </span>
                    <button type="button" @click="sidebarOpen = false" class="p-2 text-slate-450 hover:text-slate-200">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
                <nav class="flex-1 px-4 py-4 space-y-2 overflow-y-auto">
                    <a href="{{ route('admin.dashboard') }}" class="block px-3 py-2.5 rounded text-sm font-bold uppercase tracking-wider {{ request()->routeIs('admin.dashboard') ? 'bg-industrial-orange/10 text-industrial-orange' : 'text-slate-400 hover:bg-slate-900' }}">
                        Dashboard
                    </a>
                    <a href="{{ route('admin.products.index') }}" class="block px-3 py-2.5 rounded text-sm font-bold uppercase tracking-wider {{ request()->routeIs('admin.products.*') ? 'bg-industrial-orange/10 text-industrial-orange' : 'text-slate-400 hover:bg-slate-900' }}">
                        Produk
                    </a>
                    <a href="{{ route('admin.shops.index') }}" class="block px-3 py-2.5 rounded text-sm font-bold uppercase tracking-wider {{ request()->routeIs('admin.shops.*') ? 'bg-industrial-orange/10 text-industrial-orange' : 'text-slate-400 hover:bg-slate-900' }}">
                        Toko
                    </a>
                    <a href="{{ route('admin.password.edit') }}" class="block px-3 py-2.5 rounded text-sm font-bold uppercase tracking-wider {{ request()->routeIs('admin.password.*') ? 'bg-industrial-orange/10 text-industrial-orange' : 'text-slate-400 hover:bg-slate-900' }}">
                        Password
                    </a>
                    <a href="{{ route('home') }}" target="_blank" class="block px-3 py-2.5 rounded text-sm font-bold uppercase tracking-wider text-slate-400 hover:bg-slate-900">
                        Lihat Situs
                    </a>
                </nav>
                <div class="border-t border-industrial-border p-4 bg-industrial-black">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-bold text-slate-300 uppercase tracking-wide">{{ Auth::user()->name ?? 'Manager' }}</p>
                            <p class="text-[10px] text-slate-500 font-mono">{{ Auth::user()->email ?? 'admin@vape.com' }}</p>
                        </div>
                        <form action="{{ route('logout') }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin keluar dari panel admin?');">
                            @csrf
                            <button type="submit" class="p-2 rounded text-slate-550 hover:text-industrial-orange">
                                Keluar
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Page Main Content Area -->
            <main class="flex-1 py-8 px-4 sm:px-6 lg:px-8">
                <!-- Session Alerts -->
                @if (session('success'))
                    <div class="mb-6 p-4 rounded bg-industrial-dark border border-industrial-orange/30 text-slate-205 flex items-center shadow-lg" x-data="{ show: true }" x-show="show">
                        <svg class="h-4 w-4 text-industrial-orange mr-3 flex-shrink-0 animate-pulse" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span class="text-xs font-semibold uppercase tracking-wider">{{ session('success') }}</span>
                        <button type="button" @click="show = false" class="ml-auto text-slate-500 hover:text-slate-400">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>
                @endif

                @if ($errors->any() && !request()->routeIs('login'))
                    <div class="mb-6 p-4 rounded bg-industrial-dark border border-red-900/30 text-slate-300 shadow-lg" x-data="{ show: true }" x-show="show">
                        <div class="flex items-center mb-2 border-b border-red-950 pb-2">
                            <svg class="h-4 w-4 text-red-500 mr-3 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                            </svg>
                            <span class="text-xs font-bold uppercase tracking-wider text-red-500">Validation Errors:</span>
                            <button type="button" @click="show = false" class="ml-auto text-slate-500 hover:text-slate-400">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </button>
                        </div>
                        <ul class="list-disc pl-8 text-xs space-y-1 text-slate-455">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>
