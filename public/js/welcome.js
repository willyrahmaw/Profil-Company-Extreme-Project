document.addEventListener('alpine:init', () => {
    Alpine.data('welcomeApp', (defaultWaUrl, hasActiveEvent, customWaTemplate) => ({
        theme: (function() {
            try {
                return localStorage.getItem('theme') || 'light';
            } catch(e) {
                return 'light';
            }
        })(),
        get isDark() {
            return this.theme === 'dark';
        },
        toggleTheme() {
            this.theme = this.theme === 'dark' ? 'light' : 'dark';
            try {
                localStorage.setItem('theme', this.theme);
            } catch(e) {}
            if (this.theme === 'dark') {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        },
        showEventPopup: hasActiveEvent ? (function() {
            try {
                if (new URLSearchParams(window.location.search).has('preview_event')) {
                    return true;
                }
                return !sessionStorage.getItem('event_popup_shown');
            } catch(e) {
                return true;
            }
        })() : false,
        closeEventPopup() {
            this.showEventPopup = false;
            try {
                sessionStorage.setItem('event_popup_shown', 'true');
            } catch(e) {}
        },
        showAllCoils: false,
        showAllCottons: false,
        orderModalOpen: false,
        orderWaUrl: defaultWaUrl,
        buyerName: '',
        buyerAddress: '',
        waTemplate: customWaTemplate || '',
        
        // Cart State & Persistent Storage
        cart: (function() {
            try {
                return JSON.parse(localStorage.getItem('cart')) || [];
            } catch(e) {
                return [];
            }
        })(),
        get cartCount() {
            return this.cart.reduce((total, item) => total + item.quantity, 0);
        },
        get cartTotal() {
            return this.cart.reduce((total, item) => total + (item.price * item.quantity), 0);
        },
        addToCart(id, title, price, image, specs, marketplaceUrls = {}) {
            let existing = this.cart.find(item => item.id === id);
            if (existing) {
                existing.quantity++;
            } else {
                this.cart.push({
                    id: id,
                    title: title,
                    price: price,
                    image: image,
                    specs: specs,
                    marketplace_urls: marketplaceUrls,
                    quantity: 1
                });
            }
            this.saveCart();
            this.showToastNotification('Berhasil menambahkan ' + title + ' ke keranjang.');
        },
        removeFromCart(id) {
            this.cart = this.cart.filter(item => item.id !== id);
            this.saveCart();
        },
        updateCartQty(id, qty) {
            let item = this.cart.find(item => item.id === id);
            if (item) {
                item.quantity = parseInt(qty) || 1;
                if (item.quantity <= 0) {
                    this.removeFromCart(id);
                } else {
                    this.saveCart();
                }
            }
        },
        clearCart() {
            this.cart = [];
            this.saveCart();
        },
        saveCart() {
            try {
                localStorage.setItem('cart', JSON.stringify(this.cart));
            } catch(e) {}
        },
        
        // Toast notifications
        toastMessage: '',
        showToast: false,
        showToastNotification(msg) {
            this.toastMessage = msg;
            this.showToast = true;
            setTimeout(() => {
                this.showToast = false;
            }, 3000);
        },

        sendToWhatsapp() {
            if (this.cart.length === 0) return;

            let formattedTotal = 'Rp ' + new Intl.NumberFormat('id-ID').format(this.cartTotal);
            
            // Format dynamic bulleted products list
            let productsListText = this.cart.map(item => {
                let specsArray = [];
                if (item.specs) {
                    if (item.specs.diameter) specsArray.push('Dia: ' + item.specs.diameter);
                    if (item.specs.resistance) specsArray.push('Res: ' + item.specs.resistance);
                    if (item.specs.material) specsArray.push('Mat: ' + item.specs.material);
                }
                let specsText = specsArray.length > 0 ? ' (' + specsArray.join(', ') + ')' : '';
                let itemPriceFormatted = 'Rp ' + new Intl.NumberFormat('id-ID').format(item.price);
                let itemTotalFormatted = 'Rp ' + new Intl.NumberFormat('id-ID').format(item.price * item.quantity);
                return `- *${item.title}*${specsText}\n  ${item.quantity} x ${itemPriceFormatted} = ${itemTotalFormatted}`;
            }).join('\n');
            
            // Log order to database via API
            let csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';
            fetch('/api/orders', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({
                    buyer_name: this.buyerName,
                    buyer_address: this.buyerAddress,
                    total_price: this.cartTotal,
                    items: this.cart.map(item => ({
                        product_title: item.title,
                        quantity: item.quantity,
                        price: item.price,
                        total_price: item.price * item.quantity
                    }))
                })
            })
            .then(res => res.json())
            .then(data => {
                console.log('Order logged to DB:', data);
                this.clearCart();
            })
            .catch(err => console.error('Failed to log order to DB:', err));

            // Format message template
            let msg = '';
            if (this.waTemplate.trim()) {
                msg = this.waTemplate
                    .replace(/{buyer_name}/g, this.buyerName)
                    .replace(/{buyer_address}/g, this.buyerAddress)
                    .replace(/{products_list}/g, productsListText)
                    .replace(/{total_price}/g, formattedTotal)
                    // Keep fallback properties if old placeholders are used
                    .replace(/{product_title}/g, this.cart[0].title)
                    .replace(/{price}/g, 'Rp ' + new Intl.NumberFormat('id-ID').format(this.cart[0].price))
                    .replace(/{quantity}/g, this.cart[0].quantity)
                    .replace(/{specs}/g, '');
            } else {
                msg = '*DETAIL INVOICE ORDER - EXTREME PROJECT*\n' +
                      '========================================\n\n' +
                      '*Nama Penerima:* ' + this.buyerName + '\n' +
                      '*Alamat Pengiriman:* ' + this.buyerAddress + '\n\n' +
                      '*Daftar Pesanan:*\n' + productsListText + '\n\n' +
                      '*Total Pembayaran:* *' + formattedTotal + '*\n' +
                      '========================================\n' +
                      '_Mohon segera diproses ya Kak, terima kasih!_';
            }

            let base = this.orderWaUrl.split('?')[0];
            window.open(base + '?text=' + encodeURIComponent(msg), '_blank');
            this.orderModalOpen = false;
        }
    }));
});


