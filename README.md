# ⚡ Extreme Project - Premium Vape Brand Website

Extreme Project adalah platform web showcase, komparasi produk, dan katalog pemesanan multi-channel premium untuk merek vape coil & cotton kelas atas. Website ini dirancang dengan estetika industri modern (*industrial dark/stealth theme*) menggunakan warna aksen oranye kustom (`#ff5500`), kontras tinggi, dan interaksi mikro yang dinamis untuk memberikan kesan eksklusif dan profesional bagi para vapers.

---

## 🚀 Fitur Utama

### 1. Landing Page Publik yang Dinamis & Responsif
*   **Hero Section Futuristik**: Visualisasi premium dengan efek glow neon dinamis untuk impresi pertama yang kuat.
*   **Katalog Terpisah (Split Catalog)**: Pembagian kategori yang jelas antara **Coil** dan **Cotton** dengan interaksi *expandable* menggunakan Alpine.js (`showAllCoils` / `showAllCottons`).
*   **Filter Spesifikasi Produk**: Slider dinamis yang responsif untuk memfilter produk coil berdasarkan *flavor*, *sweetness*, dan *throat hit*.
*   **Sistem Keranjang & WhatsApp Ordering Pipeline**: Mengumpulkan produk ke keranjang belanja lokal (persistent via LocalStorage), mencatat pesanan ke database (`orders` & `order_items`), dan mengalihkan pengguna ke WhatsApp dengan pesan berformat rapi sesuai template dinamis.
*   **Survey Kepuasan Pelanggan**: Kuesioner interaktif publik di landing page untuk mengumpulkan riset dan opini pelanggan secara langsung.
*   **Portal Panduan Edukatif (/learn)**: Halaman khusus yang menampilkan artikel edukatif seputar panduan koil/kapas demi meningkatkan *customer research*.
*   **Mode Gelap / Terang (Dark & Light Mode)**: Transisi mode warna yang mulus di seluruh halaman menggunakan sistem kelas Tailwind `dark:`.

### 2. Panel Admin (Dashboard Manajemen Komprehensif)
*   **Metrik Ringkasan (Stat Cards)**: Menampilkan total stok, nilai aset stok, pesanan masuk, tanggapan survey, serta statistik toko aktif yang dilengkapi dengan indikator visual.
*   **Manajemen Produk (Products CRUD)**:
    *   Pengelompokan input form berdasarkan kategori: **Coil** (slider nilai 1-5) dan **Cotton** (toggle spesifikasi organik).
    *   Sistem validasi input yang ketat dan otomatisasi generate *slug* berdasarkan judul produk.
*   **Manajemen Event & Diskon Aktif (Events CRUD)**:
    *   Mengatur diskon persentase global dan durasi event.
    *   Popup promo otomatis di halaman depan saat ada event aktif dan pemotongan harga otomatis di keranjang.
*   **Manajemen Pengaturan Global & SEO (Settings CRUD)**:
    *   Mengatur metadata SEO (title, deskripsi, kata kunci), canonical URL, dan skema JSON-LD.
    *   Unggah logo (terang & gelap), favicon, informasi profil bisnis, dan modifikasi template pesan pesanan WhatsApp.
*   **Manajemen Riset Survey & Testimoni**:
    *   Melihat, menganalisis, dan menghapus tanggapan survey pelanggan.
    *   Mengelola testimoni ulasan pembeli (Reviews) untuk ditampilkan di landing page.
*   **Manajemen Portal Panduan (Learn Guides CRUD)**:
    *   Menambahkan, menyunting, dan menghapus artikel panduan edukatif.
*   **Manajemen Channel Toko (Shops CRUD)**:
    *   Menambahkan channel penjualan resmi (**TikTok Shop**, **WhatsApp**, **Instagram**) dengan validasi URL platform.
*   **Ganti Password Admin**: Fitur ubah sandi admin yang aman langsung dari panel pengaturan profil.

### 3. Optimalisasi Performa & Aset Otomatis
*   **Konversi WebP Otomatis**: Semua berkas gambar yang diunggah (JPEG, PNG, GIF) dikonversi secara otomatis ke format `.webp` berkualitas tinggi (menggunakan PHP GD & output buffering) demi meminimalkan waktu pemuatan halaman dan ukuran penyimpanan. Pengecualian dilakukan untuk berkas `.ico` agar tetap utuh.
*   **Render Optimizations**: Pramuat (*preload*) di head untuk aset di atas lipatan (*above-the-fold*), penundaan (*defer*) skrip non-kritis, dan preconnect CDN untuk mempercepat metrik FCP, LCP, dan Speed Index.

---

## 🛠️ Tech Stack & Dependensi

*   **Framework Utama**: Laravel 13.x (PHP 8.3+)
*   **Database**: MySQL
*   **Frontend & Styling**: 
    *   Tailwind CSS v4 (via CDN & browser runtime compiler)
    *   Alpine.js (untuk logika reaktif frontend & state management)
*   **Developer Tools**: 
    *   PHPUnit & Artisan Test Suite
    *   Laravel Pail & Laravel Pao

---

## 🗄️ Skema Database Utama

### 1. Tabel `users`
Digunakan untuk autentikasi admin panel.

### 2. Tabel `products`
Menyimpan data coil dan cotton beserta spesifikasinya dalam format JSON, serta link marketplace jika ada.

### 3. Tabel `settings`
Menyimpan konfigurasi SEO global, logo (terang/gelap), favicon, profil bisnis, dan template pesan WhatsApp.

### 4. Tabel `events`
Menyimpan data promo diskon global yang aktif berdasarkan durasi tanggal mulai dan selesai.

### 5. Tabel `orders` & `order_items`
Mencatat detail pesanan pelanggan sebelum dialihkan ke WhatsApp penjual untuk pencatatan log internal.

### 6. Tabel `survey_responses`
Menyimpan data kuesioner kepuasan pembeli dari halaman publik.

### 7. Tabel `testimonials`
Menyimpan ulasan bintang lima dari pembeli untuk ditampilkan di landing page.

### 8. Tabel `learn_guides`
Menyimpan konten panduan edukasi vape bagi pengguna.

### 9. Tabel `shops`
Menyimpan daftar channel penjualan multi-channel (**TikTok Shop**, **WhatsApp**, **Instagram**).

---

## ⚙️ Panduan Instalasi & Penggunaan

Ikuti langkah-langkah berikut untuk menjalankan project di lingkungan lokal:

### 1. Prasyarat Sistem
*   PHP >= 8.3 (dengan ekstensi GD aktif untuk konversi WebP)
*   Composer
*   MySQL Database Server

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
7.  **Hubungkan Simbolik Link Storage**:
    ```bash
    php artisan storage:link
    ```

### 3. Menjalankan Server Lokal
Ubah host di `.env` menjadi host lokal Anda atau jalankan perintah server lokal Laravel:
```bash
php artisan serve
```
Akses platform di:
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

Project ini telah diperkuat dengan standar keamanan web berikut:
1.  **Proteksi Brute Force (Rate Limiting)**: Route login admin dibatasi menggunakan middleware throttle `throttle:5,1` (maksimal 5 kali percobaan login per menit).
2.  **Security Headers Middleware**: Mengimplementasikan `SecurityHeaders` middleware global untuk mencegah serangan XSS, Clickjacking, dan MIME sniffing.
3.  **Strict URL Format Validation**: Memvalidasi domain URL input toko agar wajib sesuai dengan platform yang dipilih (`instagram.com`, `tiktok.com`, `wa.me`).
4.  **IP Ban System**: Memblokir IP address secara otomatis untuk jangka waktu tertentu apabila melakukan percobaan login gagal berkali-kali.

---

## 🧪 Pengujian (Testing)

Project dilengkapi dengan automated testing untuk memastikan stabilitas kode. Jalankan seluruh test suite menggunakan perintah:

```bash
php artisan test
```

Test coverage mencakup:
*   `ProductTest`: CRUD produk dan validasi spesifikasi coil/cotton.
*   `SettingTest`: Unggah logo, favicon, dan integrasi pengaturan global.
*   `EventTest`: Pembuatan event diskon dan validasi popup.
*   `SurveyTest`: Penyimpanan respon survey riset pembeli.
*   `TestimonialTest`: CRUD ulasan bintang lima pelanggan.
*   `LearnGuideTest`: Manajemen artikel edukatif.
*   `ImageHelperTest`: Unit test konversi gambar JPG/PNG ke WebP serta pembatalan konversi file ICO.
*   `LoginIpBanTest`: Memastikan sistem pembatasan IP ketika terjadi percobaan login ilegal bekerja secara akurat.

