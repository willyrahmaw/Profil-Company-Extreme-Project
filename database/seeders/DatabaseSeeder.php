<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\User;
use App\Models\Product;
use App\Models\Shop;
use App\Models\Testimonial;
use App\Models\LearnGuide;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Create Admin User
        User::updateOrCreate(
            ['email' => 'admin@vape.com'],
            [
                'name' => 'Admin Vape',
                'password' => Hash::make('password'),
            ]
        );

        // 2. Create Seed Products
        Product::updateOrCreate(
            ['slug' => 'extreme-v1-hitam'],
            [
                'title' => 'Extreme V1 Hitam',
                'category' => 'coil',
                'price' => 70000.00,
                'stock' => 20,
                'character_description' => 'Menghadirkan flavor yang tajam, bersih, dan sangat terdefinisi dengan throat hit yang kuat serta responsif. Dirancang untuk mengoptimalkan karakter liquid sehingga menghasilkan cita rasa yang kaya, konsisten, dan dominan. Pilihan ideal bagi pengguna yang mengutamakan intensitas flavor, performa tinggi, serta sensasi vaping yang tegas di setiap tarikan.',
                'specifications' => array(
                    'foot' => 'Kaki Sejajar',
                    'wrap' => '5 wraps',
                    'flavor' => 4,
                    'version' => 'V1',
                    'diameter' => '3 mm',
                    'material' => 'BABY ALIEN NI80 US',
                    'sweetness' => 3,
                    'durability' => '14 - 21 HARI',
                    'resistance' => '0.36 Ω single / 0.18 Ω dual',
                    'throat_hit' => 5,
                    'resistance_dual' => '0.18',
                    'recommended_watt' => 'Single: 30-40W / Dual: 55-65W',
                    'resistance_single' => '0.36',
                    'recommended_liquid' =>
                    array(
                        0 => 'Creamy',
                    ),
                    'compatible_atomizers' =>
                    array(
                        0 => 'RDA',
                        1 => 'RTA',
                    ),
                ),
            ]
        );

        Product::updateOrCreate(
            ['slug' => 'extreme-v2-kuning'],
            [
                'title' => 'Extreme V2 Kuning',
                'category' => 'coil',
                'price' => 70000.00,
                'stock' => 20,
                'character_description' => 'Dirancang untuk menghasilkan flavor yang kaya, kuat, dan konsisten dengan kemampuan mengangkat karakter sweetness secara optimal. Sensasi hisapan yang halus and nyaman menjadikannya ideal untuk penggunaan harian, menghadirkan pengalaman vaping yang stabil dengan cita rasa yang penuh, manis, dan tetap seimbang di setiap tarikan.',
                'specifications' => array(
                    'foot' => 'Kaki Sejajar',
                    'wrap' => '5 wraps',
                    'flavor' => 4,
                    'version' => 'V2',
                    'diameter' => '3 mm',
                    'material' => 'BABY ALIEN NI80 GERMANY',
                    'sweetness' => 5,
                    'durability' => '14 - 21 HARI',
                    'resistance' => '0.38 Ω single / 0.19 Ω dual',
                    'throat_hit' => 3,
                    'resistance_dual' => '0.19',
                    'recommended_watt' => 'Single: 30-40W / Dual: 55-65W',
                    'resistance_single' => '0.38',
                    'recommended_liquid' =>
                    array(
                        0 => 'Creamy',
                        1 => 'Sweet',
                        2 => 'Fruit',
                    ),
                    'compatible_atomizers' =>
                    array(
                        0 => 'RDA',
                        1 => 'RTA',
                    ),
                ),
            ]
        );

        Product::updateOrCreate(
            ['slug' => 'extreme-v3-pink'],
            [
                'title' => 'Extreme V3 Pink',
                'category' => 'coil',
                'price' => 70000.00,
                'stock' => 20,
                'character_description' => 'Mengombinasikan flavor yang bersih, jernih, dan akurat dengan throat hit yang dominan untuk menghasilkan pengalaman vaping yang lebih tegas. Respons cepat, reproduksi rasa yang konsisten, dan performa yang stabil menjadikannya pilihan tepat bagi pengguna yang menyukai sensasi vaping agresif dengan karakter yang kuat.',
                'specifications' => array(
                    'foot' => 'Kaki Sejajar',
                    'wrap' => '6 wraps',
                    'flavor' => 4,
                    'version' => 'V3',
                    'diameter' => '3 mm',
                    'material' => 'FUSED CLAPTON NI80 US',
                    'sweetness' => 3,
                    'durability' => '14 - 21 HARI',
                    'resistance' => '0.34 Ω single / 0.17 Ω dual',
                    'throat_hit' => 5,
                    'resistance_dual' => '0.17',
                    'recommended_watt' => 'Single: 38-45W / Dual: 65-75W',
                    'resistance_single' => '0.36',
                    'recommended_liquid' =>
                    array(
                        0 => 'Creamy',
                        1 => 'Fruit',
                    ),
                    'compatible_atomizers' =>
                    array(
                        0 => 'RTA',
                        1 => 'RDA',
                    ),
                ),
            ]
        );

        Product::updateOrCreate(
            ['slug' => 'extreme-v4-ungu'],
            [
                'title' => 'Extreme V4 Ungu',
                'category' => 'coil',
                'price' => 70000.00,
                'stock' => 20,
                'character_description' => 'Dirancang sebagai pilihan ideal bagi pecinta liquid sweet dan creamy. Mampu mengoptimalkan sweetness sehingga menghasilkan cita rasa yang lebih kaya dan autentik, dipadukan dengan sensasi inhale yang halus dan nyaman. Sangat cocok untuk penggunaan harian dengan karakter rasa yang manis, lembut, dan tetap konsisten.',
                'specifications' => array(
                    'foot' => 'Kaki Silang',
                    'wrap' => '5 wraps',
                    'flavor' => 4,
                    'version' => 'V4',
                    'diameter' => '2.5 mm',
                    'material' => 'FUSED CLAPTON NI80 KOOKPUNT',
                    'sweetness' => 5,
                    'durability' => '14 - 21 HARI',
                    'resistance' => '0.30 Ω single',
                    'throat_hit' => 3,
                    'resistance_dual' => '',
                    'recommended_watt' => 'Single: 38-48W',
                    'resistance_single' => '0.30',
                    'recommended_liquid' =>
                    array(
                        0 => 'Creamy',
                        1 => 'Sweet',
                    ),
                    'compatible_atomizers' =>
                    array(
                        0 => 'AIO',
                    ),
                ),
            ]
        );

        Product::updateOrCreate(
            ['slug' => 'extreme-v5-putih'],
            [
                'title' => 'Extreme V5 Putih',
                'category' => 'coil',
                'price' => 70000.00,
                'stock' => 20,
                'character_description' => 'Menghadirkan keseimbangan optimal antara flavor, sweetness, dan throat hit yang kuat untuk menciptakan pengalaman vaping yang solid. Reproduksi rasa yang akurat dipadukan dengan performa yang stabil menghasilkan sensasi hisapan yang konsisten, cocok bagi pengguna yang menginginkan harmonisasi sempurna antara rasa, kekuatan, dan kenyamanan.',
                'specifications' => array(
                    'foot' => 'Kaki Sejajar',
                    'wrap' => '6 wraps',
                    'flavor' => 5,
                    'version' => 'V5',
                    'diameter' => '3 mm',
                    'material' => 'FUSED CLAPTON NI80 US',
                    'sweetness' => 4,
                    'durability' => '14 - 21 HARI',
                    'resistance' => '0.36 Ω single / 0.18 Ω dual',
                    'throat_hit' => 5,
                    'resistance_dual' => '0.18',
                    'recommended_watt' => 'Single: 35-45W / Dual: 55-65W',
                    'resistance_single' => '0.36',
                    'recommended_liquid' =>
                    array(
                        0 => 'Creamy',
                        1 => 'Fruit',
                    ),
                    'compatible_atomizers' =>
                    array(
                        0 => 'RDA',
                        1 => 'RTA',
                        2 => 'AIO',
                    ),
                ),
            ]
        );

        Product::updateOrCreate(
            ['slug' => 'extreme-v6-merah'],
            [
                'title' => 'Extreme V6 Merah',
                'category' => 'coil',
                'price' => 70000.00,
                'stock' => 20,
                'character_description' => 'Menawarkan performa paling seimbang antara flavor, sweetness, dan kenyamanan throat hit. Dirancang untuk bekerja optimal pada berbagai jenis liquid dengan menghasilkan cita rasa yang akurat, respons yang stabil, serta sensasi hisapan yang nyaman. Pilihan all-around yang ideal untuk penggunaan harian.',
                'specifications' => array(
                    'foot' => 'Kaki Sejajar',
                    'wrap' => '6 wraps',
                    'flavor' => 4,
                    'version' => 'V6',
                    'diameter' => '2.5 mm',
                    'material' => 'FUSED CLAPTON NI80 US',
                    'sweetness' => 4,
                    'durability' => '14 - 21 HARI',
                    'resistance' => '0.35 Ω single',
                    'throat_hit' => 4,
                    'resistance_dual' => '',
                    'recommended_watt' => 'Single: 35-45W',
                    'resistance_single' => '0.35',
                    'recommended_liquid' =>
                    array(
                        0 => 'Fruit',
                        1 => 'Creamy',
                        2 => 'Sweet',
                    ),
                    'compatible_atomizers' =>
                    array(
                        0 => 'AIO',
                    ),
                ),
            ]
        );

        Product::updateOrCreate(
            ['slug' => 'handmade-premium-organic-cotton'],
            [
                'title' => 'Handmade Premium Organic Cotton',
                'category' => 'cotton',
                'price' => 45000.00,
                'stock' => 100,
                'character_description' => 'Menghasilkan rasa liquid yang bersih dengan daya serap cepat untuk penggunaan intensif.',
                'specifications' => array(
                    'items' =>
                    array(
                        0 => 'Material: Organic Fiber',
                        1 => 'Chemical Free',
                        2 => 'Zero Bleach',
                        3 => 'Heat Resistant',
                        4 => 'High Absorption',
                        5 => 'Flavor Neutral',
                    ),
                ),
            ]
        );

        Product::updateOrCreate(
            ['slug' => 'cyber-absorbent-cotton'],
            [
                'title' => 'Cyber Absorbent Cotton',
                'category' => 'cotton',
                'price' => 55000.00,
                'stock' => 80,
                'character_description' => 'Menghasilkan rasa liquid yang bersih dengan daya serap cepat untuk penggunaan intensif.',
                'specifications' => array(
                    'items' =>
                    array(
                        0 => 'Material: Premium Organic Fiber',
                        1 => 'Chemical Free',
                        2 => 'Zero Bleach',
                        3 => 'Advanced Heat Resistance',
                        4 => 'Maximum High Absorption',
                        5 => 'Absolute Flavor Neutral',
                    ),
                ),
            ]
        );

        // 3. Create Seed Shops
        Shop::updateOrCreate(
            ['name' => 'TikTok Shop Coils'],
            [
                'url' => 'https://tiktok.com/@extreme_coils',
                'platform' => 'tiktok',
                'is_active' => true,
            ]
        );

        Shop::updateOrCreate(
            ['name' => 'TikTok Shop Cottons'],
            [
                'url' => 'https://tiktok.com/@extreme_cottons',
                'platform' => 'tiktok',
                'is_active' => true,
            ]
        );

        Shop::updateOrCreate(
            ['name' => 'TikTok Shop Official'],
            [
                'url' => 'https://tiktok.com/@extreme_official',
                'platform' => 'tiktok',
                'is_active' => true,
            ]
        );

        Shop::updateOrCreate(
            ['name' => 'WhatsApp Admin Utama'],
            [
                'url' => 'https://wa.me/628123456789',
                'platform' => 'whatsapp',
                'is_active' => true,
            ]
        );

        Shop::updateOrCreate(
            ['name' => 'WhatsApp Line 2 (Custom Coil)'],
            [
                'url' => 'https://wa.me/628987654321',
                'platform' => 'whatsapp',
                'is_active' => true,
            ]
        );

        Shop::updateOrCreate(
            ['name' => 'Instagram Portfolio'],
            [
                'url' => 'https://instagram.com/extreme_project',
                'platform' => 'instagram',
                'is_active' => true,
            ]
        );

        // 4. Create Seed Testimonials
        Testimonial::updateOrCreate(
            ['name' => 'Rizky'],
            [
                'content' => 'Flavor paling keluar dibanding coil pabrikan lain. Sensasi rasa creamy-nya tebal banget dan konsisten sampai beberapa minggu penggunaan.',
                'stars' => 5,
                'avatar_initial' => 'R',
                'is_active' => true,
            ]
        );

        Testimonial::updateOrCreate(
            ['name' => 'Dimas'],
            [
                'content' => 'Gila sih, awet hampir 3 minggu dengan perawatan rutin. Manisnya dapet dan ramp-up speed-nya super instan.',
                'stars' => 5,
                'avatar_initial' => 'D',
                'is_active' => true,
            ]
        );

        Testimonial::updateOrCreate(
            ['name' => 'Bagas'],
            [
                'content' => 'Ramp up cepat banget, throat hit juga mantap nendang pas untuk liquid fruity dingin. Sangat recommended!',
                'stars' => 5,
                'avatar_initial' => 'B',
                'is_active' => true,
            ]
        );

        // 5. Create Seed Learn Guides
        LearnGuide::updateOrCreate(
            ['slug' => 'cara-memilih-coil'],
            [
                'title' => 'Cara Memilih Coil Sesuai Jenis Liquid',
                'content' => '<p class="text-zinc-650 dark:text-zinc-400 text-xs sm:text-sm font-sans font-light leading-relaxed text-justify">
    Memilih coil yang salah untuk tipe liquid tertentu dapat menghasilkan rasa yang kurang optimal, tarikan terlalu berat, atau coil yang cepat berkerak. Sesuaikan pilihan coil Anda dengan kecocokan liquid pada database produk kami:
</p>
<div class="grid grid-cols-1 md:grid-cols-3 gap-4 pt-2">
    <div class="p-5 border border-zinc-250 dark:border-zinc-900 bg-zinc-950/20 rounded-xl space-y-2">
        <h4 class="text-xs font-mono font-bold text-industrial-orange uppercase tracking-wider">Liquid Fruity / Menthol</h4>
        <p class="text-[11px] text-zinc-550 dark:text-zinc-450 leading-relaxed font-sans font-light text-justify">
            Untuk mengangkat sensasi dingin menthol dan kesegaran rasa buah, gunakan varian yang mendukung karakter <strong>Fruit</strong> seperti <strong>Extreme V2 Kuning</strong>, <strong>V3 Pink</strong> (MTL Specialist), <strong>V5 Putih</strong>, atau <strong>V6 Merah</strong>.
        </p>
    </div>
    <div class="p-5 border border-zinc-250 dark:border-zinc-900 bg-zinc-950/20 rounded-xl space-y-2">
        <h4 class="text-xs font-mono font-bold text-industrial-orange uppercase tracking-wider">Liquid Creamy / Dessert</h4>
        <p class="text-[11px] text-zinc-550 dark:text-zinc-450 leading-relaxed font-sans font-light text-justify">
            Seluruh varian coil kami (V1-V6) mendukung karakter <strong>Creamy</strong>. Gunakan coil berdiameter 3.0 mm seperti <strong>Extreme V1 Hitam</strong> (US Ni80) atau <strong>Extreme V2 Kuning</strong> (Germany Ni80) untuk uap tebal pada RDA/RTA, atau <strong>Extreme V4 Ungu</strong> (diameter 2.5 mm) khusus untuk AIO.
        </p>
    </div>
    <div class="p-5 border border-zinc-250 dark:border-zinc-900 bg-zinc-950/20 rounded-xl space-y-2">
        <h4 class="text-xs font-mono font-bold text-industrial-orange uppercase tracking-wider">Liquid Sweet / Manis</h4>
        <p class="text-[11px] text-zinc-550 dark:text-zinc-450 leading-relaxed font-sans font-light text-justify">
            Jika Anda ingin memaksimalkan kemanisan liquid, pilih varian yang direkomendasikan untuk liquid <strong>Sweet</strong> di database kami, seperti <strong>Extreme V4 Ungu</strong> (sweetness 5/5) atau <strong>Extreme V6 Merah</strong> (sweetness 4/5).
        </p>
    </div>
</div>',
                'order_position' => 1,
                'is_active' => true,
            ]
        );

        LearnGuide::updateOrCreate(
            ['slug' => 'perbedaan-semua-coil'],
            [
                'title' => 'Perbedaan Karakteristik Coil V1 sampai V6',
                'content' => '<p class="text-zinc-650 dark:text-zinc-400 text-xs sm:text-sm font-sans font-light leading-relaxed text-justify">
    Masing-masing versi coil kami dirancang dengan spesifikasi lilitan dan diameter yang berbeda untuk memenuhi preferensi vapers yang unik:
</p>
<div class="space-y-4 pt-2 font-mono text-[11px]">
    <div class="flex items-start gap-4 p-4 border border-zinc-900/60 bg-zinc-900/10 rounded-lg">
        <span class="text-industrial-orange font-bold font-display text-xs">V1</span>
        <div>
            <strong class="text-slate-900 dark:text-white block uppercase">Extreme V1 Hitam (US Ni80)</strong>
            <span class="text-zinc-550 dark:text-zinc-450 leading-relaxed font-sans font-light text-justify block mt-1">Mengutamakan flavor murni dan throat hit kuat, sangat cocok untuk menthol/fruit segar.</span>
        </div>
    </div>
    <div class="flex items-start gap-4 p-4 border border-zinc-900/60 bg-zinc-900/10 rounded-lg">
        <span class="text-industrial-orange font-bold font-display text-xs">V2</span>
        <div>
            <strong class="text-slate-900 dark:text-white block uppercase">Extreme V2 Kuning (Germany Ni80)</strong>
            <span class="text-zinc-550 dark:text-zinc-450 leading-relaxed font-sans font-light text-justify block mt-1">Mengoptimalkan sweetness dan detail aroma liquid creamy kental (dessert/susu).</span>
        </div>
    </div>
    <div class="flex items-start gap-4 p-4 border border-zinc-900/60 bg-zinc-900/10 rounded-lg">
        <span class="text-industrial-orange font-bold font-display text-xs">V3</span>
        <div>
            <strong class="text-slate-900 dark:text-white block uppercase">Extreme V3 Pink (MTL Specialist)</strong>
            <span class="text-zinc-550 dark:text-zinc-450 leading-relaxed font-sans font-light text-justify block mt-1">Hambatan tinggi untuk setup daya rendah (12-18W), berfokus pada throat hit maksimal.</span>
        </div>
    </div>
    <div class="flex items-start gap-4 p-4 border border-zinc-900/60 bg-zinc-900/10 rounded-lg">
        <span class="text-industrial-orange font-bold font-display text-xs">V4</span>
        <div>
            <strong class="text-slate-900 dark:text-white block uppercase">Extreme V4 Ungu (Sweet Clapton)</strong>
            <span class="text-zinc-550 dark:text-zinc-450 leading-relaxed font-sans font-light text-justify block mt-1">Mengangkat manis maksimal dengan tarikan yang halus dan nyaman.</span>
        </div>
    </div>
    <div class="flex items-start gap-4 p-4 border border-zinc-900/60 bg-zinc-900/10 rounded-lg">
        <span class="text-industrial-orange font-bold font-display text-xs">V5</span>
        <div>
            <strong class="text-slate-900 dark:text-white block uppercase">Extreme V5 Putih (All-Arounder Balanced)</strong>
            <span class="text-zinc-550 dark:text-zinc-450 leading-relaxed font-sans font-light text-justify block mt-1">Menghasikan paduan flavor tebal, manis seimbang, dan throat hit mantap.</span>
        </div>
    </div>
    <div class="flex items-start gap-4 p-4 border border-zinc-900/60 bg-zinc-900/10 rounded-lg">
        <span class="text-industrial-orange font-bold font-display text-xs">V6</span>
        <div>
            <strong class="text-slate-900 dark:text-white block uppercase">Extreme V6 Merah (Flavor Specialist)</strong>
            <span class="text-zinc-550 dark:text-zinc-450 leading-relaxed font-sans font-light text-justify block mt-1">Fokus pada kompleksitas flavor liquid layering tinggi dengan throat hit lembut.</span>
        </div>
    </div>
</div>',
                'order_position' => 2,
                'is_active' => true,
            ]
        );

        LearnGuide::updateOrCreate(
            ['slug' => 'cara-memasang-coil'],
            [
                'title' => 'Cara Memasang Coil dengan Presisi',
                'content' => '<p class="text-zinc-650 dark:text-zinc-400 text-xs sm:text-sm font-sans font-light leading-relaxed text-justify">
    Pemasangan coil yang presisi akan mencegah kebocoran, sirkuit pendek (short circuit), dan memastikan pemanasan kawat merata dari dalam ke luar:
</p>
<ul class="list-decimal list-inside space-y-3 font-sans text-xs text-zinc-650 dark:text-zinc-400 font-light pl-2">
    <li><strong class="font-bold text-slate-900 dark:text-white">Potong Kaki Coil:</strong> Sesuaikan panjang kaki coil dengan kedalaman pos deck atomizer (sekitar 4.5 mm - 5.5 mm untuk deck postless).</li>
    <li><strong class="font-bold text-slate-900 dark:text-white">Kencangkan Baut:</strong> Masukkan kaki coil ke dalam lubang pos dan kencangkan baut pengunci dengan pas menggunakan obeng presisi.</li>
    <li><strong class="font-bold text-slate-900 dark:text-white">Posisi Tengah:</strong> Sejajarkan coil persis di tengah lubang aliran udara (airflow) untuk pendinginan kawat yang maksimal.</li>
    <li><strong class="font-bold text-slate-900 dark:text-white">Pencegahan Sentuhan:</strong> Pastikan badan coil tidak menyentuh dinding luar <em>cap</em> atomizer agar tidak memicu hubungan arus pendek (short).</li>
</ul>',
                'order_position' => 3,
                'is_active' => true,
            ]
        );

        LearnGuide::updateOrCreate(
            ['slug' => 'cara-priming-coil'],
            [
                'title' => 'Cara Priming Coil & Kapas yang Benar',
                'content' => '<p class="text-zinc-650 dark:text-zinc-400 text-xs sm:text-sm font-sans font-light leading-relaxed text-justify">
    Priming is adalah proses membasahi kapas baru secara jenuh sebelum melakukan pembakaran pertama demi menghindari gosong instan (<em>dry hit</em>):
</p>
<div class="p-5 bg-industrial-orange/5 border border-industrial-orange/20 rounded-xl space-y-3 text-xs leading-relaxed font-sans font-light">
    <p class="text-industrial-orange font-bold uppercase font-mono tracking-widest">[ GOLDEN_RULE_PRIMING ]</p>
    <p>
        1. Teteskan liquid langsung secara merata pada kawat coil dan permukaan kapas yang menyembul dari deck.
    </p>
    <p>
        2. Lakukan firing singkat pada daya rendah (e.g. 15-20W) selama 0.5 detik untuk menarik liquid meresap ke serat terdalam kapas.
    </p>
    <p>
        3. Diamkan atomizer selama minimal 3 hingga 5 menit setelah dirakit kembali sebelum Anda menghisapnya pertama kali.
    </p>
</div>',
                'order_position' => 4,
                'is_active' => true,
            ]
        );

        LearnGuide::updateOrCreate(
            ['slug' => 'cara-membersihkan-coil'],
            [
                'title' => 'Cara Membersihkan Coil secara Steril',
                'content' => '<p class="text-zinc-650 dark:text-zinc-400 text-xs sm:text-sm font-sans font-light leading-relaxed text-justify">
    Coil handmade Ni80 kami dapat dicuci dan digunakan kembali berkali-kali. Berikut metode sterilisasi yang kami rekomendasikan di laboratorium kami:
</p>
<ul class="list-disc list-inside space-y-3 font-sans text-xs text-zinc-650 dark:text-zinc-400 font-light pl-2">
    <li><strong class="font-bold text-slate-900 dark:text-white">Ultrasonic Cleaner:</strong> Masukkan deck atomizer (tanpa kapas) ke dalam wadah pembersih ultrasonik berisi air hangat selama 5-8 menit untuk merontokkan kerak liquid.</li>
    <li><strong class="font-bold text-slate-900 dark:text-white">Sikat Halus:</strong> Sikat permukaan kawat secara perlahan menggunakan sikat kawat kuningan mikro atau sikat gigi berbulu halus untuk membuang partikel karbon sisa pembakaran.</li>
    <li><strong class="font-bold text-slate-900 dark:text-white">Bilas Air Mengalir:</strong> Bilas bersih dengan air steril (air suling), lalu lakukan pemanasan kering ringan pada mod (watt rendah) untuk mengeringkannya secara merata.</li>
</ul>',
                'order_position' => 5,
                'is_active' => true,
            ]
        );

        LearnGuide::updateOrCreate(
            ['slug' => 'mengapa-coil-cepat-gosong'],
            [
                'title' => 'Mengapa Coil Cepat Gosong (Dry Hits)',
                'content' => '<p class="text-zinc-650 dark:text-zinc-400 text-xs sm:text-sm font-sans font-light leading-relaxed text-justify">
    Jika coil baru Anda mendadak gosong dalam waktu 1-2 hari, biasanya disebabkan oleh faktor-faktor teknis eksternal berikut:
</p>
<div class="grid grid-cols-1 gap-4 pt-2 font-mono text-[11px] text-zinc-550 dark:text-zinc-450">
    <div class="flex gap-2">
        <span class="text-red-500 font-bold">[!]</span>
        <span><strong>Pemanis Buatan Tinggi (Sweetener):</strong> Liquid murah atau liquid dengan kadar pemanis buatan tinggi akan cepat mengkristal di permukaan kawat panas dan memicu kerak gosong.</span>
    </div>
    <div class="flex gap-2">
        <span class="text-red-500 font-bold">[!]</span>
        <span><strong>Wicking Terlalu Padat:</strong> Memasukkan kapas terlalu padat ke dalam lilitan kawat membatasi aliran kapiler liquid sehingga bagian tengah kapas mengering saat firing.</span>
    </div>
    <div class="flex gap-2">
        <span class="text-red-500 font-bold">[!]</span>
        <span><strong>Watt Terlalu Tinggi:</strong> Melakukan firing di luar batas daya optimal coil membakar liquid lebih cepat daripada kemampuan serap kapas.</span>
    </div>
</div>',
                'order_position' => 6,
                'is_active' => true,
            ]
        );

        LearnGuide::updateOrCreate(
            ['slug' => 'tips-memperpanjang-umur-coil'],
            [
                'title' => 'Tips Memperpanjang Umur Coil',
                'content' => '<p class="text-zinc-650 dark:text-zinc-400 text-xs sm:text-sm font-sans font-light leading-relaxed text-justify">
    Terapkan tips praktis ini agar coil handmade Anda bertahan optimal hingga lebih dari 3 minggu penggunaan harian:
</p>
<ul class="list-disc list-inside space-y-3 font-sans text-xs text-zinc-650 dark:text-zinc-400 font-light pl-2">
    <li><strong class="font-bold text-slate-900 dark:text-white">Gunakan Kapas Organik Murni:</strong> Hindari serat kapas murah berpemutih yang cepat aus dan merusak cita rasa liquid Anda.</li>
    <li><strong class="font-bold text-slate-900 dark:text-white">Hindari Dry Burn Berlebihan:</strong> Saat membersihkan coil, jangan memanaskan kawat sampai menyala merah membara terlalu lama karena dapat merusak struktur logam paduan Ni80.</li>
    <li><strong class="font-bold text-slate-900 dark:text-white">Lakukan Drip Rutin:</strong> Jaga agar kapas selalu basah secara konsisten, jangan menunda meneteskan liquid sampai terasa kering (dry hit).</li>
</ul>',
                'order_position' => 7,
                'is_active' => true,
            ]
        );
    }
}
