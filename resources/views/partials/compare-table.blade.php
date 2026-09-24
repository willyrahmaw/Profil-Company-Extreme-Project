@php
$starPath = 'M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z';

// Colour accents keyed by the colour word in the product title (e.g. "Extreme V2 Kuning").
$variantColors = [
    'hitam'  => ['badge' => 'bg-zinc-950 border-zinc-800 text-zinc-100 dark:bg-zinc-900 dark:border-zinc-800 dark:text-white', 'bar' => 'bg-zinc-900', 'text' => 'text-zinc-900 dark:text-white'],
    'kuning' => ['badge' => 'bg-amber-500/10 border-amber-500/20 text-amber-500 dark:text-amber-400', 'bar' => 'bg-amber-500', 'text' => 'text-amber-500'],
    'pink'   => ['badge' => 'bg-pink-500/10 border-pink-500/20 text-pink-500 dark:text-pink-400', 'bar' => 'bg-pink-500', 'text' => 'text-pink-500'],
    'ungu'   => ['badge' => 'bg-purple-500/10 border-purple-500/20 text-purple-500 dark:text-purple-400', 'bar' => 'bg-purple-500', 'text' => 'text-purple-500'],
    'putih'  => ['badge' => 'bg-zinc-200/50 dark:bg-zinc-800/30 border-zinc-300 dark:border-zinc-700 text-zinc-800 dark:text-zinc-300', 'bar' => 'bg-zinc-400', 'text' => 'text-zinc-500 dark:text-zinc-300'],
    'merah'  => ['badge' => 'bg-red-500/10 border-red-500/20 text-red-500 dark:text-red-400', 'bar' => 'bg-red-500', 'text' => 'text-red-500'],
];
$defaultColor = ['badge' => 'bg-industrial-orange/10 border-industrial-orange/20 text-industrial-orange', 'bar' => 'bg-industrial-orange', 'text' => 'text-industrial-orange'];

$compareCoils = $coils
    ->sortBy(fn($p) => $p->specifications['version'] ?? $p->title, SORT_NATURAL | SORT_FLAG_CASE)
    ->values()
    ->map(function ($p) use ($variantColors, $defaultColor) {
        $spec = $p->specifications ?? [];

        $color = $defaultColor;
        foreach ($variantColors as $word => $classes) {
            if (str_contains(strtolower($p->title), $word)) {
                $color = $classes;
                break;
            }
        }

        $resistance = collect([
            !empty($spec['resistance_single']) ? 'S ' . $spec['resistance_single'] . ' Ω' : null,
            !empty($spec['resistance_dual']) ? 'D ' . $spec['resistance_dual'] . ' Ω' : null,
        ])->filter()->implode(' / ') ?: ($spec['resistance'] ?? null);

        return [
            'label'      => !empty($spec['version']) ? strtoupper($spec['version']) : $p->title,
            'title'      => $p->title,
            'color'      => $color,
            'flavor'     => (int) ($spec['flavor'] ?? 0),
            'sweetness'  => (int) ($spec['sweetness'] ?? 0),
            'throat_hit' => (int) ($spec['throat_hit'] ?? 0),
            'durability' => !empty($spec['durability']) ? explode(' (', $spec['durability'])[0] : null,
            'liquid'     => !empty($spec['recommended_liquid']) ? implode(', ', (array) $spec['recommended_liquid']) : null,
            'watt'       => $spec['recommended_watt'] ?? null,
            'resistance' => $resistance,
            'material'   => $spec['material'] ?? null,
        ];
    });

$ratingRows = ['flavor' => 'Flavor Extraction', 'sweetness' => 'Sweetness Lift', 'throat_hit' => 'Throat Hit'];
@endphp

@if($compareCoils->isNotEmpty())
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
        <div class="hidden md:block overflow-x-auto border border-zinc-200 dark:border-zinc-800 rounded-2xl bg-white dark:bg-zinc-950/20 backdrop-blur-md shadow-md">
            <table class="w-full text-left font-display text-[10px] text-zinc-700 dark:text-zinc-300 border-collapse">
                <thead>
                    <tr class="bg-zinc-50 dark:bg-zinc-900/40 text-zinc-555 dark:text-zinc-500 uppercase tracking-wider border-b border-zinc-200 dark:border-zinc-800/80">
                        <th class="px-6 py-5 font-bold text-xs uppercase font-display text-zinc-800 dark:text-zinc-200">Spesifikasi / Varian</th>
                        @foreach($compareCoils as $c)
                        <th class="px-4 py-5 text-center">
                            <span class="inline-flex items-center px-2.5 py-1 border {{ $c['color']['badge'] }} rounded text-[10px] font-bold tracking-wider font-display" title="{{ $c['title'] }}">{{ $c['label'] }}</span>
                        </th>
                        @endforeach
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-200 dark:divide-zinc-800/80">
                    @foreach($ratingRows as $key => $rowLabel)
                    <tr class="hover:bg-zinc-50/50 dark:hover:bg-zinc-900/20 transition-colors">
                        <td class="px-6 py-4.5 font-bold uppercase text-zinc-900 dark:text-zinc-200">{{ $rowLabel }}</td>
                        @foreach($compareCoils as $c)
                        <td class="px-4 py-4.5 text-center">
                            <div class="flex justify-center gap-0.5">
                                @for($i=1; $i<=5; $i++)
                                    <svg class="h-3 w-3 {{ $i <= $c[$key] ? 'text-industrial-orange' : 'text-zinc-300 dark:text-zinc-800' }}" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="{{ $starPath }}" />
                                    </svg>
                                    @endfor
                            </div>
                        </td>
                        @endforeach
                    </tr>
                    @endforeach

                    <!-- Durability Row -->
                    <tr class="hover:bg-zinc-50/50 dark:hover:bg-zinc-900/20 transition-colors">
                        <td class="px-6 py-4.5 font-bold uppercase text-zinc-900 dark:text-zinc-200">Durability</td>
                        @foreach($compareCoils as $c)
                        <td class="px-4 py-4.5 text-center">
                            @if($c['durability'])
                            <span class="px-2 py-0.5 rounded border border-industrial-orange/20 dark:border-industrial-orange/10 bg-industrial-orange/10 text-industrial-orange font-bold uppercase text-[9px] inline-block font-display">
                                {{ $c['durability'] }}
                            </span>
                            @else
                            <span class="text-zinc-400 dark:text-zinc-600">—</span>
                            @endif
                        </td>
                        @endforeach
                    </tr>

                    <!-- Recommended Liquid -->
                    <tr class="hover:bg-zinc-50/50 dark:hover:bg-zinc-900/20 transition-colors">
                        <td class="px-6 py-4.5 font-bold uppercase text-zinc-900 dark:text-zinc-200">Best Liquid Match</td>
                        @foreach($compareCoils as $c)
                        <td class="px-4 py-4.5 text-center">
                            <span class="text-zinc-600 dark:text-zinc-400 font-bold uppercase text-[9px]">
                                {{ $c['liquid'] ?? '—' }}
                            </span>
                        </td>
                        @endforeach
                    </tr>

                    <!-- Recommended Watt -->
                    <tr class="hover:bg-zinc-50/50 dark:hover:bg-zinc-900/20 transition-colors">
                        <td class="px-6 py-4.5 font-bold uppercase text-zinc-900 dark:text-zinc-200">Wattage Range</td>
                        @foreach($compareCoils as $c)
                        <td class="px-4 py-4.5 text-center">
                            <span class="text-zinc-900 dark:text-white font-black text-[10px] tracking-wide">
                                {{ $c['watt'] ?? '—' }}
                            </span>
                        </td>
                        @endforeach
                    </tr>

                    <!-- Resistance -->
                    <tr class="hover:bg-zinc-50/50 dark:hover:bg-zinc-900/20 transition-colors">
                        <td class="px-6 py-4.5 font-bold uppercase text-zinc-900 dark:text-zinc-200">Resistance</td>
                        @foreach($compareCoils as $c)
                        <td class="px-4 py-4.5 text-center">
                            <span class="text-zinc-600 dark:text-zinc-400 font-bold text-[9px]">
                                {{ $c['resistance'] ?? '—' }}
                            </span>
                        </td>
                        @endforeach
                    </tr>

                    <!-- Material -->
                    <tr class="hover:bg-zinc-50/50 dark:hover:bg-zinc-900/20 transition-colors">
                        <td class="px-6 py-4.5 font-bold uppercase text-zinc-900 dark:text-zinc-200">Material</td>
                        @foreach($compareCoils as $c)
                        <td class="px-4 py-4.5 text-center">
                            <span class="text-zinc-600 dark:text-zinc-400 font-bold uppercase text-[9px]">
                                {{ $c['material'] ?? '—' }}
                            </span>
                        </td>
                        @endforeach
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Mobile Accordion/Card Grid View -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 md:hidden">
            @foreach($compareCoils as $c)
            <div class="stealth-card p-5 bg-white dark:bg-zinc-950/20 border border-zinc-200 dark:border-zinc-800 rounded-xl space-y-3 font-display text-[10px] relative transition-colors duration-300">
                <!-- Color tag accent left -->
                <div class="absolute top-0 left-0 w-1 h-full rounded-l-xl {{ $c['color']['bar'] }}"></div>

                <div class="flex justify-between items-center pl-2">
                    <div class="text-xs font-bold uppercase tracking-wider font-display {{ $c['color']['text'] }}">
                        {{ $c['title'] }}
                    </div>
                </div>

                <div class="space-y-1.5 pt-2 pl-2">
                    @foreach(['flavor' => 'Flavor', 'sweetness' => 'Sweetness', 'throat_hit' => 'Throat Hit'] as $key => $rowLabel)
                    <div class="flex justify-between border-b border-zinc-100 dark:border-zinc-900 pb-1.5">
                        <span class="text-zinc-500 font-display">{{ $rowLabel }}:</span>
                        <div class="flex gap-0.5">
                            @for($i=1; $i<=5; $i++)
                                <svg class="h-3 w-3 {{ $i <= $c[$key] ? 'text-industrial-orange' : 'text-zinc-200 dark:text-zinc-800' }}" fill="currentColor" viewBox="0 0 20 20">
                                <path d="{{ $starPath }}" />
                                </svg>
                                @endfor
                        </div>
                    </div>
                    @endforeach
                    <!-- Durability -->
                    <div class="flex justify-between border-b border-zinc-100 dark:border-zinc-900 pb-1.5">
                        <span class="text-zinc-500">Durability:</span>
                        <span class="text-industrial-orange font-bold uppercase text-[9px]">{{ $c['durability'] ?? '—' }}</span>
                    </div>
                    <!-- Best Liquid -->
                    <div class="flex justify-between border-b border-zinc-100 dark:border-zinc-900 pb-1.5">
                        <span class="text-zinc-500">Best Liquid:</span>
                        <span class="text-slate-850 dark:text-zinc-350 uppercase text-[9px] font-bold text-right pl-4">{{ $c['liquid'] ?? '—' }}</span>
                    </div>
                    <!-- Resistance -->
                    <div class="flex justify-between border-b border-zinc-100 dark:border-zinc-900 pb-1.5">
                        <span class="text-zinc-500">Resistance:</span>
                        <span class="text-slate-850 dark:text-zinc-350 text-[9px] font-bold text-right pl-4">{{ $c['resistance'] ?? '—' }}</span>
                    </div>
                    <!-- Material -->
                    <div class="flex justify-between border-b border-zinc-100 dark:border-zinc-900 pb-1.5">
                        <span class="text-zinc-500">Material:</span>
                        <span class="text-slate-850 dark:text-zinc-350 uppercase text-[9px] font-bold text-right pl-4">{{ $c['material'] ?? '—' }}</span>
                    </div>
                    <!-- Wattage -->
                    <div class="flex justify-between pt-1">
                        <span class="text-zinc-500">Wattage Range:</span>
                        <span class="text-slate-900 dark:text-white font-bold">{{ $c['watt'] ?? '—' }}</span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

    </div>
</section>
@endif
