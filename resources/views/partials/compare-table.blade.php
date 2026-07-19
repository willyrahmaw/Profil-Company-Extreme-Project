<!-- Compare Table Section -->
<section id="compare-coils" class="py-24 bg-white dark:bg-black border-t border-zinc-200 dark:border-zinc-900 transition-colors duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Section Header -->
        <div class="space-y-3 mb-12 border-b border-zinc-200 dark:border-zinc-900 pb-8 text-left transition-colors duration-300">
            <div class="inline-flex items-center gap-2 px-3 py-1 bg-white dark:bg-zinc-950 border border-zinc-200 dark:border-zinc-800 text-[9px] font-bold text-industrial-orange uppercase tracking-widest font-display shadow-sm dark:shadow-none transition-colors duration-300">
                COIL COMPONENT MATRIX: COMPARISON
            </div>
            <h2 class="text-3xl font-black tracking-tight text-slate-900 dark:text-white font-display uppercase transition-colors duration-300">PERBANDINGAN VARIAN COIL</h2>
            <p class="text-zinc-550 text-xs font-sans">Bandingkan rating performa dan kecocokan setiap tipe Extreme Coil untuk menemukan kecocokan setup Anda.</p>
        </div>

        <!-- Desktop View Table -->
        <div class="hidden md:block overflow-hidden border border-zinc-200 dark:border-zinc-800 rounded-2xl bg-white dark:bg-zinc-950/20 backdrop-blur-md shadow-md">
            <table class="w-full text-left font-display text-[10px] text-zinc-700 dark:text-zinc-300 border-collapse">
                <thead>
                    <tr class="bg-zinc-50 dark:bg-zinc-900/40 text-zinc-555 dark:text-zinc-500 uppercase tracking-wider border-b border-zinc-200 dark:border-zinc-800/80">
                        <th class="px-6 py-5 font-bold text-xs uppercase font-display text-zinc-800 dark:text-zinc-200">Spesifikasi / Varian</th>
                        <th class="px-4 py-5 text-center">
                            <span class="inline-flex items-center px-2.5 py-1 bg-zinc-950 border border-zinc-800 text-zinc-100 dark:bg-zinc-900 dark:border-zinc-800 dark:text-white rounded text-[10px] font-bold tracking-wider font-display">V1 (HITAM)</span>
                        </th>
                        <th class="px-4 py-5 text-center">
                            <span class="inline-flex items-center px-2.5 py-1 bg-amber-500/10 border border-amber-500/20 text-amber-500 dark:text-amber-400 rounded text-[10px] font-bold tracking-wider font-display">V2 (KUNING)</span>
                        </th>
                        <th class="px-4 py-5 text-center">
                            <span class="inline-flex items-center px-2.5 py-1 bg-pink-500/10 border border-pink-500/20 text-pink-500 dark:text-pink-400 rounded text-[10px] font-bold tracking-wider font-display">V3 (PINK)</span>
                        </th>
                        <th class="px-4 py-5 text-center">
                            <span class="inline-flex items-center px-2.5 py-1 bg-purple-500/10 border border-purple-500/20 text-purple-500 dark:text-purple-450 rounded text-[10px] font-bold tracking-wider font-display">V4 (UNGU)</span>
                        </th>
                        <th class="px-4 py-5 text-center">
                            <span class="inline-flex items-center px-2.5 py-1 bg-zinc-200/50 dark:bg-zinc-800/30 border border-zinc-300 dark:border-zinc-700 text-zinc-800 dark:text-zinc-300 rounded text-[10px] font-bold tracking-wider font-display">V5 (PUTIH)</span>
                        </th>
                        <th class="px-4 py-5 text-center">
                            <span class="inline-flex items-center px-2.5 py-1 bg-red-500/10 border border-red-500/20 text-red-500 dark:text-red-400 rounded text-[10px] font-bold tracking-wider font-display">V6 (MERAH)</span>
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-200 dark:divide-zinc-800/80">
                    <!-- Flavor Row -->
                    <tr class="hover:bg-zinc-50/50 dark:hover:bg-zinc-900/20 transition-colors">
                        <td class="px-6 py-4.5 font-bold uppercase text-zinc-900 dark:text-zinc-200">Flavor Extraction</td>
                        @foreach(['V1' => 4, 'V2' => 5, 'V3' => 3, 'V4' => 4, 'V5' => 5, 'V6' => 4] as $v => $val)
                        <td class="px-4 py-4.5 text-center">
                            <div class="flex justify-center gap-0.5">
                                @for($i=1; $i<=5; $i++)
                                    <svg class="h-3 w-3 {{ $i <= $val ? 'text-industrial-orange' : 'text-zinc-300 dark:text-zinc-800' }}" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                    </svg>
                                    @endfor
                            </div>
                        </td>
                        @endforeach
                    </tr>

                    <!-- Sweetness Row -->
                    <tr class="hover:bg-zinc-50/50 dark:hover:bg-zinc-900/20 transition-colors">
                        <td class="px-6 py-4.5 font-bold uppercase text-zinc-900 dark:text-zinc-200">Sweetness Lift</td>
                        @foreach(['V1' => 2, 'V2' => 3, 'V3' => 2, 'V4' => 5, 'V5' => 3, 'V6' => 4] as $v => $val)
                        <td class="px-4 py-4.5 text-center">
                            <div class="flex justify-center gap-0.5">
                                @for($i=1; $i<=5; $i++)
                                    <svg class="h-3 w-3 {{ $i <= $val ? 'text-industrial-orange' : 'text-zinc-300 dark:text-zinc-800' }}" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                    </svg>
                                    @endfor
                            </div>
                        </td>
                        @endforeach
                    </tr>

                    <!-- Throat Hit Row -->
                    <tr class="hover:bg-zinc-50/50 dark:hover:bg-zinc-900/20 transition-colors">
                        <td class="px-6 py-4.5 font-bold uppercase text-zinc-900 dark:text-zinc-200">Throat Hit</td>
                        @foreach(['V1' => 5, 'V2' => 2, 'V3' => 5, 'V4' => 3, 'V5' => 4, 'V6' => 4] as $v => $val)
                        <td class="px-4 py-4.5 text-center">
                            <div class="flex justify-center gap-0.5">
                                @for($i=1; $i<=5; $i++)
                                    <svg class="h-3 w-3 {{ $i <= $val ? 'text-industrial-orange' : 'text-zinc-300 dark:text-zinc-800' }}" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                    </svg>
                                    @endfor
                            </div>
                        </td>
                        @endforeach
                    </tr>

                    <!-- Ramp Up Row -->
                    <tr class="hover:bg-zinc-50/50 dark:hover:bg-zinc-900/20 transition-colors">
                        <td class="px-6 py-4.5 font-bold uppercase text-zinc-900 dark:text-zinc-200">Ramp Up Speed</td>
                        @foreach(['V1' => 'Instan', 'V2' => 'Sangat Cepat', 'V3' => 'Cepat', 'V4' => 'Sangat Cepat', 'V5' => 'Cepat', 'V6' => 'Cepat'] as $v => $val)
                        <td class="px-4 py-4.5 text-center">
                            <span class="px-2 py-0.5 rounded border border-zinc-200 dark:border-zinc-800 bg-zinc-100/50 dark:bg-zinc-900/50 text-slate-800 dark:text-zinc-350 font-bold uppercase text-[9px] inline-block font-display">
                                {{ $val }}
                            </span>
                        </td>
                        @endforeach
                    </tr>

                    <!-- Durability Row -->
                    <tr class="hover:bg-zinc-50/50 dark:hover:bg-zinc-900/20 transition-colors">
                        <td class="px-6 py-4.5 font-bold uppercase text-zinc-900 dark:text-zinc-200">Durability</td>
                        @foreach(['V1' => 'High', 'V2' => 'Med-High', 'V3' => 'High', 'V4' => 'Med-High', 'V5' => 'High', 'V6' => 'High'] as $v => $val)
                        <td class="px-4 py-4.5 text-center">
                            <span class="px-2 py-0.5 rounded border border-industrial-orange/20 dark:border-industrial-orange/10 bg-industrial-orange/10 text-industrial-orange font-bold uppercase text-[9px] inline-block font-display">
                                {{ $val }}
                            </span>
                        </td>
                        @endforeach
                    </tr>

                    <!-- Recommended Liquid -->
                    <tr class="hover:bg-zinc-50/50 dark:hover:bg-zinc-900/20 transition-colors">
                        <td class="px-6 py-4.5 font-bold uppercase text-zinc-900 dark:text-zinc-200">Best Liquid Match</td>
                        @foreach([
                        'V1' => 'Fruit, Menthol',
                        'V2' => 'Creamy, Sweet',
                        'V3' => 'Menthol, Fruit',
                        'V4' => 'Creamy, Sweet',
                        'V5' => 'Creamy, Fruit',
                        'V6' => 'All Liquids'
                        ] as $v => $val)
                        <td class="px-4 py-4.5 text-center">
                            <span class="text-zinc-600 dark:text-zinc-400 font-bold uppercase text-[9px]">
                                {{ $val }}
                            </span>
                        </td>
                        @endforeach
                    </tr>

                    <!-- Recommended Watt -->
                    <tr class="hover:bg-zinc-50/50 dark:hover:bg-zinc-900/20 transition-colors">
                        <td class="px-6 py-4.5 font-bold uppercase text-zinc-900 dark:text-zinc-200">Wattage Range</td>
                        @foreach([
                        'V1' => '35 - 45W',
                        'V2' => '40 - 55W',
                        'V3' => '12 - 18W',
                        'V4' => '30 - 40W',
                        'V5' => '35 - 50W',
                        'V6' => '35 - 45W'
                        ] as $v => $val)
                        <td class="px-4 py-4.5 text-center">
                            <span class="text-zinc-900 dark:text-white font-black text-[10px] tracking-wide">
                                {{ $val }}
                            </span>
                        </td>
                        @endforeach
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Mobile Accordion/Card Grid View -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 md:hidden">
            @foreach([
            ['title' => 'Extreme V1 Hitam', 'color' => 'hitam', 'flavor' => 4, 'sweetness' => 2, 'throat_hit' => 5, 'liquid' => 'Fruit, Menthol', 'watt' => '35 - 45W', 'ramp' => 'Instan', 'durability' => 'High'],
            ['title' => 'Extreme V2 Kuning', 'color' => 'kuning', 'flavor' => 5, 'sweetness' => 3, 'throat_hit' => 2, 'liquid' => 'Creamy, Sweet', 'watt' => '40 - 55W', 'ramp' => 'Sangat Cepat', 'durability' => 'Medium-High'],
            ['title' => 'Extreme V3 Pink', 'color' => 'pink', 'flavor' => 3, 'sweetness' => 2, 'throat_hit' => 5, 'liquid' => 'Menthol, Fruit', 'watt' => '12 - 18W', 'ramp' => 'Cepat', 'durability' => 'High'],
            ['title' => 'Extreme V4 Ungu', 'color' => 'ungu', 'flavor' => 4, 'sweetness' => 5, 'throat_hit' => 3, 'liquid' => 'Creamy, Sweet', 'watt' => '30 - 40W', 'ramp' => 'Sangat Cepat', 'durability' => 'Medium-High'],
            ['title' => 'Extreme V5 Putih', 'color' => 'putih', 'flavor' => 5, 'sweetness' => 3, 'throat_hit' => 4, 'liquid' => 'Creamy, Fruit', 'watt' => '35 - 50W', 'ramp' => 'Cepat', 'durability' => 'High'],
            ['title' => 'Extreme V6 Merah', 'color' => 'merah', 'flavor' => 4, 'sweetness' => 4, 'throat_hit' => 4, 'liquid' => 'All Liquids', 'watt' => '35 - 45W', 'ramp' => 'Cepat', 'durability' => 'High'],
            ] as $cItem)
            <div class="stealth-card p-5 bg-white dark:bg-zinc-950/20 border border-zinc-200 dark:border-zinc-800 rounded-xl space-y-3 font-display text-[10px] relative transition-colors duration-300">
                <!-- Color tag accent left -->
                <div class="absolute top-0 left-0 w-1 h-full rounded-l-xl
                    @if($cItem['color'] === 'hitam') bg-zinc-900 @elseif($cItem['color'] === 'kuning') bg-amber-500 @elseif($cItem['color'] === 'pink') bg-pink-500 @elseif($cItem['color'] === 'ungu') bg-purple-500 @elseif($cItem['color'] === 'putih') bg-zinc-400 @else bg-red-500 @endif">
                </div>

                <div class="flex justify-between items-center pl-2">
                    <div class="text-xs font-bold uppercase tracking-wider font-display
                        @if($cItem['color'] === 'hitam') text-zinc-900 dark:text-white @elseif($cItem['color'] === 'kuning') text-amber-500 @elseif($cItem['color'] === 'pink') text-pink-500 @elseif($cItem['color'] === 'ungu') text-purple-500 @elseif($cItem['color'] === 'putih') text-zinc-500 dark:text-zinc-300 @else text-red-500 @endif">
                        {{ $cItem['title'] }}
                    </div>
                </div>

                <div class="space-y-1.5 pt-2 pl-2">
                    <!-- Flavor -->
                    <div class="flex justify-between border-b border-zinc-100 dark:border-zinc-900 pb-1.5">
                        <span class="text-zinc-500 font-display">Flavor:</span>
                        <div class="flex gap-0.5">
                            @for($i=1; $i<=5; $i++)
                                <svg class="h-3 w-3 {{ $i <= $cItem['flavor'] ? 'text-industrial-orange' : 'text-zinc-200 dark:text-zinc-800' }}" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                @endfor
                        </div>
                    </div>
                    <!-- Sweetness -->
                    <div class="flex justify-between border-b border-zinc-100 dark:border-zinc-900 pb-1.5">
                        <span class="text-zinc-500 font-display">Sweetness:</span>
                        <div class="flex gap-0.5">
                            @for($i=1; $i<=5; $i++)
                                <svg class="h-3 w-3 {{ $i <= $cItem['sweetness'] ? 'text-industrial-orange' : 'text-zinc-200 dark:text-zinc-800' }}" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                @endfor
                        </div>
                    </div>
                    <!-- Throat Hit -->
                    <div class="flex justify-between border-b border-zinc-100 dark:border-zinc-900 pb-1.5">
                        <span class="text-zinc-500 font-display">Throat Hit:</span>
                        <div class="flex gap-0.5">
                            @for($i=1; $i<=5; $i++)
                                <svg class="h-3 w-3 {{ $i <= $cItem['throat_hit'] ? 'text-industrial-orange' : 'text-zinc-200 dark:text-zinc-800' }}" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                @endfor
                        </div>
                    </div>
                    <!-- Ramp Up -->
                    <div class="flex justify-between border-b border-zinc-100 dark:border-zinc-900 pb-1.5">
                        <span class="text-zinc-500">Ramp Up:</span>
                        <span class="text-slate-800 dark:text-zinc-200 font-bold uppercase text-[9px]">{{ $cItem['ramp'] }}</span>
                    </div>
                    <!-- Durability -->
                    <div class="flex justify-between border-b border-zinc-100 dark:border-zinc-900 pb-1.5">
                        <span class="text-zinc-500">Durability:</span>
                        <span class="text-industrial-orange font-bold uppercase text-[9px]">{{ $cItem['durability'] }}</span>
                    </div>
                    <!-- Best Liquid -->
                    <div class="flex justify-between border-b border-zinc-100 dark:border-zinc-900 pb-1.5">
                        <span class="text-zinc-500">Best Liquid:</span>
                        <span class="text-slate-850 dark:text-zinc-350 uppercase text-[9px] font-bold text-right pl-4">{{ $cItem['liquid'] }}</span>
                    </div>
                    <!-- Wattage -->
                    <div class="flex justify-between pt-1">
                        <span class="text-zinc-500">Wattage Range:</span>
                        <span class="text-slate-900 dark:text-white font-bold">{{ $cItem['watt'] }}</span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

    </div>
</section>
