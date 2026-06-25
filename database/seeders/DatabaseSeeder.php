<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\User;
use App\Models\Product;
use App\Models\Shop;
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
        // Coils
        Product::updateOrCreate(
            ['slug' => 'cyber-alien-clapton-v1'],
            [
                'title' => 'Cyber Alien Clapton V1',
                'category' => 'coil',
                'price' => 75000.00,
                'stock' => 50,
                'character_description' => 'Pilihan terbaik bagi pecinta liquid manis. Mengangkat sweetness lebih maksimal dengan sensasi inhale yang halus.',
                'specifications' => [
                    'flavor' => 5,
                    'sweetness' => 5,
                    'throat_hit' => 3,
                ],
            ]
        );

        Product::updateOrCreate(
            ['slug' => 'sub-ohm-fused-coil'],
            [
                'title' => 'Sub-Ohm Fused Coil',
                'category' => 'coil',
                'price' => 60000.00,
                'stock' => 42,
                'character_description' => 'Pilihan terbaik bagi pecinta liquid manis. Mengangkat sweetness lebih maksimal dengan sensasi inhale yang halus.',
                'specifications' => [
                    'flavor' => 4,
                    'sweetness' => 4,
                    'throat_hit' => 4,
                ],
            ]
        );

        // Cottons
        Product::updateOrCreate(
            ['slug' => 'handmade-premium-organic-cotton'],
            [
                'title' => 'Handmade Premium Organic Cotton',
                'category' => 'cotton',
                'price' => 35000.00,
                'stock' => 100,
                'character_description' => 'Menghasilkan rasa liquid yang bersih dengan daya serap cepat untuk penggunaan intensif.',
                'specifications' => [
                    'clean_flavor_delivery' => true,
                    'fast_liquid_absorption' => true,
                    'premium_organic_fiber' => true,
                ],
            ]
        );

        Product::updateOrCreate(
            ['slug' => 'cyber-absorbent-cotton'],
            [
                'title' => 'Cyber Absorbent Cotton',
                'category' => 'cotton',
                'price' => 45000.00,
                'stock' => 80,
                'character_description' => 'Menghasilkan rasa liquid yang bersih dengan daya serap cepat untuk penggunaan intensif.',
                'specifications' => [
                    'clean_flavor_delivery' => true,
                    'fast_liquid_absorption' => true,
                    'premium_organic_fiber' => true,
                ],
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
    }
}
