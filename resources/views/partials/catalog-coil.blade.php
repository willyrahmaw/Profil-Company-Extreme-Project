        <!-- Coil Catalog Section -->
        <section id="catalog-coils" class="py-24 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="space-y-3 mb-12 border-b border-zinc-200/80 dark:border-zinc-900 pb-8 text-left transition-colors duration-300">
                <div class="inline-flex items-center gap-2 px-3 py-1 bg-white dark:bg-zinc-950 border border-zinc-200 dark:border-zinc-800 text-[9px] font-bold text-industrial-orange uppercase tracking-widest font-mono shadow-sm dark:shadow-none transition-colors duration-300">
                    CATALOG NODE: COILS
                </div>
                <h2 class="text-3xl font-black tracking-tight text-slate-900 dark:text-white font-display uppercase transition-colors duration-300">REAKTOR COIL</h2>
                <p class="text-zinc-500 text-xs font-sans">Kawat lilitan presisi mikro buatan tangan builder ahli kami untuk performa dan ekstraksi rasa extreme.</p>

            </div>

            <!-- Interactive Coil Finder Widget -->
            <div x-data="{
                step: 0,
                atomizer: '',
                liquid: '',
                preference: '',
                result: null,
                findMatch() {
                    // Match logic based on our seeds
                    if (this.liquid === 'Menthol') {
                        this.result = {
                            title: 'Extreme V3 Pink',
                            desc: 'Optimal untuk setup RTA dengan liquid menthol/fruity dingin dan throat hit maksimal.',
                            slug: 'extreme-v3-pink'
                        };
                    } else if (this.liquid === 'Creamy' && this.preference === 'sweetness') {
                        this.result = {
                            title: 'Extreme V4 Ungu',
                            desc: 'Dirancang khusus untuk menonjolkan rasa manis maksimal pada liquid creamy dessert.',
                            slug: 'extreme-v4-ungu'
                        };
                    } else if (this.liquid === 'Creamy' && this.preference === 'flavor') {
                        this.result = {
                            title: 'Extreme V2 Kuning',
                            desc: 'Menghadirkan flavor detail tebal dan tektur creamy padat yang luar biasa konsisten.',
                            slug: 'extreme-v2-kuning'
                        };
                    } else if (this.liquid === 'Fruit') {
                        this.result = {
                            title: 'Extreme V1 Hitam',
                            desc: 'Menghasilkan ramp up instan, rasa fruity yang bersih, tajam, dan dingin menyegarkan.',
                            slug: 'extreme-v1-hitam'
                        };
                    } else {
                        this.result = {
                            title: 'Extreme V6 Merah',
                            desc: 'Varian all-around terbaik dengan performa paling seimbang untuk berbagai liquid harian.',
                            slug: 'extreme-v6-merah'
                        };
                    }
                    this.step = 3;
                },
                reset() {
                    this.step = 0;
                    this.atomizer = '';
                    this.liquid = '';
                    this.preference = '';
                    this.result = null;
                }
            }" class="mb-12 stealth-card p-6 sm:p-8 bg-zinc-950/20 border border-zinc-200/60 dark:border-zinc-900 rounded-2xl relative overflow-hidden transition-all duration-300">
                <div class="absolute -top-px -left-px w-2 h-2 border-t border-l border-industrial-orange"></div>
                <div class="absolute -top-px -right-px w-2 h-2 border-t border-r border-industrial-orange"></div>

                <!-- Step 0: Intro -->
                <div x-show="step === 0" class="space-y-4">
                    <div class="flex items-center gap-2">
                        <span class="text-[8px] font-mono text-industrial-orange uppercase tracking-widest font-bold bg-industrial-orange/5 px-2 py-0.5 border border-industrial-orange/20">COIL_FINDER_ENGINE</span>
                        <span class="text-[9px] font-mono text-zinc-500 uppercase tracking-widest">v1.2.0_beta</span>
                    </div>
                    <h3 class="text-lg font-black text-slate-900 dark:text-white uppercase font-display tracking-wider">Bingung Pilih Coil Yang Pas?</h3>
                    <p class="text-zinc-650 dark:text-zinc-400 text-xs font-sans leading-relaxed max-w-xl">
                        Gunakan mesin pencari kami untuk mencocokkan jenis atomizer, liquid favorit, dan gaya vaping Anda demi mendapatkan rekomendasi varian koil terbaik secara instan.
                    </p>
                    <button type="button" @click="step = 1" class="stealth-btn-primary px-6 py-3 text-[10px] uppercase font-bold tracking-widest">
                        MULAI PENCARIAN
                    </button>
                </div>

                <!-- Step 1: Atomizer Choice -->
                <div x-show="step === 1" class="space-y-4" x-cloak>
                    <div class="text-[8px] font-mono text-zinc-500 uppercase tracking-widest">Langkah 1 dari 2: Pilih Atomizer Anda</div>
                    <h3 class="text-base font-bold text-slate-900 dark:text-white uppercase font-display">Tipe Atomizer yang Anda gunakan?</h3>
                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
                        @foreach(['RDA', 'RTA', 'AIO'] as $atom)
                        <button type="button" @click="atomizer = '{{ $atom }}'; step = 2"
                            class="p-4 rounded-xl border font-mono text-xs font-bold uppercase tracking-wider transition-all duration-150 hover:border-industrial-orange hover:bg-industrial-orange/5"
                            :class="atomizer === '{{ $atom }}' ? 'border-industrial-orange bg-industrial-orange/10 text-industrial-orange' : 'border-zinc-800 text-zinc-400 bg-zinc-950/60'">
                            {{ $atom }}
                        </button>
                        @endforeach
                    </div>
                    <button type="button" @click="step = 0" class="text-[10px] uppercase font-bold tracking-widest text-zinc-550 hover:text-white transition-colors mt-2">&larr; Kembali</button>
                </div>

                <!-- Step 2: Liquid Profile -->
                <div x-show="step === 2" class="space-y-4" x-cloak>
                    <div class="text-[8px] font-mono text-zinc-500 uppercase tracking-widest">Langkah 2 dari 2: Profil Liquid & Preferensi</div>
                    <h3 class="text-base font-bold text-slate-900 dark:text-white uppercase font-display">Apa jenis liquid favorit Anda?</h3>
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
                        @foreach(['Creamy', 'Fruit', 'Sweet', 'Menthol'] as $liqType)
                        <button type="button" @click="liquid = '{{ $liqType }}'; preference = '{{ $liqType === 'Creamy' ? 'sweetness' : 'flavor' }}'; findMatch()"
                            class="p-4 rounded-xl border font-mono text-xs font-bold uppercase tracking-wider transition-all duration-150 hover:border-industrial-orange hover:bg-industrial-orange/5"
                            :class="liquid === '{{ $liqType }}' ? 'border-industrial-orange bg-industrial-orange/10 text-industrial-orange' : 'border-zinc-800 text-zinc-400 bg-zinc-950/60'">
                            {{ $liqType }}
                        </button>
                        @endforeach
                    </div>
                    <button type="button" @click="step = 1" class="text-[10px] uppercase font-bold tracking-widest text-zinc-550 hover:text-white transition-colors mt-2">&larr; Kembali</button>
                </div>

                <!-- Step 3: Result -->
                <div x-show="step === 3" class="space-y-4" x-cloak>
                    <div class="flex items-center gap-2">
                        <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full animate-pulse"></span>
                        <span class="text-[8px] font-mono text-emerald-450 uppercase tracking-widest font-bold">MATCH_FOUND_SUCCESS</span>
                    </div>
                    <div class="space-y-2">
                        <h4 class="text-xs font-mono text-zinc-550 uppercase tracking-widest">Rekomendasi Coil Anda:</h4>
                        <div class="text-xl font-black text-industrial-orange uppercase font-display tracking-wider" x-text="result?.title"></div>
                        <p class="text-zinc-650 dark:text-zinc-300 text-xs font-sans max-w-xl" x-text="result?.desc"></p>
                    </div>
                    <div class="flex gap-4 items-center pt-2">
                        <button type="button" @click="reset()" class="px-5 py-2.5 text-[10px] uppercase font-bold tracking-widest text-zinc-600 dark:text-zinc-450 hover:text-white border border-zinc-800 hover:border-zinc-650 transition-colors">
                            CARI LAGI
                        </button>
                        <a :href="'#' + (result ? result.slug : '')" class="stealth-btn-primary px-6 py-2.5 text-[10px] uppercase font-bold tracking-widest">
                            LIHAT DETAIL PRODUK &rarr;
                        </a>
                    </div>
                </div>
            </div>

            @if($coils->isEmpty())
            <div class="py-20 text-center bg-white dark:bg-zinc-900/20 border border-zinc-200 dark:border-zinc-900 rounded-2xl shadow-sm dark:shadow-none transition-colors duration-300">
                <svg class="mx-auto h-12 w-12 text-zinc-400 dark:text-zinc-800 animate-pulse" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                </svg>
                <h3 class="mt-4 text-zinc-600 dark:text-zinc-400 font-bold uppercase tracking-wider text-xs font-mono">Stok Coil Depleted</h3>
                <p class="mt-1 text-zinc-500 dark:text-zinc-500 text-xs">Penyediaan coil buatan tangan sedang dipersiapkan di laboratorium kami.</p>
            </div>
            @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($coils as $product)
                <div x-show="{{ $loop->iteration }} <= 6 || showAllCoils" x-cloak id="{{ $product->slug }}"
                    class="stealth-card rounded-2xl overflow-hidden flex flex-col justify-between group relative bg-gradient-to-br from-white to-zinc-50/50 dark:from-zinc-900/40 dark:to-zinc-950/60 dark:backdrop-blur-md border border-zinc-300/90 dark:border-zinc-800/90 hover:border-industrial-orange/80 dark:hover:border-industrial-orange/85 hover:-translate-y-1 transition-all duration-300">

                    <!-- Product Image Area -->
                    <div class="h-72 w-full relative overflow-hidden bg-zinc-100 dark:bg-black border-b border-zinc-200/60 dark:border-zinc-900 flex items-center justify-center transition-colors duration-300">
                        <img src="{{ $product->image_path ?: '/images/products/coil.png' }}" alt="{{ $product->title }} - Coil Handmade Vape Premium Extreme Project" class="p-4 h-full w-full object-contain group-hover:scale-105 transition-transform duration-700 ease-out dark:invert dark:opacity-85" loading="lazy" decoding="async">

                        <!-- Fixed Overlay for Dark/Light Mode -->
                        <span class="absolute top-3 left-3 text-[8px] font-mono text-zinc-500 uppercase tracking-widest bg-white/80 dark:bg-black/60 px-1.5 py-0.5 rounded">[ CODE: {{ strtoupper(substr($product->slug, 0, 8)) }} ]</span>
                        <span class="absolute bottom-3 left-3 text-[8px] font-mono text-zinc-500 uppercase tracking-widest bg-white/80 dark:bg-black/60 px-1.5 py-0.5 rounded">[ COIL ]</span>

                        <div class="absolute top-3 right-3 flex items-center">
                            @if($product->stock === 0)
                            <span class="text-[8px] font-bold text-zinc-500 bg-white dark:bg-zinc-950 border border-zinc-300/80 dark:border-zinc-800 px-2 py-0.5 uppercase tracking-widest font-mono transition-colors duration-300">DEPLETED</span>
                            @elseif($product->stock < 10)
                                <span class="text-[8px] font-bold text-black bg-amber-500 px-2 py-0.5 uppercase tracking-widest font-mono animate-pulse">LOW_RESRV</span>
                                @else
                                <span class="text-[8px] font-bold text-white bg-industrial-orange px-2 py-0.5 uppercase tracking-widest font-mono">ONLINE</span>
                                @endif
                        </div>
                    </div>
                    <!-- Card Data details -->
                    <div class="p-8 flex-grow flex flex-col justify-between transition-colors duration-300">
                        <div>
                            @if($product->category === 'coil' && !empty($product->specifications['version']))
                            <span class="text-[8px] font-bold text-industrial-orange uppercase font-mono tracking-widest block mb-1">
                                [ VERSI_{{ $product->specifications['version'] }} ]
                            </span>
                            @endif
                            <div class="flex items-center gap-2 flex-wrap">
                                <h3 class="text-lg font-black text-slate-900 dark:text-white tracking-wide uppercase transition-colors group-hover:text-industrial-orange font-mono">
                                    {{ $product->title }}
                                </h3>
                            </div>
                            @if($product->category === 'coil' && !empty($product->specifications['material']))
                            <div class="text-[10px] font-bold text-slate-500 dark:text-zinc-400 uppercase tracking-wider mt-1 font-display">
                                {{ $product->specifications['material'] }}
                            </div>
                            @endif

                            <p class="text-zinc-650 dark:text-zinc-300 text-xs mt-3 leading-relaxed min-h-[35px] font-sans font-light transition-colors duration-300 text-justify">
                                {{ $product->character_description }}
                            </p>

                            <!-- Divider -->
                            <div class="my-5 border-t border-zinc-200/80 dark:border-zinc-900/80 transition-colors duration-300"></div>

                            <!-- Specs -->
                            <div class="space-y-3">
                                <h4 class="text-[8px] font-bold text-zinc-400 dark:text-zinc-500 uppercase tracking-widest mb-2 font-mono">[ PARAMETER ]</h4>

                                <!-- Flavor Stars -->
                                <div class="flex items-center justify-between">
                                    <span class="text-xs text-zinc-800 dark:text-zinc-300 font-medium font-sans">Flavor</span>
                                    <div class="flex items-center gap-1">
                                        @for ($i = 1; $i <= 5; $i++)
                                            @if ($i <=($product->specifications['flavor'] ?? 0))
                                            <svg class="h-3.5 w-3.5 text-industrial-orange fill-current" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>
                                            @else
                                            <svg class="h-3.5 w-3.5 text-zinc-300 dark:text-zinc-700" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>
                                            @endif
                                            @endfor
                                    </div>
                                </div>

                                <!-- Sweetness Stars -->
                                <div class="flex items-center justify-between">
                                    <span class="text-xs text-zinc-800 dark:text-zinc-300 font-medium font-sans">Sweetness</span>
                                    <div class="flex items-center gap-1">
                                        @for ($i = 1; $i <= 5; $i++)
                                            @if ($i <=($product->specifications['sweetness'] ?? 0))
                                            <svg class="h-3.5 w-3.5 text-industrial-orange fill-current" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>
                                            @else
                                            <svg class="h-3.5 w-3.5 text-zinc-300 dark:text-zinc-700" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>
                                            @endif
                                            @endfor
                                    </div>
                                </div>

                                <!-- Throat Hit Stars -->
                                <div class="flex items-center justify-between">
                                    <span class="text-xs text-zinc-800 dark:text-zinc-300 font-medium font-sans">Throat Hit</span>
                                    <div class="flex items-center gap-1">
                                        @for ($i = 1; $i <= 5; $i++)
                                            @if ($i <=($product->specifications['throat_hit'] ?? 0))
                                            <svg class="h-3.5 w-3.5 text-industrial-orange fill-current" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>
                                            @else
                                            <svg class="h-3.5 w-3.5 text-zinc-300 dark:text-zinc-700" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>
                                            @endif
                                            @endfor
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Recommendations Box -->
                        @if(!empty($product->specifications['compatible_atomizers']) || !empty($product->specifications['recommended_liquid']) || !empty($product->specifications['recommended_watt']))
                        <div class="mt-3 p-3 bg-industrial-orange/5 border border-industrial-orange/20 rounded-xl space-y-1.5 text-[10px]">
                            <span class="text-[8px] font-mono text-industrial-orange uppercase tracking-widest block mb-1 font-bold">[ MATCH_RECOMMENDATIONS ]</span>

                            @if(!empty($product->specifications['compatible_atomizers']))
                            <div class="flex justify-between border-b border-zinc-200/60 dark:border-zinc-800/30 pb-1">
                                <span class="text-zinc-500 dark:text-zinc-400 font-display">Compatible:</span>
                                <div class="flex gap-1 flex-wrap justify-end">
                                    @foreach((array)$product->specifications['compatible_atomizers'] as $atomizer)
                                    <span class="px-1.5 py-0.5 bg-zinc-200 dark:bg-zinc-900 border border-zinc-300 dark:border-zinc-800 text-[8px] font-mono rounded font-bold uppercase text-slate-800 dark:text-zinc-300">{{ $atomizer }}</span>
                                    @endforeach
                                </div>
                            </div>
                            @endif

                            @if(!empty($product->specifications['recommended_liquid']))
                            <div class="flex justify-between border-b border-zinc-200/60 dark:border-zinc-800/30 pb-1">
                                <span class="text-zinc-500 dark:text-zinc-400 font-display">Best For Liquid:</span>
                                <div class="flex gap-1 flex-wrap justify-end">
                                    @foreach((array)$product->specifications['recommended_liquid'] as $liq)
                                    <span class="px-1.5 py-0.2 bg-industrial-orange/10 border border-industrial-orange/20 text-[8px] font-mono rounded font-bold uppercase text-industrial-orange">{{ $liq }}</span>
                                    @endforeach
                                </div>
                            </div>
                            @endif

                            @if(!empty($product->specifications['recommended_watt']))
                            <div class="flex justify-between pb-0.5">
                                <span class="text-zinc-500 dark:text-zinc-400 font-display">Power Range:</span>
                                <span class="text-slate-800 dark:text-zinc-100 font-display font-bold">{{ $product->specifications['recommended_watt'] }}</span>
                            </div>
                            @endif
                        </div>
                        @endif

                        {{-- Physical specifications detailed box under description --}}
                        @if(!empty($product->specifications['diameter']) || !empty($product->specifications['resistance']) || !empty($product->specifications['resistance_single']) || !empty($product->specifications['resistance_dual']) || !empty($product->specifications['foot']) || !empty($product->specifications['wrap']) || !empty($product->specifications['material']) || !empty($product->specifications['durability']))
                        <div class="mt-4 p-3.5 bg-zinc-100 dark:bg-zinc-900/40 border border-zinc-300/80 dark:border-zinc-800 rounded-xl space-y-2">
                            <span class="text-[8px] font-mono text-zinc-500 dark:text-zinc-400 uppercase tracking-widest block mb-1">[ SPECIFICATIONS ]</span>
                            <div class="grid grid-cols-2 gap-x-4 gap-y-1.5 text-[10px] font-mono">
                                @if(!empty($product->specifications['diameter']))
                                <div class="flex justify-between border-b border-zinc-200/60 dark:border-zinc-800/30 pb-0.5">
                                    <span class="text-zinc-500 dark:text-zinc-400 font-display">Diameter:</span>
                                    <span class="text-slate-800 dark:text-zinc-100 font-display">{{ $product->specifications['diameter'] }}</span>
                                </div>
                                @endif
                                @if(!empty($product->specifications['wrap']))
                                <div class="flex justify-between border-b border-zinc-200/60 dark:border-zinc-800/30 pb-0.5">
                                    <span class="text-zinc-500 dark:text-zinc-400 font-display">Lilitan:</span>
                                    <span class="text-slate-800 dark:text-zinc-100 font-display">{{ $product->specifications['wrap'] }}</span>
                                </div>
                                @endif
                                @if(!empty($product->specifications['foot']))
                                <div class="flex justify-between border-b border-zinc-200/60 dark:border-zinc-800/30 pb-0.5">
                                    <span class="text-zinc-500 dark:text-zinc-400 font-display">Tipe Kaki:</span>
                                    <span class="text-slate-800 dark:text-zinc-100 font-display">({{ strtoupper($product->specifications['foot']) }})</span>
                                </div>
                                @endif
                                @if(!empty($product->specifications['resistance_single']))
                                <div class="flex justify-between border-b border-zinc-200/60 dark:border-zinc-800/30 pb-0.5">
                                    <span class="text-zinc-500 dark:text-zinc-400 font-display">Single Coil:</span>
                                    <span class="text-slate-800 dark:text-zinc-100 font-display">{{ $product->specifications['resistance_single'] }} Ω</span>
                                </div>
                                @endif
                                @if(!empty($product->specifications['resistance_dual']))
                                <div class="flex justify-between border-b border-zinc-200/60 dark:border-zinc-800/30 pb-0.5">
                                    <span class="text-zinc-500 dark:text-zinc-400 font-display">Dual Coil:</span>
                                    <span class="text-slate-800 dark:text-zinc-100 font-display">{{ $product->specifications['resistance_dual'] }} Ω</span>
                                </div>
                                @endif
                                @if(empty($product->specifications['resistance_single']) && empty($product->specifications['resistance_dual']) && !empty($product->specifications['resistance']))
                                <div class="flex justify-between border-b border-zinc-200/60 dark:border-zinc-800/30 pb-0.5">
                                    <span class="text-zinc-500 dark:text-zinc-400 font-display">Ohm:</span>
                                    <span class="text-slate-800 dark:text-zinc-100 font-display">{{ $product->specifications['resistance'] }}</span>
                                </div>
                                @endif
                                @if(!empty($product->specifications['material']))
                                <div class="col-span-2 flex justify-between border-b border-zinc-200/60 dark:border-zinc-800/30 pb-0.5">
                                    <span class="text-zinc-500 dark:text-zinc-400 font-display">Bahan:</span>
                                    <span class="text-slate-800 dark:text-zinc-100 font-display text-right" title="{{ $product->specifications['material'] }}">{{ $product->specifications['material'] }}</span>
                                </div>
                                @endif
                                @if(!empty($product->specifications['durability']))
                                <div class="col-span-2 flex flex-col pt-0.5 border-t border-zinc-200/40 dark:border-zinc-800/40 mt-1">
                                    <div class="flex justify-between">
                                        <span class="text-zinc-500 dark:text-zinc-400 font-display">Ketahanan:</span>
                                        <span class="text-slate-800 dark:text-zinc-100 font-display">
                                            {{ explode(' (', $product->specifications['durability'])[0] }}
                                        </span>
                                    </div>
                                    <span class="text-[7.5px] text-zinc-500 dark:text-zinc-400 mt-1.5 leading-normal italic text-right font-sans">
                                        *Bergantung pada penggunaan, jenis liquid, dan perawatan.
                                    </span>
                                </div>
                                @endif
                            </div>
                        </div>
                        @endif

                        <!-- Card Footer -->
                        <div class="mt-8 flex items-center justify-between gap-4 border-t border-zinc-200/80 dark:border-zinc-900/80 pt-6 transition-colors duration-300">
                            @php
                            $effectivePrice = $hasActiveEvent ? $product->price * (1 - ($discountPercentage / 100)) : $product->price;
                            @endphp
                            <div class="flex flex-col">
                                <span class="text-[9px] text-zinc-500 dark:text-zinc-400 uppercase tracking-widest font-display">Price</span>
                                @if($hasActiveEvent)
                                <div class="flex items-center gap-1.5 flex-wrap">
                                    <span class="text-xs text-zinc-400 dark:text-zinc-500 line-through font-display">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                                    <span class="text-base font-bold font-display text-industrial-orange transition-colors duration-300">Rp {{ number_format($effectivePrice, 0, ',', '.') }}</span>
                                    <span class="inline-flex items-center px-1.5 py-0.5 text-[8px] font-bold bg-industrial-orange/10 border border-industrial-orange/30 text-industrial-orange uppercase font-display tracking-wider">{{ $discountPercentage }}% OFF</span>
                                </div>
                                @else
                                <span class="text-base font-bold font-display text-slate-900 dark:text-white transition-colors duration-300">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                                @endif
                            </div>

                            @if($product->stock > 0)
                            <button type="button"
                                @click="addToCart('{{ $product->id }}', '{{ $product->title }}', {{ $effectivePrice }}, '{{ $product->image_path ?: '/images/products/coil.png' }}', { version: '{{ $product->specifications['version'] ?? '' }}', diameter: '{{ $product->specifications['diameter'] ?? '' }}', resistance: '{{ $product->specifications['resistance'] ?? '' }}', resistance_single: '{{ $product->specifications['resistance_single'] ?? '' }}', resistance_dual: '{{ $product->specifications['resistance_dual'] ?? '' }}', foot: '{{ $product->specifications['foot'] ?? '' }}', wrap: '{{ $product->specifications['wrap'] ?? '' }}', material: '{{ $product->specifications['material'] ?? '' }}', durability: '{{ $product->specifications['durability'] ?? '' }}' }, {{ json_encode($product->marketplace_urls ?? new \stdClass()) }}); orderModalOpen = true;"
                                class="stealth-btn-primary px-5 py-2.5 text-[10px] uppercase font-bold tracking-widest text-center flex items-center gap-1">
                                <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                </svg>
                                TAMBAH
                            </button>
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
            @if($coils->count() >= 7)
            <div class="mt-10 flex justify-center">
                <button type="button" x-show="!showAllCoils" @click="showAllCoils = true" class="px-6 py-3 text-[10px] uppercase font-bold tracking-widest text-center font-display transition-all duration-200 text-zinc-600 dark:text-zinc-200 border border-zinc-300 dark:border-zinc-700 hover:border-slate-900 dark:hover:border-white hover:text-slate-900 dark:hover:text-white hover:bg-zinc-100 dark:hover:bg-zinc-800/50 hover:scale-105">
                    LIHAT PRODUK LAINNYA
                </button>
            </div>
            @endif
            @endif
        </section>