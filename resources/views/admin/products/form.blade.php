@extends('layouts.admin')

@section('title', $isEdit ? 'Edit Produk' : 'Tambah Produk')

@section('content')
<div class="max-w-3xl mx-auto space-y-8"
    x-data="{
         category: '{{ old('category', $product->category ?? 'coil') }}',
         specs: {
             flavor: {{ (int) old('specifications.flavor', $product->specifications['flavor'] ?? 3) }},
             sweetness: {{ (int) old('specifications.sweetness', $product->specifications['sweetness'] ?? 3) }},
             throat_hit: {{ (int) old('specifications.throat_hit', $product->specifications['throat_hit'] ?? 3) }},
             clean_flavor_delivery: {{ old('specifications.clean_flavor_delivery', $product->specifications['clean_flavor_delivery'] ?? false) ? 'true' : 'false' }},
             fast_liquid_absorption: {{ old('specifications.fast_liquid_absorption', $product->specifications['fast_liquid_absorption'] ?? false) ? 'true' : 'false' }},
             premium_organic_fiber: {{ old('specifications.premium_organic_fiber', $product->specifications['premium_organic_fiber'] ?? false) ? 'true' : 'false' }}
         }
     }">

    {{-- Breadcrumb --}}
    <div class="flex items-center gap-2 text-[10px] font-semibold text-slate-500 uppercase tracking-widest">
        <a href="{{ route('admin.products.index') }}" class="hover:text-industrial-orange transition-colors">Produk</a>
        <svg class="h-3 w-3 text-slate-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
        </svg>
        <span class="text-slate-400">{{ $isEdit ? 'Edit Produk' : 'Tambah Produk Baru' }}</span>
    </div>

    {{-- Page Heading --}}
    <div>
        <h1 class="text-2xl font-bold tracking-tight text-slate-100 font-display">
            {{ $isEdit ? 'UBAH DATA PRODUK' : 'BUAT PRODUK BARU' }}
        </h1>
        <p class="text-xs text-slate-500 mt-1">
            {{ $isEdit ? 'Perbarui detail parameter produk dalam katalog toko.' : 'Isi semua field di bawah untuk menambahkan produk ke katalog.' }}
        </p>
    </div>

    {{-- Form --}}
    <form action="{{ $isEdit ? route('admin.products.update', $product->id) : route('admin.products.store') }}"
        method="POST"
        enctype="multipart/form-data"
        onsubmit="return confirm('Apakah Anda yakin ingin menyimpan data produk ini?');"
        class="space-y-6">
        @csrf
        @if($isEdit)
        @method('PUT')
        @endif

        {{-- ===== SECTION 1: KATEGORI ===== --}}
        <div class="bg-industrial-dark border border-industrial-border rounded-none p-6 sm:p-8 shadow-xl space-y-5">
            <div class="flex items-center gap-3 border-b border-industrial-border/50 pb-4">
                <div class="w-5 h-5 rounded-none bg-industrial-orange/10 border border-industrial-orange/30 flex items-center justify-center flex-shrink-0">
                    <span class="text-industrial-orange font-bold text-[10px] font-display">1</span>
                </div>
                <h2 class="text-xs font-bold text-slate-300 uppercase tracking-widest font-display">Kategori Produk</h2>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <label class="relative flex flex-col items-center justify-center p-5 border rounded-none cursor-pointer transition-all duration-200"
                    :class="category === 'coil' ? 'bg-industrial-orange/5 border-industrial-orange text-industrial-orange shadow-[inset_0_0_20px_rgba(255,85,0,0.04)]' : 'bg-black border-industrial-border text-slate-500 hover:border-slate-600'">
                    <input type="radio" name="category" value="coil" x-model="category" class="sr-only">
                    <svg class="h-6 w-6 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                    <span class="text-xs font-bold uppercase tracking-wider font-display">Koleksi Coil</span>
                    <span class="text-[9px] mt-1 opacity-60">Coil handmade premium</span>
                </label>

                <label class="relative flex flex-col items-center justify-center p-5 border rounded-none cursor-pointer transition-all duration-200"
                    :class="category === 'cotton' ? 'bg-industrial-orange/5 border-industrial-orange text-industrial-orange shadow-[inset_0_0_20px_rgba(255,85,0,0.04)]' : 'bg-black border-industrial-border text-slate-500 hover:border-slate-600'">
                    <input type="radio" name="category" value="cotton" x-model="category" class="sr-only">
                    <svg class="h-6 w-6 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064" />
                    </svg>
                    <span class="text-xs font-bold uppercase tracking-wider font-display">Koleksi Kapas</span>
                    <span class="text-[9px] mt-1 opacity-60">Kapas wicking organik</span>
                </label>
            </div>
            @error('category')
            <p class="text-xs text-red-400 font-semibold flex items-center gap-1.5">
                <svg class="h-3.5 w-3.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
                {{ $message }}
            </p>
            @enderror
        </div>

        {{-- ===== SECTION 2: INFO DASAR ===== --}}
        <div class="bg-industrial-dark border border-industrial-border rounded-none p-6 sm:p-8 shadow-xl space-y-5">
            <div class="flex items-center gap-3 border-b border-industrial-border/50 pb-4">
                <div class="w-5 h-5 rounded-none bg-industrial-orange/10 border border-industrial-orange/30 flex items-center justify-center flex-shrink-0">
                    <span class="text-industrial-orange font-bold text-[10px] font-display">2</span>
                </div>
                <h2 class="text-xs font-bold text-slate-300 uppercase tracking-widest font-display">Informasi Produk</h2>
            </div>
            {{-- Version --}}
            <div>
                <label for="spec_version" class="block text-[10px] font-bold text-slate-455 uppercase tracking-wider mb-1.5">
                    Versi (e.g. V1, V2, dll.)
                </label>
                <input type="text" id="spec_version" name="specifications[version]"
                    value="{{ old('specifications.version', $product->specifications['version'] ?? '') }}"
                    class="block w-full rounded bg-black border border-zinc-800 text-slate-100 px-3 py-2 text-xs focus:outline-none focus:ring-1 focus:ring-industrial-orange focus:border-transparent transition-all placeholder-slate-700 font-semibold"
                    placeholder="e.g. V1">
            </div>
            {{-- Nama Produk --}}
            <div>
                <label for="title" class="block text-[10px] font-bold text-slate-450 uppercase tracking-wider mb-1.5">
                    Nama Produk <span class="text-red-400">*</span>
                </label>
                <input type="text" id="title" name="title" required
                    value="{{ old('title', $product->title) }}"
                    class="block w-full rounded bg-black border border-industrial-border text-slate-100 px-4 py-3 text-sm focus:outline-none focus:ring-1 focus:ring-industrial-orange focus:border-transparent transition-all placeholder-slate-700 font-semibold"
                    placeholder="e.g. Alien Clapton Fused">
                @error('title')
                <p class="mt-1.5 text-xs text-red-400 font-semibold flex items-center gap-1.5">
                    <svg class="h-3.5 w-3.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                    {{ $message }}
                </p>
                @enderror
            </div>

            {{-- Harga & Stok --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                {{-- Harga --}}
                <div>
                    <label for="price" class="block text-[10px] font-bold text-slate-450 uppercase tracking-wider mb-1.5">
                        Harga (IDR) <span class="text-red-400">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <span class="text-slate-500 text-xs font-mono font-semibold">Rp</span>
                        </div>
                        <input type="number" id="price" name="price" required min="0" step="500"
                            value="{{ old('price', $product->price ? (int)$product->price : '') }}"
                            class="block w-full rounded bg-black border border-industrial-border text-slate-100 pl-10 pr-4 py-3 text-sm focus:outline-none focus:ring-1 focus:ring-industrial-orange focus:border-transparent transition-all font-mono placeholder-slate-700"
                            placeholder="50000">
                    </div>
                    @error('price')
                    <p class="mt-1.5 text-xs text-red-400 font-semibold flex items-center gap-1.5">
                        <svg class="h-3.5 w-3.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                        {{ $message }}
                    </p>
                    @enderror
                </div>

                {{-- Stok --}}
                <div>
                    <label for="stock" class="block text-[10px] font-bold text-slate-450 uppercase tracking-wider mb-1.5">
                        Stok Inventaris <span class="text-red-400">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                            <span class="text-slate-500 text-xs font-mono">unit</span>
                        </div>
                        <input type="number" id="stock" name="stock" required min="0"
                            value="{{ old('stock', $product->stock ?? '') }}"
                            class="block w-full rounded bg-black border border-industrial-border text-slate-100 pl-4 pr-12 py-3 text-sm focus:outline-none focus:ring-1 focus:ring-industrial-orange focus:border-transparent transition-all font-mono placeholder-slate-700"
                            placeholder="100">
                    </div>
                    @error('stock')
                    <p class="mt-1.5 text-xs text-red-400 font-semibold flex items-center gap-1.5">
                        <svg class="h-3.5 w-3.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                        {{ $message }}
                    </p>
                    @enderror
            </div>

            {{-- Link Marketplace Produk (Beli Instan) --}}
            <div class="border-t border-industrial-border/60 pt-6 mt-6">
                <span class="text-[8px] font-display text-industrial-orange font-bold uppercase tracking-widest">[ LINK_BELI_INSTAN_MARKETPLACE ]</span>
                <h4 class="text-xs font-bold text-slate-200 uppercase tracking-wide mt-1 mb-3">Tautan E-Commerce Produk</h4>
                <p class="text-[10px] text-slate-500 mb-4 leading-normal">
                    Masukkan URL halaman detail produk ini untuk setiap marketplace agar pelanggan dapat melakukan checkout instan.
                </p>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    @php
                        $platforms = [
                            'shopee' => 'Shopee',
                            'tokopedia' => 'Tokopedia',
                            'blibli' => 'Blibli',
                            'tiktok' => 'TikTok Shop',
                            'toco' => 'Toco'
                        ];
                        $currentUrls = $product->marketplace_urls ?? [];
                    @endphp
                    @foreach($platforms as $key => $label)
                    <div>
                        <label for="market_url_{{ $key }}" class="block text-[10px] font-bold text-slate-450 uppercase tracking-wider mb-1.5">
                            Link {{ $label }}
                        </label>
                        <input type="url" id="market_url_{{ $key }}" name="marketplace_urls[{{ $key }}]"
                            value="{{ old('marketplace_urls.' . $key, $currentUrls[$key] ?? '') }}"
                            class="block w-full rounded bg-black border border-industrial-border text-slate-100 px-4 py-3 text-sm focus:outline-none focus:ring-1 focus:ring-industrial-orange focus:border-transparent transition-all font-mono placeholder-slate-700"
                            placeholder="https://...">
                        @error('marketplace_urls.' . $key)
                        <p class="mt-1.5 text-xs text-red-400 font-semibold flex items-center gap-1.5">
                            <svg class="h-3.5 w-3.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                            {{ $message }}
                        </p>
                        @enderror
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- Deskripsi --}}
            <div>
                <label for="character_description" class="block text-[10px] font-bold text-slate-450 uppercase tracking-wider mb-1.5">
                    Deskripsi / Karakter Produk <span class="text-red-400">*</span>
                </label>
                <textarea id="character_description" name="character_description" required rows="4"
                    class="block w-full rounded bg-black border border-industrial-border text-slate-100 px-4 py-3 text-sm focus:outline-none focus:ring-1 focus:ring-industrial-orange focus:border-transparent transition-all placeholder-slate-700 resize-y"
                    placeholder="Masukkan detail karakteristik produk di sini...">{{ old('character_description', $product->character_description) }}</textarea>

                {{-- Copywriting Quick-Pick --}}
                <div class="mt-3">
                    <p class="text-[9px] text-slate-600 uppercase tracking-wider mb-1.5">Pilihan teks cepat (klik untuk menyalin ke clipboard):</p>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                        <button type="button"
                            onclick="document.getElementById('character_description').value = 'Pilihan terbaik bagi pecinta liquid manis. Mengangkat sweetness lebih maksimal dengan sensasi inhale yang halus dan throat hit yang konsisten.'"
                            class="text-left p-2.5 bg-black rounded border border-industrial-border hover:border-industrial-orange/30 transition-colors group">
                            <strong class="text-industrial-orange uppercase block mb-0.5 font-display text-[9px] group-hover:text-industrial-orange">⚡ Coil Standard</strong>
                            <span class="text-[9px] text-slate-500 leading-relaxed">Pilihan terbaik bagi pecinta liquid manis. Mengangkat sweetness lebih maksimal...</span>
                        </button>
                        <button type="button"
                            onclick="document.getElementById('character_description').value = 'Menghasilkan rasa liquid yang bersih dengan daya serap cepat untuk penggunaan intensif. Serat organik 100% tanpa bahan kimia.'"
                            class="text-left p-2.5 bg-black rounded border border-industrial-border hover:border-industrial-orange/30 transition-colors group">
                            <strong class="text-industrial-orange uppercase block mb-0.5 font-display text-[9px] group-hover:text-industrial-orange">🌿 Cotton Standard</strong>
                            <span class="text-[9px] text-slate-500 leading-relaxed">Menghasilkan rasa liquid yang bersih dengan daya serap cepat untuk penggunaan intensif...</span>
                        </button>
                    </div>
                </div>

                @error('character_description')
                <p class="mt-1.5 text-xs text-red-400 font-semibold flex items-center gap-1.5">
                    <svg class="h-3.5 w-3.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                    {{ $message }}
                </p>
                @enderror
            </div>

            {{-- Foto Produk --}}
            <div class="border-t border-industrial-border/50 pt-5 mt-5">
                <label class="block text-[10px] font-bold text-slate-455 uppercase tracking-wider mb-1.5">
                    Foto Produk <span class="text-slate-500">(Maks 2MB, Rekomendasi 1:1)</span>
                </label>

                <div class="grid grid-cols-1 md:grid-cols-4 gap-4 items-center">
                    {{-- Preview area --}}
                    <div class="md:col-span-1 flex flex-col items-center justify-center p-4 bg-black border border-industrial-border h-32 relative group">
                        @if($product->image_path)
                        <img src="{{ $product->image_path }}" id="product_image_preview" alt="Preview" class="h-full w-full object-contain">
                        @else
                        <div id="product_image_placeholder" class="text-center text-slate-650 flex flex-col items-center">
                            <svg class="h-8 w-8 mb-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <span class="text-[8px] uppercase tracking-wider font-mono">No Image</span>
                        </div>
                        <img src="" id="product_image_preview" alt="Preview" class="h-full w-full object-contain hidden">
                        @endif
                    </div>

                    {{-- Input area --}}
                    <div class="md:col-span-3 space-y-2">
                        <input type="file" id="product_image_input" name="image" accept="image/*"
                            onchange="
                                   const file = this.files[0];
                                   if (file) {
                                       const reader = new FileReader();
                                       reader.onload = function(e) {
                                           document.getElementById('product_image_preview').src = e.target.result;
                                           document.getElementById('product_image_preview').classList.remove('hidden');
                                           const placeholder = document.getElementById('product_image_placeholder');
                                           if (placeholder) placeholder.classList.add('hidden');
                                       }
                                       reader.readAsDataURL(file);
                                   }
                               "
                            class="block w-full text-xs text-slate-400 file:mr-4 file:py-2 file:px-4 file:rounded file:border file:border-industrial-border file:text-xs file:font-semibold file:bg-black file:text-slate-300 hover:file:bg-zinc-900 file:cursor-pointer">
                        <p class="text-[9px] text-slate-500 font-mono">Tipe file yang didukung: JPG, JPEG, PNG, WEBP, GIF, SVG.</p>
                        @error('image')
                        <p class="mt-1.5 text-xs text-red-400 font-semibold flex items-center gap-1.5">
                            <svg class="h-3.5 w-3.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                            {{ $message }}
                        </p>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        {{-- ===== SECTION 3: SPESIFIKASI ===== --}}
        <div class="bg-industrial-dark border border-industrial-border rounded-none p-6 sm:p-8 shadow-xl space-y-5">
            <div class="flex items-center gap-3 border-b border-industrial-border/50 pb-4">
                <div class="w-5 h-5 rounded-none bg-industrial-orange/10 border border-industrial-orange/30 flex items-center justify-center flex-shrink-0">
                    <span class="text-industrial-orange font-bold text-[10px] font-display">3</span>
                </div>
                <div class="flex-1 flex items-center justify-between">
                    <h2 x-text="category === 'coil' ? 'Spesifikasi Performa' : 'Fitur & Spesifikasi'" class="text-xs font-bold text-slate-300 uppercase tracking-widest font-display">Spesifikasi Performa</h2>
                    <span x-text="category === 'coil' ? 'MATRIKS COIL' : 'MATRIKS KAPAS'"
                        class="text-[8px] px-2 py-0.5 bg-industrial-orange/10 border border-industrial-orange/20 text-industrial-orange font-bold uppercase tracking-wider font-display"></span>
                </div>
            </div>

            {{-- COIL SPECS: Star sliders 1-5 --}}
            <div x-show="category === 'coil'" class="space-y-6" x-cloak>
                <p class="text-[10px] text-slate-500">Atur nilai performa coil dari 1 (terendah) hingga 5 (tertinggi) menggunakan slider di bawah.</p>

                {{-- Flavor --}}
                <div class="space-y-2">
                    <div class="flex justify-between items-center">
                        <div>
                            <span class="text-xs font-semibold text-slate-300">Ekstraksi Rasa</span>
                            <span class="text-[9px] text-slate-600 ml-1.5 font-mono uppercase">Flavor</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <div class="flex items-center gap-0.5">
                                <template x-for="i in 5">
                                    <svg class="h-4 w-4 transition-all duration-150 cursor-default"
                                        :class="i <= specs.flavor ? 'text-industrial-orange fill-current drop-shadow-[0_0_4px_rgba(255,85,0,0.6)]' : 'text-slate-800'"
                                        viewBox="0 0 20 20" fill="none">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                    </svg>
                                </template>
                            </div>
                            <span class="text-xs font-bold text-industrial-orange font-mono w-4 text-center" x-text="specs.flavor"></span>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <span class="text-[9px] text-slate-600 font-mono">1</span>
                        <input type="range" name="specifications[flavor]" min="1" max="5" step="1" x-model.number="specs.flavor"
                            class="flex-1 h-1.5 bg-zinc-900 rounded appearance-none cursor-pointer accent-industrial-orange">
                        <span class="text-[9px] text-slate-600 font-mono">5</span>
                    </div>
                </div>

                {{-- Sweetness --}}
                <div class="space-y-2">
                    <div class="flex justify-between items-center">
                        <div>
                            <span class="text-xs font-semibold text-slate-300">Tingkat Kemanisan</span>
                            <span class="text-[9px] text-slate-600 ml-1.5 font-mono uppercase">Sweetness</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <div class="flex items-center gap-0.5">
                                <template x-for="i in 5">
                                    <svg class="h-4 w-4 transition-all duration-150 cursor-default"
                                        :class="i <= specs.sweetness ? 'text-industrial-orange fill-current drop-shadow-[0_0_4px_rgba(255,85,0,0.6)]' : 'text-slate-800'"
                                        viewBox="0 0 20 20" fill="none">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                    </svg>
                                </template>
                            </div>
                            <span class="text-xs font-bold text-industrial-orange font-mono w-4 text-center" x-text="specs.sweetness"></span>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <span class="text-[9px] text-slate-600 font-mono">1</span>
                        <input type="range" name="specifications[sweetness]" min="1" max="5" step="1" x-model.number="specs.sweetness"
                            class="flex-1 h-1.5 bg-zinc-900 rounded appearance-none cursor-pointer accent-industrial-orange">
                        <span class="text-[9px] text-slate-600 font-mono">5</span>
                    </div>
                </div>

                {{-- Throat Hit --}}
                <div class="space-y-2">
                    <div class="flex justify-between items-center">
                        <div>
                            <span class="text-xs font-semibold text-slate-300">Hantaman Tenggorokan</span>
                            <span class="text-[9px] text-slate-600 ml-1.5 font-mono uppercase">Throat Hit</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <div class="flex items-center gap-0.5">
                                <template x-for="i in 5">
                                    <svg class="h-4 w-4 transition-all duration-150 cursor-default"
                                        :class="i <= specs.throat_hit ? 'text-industrial-orange fill-current drop-shadow-[0_0_4px_rgba(255,85,0,0.6)]' : 'text-slate-800'"
                                        viewBox="0 0 20 20" fill="none">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                    </svg>
                                </template>
                            </div>
                            <span class="text-xs font-bold text-industrial-orange font-mono w-4 text-center" x-text="specs.throat_hit"></span>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <span class="text-[9px] text-slate-600 font-mono">1</span>
                        <input type="range" name="specifications[throat_hit]" min="1" max="5" step="1" x-model.number="specs.throat_hit"
                            class="flex-1 h-1.5 bg-zinc-900 rounded appearance-none cursor-pointer accent-industrial-orange">
                        <span class="text-[9px] text-slate-600 font-mono">5</span>
                    </div>
                </div>

                {{-- Parameter Fisik Coil --}}
                @php
                $resistanceSingle = old('specifications_resistance_single', $product->specifications['resistance_single'] ?? '');
                $resistanceDual = old('specifications_resistance_dual', $product->specifications['resistance_dual'] ?? '');
                $footValue = old('specifications_foot', $product->specifications['foot'] ?? '');

                // Legacy fallback parser
                if (empty($resistanceSingle) && empty($resistanceDual)) {
                $resistanceStr = old('specifications.resistance', $product->specifications['resistance'] ?? '');
                if (preg_match_all('/([0-9\.]+)\s*(?:ohm|Ω)\s*(single|dual)/iu', $resistanceStr, $allMatches, PREG_SET_ORDER)) {
                foreach ($allMatches as $m) {
                $type = strtolower($m[2]);
                if ($type === 'single') {
                $resistanceSingle = $m[1];
                } elseif ($type === 'dual') {
                $resistanceDual = $m[1];
                }
                }
                } else if (preg_match('/([0-9\.]+)\s*(?:ohm|Ω)\s*(single|dual)/iu', $resistanceStr, $matches)) {
                $val = $matches[1];
                $type = strtolower($matches[2]);
                if ($type === 'single') {
                $resistanceSingle = $val;
                } else {
                $resistanceDual = $val;
                }
                } elseif (preg_match('/([0-9\.]+)/', $resistanceStr, $matches)) {
                $resistanceSingle = $matches[1];
                }
                }

                $wrapValue = old('specifications_wrap_value');
                if (empty($wrapValue)) {
                $wrapStr = old('specifications.wrap', $product->specifications['wrap'] ?? '');
                if (preg_match('/([0-9]+)/', $wrapStr, $matches)) {
                $wrapValue = (int) $matches[1];
                }
                }
                @endphp

                <div class="border-t border-zinc-800/60 pt-6 mt-6 space-y-4">
                    <h3 class="text-xs font-bold text-slate-300 uppercase tracking-widest font-display">Parameter Fisik Coil</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        {{-- Diameter --}}
                        <div>
                            <label for="spec_diameter" class="block text-[10px] font-bold text-slate-455 uppercase tracking-wider mb-1.5">
                                Diameter Kawat (e.g. 3.0 mm)
                            </label>
                            <input type="text" id="spec_diameter" name="specifications[diameter]"
                                value="{{ old('specifications.diameter', $product->specifications['diameter'] ?? '') }}"
                                class="block w-full rounded bg-black border border-zinc-800 text-slate-100 px-3 py-2 text-xs focus:outline-none focus:ring-1 focus:ring-industrial-orange focus:border-transparent transition-all placeholder-slate-700 font-semibold"
                                placeholder="e.g. 3.0 mm">
                        </div>



                        {{-- Wrap --}}
                        <div>
                            <label for="spec_wrap_value" class="block text-[10px] font-bold text-slate-455 uppercase tracking-wider mb-1.5">
                                Jumlah Lilitan / Wrap
                            </label>
                            <select id="spec_wrap_value" name="specifications_wrap_value"
                                class="block w-full rounded bg-black border border-zinc-800 text-slate-100 px-3 py-2 text-xs focus:outline-none focus:ring-1 focus:ring-industrial-orange focus:border-transparent transition-all font-semibold cursor-pointer">
                                <option value="" disabled {{ empty($wrapValue) ? 'selected' : '' }}>Pilih lilitan...</option>
                                @for ($w = 3; $w <= 10; $w++)
                                    <option value="{{ $w }}" {{ $wrapValue == $w ? 'selected' : '' }}>{{ $w }} Wraps ({{ $w }} Lilitan)</option>
                                    @endfor
                            </select>
                        </div>

                        {{-- Material --}}
                        <div>
                            <label for="spec_material" class="block text-[10px] font-bold text-slate-450 uppercase tracking-wider mb-1.5">
                                Bahan / Material (e.g. Ni80 Sandvik)
                            </label>
                            <input type="text" id="spec_material" name="specifications[material]"
                                value="{{ old('specifications.material', $product->specifications['material'] ?? '') }}"
                                class="block w-full rounded bg-black border border-zinc-800 text-slate-100 px-3 py-2 text-xs focus:outline-none focus:ring-1 focus:ring-industrial-orange focus:border-transparent transition-all placeholder-slate-700 font-semibold"
                                placeholder="e.g. Ni80 Sandvik">
                        </div>

                        {{-- Foot Type --}}
                        <div>
                            <label for="spec_foot" class="block text-[10px] font-bold text-slate-455 uppercase tracking-wider mb-1.5">
                                Tipe Kaki Coil
                            </label>
                            <select id="spec_foot" name="specifications_foot"
                                class="block w-full rounded bg-black border border-zinc-800 text-slate-100 px-3 py-2 text-xs focus:outline-none focus:ring-1 focus:ring-industrial-orange focus:border-transparent transition-all font-semibold cursor-pointer">
                                <option value="" {{ empty($footValue) ? 'selected' : '' }}>Pilih Tipe Kaki...</option>
                                <option value="Kaki Sejajar" {{ strcasecmp($footValue, 'Kaki Sejajar') === 0 ? 'selected' : '' }}>Kaki Sejajar</option>
                                <option value="Kaki Silang" {{ strcasecmp($footValue, 'Kaki Silang') === 0 ? 'selected' : '' }}>Kaki Silang</option>
                            </select>
                        </div>

                        {{-- Resistance Single Coil --}}
                        <div>
                            <label for="spec_resistance_single" class="block text-[10px] font-bold text-slate-455 uppercase tracking-wider mb-1.5">
                                Hambatan Single Coil (Ω)
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                    <span class="text-slate-500 text-xs font-mono">Ω</span>
                                </div>
                                <input type="number" step="0.01" min="0.01" max="5.00"
                                    id="spec_resistance_single" name="specifications_resistance_single"
                                    value="{{ $resistanceSingle }}"
                                    class="block w-full rounded bg-black border border-zinc-800 text-slate-100 pl-3 pr-8 py-2 text-xs focus:outline-none focus:ring-1 focus:ring-industrial-orange focus:border-transparent transition-all placeholder-slate-750 font-semibold font-mono"
                                    placeholder="e.g. 0.36">
                            </div>
                        </div>

                        {{-- Resistance Dual Coil --}}
                        <div>
                            <label for="spec_resistance_dual" class="block text-[10px] font-bold text-slate-455 uppercase tracking-wider mb-1.5">
                                Hambatan Dual Coil (Ω) (Opsional)
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                    <span class="text-slate-500 text-xs font-mono">Ω</span>
                                </div>
                                <input type="number" step="0.01" min="0.01" max="5.00"
                                    id="spec_resistance_dual" name="specifications_resistance_dual"
                                    value="{{ $resistanceDual }}"
                                    class="block w-full rounded bg-black border border-zinc-800 text-slate-100 pl-3 pr-8 py-2 text-xs focus:outline-none focus:ring-1 focus:ring-industrial-orange focus:border-transparent transition-all placeholder-slate-750 font-semibold font-mono"
                                    placeholder="e.g. 0.18">
                            </div>
                        </div>
                    </div>

                    {{-- Durability (Ketahanan) --}}
                    <div>
                        <label for="spec_durability" class="block text-[10px] font-bold text-slate-455 uppercase tracking-wider mb-1.5">
                            Ketahanan / Durability (e.g. 14 - 21 Hari)
                        </label>
                        <input type="text" id="spec_durability" name="specifications[durability]"
                            value="{{ old('specifications.durability', $product->specifications['durability'] ?? '') }}"
                            class="block w-full rounded bg-black border border-zinc-800 text-slate-100 px-3 py-2 text-xs focus:outline-none focus:ring-1 focus:ring-industrial-orange focus:border-transparent transition-all placeholder-slate-700 font-semibold"
                            placeholder="e.g. 14 - 21 Hari (Tergantung Perawatan User)">
                    </div>

                    {{-- Recommended Watt --}}
                    <div>
                        <label for="spec_recommended_watt" class="block text-[10px] font-bold text-slate-455 uppercase tracking-wider mb-1.5">
                            Rekomendasi Watt (e.g. 35 - 45W)
                        </label>
                        <input type="text" id="spec_recommended_watt" name="specifications[recommended_watt]"
                            value="{{ old('specifications.recommended_watt', $product->specifications['recommended_watt'] ?? '') }}"
                            class="block w-full rounded bg-black border border-zinc-800 text-slate-100 px-3 py-2 text-xs focus:outline-none focus:ring-1 focus:ring-industrial-orange focus:border-transparent transition-all placeholder-slate-700 font-semibold"
                            placeholder="e.g. 35-45W">
                    </div>

                    {{-- Compatible Atomizers (Checkboxes) --}}
                    <div>
                        <label class="block text-[10px] font-bold text-slate-455 uppercase tracking-wider mb-1.5">
                            Kompatibilitas Atomizer
                        </label>
                        <div class="flex flex-wrap gap-4 mt-2">
                            @foreach(['RDA', 'RTA', 'MTL', 'DL', 'AIO'] as $atomizer)
                            <label class="inline-flex items-center gap-2 cursor-pointer text-xs font-semibold text-slate-300">
                                <input type="checkbox" name="specifications[compatible_atomizers][]" value="{{ $atomizer }}"
                                    {{ in_array($atomizer, old('specifications.compatible_atomizers', $product->specifications['compatible_atomizers'] ?? [])) ? 'checked' : '' }}
                                    class="rounded bg-black border-zinc-800 text-industrial-orange focus:ring-industrial-orange">
                                <span>{{ $atomizer }}</span>
                            </label>
                            @endforeach
                        </div>
                    </div>

                    {{-- Recommended Liquid (Checkboxes) --}}
                    <div>
                        <label class="block text-[10px] font-bold text-slate-455 uppercase tracking-wider mb-1.5">
                            Rekomendasi Liquid
                        </label>
                        <div class="flex flex-wrap gap-4 mt-2">
                            @foreach(['Fruit', 'Creamy', 'Sweet', 'Menthol'] as $liq)
                            <label class="inline-flex items-center gap-2 cursor-pointer text-xs font-semibold text-slate-300">
                                <input type="checkbox" name="specifications[recommended_liquid][]" value="{{ $liq }}"
                                    {{ in_array($liq, old('specifications.recommended_liquid', $product->specifications['recommended_liquid'] ?? [])) ? 'checked' : '' }}
                                    class="rounded bg-black border-zinc-800 text-industrial-orange focus:ring-industrial-orange">
                                <span>{{ $liq }}</span>
                            </label>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            {{-- COTTON SPECS: Textarea --}}
            <div x-show="category === 'cotton'" class="space-y-4" x-cloak>
                <div>
                    <label for="specifications_text" class="block text-[10px] font-bold text-slate-450 uppercase tracking-wider mb-1.5">
                        Fitur & Spesifikasi Kapas (Satu per baris)
                    </label>
                    <textarea id="specifications_text" name="specifications_text" rows="5"
                        class="block w-full rounded bg-black border border-zinc-800 text-slate-100 px-4 py-3 text-sm focus:outline-none focus:ring-1 focus:ring-industrial-orange focus:border-transparent transition-all placeholder-slate-700 resize-y font-sans"
                        placeholder="e.g.&#10;Clean Flavor Delivery&#10;Fast Liquid Absorption&#10;Premium Organic Fiber">{{ old('specifications_text', (isset($product->specifications['items']) && is_array($product->specifications['items'])) ? implode("\n", $product->specifications['items']) : '') }}</textarea>
                    <p class="text-[9px] text-slate-500 mt-1.5">Tuliskan setiap fitur atau keunggulan kapas pada baris baru (tekan Enter). Fitur-fitur ini akan ditampilkan sebagai daftar keunggulan produk di halaman depan.</p>
                </div>
            </div>
        </div>

        {{-- ===== ACTION BUTTONS ===== --}}
        <div class="flex items-center justify-between gap-4 py-2">
            <a href="{{ route('admin.products.index') }}"
                class="flex items-center gap-2 px-5 py-2.5 text-xs font-bold uppercase tracking-widest text-slate-500 hover:text-slate-300 transition-colors border border-transparent hover:border-zinc-800 rounded-none">
                <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Kembali
            </a>
            <button type="submit"
                class="stealth-btn-primary flex items-center gap-2 px-8 py-2.5 text-xs font-bold uppercase tracking-widest rounded-none">
                <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                {{ $isEdit ? 'Simpan Perubahan' : 'Terbitkan Produk' }}
            </button>
        </div>
    </form>
</div>
@endsection