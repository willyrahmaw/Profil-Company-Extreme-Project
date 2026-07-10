<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <!-- Initial theme loader to prevent flash of light/dark -->
    <script>
        (function() {
            try {
                const theme = localStorage.getItem('theme') || 'light';
                if (theme === 'dark') {
                    document.documentElement.classList.add('dark');
                } else {
                    document.documentElement.classList.remove('dark');
                }
            } catch (e) {
                document.documentElement.classList.remove('dark');
            }
        })();
    </script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- ═══════════════════════════════════════════════
         CORE SEO
    ═══════════════════════════════════════════════ --}}
    @php
        $seo = $siteSettings;
        $siteUrl    = config('app.url');
        $siteName   = $seo->website_name    ?? 'Extreme Project';
        $pageTitle  = $seo->meta_title      ?? 'Extreme Project – Coil & Cotton Vape Premium Indonesia';
        $pageDesc   = $seo->meta_description ?? 'Coil handmade premium & organic cotton 100% bebas kimia dari Extreme Project. Dibuat untuk vaper yang serius dengan flavor maksimal dan hambatan stabil.';
        $keywords   = $seo->meta_keywords   ?? 'extreme project, handmade coil, vape cotton, alien fused clapton, coil building indonesia, organic cotton vape, coil ni80, coil kanthal';
        $canonical  = $seo->canonical_url   ?? $siteUrl;
        $robots     = $seo->robots          ?? 'index, follow';
        $ogImage    = ($seo && $seo->og_image) ? (strpos($seo->og_image, 'http') === 0 ? $seo->og_image : url($seo->og_image)) : $siteUrl . '/images/profil/og-default.jpg';
        $ogTitle    = $seo->og_title        ?? $pageTitle;
        $ogDesc     = $seo->og_description  ?? $pageDesc;
        $ogType     = $seo->og_type         ?? 'website';
        $twCard     = $seo->twitter_card    ?? 'summary_large_image';
        $twSite     = $seo->twitter_site    ?? '';
        $twImage    = ($seo && $seo->twitter_image) ? (strpos($seo->twitter_image, 'http') === 0 ? $seo->twitter_image : url($seo->twitter_image)) : $ogImage;
        $bizName    = $seo->business_name   ?? $siteName;
        $bizType    = $seo->business_type   ?? 'LocalBusiness';
        $bizPhone   = $seo->business_phone  ?? '';
        $bizCity    = $seo->business_city   ?? 'Indonesia';
        $bizCountry = $seo->business_country ?? 'ID';
        $gaId       = $seo->google_analytics_id ?? '';
    @endphp

    <title>{{ $pageTitle }}</title>
    <meta name="description"         content="{{ $pageDesc }}">
    <meta name="keywords"            content="{{ $keywords }}">
    <meta name="robots"              content="{{ $robots }}">
    <meta name="author"              content="{{ $siteName }}">
    <meta name="language"            content="id">
    <meta name="revisit-after"       content="7 days">
    <link rel="canonical"            href="{{ $canonical }}">

    {{-- ═══════════════════════════════════════════════
         OPEN GRAPH (Facebook, WhatsApp, LinkedIn)
    ═══════════════════════════════════════════════ --}}
    <meta property="og:type"         content="{{ $ogType }}">
    <meta property="og:url"          content="{{ $canonical }}">
    <meta property="og:site_name"    content="{{ $siteName }}">
    <meta property="og:title"        content="{{ $ogTitle }}">
    <meta property="og:description"  content="{{ $ogDesc }}">
    <meta property="og:image"        content="{{ $ogImage }}">
    <meta property="og:image:width"  content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:locale"       content="id_ID">

    {{-- ═══════════════════════════════════════════════
         TWITTER CARD
    ═══════════════════════════════════════════════ --}}
    <meta name="twitter:card"        content="{{ $twCard }}">
    <meta name="twitter:title"       content="{{ $ogTitle }}">
    <meta name="twitter:description" content="{{ $ogDesc }}">
    <meta name="twitter:image"       content="{{ $twImage }}">
    @if($twSite)
    <meta name="twitter:site"        content="{{ $twSite }}">
    @endif

    {{-- ═══════════════════════════════════════════════
         FAVICON & APPLE TOUCH
    ═══════════════════════════════════════════════ --}}
    @if($seo && $seo->favicon_path)
    <link rel="icon"             type="image/x-icon" href="{{ $seo->favicon_path }}">
    <link rel="shortcut icon"    type="image/x-icon" href="{{ $seo->favicon_path }}">
    <link rel="apple-touch-icon"                      href="{{ $seo->favicon_path }}">
    @endif

    {{-- ═══════════════════════════════════════════════
         JSON-LD STRUCTURED DATA (LocalBusiness)
    ═══════════════════════════════════════════════ --}}
    @php
        $schemaLogo = ($seo && $seo->logo_path) ? $seo->logo_path : $siteUrl . '/images/profil/logo.png';
        $schemaData = [
            '@context'    => 'https://schema.org',
            '@type'       => $bizType,
            'name'        => $bizName,
            'url'         => $siteUrl,
            'logo'        => $schemaLogo,
            'image'       => $ogImage,
            'description' => $pageDesc,
            'address'     => [
                '@type'           => 'PostalAddress',
                'addressLocality' => $bizCity,
                'addressCountry'  => $bizCountry,
            ],
            'sameAs'      => [],
            'potentialAction' => [
                '@type'       => 'SearchAction',
                'target'      => $siteUrl . '/?q={search_term_string}',
                'query-input' => 'required name=search_term_string',
            ],
        ];
        if ($bizPhone) {
            $schemaData['telephone'] = $bizPhone;
        }
    @endphp
    <script type="application/ld+json">{!! json_encode($schemaData, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}</script>

    {{-- ═══════════════════════════════════════════════
         GOOGLE FONTS
    ═══════════════════════════════════════════════ --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://cdn.jsdelivr.net">
    <link rel="dns-prefetch" href="https://fonts.googleapis.com">
    <link rel="dns-prefetch" href="https://fonts.gstatic.com" crossorigin>
    <link rel="dns-prefetch" href="https://cdn.jsdelivr.net">
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;700;900&family=Inter:wght@300;400;500;600;700&family=Share+Tech+Mono&display=swap" rel="stylesheet">

    {{-- ═══════════════════════════════════════════════
         TAILWIND CSS CDN
    ═══════════════════════════════════════════════ --}}
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <style type="text/tailwindcss">
        @theme {
            --font-sans: 'Inter', sans-serif;
            --font-display: 'Space Grotesk', sans-serif;
            --font-mono: 'Share Tech Mono', monospace;

            --color-industrial-black: #000000;
            --color-industrial-dark: #07070a;
            --color-industrial-light: #0e0e12;
            --color-industrial-orange: #FF4081;
            --color-industrial-orangeHover: #E91E63;
            --color-industrial-border: #1b1b22;
            --color-industrial-borderMuted: #0d0d12;
        }

        @custom-variant dark (&:where(.dark, .dark *));
    </style>

    {{-- ═══════════════════════════════════════════════
         ASSETS
    ═══════════════════════════════════════════════ --}}
    {{-- Preload Above-the-fold Critical Assets --}}
    @if($seo && $seo->logo_path)
    <link rel="preload" as="image" href="{{ $seo->logo_path }}" fetchpriority="high">
    @endif
    @if($seo && $seo->logo_light_path)
    <link rel="preload" as="image" href="{{ $seo->logo_light_path }}" fetchpriority="high">
    @endif
    <link rel="preload" as="image" href="{{ asset('images/profil/ohm.png') }}" fetchpriority="high">
    <link rel="preload" as="image" href="{{ asset('images/profil/cotton.png') }}" fetchpriority="high">

    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
    <script src="{{ asset('js/welcome.js') }}" defer></script>

    {{-- ═══════════════════════════════════════════════
         ALPINE.JS
    ═══════════════════════════════════════════════ --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    {{-- ═══════════════════════════════════════════════
         GOOGLE ANALYTICS
    ═══════════════════════════════════════════════ --}}
    @if($gaId)
    <script async src="https://www.googletagmanager.com/gtag/js?id={{ $gaId }}"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', '{{ $gaId }}');
    </script>
    @endif

</head>

<body class="min-h-screen flex flex-col justify-between overflow-x-hidden bg-slate-50 dark:bg-black text-slate-900 dark:text-slate-100 transition-colors duration-300"
    x-data="welcomeApp('{{ $defaultWaUrl ?? 'https://wa.me/628123456789' }}', {{ ($hasActiveEvent ?? false) ? 'true' : 'false' }}, {{ json_encode($siteSettings->wa_template ?? '') }})">

    @yield('content')

    @include('partials.order-modal')
    @include('partials.event-modal')
    @include('partials.footer')

</body>

</html>
