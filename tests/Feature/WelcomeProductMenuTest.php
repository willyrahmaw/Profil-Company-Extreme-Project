<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\Product;
use App\Models\Shop;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class WelcomeProductMenuTest extends TestCase
{
    use DatabaseTransactions;

    public function test_welcome_has_product_menu_anchor(): void
    {
        $response = $this->get(route('home'));

        $response->assertOk();
        $response->assertSee('href="#products"', false);
        $response->assertSee('PRODUK');
    }

    public function test_welcome_shows_more_products_button_when_category_has_at_least_six_products(): void
    {
        Product::query()->delete();
        Shop::query()->delete();

        for ($i = 1; $i <= 6; $i++) {
            Product::create([
                'title' => "Coil Publik {$i}",
                'category' => 'coil',
                'price' => 50000,
                'stock' => 10,
                'character_description' => 'Produk publik untuk menguji tombol lihat produk lainnya.',
                'specifications' => [
                    'flavor' => 4,
                    'sweetness' => 4,
                    'throat_hit' => 3,
                ],
                'created_at' => now()->addSeconds($i),
                'updated_at' => now()->addSeconds($i),
            ]);
        }

        $response = $this->get(route('home'));

        $response->assertOk();
        $response->assertSee('LIHAT PRODUK LAINNYA');
        $response->assertSee('x-show="6 <= 5 || showAllCoils"', false);
    }

    public function test_welcome_hides_more_products_button_when_category_has_less_than_six_products(): void
    {
        Product::query()->delete();
        Shop::query()->delete();

        for ($i = 1; $i <= 5; $i++) {
            Product::create([
                'title' => "Coil Ringkas {$i}",
                'category' => 'coil',
                'price' => 50000,
                'stock' => 10,
                'character_description' => 'Produk publik untuk menguji batas tombol lihat produk lainnya.',
                'specifications' => [
                    'flavor' => 4,
                    'sweetness' => 4,
                    'throat_hit' => 3,
                ],
                'created_at' => now()->addSeconds($i),
                'updated_at' => now()->addSeconds($i),
            ]);
        }

        $response = $this->get(route('home'));

        $response->assertOk();
        $response->assertDontSee('LIHAT PRODUK LAINNYA');
    }
}