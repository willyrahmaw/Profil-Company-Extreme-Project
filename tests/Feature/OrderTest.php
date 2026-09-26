<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\Event;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Str;
use Tests\TestCase;

class OrderTest extends TestCase
{
    use DatabaseTransactions;

    protected function setUp(): void
    {
        parent::setUp();

        Event::query()->update(['is_active' => false]);
    }

    private function createProduct(float $price): Product
    {
        return Product::create([
            'title' => 'Coil Order '.Str::random(6),
            'category' => 'coil',
            'price' => $price,
            'stock' => 10,
            'character_description' => 'Produk untuk menguji pencatatan order.',
            'specifications' => ['flavor' => 4, 'sweetness' => 4, 'throat_hit' => 3],
        ]);
    }

    public function test_order_prices_are_taken_from_the_database(): void
    {
        $product = $this->createProduct(50000);

        $response = $this->postJson(route('api.orders.store'), [
            'buyer_name' => 'Budi',
            'buyer_address' => 'Jl. Merdeka 1',
            'total_price' => 1,
            'items' => [
                ['product_id' => $product->id, 'quantity' => 3, 'price' => 1, 'total_price' => 3, 'product_title' => 'Palsu'],
            ],
        ]);

        $response->assertCreated();

        $order = Order::with('items')->findOrFail($response->json('order.id'));
        $this->assertEquals(150000, $order->total_price);
        $this->assertEquals(50000, $order->items[0]->price);
        $this->assertEquals(150000, $order->items[0]->total_price);
        $this->assertSame($product->title, $order->items[0]->product_title);
    }

    public function test_order_applies_active_event_discount(): void
    {
        $product = $this->createProduct(40000);
        Event::create(['name' => 'Promo', 'discount_percentage' => 25, 'is_active' => true]);

        $response = $this->postJson(route('api.orders.store'), [
            'buyer_name' => 'Budi',
            'buyer_address' => 'Jl. Merdeka 1',
            'items' => [['product_id' => $product->id, 'quantity' => 2]],
        ]);

        $response->assertCreated();
        $this->assertEquals(60000, Order::findOrFail($response->json('order.id'))->total_price);
    }

    public function test_order_rejects_unknown_products_and_oversized_input(): void
    {
        $response = $this->postJson(route('api.orders.store'), [
            'buyer_name' => 'Budi',
            'buyer_address' => str_repeat('a', 1001),
            'items' => [['product_id' => 999999999, 'quantity' => 1]],
        ]);

        $response->assertUnprocessable();
        $response->assertJsonValidationErrors(['buyer_address', 'items.0.product_id']);
    }

    public function test_order_endpoint_is_rate_limited(): void
    {
        for ($attempt = 1; $attempt <= 10; $attempt++) {
            $this->postJson(route('api.orders.store'), [])->assertUnprocessable();
        }

        $this->postJson(route('api.orders.store'), [])->assertTooManyRequests();
    }
}
