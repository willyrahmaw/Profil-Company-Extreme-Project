@extends('layouts.admin')

@section('title', 'Pengaturan Website')

@section('content')
<div class="max-w-3xl mx-auto space-y-8">
    
    <!-- Breadcrumb -->
    <div class="flex items-center gap-2 text-[10px] font-semibold text-slate-500 uppercase tracking-widest">
        <span>Admin</span>
        <span>/</span>
        <span class="text-slate-400">Pengaturan Website</span>
    </div>

    <div>
        <h1 class="text-2xl font-bold tracking-tight text-slate-100 font-display uppercase">
            PENGATURAN IDENTITAS & SEO
        </h1>
        <p class="text-xs text-slate-450">
            Perbarui nama website, logo navigasi menu, favicon (avatar tab browser), serta konfigurasi kata kunci metadata SEO pencarian.
        </p>
    </div>

    @if(session('success'))
        <div class="p-4 bg-industrial-orange/10 border border-industrial-orange/30 text-industrial-orange text-xs font-semibold uppercase tracking-wider font-mono">
            [ STATUS: {{ session('success') }} ]
        </div>
    @endif

    <!-- Form Panel -->
    <form action="{{ route('admin.settings.update') }}" 
          method="POST" 
          enctype="multipart/form-data"
          class="bg-industrial-dark border border-industrial-border rounded-none p-6 sm:p-8 shadow-xl space-y-6">
        @csrf
        @method('PUT')

        <!-- Website Name & Meta Title Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Website Name -->
            <div>
                <label for="website_name" class="block text-[10px] font-semibold text-slate-450 uppercase tracking-wider">
                    Nama Website (Menu Brand)
                </label>
                <input type="text" id="website_name" name="website_name" required 
                       value="{{ old('website_name', $setting->website_name ?? 'Extreme Project') }}"
                       class="mt-1.5 block w-full rounded bg-black border border-industrial-border text-slate-100 px-4 py-3 text-sm focus:outline-none focus:ring-1 focus:ring-industrial-orange focus:border-transparent transition-all font-semibold"
                       placeholder="e.g. Extreme Project">
                @error('website_name')
                    <p class="mt-1.5 text-xs text-red-500 font-semibold">{{ $message }}</p>
                @enderror
            </div>

            <!-- Meta Title -->
            <div>
                <label for="meta_title" class="block text-[10px] font-semibold text-slate-455 uppercase tracking-wider">
                    Meta Title (Judul Tab Browser)
                </label>
                <input type="text" id="meta_title" name="meta_title" required 
                       value="{{ old('meta_title', $setting->meta_title ?? 'Extreme Project - Why Choose Me') }}"
                       class="mt-1.5 block w-full rounded bg-black border border-industrial-border text-slate-100 px-4 py-3 text-sm focus:outline-none focus:ring-1 focus:ring-industrial-orange focus:border-transparent transition-all font-semibold"
                       placeholder="e.g. Extreme Project - Premium Handmade Coil">
                @error('meta_title')
                    <p class="mt-1.5 text-xs text-red-500 font-semibold">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Meta Description -->
        <div>
            <label for="meta_description" class="block text-[10px] font-semibold text-slate-450 uppercase tracking-wider">
                Meta Description (Deskripsi SEO)
            </label>
            <textarea id="meta_description" name="meta_description" rows="3"
                      class="mt-1.5 block w-full rounded bg-black border border-industrial-border text-slate-100 px-4 py-3 text-sm focus:outline-none focus:ring-1 focus:ring-industrial-orange focus:border-transparent transition-all resize-none"
                      placeholder="e.g. Koleksi coil vape handmade premium dan kapas wicking organik 100% kimia bebas dari Extreme Project.">{{ old('meta_description', $setting->meta_description ?? '') }}</textarea>
            @error('meta_description')
                <p class="mt-1.5 text-xs text-red-550 font-semibold">{{ $message }}</p>
            @enderror
        </div>

        <!-- Meta Keywords -->
        <div>
            <label for="meta_keywords" class="block text-[10px] font-semibold text-slate-450 uppercase tracking-wider">
                Meta Keywords (Kata Kunci SEO, pisahkan dengan koma)
            </label>
            <textarea id="meta_keywords" name="meta_keywords" rows="2"
                      class="mt-1.5 block w-full rounded bg-black border border-industrial-border text-slate-100 px-4 py-3 text-sm focus:outline-none focus:ring-1 focus:ring-industrial-orange focus:border-transparent transition-all resize-none"
                      placeholder="e.g. extreme project, handmade coil, vape cotton, alien fused clapton">{{ old('meta_keywords', $setting->meta_keywords ?? '') }}</textarea>
            @error('meta_keywords')
                <p class="mt-1.5 text-xs text-red-550 font-semibold">{{ $message }}</p>
            @enderror
        </div>

        <!-- Image Upload Panel Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Favicon Upload -->
            <div class="p-4 bg-black/40 border border-industrial-border rounded-none space-y-4">
                <span class="text-[9px] font-mono text-industrial-orange font-bold uppercase tracking-widest">[ TAB_FAVICON_ICO ]</span>
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 border border-industrial-border flex items-center justify-center bg-black/60 overflow-hidden">
                        @if($setting && $setting->favicon_path)
                            <img src="{{ $setting->favicon_path }}" alt="Favicon" class="w-8 h-8 object-contain">
                        @else
                            <!-- Fallback standard favicon representation -->
                            <div class="text-zinc-650 font-mono text-[8px] tracking-tighter uppercase">[ ICO ]</div>
                        @endif
                    </div>
                    <div class="flex-grow">
                        <label class="block text-[9px] font-semibold text-slate-500 uppercase tracking-wider mb-1">Pilih File (.ico/.png, maks 1MB)</label>
                        <input type="file" name="favicon" accept=".ico,.png,.jpg,.jpeg"
                               class="block w-full text-xs text-zinc-400 file:mr-3 file:py-1.5 file:px-3 file:rounded file:border-0 file:text-[10px] file:font-semibold file:bg-zinc-800 file:text-white hover:file:bg-zinc-700 cursor-pointer">
                    </div>
                </div>
                @error('favicon')
                    <p class="text-xs text-red-550 font-semibold">{{ $message }}</p>
                @enderror
            </div>

            <!-- Logo Upload (Dark Theme Default) -->
            <div class="p-4 bg-black/40 border border-industrial-border rounded-none space-y-4">
                <span class="text-[9px] font-mono text-industrial-orange font-bold uppercase tracking-widest">[ DARK_THEME_LOGO ]</span>
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 border border-industrial-border flex items-center justify-center bg-black/60 overflow-hidden">
                        @if($setting && $setting->logo_path)
                            <img src="{{ $setting->logo_path }}" alt="Logo" class="w-10 h-10 object-contain">
                        @else
                            <!-- Dot fallback representing the industrial orange dot -->
                            <span class="w-2.5 h-2.5 bg-industrial-orange rounded-full shadow-[0_0_8px_#FF4081]"></span>
                        @endif
                    </div>
                    <div class="flex-grow">
                        <label class="block text-[9px] font-semibold text-slate-500 uppercase tracking-wider mb-1">Pilih File (.png/.svg/.jpg, maks 2MB)</label>
                        <input type="file" name="logo" accept=".png,.svg,.jpg,.jpeg,.webp"
                               class="block w-full text-xs text-zinc-400 file:mr-3 file:py-1.5 file:px-3 file:rounded file:border-0 file:text-[10px] file:font-semibold file:bg-zinc-800 file:text-white hover:file:bg-zinc-700 cursor-pointer">
                    </div>
                </div>
                @error('logo')
                    <p class="text-xs text-red-550 font-semibold">{{ $message }}</p>
                @enderror
            </div>

            <!-- Logo Light Theme Upload -->
            <div class="p-4 bg-black/40 border border-industrial-border rounded-none space-y-4">
                <span class="text-[9px] font-mono text-industrial-orange font-bold uppercase tracking-widest">[ LIGHT_THEME_LOGO ]</span>
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 border border-industrial-border flex items-center justify-center bg-white overflow-hidden">
                        @if($setting && $setting->logo_light_path)
                            <img src="{{ $setting->logo_light_path }}" alt="Logo Light" class="w-10 h-10 object-contain">
                        @else
                            <span class="w-2.5 h-2.5 bg-industrial-orange rounded-full shadow-[0_0_8px_#FF4081]"></span>
                        @endif
                    </div>
                    <div class="flex-grow">
                        <label class="block text-[9px] font-semibold text-slate-500 uppercase tracking-wider mb-1">Pilih File (.png/.svg/.jpg, maks 2MB)</label>
                        <input type="file" name="logo_light" accept=".png,.svg,.jpg,.jpeg,.webp"
                               class="block w-full text-xs text-zinc-400 file:mr-3 file:py-1.5 file:px-3 file:rounded file:border-0 file:text-[10px] file:font-semibold file:bg-zinc-800 file:text-white hover:file:bg-zinc-700 cursor-pointer">
                    </div>
                </div>
                @error('logo_light')
                    <p class="text-xs text-red-550 font-semibold">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- ════════════════════════════════════════
             OPEN GRAPH / SOCIAL MEDIA
        ════════════════════════════════════════ -->
        <div class="pt-2 border-t border-industrial-border">
            <p class="text-[9px] font-mono text-industrial-orange uppercase tracking-widest font-bold mb-4">[ OPEN_GRAPH — FACEBOOK / WHATSAPP / LINKEDIN ]</p>
            <div class="space-y-4">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- OG Title -->
                    <div>
                        <label for="og_title" class="block text-[10px] font-semibold text-slate-450 uppercase tracking-wider">OG Title</label>
                        <input type="text" id="og_title" name="og_title"
                               value="{{ old('og_title', $setting->og_title ?? '') }}"
                               class="mt-1.5 block w-full rounded bg-black border border-industrial-border text-slate-100 px-4 py-3 text-sm focus:outline-none focus:ring-1 focus:ring-industrial-orange transition-all"
                               placeholder="Judul saat dibagikan di sosmed (default: Meta Title)">
                    </div>

                    <!-- OG Type -->
                    <div>
                        <label for="og_type" class="block text-[10px] font-semibold text-slate-450 uppercase tracking-wider">OG Type</label>
                        <select id="og_type" name="og_type"
                                class="mt-1.5 block w-full rounded bg-black border border-industrial-border text-slate-100 px-4 py-3 text-sm focus:outline-none focus:ring-1 focus:ring-industrial-orange transition-all">
                            <option value="website" {{ old('og_type', $setting->og_type ?? 'website') === 'website' ? 'selected' : '' }}>website</option>
                            <option value="article" {{ old('og_type', $setting->og_type ?? '') === 'article' ? 'selected' : '' }}>article</option>
                            <option value="product" {{ old('og_type', $setting->og_type ?? '') === 'product' ? 'selected' : '' }}>product</option>
                        </select>
                    </div>
                </div>

                <!-- OG Description -->
                <div>
                    <label for="og_description" class="block text-[10px] font-semibold text-slate-450 uppercase tracking-wider">OG Description</label>
                    <textarea id="og_description" name="og_description" rows="2"
                              class="mt-1.5 block w-full rounded bg-black border border-industrial-border text-slate-100 px-4 py-3 text-sm focus:outline-none focus:ring-1 focus:ring-industrial-orange transition-all resize-none"
                              placeholder="Deskripsi saat dibagikan di sosmed (default: Meta Description)">{{ old('og_description', $setting->og_description ?? '') }}</textarea>
                </div>

                <!-- OG Image -->
                <div>
                    <label class="block text-[10px] font-semibold text-slate-450 uppercase tracking-wider mb-1.5">
                        OG Image (1200×630px recommended)
                    </label>
                    <div class="flex items-center gap-4 p-4 bg-black/40 border border-industrial-border rounded-none">
                        <div class="w-16 h-12 border border-industrial-border flex items-center justify-center bg-black/60 overflow-hidden flex-shrink-0">
                            @if($setting && $setting->og_image)
                                <img src="{{ $setting->og_image }}" alt="OG Preview" class="w-full h-full object-contain">
                            @else
                                <div class="text-zinc-650 font-mono text-[8px] tracking-tighter uppercase">[ NO IMAGE ]</div>
                            @endif
                        </div>
                        <div class="flex-grow">
                            <label class="block text-[9px] font-semibold text-slate-500 uppercase tracking-wider mb-1">Pilih File (.jpg/.png/.webp, maks 2MB)</label>
                            <input type="file" name="og_image" accept=".png,.jpg,.jpeg,.webp"
                                   class="block w-full text-xs text-zinc-400 file:mr-3 file:py-1.5 file:px-3 file:rounded file:border-0 file:text-[10px] file:font-semibold file:bg-zinc-800 file:text-white hover:file:bg-zinc-700 cursor-pointer">
                        </div>
                    </div>
                    @error('og_image')
                        <p class="mt-1.5 text-xs text-red-500 font-semibold">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <!-- ════════════════════════════════════════
             TWITTER CARD
        ════════════════════════════════════════ -->
        <div class="pt-2 border-t border-industrial-border">
            <p class="text-[9px] font-mono text-industrial-orange uppercase tracking-widest font-bold mb-4">[ TWITTER_CARD — X / TWITTER ]</p>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                <div>
                    <label for="twitter_card" class="block text-[10px] font-semibold text-slate-450 uppercase tracking-wider">Card Type</label>
                    <select id="twitter_card" name="twitter_card"
                            class="mt-1.5 block w-full rounded bg-black border border-industrial-border text-slate-100 px-4 py-3 text-sm focus:outline-none focus:ring-1 focus:ring-industrial-orange transition-all">
                        <option value="summary_large_image" {{ old('twitter_card', $setting->twitter_card ?? 'summary_large_image') === 'summary_large_image' ? 'selected' : '' }}>summary_large_image</option>
                        <option value="summary" {{ old('twitter_card', $setting->twitter_card ?? '') === 'summary' ? 'selected' : '' }}>summary</option>
                    </select>
                </div>

                <div>
                    <label for="twitter_site" class="block text-[10px] font-semibold text-slate-450 uppercase tracking-wider">Twitter @handle</label>
                    <input type="text" id="twitter_site" name="twitter_site"
                           value="{{ old('twitter_site', $setting->twitter_site ?? '') }}"
                           class="mt-1.5 block w-full rounded bg-black border border-industrial-border text-slate-100 px-4 py-3 text-sm focus:outline-none focus:ring-1 focus:ring-industrial-orange transition-all font-mono"
                           placeholder="@extremeproject">
                </div>

                <div>
                    <label for="twitter_image" class="block text-[10px] font-semibold text-slate-450 uppercase tracking-wider">Twitter Image URL</label>
                    <input type="url" id="twitter_image" name="twitter_image"
                           value="{{ old('twitter_image', $setting->twitter_image ?? '') }}"
                           class="mt-1.5 block w-full rounded bg-black border border-industrial-border text-slate-100 px-4 py-3 text-sm focus:outline-none focus:ring-1 focus:ring-industrial-orange transition-all font-mono"
                           placeholder="(default: sama dengan OG Image)">
                </div>
            </div>
        </div>

        <!-- ════════════════════════════════════════
             TECHNICAL SEO
        ════════════════════════════════════════ -->
        <div class="pt-2 border-t border-industrial-border">
            <p class="text-[9px] font-mono text-industrial-orange uppercase tracking-widest font-bold mb-4">[ TECHNICAL_SEO ]</p>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                <div>
                    <label for="canonical_url" class="block text-[10px] font-semibold text-slate-450 uppercase tracking-wider">Canonical URL</label>
                    <input type="url" id="canonical_url" name="canonical_url"
                           value="{{ old('canonical_url', $setting->canonical_url ?? '') }}"
                           class="mt-1.5 block w-full rounded bg-black border border-industrial-border text-slate-100 px-4 py-3 text-sm focus:outline-none focus:ring-1 focus:ring-industrial-orange transition-all font-mono"
                           placeholder="https://yourdomain.com (default: APP_URL)">
                </div>

                <div>
                    <label for="robots" class="block text-[10px] font-semibold text-slate-450 uppercase tracking-wider">Robots</label>
                    <select id="robots" name="robots"
                            class="mt-1.5 block w-full rounded bg-black border border-industrial-border text-slate-100 px-4 py-3 text-sm focus:outline-none focus:ring-1 focus:ring-industrial-orange transition-all">
                        <option value="index, follow" {{ old('robots', $setting->robots ?? 'index, follow') === 'index, follow' ? 'selected' : '' }}>index, follow (recommended)</option>
                        <option value="noindex, nofollow" {{ old('robots', $setting->robots ?? '') === 'noindex, nofollow' ? 'selected' : '' }}>noindex, nofollow</option>
                        <option value="index, nofollow" {{ old('robots', $setting->robots ?? '') === 'index, nofollow' ? 'selected' : '' }}>index, nofollow</option>
                        <option value="noindex, follow" {{ old('robots', $setting->robots ?? '') === 'noindex, follow' ? 'selected' : '' }}>noindex, follow</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- ════════════════════════════════════════
             BUSINESS / SCHEMA.ORG
        ════════════════════════════════════════ -->
        <div class="pt-2 border-t border-industrial-border">
            <p class="text-[9px] font-mono text-industrial-orange uppercase tracking-widest font-bold mb-4">[ SCHEMA_ORG — STRUCTURED DATA / RICH RESULTS ]</p>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                <div>
                    <label for="business_name" class="block text-[10px] font-semibold text-slate-450 uppercase tracking-wider">Business Name</label>
                    <input type="text" id="business_name" name="business_name"
                           value="{{ old('business_name', $setting->business_name ?? '') }}"
                           class="mt-1.5 block w-full rounded bg-black border border-industrial-border text-slate-100 px-4 py-3 text-sm focus:outline-none focus:ring-1 focus:ring-industrial-orange transition-all"
                           placeholder="Extreme Project">
                </div>

                <div>
                    <label for="business_type" class="block text-[10px] font-semibold text-slate-450 uppercase tracking-wider">Business Type</label>
                    <select id="business_type" name="business_type"
                            class="mt-1.5 block w-full rounded bg-black border border-industrial-border text-slate-100 px-4 py-3 text-sm focus:outline-none focus:ring-1 focus:ring-industrial-orange transition-all">
                        <option value="LocalBusiness" {{ old('business_type', $setting->business_type ?? 'LocalBusiness') === 'LocalBusiness' ? 'selected' : '' }}>LocalBusiness</option>
                        <option value="Store" {{ old('business_type', $setting->business_type ?? '') === 'Store' ? 'selected' : '' }}>Store</option>
                        <option value="Organization" {{ old('business_type', $setting->business_type ?? '') === 'Organization' ? 'selected' : '' }}>Organization</option>
                    </select>
                </div>

                <div>
                    <label for="business_phone" class="block text-[10px] font-semibold text-slate-450 uppercase tracking-wider">No. Telepon</label>
                    <input type="text" id="business_phone" name="business_phone"
                           value="{{ old('business_phone', $setting->business_phone ?? '') }}"
                           class="mt-1.5 block w-full rounded bg-black border border-industrial-border text-slate-100 px-4 py-3 text-sm focus:outline-none focus:ring-1 focus:ring-industrial-orange transition-all font-mono"
                           placeholder="+62812xxxxxxxx">
                </div>

                <div>
                    <label for="business_city" class="block text-[10px] font-semibold text-slate-450 uppercase tracking-wider">Kota</label>
                    <input type="text" id="business_city" name="business_city"
                           value="{{ old('business_city', $setting->business_city ?? '') }}"
                           class="mt-1.5 block w-full rounded bg-black border border-industrial-border text-slate-100 px-4 py-3 text-sm focus:outline-none focus:ring-1 focus:ring-industrial-orange transition-all"
                           placeholder="Jakarta">
                </div>
            </div>
        </div>

        <!-- ════════════════════════════════════════
             GOOGLE ANALYTICS
        ════════════════════════════════════════ -->
        <div class="pt-2 border-t border-industrial-border">
            <p class="text-[9px] font-mono text-industrial-orange uppercase tracking-widest font-bold mb-4">[ GOOGLE_ANALYTICS ]</p>
            <div>
                <label for="google_analytics_id" class="block text-[10px] font-semibold text-slate-450 uppercase tracking-wider">
                    Google Analytics Measurement ID
                </label>
                <input type="text" id="google_analytics_id" name="google_analytics_id"
                       value="{{ old('google_analytics_id', $setting->google_analytics_id ?? '') }}"
                       class="mt-1.5 block w-full rounded bg-black border border-industrial-border text-slate-100 px-4 py-3 text-sm focus:outline-none focus:ring-1 focus:ring-industrial-orange transition-all font-mono"
                       placeholder="G-XXXXXXXXXX">
                <p class="mt-1 text-[9px] text-zinc-600">Kosongkan jika tidak menggunakan Google Analytics.</p>
            </div>
        </div>

        <!-- ════════════════════════════════════════
             WHATSAPP INVOICE TEMPLATE
        ════════════════════════════════════════ -->
        <div class="pt-2 border-t border-industrial-border">
            <p class="text-[9px] font-mono text-industrial-orange uppercase tracking-widest font-bold mb-4">[ WHATSAPP_INVOICE_TEMPLATE ]</p>
            <div>
                <label for="wa_template" class="block text-[10px] font-semibold text-slate-450 uppercase tracking-wider">
                    Template Pesan WhatsApp
                </label>
                <textarea id="wa_template" name="wa_template" rows="8"
                          class="mt-1.5 block w-full rounded bg-black border border-industrial-border text-slate-100 px-4 py-3 text-sm focus:outline-none focus:ring-1 focus:ring-industrial-orange transition-all font-mono"
                          placeholder="*INVOICE ORDER - EXTREME PROJECT*&#10;========================================&#10;&#10;*Nama Penerima:* {buyer_name}&#10;*Produk:* {product_title} ({price})&#10;*Spesifikasi:* {specs}&#10;*Jumlah:* {quantity} Pcs&#10;*Total Pembayaran:* {total_price}&#10;*Alamat Pengiriman:* {buyer_address}&#10;&#10;========================================">{{ old('wa_template', $setting->wa_template ?? '') }}</textarea>
                
                <!-- Helper Guide for parameters -->
                <div class="mt-3 p-4 bg-black/40 border border-industrial-border rounded-none space-y-2 text-[10px] text-slate-400 font-mono">
                    <span class="text-industrial-orange font-bold uppercase tracking-wider text-[8px]">[ PARAMETER_TAGS_GUIDE ]</span>
                    <p class="text-slate-500 text-[9px] leading-relaxed">
                        Anda dapat menyusun pesan WhatsApp kustom dengan menyisipkan tag parameter berikut. Tag ini akan otomatis digantikan oleh sistem dengan data asli pembeli saat order dikirim:
                    </p>
                    <div class="grid grid-cols-2 gap-2 mt-2">
                        <div>
                            <code class="text-industrial-orange font-bold">{buyer_name}</code>
                            <span class="text-[9px] text-slate-500 ml-1.5">— Nama pembeli</span>
                        </div>
                        <div>
                            <code class="text-industrial-orange font-bold">{buyer_address}</code>
                            <span class="text-[9px] text-slate-500 ml-1.5">— Alamat pengiriman</span>
                        </div>
                        <div>
                            <code class="text-industrial-orange font-bold">{product_title}</code>
                            <span class="text-[9px] text-slate-500 ml-1.5">— Nama produk</span>
                        </div>
                        <div>
                            <code class="text-industrial-orange font-bold">{price}</code>
                            <span class="text-[9px] text-slate-500 ml-1.5">— Harga satuan produk</span>
                        </div>
                        <div>
                            <code class="text-industrial-orange font-bold">{quantity}</code>
                            <span class="text-[9px] text-slate-500 ml-1.5">— Jumlah unit ordered</span>
                        </div>
                        <div>
                            <code class="text-industrial-orange font-bold">{total_price}</code>
                            <span class="text-[9px] text-slate-500 ml-1.5">— Total harga (qty × price)</span>
                        </div>
                        <div class="col-span-2">
                            <code class="text-industrial-orange font-bold">{specs}</code>
                            <span class="text-[9px] text-slate-500 ml-1.5">— Daftar parameter spesifikasi produk (koma-terpisah)</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Actions -->
        <div class="flex items-center justify-end gap-4 pt-4 border-t border-industrial-border">
            <button type="submit"
                    class="stealth-btn-primary px-8 py-3 text-xs font-bold uppercase tracking-widest font-display flex items-center gap-2">
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection
