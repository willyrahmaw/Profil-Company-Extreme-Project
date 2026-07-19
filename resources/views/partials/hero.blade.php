        <!-- Hero Section -->
        <section id="hero" class="relative py-20 sm:py-28">

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                <div class="flex flex-col items-center text-center space-y-8">

                    <!-- Lab Status Indicator -->
                    <div class="relative -top-10 md:-top-16 inline-flex items-center gap-2 px-3 py-1 bg-white dark:bg-zinc-950 border border-zinc-200 dark:border-zinc-800 text-[9px] font-bold text-industrial-orange uppercase tracking-widest font-display shadow-sm dark:shadow-none transition-colors duration-300">
                        <span class="w-1.5 h-1.5 bg-industrial-orange rounded-full animate-ping"></span>
                        Precision. Performance. Innovation
                    </div>

                    <!-- Headline & Watermark Wrapper -->
                    <div class="relative w-full flex justify-center items-center py-4 mb-20">
                        <!-- Subtle Logo Navbar Watermark behind the text (Centered absolutely without cropping) -->
                        <div class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 z-0 pointer-events-none flex items-center justify-center opacity-[0.3] dark:opacity-[0.2] select-none">
                            @if($siteSettings && $siteSettings->logo_path)
                            <img src="{{ $siteSettings->logo_path }}" alt="Logo Watermark" class="w-[95vw] md:w-[85vw] max-w-[1400px] h-auto object-contain hidden dark:block" fetchpriority="high" loading="eager" decoding="async">
                            @endif
                            @if($siteSettings && ($siteSettings->logo_light_path || $siteSettings->logo_path))
                            <img src="{{ $siteSettings->logo_light_path ?: $siteSettings->logo_path }}" alt="Logo Watermark" class="w-[95vw] md:w-[85vw] max-w-[1400px] h-auto object-contain block dark:hidden" fetchpriority="high" loading="eager" decoding="async">
                            @else
                            <!-- Fallback: Premium Ohm Symbol Watermark -->
                            <img src="{{ asset('images/profil/ohm.png') }}" alt="Ohm Watermark" class="w-[75vw] md:w-[60vw] max-w-[800px] h-auto object-contain dark:invert opacity-[0.8] dark:opacity-[0.6]" fetchpriority="high" loading="eager" decoding="async">
                            @endif
                        </div>

                        <!-- Headline Text -->
                        <h1 class="relative z-10 w-full text-center text-2xl sm:text-3xl font-black tracking-tight font-display uppercase leading-tight text-slate-900 dark:text-white transition-colors duration-300">EXPERIENCE THE NEXT LEVEL OF FLAVOR</h1>
                    </div>



                    <!-- Description -->
                    <p class="text-zinc-650 dark:text-zinc-400 text-sm leading-relaxed max-w-2xl font-sans font-light mt-12 mx-auto transition-colors duration-300">
                        EXTREME PROJECT menghadirkan coil dan organic cotton premium yang dirancang khusus untuk vapers yang mengutamakan performa maksimal, flavor yang kaya, serta konsistensi dalam setiap build.
                    </p>

                    <!-- Actions -->
                    <div class="flex flex-col sm:flex-row items-stretch sm:items-center justify-center gap-4 w-full max-w-md pt-2">
                        <a href="#products" class="stealth-btn-primary px-8 py-4 text-xs font-bold uppercase tracking-widest text-center font-display shadow-md dark:shadow-none">
                            EXPLORE CATALOG
                        </a>
                        <a href="#why-choose-me" class="px-8 py-4 text-xs font-bold uppercase tracking-widest text-center font-display transition-all duration-200 text-zinc-650 dark:text-zinc-200 border border-zinc-300 dark:border-zinc-700 hover:border-slate-900 dark:hover:border-white hover:text-slate-900 dark:hover:text-white hover:bg-zinc-100 dark:hover:bg-zinc-800/50 hover:scale-105">
                            WHY CHOOSE ME &rarr;
                        </a>
                    </div>

                    <!-- Statistics / Social Proof Strip -->
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-6 md:gap-12 w-full max-w-4xl mx-auto pt-8 border-t border-zinc-200/40 dark:border-zinc-900/60 transition-colors">
                        <div class="text-center space-y-1">
                            <div class="text-2xl sm:text-3xl font-black text-industrial-orange font-display">40.000+</div>
                            <div class="text-[9px] uppercase tracking-widest text-zinc-550 dark:text-zinc-500 font-display font-bold">Products Sold</div>
                        </div>
                        <div class="text-center space-y-1">
                            <div class="text-2xl sm:text-3xl font-black text-slate-900 dark:text-white font-display">6</div>
                            <div class="text-[9px] uppercase tracking-widest text-zinc-550 dark:text-zinc-500 font-display font-bold">Coil Varian</div>
                        </div>
                        <div class="text-center space-y-1">
                            <div class="text-2xl sm:text-3xl font-black text-slate-900 dark:text-white font-display">2021</div>
                            <div class="text-[9px] uppercase tracking-widest text-zinc-550 dark:text-zinc-500 font-display font-bold">Established</div>
                        </div>
                        <div class="text-center space-y-1">
                            <div class="text-2xl sm:text-3xl font-black text-industrial-orange font-display">100%</div>
                            <div class="text-[9px] uppercase tracking-widest text-zinc-550 dark:text-zinc-500 font-display font-bold">Handmade Craft</div>
                        </div>
                    </div>

                    <!-- 2-Column Coil & Cotton Layout -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 w-full max-w-4xl mx-auto pt-8">

                        <!-- Card 1: Coil (Fused Clapton Helix) -->
                        <div class="stealth-card p-6 bg-white/40 dark:bg-zinc-950/10 backdrop-blur-sm border border-zinc-250 dark:border-zinc-900 rounded-2xl relative shadow-inner text-left flex flex-col justify-between group hover:border-industrial-orange/30 transition-all duration-300">
                            <!-- Technical corner accents -->
                            <div class="absolute -top-px -left-px w-2 h-2 border-t border-l border-industrial-orange"></div>
                            <div class="absolute -top-px -right-px w-2 h-2 border-t border-r border-industrial-orange"></div>
                            <div class="absolute -bottom-px -left-px w-2 h-2 border-b border-l border-industrial-orange"></div>
                            <div class="absolute -bottom-px -right-px w-2 h-2 border-b border-r border-industrial-orange"></div>

                            <div class="space-y-4">
                                <div class="flex justify-between items-center font-display text-[7px] text-zinc-400 dark:text-zinc-650 border-b border-zinc-150 dark:border-zinc-900 pb-2">
                                    <span>SYS_REF: COIL_HEATING_SYS</span>
                                    <span class="text-industrial-orange font-bold">HEATING: ACTIVE</span>
                                </div>

                                <!-- Ohm PNG Image -->
                                <div class="h-32 flex items-center justify-center">
                                    <img src="{{ asset('images/profil/ohm.png') }}" alt="Ohm Symbol" class="h-28 w-28 object-contain transition-all duration-300 animate-coil-glow dark:invert dark:opacity-60" fetchpriority="high" loading="eager" decoding="async" />
                                </div>

                                <h3 class="text-sm font-bold text-slate-900 dark:text-white uppercase font-display tracking-wide">Precision Coil</h3>
                                <p class="text-zinc-500 dark:text-zinc-450 text-xs font-sans leading-relaxed">
                                    Kawat handmade lilitan mikro Ni80 dengan hambatan stabil, menghasilkan pemanasan instan dan ekstraksi flavor yang detail.
                                </p>
                            </div>

                            <div class="mt-4 border-t border-zinc-150 dark:border-zinc-900 pt-2 font-display text-[7px] text-zinc-400 dark:text-zinc-650 flex justify-between">
                                <span>RESIST: 0.12 OHM</span>
                                <span>RMP_UP: INSTANT</span>
                            </div>
                        </div>

                        <!-- Card 2: Cotton (Organic Capillary Waves) -->
                        <div class="stealth-card p-6 bg-white/40 dark:bg-zinc-950/10 backdrop-blur-sm border border-zinc-250 dark:border-zinc-900 rounded-2xl relative shadow-inner text-left flex flex-col justify-between group hover:border-industrial-orange/30 transition-all duration-300">
                            <!-- Technical corner accents -->
                            <div class="absolute -top-px -left-px w-2 h-2 border-t border-l border-industrial-orange"></div>
                            <div class="absolute -top-px -right-px w-2 h-2 border-t border-r border-industrial-orange"></div>
                            <div class="absolute -bottom-px -left-px w-2 h-2 border-b border-l border-industrial-orange"></div>
                            <div class="absolute -bottom-px -right-px w-2 h-2 border-b border-r border-industrial-orange"></div>

                            <div class="space-y-4">
                                <div class="flex justify-between items-center font-display text-[7px] text-zinc-400 dark:text-zinc-650 border-b border-zinc-150 dark:border-zinc-900 pb-2">
                                    <span>SYS_REF: COTTON_WICKING_MED</span>
                                    <span class="text-industrial-orange font-bold">WICKING: 99%</span>
                                </div>

                                <!-- Cotton PNG Image -->
                                <div class="h-32 flex items-center justify-center">
                                    <img src="{{ asset('images/profil/cotton.png') }}" alt="Organic Cotton" class="h-28 w-28 object-contain transition-all duration-300 animate-coil-glow group-hover:brightness-75 dark:invert dark:opacity-60 group-hover:dark:opacity-90" fetchpriority="high" loading="eager" decoding="async" />
                                </div>

                                <h3 class="text-sm font-bold text-slate-900 dark:text-white uppercase font-display tracking-wide">Organic Cotton</h3>
                                <p class="text-zinc-500 dark:text-zinc-450 text-xs font-sans leading-relaxed">
                                    Serat kapas organik 100% tanpa pemutih kimia untuk daya serap tinggi (wicking) dan menjaga kemurnian aroma liquid Anda.
                                </p>
                            </div>

                            <div class="mt-4 border-t border-zinc-150 dark:border-zinc-900 pt-2 font-display text-[7px] text-zinc-400 dark:text-zinc-650 flex justify-between">
                                <span>PURITY: 100% ORG</span>
                                <span>CHEM: FREE</span>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>
