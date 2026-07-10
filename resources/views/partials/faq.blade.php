<!-- FAQ Section -->
<section id="faq" class="py-24 bg-white dark:bg-black border-t border-zinc-200 dark:border-zinc-900 transition-colors duration-300">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Section Header -->
        <div class="space-y-3 mb-16 border-b border-zinc-200 dark:border-zinc-900 pb-8 text-center transition-colors duration-300">
            <div class="inline-flex items-center gap-2 px-3 py-1 bg-white dark:bg-zinc-950 border border-zinc-200 dark:border-zinc-800 text-[9px] font-bold text-industrial-orange uppercase tracking-widest font-mono shadow-sm dark:shadow-none transition-colors duration-300">
                FAQ: CUSTOMER_SUPPORT
            </div>
            <h2 class="text-3xl font-black tracking-tight text-slate-900 dark:text-white font-display uppercase transition-colors duration-300">FREQUENTLY ASKED QUESTIONS</h2>
            <p class="text-zinc-550 text-xs font-sans">Semua jawaban yang Anda butuhkan tentang perawatan kawat coil dan serat wicking kapas organik kami.</p>
        </div>

        <!-- FAQ Accordion Block -->
        <div class="space-y-4" x-data="{ activeFaq: null }">
            @foreach([
                [
                    'q' => 'Berapa lama kawat coil Extreme Project bisa bertahan?',
                    'a' => 'Dengan perawatan rutin (seperti menyikat kawat coil dengan lembut saat wicking ulang dan menghindari dry burn berlebihan), coil handmade Ni80 kami dapat bertahan antara 14 hingga 21 hari dengan performa rasa yang tetap tajam.'
                ],
                [
                    'q' => 'Bagaimana cara melakukan priming coil yang benar?',
                    'a' => 'Priming dilakukan dengan meneteskan liquid langsung secara merata pada kapas baru (wicking) dan kawat coil hingga benar-benar basah jenuh. Biarkan meresap selama 3-5 menit sebelum melakukan firing pertama agar kapas tidak gosong (dry hit).'
                ],
                [
                    'q' => 'Mengapa coil saya cepat sekali gosong atau berkerak?',
                    'a' => 'Penyebab utama coil cepat berkerak atau gosong meliputi: (1) Menggunakan liquid dengan pemanis buatan tinggi (sweetener), (2) Melakukan firing pada wattage yang melebihi batas rekomendasi, atau (3) Kualitas kapas yang jenuh. Bersihkan kawat coil secara berkala menggunakan ultrasonic cleaner atau sikat coil halus.'
                ],
                [
                    'q' => 'Bagaimana cara memilih jenis coil yang paling cocok?',
                    'a' => 'Anda bisa menggunakan fitur interaktif **Coil Finder** di seksi atas halaman produk kami untuk mendapatkan rekomendasi instan, atau klik menu **LEARN** di navbar atas untuk membaca panduan memilih coil secara detail.'
                ],
                [
                    'q' => 'Apakah coil Extreme Project bisa digunakan untuk RTA?',
                    'a' => 'Sangat bisa. Kami menyediakan versi coil berdiameter 2.5 mm (misal V4, V6) yang memiliki ukuran pas untuk deck atomizer RTA sempit, di samping diameter 3 mm standar untuk RDA ber-deck luas.'
                ],
                [
                    'q' => 'Berapa wattage (watt) yang direkomendasikan?',
                    'a' => 'Daya watt yang direkomendasikan tergantung pada varian coil: Single coil umumnya optimal di 30-45W (seperti V4, V6), sedangkan dual coil optimal di 40-55W (seperti V1, V2). Selalu mulai dari watt rendah (e.g. 30W) lalu naikkan perlahan.'
                ]
            ] as $index => $faqItem)
            <div class="stealth-card border rounded-xl overflow-hidden transition-all duration-200"
                :class="activeFaq === {{ $index }} ? 'border-industrial-orange/60 bg-industrial-orange/5' : 'border-zinc-200 dark:border-zinc-900 bg-zinc-950/10'">
                
                <button type="button" @click="activeFaq = (activeFaq === {{ $index }} ? null : {{ $index }})"
                    class="w-full px-6 py-4 flex items-center justify-between text-left focus:outline-none group">
                    <span class="text-xs sm:text-sm font-bold uppercase tracking-wider font-display text-slate-900 dark:text-white group-hover:text-industrial-orange transition-colors">
                        {{ $faqItem['q'] }}
                    </span>
                    <svg class="h-4 w-4 text-zinc-500 transition-transform duration-200 flex-shrink-0"
                        :class="activeFaq === {{ $index }} ? 'transform rotate-180 text-industrial-orange' : ''"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>

                <div x-show="activeFaq === {{ $index }}" x-cloak
                    x-transition:enter="transition ease-out duration-150"
                    x-transition:enter-start="opacity-0 max-h-0"
                    x-transition:enter-end="opacity-100 max-h-screen"
                    class="px-6 pb-5">
                    <p class="text-zinc-650 dark:text-zinc-300 text-xs sm:text-sm leading-relaxed font-sans font-light">
                        {{ $faqItem['a'] }}
                    </p>
                </div>
            </div>
            @endforeach
        </div>

    </div>
</section>
