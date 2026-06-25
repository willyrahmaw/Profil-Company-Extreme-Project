<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <!-- Initial theme loader to prevent flash of dark/light -->
    <script>
        (function() {
            const theme = localStorage.getItem('theme') || 'dark';
            if (theme === 'dark') {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        })();
    </script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Extreme Project - The Art of Coil Building</title>

    <!-- Meta tags for SEO -->
    <meta name="description" content="Koleksi coil vape handmade premium dan kapas wicking organik 100% kimia bebas dari Extreme Project. Dirancang khusus untuk memecah layer rasa liquid secara maksimal.">
    <meta name="keywords" content="extreme project, handmade coil, vape cotton, alien fused clapton, reaktor rasa, coil building indonesia">

    <!-- Google Fonts: Space Grotesk (Brutalist Tech) & Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;700;900&family=Inter:wght@300;400;500;600;700&family=Share+Tech+Mono&display=swap" rel="stylesheet">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class', // Mengaktifkan mode gelap berbasis class
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                        display: ['Space Grotesk', 'sans-serif'],
                        mono: ['Share Tech Mono', 'monospace'],
                    },
                    colors: {
                        industrial: {
                            black: '#000000',
                            dark: '#07070a',
                            light: '#0e0e12',
                            orange: '#ff5500',
                            orangeHover: '#d14600',
                            border: '#1b1b22',
                            borderMuted: '#0d0d12',
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
            background-image: radial-gradient(circle at 10% 10%, rgba(255, 85, 0, 0.03) 0%, transparent 40%),
                radial-gradient(circle at 90% 90%, rgba(255, 85, 0, 0.02) 0%, transparent 40%);
        }

        .dark body {
            background-image: radial-gradient(circle at 10% 10%, rgba(255, 85, 0, 0.05) 0%, transparent 40%),
                radial-gradient(circle at 90% 90%, rgba(255, 85, 0, 0.03) 0%, transparent 40%);
        }

        h1, h2, h3, h4, h5, h6, .font-display {
            font-family: 'Space Grotesk', sans-serif;
            letter-spacing: -0.02em;
        }

        /* Grid background overlay */
        .industrial-grid {
            background-size: 30px 30px;
            background-image:
                linear-gradient(to right, rgba(0, 0, 0, 0.03) 1px, transparent 1px),
                linear-gradient(to bottom, rgba(0, 0, 0, 0.03) 1px, transparent 1px);
        }

        .dark .industrial-grid {
            background-image:
                linear-gradient(to right, rgba(255, 85, 0, 0.01) 1px, transparent 1px),
                linear-gradient(to bottom, rgba(255, 85, 0, 0.01) 1px, transparent 1px);
        }

        /* Pulse dot indicator */
        @keyframes pulse-glow {
            0%, 100% {
                transform: scale(1);
                opacity: 0.5;
                box-shadow: 0 0 0 0 rgba(255, 85, 0, 0.4);
            }
            50% {
                transform: scale(1.2);
                opacity: 1;
                box-shadow: 0 0 8px 3px rgba(255, 85, 0, 0.8);
            }
        }

        .pulse-dot {
            width: 6px;
            height: 6px;
            background-color: #ff5500;
            border-radius: 50%;
            display: inline-block;
            animation: pulse-glow 2s infinite ease-in-out;
        }

        /* Scanner Scanline effect */
        @keyframes scan {
            0% { top: -10%; }
            50% { top: 110%; }
            100% { top: -10%; }
        }

        .scanline::after {
            content: '';
            position: absolute;
            width: 100%;
            height: 1px;
            background: rgba(255, 85, 0, 0.4);
            box-shadow: 0 0 8px rgba(255, 85, 0, 0.6);
            left: 0;
            animation: scan 6s linear infinite;
        }

        /* Stealth Layout styles - Colors moved to Tailwind classes */
        .stealth-card {
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .stealth-card:hover {
            box-shadow: 0 10px 30px -15px rgba(255, 85, 0, 0.1);
            transform: translateY(-2px);
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
            color: #ffffff;
        }

        .stealth-btn-primary:active {
            transform: scale(0.98);
        }

        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body class="min-h-screen flex flex-col justify-between overflow-x-hidden industrial-grid bg-slate-50 dark:bg-black text-slate-900 dark:text-slate-100 transition-colors duration-300" x-data="{ theme: localStorage.getItem('theme') || 'dark', showAllCoils: false, showAllCottons: false }">

    @php
    $whatsappShops = $shops->where('platform', 'whatsapp');
    $instagramShops = $shops->where('platform', 'instagram');
    $tiktokShops = $shops->where('platform', 'tiktok');

    $firstWhatsapp = $whatsappShops->first();
    $defaultWaUrl = $firstWhatsapp ? $firstWhatsapp->url : 'https://wa.me/628123456789';
    @endphp

    <!-- Header Navigation -->
    <header class="sticky top-0 z-50 bg-white/85 dark:bg-black/85 backdrop-blur-md border-b border-zinc-200 dark:border-zinc-900 transition-colors duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
            <a href="#" class="flex items-center gap-2 group">
                <span class="pulse-dot"></span>
                <span class="text-md font-bold tracking-widest text-slate-900 dark:text-white font-display uppercase transition-colors group-hover:text-industrial-orange dark:group-hover:text-industrial-orange">
                    EXTREME PROJECT
                </span>
            </a>

            <nav class="hidden lg:flex items-center gap-8 text-[10px] font-bold uppercase tracking-widest text-zinc-500 dark:text-zinc-400 font-sans">
                <a href="#hero" class="hover:text-industrial-orange dark:hover:text-white transition-colors">MAIN</a>
                <a href="#standards" class="hover:text-industrial-orange dark:hover:text-white transition-colors">STANDARDS</a>
                <a href="#products" class="hover:text-industrial-orange dark:hover:text-white transition-colors">PRODUK</a>
                <a href="#catalog-coils" class="hover:text-industrial-orange dark:hover:text-white transition-colors">COILS</a>
                <a href="#catalog-cottons" class="hover:text-industrial-orange dark:hover:text-white transition-colors">COTTONS</a>
                <a href="#ordering" class="hover:text-industrial-orange dark:hover:text-white transition-colors">ORDER NOW</a>
            </nav>

            <div class="flex items-center gap-6">
                <!-- Theme Toggle Button -->
                <button @click="theme = (theme === 'dark' ? 'light' : 'dark'); localStorage.setItem('theme', theme); theme === 'dark' ? document.documentElement.classList.add('dark') : document.documentElement.classList.remove('dark')"
                    class="p-2 rounded border transition-all focus:outline-none flex items-center justify-center bg-zinc-100 dark:bg-transparent border-zinc-300 dark:border-zinc-800 text-zinc-600 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-white"
                    title="Toggle Theme">
                    <!-- Sun Icon (Muncul saat Dark Mode) -->
                    <svg x-show="theme === 'dark'" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364-6.364l-.707.707M6.343 17.657l-.707.707m12.728 0l-.707-.707M6.343 6.343l-.707-.707M14 12a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    <!-- Moon Icon (Muncul saat Light Mode) -->
                    <svg x-show="theme === 'light'" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" x-cloak>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                    </svg>
                </button>

                <a href="#ordering" class="stealth-btn-primary px-5 py-2.5 text-[10px] uppercase font-bold tracking-widest">
                    ORDER NOW
                </a>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow">

        <!-- Hero Section -->
        <section id="hero" class="relative py-20 sm:py-28 overflow-hidden border-b border-zinc-200 dark:border-zinc-900 transition-colors duration-300">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                <div class="flex flex-col items-center text-center space-y-8">

                    <!-- Lab Status Indicator -->
                    <div class="inline-flex items-center gap-2 px-3 py-1 bg-white dark:bg-zinc-950 border border-zinc-200 dark:border-zinc-800 text-[9px] font-bold text-industrial-orange uppercase tracking-widest font-mono mx-auto shadow-sm dark:shadow-none transition-colors duration-300">
                        <span class="w-1.5 h-1.5 bg-industrial-orange rounded-full animate-ping"></span>
                        Precision. Performance. Innovation
                    </div>

                    <!-- Centered Headline -->
                    <h1 class="text-4xl sm:text-6xl md:text-7xl font-black tracking-tight font-display uppercase leading-tight text-slate-900 dark:text-white max-w-4xl mx-auto transition-colors duration-300">
                        EXPERIENCE THE <br>
                        <span class="text-industrial-orange">
                            NEXT LEVEL OF FLAVOR
                        </span>
                    </h1>

                    <!-- Centered Description -->
                    <p class="text-zinc-600 dark:text-zinc-400 text-sm sm:text-base leading-relaxed max-w-2xl font-sans font-light mx-auto transition-colors duration-300">
                        EXTREME PROJECT menghadirkan coil dan organic cotton premium yang dirancang khusus untuk vapers yang mengutamakan performa maksimal, flavor yang kaya, serta konsistensi dalam setiap build.
                    </p>

                    <!-- Centered Actions -->
                    <div class="flex flex-col sm:flex-row items-stretch sm:items-center justify-center gap-4 w-full max-w-md mx-auto pt-2">
                        <a href="#products" class="stealth-btn-primary px-8 py-4 text-xs font-bold uppercase tracking-widest text-center font-display shadow-md dark:shadow-none">
                            EXPLORE CATALOG
                        </a>
                        <a href="#standards" class="px-8 py-4 text-xs font-bold uppercase tracking-widest text-center font-display transition-all duration-200 text-zinc-600 dark:text-zinc-200 border border-zinc-300 dark:border-zinc-700 hover:border-slate-900 dark:hover:border-white hover:text-slate-900 dark:hover:text-white hover:bg-zinc-100 dark:hover:bg-zinc-800/50 hover:scale-105">
                            EXTREME STANDARDS &rarr;
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- The Extreme Standards Section -->
        <section id="standards" class="py-24 bg-slate-50 dark:bg-black border-b border-zinc-200 dark:border-zinc-900 relative overflow-hidden transition-colors duration-300">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-12 items-start mb-20 border-b border-zinc-200 dark:border-zinc-900 pb-12 transition-colors duration-300">
                    <div class="space-y-4 lg:col-span-1">
                        <span class="text-[9px] font-bold text-industrial-orange uppercase tracking-widest font-mono bg-white dark:bg-zinc-950 px-3 py-1 border border-zinc-200 dark:border-zinc-800 shadow-sm dark:shadow-none transition-colors duration-300">
                            SPEC: EX_STANDARDS_SYS
                        </span>
                        <h2 class="text-3xl sm:text-5xl font-black tracking-tight text-slate-900 dark:text-white font-display uppercase leading-none mt-6 transition-colors duration-300">
                            THE ART OF <br>COIL BUILDING
                        </h2>
                    </div>
                    <div class="text-zinc-600 dark:text-zinc-400 text-xs sm:text-sm leading-relaxed lg:col-span-2 space-y-4 font-sans font-light transition-colors duration-300">
                        <p>
                            Di <strong class="text-slate-900 dark:text-white font-bold transition-colors duration-300">Extreme Project</strong>, kami percaya bahwa pengalaman rasa yang sempurna tidak lahir secara kebetulan. Kami menggabungkan sains ketahanan material dengan keahlian tangan (<em class="text-slate-800 dark:text-white font-semibold not-italic">craftsmanship</em>) demi menciptakan standar baru di industri <em class="text-industrial-orange font-bold not-italic">front-end</em> vaping.
                        </p>
                        <p>
                            Kombinasi lilitan presisi mikro menghasilkan nilai hambatan yang luar biasa stabil, ketahanan performa jangka panjang, serta jaminan higienitas mutlak karena telah melalui proses pembersihan sterilisasi ultrasonik sebelum dikemas.
                        </p>
                    </div>
                </div>

                <!-- 6 Pillars Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                    <!-- Pillar 1 -->
                    <div class="stealth-card p-8 rounded-none relative bg-white/80 dark:bg-zinc-900/60 border border-zinc-200 dark:border-zinc-800 hover:border-industrial-orange/50 dark:hover:border-industrial-orange/50 shadow-sm dark:shadow-none transition-colors duration-300">
                        <div class="flex justify-between items-center mb-6">
                            <span class="text-[9px] font-mono text-zinc-500 uppercase tracking-widest">EX-01 // COIL_BUILD</span>
                            <span class="pulse-dot"></span>
                        </div>
                        <h3 class="text-xs font-bold text-slate-900 dark:text-white tracking-wider font-sans uppercase transition-colors duration-300">Handmade Quality</h3>
                        <p class="text-zinc-500 dark:text-zinc-400 text-xs leading-relaxed mt-3 font-sans font-light transition-colors duration-300">
                            Setiap pasang coil dirakit manual secara presisi oleh builder ahli untuk menjamin kualitas struktur lilitan yang sempurna.
                        </p>
                    </div>

                    <!-- Pillar 2 -->
                    <div class="stealth-card p-8 rounded-none relative bg-white/80 dark:bg-zinc-900/60 border border-zinc-200 dark:border-zinc-800 hover:border-industrial-orange/50 dark:hover:border-industrial-orange/50 shadow-sm dark:shadow-none transition-colors duration-300">
                        <div class="flex justify-between items-center mb-6">
                            <span class="text-[9px] font-mono text-zinc-500 uppercase tracking-widest">EX-02 // RAW_MTRL</span>
                            <span class="pulse-dot"></span>
                        </div>
                        <h3 class="text-xs font-bold text-slate-900 dark:text-white tracking-wider font-sans uppercase transition-colors duration-300">Premium Ni80 Material</h3>
                        <p class="text-zinc-500 dark:text-zinc-400 text-xs leading-relaxed mt-3 font-sans font-light transition-colors duration-300">
                            Menggunakan kawat spesifikasi industri tertinggi dengan tingkat kemurnian prima demi konduktivitas elektrik terbaik.
                        </p>
                    </div>

                    <!-- Pillar 3 -->
                    <div class="stealth-card p-8 rounded-none relative bg-white/80 dark:bg-zinc-900/60 border border-zinc-200 dark:border-zinc-800 hover:border-industrial-orange/50 dark:hover:border-industrial-orange/50 shadow-sm dark:shadow-none transition-colors duration-300">
                        <div class="flex justify-between items-center mb-6">
                            <span class="text-[9px] font-mono text-zinc-500 uppercase tracking-widest">EX-03 // RAMP_UP</span>
                            <span class="pulse-dot"></span>
                        </div>
                        <h3 class="text-xs font-bold text-slate-900 dark:text-white tracking-wider font-sans uppercase transition-colors duration-300">Instant Ramp-Up Time</h3>
                        <p class="text-zinc-500 dark:text-zinc-400 text-xs leading-relaxed mt-3 font-sans font-light transition-colors duration-300">
                            Distribusi panas yang instan dan merata, menghasilkan pembakaran optimal tanpa jeda sejak detik pertama.
                        </p>
                    </div>

                    <!-- Pillar 4 -->
                    <div class="stealth-card p-8 rounded-none relative bg-white/80 dark:bg-zinc-900/60 border border-zinc-200 dark:border-zinc-800 hover:border-industrial-orange/50 dark:hover:border-industrial-orange/50 shadow-sm dark:shadow-none transition-colors duration-300">
                        <div class="flex justify-between items-center mb-6">
                            <span class="text-[9px] font-mono text-zinc-500 uppercase tracking-widest">EX-04 // VAP_DENS</span>
                            <span class="pulse-dot"></span>
                        </div>
                        <h3 class="text-xs font-bold text-slate-900 dark:text-white tracking-wider font-sans uppercase transition-colors duration-300">Dense Vapor Production</h3>
                        <p class="text-zinc-500 dark:text-zinc-400 text-xs leading-relaxed mt-3 font-sans font-light transition-colors duration-300">
                            Struktur kawat yang dirancang khusus untuk menangkap liquid secara maksimal, memproduksi uap yang tebal dan masif.
                        </p>
                    </div>

                    <!-- Pillar 5 -->
                    <div class="stealth-card p-8 rounded-none relative bg-white/80 dark:bg-zinc-900/60 border border-zinc-200 dark:border-zinc-800 hover:border-industrial-orange/50 dark:hover:border-industrial-orange/50 shadow-sm dark:shadow-none transition-colors duration-300">
                        <div class="flex justify-between items-center mb-6">
                            <span class="text-[9px] font-mono text-zinc-500 uppercase tracking-widest">EX-05 // FLV_EXTR</span>
                            <span class="pulse-dot"></span>
                        </div>
                        <h3 class="text-xs font-bold text-slate-900 dark:text-white tracking-wider font-sans uppercase transition-colors duration-300">Maximum Flavor Experience</h3>
                        <p class="text-zinc-500 dark:text-zinc-400 text-xs leading-relaxed mt-3 font-sans font-light transition-colors duration-300">
                            Memecah <em class="text-slate-800 dark:text-zinc-200 font-semibold not-italic">layer</em> rasa liquid secara detail, mengekstrak sensasi rasa manis dan aroma ke tingkat yang paling murni.
                        </p>
                    </div>

                    <!-- Pillar 6 -->
                    <div class="stealth-card p-8 rounded-none relative bg-white/80 dark:bg-zinc-900/60 border border-zinc-200 dark:border-zinc-800 hover:border-industrial-orange/50 dark:hover:border-industrial-orange/50 shadow-sm dark:shadow-none transition-colors duration-300">
                        <div class="flex justify-between items-center mb-6">
                            <span class="text-[9px] font-mono text-zinc-500 uppercase tracking-widest">EX-06 // TRST_REF</span>
                            <span class="pulse-dot"></span>
                        </div>
                        <h3 class="text-xs font-bold text-slate-900 dark:text-white tracking-wider font-sans uppercase transition-colors duration-300">Trusted Since 2021</h3>
                        <p class="text-zinc-500 dark:text-zinc-400 text-xs leading-relaxed mt-3 font-sans font-light transition-colors duration-300">
                            Menjadi pilihan utama para antusias vaping selama bertahun-tahun berkat konsistensi performa yang teruji nyata.
                        </p>
                    </div>

                </div>
            </div>
        </section>

        @php
        $coils = $products->filter(fn($p) => $p->category === 'coil');
        $cottons = $products->filter(fn($p) => $p->category === 'cotton');
        @endphp

        <div id="products" class="scroll-mt-24"></div>

        <!-- Coil Catalog Section -->
        <section id="catalog-coils" class="py-24 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="space-y-3 mb-12 border-b border-zinc-200 dark:border-zinc-900 pb-8 text-left transition-colors duration-300">
                <div class="inline-flex items-center gap-2 px-3 py-1 bg-white dark:bg-zinc-950 border border-zinc-200 dark:border-zinc-800 text-[9px] font-bold text-industrial-orange uppercase tracking-widest font-mono shadow-sm dark:shadow-none transition-colors duration-300">
                    CATALOG NODE: COILS
                </div>
                <h2 class="text-3xl font-black tracking-tight text-slate-900 dark:text-white font-display uppercase transition-colors duration-300">REAKTOR COIL</h2>
                <p class="text-zinc-500 text-xs font-sans">Kawat lilitan presisi mikro buatan tangan builder ahli kami untuk performa dan ekstraksi rasa ekstrem.</p>
            </div>

            @if($coils->isEmpty())
            <div class="py-20 text-center bg-white dark:bg-zinc-950/20 border border-zinc-200 dark:border-zinc-900 rounded-none shadow-sm dark:shadow-none transition-colors duration-300">
                <svg class="mx-auto h-12 w-12 text-zinc-400 dark:text-zinc-800 animate-pulse" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                </svg>
                <h3 class="mt-4 text-zinc-600 dark:text-zinc-400 font-bold uppercase tracking-wider text-xs font-mono">Stok Coil Depleted</h3>
                <p class="mt-1 text-zinc-500 dark:text-zinc-500 text-xs">Penyediaan coil buatan tangan sedang dipersiapkan di laboratorium kami.</p>
            </div>
            @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($coils as $product)
                <div x-show="{{ $loop->iteration }} <= 5 || showAllCoils" x-cloak class="stealth-card rounded-none overflow-hidden flex flex-col justify-between group relative bg-white dark:bg-zinc-950/20 border border-zinc-200 dark:border-zinc-800 hover:border-industrial-orange/50 shadow-sm dark:shadow-none transition-colors duration-300">
                    
                    <!-- Product Image Area -->
                    <div class="h-64 w-full relative overflow-hidden bg-zinc-100 dark:bg-black border-b border-zinc-200 dark:border-zinc-900 flex items-center justify-center transition-colors duration-300">
                        <img src="/images/products/coil.png" alt="Handcrafted Coil" class="h-full w-full object-cover group-hover:scale-105 transition-transform duration-700 ease-out">
                        
                        <!-- Fixed Overlay for Dark/Light Mode -->
                        <div class="absolute inset-0 bg-gradient-to-t from-white via-white/40 dark:from-black dark:via-black/20 to-transparent opacity-85 pointer-events-none transition-colors duration-300"></div>
                        <div class="absolute inset-0 bg-[radial-gradient(circle_at_center,rgba(255,85,0,0.04),transparent_60%)] pointer-events-none"></div>

                        <span class="absolute top-3 left-3 text-[8px] font-mono text-zinc-500 uppercase tracking-widest">[ CODE: {{ strtoupper(substr($product->slug, 0, 8)) }} ]</span>
                        <span class="absolute bottom-3 left-3 text-[8px] font-mono text-zinc-500 uppercase tracking-widest">[ COIL ]</span>

                        <div class="absolute top-3 right-3 flex items-center">
                            @if($product->stock === 0)
                            <span class="text-[8px] font-bold text-zinc-500 bg-white dark:bg-zinc-950 border border-zinc-300 dark:border-zinc-800 px-2 py-0.5 uppercase tracking-widest font-mono shadow-sm dark:shadow-none transition-colors duration-300">DEPLETED</span>
                            @elseif($product->stock < 10)
                                <span class="text-[8px] font-bold text-black bg-amber-500 px-2 py-0.5 uppercase tracking-widest font-mono shadow-sm dark:shadow-none">LOW_RESRV</span>
                                @else
                                <span class="text-[8px] font-bold text-white bg-industrial-orange px-2 py-0.5 uppercase tracking-widest font-mono shadow-sm dark:shadow-none">ONLINE</span>
                                @endif
                        </div>
                    </div>

                    <!-- Card Data details -->
                    <div class="p-8 flex-grow flex flex-col justify-between bg-zinc-50 dark:bg-transparent transition-colors duration-300">
                        <div>
                            <h3 class="text-base font-bold text-slate-900 dark:text-white tracking-wide uppercase transition-colors group-hover:text-industrial-orange font-mono">
                                {{ $product->title }}
                            </h3>
                            <p class="text-zinc-500 dark:text-zinc-400 text-xs mt-3 leading-relaxed min-h-[35px] font-sans font-light transition-colors duration-300">
                                {{ $product->character_description }}
                            </p>

                            <!-- Divider -->
                            <div class="my-5 border-t border-zinc-200 dark:border-zinc-900 transition-colors duration-300"></div>

                            <!-- Specs -->
                            <div class="space-y-4">
                                <h4 class="text-[8px] font-bold text-zinc-500 uppercase tracking-widest mb-2 font-mono">[ SPECIFICATION_PARAM ]</h4>

                                <!-- Flavor Stars -->
                                <div class="flex items-center justify-between">
                                    <span class="text-xs text-zinc-600 dark:text-zinc-400 font-sans transition-colors duration-300">Flavor Extraction</span>
                                    <div class="flex items-center gap-1">
                                        @for ($i = 1; $i <= 5; $i++)
                                            @if ($i <=($product->specifications['flavor'] ?? 0))
                                            <svg class="h-3.5 w-3.5 text-industrial-orange fill-current drop-shadow-[0_0_5px_rgba(255,85,0,0.6)]" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>
                                            @else
                                            <svg class="h-3.5 w-3.5 text-zinc-300 dark:text-zinc-800 transition-colors duration-300" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>
                                            @endif
                                            @endfor
                                    </div>
                                </div>

                                <!-- Sweetness Stars -->
                                <div class="flex items-center justify-between">
                                    <span class="text-xs text-zinc-600 dark:text-zinc-400 font-sans transition-colors duration-300">Sweetness Boost</span>
                                    <div class="flex items-center gap-1">
                                        @for ($i = 1; $i <= 5; $i++)
                                            @if ($i <=($product->specifications['sweetness'] ?? 0))
                                            <svg class="h-3.5 w-3.5 text-industrial-orange fill-current drop-shadow-[0_0_5px_rgba(255,85,0,0.6)]" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>
                                            @else
                                            <svg class="h-3.5 w-3.5 text-zinc-300 dark:text-zinc-800 transition-colors duration-300" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>
                                            @endif
                                            @endfor
                                    </div>
                                </div>

                                <!-- Throat Hit Stars -->
                                <div class="flex items-center justify-between">
                                    <span class="text-xs text-zinc-600 dark:text-zinc-400 font-sans transition-colors duration-300">Throat Impact</span>
                                    <div class="flex items-center gap-1">
                                        @for ($i = 1; $i <= 5; $i++)
                                            @if ($i <=($product->specifications['throat_hit'] ?? 0))
                                            <svg class="h-3.5 w-3.5 text-industrial-orange fill-current drop-shadow-[0_0_5px_rgba(255,85,0,0.6)]" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>
                                            @else
                                            <svg class="h-3.5 w-3.5 text-zinc-300 dark:text-zinc-800 transition-colors duration-300" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>
                                            @endif
                                            @endfor
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Card Footer -->
                        <div class="mt-8 flex items-center justify-between gap-4 border-t border-zinc-200 dark:border-zinc-900 pt-6 transition-colors duration-300">
                            <div class="flex flex-col">
                                <span class="text-[9px] text-zinc-500 dark:text-zinc-550 uppercase tracking-widest font-mono">Price</span>
                                <span class="text-base font-bold font-mono text-slate-900 dark:text-white transition-colors duration-300">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                            </div>

                            @if($product->stock > 0)
                            @php
                            $productWaUrl = $defaultWaUrl;
                            if (strpos($productWaUrl, '?') !== false) {
                            $productWaUrl .= '&text=' . urlencode('Halo, saya ingin memesan ' . $product->title);
                            } else {
                            $productWaUrl .= '?text=' . urlencode('Halo, saya ingin memesan ' . $product->title);
                            }
                            @endphp
                            <a href="{{ $productWaUrl }}"
                                target="_blank"
                                class="stealth-btn-primary px-5 py-2.5 text-[10px] uppercase font-bold tracking-widest text-center shadow-md dark:shadow-none">
                                ORDER NOW
                            </a>
                            @else
                            <button disabled class="px-5 py-2.5 text-[10px] uppercase font-bold tracking-widest text-zinc-500 dark:text-zinc-600 bg-zinc-100 dark:bg-zinc-950 border border-zinc-300 dark:border-zinc-850 cursor-not-allowed transition-colors duration-300">
                                SOLD OUT
                            </button>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @if($coils->count() >= 6)
            <div class="mt-10 flex justify-center">
                <button type="button" x-show="!showAllCoils" @click="showAllCoils = true" class="px-6 py-3 text-[10px] uppercase font-bold tracking-widest text-center font-display transition-all duration-200 text-zinc-600 dark:text-zinc-200 border border-zinc-300 dark:border-zinc-700 hover:border-slate-900 dark:hover:border-white hover:text-slate-900 dark:hover:text-white hover:bg-zinc-100 dark:hover:bg-zinc-800/50 hover:scale-105">
                    LIHAT PRODUK LAINNYA
                </button>
            </div>
            @endif
            @endif
        </section>

        <!-- Cotton Catalog Section -->
        <section id="catalog-cottons" class="py-24 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 border-t border-zinc-200 dark:border-zinc-900 transition-colors duration-300">
            <div class="space-y-3 mb-12 border-b border-zinc-200 dark:border-zinc-900 pb-8 text-left transition-colors duration-300">
                <div class="inline-flex items-center gap-2 px-3 py-1 bg-white dark:bg-zinc-950 border border-zinc-200 dark:border-zinc-800 text-[9px] font-bold text-industrial-orange uppercase tracking-widest font-mono shadow-sm dark:shadow-none transition-colors duration-300">
                    CATALOG NODE: COTTON
                </div>
                <h2 class="text-3xl font-black tracking-tight text-slate-900 dark:text-white font-display uppercase transition-colors duration-300">SERAT KAPAS ORGANIK</h2>
                <p class="text-zinc-500 text-xs font-sans">Kapas wicking organik premium tanpa pemutih kimia untuk rasa liquid yang murni dan bersih.</p>
            </div>

            @if($cottons->isEmpty())
            <div class="py-20 text-center bg-white dark:bg-zinc-950/20 border border-zinc-200 dark:border-zinc-900 rounded-none shadow-sm dark:shadow-none transition-colors duration-300">
                <svg class="mx-auto h-12 w-12 text-zinc-400 dark:text-zinc-800 animate-pulse" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                </svg>
                <h3 class="mt-4 text-zinc-600 dark:text-zinc-400 font-bold uppercase tracking-wider text-xs font-mono">Stok Kapas Depleted</h3>
                <p class="mt-1 text-zinc-500 dark:text-zinc-550 text-xs">Penyediaan kapas wicking organik sedang dipersiapkan di laboratorium kami.</p>
            </div>
            @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($cottons as $product)
                <div x-show="{{ $loop->iteration }} <= 5 || showAllCottons" x-cloak class="stealth-card rounded-none overflow-hidden flex flex-col justify-between group relative bg-white dark:bg-zinc-950/20 border border-zinc-200 dark:border-zinc-800 hover:border-industrial-orange/50 shadow-sm dark:shadow-none transition-colors duration-300">
                    
                    <!-- Product Image Area -->
                    <div class="h-64 w-full relative overflow-hidden bg-zinc-100 dark:bg-black border-b border-zinc-200 dark:border-zinc-900 flex items-center justify-center transition-colors duration-300">
                        <img src="/images/products/cotton.png" alt="Artisan Cotton" class="h-full w-full object-cover group-hover:scale-105 transition-transform duration-700 ease-out">
                        
                        <!-- Fixed Overlay -->
                        <div class="absolute inset-0 bg-gradient-to-t from-white via-white/40 dark:from-black dark:via-black/20 to-transparent opacity-85 pointer-events-none transition-colors duration-300"></div>
                        <div class="absolute inset-0 bg-[radial-gradient(circle_at_center,rgba(255,85,0,0.04),transparent_60%)] pointer-events-none"></div>

                        <span class="absolute top-3 left-3 text-[8px] font-mono text-zinc-500 uppercase tracking-widest">[ CODE: {{ strtoupper(substr($product->slug, 0, 8)) }} ]</span>
                        <span class="absolute bottom-3 left-3 text-[8px] font-mono text-zinc-500 uppercase tracking-widest">[ COTTON ]</span>

                        <div class="absolute top-3 right-3 flex items-center">
                            @if($product->stock === 0)
                            <span class="text-[8px] font-bold text-zinc-500 bg-white dark:bg-zinc-950 border border-zinc-300 dark:border-zinc-800 px-2 py-0.5 uppercase tracking-widest font-mono shadow-sm dark:shadow-none transition-colors duration-300">DEPLETED</span>
                            @elseif($product->stock < 10)
                                <span class="text-[8px] font-bold text-black bg-amber-500 px-2 py-0.5 uppercase tracking-widest font-mono shadow-sm dark:shadow-none">LOW_RESRV</span>
                                @else
                                <span class="text-[8px] font-bold text-white bg-industrial-orange px-2 py-0.5 uppercase tracking-widest font-mono shadow-sm dark:shadow-none">ONLINE</span>
                                @endif
                        </div>
                    </div>

                    <!-- Card Data details -->
                    <div class="p-8 flex-grow flex flex-col justify-between bg-zinc-50 dark:bg-transparent transition-colors duration-300">
                        <div>
                            <h3 class="text-base font-bold text-slate-900 dark:text-white tracking-wide uppercase transition-colors group-hover:text-industrial-orange font-mono">
                                {{ $product->title }}
                            </h3>
                            <p class="text-zinc-500 dark:text-zinc-400 text-xs mt-3 leading-relaxed min-h-[35px] font-sans font-light transition-colors duration-300">
                                {{ $product->character_description }}
                            </p>

                            <!-- Divider -->
                            <div class="my-5 border-t border-zinc-200 dark:border-zinc-900 transition-colors duration-300"></div>

                            <!-- Specs -->
                            <div class="space-y-3">
                                <h4 class="text-[8px] font-bold text-zinc-500 uppercase tracking-widest mb-3 font-mono">[ SPECIFICATION_PARAM ]</h4>
                                <div class="flex flex-col gap-2.5">
                                    <!-- Clean Flavor Badge -->
                                    <div class="flex items-center gap-2">
                                        @if(isset($product->specifications['clean_flavor_delivery']) && $product->specifications['clean_flavor_delivery'])
                                        <span class="w-1.5 h-1.5 bg-industrial-orange rounded-full"></span>
                                        <span class="text-xs font-sans text-slate-800 dark:text-zinc-200 transition-colors duration-300">Clean Flavor Delivery</span>
                                        @else
                                        <span class="w-1.5 h-1.5 bg-zinc-300 dark:bg-zinc-800 rounded-full transition-colors duration-300"></span>
                                        <span class="text-xs font-sans text-zinc-400 dark:text-zinc-600 line-through transition-colors duration-300">Clean Flavor Delivery</span>
                                        @endif
                                    </div>

                                    <!-- Fast Liquid Absorption Badge -->
                                    <div class="flex items-center gap-2">
                                        @if(isset($product->specifications['fast_liquid_absorption']) && $product->specifications['fast_liquid_absorption'])
                                        <span class="w-1.5 h-1.5 bg-industrial-orange rounded-full"></span>
                                        <span class="text-xs font-sans text-slate-800 dark:text-zinc-200 transition-colors duration-300">Fast Liquid Absorption</span>
                                        @else
                                        <span class="w-1.5 h-1.5 bg-zinc-300 dark:bg-zinc-800 rounded-full transition-colors duration-300"></span>
                                        <span class="text-xs font-sans text-zinc-400 dark:text-zinc-600 line-through transition-colors duration-300">Fast Liquid Absorption</span>
                                        @endif
                                    </div>

                                    <!-- Premium Organic Fiber Badge -->
                                    <div class="flex items-center gap-2">
                                        @if(isset($product->specifications['premium_organic_fiber']) && $product->specifications['premium_organic_fiber'])
                                        <span class="w-1.5 h-1.5 bg-industrial-orange rounded-full"></span>
                                        <span class="text-xs font-sans text-slate-800 dark:text-zinc-200 transition-colors duration-300">Premium Organic Fiber</span>
                                        @else
                                        <span class="w-1.5 h-1.5 bg-zinc-300 dark:bg-zinc-800 rounded-full transition-colors duration-300"></span>
                                        <span class="text-xs font-sans text-zinc-400 dark:text-zinc-600 line-through transition-colors duration-300">Premium Organic Fiber</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Card Footer -->
                        <div class="mt-8 flex items-center justify-between gap-4 border-t border-zinc-200 dark:border-zinc-900 pt-6 transition-colors duration-300">
                            <div class="flex flex-col">
                                <span class="text-[9px] text-zinc-500 dark:text-zinc-550 uppercase tracking-widest font-mono">Price</span>
                                <span class="text-base font-bold font-mono text-slate-900 dark:text-white transition-colors duration-300">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                            </div>

                            @if($product->stock > 0)
                            @php
                            $productWaUrl = $defaultWaUrl;
                            if (strpos($productWaUrl, '?') !== false) {
                            $productWaUrl .= '&text=' . urlencode('Halo, saya ingin memesan ' . $product->title);
                            } else {
                            $productWaUrl .= '?text=' . urlencode('Halo, saya ingin memesan ' . $product->title);
                            }
                            @endphp
                            <a href="{{ $productWaUrl }}"
                                target="_blank"
                                class="stealth-btn-primary px-5 py-2.5 text-[10px] uppercase font-bold tracking-widest text-center shadow-md dark:shadow-none">
                                ORDER NOW
                            </a>
                            @else
                            <button disabled class="px-5 py-2.5 text-[10px] uppercase font-bold tracking-widest text-zinc-500 dark:text-zinc-600 bg-zinc-100 dark:bg-zinc-950 border border-zinc-300 dark:border-zinc-850 cursor-not-allowed transition-colors duration-300">
                                SOLD OUT
                            </button>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @if($cottons->count() >= 6)
            <div class="mt-10 flex justify-center">
                <button type="button" x-show="!showAllCottons" @click="showAllCottons = true" class="px-6 py-3 text-[10px] uppercase font-bold tracking-widest text-center font-display transition-all duration-200 text-zinc-600 dark:text-zinc-200 border border-zinc-300 dark:border-zinc-700 hover:border-slate-900 dark:hover:border-white hover:text-slate-900 dark:hover:text-white hover:bg-zinc-100 dark:hover:bg-zinc-800/50 hover:scale-105">
                    LIHAT PRODUK LAINNYA
                </button>
            </div>
            @endif
            @endif
        </section>

        <!-- Ordering Channels Section -->
        <section id="ordering" class="py-24 bg-slate-50 dark:bg-black border-t border-zinc-200 dark:border-zinc-900 transition-colors duration-300">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 text-center space-y-6 flex flex-col items-center">
                <div class="inline-flex items-center gap-2 px-3 py-1 bg-white dark:bg-zinc-950 border border-zinc-200 dark:border-zinc-800 text-[9px] font-bold text-industrial-orange uppercase tracking-widest font-mono mx-auto shadow-sm dark:shadow-none transition-colors duration-300">
                    SYS_NODE: ORDER_NOW
                </div>
                <h2 class="text-3xl font-black tracking-tight text-slate-900 dark:text-white font-display uppercase transition-colors duration-300">ORDER NOW</h2>
                <p class="text-zinc-600 dark:text-zinc-500 max-w-xl mx-auto text-xs leading-relaxed font-sans font-light transition-colors duration-300">
                    Pesan sekarang untuk mendapatkan coil dan kapas vape premium buatan tangan terbaik. Hubungi kami langsung untuk melakukan pemesanan atau berkonsultasi mengenai detail spesifikasi custom Anda.
                </p>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 w-full max-w-2xl mx-auto pt-4 font-mono">
                    <!-- WhatsApp -->
                    @if($whatsappShops->count() === 1)
                    <a href="{{ $whatsappShops->first()->url }}" target="_blank"
                        class="stealth-card p-8 rounded-none flex flex-col items-center justify-center text-center group relative bg-white/80 dark:bg-zinc-900/60 border border-zinc-200 dark:border-zinc-800 hover:border-industrial-orange/50 dark:hover:border-industrial-orange/50 shadow-sm dark:shadow-none transition-colors duration-300">
                        <svg class="h-6 w-6 text-zinc-400 group-hover:text-industrial-orange mb-3 transition-colors" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L0 24l6.335-1.662c1.746.953 3.71 1.458 5.704 1.459h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" />
                        </svg>
                        <span class="text-xs uppercase font-bold tracking-wider text-zinc-500 dark:text-zinc-400 group-hover:text-industrial-orange transition-colors">[ WHATSAPP ]</span>
                        <span class="text-[9px] text-zinc-500 dark:text-zinc-600 mt-2">Hubungi Kami</span>
                    </a>
                    @else
                    <div x-data="{ open: false }" @click.away="open = false"
                        class="stealth-card p-8 rounded-none flex flex-col items-center justify-center text-center group relative cursor-pointer select-none bg-white/80 dark:bg-zinc-900/60 border border-zinc-200 dark:border-zinc-800 hover:border-industrial-orange/50 dark:hover:border-industrial-orange/50 shadow-sm dark:shadow-none transition-colors duration-300">
                        <div @click="open = !open" class="flex flex-col items-center justify-center w-full h-full">
                            <svg class="h-6 w-6 text-zinc-400 group-hover:text-industrial-orange mb-3 transition-colors" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L0 24l6.335-1.662c1.746.953 3.71 1.458 5.704 1.459h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" />
                            </svg>
                            <span class="text-xs uppercase font-bold tracking-wider text-zinc-500 dark:text-zinc-400 group-hover:text-industrial-orange transition-colors flex items-center justify-center gap-1.5 w-full">
                                [ WHATSAPP ]
                                <svg class="h-3 w-3 transition-transform duration-200" :class="open ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </span>
                            <span class="text-[9px] text-zinc-500 dark:text-zinc-650 mt-2">Hubungi Kami</span>
                        </div>

                        <!-- Dropdown List -->
                        <div x-show="open"
                            x-transition:enter="transition ease-out duration-150 transform"
                            x-transition:enter-start="opacity-0 scale-95 translate-y-2"
                            x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                            x-transition:leave="transition ease-in duration-100 transform"
                            x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                            x-transition:leave-end="opacity-0 scale-95 translate-y-2"
                            class="absolute left-0 right-0 top-full mt-2 z-30 bg-white dark:bg-zinc-950 border border-zinc-200 dark:border-zinc-800 p-2 space-y-1 font-mono text-[10px] shadow-lg dark:shadow-none transition-colors duration-300"
                            style="display: none;"
                            @click.stop>
                            @if($whatsappShops->isEmpty())
                            <span class="block w-full text-center px-3 py-2 text-zinc-500 dark:text-zinc-650 uppercase font-bold tracking-wider text-[8px]">Belum ada nomor WA</span>
                            @else
                            @foreach($whatsappShops as $shop)
                            <a href="{{ $shop->url }}" target="_blank"
                                class="block w-full text-left px-3 py-2 text-slate-800 dark:text-zinc-400 hover:text-industrial-orange dark:hover:text-industrial-orange hover:bg-zinc-50 dark:hover:bg-zinc-900/50 transition-all border border-transparent hover:border-zinc-200 dark:hover:border-zinc-800/50 uppercase font-bold tracking-wider">
                                {{ $shop->name }}
                            </a>
                            @endforeach
                            @endif
                        </div>
                    </div>
                    @endif

                    <!-- Instagram -->
                    @if($instagramShops->count() === 1)
                    <a href="{{ $instagramShops->first()->url }}" target="_blank"
                        class="stealth-card p-8 rounded-none flex flex-col items-center justify-center text-center group relative bg-white/80 dark:bg-zinc-900/60 border border-zinc-200 dark:border-zinc-800 hover:border-industrial-orange/50 dark:hover:border-industrial-orange/50 shadow-sm dark:shadow-none transition-colors duration-300">
                        <svg class="h-6 w-6 text-zinc-400 group-hover:text-industrial-orange mb-3 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <rect x="2" y="2" width="20" height="20" rx="5" ry="5" />
                            <path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37z" />
                            <line x1="17.5" y1="6.5" x2="17.51" y2="6.5" />
                        </svg>
                        <span class="text-xs uppercase font-bold tracking-wider text-zinc-500 dark:text-zinc-400 group-hover:text-industrial-orange transition-colors">[ INSTAGRAM ]</span>
                        <span class="text-[9px] text-zinc-500 dark:text-zinc-650 mt-2">DM Kami</span>
                    </a>
                    @else
                    <div x-data="{ open: false }" @click.away="open = false"
                        class="stealth-card p-8 rounded-none flex flex-col items-center justify-center text-center group relative cursor-pointer select-none bg-white/80 dark:bg-zinc-900/60 border border-zinc-200 dark:border-zinc-800 hover:border-industrial-orange/50 dark:hover:border-industrial-orange/50 shadow-sm dark:shadow-none transition-colors duration-300">
                        <div @click="open = !open" class="flex flex-col items-center justify-center w-full h-full">
                            <svg class="h-6 w-6 text-zinc-400 group-hover:text-industrial-orange mb-3 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <rect x="2" y="2" width="20" height="20" rx="5" ry="5" />
                                <path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37z" />
                                <line x1="17.5" y1="6.5" x2="17.51" y2="6.5" />
                            </svg>
                            <span class="text-xs uppercase font-bold tracking-wider text-zinc-500 dark:text-zinc-400 group-hover:text-industrial-orange transition-colors flex items-center justify-center gap-1.5 w-full">
                                [ INSTAGRAM ]
                                <svg class="h-3 w-3 transition-transform duration-200" :class="open ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </span>
                            <span class="text-[9px] text-zinc-500 dark:text-zinc-650 mt-2">DM Kami</span>
                        </div>

                        <!-- Dropdown List -->
                        <div x-show="open"
                            x-transition:enter="transition ease-out duration-150 transform"
                            x-transition:enter-start="opacity-0 scale-95 translate-y-2"
                            x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                            x-transition:leave="transition ease-in duration-100 transform"
                            x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                            x-transition:leave-end="opacity-0 scale-95 translate-y-2"
                            class="absolute left-0 right-0 top-full mt-2 z-30 bg-white dark:bg-zinc-950 border border-zinc-200 dark:border-zinc-800 p-2 space-y-1 font-mono text-[10px] shadow-lg dark:shadow-none transition-colors duration-300"
                            style="display: none;"
                            @click.stop>
                            @if($instagramShops->isEmpty())
                            <span class="block w-full text-center px-3 py-2 text-zinc-500 dark:text-zinc-650 uppercase font-bold tracking-wider text-[8px]">Belum ada akun IG</span>
                            @else
                            @foreach($instagramShops as $shop)
                            <a href="{{ $shop->url }}" target="_blank"
                                class="block w-full text-left px-3 py-2 text-slate-800 dark:text-zinc-400 hover:text-industrial-orange dark:hover:text-industrial-orange hover:bg-zinc-50 dark:hover:bg-zinc-900/50 transition-all border border-transparent hover:border-zinc-200 dark:hover:border-zinc-800/50 uppercase font-bold tracking-wider">
                                {{ $shop->name }}
                            </a>
                            @endforeach
                            @endif
                        </div>
                    </div>
                    @endif

                    <!-- TikTok Shop -->
                    @if($tiktokShops->count() === 1)
                    <a href="{{ $tiktokShops->first()->url }}" target="_blank"
                        class="stealth-card p-8 rounded-none flex flex-col items-center justify-center text-center group relative bg-white/80 dark:bg-zinc-900/60 border border-zinc-200 dark:border-zinc-800 hover:border-industrial-orange/50 dark:hover:border-industrial-orange/50 shadow-sm dark:shadow-none transition-colors duration-300">
                        <svg class="h-6 w-6 text-zinc-400 group-hover:text-industrial-orange mb-3 transition-colors" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.17-2.86-.74-3.99-1.72-.08-.07-.17-.17-.25-.25v6.07c0 2.21-.75 4.43-2.31 6.01-1.79 1.8-4.5 2.51-6.94 1.89-2.73-.69-4.96-2.91-5.4-5.69-.64-4.04 2.12-7.9 6.17-8.52.26-.04.53-.06.79-.08v4.07c-1.12.11-2.23.63-2.87 1.57-.75 1.12-.76 2.66-.02 3.79.74 1.1 2.13 1.69 3.44 1.44 1.17-.22 2.12-1.22 2.33-2.39.06-.32.08-.66.08-.99V0c-.23.01-.46.01-.69.02z" />
                        </svg>
                        <span class="text-xs uppercase font-bold tracking-wider text-zinc-500 dark:text-zinc-400 group-hover:text-industrial-orange transition-colors">[ TIKTOK_SHOPS ]</span>
                        <span class="text-[9px] text-zinc-500 dark:text-zinc-650 mt-2">Pilih Akun Toko</span>
                    </a>
                    @else
                    <div x-data="{ open: false }" @click.away="open = false"
                        class="stealth-card p-8 rounded-none flex flex-col items-center justify-center text-center group relative cursor-pointer select-none bg-white/80 dark:bg-zinc-900/60 border border-zinc-200 dark:border-zinc-800 hover:border-industrial-orange/50 dark:hover:border-industrial-orange/50 shadow-sm dark:shadow-none transition-colors duration-300">
                        <div @click="open = !open" class="flex flex-col items-center justify-center w-full h-full">
                            <svg class="h-6 w-6 text-zinc-400 group-hover:text-industrial-orange mb-3 transition-colors" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.17-2.86-.74-3.99-1.72-.08-.07-.17-.17-.25-.25v6.07c0 2.21-.75 4.43-2.31 6.01-1.79 1.8-4.5 2.51-6.94 1.89-2.73-.69-4.96-2.91-5.4-5.69-.64-4.04 2.12-7.9 6.17-8.52.26-.04.53-.06.79-.08v4.07c-1.12.11-2.23.63-2.87 1.57-.75 1.12-.76 2.66-.02 3.79.74 1.1 2.13 1.69 3.44 1.44 1.17-.22 2.12-1.22 2.33-2.39.06-.32.08-.66.08-.99V0c-.23.01-.46.01-.69.02z" />
                            </svg>
                            <span class="text-xs uppercase font-bold tracking-wider text-zinc-500 dark:text-zinc-400 group-hover:text-industrial-orange transition-colors flex items-center justify-center gap-1.5 w-full">
                                [ TIKTOK_SHOPS ]
                                <svg class="h-3 w-3 transition-transform duration-200" :class="open ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </span>
                            <span class="text-[9px] text-zinc-500 dark:text-zinc-650 mt-2">Pilih Akun Toko</span>
                        </div>

                        <!-- Dropdown List -->
                        <div x-show="open"
                            x-transition:enter="transition ease-out duration-150 transform"
                            x-transition:enter-start="opacity-0 scale-95 translate-y-2"
                            x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                            x-transition:leave="transition ease-in duration-100 transform"
                            x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                            x-transition:leave-end="opacity-0 scale-95 translate-y-2"
                            class="absolute left-0 right-0 top-full mt-2 z-30 bg-white dark:bg-zinc-950 border border-zinc-200 dark:border-zinc-800 p-2 space-y-1 font-mono text-[10px] shadow-lg dark:shadow-none transition-colors duration-300"
                            style="display: none;"
                            @click.stop>
                            @if($tiktokShops->isEmpty())
                            <span class="block w-full text-center px-3 py-2 text-zinc-500 dark:text-zinc-650 uppercase font-bold tracking-wider text-[8px]">Belum ada toko aktif</span>
                            @else
                            @foreach($tiktokShops as $shop)
                            <a href="{{ $shop->url }}" target="_blank"
                                class="block w-full text-left px-3 py-2 text-slate-800 dark:text-zinc-400 hover:text-industrial-orange dark:hover:text-industrial-orange hover:bg-zinc-50 dark:hover:bg-zinc-900/50 transition-all border border-transparent hover:border-zinc-200 dark:hover:border-zinc-800/50 uppercase font-bold tracking-wider">
                                {{ $shop->name }}
                            </a>
                            @endforeach
                            @endif
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </section>

    </main>

    <!-- Footer -->
    <footer class="bg-slate-50 dark:bg-black border-t border-zinc-200 dark:border-zinc-900 py-8 transition-colors duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row items-center justify-between gap-4 text-[10px] tracking-wider text-zinc-500 uppercase font-mono">
            <div>
                &copy; 2026 Extreme Project. Handcrafted Precision. Hak Cipta Dilindungi.
            </div>
        </div>
    </footer>

</body>

</html>