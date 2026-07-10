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

    public function test_validation_cotton_specifications(): void
    {
        $user = User::factory()->create();

        // Submit cotton specs via specifications_text
        $response = $this->actingAs($user)->post('/admin/products', [
            'title' => 'Premium Cotton Test',
            'category' => 'cotton',
            'price' => 30000,
            'stock' => 20,
            'character_description' => 'Menghasilkan rasa liquid yang bersih.',
            'specifications_text' => "Clean Flavor Delivery\nFast Liquid Absorption\nPremium Organic Fiber"
        ]);

        $response->assertRedirect('/admin/products');
        
        $product = Product::where('title', 'Premium Cotton Test')->first();
        $this->assertCount(3, $product->specifications['items']);
        $this->assertEquals('Clean Flavor Delivery', $product->specifications['items'][0]);
        $this->assertEquals('Fast Liquid Absorption', $product->specifications['items'][1]);
        $this->assertEquals('Premium Organic Fiber', $product->specifications['items'][2]);
    }

    public function test_coil_helper_inputs_formatting(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/admin/products', [
            'title' => 'Formatted Coil Test',
            'category' => 'coil',
            'price' => 60000,
            'stock' => 15,
            'character_description' => 'Meningkatkan rasa liquid kesayangan Anda.',
            'specifications_resistance_single' => 0.36,
            'specifications_resistance_dual' => 0.18,
            'specifications_foot' => 'Kaki Sejajar',
            'specifications_wrap_value' => 5,
            'specifications' => [
                'flavor' => 4,
                'sweetness' => 3,
                'throat_hit' => 3,
                'diameter' => '3.0 mm',
                'version' => 'V1',
                'material' => 'Ni80',
                'durability' => '2 minggu',
            ]
        ]);

        $response->assertRedirect('/admin/products');
        
        $product = Product::where('title', 'Formatted Coil Test')->first();
        $this->assertEquals('0.36 Ω single / 0.18 Ω dual', $product->specifications['resistance'] ?? null);
        $this->assertEquals('0.36', $product->specifications['resistance_single'] ?? null);
        $this->assertEquals('0.18', $product->specifications['resistance_dual'] ?? null);
        $this->assertEquals('Kaki Sejajar', $product->specifications['foot'] ?? null);
        $this->assertEquals('5 wraps', $product->specifications['wrap'] ?? null);
        $this->assertEquals('V1', $product->specifications['version'] ?? null);
    }

    public function test_edit_form_renders_parsed_values(): void
    {
        $user = User::factory()->create();
        
        $product = Product::create([
            'title' => 'Clapton Coil To Edit',
            'category' => 'coil',
            'price' => 50000,
            'stock' => 10,
            'character_description' => 'Untuk test edit form parsing.',
            'specifications' => [
                'flavor' => 4,
                'sweetness' => 4,
                'throat_hit' => 4,
                'diameter' => '3.0 mm',
                'version' => 'V1',
                'resistance' => '0.36 Ω single / 0.18 Ω dual',
                'resistance_single' => '0.36',
                'resistance_dual' => '0.18',
                'foot' => 'Kaki Sejajar',
                'wrap' => '5 wraps',
                'material' => 'Ni80',
                'durability' => '2-3 minggu',
            ],
        ]);

        $response = $this->actingAs($user)->get("/admin/products/{$product->id}/edit");

        $response->assertOk();
        $response->assertSee('value="0.36"', false);
        $response->assertSee('value="0.18"', false);
        $response->assertSee('value="V1"', false);
        $response->assertSee('<option value="Kaki Sejajar" selected>', false);
        $response->assertSee('<option value="5" selected>', false);
    }

    public function test_edit_cotton_form_renders_specifications(): void
    {
        $user = User::factory()->create();
        
        $product = Product::create([
            'title' => 'Premium Cotton To Edit',
            'category' => 'cotton',
            'price' => 30000,
            'stock' => 10,
            'character_description' => 'Untuk test edit cotton.',
            'specifications' => [
                'items' => [
                    'Clean Flavor Delivery',
                    'Fast Liquid Absorption',
                ],
            ],
        ]);

        $response = $this->actingAs($user)->get("/admin/products/{$product->id}/edit");

        $response->assertOk();
        $response->assertSee('Clean Flavor Delivery');
        $response->assertSee('Fast Liquid Absorption');
    }

    public function test_marketplace_urls_validation(): void
    {
        $user = User::factory()->create();

        // 1. Submit invalid URLs
        $response = $this->actingAs($user)->post('/admin/products', [
            'title' => 'Invalid URL Product',
            'category' => 'cotton',
            'price' => 20000,
            'stock' => 15,
            'character_description' => 'Test deskripsi.',
            'specifications_text' => 'Spec Item',
            'marketplace_urls' => [
                'shopee' => 'not-a-valid-url',
            ]
        ]);

        $response->assertSessionHasErrors(['marketplace_urls.shopee']);

        // 2. Submit valid URLs
        $response = $this->actingAs($user)->post('/admin/products', [
            'title' => 'Valid URL Product',
            'category' => 'cotton',
            'price' => 20000,
            'stock' => 15,
            'character_description' => 'Test deskripsi.',
            'specifications_text' => 'Spec Item',
            'marketplace_urls' => [
                'shopee' => 'https://shopee.co.id/my-awesome-product',
                'tokopedia' => 'https://tokopedia.com/my-awesome-product',
                'blibli' => '',
            ]
        ]);

        $response->assertRedirect('/admin/products');
        
        $product = Product::where('title', 'Valid URL Product')->first();
        $this->assertNotNull($product->marketplace_urls);
        $this->assertEquals('https://shopee.co.id/my-awesome-product', $product->marketplace_urls['shopee']);
        $this->assertEquals('https://tokopedia.com/my-awesome-product', $product->marketplace_urls['tokopedia']);
    }
}
