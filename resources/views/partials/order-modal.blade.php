    <!-- Order Form Slide-Over Drawer -->
    <div x-show="orderModalOpen"
        x-cloak
        class="fixed inset-0 z-50 overflow-hidden"
        @keydown.window.escape="orderModalOpen = false"
        role="dialog"
        aria-modal="true">

        <!-- Backdrop -->
        <div x-show="orderModalOpen"
            x-transition:enter="transition-opacity ease-in-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition-opacity ease-in-out duration-350"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="absolute inset-0 bg-black/60 backdrop-blur-sm transition-opacity"
            @click="orderModalOpen = false"></div>

        <!-- Panel container -->
        <div class="fixed inset-y-0 right-0 pl-10 max-w-full flex">
            <!-- Slide-over panel -->
            <div x-show="orderModalOpen"
                x-transition:enter="transform transition ease-in-out duration-300 sm:duration-500"
                x-transition:enter-start="translate-x-full"
                x-transition:enter-end="translate-x-0"
                x-transition:leave="transform transition ease-in-out duration-300 sm:duration-500"
                x-transition:leave-start="translate-x-0"
                x-transition:leave-end="translate-x-full"
                class="w-screen max-w-md bg-white dark:bg-zinc-900 border-l border-zinc-200 dark:border-zinc-800 shadow-2xl flex flex-col justify-between transition-colors duration-300 relative"
                @click.away="orderModalOpen = false">
                
                <!-- Tech accents -->
                <div class="absolute -top-px -left-px w-3 h-3 border-t border-l border-industrial-orange"></div>
                <div class="absolute -bottom-px -left-px w-3 h-3 border-b border-l border-industrial-orange"></div>

                <!-- Form wrapping the entire body & footer -->
                <form @submit.prevent="sendToWhatsapp()" class="h-full flex flex-col justify-between overflow-hidden">
                    <!-- Main Drawer Content (Scrollable) -->
                    <div class="flex-1 overflow-y-auto p-6 sm:p-8 space-y-6">
                        <!-- Header -->
                        <div class="border-b border-zinc-200 dark:border-zinc-800/80 pb-4 flex justify-between items-start">
                            <div>
                                <span class="text-[8px] font-display text-industrial-orange font-bold uppercase tracking-widest">[ KERANJANG_BELANJA // CART_DRAWER ]</span>
                                <h3 class="text-lg font-bold text-zinc-950 dark:text-white uppercase tracking-wide mt-1 font-display">KERANJANG BELANJA</h3>
                            </div>
                            <button type="button" @click="orderModalOpen = false" class="text-zinc-400 hover:text-zinc-900 dark:text-zinc-500 dark:hover:text-white transition-colors">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>

                        <!-- Form Inputs -->
                        <div class="space-y-4">
                            <!-- Nama Penerima -->
                            <div>
                                <label for="buyer_name" class="block text-[10px] font-semibold text-zinc-550 dark:text-zinc-400 uppercase tracking-wider mb-1.5 font-mono">
                                    Nama Penerima
                                </label>
                                <input type="text" id="buyer_name" x-model="buyerName" required
                                    class="block w-full rounded-lg bg-zinc-50 dark:bg-black border border-zinc-200 dark:border-zinc-800 text-zinc-900 dark:text-slate-100 px-4 py-2.5 text-xs focus:outline-none focus:ring-1 focus:ring-industrial-orange focus:border-transparent transition-all placeholder-zinc-400 dark:placeholder-zinc-700 font-semibold"
                                    placeholder="Masukkan nama lengkap Anda">
                            </div>

                            <!-- Alamat Pengiriman -->
                            <div>
                                <label for="buyer_address" class="block text-[10px] font-semibold text-zinc-550 dark:text-zinc-400 uppercase tracking-wider mb-1.5 font-mono">
                                    Alamat Lengkap Pengiriman
                                </label>
                                <textarea id="buyer_address" x-model="buyerAddress" required rows="3"
                                    class="block w-full rounded-lg bg-zinc-50 dark:bg-black border border-zinc-200 dark:border-zinc-800 text-zinc-900 dark:text-slate-100 px-4 py-2.5 text-xs focus:outline-none focus:ring-1 focus:ring-industrial-orange focus:border-transparent transition-all placeholder-zinc-400 dark:placeholder-zinc-700 font-semibold resize-none"
                                    placeholder="Masukkan alamat lengkap (jalan, nomor rumah, RT/RW, kecamatan, kabupaten, kode pos)"></textarea>
                            </div>
                        </div>

                        <!-- Cart Items List -->
                        <div class="space-y-3">
                            <label class="block text-[10px] font-semibold text-zinc-550 dark:text-zinc-400 uppercase tracking-wider mb-1 font-mono">
                                Daftar Belanjaan Anda
                            </label>
                            
                            <div class="border border-zinc-200 dark:border-zinc-800 divide-y divide-zinc-200 dark:divide-zinc-800 max-h-64 overflow-y-auto bg-zinc-50/50 dark:bg-black/30 rounded-lg">
                                <template x-for="item in cart" :key="item.id">
                                    <div class="p-3 flex items-center gap-3">
                                        <!-- Thumbnail -->
                                        <div class="w-10 h-10 bg-white dark:bg-black border border-zinc-200 dark:border-zinc-800 flex items-center justify-center overflow-hidden rounded flex-shrink-0">
                                            <img :src="item.image" alt="Item Preview" class="h-full w-full object-contain">
                                        </div>
                                        
                                        <!-- Item Info -->
                                        <div class="flex-grow min-w-0">
                                            <div class="text-xs font-bold text-zinc-950 dark:text-white truncate" x-text="item.title"></div>
                                            <div class="text-[10px] text-zinc-500 font-mono mt-0.5" x-text="'Rp ' + new Intl.NumberFormat('id-ID').format(item.price)"></div>
                                            
                                            <!-- Direct purchase links per product -->
                                            <div class="flex flex-wrap items-center gap-x-2 gap-y-1 mt-1.5" x-show="item.marketplace_urls && Object.values(item.marketplace_urls).some(url => url && url !== '')">
                                                <span class="text-[8px] text-zinc-400 dark:text-zinc-500 font-mono tracking-wider font-semibold">BELI INSTAN:</span>
                                                <template x-for="[platform, url] in Object.entries(item.marketplace_urls)" :key="platform">
                                                    <template x-if="url">
                                                        <a :href="url" target="_blank" 
                                                            :class="{
                                                                'text-orange-500 hover:text-orange-600': platform === 'shopee',
                                                                'text-green-500 hover:text-green-600': platform === 'tokopedia',
                                                                'text-pink-550 hover:text-pink-600': platform === 'tiktok',
                                                                'text-blue-500 hover:text-blue-600': platform === 'blibli',
                                                                'text-indigo-450 hover:text-indigo-550': platform === 'toco',
                                                                'text-zinc-400 hover:text-zinc-500': !['shopee', 'tokopedia', 'tiktok', 'blibli', 'toco'].includes(platform)
                                                            }"
                                                            class="text-[9px] font-black hover:underline transition-colors uppercase font-mono tracking-wide"
                                                            x-text="platform">
                                                        </a>
                                                    </template>
                                                </template>
                                            </div>
                                        </div>
                                        
                                        <!-- Qty Modifiers -->
                                        <div class="flex items-center gap-2 flex-shrink-0">
                                            <button type="button" @click="updateCartQty(item.id, item.quantity - 1)"
                                                class="w-6 h-6 rounded bg-zinc-200/60 dark:bg-zinc-800 border border-zinc-300/80 dark:border-zinc-700 text-zinc-800 dark:text-white flex items-center justify-center font-bold text-xs hover:bg-zinc-300 dark:hover:bg-zinc-700 select-none">
                                                -
                                            </button>
                                            <span class="text-xs font-mono font-bold text-zinc-900 dark:text-white w-6 text-center" x-text="item.quantity"></span>
                                            <button type="button" @click="updateCartQty(item.id, item.quantity + 1)"
                                                class="w-6 h-6 rounded bg-zinc-200/60 dark:bg-zinc-800 border border-zinc-300/80 dark:border-zinc-700 text-zinc-800 dark:text-white flex items-center justify-center font-bold text-xs hover:bg-zinc-300 dark:hover:bg-zinc-700 select-none">
                                                +
                                            </button>
                                        </div>

                                        <!-- Remove Item -->
                                        <button type="button" @click="removeFromCart(item.id)" 
                                            class="text-zinc-400 hover:text-red-500 dark:text-zinc-600 dark:hover:text-red-400 p-1 flex-shrink-0 transition-colors">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </div>
                                </template>
                                
                                <template x-if="cart.length === 0">
                                    <div class="p-6 text-center text-xs text-zinc-550 dark:text-zinc-500 font-mono tracking-wider uppercase">
                                        [ KERANJANG_KOSONG ]
                                    </div>
                                </template>
                            </div>
                        </div>
                    </div>

                    <!-- Footer (Sticky at the bottom of the drawer) -->
                    <div class="border-t border-zinc-200 dark:border-zinc-800/60 p-6 bg-zinc-50/50 dark:bg-black/30 space-y-4">
                        <!-- Order Summary Card -->
                        <div class="p-4 bg-zinc-50 dark:bg-black/40 border border-zinc-200 dark:border-zinc-800/60 rounded-xl space-y-2">
                            <span class="text-[8px] font-display text-zinc-500 uppercase tracking-widest">[ RINGKASAN_PEMBAYARAN ]</span>
                            <div class="flex justify-between items-center text-xs pt-1">
                                <span class="text-zinc-505 dark:text-zinc-400">Total Pesanan:</span>
                                <span class="font-bold text-zinc-950 dark:text-white" x-text="cartCount + ' Item'"></span>
                            </div>
                            <div class="flex justify-between items-center border-t border-zinc-200/50 dark:border-zinc-800/50 pt-2 text-sm">
                                <span class="text-zinc-650 dark:text-zinc-400 font-bold">Total Pembayaran:</span>
                                <span class="font-display font-black text-industrial-orange text-base" x-text="'Rp ' + new Intl.NumberFormat('id-ID').format(cartTotal)"></span>
                            </div>
                        </div>

                        <!-- Marketplace Checkout Alternative -->
                        @php
                            $modalShops = \App\Models\Shop::where('is_active', true)->get();
                            $shopeeShops = $modalShops->where('platform', 'shopee');
                            $tokopediaShops = $modalShops->where('platform', 'tokopedia');
                        @endphp

                        @if($shopeeShops->isNotEmpty() || $tokopediaShops->isNotEmpty())
                        <div x-show="cart.length > 0" class="p-4 bg-white dark:bg-zinc-950 border border-zinc-200 dark:border-zinc-850 rounded-xl space-y-3 transition-colors duration-300">
                            <span class="text-[8px] font-display text-zinc-500 uppercase tracking-widest">[ PESAN_INSTAN_VIA_MARKETPLACE ]</span>
                            <p class="text-[10px] text-zinc-500 dark:text-zinc-400 leading-normal font-sans">
                                Lebih suka transaksi lewat marketplace? Kunjungi official store kami untuk memesan produk pilihan Anda dengan aman:
                            </p>
                            <div class="flex flex-col gap-2">
                                @foreach($shopeeShops as $sShop)
                                <a href="{{ $sShop->url }}" target="_blank"
                                    class="flex items-center justify-center gap-2 px-3 py-2 bg-zinc-50 dark:bg-black border border-zinc-200 dark:border-zinc-800 text-[10px] font-bold text-slate-800 dark:text-zinc-200 hover:text-industrial-orange dark:hover:text-industrial-orange hover:border-industrial-orange/50 dark:hover:border-industrial-orange/50 transition-all font-mono tracking-wider">
                                    <svg class="h-3.5 w-3.5 text-zinc-450 dark:text-zinc-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                    </svg>
                                    {{ strtoupper($sShop->name) }} (SHOPEE)
                                </a>
                                @endforeach

                                @foreach($tokopediaShops as $tShop)
                                <a href="{{ $tShop->url }}" target="_blank"
                                    class="flex items-center justify-center gap-2 px-3 py-2 bg-zinc-50 dark:bg-black border border-zinc-200 dark:border-zinc-800 text-[10px] font-bold text-slate-800 dark:text-zinc-200 hover:text-industrial-orange dark:hover:text-industrial-orange hover:border-industrial-orange/50 dark:hover:border-industrial-orange/50 transition-all font-mono tracking-wider">
                                    <svg class="h-3.5 w-3.5 text-zinc-450 dark:text-zinc-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                    </svg>
                                    {{ strtoupper($tShop->name) }} (TOKOPEDIA)
                                </a>
                                @endforeach
                            </div>
                        </div>
                        @endif

                        <!-- Action Buttons -->
                        <div class="flex items-center justify-end gap-3 pt-4 border-t border-zinc-200 dark:border-zinc-800/60">
                            <button type="button" @click="orderModalOpen = false"
                                class="px-4 py-2.5 text-xs font-bold uppercase tracking-widest text-zinc-550 hover:text-zinc-900 dark:text-zinc-400 dark:hover:text-white transition-colors font-display">
                                Batal
                            </button>
                            <button type="submit"
                                class="stealth-btn-primary px-6 py-2.5 text-xs font-bold uppercase tracking-widest font-display flex items-center gap-2">
                                <span>KIRIM KE WHATSAPP</span>
                                <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 24 24">
                                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L0 24l6.335-1.662c1.746.953 3.71 1.458 5.704 1.459h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
