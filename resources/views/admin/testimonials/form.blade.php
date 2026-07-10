@extends('layouts.admin')

@section('title', $isEdit ? 'Edit Testimoni' : 'Tambah Testimoni')

@section('content')
<div class="max-w-2xl mx-auto space-y-8" 
     x-data="{
         stars: {{ old('stars', $testimonial->stars) }},
         isActive: {{ old('is_active', $testimonial->is_active) ? 'true' : 'false' }}
     }">
    
    <!-- Breadcrumb -->
    <div class="flex items-center gap-2 text-[10px] font-semibold text-slate-500 uppercase tracking-widest">
        <a href="{{ route('admin.testimonials.index') }}" class="hover:text-industrial-orange transition-colors">Testimoni</a>
        <span>/</span>
        <span class="text-slate-400">{{ $isEdit ? 'Edit' : 'Tambah' }}</span>
    </div>

    <div>
        <h1 class="text-2xl font-bold tracking-tight text-slate-100 font-display">
            {{ $isEdit ? 'UBAH TESTIMONI PELANGGAN' : 'BUAT TESTIMONI BARU' }}
        </h1>
        <p class="text-xs text-slate-450">
            {{ $isEdit ? 'Perbarui isi testimonial, nama pelanggan, atau rating penilaian.' : 'Masukkan data testimonial pelanggan baru untuk dipublikasikan.' }}
        </p>
    </div>

    <!-- Form Panel -->
    <form action="{{ $isEdit ? route('admin.testimonials.update', $testimonial->id) : route('admin.testimonials.store') }}" 
          method="POST" 
          onsubmit="return confirm('Apakah Anda yakin ingin menyimpan data testimoni ini?');"
          class="bg-industrial-dark border border-industrial-border rounded-none p-6 sm:p-8 shadow-xl space-y-6">
        @csrf
        @if($isEdit)
            @method('PUT')
        @endif

        <!-- Customer Name -->
        <div>
            <label for="name" class="block text-[10px] font-semibold text-slate-455 uppercase tracking-wider">
                Nama Pelanggan
            </label>
            <input type="text" id="name" name="name" required value="{{ old('name', $testimonial->name) }}"
                   class="mt-1.5 block w-full rounded bg-black border border-industrial-border text-slate-100 px-4 py-3 text-sm focus:outline-none focus:ring-1 focus:ring-industrial-orange focus:border-transparent transition-all placeholder-slate-700 font-semibold"
                   placeholder="e.g. Rizky">
            @error('name')
                <p class="mt-1.5 text-xs text-red-550 font-semibold">{{ $message }}</p>
            @enderror
        </div>

        <!-- Star Rating & Avatar Initial -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Star Rating -->
            <div>
                <label for="stars" class="block text-[10px] font-semibold text-slate-455 uppercase tracking-wider mb-1.5">
                    Rating Penilaian (Bintang)
                </label>
                <select id="stars" name="stars" x-model.number="stars"
                        class="block w-full rounded bg-black border border-industrial-border text-slate-100 px-4 py-3 text-sm focus:outline-none focus:ring-1 focus:ring-industrial-orange focus:border-transparent transition-all font-semibold">
                    <option value="5">★★★★★ (5 Bintang)</option>
                    <option value="4">★★★★☆ (4 Bintang)</option>
                    <option value="3">★★★☆☆ (3 Bintang)</option>
                    <option value="2">★★☆☆☆ (2 Bintang)</option>
                    <option value="1">★☆☆☆☆ (1 Bintang)</option>
                </select>
                @error('stars')
                    <p class="mt-1.5 text-xs text-red-550 font-semibold">{{ $message }}</p>
                @enderror
            </div>

            <!-- Avatar Initial -->
            <div>
                <label for="avatar_initial" class="block text-[10px] font-semibold text-slate-455 uppercase tracking-wider">
                    Inisial Avatar (Opsional)
                </label>
                <input type="text" id="avatar_initial" name="avatar_initial" maxlength="2" value="{{ old('avatar_initial', $testimonial->avatar_initial) }}"
                       class="mt-1.5 block w-full rounded bg-black border border-industrial-border text-slate-100 px-4 py-3 text-sm focus:outline-none focus:ring-1 focus:ring-industrial-orange focus:border-transparent transition-all font-semibold placeholder-slate-700"
                       placeholder="e.g. R (Kosongkan untuk auto-fill)">
                @error('avatar_initial')
                    <p class="mt-1.5 text-xs text-red-550 font-semibold">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Testimonial Content -->
        <div>
            <label for="content" class="block text-[10px] font-semibold text-slate-455 uppercase tracking-wider">
                Isi Testimoni
            </label>
            <textarea id="content" name="content" required rows="4"
                      class="mt-1.5 block w-full rounded bg-black border border-industrial-border text-slate-100 px-4 py-3 text-sm focus:outline-none focus:ring-1 focus:ring-industrial-orange focus:border-transparent transition-all placeholder-slate-700 font-light"
                      placeholder="Tulis ulasan/testimoni dari pelanggan di sini...">{{ old('content', $testimonial->content) }}</textarea>
            @error('content')
                <p class="mt-1.5 text-xs text-red-550 font-semibold">{{ $message }}</p>
            @enderror
        </div>

        <!-- Status Toggle -->
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

        <!-- Action Buttons -->
        <div class="flex items-center justify-end gap-4 pt-4 border-t border-industrial-border font-mono text-[10px]">
            <a href="{{ route('admin.testimonials.index') }}" 
               class="px-5 py-3 border border-zinc-800 hover:border-zinc-650 text-slate-400 hover:text-slate-200 transition-colors uppercase font-bold tracking-widest rounded-none">
                [ BATAL ]
            </a>
            <button type="submit" 
                    class="stealth-btn-primary px-5 py-3 text-xs uppercase font-bold tracking-widest rounded-none">
                [ SIMPAN TESTIMONI ]
            </button>
        </div>
    </form>
</div>
@endsection
