        <!-- Ordering Channels Section -->
        <section id="ordering" class="py-24 bg-slate-50 dark:bg-black border-t border-zinc-200 dark:border-zinc-900 transition-colors duration-300">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 text-center space-y-6 flex flex-col items-center">
                <div class="inline-flex items-center gap-2 px-3 py-1 bg-white dark:bg-zinc-950 border border-zinc-200 dark:border-zinc-800 text-[9px] font-bold text-industrial-orange uppercase tracking-widest font-display mx-auto shadow-sm dark:shadow-none transition-colors duration-300">
                    SYS_NODE: ORDER_NOW
                </div>
                <h2 class="text-3xl font-black tracking-tight text-slate-900 dark:text-white font-display uppercase transition-colors duration-300">Ready to Experience Extreme Flavor?</h2>
                <p class="text-zinc-650 dark:text-zinc-500 max-w-xl mx-auto text-xs leading-relaxed font-sans font-light transition-colors duration-300">
                    Hubungi kami langsung melalui kontak resmi di bawah ini atau belanja instan lewat official marketplace kami.
                </p>
 
                @php
                $platforms = [
                'shopee' => [
                'label' => 'SHOPEE',
                'sub' => 'Beli di Shopee',
                'empty' => 'Belum ada toko Shopee',
                'svg' => '<svg class="h-6 w-6 text-zinc-400 group-hover:text-industrial-orange mb-3 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                </svg>'
                ],
                'tokopedia' => [
                'label' => 'TOKOPEDIA',
                'sub' => 'Beli di Tokopedia',
                'empty' => 'Belum ada toko Tokopedia',
                'svg' => '<svg class="h-6 w-6 text-zinc-400 group-hover:text-industrial-orange mb-3 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                </svg>'
                ],
                'tiktok' => [
                'label' => 'TIKTOK SHOP',
                'sub' => 'Pilih Akun Toko',
                'empty' => 'Belum ada toko aktif',
                'svg' => '<svg class="h-6 w-6 text-zinc-400 group-hover:text-industrial-orange mb-3 transition-colors" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.17-2.86-.74-3.99-1.72-.08-.07-.17-.17-.25-.25v6.07c0 2.21-.75 4.43-2.31 6.01-1.79 1.8-4.5 2.51-6.94 1.89-2.73-.69-4.96-2.91-5.4-5.69-.64-4.04 2.12-7.9 6.17-8.52.26-.04.53-.06.79-.08v4.07c-1.12.11-2.23.63-2.87 1.57-.75 1.12-.76 2.66-.02 3.79.74 1.1 2.13 1.69 3.44 1.44 1.17-.22 2.12-1.22 2.33-2.39.06-.32.08-.66.08-.99V0c-.23.01-.46.01-.69.02z" />
                </svg>'
                ],
                'whatsapp' => [
                'label' => 'WHATSAPP',
                'sub' => 'Hubungi Kami',
                'empty' => 'Belum ada nomor WA',
                'svg' => '<svg class="h-6 w-6 text-zinc-400 group-hover:text-industrial-orange mb-3 transition-colors" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L0 24l6.335-1.662c1.746.953 3.71 1.458 5.704 1.459h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" />
                </svg>'
                ],
                'instagram' => [
                'label' => 'INSTAGRAM',
                'sub' => 'DM Kami',
                'empty' => 'Belum ada akun IG',
                'svg' => '<svg class="h-6 w-6 text-zinc-400 group-hover:text-industrial-orange mb-3 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <rect x="2" y="2" width="20" height="20" rx="5" ry="5" />
                    <path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37z" />
                    <line x1="17.5" y1="6.5" x2="17.51" y2="6.5" />
                </svg>'
                ]
                ];
                @endphp

                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 w-full max-w-4xl mx-auto pt-4 font-display">
                    @foreach($platforms as $pKey => $pInfo)
                    @php
                    $platformShops = $shops->where('platform', $pKey)->where('is_active', true);
                    @endphp
                    @if($platformShops->isNotEmpty())
                    @if($platformShops->count() === 1)
                    <a href="{{ $platformShops->first()->url }}" target="_blank"
                        class="stealth-card p-8 rounded-2xl flex flex-col items-center justify-center text-center group relative bg-white/80 dark:bg-zinc-900/60 border border-zinc-200 dark:border-zinc-800 hover:border-industrial-orange/50 dark:hover:border-industrial-orange/50 shadow-sm dark:shadow-none transition-colors duration-300">
                        {!! $pInfo['svg'] !!}
                        <span class="text-xs uppercase font-bold tracking-wider text-zinc-500 dark:text-zinc-400 group-hover:text-industrial-orange transition-colors">[ {{ $pInfo['label'] }} ]</span>
                        <span class="text-[9px] text-zinc-500 dark:text-zinc-650 mt-2">{{ $pInfo['sub'] }}</span>
                    </a>
                    @else
                    <div x-data="{ open: false }" @click.away="open = false"
                        class="stealth-card p-8 rounded-2xl flex flex-col items-center justify-center text-center group relative cursor-pointer select-none bg-white/80 dark:bg-zinc-900/60 border border-zinc-200 dark:border-zinc-800 hover:border-industrial-orange/50 dark:hover:border-industrial-orange/50 shadow-sm dark:shadow-none transition-colors duration-300">
                        <div @click="open = !open" class="flex flex-col items-center justify-center w-full h-full">
                            {!! $pInfo['svg'] !!}
                            <span class="text-xs uppercase font-bold tracking-wider text-zinc-500 dark:text-zinc-400 group-hover:text-industrial-orange transition-colors flex items-center justify-center gap-1.5 w-full">
                                [ {{ $pInfo['label'] }} ]
                                <svg class="h-3 w-3 transition-transform duration-200" :class="open ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </span>
                            <span class="text-[9px] text-zinc-500 dark:text-zinc-650 mt-2">{{ $pInfo['sub'] }}</span>
                        </div>

                        <!-- Dropdown List -->
                        <div x-show="open"
                            x-transition:enter="transition ease-out duration-150 transform"
                            x-transition:enter-start="opacity-0 scale-95 translate-y-2"
                            x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                            x-transition:leave="transition ease-in duration-100 transform"
                            x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                            x-transition:leave-end="opacity-0 scale-95 translate-y-2"
                            class="absolute left-0 right-0 top-full mt-2 z-30 bg-white dark:bg-zinc-950 border border-zinc-200 dark:border-zinc-800 p-2 space-y-1 font-display text-[10px] shadow-lg dark:shadow-none transition-colors duration-300"
                            style="display: none;"
                            @click.stop>
                            @foreach($platformShops as $shop)
                            <a href="{{ $shop->url }}" target="_blank"
                                class="block w-full text-left px-3 py-2 text-slate-800 dark:text-zinc-400 hover:text-industrial-orange dark:hover:text-industrial-orange hover:bg-zinc-50 dark:hover:bg-zinc-900/50 transition-all border border-transparent hover:border-zinc-200 dark:hover:border-zinc-800/50 uppercase font-bold tracking-wider">
                                {{ $shop->name }}
                            </a>
                            @endforeach
                        </div>
                    </div>
                    @endif
                    @endif
                    @endforeach
                </div>
            </div>
        </section>
