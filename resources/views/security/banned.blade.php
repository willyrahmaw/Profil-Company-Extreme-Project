<!DOCTYPE html>
<html lang="id" class="h-full bg-black text-slate-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Akses Diblokir - Extreme Project</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                        display: ['Space Grotesk', 'sans-serif'],
                    },
                    colors: {
                        industrial: {
                            orange: '#FF4081',
                            dark: '#0a0a0c',
                            border: '#1c1c22',
                        }
                    }
                }
            }
        }
    </script>
</head>
<body class="h-full min-h-screen flex items-center justify-center px-4 bg-black">
    <main class="w-full max-w-lg border border-red-500/30 bg-industrial-dark p-8 text-center shadow-2xl">
        <div class="mx-auto mb-6 flex h-14 w-14 items-center justify-center border border-red-500/40 bg-red-950/20 text-red-400">
            <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 9v3.75m0 3.75h.008v.008H12V16.5zm9-4.5a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </div>

        <p class="text-[10px] font-bold uppercase tracking-[0.28em] text-industrial-orange">Security Lock</p>
        <h1 class="mt-3 text-3xl font-black uppercase tracking-tight text-white">Akses Diblokir</h1>

        @if($ban)
            <p class="mt-4 text-sm leading-relaxed text-slate-400">
                IP <span class="font-mono font-bold text-slate-200">{{ $ban['ip'] }}</span> dibanned sementara karena terlalu banyak percobaan login gagal.
            </p>
            <div class="mt-6 grid grid-cols-1 gap-3 sm:grid-cols-3">
                <div class="border border-industrial-border bg-black p-4">
                    <p class="text-[9px] uppercase tracking-widest text-slate-500">Level</p>
                    <p class="mt-1 text-xl font-black text-red-400">{{ $ban['level'] }}</p>
                </div>
                <div class="border border-industrial-border bg-black p-4 sm:col-span-2">
                    <p class="text-[9px] uppercase tracking-widest text-slate-500">Buka Kembali</p>
                    <p class="mt-1 text-sm font-bold text-slate-200">{{ $ban['banned_until']->timezone(config('app.timezone'))->format('d M Y H:i') }}</p>
                </div>
            </div>
            <p class="mt-5 text-xs text-slate-500">
                Sisa waktu sekitar {{ ceil($ban['remaining_seconds'] / 60) }} menit.
            </p>
        @else
            <p class="mt-4 text-sm leading-relaxed text-slate-400">
                IP ini tidak sedang dibanned. Silakan kembali ke halaman utama.
            </p>
            <a href="{{ route('home') }}" class="mt-6 inline-flex items-center justify-center bg-industrial-orange px-5 py-3 text-xs font-bold uppercase tracking-widest text-white">
                Kembali
            </a>
        @endif
    </main>
</body>
</html>