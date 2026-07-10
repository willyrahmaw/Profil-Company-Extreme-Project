<!-- Reviews / Testimonial Section -->
<section id="reviews" class="py-24 bg-slate-50 dark:bg-black/50 border-t border-zinc-200 dark:border-zinc-900 transition-colors duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Section Header -->
        <div class="space-y-3 mb-16 border-b border-zinc-200 dark:border-zinc-900 pb-8 text-left transition-colors duration-300">
            <div class="inline-flex items-center gap-2 px-3 py-1 bg-white dark:bg-zinc-950 border border-zinc-200 dark:border-zinc-800 text-[9px] font-bold text-industrial-orange uppercase tracking-widest font-mono shadow-sm dark:shadow-none transition-colors duration-300">
                USER_FEEDBACK: SOCIAL_PROOF
            </div>
            <h2 class="text-3xl font-black tracking-tight text-slate-900 dark:text-white font-display uppercase transition-colors duration-300">REVIEW PELANGGAN</h2>
            <p class="text-zinc-550 text-xs font-sans">Kata mereka yang telah membuktikan kualitas dan durabilitas produk buatan tangan kami.</p>
        </div>

        @php
        $displayReviews = isset($testimonials) && $testimonials->isNotEmpty() ? $testimonials->map(fn($t) => [
            'name' => $t->name,
            'avatar' => $t->avatar_initial ?: strtoupper(substr($t->name, 0, 1)),
            'stars' => $t->stars,
            'content' => $t->content
        ]) : [
            ['name' => 'Rizky', 'avatar' => 'R', 'stars' => 5, 'content' => 'Flavor paling keluar dibanding coil pabrikan lain. Sensasi rasa creamy-nya tebal banget dan konsisten sampai beberapa minggu penggunaan.'],
            ['name' => 'Dimas', 'avatar' => 'D', 'stars' => 5, 'content' => 'Gila sih, awet hampir 3 minggu dengan perawatan rutin. Manisnya dapet dan ramp-up speed-nya super instan.'],
            ['name' => 'Bagas', 'avatar' => 'B', 'stars' => 5, 'content' => 'Ramp up cepat banget, throat hit juga mantap nendang pas untuk liquid fruity dingin. Sangat recommended!']
        ];
        @endphp

        <!-- Reviews Slider -->
        <div class="relative max-w-4xl mx-auto overflow-hidden" 
             x-data="{ 
                 activeIndex: 0, 
                 count: {{ count($displayReviews) }},
                 paused: false,
                 init() {
                     setInterval(() => {
                         if (!this.paused) {
                             this.activeIndex = (this.activeIndex + 1) % this.count;
                         }
                     }, 5000);
                 }
             }"
             @mouseenter="paused = true"
             @mouseleave="paused = false">
            
            <!-- Slider Track Container -->
            <div class="flex transition-transform duration-500 ease-out"
                 :style="'transform: translateX(-' + (activeIndex * 100) + '%)'">
                
                @foreach($displayReviews as $review)
                <div class="w-full flex-shrink-0 px-4">
                    <div class="stealth-card p-8 sm:p-12 bg-white dark:bg-zinc-950/20 border border-zinc-250 dark:border-zinc-900 rounded-2xl relative shadow-sm hover:border-industrial-orange/30 transition-all duration-300 flex flex-col justify-between h-full">
                         
                        <!-- Technical corner accents -->
                        <div class="absolute -top-px -left-px w-2 h-2 border-t border-l border-zinc-300 dark:border-zinc-800"></div>
                        <div class="absolute -top-px -right-px w-2 h-2 border-t border-r border-zinc-300 dark:border-zinc-800"></div>
                        
                        <!-- Decorative large quote -->
                        <div class="absolute right-8 top-6 text-zinc-200 dark:text-zinc-900/60 font-serif text-8xl leading-none select-none pointer-events-none">”</div>
                        
                        <div>
                            <!-- Stars -->
                            <div class="flex items-center gap-1 text-industrial-orange mb-6">
                                @for($i=0; $i<$review['stars']; $i++)
                                <svg class="h-4.5 w-4.5 fill-current" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                @endfor
                            </div>

                            <!-- Review Content -->
                            <p class="text-zinc-750 dark:text-zinc-300 text-sm sm:text-base font-sans font-light leading-relaxed italic mb-8 pr-12 text-justify">
                                "{{ $review['content'] }}"
                            </p>
                        </div>

                        <!-- Reviewer Profile -->
                        <div class="flex items-center justify-between gap-4 border-t border-zinc-100 dark:border-zinc-900 pt-6 mt-4">
                            <div class="flex items-center gap-3 font-mono text-xs">
                                <div class="w-10 h-10 rounded-full bg-industrial-orange/10 border border-industrial-orange/20 text-industrial-orange flex items-center justify-center font-bold font-display text-sm">
                                    {{ $review['avatar'] }}
                                </div>
                                <div>
                                    <div class="font-bold text-slate-800 dark:text-white text-sm">{{ $review['name'] }}</div>
                                    <div class="text-[9px] text-zinc-500 uppercase tracking-widest mt-0.5">Verified Buyer</div>
                                </div>
                            </div>
                            
                            <!-- Mini Indicator -->
                            <div class="text-[8px] font-mono text-zinc-500 uppercase tracking-widest">
                                Response {{ $loop->iteration }} of {{ $loop->remaining + $loop->iteration }}
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            
            <!-- Navigation Controls (Prev/Next) -->
            <div class="absolute top-1/2 -translate-y-1/2 left-2 z-20">
                <button type="button" @click="activeIndex = (activeIndex - 1 + count) % count"
                        class="p-2.5 rounded-full bg-white/80 dark:bg-zinc-950/80 border border-zinc-200 dark:border-zinc-900 text-zinc-500 hover:text-industrial-orange hover:border-industrial-orange shadow-md dark:shadow-none hover:scale-105 active:scale-95 transition-all backdrop-blur-sm">
                    <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                    </svg>
                </button>
            </div>
            <div class="absolute top-1/2 -translate-y-1/2 right-2 z-20">
                <button type="button" @click="activeIndex = (activeIndex + 1) % count"
                        class="p-2.5 rounded-full bg-white/80 dark:bg-zinc-950/80 border border-zinc-200 dark:border-zinc-900 text-zinc-500 hover:text-industrial-orange hover:border-industrial-orange shadow-md dark:shadow-none hover:scale-105 active:scale-95 transition-all backdrop-blur-sm">
                    <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
            </div>
            
            <!-- Navigation Dots -->
            <div class="flex items-center justify-center gap-2 mt-8">
                @foreach($displayReviews as $review)
                <button type="button" @click="activeIndex = {{ $loop->index }}"
                        class="w-2 h-2 rounded-full transition-all duration-300"
                        :class="activeIndex === {{ $loop->index }} ? 'bg-industrial-orange w-6' : 'bg-zinc-350 dark:bg-zinc-800 hover:bg-zinc-400 dark:hover:bg-zinc-700'"></button>
                @endforeach
            </div>
        </div>
    </div>
</section>
