@extends('layouts.admin')

@section('title', $isEdit ? 'Edit Event' : 'Tambah Event')

@section('content')
<div class="max-w-2xl mx-auto space-y-8" 
     x-data="{
         discountPercentage: {{ old('discount_percentage', $event->discount_percentage) }},
         isActive: {{ old('is_active', $event->is_active) ? 'true' : 'false' }}
     }">
    
    <!-- Breadcrumb -->
    <div class="flex items-center gap-2 text-[10px] font-semibold text-slate-500 uppercase tracking-widest">
        <a href="{{ route('admin.events.index') }}" class="hover:text-industrial-orange transition-colors">Event</a>
        <span>/</span>
        <span class="text-slate-400">{{ $isEdit ? 'Edit' : 'Tambah' }}</span>
    </div>

    <div>
        <h1 class="text-2xl font-bold tracking-tight text-slate-100 font-display">
            {{ $isEdit ? 'UBAH MATRIKS EVENT' : 'DAFTARKAN EVENT BARU' }}
        </h1>
        <p class="text-xs text-slate-455">
            {{ $isEdit ? 'Perbarui informasi event promo, nominal persentase diskon, durasi aktif, atau gambar flyer.' : 'Masukkan nama event, persentase diskon global, rentang tanggal durasi, dan unggah flyer promosi.' }}
        </p>
    </div>

    <!-- Form Panel -->
    <form action="{{ $isEdit ? route('admin.events.update', $event->id) : route('admin.events.store') }}" 
          method="POST" 
          enctype="multipart/form-data"
          onsubmit="return confirm('Apakah Anda yakin ingin menyimpan data event ini? Jika diaktifkan, event aktif lainnya akan otomatis dinonaktifkan.');"
          class="bg-industrial-dark border border-industrial-border rounded-none p-6 sm:p-8 shadow-xl space-y-6">
        @csrf
        @if($isEdit)
            @method('PUT')
        @endif

        <!-- Event Name -->
        <div>
            <label for="name" class="block text-[10px] font-semibold text-slate-455 uppercase tracking-wider">
                Nama Event / Promo
            </label>
            <input type="text" id="name" name="name" required value="{{ old('name', $event->name) }}"
                   class="mt-1.5 block w-full rounded bg-black border border-industrial-border text-slate-100 px-4 py-3 text-sm focus:outline-none focus:ring-1 focus:ring-industrial-orange focus:border-transparent transition-all placeholder-slate-700 font-semibold"
                   placeholder="e.g. Promo Akhir Tahun">
            @error('name')
                <p class="mt-1.5 text-xs text-red-550 font-semibold">{{ $message }}</p>
            @enderror
        </div>

        <!-- Discount Percentage & Active Toggle Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Discount Percentage Selector -->
            <div>
                <label for="discount_percentage" class="block text-[10px] font-semibold text-slate-455 uppercase tracking-wider">
                    Persentase Diskon (%)
                </label>
                <input type="number" id="discount_percentage" name="discount_percentage" required min="0" max="100"
                       x-model="discountPercentage"
                       class="mt-1.5 block w-full rounded bg-black border border-industrial-border text-slate-100 px-4 py-3 text-sm focus:outline-none focus:ring-1 focus:ring-industrial-orange focus:border-transparent transition-all font-mono placeholder-slate-700"
                       placeholder="e.g. 15">
                @error('discount_percentage')
                    <p class="mt-1.5 text-xs text-red-550 font-semibold">{{ $message }}</p>
                @enderror
            </div>

            <!-- Active Checkbox Toggle -->
            <div>
                <label class="block text-[10px] font-semibold text-slate-455 uppercase tracking-wider mb-2">
                    Status Publikasi
                </label>
                <label class="flex items-center justify-between p-3 bg-black border border-industrial-border rounded-none hover:border-slate-800 cursor-pointer transition-colors h-[46px]">
                    <span class="text-xs font-semibold text-slate-300">Aktifkan Diskon Global</span>
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

        <!-- Date Range Selection Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Start Date -->
            <div>
                <label for="start_date" class="block text-[10px] font-semibold text-slate-455 uppercase tracking-wider">
                    Tanggal & Waktu Mulai
                </label>
                <input type="datetime-local" id="start_date" name="start_date" required
                       value="{{ old('start_date', $event->start_date ? $event->start_date->format('Y-m-d\TH:i') : '') }}"
                       class="mt-1.5 block w-full rounded bg-black border border-industrial-border text-slate-100 px-4 py-3 text-sm focus:outline-none focus:ring-1 focus:ring-industrial-orange focus:border-transparent transition-all font-mono">
                @error('start_date')
                    <p class="mt-1.5 text-xs text-red-550 font-semibold">{{ $message }}</p>
                @enderror
            </div>

            <!-- End Date -->
            <div>
                <label for="end_date" class="block text-[10px] font-semibold text-slate-455 uppercase tracking-wider">
                    Tanggal & Waktu Selesai
                </label>
                <input type="datetime-local" id="end_date" name="end_date" required
                       value="{{ old('end_date', $event->end_date ? $event->end_date->format('Y-m-d\TH:i') : '') }}"
                       class="mt-1.5 block w-full rounded bg-black border border-industrial-border text-slate-100 px-4 py-3 text-sm focus:outline-none focus:ring-1 focus:ring-industrial-orange focus:border-transparent transition-all font-mono">
                @error('end_date')
                    <p class="mt-1.5 text-xs text-red-550 font-semibold">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Event Image Flyer Upload -->
        <div>
            <label for="image" class="block text-[10px] font-semibold text-slate-455 uppercase tracking-wider mb-2">
                Gambar Flyer Promosi (Pop-up Gambar)
            </label>
            
            @if($isEdit && $event->image_path)
                <div class="mb-4">
                    <p class="text-[9px] font-mono text-slate-500 uppercase mb-1.5">[ FLYER PROMO SAAT INI ]</p>
                    <img src="{{ $event->image_path }}" alt="Current Flyer" class="max-w-xs h-auto border border-zinc-800 rounded">
                </div>
            @endif

            <input type="file" id="image" name="image" accept="image/*"
                   class="block w-full text-xs text-slate-400 file:mr-4 file:py-2.5 file:px-4 file:rounded file:border file:border-zinc-800 file:bg-black file:text-xs file:font-semibold file:text-slate-300 file:cursor-pointer hover:file:bg-zinc-900 focus:outline-none">
            
            <p class="mt-2 text-[10px] text-slate-500 leading-relaxed">
                Gambar ini akan ditampilkan secara otomatis dalam bentuk modal pop-up ketika pengunjung pertama kali membuka halaman utama website. Rekomendasi rasio gambar vertikal atau persegi (Max 2MB).
            </p>
            @error('image')
                <p class="mt-1.5 text-xs text-red-550 font-semibold">{{ $message }}</p>
            @enderror
        </div>

        <!-- Form Action Buttons -->
        <div class="flex items-center justify-end gap-4 border-t border-zinc-800/60 pt-6">
            <a href="{{ route('admin.events.index') }}" 
               class="px-4 py-2.5 text-xs font-bold uppercase tracking-widest text-slate-450 hover:text-slate-200 transition-colors font-display">
                Batal
            </a>
            <button type="submit" 
                    class="stealth-btn-primary px-6 py-2.5 text-xs font-bold uppercase tracking-widest rounded-none font-display">
                {{ $isEdit ? 'Simpan Perubahan' : 'Daftarkan Event' }}
            </button>
        </div>
    </form>
</div>
@endsection
