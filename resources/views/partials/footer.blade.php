    <!-- Footer -->
    <footer class="bg-slate-50 dark:bg-black border-t border-zinc-200 dark:border-zinc-900 pt-16 pb-8 transition-colors duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-12">
                
                <!-- Column 1: Brand Info -->
                <div class="space-y-4">
                    <h3 class="text-xs font-black tracking-widest text-slate-900 dark:text-white uppercase font-display">EXTREME PROJECT</h3>
                    <p class="text-zinc-550 dark:text-zinc-400 text-xs font-sans font-light leading-relaxed">
                        Penyedia kawat coil dan organic cotton premium handmade terbaik sejak 2021. Dirancang presisi demi performa ekstraksi rasa maksimal.
                    </p>
                </div>

                <!-- Column 2: Quick Links -->
                <div class="space-y-3 font-mono text-[10px]">
                    <h4 class="text-zinc-400 dark:text-zinc-500 uppercase tracking-widest font-bold">Quick Links</h4>
                    <div class="flex flex-col gap-2 uppercase tracking-wider font-semibold">
                        <a href="{{ route('home') }}#products" class="text-zinc-650 dark:text-zinc-450 hover:text-industrial-orange transition-colors">Products Catalog</a>
                        <a href="{{ route('home') }}#catalog-coils" class="text-zinc-650 dark:text-zinc-450 hover:text-industrial-orange transition-colors">Reaktor Coils</a>
                        @if(\App\Models\Product::where('category', 'cotton')->exists())
                        <a href="{{ route('home') }}#catalog-cottons" class="text-zinc-650 dark:text-zinc-450 hover:text-industrial-orange transition-colors">Serat Kapas</a>
                        @endif
                        <a href="{{ route('home') }}#compare-coils" class="text-zinc-650 dark:text-zinc-450 hover:text-industrial-orange transition-colors">Compare Matrix</a>
                    </div>
                </div>

                <!-- Column 3: Support -->
                <div class="space-y-3 font-mono text-[10px]">
                    <h4 class="text-zinc-400 dark:text-zinc-500 uppercase tracking-widest font-bold">Support & Guide</h4>
                    <div class="flex flex-col gap-2 uppercase tracking-wider font-semibold">
                        <a href="{{ route('learn') }}" class="text-zinc-650 dark:text-zinc-450 hover:text-industrial-orange transition-colors">Educational Guides</a>
                        <a href="{{ route('home') }}#faq" class="text-zinc-650 dark:text-zinc-450 hover:text-industrial-orange transition-colors">FAQ</a>
                        <a href="{{ route('research.show') }}" class="text-zinc-650 dark:text-zinc-450 hover:text-industrial-orange transition-colors">Customer Research</a>
                        <span class="text-zinc-500 dark:text-zinc-600 cursor-default">Warranty Support</span>
                    </div>
                </div>

                <!-- Column 4: Contact & Socials -->
                <div class="space-y-3 font-mono text-[10px]">
                    <h4 class="text-zinc-400 dark:text-zinc-500 uppercase tracking-widest font-bold">Social Media</h4>
                    <div class="flex flex-col gap-2 uppercase tracking-wider font-semibold">
                        <a href="https://instagram.com/extreme_project" target="_blank" class="text-zinc-650 dark:text-zinc-450 hover:text-industrial-orange transition-colors">Instagram</a>
                        <a href="https://tiktok.com/@extreme_official" target="_blank" class="text-zinc-650 dark:text-zinc-450 hover:text-industrial-orange transition-colors">TikTok Shop</a>
                        <a href="{{ $defaultWaUrl }}" target="_blank" class="text-zinc-650 dark:text-zinc-450 hover:text-industrial-orange transition-colors">WhatsApp Order</a>
                    </div>
                </div>
            </div>

            <!-- Bottom Border & Copyright -->
            <div class="border-t border-zinc-200 dark:border-zinc-900 pt-8 flex flex-col md:flex-row items-center justify-between gap-4 text-[9px] tracking-widest text-zinc-550 uppercase font-mono transition-colors">
                <div>
                    &copy; 2026 Extreme Project. Handcrafted Precision. Hak Cipta Dilindungi.
                </div>
                <div class="flex gap-4">
                    <span>SYS_NODE: ONLINE</span>
                    <span>STERILIZED_SYS: OK</span>
                </div>
            </div>
        </div>
    </footer>
