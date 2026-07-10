@extends('layouts.admin')

@section('title', 'Kelola Produk')

@section('content')
<div class="space-y-8" x-data="{ 
    activeDeleteId: null,
    async updateStock(id, newStock) {
        if (newStock === '' || isNaN(newStock) || newStock < 0) return null;
        try {
            let response = await fetch('/admin/products/' + id + '/stock', {
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ stock: newStock })
            });
            if (response.ok) {
                let data = await response.json();
                return data.stock;
            }
        } catch(e) {
            console.error(e);
        }
        return null;
    }
}">
    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold tracking-tight text-slate-100 font-display">KELOLA PRODUK</h1>
            <p class="text-xs text-slate-400">Tambah, ubah, atau hapus produk dari stok etalase toko.</p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.products.create') }}" 
               class="stealth-btn-primary px-5 py-3 text-xs uppercase font-bold tracking-widest rounded-none">
                [ + TAMBAH PRODUK BARU ]
            </a>
        </div>
    </div>

    <!-- Products Table -->
    <div class="stealth-card rounded-none overflow-hidden relative">
        <div class="overflow-x-auto">
            @if ($products->isEmpty())
                <div class="py-16 text-center">
                    <svg class="mx-auto h-12 w-12 text-slate-700 animate-pulse" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                    </svg>
                    <h3 class="mt-4 text-slate-350 font-bold uppercase tracking-wider text-xs font-display">Belum Ada Produk Terdaftar</h3>
                    <p class="mt-1 text-slate-500 text-xs">Buat produk pertama untuk mengisi etalase toko.</p>
                    <a href="{{ route('admin.products.create') }}" class="mt-6 inline-flex items-center px-4 py-2 border border-industrial-orange text-xs font-bold uppercase tracking-widest rounded-none text-industrial-orange hover:bg-industrial-orange hover:text-white transition-all font-mono">
                        [ BUAT PRODUK PERTAMA ]
                    </a>
                </div>
            @else
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-zinc-950/80 border-b border-zinc-800 text-slate-400 text-[10px] uppercase tracking-widest font-mono">
                            <th class="py-4 px-6">Detail Produk</th>
                            <th class="py-4 px-6">Kategori</th>
                            <th class="py-4 px-6">Harga</th>
                            <th class="py-4 px-6">Status Inventaris</th>
                            <th class="py-4 px-6 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-zinc-800/50 text-xs text-slate-300">
                        @foreach ($products as $product)
                            <tr class="hover:bg-zinc-900/30 transition-colors">
                                <td class="py-4 px-6">
                                    <div class="flex items-center gap-3">
                                        {{-- Thumbnail --}}
                                        <div class="w-10 h-10 bg-black border border-zinc-800 flex items-center justify-center flex-shrink-0 overflow-hidden">
                                            @if($product->image_path)
                                                <img src="{{ $product->image_path }}" alt="Thumb" class="h-full w-full object-contain">
                                            @else
                                                <span class="text-[8px] font-mono text-zinc-650">N/A</span>
                                            @endif
                                        </div>
                                        <div>
                                            <div class="font-semibold text-slate-200 text-sm">{{ $product->title }}</div>
                                            <div class="text-[9px] text-slate-500 font-mono mt-0.5">{{ $product->slug }}</div>
                                            @if($product->category === 'coil' && !empty($product->specifications))
                                                <div class="flex flex-wrap gap-1.5 mt-2">
                                                    @if(!empty($product->specifications['diameter']))
                                                        <span class="px-1.5 py-0.5 text-[8px] font-mono bg-zinc-950 border border-zinc-850 text-slate-400" title="Diameter">Diameter: {{ $product->specifications['diameter'] }}</span>
                                                    @endif
                                                    @if(!empty($product->specifications['resistance']))
                                                        <span class="px-1.5 py-0.5 text-[8px] font-mono bg-zinc-950 border border-zinc-850 text-slate-400" title="Ohm/Resistance">Ohm: {{ $product->specifications['resistance'] }}</span>
                                                    @endif
                                                    @if(!empty($product->specifications['wrap']))
                                                        <span class="px-1.5 py-0.5 text-[8px] font-mono bg-zinc-950 border border-zinc-850 text-slate-400" title="Lilitan/Wraps">Lilitan: {{ $product->specifications['wrap'] }}</span>
                                                    @endif
                                                    @if(!empty($product->specifications['material']))
                                                        <span class="px-1.5 py-0.5 text-[8px] font-mono bg-zinc-950 border border-zinc-850 text-slate-400" title="Material/Bahan">Bahan: {{ $product->specifications['material'] }}</span>
                                                    @endif
                                                    @if(!empty($product->specifications['durability']))
                                                        <span class="px-1.5 py-0.5 text-[8px] font-mono bg-zinc-950 border border-zinc-850 text-slate-400" title="Ketahanan/Durability">Ketahanan: {{ $product->specifications['durability'] }}</span>
                                                    @endif
                                                </div>
                                            @elseif($product->category === 'cotton' && !empty($product->specifications['items']))
                                                <div class="flex flex-wrap gap-1.5 mt-2">
                                                    @foreach($product->specifications['items'] as $item)
                                                        <span class="px-1.5 py-0.5 text-[8px] font-mono bg-zinc-950 border border-zinc-850 text-slate-400" title="Fitur Kapas">{{ $item }}</span>
                                                    @endforeach
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td class="py-4 px-6">
                                    @if ($product->category === 'coil')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-none text-[8px] font-bold tracking-widest bg-black border border-industrial-orange/20 text-industrial-orange uppercase font-display">
                                            Coil
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-none text-[8px] font-bold tracking-widest bg-black border border-industrial-orange/20 text-industrial-orange uppercase font-display">
                                            Kapas
                                        </span>
                                    @endif
                                </td>
                                <td class="py-4 px-6 font-mono font-semibold text-slate-200">
                                    Rp {{ number_format($product->price, 0, ',', '.') }}
                                </td>
                                <td class="py-4 px-6 text-slate-350" x-data="{ stock: {{ $product->stock }} }">
                                    <div class="flex items-center gap-1.5 bg-black/40 border border-zinc-800 p-1 w-fit rounded">
                                        <button type="button" 
                                                @click="updateStock({{ $product->id }}, stock - 1).then(res => { if(res !== null) stock = res })" 
                                                class="w-5 h-5 bg-zinc-950 hover:bg-zinc-900 border border-zinc-800 text-slate-400 hover:text-industrial-orange flex items-center justify-center font-bold font-mono rounded transition-colors disabled:opacity-40"
                                                :disabled="stock <= 0">
                                            -
                                        </button>
                                        <input type="number" 
                                               x-model.number="stock" 
                                               @change="updateStock({{ $product->id }}, stock).then(res => { if(res !== null) stock = res })"
                                               class="w-9 bg-transparent text-center font-mono text-xs text-slate-100 font-bold focus:outline-none [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none">
                                        <button type="button" 
                                                @click="updateStock({{ $product->id }}, stock + 1).then(res => { if(res !== null) stock = res })" 
                                                class="w-5 h-5 bg-zinc-950 hover:bg-zinc-900 border border-zinc-800 text-slate-400 hover:text-industrial-orange flex items-center justify-center font-bold font-mono rounded transition-colors">
                                            +
                                        </button>
                                    </div>
                                </td>
                                <td class="py-4 px-6 text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        <!-- Edit Link -->
                                        <a href="{{ route('admin.products.edit', $product->id) }}" 
                                           class="p-2 rounded bg-black hover:bg-zinc-900 border border-zinc-800 hover:border-industrial-orange text-slate-400 hover:text-industrial-orange transition-all"
                                           title="Ubah Produk">
                                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                            </svg>
                                        </a>

                                        <!-- Delete Button -->
                                        <button type="button" 
                                                @click="activeDeleteId = {{ $product->id }}"
                                                class="p-2 rounded bg-black hover:bg-zinc-900 border border-zinc-800 hover:border-red-500/45 text-slate-400 hover:text-red-400 transition-all"
                                                title="Hapus Produk">
                                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
        @include('admin.partials.pagination', ['paginator' => $products])
    </div>

    <!-- Delete Confirmation Modal -->
    <div x-show="activeDeleteId !== null" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/90 backdrop-blur-sm" style="display: none;">
        <div class="bg-zinc-950 border border-zinc-800 rounded-none p-6 max-w-sm w-full shadow-2xl relative" @click.away="activeDeleteId = null">
            
            <div class="text-center">
                <h3 class="text-sm font-bold tracking-wider text-slate-200 uppercase font-display">Konfirmasi Hapus</h3>
                <p class="text-xs text-slate-400 mt-3 leading-relaxed">Apakah Anda yakin ingin menghapus produk ini secara permanen? Tindakan ini tidak dapat dibatalkan.</p>
            </div>
            
            <div class="flex items-center gap-3 mt-6">
                <button type="button" @click="activeDeleteId = null" 
                        class="flex-1 py-2 text-xs font-bold uppercase tracking-widest text-slate-450 hover:text-zinc-200 bg-zinc-900 border border-zinc-800 rounded-none transition-all">
                    Batal
                </button>
                <!-- Form submission -->
                <form :action="'{{ url('admin/products') }}/' + activeDeleteId" method="POST" class="flex-1">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            class="w-full py-2 text-xs font-bold uppercase tracking-widest text-white bg-red-600 hover:bg-red-700 rounded-none transition-all">
                        Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
