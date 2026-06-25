<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\Product;
use App\Models\Shop;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Pagination\LengthAwarePaginator;
use Tests\TestCase;

class AdminPaginationTest extends TestCase
{
    use DatabaseTransactions;

    public function test_products_index_is_paginated(): void
    {
        Product::query()->delete();
        $user = User::factory()->create();

        for ($i = 1; $i <= 12; $i++) {
            Product::create([
                'title' => "Produk Test {$i}",
                'category' => 'coil',
                'price' => 50000,
                'stock' => 10,
                'character_description' => 'Produk test untuk memastikan pagination berjalan.',
                'specifications' => [
                    'flavor' => 4,
                    'sweetness' => 4,
                    'throat_hit' => 3,
                ],
                'created_at' => now()->addSeconds($i),
                'updated_at' => now()->addSeconds($i),
            ]);
        }

        $response = $this->actingAs($user)->get(route('admin.products.index', ['page' => 2]));

        $response->assertOk();
        $response->assertViewHas('products', function ($products) {
            return $products instanceof LengthAwarePaginator
                && $products->perPage() === 10
                && $products->currentPage() === 2
                && $products->total() === 12
                && $products->count() === 2;
        });
    }

    public function test_shops_index_is_paginated(): void
    {
        Shop::query()->delete();
        $user = User::factory()->create();

        for ($i = 1; $i <= 11; $i++) {
            Shop::create([
                'name' => "Toko Test {$i}",
                'url' => "https://example.com/toko-{$i}",
                'platform' => 'tiktok',
                'is_active' => true,
                'created_at' => now()->addSeconds($i),
                'updated_at' => now()->addSeconds($i),
            ]);
        }

        $response = $this->actingAs($user)->get(route('admin.shops.index', ['page' => 2]));

        $response->assertOk();
        $response->assertViewHas('shops', function ($shops) {
            return $shops instanceof LengthAwarePaginator
                && $shops->perPage() === 10
                && $shops->currentPage() === 2
                && $shops->total() === 11
                && $shops->count() === 1;
        });
    }

    public function test_dashboard_products_table_is_paginated(): void
    {
        Product::query()->delete();
        $user = User::factory()->create();

        for ($i = 1; $i <= 7; $i++) {
            Product::create([
                'title' => "Produk Dashboard {$i}",
                'category' => 'cotton',
                'price' => 35000,
                'stock' => 20,
                'character_description' => 'Produk dashboard untuk memastikan tabel ringkas tetap bisa dipaginasi.',
                'specifications' => [
                    'clean_flavor_delivery' => true,
                    'fast_liquid_absorption' => true,
                    'premium_organic_fiber' => true,
                ],
                'created_at' => now()->addSeconds($i),
                'updated_at' => now()->addSeconds($i),
            ]);
        }

        $response = $this->actingAs($user)->get(route('admin.dashboard', ['products_page' => 2]));

        $response->assertOk();
        $response->assertViewHas('latestProducts', function ($products) {
            return $products instanceof LengthAwarePaginator
                && $products->perPage() === 5
                && $products->currentPage() === 2
                && $products->total() === 7
                && $products->count() === 2;
        });
    }
}