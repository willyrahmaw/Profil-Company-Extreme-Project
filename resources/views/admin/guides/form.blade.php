@extends('layouts.admin')

@section('title', $isEdit ? 'Edit Panduan Edukasi' : 'Tambah Panduan Edukasi')

@section('content')
<div class="max-w-2xl mx-auto space-y-8" 
     x-data="{
         orderPosition: {{ old('order_position', $guide->order_position) }},
         isActive: {{ old('is_active', $guide->is_active) ? 'true' : 'false' }}
     }">
    
    <!-- Breadcrumb -->
    <div class="flex items-center gap-2 text-[10px] font-semibold text-slate-500 uppercase tracking-widest">
        <a href="{{ route('admin.guides.index') }}" class="hover:text-industrial-orange transition-colors">Panduan</a>
        <span>/</span>
        <span class="text-slate-400">{{ $isEdit ? 'Edit' : 'Tambah' }}</span>
    </div>

    <div>
        <h1 class="text-2xl font-bold tracking-tight text-slate-100 font-display">
            {{ $isEdit ? 'UBAH PANDUAN EDUKASI' : 'BUAT PANDUAN BARU' }}
        </h1>
        <p class="text-xs text-slate-450">
            {{ $isEdit ? 'Perbarui judul panduan, isi artikel edukatif, atau urutan tampil.' : 'Masukkan judul dan artikel edukatif baru untuk dipublikasikan.' }}
        </p>
    </div>

    <!-- Form Panel -->
    <form action="{{ $isEdit ? route('admin.guides.update', $guide->id) : route('admin.guides.store') }}" 
          method="POST" 
          onsubmit="return confirm('Apakah Anda yakin ingin menyimpan data panduan ini?');"
          class="bg-industrial-dark border border-industrial-border rounded-none p-6 sm:p-8 shadow-xl space-y-6">
        @csrf
        @if($isEdit)
            @method('PUT')
        @endif

        <!-- Guide Title -->
        <div>
            <label for="title" class="block text-[10px] font-semibold text-slate-455 uppercase tracking-wider">
                Judul Panduan
            </label>
            <input type="text" id="title" name="title" required value="{{ old('title', $guide->title) }}"
                   class="mt-1.5 block w-full rounded bg-black border border-industrial-border text-slate-100 px-4 py-3 text-sm focus:outline-none focus:ring-1 focus:ring-industrial-orange focus:border-transparent transition-all placeholder-slate-700 font-semibold"
                   placeholder="e.g. Cara Membersihkan Coil">
            @error('title')
                <p class="mt-1.5 text-xs text-red-550 font-semibold">{{ $message }}</p>
            @enderror
        </div>

        <!-- Order Position & Active Toggle Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Order Position -->
            <div>
                <label for="order_position" class="block text-[10px] font-semibold text-slate-455 uppercase tracking-wider mb-1.5">
                    Urutan Tampil (Posisi)
                </label>
                <input type="number" id="order_position" name="order_position" required min="0" value="{{ old('order_position', $guide->order_position) }}"
                       class="block w-full rounded bg-black border border-industrial-border text-slate-100 px-4 py-3 text-sm focus:outline-none focus:ring-1 focus:ring-industrial-orange focus:border-transparent transition-all font-semibold font-mono"
                       placeholder="e.g. 1">
                @error('order_position')
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

        <!-- Guide Content -->
        <div>
            <label for="content" class="block text-[10px] font-semibold text-slate-455 uppercase tracking-wider mb-1.5">
                Isi Artikel Panduan (Mendukung tag HTML dasar)
            </label>
            <textarea id="content" name="content" required rows="10"
                      class="block w-full rounded bg-black border border-industrial-border text-slate-100 px-4 py-3 text-sm focus:outline-none focus:ring-1 focus:ring-industrial-orange focus:border-transparent transition-all placeholder-slate-700 font-light font-mono leading-relaxed"
                      placeholder="Tulis ulasan/artikel edukatif di sini...">{{ old('content', $guide->content) }}</textarea>
            @error('content')
                <p class="mt-1.5 text-xs text-red-550 font-semibold">{{ $message }}</p>
            @enderror
            <p class="text-[9px] text-zinc-550 mt-1.5">Tips: Anda dapat menggunakan elemen HTML seperti &lt;p&gt;, &lt;ul&gt;, &lt;li&gt;, &lt;strong&gt;, &lt;div class="grid grid-cols-1 sm:grid-cols-2 gap-4"&gt; untuk tata letak premium.</p>
        </div>

        <!-- Action Buttons -->
        <div class="flex items-center justify-end gap-4 pt-4 border-t border-industrial-border font-mono text-[10px]">
            <a href="{{ route('admin.guides.index') }}" 
               class="px-5 py-3 border border-zinc-800 hover:border-zinc-650 text-slate-400 hover:text-slate-200 transition-colors uppercase font-bold tracking-widest rounded-none">
                [ BATAL ]
            </a>
            <button type="submit" 
                    class="stealth-btn-primary px-5 py-3 text-xs uppercase font-bold tracking-widest rounded-none">
                [ SIMPAN PANDUAN ]
            </button>
        </div>
    </form>
</div>
@endsection
