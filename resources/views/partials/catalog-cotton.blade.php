@if(!$cottons->isEmpty())
        <!-- Cotton Catalog Section -->
        <section id="catalog-cottons" class="py-24 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 border-t border-zinc-200 dark:border-zinc-900 transition-colors duration-300">
            <div class="space-y-3 mb-12 border-b border-zinc-200 dark:border-zinc-900 pb-8 text-left transition-colors duration-300">
                <div class="inline-flex items-center gap-2 px-3 py-1 bg-white dark:bg-zinc-950 border border-zinc-200 dark:border-zinc-800 text-[9px] font-bold text-industrial-orange uppercase tracking-widest font-display shadow-sm dark:shadow-none transition-colors duration-300">
                    CATALOG NODE: COTTON
                </div>
                <h2 class="text-3xl font-black tracking-tight text-slate-900 dark:text-white font-display uppercase transition-colors duration-300">SERAT KAPAS ORGANIK</h2>
                <p class="text-zinc-500 text-xs font-sans">Kapas wicking organik premium tanpa pemutih kimia untuk rasa liquid yang murni dan bersih.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($cottons as $product)
                <div x-show="{{ $loop->iteration }} <= 5 || showAllCottons" x-cloak
                    class="stealth-card rounded-2xl overflow-hidden flex flex-col justify-between group relative bg-gradient-to-br from-white to-zinc-50/50 dark:from-zinc-900/40 dark:to-zinc-950/60 dark:backdrop-blur-md border border-zinc-300/90 dark:border-zinc-800/90 hover:border-industrial-orange/80 dark:hover:border-industrial-orange/85 hover:-translate-y-1 transition-all duration-300">

                    <!-- Product Image Area -->
                    <div class="h-64 w-full relative overflow-hidden bg-zinc-100 dark:bg-black border-b border-zinc-200/60 dark:border-zinc-900 flex items-center justify-center transition-colors duration-300">
                        <img src="{{ $product->image_path ?: '/images/products/cotton.png' }}" alt="{{ $product->title }} - Kapas Vape Organik Premium Extreme Project" class="p-4 h-full w-full object-contain group-hover:scale-105 transition-transform duration-700 ease-out" loading="lazy" decoding="async">

                        <!-- Fixed Overlay -->
                        <div class="absolute inset-0 bg-gradient-to-t from-white via-white/40 dark:from-black dark:via-black/20 to-transparent opacity-85 pointer-events-none transition-colors duration-300"></div>
                        <div class="absolute inset-0 bg-[radial-gradient(circle_at_center,rgba(255,64,129,0.06),transparent_60%)] pointer-events-none"></div>

                        <span class="absolute top-3 left-3 text-[8px] font-display text-zinc-500 uppercase tracking-widest bg-white/80 dark:bg-black/60 px-1.5 py-0.5 rounded">[ CODE: {{ strtoupper(substr($product->slug, 0, 8)) }} ]</span>
                        <span class="absolute bottom-3 left-3 text-[8px] font-display text-zinc-500 uppercase tracking-widest bg-white/80 dark:bg-black/60 px-1.5 py-0.5 rounded">[ COTTON ]</span>

                        <div class="absolute top-3 right-3 flex items-center">
                            @if($product->stock === 0)
                            <span class="text-[8px] font-bold text-zinc-500 bg-white dark:bg-zinc-950 border border-zinc-300/80 dark:border-zinc-800 px-2 py-0.5 uppercase tracking-widest font-display transition-colors duration-300">DEPLETED</span>
                            @elseif($product->stock < 10)
                                <span class="text-[8px] font-bold text-black bg-amber-500 px-2 py-0.5 uppercase tracking-widest font-display animate-pulse">LOW_RESRV</span>
                                @else
                                <span class="text-[8px] font-bold text-white bg-industrial-orange px-2 py-0.5 uppercase tracking-widest font-display">ONLINE</span>
                                @endif
                        </div>
                    </div>

                    <!-- Card Data details -->
                    <div class="p-8 flex-grow flex flex-col justify-between transition-colors duration-300">
                        <div>
                            <h3 class="text-lg font-black text-slate-900 dark:text-white tracking-wide uppercase transition-colors group-hover:text-industrial-orange font-display">
                                {{ $product->title }}
                            </h3>
                            <p class="text-zinc-650 dark:text-zinc-300 text-xs mt-3 leading-relaxed min-h-[35px] font-sans font-light transition-colors duration-300">
                                {{ $product->character_description }}
                            </p>

                            <!-- Divider -->
                            <div class="my-5 border-t border-zinc-200/80 dark:border-zinc-900/80 transition-colors duration-300"></div>

                            <!-- Specs -->
                            <div class="space-y-3">
                                <h4 class="text-[8px] font-bold text-zinc-450 dark:text-zinc-555 uppercase tracking-widest mb-3 font-display">[ SPECIFICATION_PARAM ]</h4>
                                <div class="grid grid-cols-1 gap-2.5">
                                    @if(isset($product->specifications['items']) && is_array($product->specifications['items']) && count($product->specifications['items']) > 0)
                                    @foreach($product->specifications['items'] as $item)
                                    <div class="flex items-center gap-2.5 px-3 py-2 bg-zinc-100 dark:bg-zinc-900/40 border border-zinc-300/80 dark:border-zinc-800 rounded-lg">
                                        <span class="w-1.5 h-1.5 bg-industrial-orange rounded-full flex-shrink-0 animate-pulse"></span>
                                        <span class="text-xs font-sans text-slate-900 dark:text-zinc-200 font-medium transition-colors duration-300">{{ $item }}</span>
                                    </div>
                                    @endforeach
                                    @else
                                    <div class="text-[9px] font-display text-zinc-500 italic">Spesifikasi standar premium</div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Card Footer -->
                        <div class="mt-8 flex items-center justify-between gap-4 border-t border-zinc-200/80 dark:border-zinc-900/80 pt-6 transition-colors duration-300">
                            @php
                            $effectivePrice = $hasActiveEvent ? $product->price * (1 - ($discountPercentage / 100)) : $product->price;
                            @endphp
                            <div class="flex flex-col">
                                <span class="text-[9px] text-zinc-500 dark:text-zinc-555 uppercase tracking-widest font-display">Price</span>
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
                                @click="addToCart('{{ $product->id }}', '{{ $product->title }}', {{ $effectivePrice }}, '{{ $product->image_path ?: '/images/products/cotton.png' }}', null, {{ json_encode($product->marketplace_urls ?? new \stdClass()) }}); orderModalOpen = true;"
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
            @if($cottons->count() >= 6)
            <div class="mt-10 flex justify-center">
                <button type="button" x-show="!showAllCottons" @click="showAllCottons = true" class="px-6 py-3 text-[10px] uppercase font-bold tracking-widest text-center font-display transition-all duration-200 text-zinc-600 dark:text-zinc-200 border border-zinc-300 dark:border-zinc-700 hover:border-slate-900 dark:hover:border-white hover:text-slate-900 dark:hover:text-white hover:bg-zinc-100 dark:hover:bg-zinc-800/50 hover:scale-105">
                    LIHAT PRODUK LAINNYA
                </button>
            </div>
            @endif
        </section>
@endif
