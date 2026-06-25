# ⚡ Extreme Project - Premium Vape Brand Website

Extreme Project adalah platform web showcase, komparasi produk, dan katalog pemesanan multi-channel premium untuk merek vape coil & cotton kelas atas. Website ini dirancang dengan estetika industri modern (*industrial dark/stealth theme*) menggunakan warna aksen oranye kustom (`#ff5500`), kontras tinggi, dan interaksi mikro yang dinamis untuk memberikan kesan eksklusif dan profesional bagi para pengguna.

---

## 🚀 Fitur Utama

### 1. Landing Page Publik yang Dinamis & Responsif
*   **Hero Section Futuristik**: Visualisasi premium yang memukau pengguna pertama kali saat mengunjungi web.
*   **Katalog Terpisah (Split Catalog)**: Pembagian kategori yang jelas antara **Coil** dan **Cotton** dengan interaksi *expandable* menggunakan Alpine.js (`showAllCoils` / `showAllCottons`).
*   **Filter Spesifikasi Produk**: Slider dinamis yang responsif untuk memfilter produk coil berdasarkan *flavor*, *sweetness*, dan *throat hit*.
*   **Multi-Channel Ordering Pipeline**: Mengarahkan pembeli langsung ke channel penjualan resmi seperti **WhatsApp**, **Instagram Direct Message**, dan **TikTok Shop** dengan integrasi tautan langsung yang valid.
*   **Mode Gelap / Terang (Dark & Light Mode)**: Landing page mendukung transisi mulus menggunakan sistem kelas Tailwind `dark:`.

### 2. Panel Admin (Dashboard Manajemen Dashboard)
*   **Metrik Ringkasan (Stat Cards)**: Menampilkan total stok, nilai aset stok, jumlah produk habis, serta statistik channel toko aktif yang dilengkapi dengan indikator visual *progress bar*.
*   **Manajemen Produk (Products CRUD)**:
    *   Pengelompokan input form berdasarkan kategori: **Coil** (menggunakan *slider* interaktif nilai 1-5) dan **Cotton** (menggunakan *toggle/checkbox* fitur spesifikasi organik).
    *   Sistem validasi input yang ketat dan otomatisasi generate *slug* berdasarkan judul produk.
*   **Manajemen Channel Toko (Shops CRUD)**:
    *   Mendukung penambahan channel penjualan resmi (**TikTok Shop**, **WhatsApp**, **Instagram**).
    *   Dilengkapi validasi URL khusus sesuai platform (misalnya, tautan WhatsApp wajib diawali `wa.me` atau `api.whatsapp.com`).
*   **Ganti Password Admin**: Fitur ubah sandi admin yang aman langsung dari panel pengaturan profil.
*   **Keamanan Ekstra**: Proteksi konfirmasi JavaScript saat keluar (logout), menghapus data, dan notifikasi sukses saat menyimpan data.

---

## 🛠️ Tech Stack & Dependensi

*   **Framework Utama**: Laravel 13.x (PHP 8.3+)
*   **Database**: MySQL
*   **Frontend & Styling**: 
    *   Tailwind CSS (via CDN untuk portabilitas instan)
    *   Alpine.js (untuk logika reaktif frontend & state management)
*   **Developer Tools**: 
    *   PHPUnit & Artisan Test Suite
    *   Laravel Pail & Laravel Pao

---

## 🗄️ Skema Database

### 1. Tabel `users` (Admin)
Digunakan untuk autentikasi admin panel.
*   `id` (BIGINT, Primary Key, Auto Increment)
*   `name` (VARCHAR)
*   `email` (VARCHAR, Unique)
*   `password` (VARCHAR)
*   `timestamps` (`created_at`, `updated_at`)

### 2. Tabel `products`
Menyimpan data coil dan cotton beserta spesifikasinya dalam format JSON.
*   `id` (BIGINT, Primary Key, Auto Increment)
*   `title` (VARCHAR)
*   `slug` (VARCHAR, Unique)
*   `category` (ENUM: `coil`, `cotton`)
*   `price` (DECIMAL 15,2)
*   `stock` (UNSIGNED INT)
*   `character_description` (TEXT)
*   `specifications` (JSON) - Menyimpan struktur spesifikasi:
    *   *Coil*: `{"flavor": int, "sweetness": int, "throat_hit": int}` (skala 1-5)
    *   *Cotton*: `{"clean_flavor_delivery": bool, "fast_liquid_absorption": bool, "premium_organic_fiber": bool}`
*   `timestamps` (`created_at`, `updated_at`)

### 3. Tabel `shops`
Menyimpan daftar channel penjualan multi-channel.
*   `id` (BIGINT, Primary Key, Auto Increment)
*   `name` (VARCHAR)
*   `url` (VARCHAR)
*   `platform` (VARCHAR) - Berisi value: `tiktok`, `whatsapp`, `instagram`
*   `is_active` (BOOLEAN, Default: `true`)
*   `timestamps` (`created_at`, `updated_at`)

---

## ⚙️ Panduan Instalasi & Penggunaan

Ikuti langkah-langkah berikut untuk menjalankan project di lingkungan lokal:

### 1. Prasyarat Sistem
*   PHP >= 8.3
*   Composer
*   MySQL Database Server
*   Node.js & NPM (opsional, jika diperlukan kompilasi aset tambahan)

### 2. Langkah Setup
1.  **Clone / Salin repositori** ke direktori lokal Anda.
2.  **Salin file konfigurasi environment**:
    ```bash
    cp .env.example .env
    ```
3.  **Sesuaikan konfigurasi database** di file `.env`:
    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=nama_database_anda
    DB_USERNAME=username_mysql_anda
    DB_PASSWORD=password_mysql_anda
    ```
4.  **Install dependensi PHP**:
    ```bash
    composer install
    ```
5.  **Generate Application Key**:
    ```bash
    php artisan key:generate
    ```
6.  **Jalankan Migrasi & Seeder Database**:
    Perintah ini akan membuat semua tabel dan mengisi data awal produk serta akun admin bawaan.
    ```bash
    php artisan migrate --seed
    ```

### 3. Menjalankan Server Lokal
Gunakan perintah artisan bawaan untuk menjalankan web server local:
```bash
php artisan serve
```
Buka browser dan akses platform di:
*   **Landing Page**: [http://127.0.0.1:8000](http://127.0.0.1:8000)
*   **Admin Panel**: [http://127.0.0.1:8000/admin](http://127.0.0.1:8000/admin)

---

## 🔑 Kredensial Admin Default

Untuk masuk ke panel admin, gunakan akun demo bawaan berikut (Hanya aktif di environment `local`):
*   **Email**: `admin@vape.com`
*   **Password**: `password`

> ⚠️ **PENTING**: Segera ubah password Anda di halaman **Ganti Password** setelah pertama kali masuk di panel admin.

---

## 🔒 Konfigurasi Keamanan

Project ini telah diaudit dan diperkuat dengan standar keamanan web berikut:
1.  **Proteksi Brute Force (Rate Limiting)**: Route login admin dibatasi menggunakan middleware throttle `throttle:5,1` (maksimal 5 kali percobaan login per menit) untuk menghindari serangan brute force.
2.  **Security Headers Middleware**: Mengimplementasikan `SecurityHeaders` middleware global yang menambahkan HTTP Header demi mencegah serangan XSS, Clickjacking, dan MIME sniffing:
    *   `X-Frame-Options: SAMEORIGIN`
    *   `X-Content-Type-Options: nosniff`
    *   `X-XSS-Protection: 1; mode=block`
    *   `Referrer-Policy: no-referrer-when-downgrade`
3.  **Strict URL Format Validation**: Menghindari input link palsu atau phising dengan memvalidasi domain URL input toko agar wajib sesuai dengan platform yang dipilih (`instagram.com`, `tiktok.com`, `wa.me`).
4.  **IP Ban System**: Helper kustom `LoginIpBan` untuk menangani aktivitas mencurigakan pada akses autentikasi.

---

## 🧪 Pengujian (Testing)

Project dilengkapi dengan automated testing untuk memastikan stabilitas kode. Jalankan seluruh test suite menggunakan perintah:

```bash
php artisan test
```

Test coverage mencakup:
*   `ProductTest`: Pengujian fungsionalitas CRUD produk serta validasi spesifikasi.
*   `WelcomeProductMenuTest`: Memverifikasi tampilan katalog di landing page dan sistem reaktivitas filter.
*   `AdminPaginationTest`: Menguji penomoran halaman yang aman di dashboard.
*   `AdminPasswordTest`: Menguji keabsahan alur pergantian password admin.
*   `LoginIpBanTest`: Memastikan sistem pembatasan IP ketika terjadi percobaan login ilegal bekerja secara akurat.
