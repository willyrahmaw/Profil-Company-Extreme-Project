@extends('layouts.admin')

@section('title', 'Dasbor')

@section('content')
<div class="space-y-8">

    {{-- ===== PAGE HEADER ===== --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <div class="flex items-center gap-2 mb-1">
                <span class="w-1.5 h-1.5 bg-industrial-orange rounded-full animate-pulse shadow-[0_0_6px_#FF4081]"></span>
                <span class="text-[10px] font-bold text-industrial-orange uppercase tracking-widest font-mono">SISTEM AKTIF</span>
            </div>
            <h1 class="text-2xl font-black tracking-tight text-slate-100 font-display uppercase">Dasbor Panel</h1>
            <p class="text-xs text-slate-500 mt-0.5">Ringkasan operasional dan metrik inventaris real-time.</p>
        </div>
    </div>

    {{-- ===== ACTIVE EVENT BANNER ===== --}}
    @if($activeEvent)
        <div class="p-4 bg-industrial-dark border border-industrial-orange/30 rounded-none text-slate-200 flex items-center justify-between shadow-lg relative overflow-hidden transition-colors duration-300">
            <!-- Tech accents -->
            <div class="absolute -top-px -left-px w-2 h-2 border-t border-l border-industrial-orange"></div>
            <div class="absolute -top-px -right-px w-2 h-2 border-t border-r border-industrial-orange"></div>
            <div class="absolute -bottom-px -left-px w-2 h-2 border-b border-l border-industrial-orange"></div>
            <div class="absolute -bottom-px -right-px w-2 h-2 border-b border-r border-industrial-orange"></div>
            
            <div class="flex items-center gap-3">
                <span class="w-2.5 h-2.5 bg-industrial-orange rounded-full animate-ping flex-shrink-0"></span>
                <div>
                    <p class="text-[10px] font-bold text-industrial-orange uppercase tracking-wider font-mono">[ EVENT DISKON AKTIF ]</p>
                    <h3 class="text-sm font-bold text-white uppercase mt-0.5">{{ $activeEvent->name }}</h3>
                </div>
            </div>
            <div class="flex items-center gap-4">
                <div class="text-right">
                    <p class="text-[9px] text-slate-500 uppercase tracking-widest font-mono">Diskon Global</p>
                    <p class="text-lg font-black text-industrial-orange font-display leading-none mt-0.5">{{ $activeEvent->discount_percentage }}% OFF</p>
                </div>
                <a href="{{ route('admin.events.index') }}" class="stealth-btn-secondary px-3 py-1.5 text-[9px] font-bold uppercase tracking-wider rounded-none font-mono">
                    [ Kelola ]
                </a>
            </div>
        </div>
    @endif

    {{-- ===== STATS GRID — ROW 1: Product & Shop KPIs ===== --}}
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">

        {{-- Total Produk --}}
        <a href="{{ route('admin.products.index') }}"
           class="stealth-card rounded-none p-5 relative group hover:border-industrial-orange/60 transition-all duration-200 block">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-[10px] font-bold text-slate-500 uppercase tracking-widest font-mono">Total Produk</p>
                    <p class="text-4xl font-black text-slate-100 font-display mt-2 leading-none">{{ $totalProducts }}</p>
                    <p class="text-[9px] text-slate-600 mt-1.5 font-mono uppercase tracking-wider">koleksi terdaftar</p>
                </div>
                <span class="p-2.5 bg-industrial-orange/5 border border-industrial-orange/20 text-industrial-orange group-hover:bg-industrial-orange/10 transition-colors flex-shrink-0">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                    </svg>
                </span>
            </div>
            <div class="mt-4 flex items-center gap-2">
                @if($totalProducts > 0)
                    <div class="flex-1 h-1 bg-zinc-900 rounded-full overflow-hidden">
                        <div class="h-full bg-industrial-orange rounded-full transition-all"
                             style="width: {{ $totalProducts > 0 ? min(100, ($coilsCount / $totalProducts) * 100) : 0 }}%"></div>
                    </div>
                    <span class="text-[9px] text-slate-500 font-mono">{{ $coilsCount }} coil / {{ $cottonsCount }} kapas</span>
                @endif
            </div>
        </a>

        {{-- Total Stok --}}
        <div class="stealth-card rounded-none p-5 relative group hover:border-industrial-orange/60 transition-all duration-200">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-[10px] font-bold text-slate-500 uppercase tracking-widest font-mono">Total Stok</p>
                    <p class="text-4xl font-black text-slate-100 font-display mt-2 leading-none">{{ number_format($totalStockUnits) }}</p>
                    <p class="text-[9px] text-slate-600 mt-1.5 font-mono uppercase tracking-wider">unit tersedia</p>
                </div>
                <span class="p-2.5 bg-emerald-500/5 border border-emerald-500/20 text-emerald-400 flex-shrink-0">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </span>
            </div>
            <div class="mt-4 pt-3 border-t border-zinc-800/50">
                <p class="text-[10px] text-slate-500 font-mono">
                    Nilai Inventaris: <span class="text-slate-300 font-semibold">Rp {{ number_format($totalStockValue, 0, ',', '.') }}</span>
                </p>
            </div>
        </div>

        {{-- Peringatan Stok --}}
        <div class="stealth-card rounded-none p-5 relative group transition-all duration-200
                    {{ $lowStockCount > 0 ? 'border-amber-500/30 hover:border-amber-500/50' : 'hover:border-industrial-orange/60' }}">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-[10px] font-bold text-slate-500 uppercase tracking-widest font-mono">Stok Menipis</p>
                    <p class="text-4xl font-black font-display mt-2 leading-none {{ $lowStockCount > 0 ? 'text-amber-400' : 'text-slate-100' }}">
                        {{ $lowStockCount }}
                    </p>
                    <p class="text-[9px] text-slate-600 mt-1.5 font-mono uppercase tracking-wider">produk &lt; 10 unit</p>
                </div>
                <span class="p-2.5 border flex-shrink-0 {{ $lowStockCount > 0 ? 'bg-amber-500/5 border-amber-500/20 text-amber-400' : 'bg-zinc-950 border-zinc-800 text-slate-600' }}">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                </span>
            </div>
            <div class="mt-4 pt-3 border-t border-zinc-800/50">
                <p class="text-[10px] font-mono {{ $outOfStockCount > 0 ? 'text-red-400' : 'text-slate-600' }}">
                    Habis Total: <span class="font-semibold">{{ $outOfStockCount }} produk</span>
                </p>
            </div>
        </div>

        {{-- Status Toko --}}
        <a href="{{ route('admin.shops.index') }}"
           class="stealth-card rounded-none p-5 relative group hover:border-industrial-orange/60 transition-all duration-200 block">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-[10px] font-bold text-slate-500 uppercase tracking-widest font-mono">Channel Aktif</p>
                    <p class="text-4xl font-black text-slate-100 font-display mt-2 leading-none">{{ $activeShops }}</p>
                    <p class="text-[9px] text-slate-600 mt-1.5 font-mono uppercase tracking-wider">dari {{ $totalShops }} total</p>
                </div>
                <span class="p-2.5 bg-industrial-orange/5 border border-industrial-orange/20 text-industrial-orange flex-shrink-0">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                    </svg>
                </span>
            </div>
            <div class="mt-4 pt-3 border-t border-zinc-800/50">
                @if($totalShops > 0)
                    <div class="flex items-center gap-2">
                        <div class="flex-1 h-1 bg-zinc-900 rounded-full overflow-hidden">
                            <div class="h-full bg-emerald-500 rounded-full"
                                 style="width: {{ ($activeShops / $totalShops) * 100 }}%"></div>
                        </div>
                        <span class="text-[9px] text-slate-500 font-mono">{{ round(($activeShops / $totalShops) * 100) }}% aktif</span>
                    </div>
                @else
                    <p class="text-[10px] text-slate-600 font-mono">Belum ada toko</p>
                @endif
            </div>
        </a>
    </div>

    {{-- ===== STATS GRID — ROW 2: Order Analytics KPIs ===== --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        {{-- Total Orders --}}
        <div class="stealth-card rounded-none p-5 relative group hover:border-industrial-orange/60 transition-all duration-200">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-[10px] font-bold text-slate-500 uppercase tracking-widest font-mono">Total Pesanan</p>
                    <p class="text-4xl font-black text-slate-100 font-display mt-2 leading-none">{{ $totalOrders }}</p>
                    <p class="text-[9px] text-slate-600 mt-1.5 font-mono uppercase tracking-wider">transaksi tercatat</p>
                </div>
                <span class="p-2.5 bg-blue-500/5 border border-blue-500/20 text-blue-450 flex-shrink-0">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                </span>
            </div>
        </div>

        {{-- Total Revenue --}}
        <div class="stealth-card rounded-none p-5 relative group hover:border-industrial-orange/60 transition-all duration-200">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-[10px] font-bold text-slate-500 uppercase tracking-widest font-mono">Total Pendapatan (Omzet)</p>
                    <p class="text-4xl font-black text-industrial-orange font-display mt-2 leading-none">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</p>
                    <p class="text-[9px] text-slate-600 mt-1.5 font-mono uppercase tracking-wider">estimasi nilai order</p>
                </div>
                <span class="p-2.5 bg-industrial-orange/5 border border-industrial-orange/20 text-industrial-orange flex-shrink-0">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </span>
            </div>
        </div>
    </div>

    {{-- ===== MAIN CONTENT GRID: Products Table + Shops Sidebar ===== --}}
    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

        {{-- === PRODUK TERBARU (2/3 width) === --}}
        <div class="xl:col-span-2 stealth-card rounded-none overflow-hidden">
            {{-- Header --}}
            <div class="px-6 py-4 border-b border-zinc-800 flex items-center justify-between bg-zinc-950/40">
                <div class="flex items-center gap-3">
                    <div class="w-1 h-5 bg-industrial-orange shadow-[0_0_8px_#FF4081]"></div>
                    <h2 class="text-xs font-bold text-slate-200 uppercase tracking-widest font-display">Produk Terbaru</h2>
                </div>
                <a href="{{ route('admin.products.index') }}"
                   class="text-[10px] font-bold uppercase tracking-widest text-slate-500 hover:text-industrial-orange transition-colors font-mono flex items-center gap-1">
                    Lihat Semua
                    <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>
            </div>

            {{-- Table --}}
            @if ($latestProducts->isEmpty())
                <div class="py-16 text-center px-6">
                    <svg class="mx-auto h-10 w-10 text-zinc-800 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                    </svg>
                    <p class="text-slate-500 text-xs font-semibold uppercase tracking-wider">Belum ada produk terdaftar</p>
                    <a href="{{ route('admin.products.create') }}" class="mt-4 inline-flex items-center gap-1.5 text-[10px] font-bold uppercase tracking-widest text-industrial-orange hover:text-white transition-colors">
                        <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                        Tambah Produk Pertama
                    </a>
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="text-[9px] text-slate-600 uppercase tracking-widest font-mono border-b border-zinc-900">
                                <th class="px-6 py-3 font-semibold">Produk</th>
                                <th class="px-4 py-3 font-semibold">Kat.</th>
                                <th class="px-4 py-3 font-semibold">Harga</th>
                                <th class="px-4 py-3 font-semibold">Stok</th>
                                <th class="px-4 py-3 font-semibold">Dibuat</th>
                                <th class="px-4 py-3 font-semibold text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-zinc-900/80">
                            @foreach ($latestProducts as $product)
                                <tr class="hover:bg-zinc-900/20 transition-colors group">
                                    <td class="px-6 py-3.5">
                                        <div class="font-semibold text-slate-200 text-xs group-hover:text-white transition-colors">{{ $product->title }}</div>
                                        <div class="text-[9px] text-slate-600 font-mono mt-0.5">{{ $product->slug }}</div>
                                    </td>
                                    <td class="px-4 py-3.5">
                                        <span class="inline-flex items-center px-1.5 py-0.5 text-[8px] font-bold uppercase tracking-wider font-display
                                                     {{ $product->category === 'coil' ? 'text-industrial-orange border border-industrial-orange/20 bg-industrial-orange/5' : 'text-sky-400 border border-sky-400/20 bg-sky-400/5' }}">
                                            {{ $product->category === 'coil' ? '⚡ Coil' : '🌿 Kapas' }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3.5">
                                        <span class="text-xs font-mono font-semibold text-slate-300">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                                    </td>
                                    <td class="px-4 py-3.5">
                                        @if ($product->stock === 0)
                                            <span class="inline-flex items-center gap-1 text-[9px] font-bold text-red-400 uppercase tracking-wider">
                                                <span class="w-1.5 h-1.5 bg-red-400 rounded-full"></span>Habis
                                            </span>
                                        @elseif ($product->stock < 10)
                                            <span class="inline-flex items-center gap-1 text-[9px] font-bold text-amber-400 uppercase tracking-wider">
                                                <span class="w-1.5 h-1.5 bg-amber-400 rounded-full animate-pulse"></span>{{ $product->stock }} unit
                                            </span>
                                        @else
                                            <span class="text-[9px] font-bold text-emerald-400 uppercase tracking-wider">{{ $product->stock }} unit</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3.5">
                                        <span class="text-[9px] text-slate-600 font-mono">{{ $product->created_at->format('d/m/Y') }}</span>
                                    </td>
                                    <td class="px-4 py-3.5 text-center">
                                        <a href="{{ route('admin.products.edit', $product->id) }}"
                                           class="inline-flex items-center gap-1 text-[9px] font-bold uppercase tracking-widest text-slate-500 hover:text-industrial-orange transition-colors">
                                            <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                            Edit
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                @include('admin.partials.pagination', ['paginator' => $latestProducts])

                {{-- Footer link --}}
                <div class="px-6 py-3 border-t border-zinc-900 bg-zinc-950/20">
                    <a href="{{ route('admin.products.index') }}"
                       class="text-[10px] text-slate-500 hover:text-industrial-orange transition-colors font-mono font-bold uppercase tracking-widest flex items-center gap-1">
                        Kelola semua {{ $totalProducts }} produk
                        <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                    </a>
                </div>
            @endif
        </div>

        {{-- === TOKO AKTIF SIDEBAR (1/3 width) === --}}
        <div class="stealth-card rounded-none overflow-hidden">
            {{-- Header --}}
            <div class="px-5 py-4 border-b border-zinc-800 flex items-center justify-between bg-zinc-950/40">
                <div class="flex items-center gap-3">
                    <div class="w-1 h-5 bg-emerald-400 shadow-[0_0_8px_rgba(52,211,153,0.4)]"></div>
                    <h2 class="text-xs font-bold text-slate-200 uppercase tracking-widest font-display">Channel Toko</h2>
                </div>
                <a href="{{ route('admin.shops.index') }}"
                   class="text-[10px] font-bold uppercase tracking-widest text-slate-500 hover:text-industrial-orange transition-colors font-mono flex items-center gap-1">
                    Kelola
                    <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>
            </div>

            @if($latestShops->isEmpty())
                <div class="py-12 text-center px-5">
                    <svg class="mx-auto h-8 w-8 text-zinc-800 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                    </svg>
                    <p class="text-slate-500 text-[10px] font-semibold uppercase tracking-wider">Belum ada toko</p>
                    <a href="{{ route('admin.shops.create') }}" class="mt-3 inline-flex items-center gap-1 text-[10px] font-bold text-industrial-orange hover:text-white transition-colors uppercase tracking-widest">
                        + Tambah Toko
                    </a>
                </div>
            @else
                <div class="divide-y divide-zinc-900/80">
                    @foreach($latestShops as $shop)
                        <div class="px-5 py-4 flex items-center justify-between hover:bg-zinc-900/20 transition-colors group">
                            <div class="flex items-center gap-3 min-w-0">
                                {{-- Platform Icon Badge --}}
                                @php
                                    $platformConfig = match($shop->platform) {
                                        'tiktok'    => ['bg' => 'bg-black border-zinc-700', 'text' => 'TT', 'color' => 'text-white'],
                                        'whatsapp'  => ['bg' => 'bg-emerald-950/50 border-emerald-700/30', 'text' => 'WA', 'color' => 'text-emerald-400'],
                                        'instagram' => ['bg' => 'bg-pink-950/30 border-pink-700/30', 'text' => 'IG', 'color' => 'text-pink-400'],
                                        'blibli'    => ['bg' => 'bg-blue-950/30 border-blue-700/30', 'text' => 'BB', 'color' => 'text-blue-400'],
                                        'tokopedia' => ['bg' => 'bg-green-950/30 border-green-700/30', 'text' => 'TP', 'color' => 'text-emerald-400'],
                                        'taco'      => ['bg' => 'bg-amber-950/30 border-amber-700/30', 'text' => 'TC', 'color' => 'text-amber-400'],
                                        default     => ['bg' => 'bg-zinc-900 border-zinc-700', 'text' => '??', 'color' => 'text-slate-400'],
                                    };
                                @endphp
                                <span class="w-8 h-8 rounded border flex items-center justify-center text-[9px] font-black font-mono flex-shrink-0 {{ $platformConfig['bg'] }} {{ $platformConfig['color'] }}">
                                    {{ $platformConfig['text'] }}
                                </span>
                                <div class="min-w-0">
                                    <p class="text-xs font-semibold text-slate-200 group-hover:text-white transition-colors truncate">{{ $shop->name }}</p>
                                    <p class="text-[9px] text-slate-600 font-mono uppercase tracking-wider">{{ ucfirst($shop->platform) }}</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-2 flex-shrink-0">
                                @if($shop->is_active)
                                    <span class="w-1.5 h-1.5 bg-emerald-400 rounded-full shadow-[0_0_4px_#34d399]"></span>
                                @else
                                    <span class="w-1.5 h-1.5 bg-zinc-700 rounded-full"></span>
                                @endif
                                <a href="{{ route('admin.shops.edit', $shop->id) }}"
                                   class="text-zinc-700 hover:text-industrial-orange transition-colors">
                                    <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Footer --}}
                <div class="px-5 py-3 border-t border-zinc-900 bg-zinc-950/20">
                    <a href="{{ route('admin.shops.create') }}"
                       class="text-[10px] text-slate-500 hover:text-industrial-orange transition-colors font-mono font-bold uppercase tracking-widest flex items-center gap-1">
                        <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                        Tambah Channel Baru
                    </a>
                </div>
            @endif
        </div>
    </div>

    {{-- ===== ORDERS & ANALYTICS GRID ===== --}}
    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">
        {{-- === LOG ORDER TERBARU (2/3 width) === --}}
        <div class="xl:col-span-2 stealth-card rounded-none overflow-hidden">
            <div class="px-6 py-4 border-b border-zinc-800 flex items-center justify-between bg-zinc-950/40">
                <div class="flex items-center gap-3">
                    <div class="w-1 h-5 bg-blue-500 shadow-[0_0_8px_rgba(59,130,246,0.5)]"></div>
                    <h2 class="text-xs font-bold text-slate-200 uppercase tracking-widest font-display">Log Pesanan Masuk (WhatsApp Clicks)</h2>
                </div>
            </div>

            @if ($recentOrders->isEmpty())
                <div class="py-16 text-center px-6">
                    <svg class="mx-auto h-10 w-10 text-zinc-800 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                    </svg>
                    <p class="text-slate-500 text-xs font-semibold uppercase tracking-wider">Belum ada pesanan masuk</p>
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="text-[9px] text-slate-600 uppercase tracking-widest font-mono border-b border-zinc-900">
                                <th class="px-6 py-3 font-semibold">Nama Pembeli</th>
                                <th class="px-4 py-3 font-semibold">Alamat Pengiriman</th>
                                <th class="px-4 py-3 font-semibold">Daftar Produk &amp; Qty</th>
                                <th class="px-4 py-3 font-semibold text-right">Total</th>
                                <th class="px-6 py-3 font-semibold text-right">Waktu</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-zinc-900/80 text-[11px] text-slate-350 font-mono">
                            @foreach ($recentOrders as $order)
                                <tr class="hover:bg-zinc-900/20 transition-colors">
                                    <td class="px-6 py-3.5 font-sans font-bold text-slate-200">
                                        {{ $order->buyer_name }}
                                    </td>
                                    <td class="px-4 py-3.5 max-w-[150px] truncate" title="{{ $order->buyer_address }}">
                                        {{ $order->buyer_address }}
                                    </td>
                                    <td class="px-4 py-3.5 font-sans text-xs text-slate-350">
                                        <div class="space-y-1">
                                            @foreach($order->items as $item)
                                                <div class="flex items-center gap-1.5">
                                                    <span class="w-1 h-1 bg-industrial-orange rounded-full flex-shrink-0 animate-pulse"></span>
                                                    <span class="text-slate-200 font-semibold truncate max-w-[160px]" title="{{ $item->product_title }}">{{ $item->product_title }}</span>
                                                    <span class="text-slate-500 text-[10px]">({{ $item->quantity }}x)</span>
                                                </div>
                                            @endforeach
                                        </div>
                                    </td>
                                    <td class="px-4 py-3.5 text-right font-bold text-industrial-orange">
                                        Rp {{ number_format($order->total_price, 0, ',', '.') }}
                                    </td>
                                    <td class="px-6 py-3.5 text-right text-slate-500 text-[10px]" title="{{ $order->created_at }}">
                                        {{ $order->created_at->diffForHumans() }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>

        {{-- === PRODUK PALING POPULER (1/3 width) === --}}
        <div class="stealth-card rounded-none overflow-hidden">
            <div class="px-5 py-4 border-b border-zinc-800 flex items-center justify-between bg-zinc-950/40">
                <div class="flex items-center gap-3">
                    <div class="w-1 h-5 bg-industrial-orange shadow-[0_0_8px_#FF4081]"></div>
                    <h2 class="text-xs font-bold text-slate-200 uppercase tracking-widest font-display">Produk Terlaris</h2>
                </div>
            </div>

            @if($topProducts->isEmpty())
                <div class="py-12 text-center px-5">
                    <svg class="mx-auto h-8 w-8 text-zinc-800 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                    </svg>
                    <p class="text-slate-500 text-[10px] font-semibold uppercase tracking-wider">Belum ada statistik produk</p>
                </div>
            @else
                <div class="divide-y divide-zinc-900/80">
                    @foreach($topProducts as $item)
                        <div class="px-5 py-4 flex items-center justify-between hover:bg-zinc-900/20 transition-colors group">
                            <div class="min-w-0">
                                <p class="text-xs font-bold text-slate-200 group-hover:text-white transition-colors truncate">{{ $item->product_title }}</p>
                                <p class="text-[9px] text-slate-500 font-mono mt-0.5">{{ $item->total_qty }} unit terjual</p>
                            </div>
                            <div class="text-right flex-shrink-0">
                                <p class="text-xs font-bold text-industrial-orange font-mono">Rp {{ number_format($item->total_revenue, 0, ',', '.') }}</p>
                                <p class="text-[8px] text-slate-600 uppercase font-mono tracking-widest">total omzet</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

    {{-- ===== QUICK ACTION STRIP ===== --}}
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        <a href="{{ route('admin.products.create') }}"
           class="flex items-center gap-4 p-4 bg-industrial-dark border border-industrial-border hover:border-industrial-orange/40 rounded-none transition-all group">
            <span class="p-3 bg-industrial-orange/5 border border-industrial-orange/20 text-industrial-orange group-hover:bg-industrial-orange/10 transition-colors">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4v16m8-8H4"/>
                </svg>
            </span>
            <div>
                <p class="text-xs font-bold text-slate-200 group-hover:text-white transition-colors uppercase tracking-wide font-display">Tambah Produk</p>
                <p class="text-[9px] text-slate-600 mt-0.5">Daftarkan coil atau kapas baru</p>
            </div>
            <svg class="h-4 w-4 text-slate-700 group-hover:text-industrial-orange ml-auto transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        </a>

        <a href="{{ route('admin.shops.create') }}"
           class="flex items-center gap-4 p-4 bg-industrial-dark border border-industrial-border hover:border-industrial-orange/40 rounded-none transition-all group">
            <span class="p-3 bg-industrial-orange/5 border border-industrial-orange/20 text-industrial-orange group-hover:bg-industrial-orange/10 transition-colors">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                </svg>
            </span>
            <div>
                <p class="text-xs font-bold text-slate-200 group-hover:text-white transition-colors uppercase tracking-wide font-display">Tambah Toko</p>
                <p class="text-[9px] text-slate-600 mt-0.5">Daftarkan channel baru</p>
            </div>
            <svg class="h-4 w-4 text-slate-700 group-hover:text-industrial-orange ml-auto transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        </a>

        <a href="{{ route('home') }}" target="_blank"
           class="flex items-center gap-4 p-4 bg-industrial-dark border border-industrial-border hover:border-industrial-orange/40 rounded-none transition-all group">
            <span class="p-3 bg-industrial-orange/5 border border-industrial-orange/20 text-industrial-orange group-hover:bg-industrial-orange/10 transition-colors">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                </svg>
            </span>
            <div>
                <p class="text-xs font-bold text-slate-200 group-hover:text-white transition-colors uppercase tracking-wide font-display">Lihat Situs</p>
                <p class="text-[9px] text-slate-600 mt-0.5">Buka halaman publik</p>
            </div>
            <svg class="h-4 w-4 text-slate-700 group-hover:text-industrial-orange ml-auto transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        </a>
    </div>

</div>
@endsection
