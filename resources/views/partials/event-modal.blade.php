    <!-- Event Promo Modal Pop-up -->
    @if($hasActiveEvent)
    <div x-show="showEventPopup"
        x-cloak
        class="fixed inset-0 z-50 overflow-y-auto flex items-center justify-center p-4">

        <!-- Backdrop -->
        <div class="fixed inset-0 bg-black/85 backdrop-blur-md" @click="closeEventPopup()"></div>
        <!-- Modal Box -->
        <div class="relative transform overflow-hidden rounded-2xl bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 text-left shadow-2xl max-w-lg w-full max-h-[85vh] flex flex-col font-sans text-zinc-900 dark:text-slate-200 z-10"
            @keydown.window.escape="closeEventPopup()">

            <!-- Tech accents -->
            <div class="absolute -top-px -left-px w-3 h-3 border-t border-l border-industrial-orange"></div>
            <div class="absolute -top-px -right-px w-3 h-3 border-t border-r border-industrial-orange"></div>
            <div class="absolute -bottom-px -left-px w-3 h-3 border-b border-l border-industrial-orange"></div>
            <div class="absolute -bottom-px -right-px w-3 h-3 border-b border-r border-industrial-orange"></div>

            <!-- Close Button (Top Right) -->
            <button type="button"
                @click="closeEventPopup()"
                class="absolute top-4 right-4 z-10 p-2 rounded bg-white/60 hover:bg-white/90 dark:bg-black/60 dark:hover:bg-black/90 border border-zinc-200 dark:border-zinc-800 hover:border-industrial-orange text-zinc-500 hover:text-zinc-900 dark:text-zinc-400 dark:hover:text-white transition-all shadow-md focus:outline-none"
                title="Tutup">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            <!-- Flyer Image or Fallback Text -->
            <div class="overflow-y-auto flex-grow max-h-[75vh]">
                @if($activeEvent->image_path)
                <img src="{{ $activeEvent->image_path }}" alt="{{ $activeEvent->name }}" class="w-full h-auto object-contain select-none">
                @else
                <div class="p-8 sm:p-12 text-center space-y-6 bg-zinc-50 dark:bg-black/40">
                    <span class="text-[10px] font-display text-industrial-orange font-bold uppercase tracking-widest">[ DETAIL_KAMPANYE_PROMO ]</span>
                    <h3 class="text-2xl sm:text-3xl font-black text-zinc-950 dark:text-white uppercase font-display tracking-wide leading-tight">
                        {{ $activeEvent->name }}
                    </h3>
                    <div class="py-6 border-y border-zinc-200 dark:border-zinc-900 flex flex-col items-center justify-center">
                        <span class="text-[9px] text-zinc-500 uppercase tracking-widest font-display">Besar Potongan Harga</span>
                        <span class="text-5xl sm:text-6xl font-black text-industrial-orange font-display tracking-tight leading-none mt-2">
                            {{ $activeEvent->discount_percentage }}% OFF
                        </span>
                    </div>
                    <p class="text-zinc-600 dark:text-zinc-400 text-xs leading-relaxed max-w-sm mx-auto font-sans font-light">
                        Diskon global otomatis diterapkan pada semua produk kami (Coil & Cotton) saat Anda menambahkannya ke keranjang belanja WhatsApp.
                    </p>
                </div>
                @endif
            </div>

            <!-- Footer / Action -->
            <div class="p-4 bg-zinc-50 dark:bg-zinc-950 border-t border-zinc-200 dark:border-zinc-900 flex flex-col sm:flex-row items-center justify-between gap-3 text-center sm:text-left">
                <div>
                    <p class="text-[8px] font-display text-industrial-orange font-bold uppercase tracking-widest">[ KAMPANYE_PROMO ]</p>
                    <h4 class="text-xs font-bold text-zinc-950 dark:text-white uppercase mt-0.5 tracking-wider">{{ $activeEvent->name }} ({{ $activeEvent->discount_percentage }}% OFF)</h4>
                </div>
                <button type="button"
                    @click="closeEventPopup()"
                    class="stealth-btn-primary px-5 py-2.5 text-[10px] uppercase font-bold tracking-widest rounded-none shadow-md">
                    Mulai Belanja
                </button>
            </div>
        </div>
    </div>
    @endif
