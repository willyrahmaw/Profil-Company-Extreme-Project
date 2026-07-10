@extends('layouts.admin')

@section('title', $isEdit ? 'Edit Toko' : 'Tambah Toko')

@section('content')
<div class="max-w-2xl mx-auto space-y-8" 
     x-data="{
         platform: '{{ old('platform', $shop->platform) }}',
         isActive: {{ old('is_active', $shop->is_active) ? 'true' : 'false' }}
     }">
    
    <!-- Breadcrumb -->
    <div class="flex items-center gap-2 text-[10px] font-semibold text-slate-500 uppercase tracking-widest">
        <a href="{{ route('admin.shops.index') }}" class="hover:text-industrial-orange transition-colors">Toko</a>
        <span>/</span>
        <span class="text-slate-400">{{ $isEdit ? 'Edit' : 'Tambah' }}</span>
    </div>

    <div>
        <h1 class="text-2xl font-bold tracking-tight text-slate-100 font-display">
            {{ $isEdit ? 'UBAH MATRIKS TOKO' : 'DAFTARKAN TOKO BARU' }}
        </h1>
        <p class="text-xs text-slate-450">
            {{ $isEdit ? 'Perbarui tautan belanja atau nama profil channel eksternal Anda.' : 'Masukkan nama dan tautan URL channel eksternal baru.' }}
        </p>
    </div>

    <!-- Form Panel -->
    <form action="{{ $isEdit ? route('admin.shops.update', $shop->id) : route('admin.shops.store') }}" 
          method="POST" 
          onsubmit="return confirm('Apakah Anda yakin ingin menyimpan data toko ini?');"
          class="bg-industrial-dark border border-industrial-border rounded-none p-6 sm:p-8 shadow-xl space-y-6">
        @csrf
        @if($isEdit)
            @method('PUT')
        @endif

        <!-- Shop Name -->
        <div>
            <label for="name" class="block text-[10px] font-semibold text-slate-455 uppercase tracking-wider">
                Nama Toko / Channel
            </label>
            <input type="text" id="name" name="name" required value="{{ old('name', $shop->name) }}"
                   class="mt-1.5 block w-full rounded bg-black border border-industrial-border text-slate-100 px-4 py-3 text-sm focus:outline-none focus:ring-1 focus:ring-industrial-orange focus:border-transparent transition-all placeholder-slate-700 font-semibold"
                   placeholder="e.g. TikTok Shop Coils">
            @error('name')
                <p class="mt-1.5 text-xs text-red-550 font-semibold">{{ $message }}</p>
            @enderror
        </div>

        <!-- URL Link -->
        <div>
            <label for="url" class="block text-[10px] font-semibold text-slate-455 uppercase tracking-wider">
                Tautan URL (Link)
            </label>
            <input type="url" id="url" name="url" required value="{{ old('url', $shop->url) }}"
                   class="mt-1.5 block w-full rounded bg-black border border-industrial-border text-slate-100 px-4 py-3 text-sm focus:outline-none focus:ring-1 focus:ring-industrial-orange focus:border-transparent transition-all font-mono placeholder-slate-750"
                   placeholder="https://tiktok.com/@username">
            @error('url')
                <p class="mt-1.5 text-xs text-red-550 font-semibold">{{ $message }}</p>
            @enderror
        </div>

        <!-- Platform & Active Toggle Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Platform Selector -->
            <div>
                <label for="platform" class="block text-[10px] font-semibold text-slate-455 uppercase tracking-wider mb-1.5">
                    Platform Channel
                </label>
                <select id="platform" name="platform" x-model="platform"
                        class="block w-full rounded bg-black border border-industrial-border text-slate-100 px-4 py-3 text-sm focus:outline-none focus:ring-1 focus:ring-industrial-orange focus:border-transparent transition-all font-semibold">
                    <option value="tiktok">TikTok Shop</option>
                    <option value="whatsapp">WhatsApp</option>
                    <option value="instagram">Instagram</option>
                    <option value="blibli">Blibli</option>
                    <option value="tokopedia">Tokopedia</option>
                    <option value="taco">Taco</option>
                </select>
                @error('platform')
                    <p class="mt-1.5 text-xs text-red-550 font-semibold">{{ $message }}</p>
                @enderror
            </div>

            <!-- Active Checkbox Toggle -->
            <div>
                <label class="block text-[10px] font-semibold text-slate-455 uppercase tracking-wider mb-2">
                    Status Publikasi
                </label>
                <label class="flex items-center justify-between p-3 bg-black border border-industrial-border rounded-none hover:border-slate-800 cursor-pointer transition-colors h-[46px]">
                    <span class="text-xs font-semibold text-slate-300">Tampilkan di Halaman Depan</span>
                    <div class="relative">
                        <input type="checkbox" name="is_active" value="1" 
                               x-model="isActive" class="sr-only">
                        <div class="w-10 h-5 bg-slate-800 rounded-full transition-colors duration-205"
                             :class="isActive ? 'bg-industrial-orange' : ''"></div>
                        <div class="absolute left-0.5 top-0.5 bg-slate-900 w-4 h-4 rounded-full transition-transform duration-205"
                             :class="isActive ? 'translate-x-5 bg-slate-950' : ''"></div>
                    </div>
                </label>
            </div>
        </div>

        <!-- Form Action Buttons -->
        <div class="flex items-center justify-end gap-4 border-t border-zinc-800/60 pt-6">
            <a href="{{ route('admin.shops.index') }}" 
               class="px-4 py-2.5 text-xs font-bold uppercase tracking-widest text-slate-450 hover:text-slate-200 transition-colors font-display">
                Batal
            </a>
            <button type="submit" 
                    class="stealth-btn-primary px-6 py-2.5 text-xs font-bold uppercase tracking-widest rounded-none font-display">
                {{ $isEdit ? 'Simpan Perubahan' : 'Daftarkan Toko' }}
            </button>
        </div>
    </form>
</div>
@endsection
