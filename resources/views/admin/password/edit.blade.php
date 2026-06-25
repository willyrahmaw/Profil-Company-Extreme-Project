@extends('layouts.admin')

@section('title', 'Ganti Password Admin')

@section('content')
<div class="max-w-3xl mx-auto space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4">
        <div>
            <p class="text-xs font-bold uppercase tracking-[0.24em] text-industrial-orange mb-2">Keamanan Akun</p>
            <h1 class="text-3xl font-black text-slate-100 font-display uppercase">Ganti Password</h1>
            <p class="text-sm text-slate-400 mt-2">Perbarui password admin untuk menjaga akses panel tetap aman.</p>
        </div>
        <a href="{{ route('admin.dashboard') }}" class="stealth-btn-secondary inline-flex items-center justify-center px-4 py-2 rounded text-xs font-bold uppercase tracking-wider">
            Kembali
        </a>
    </div>

    <form action="{{ route('admin.password.update') }}" method="POST" class="stealth-card rounded p-5 sm:p-6 space-y-5">
        @csrf
        @method('PUT')

        <div>
            <label for="current_password" class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-2">Password Lama</label>
            <input
                id="current_password"
                name="current_password"
                type="password"
                autocomplete="current-password"
                required
                class="w-full rounded border border-zinc-800 bg-zinc-950 px-4 py-3 text-sm text-slate-200 outline-none transition focus:border-industrial-orange"
            >
            @error('current_password')
                <p class="mt-2 text-xs font-semibold text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <div class="grid gap-5 sm:grid-cols-2">
            <div>
                <label for="password" class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-2">Password Baru</label>
                <input
                    id="password"
                    name="password"
                    type="password"
                    autocomplete="new-password"
                    required
                    minlength="8"
                    class="w-full rounded border border-zinc-800 bg-zinc-950 px-4 py-3 text-sm text-slate-200 outline-none transition focus:border-industrial-orange"
                >
                @error('password')
                    <p class="mt-2 text-xs font-semibold text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password_confirmation" class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-2">Konfirmasi Password Baru</label>
                <input
                    id="password_confirmation"
                    name="password_confirmation"
                    type="password"
                    autocomplete="new-password"
                    required
                    minlength="8"
                    class="w-full rounded border border-zinc-800 bg-zinc-950 px-4 py-3 text-sm text-slate-200 outline-none transition focus:border-industrial-orange"
                >
            </div>
        </div>

        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 pt-2">
            <p class="text-xs text-slate-500">Gunakan minimal 8 karakter. Setelah disimpan, login berikutnya memakai password baru.</p>
            <button type="submit" class="stealth-btn-primary inline-flex items-center justify-center px-5 py-3 rounded text-xs font-bold uppercase tracking-wider">
                Simpan Password
            </button>
        </div>
    </form>
</div>
@endsection