<!DOCTYPE html>
<html lang="id" class="h-full bg-black text-slate-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Coil & Cotton Vape</title>
    
    <!-- Google Fonts: Space Grotesk & Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@550;700;900&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS CDN -->
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
                            black: '#000000',
                            dark: '#0a0a0c',
                            orange: '#FF4081',
                            orangeHover: '#E91E63',
                            border: '#1c1c22',
                        }
                    }
                }
            }
        }
    </script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #000000;
            background-image: radial-gradient(circle at center, rgba(255, 64, 129, 0.04), transparent 500px);
        }
        h1, h2, h3, h4, h5, h6, .font-display {
            font-family: 'Space Grotesk', sans-serif;
            letter-spacing: -0.02em;
        }
    </style>
</head>
<body class="h-full flex flex-col justify-center py-12 sm:px-6 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-md text-center">
        <!-- Logo -->
        <span class="text-2xl font-black tracking-tighter text-slate-100 font-display flex items-center justify-center gap-1.5 uppercase">
            <span class="w-3.5 h-3.5 bg-industrial-orange shadow-[0_0_8px_#FF4081]"></span>
            EXTREME PROJECT
        </span>
        <h2 class="mt-3 text-xs font-bold tracking-widest text-industrial-orange uppercase font-display">
            PORTAL OTORISASI
        </h2>
        <p class="mt-1.5 text-xs text-slate-500">
            Sistem pengaman otorisasi dasbor manajer.
        </p>
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md px-4">
        <div class="bg-industrial-dark py-8 px-6 border border-industrial-border rounded sm:px-10 shadow-2xl relative overflow-hidden">
            
            @env('local')
            {{-- ⚠️ Hanya tampil di local environment — TIDAK tampil di production --}}
            <div class="mb-6 p-4 rounded bg-black border border-industrial-orange/20 text-xs text-slate-400">
                <div class="flex items-center text-industrial-orange font-bold mb-1 tracking-widest uppercase font-display text-[9px]">
                    KUNCI AKSES MASUK (DEV ONLY)
                </div>
                <p class="mt-1">Email: <span class="text-slate-200 font-mono select-all font-semibold">admin@vape.com</span></p>
                <p>Password: <span class="text-slate-200 font-mono select-all font-semibold">password</span></p>
            </div>
            @endenv

            <!-- Validation Errors -->
            @if ($errors->any())
                <div class="mb-6 p-3 rounded bg-red-950/20 border border-red-500/20 text-red-400 text-xs">
                    <ul class="list-disc pl-5 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form class="space-y-6" action="{{ route('login') }}" method="POST">
                @csrf

                <!-- Email Address -->
                <div>
                    <label for="email" class="block text-[10px] font-bold text-slate-450 uppercase tracking-widest">
                        Alamat Email Otoritas
                    </label>
                    <div class="mt-1.5">
                        <input id="email" name="email" type="email" autocomplete="email" required value="{{ old('email') }}"
                               class="block w-full rounded bg-black border border-industrial-border text-slate-100 px-4 py-3 text-sm focus:outline-none focus:ring-1 focus:ring-industrial-orange focus:border-transparent transition-all placeholder-slate-800 font-medium"
                               placeholder="admin@vape.com">
                    </div>
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-[10px] font-bold text-slate-455 uppercase tracking-widest">
                        Password Kunci
                    </label>
                    <div class="mt-1.5">
                        <input id="password" name="password" type="password" autocomplete="current-password" required
                               class="block w-full rounded bg-black border border-industrial-border text-slate-100 px-4 py-3 text-sm focus:outline-none focus:ring-1 focus:ring-industrial-orange focus:border-transparent transition-all placeholder-slate-800 font-medium"
                               placeholder="••••••••">
                    </div>
                </div>

                <!-- Remember Me -->
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input id="remember" name="remember" type="checkbox"
                               class="h-4 w-4 rounded bg-black border-industrial-border text-industrial-orange focus:ring-industrial-orange focus:ring-offset-black">
                        <label for="remember" class="ml-2 block text-xs text-slate-405">
                            Ingat login sesi
                        </label>
                    </div>
                </div>

                <!-- Submit Button -->
                <div>
                    <button type="submit"
                            class="w-full flex justify-center py-3 px-4 rounded text-xs font-bold tracking-widest text-white bg-industrial-orange hover:bg-industrial-orangeHover hover:shadow-[0_0_20px_0px_rgba(255,85,0,0.35)] focus:outline-none transition-all uppercase font-display">
                        Masuk Ke Terminal Dasbor
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
