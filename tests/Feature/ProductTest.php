<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\User;
use App\Models\Product;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * Test guest cannot access admin dashboard.
     */
    public function test_guest_cannot_access_admin_dashboard(): void
    {
        $response = $this->get('/admin/dashboard');
        $response->assertRedirect('/admin/login');
    }

    /**
     * Test validation requires valid specs depending on category.
     */
    public function test_validation_coil_specifications(): void
    {
        $user = User::factory()->create();

        // 1. Submit invalid coil specs (missing parameters)
        $response = $this->actingAs($user)->post('/admin/products', [
            'title' => 'Invalid Coil Test',
            'category' => 'coil',
            'price' => 50000,
            'stock' => 10,
            'character_description' => 'Pilihan terbaik bagi pecinta liquid manis.',
            'specifications' => [
                'flavor' => 80,
                // sweetness is missing
            ]
        ]);

        $response->assertSessionHasErrors(['specifications.sweetness']);

        // 2. Submit valid coil specs
        $response = $this->actingAs($user)->post('/admin/products', [
            'title' => 'Valid Coil Test',
            'category' => 'coil',
            'price' => 55000,
            'stock' => 12,
            'character_description' => 'Pilihan terbaik bagi pecinta liquid manis. Mengangkat sweetness lebih maksimal dengan sensasi inhale yang halus.',
            'specifications' => [
                'flavor' => 5,
                'sweetness' => 4,
                'throat_hit' => 3,
            ]
        ]);

        $response->assertRedirect('/admin/products');
        $this->assertDatabaseHas('products', [
            'title' => 'Valid Coil Test',
            'category' => 'coil',
        ]);

        $product = Product::where('title', 'Valid Coil Test')->first();
        $this->assertEquals(5, $product->specifications['flavor']);
    }

    /**
     * Test cotton specifications input formatting.
     */
    public function test_validation_cotton_specifications(): void
    {
        $user = User::factory()->create();

        // Submit cotton specs, verifying they are casted/defaulted properly to boolean
        $response = $this->actingAs($user)->post('/admin/products', [
            'title' => 'Premium Cotton Test',
            'category' => 'cotton',
            'price' => 30000,
            'stock' => 20,
            'character_description' => 'Menghasilkan rasa liquid yang bersih.',
            'specifications' => [
                'clean_flavor_delivery' => '1',
                // other parameters omitted (should default to false)
            ]
        ]);

        $response->assertRedirect('/admin/products');
        
        $product = Product::where('title', 'Premium Cotton Test')->first();
        $this->assertTrue($product->specifications['clean_flavor_delivery']);
        $this->assertFalse($product->specifications['fast_liquid_absorption']);
        $this->assertFalse($product->specifications['premium_organic_fiber']);
    }
}
