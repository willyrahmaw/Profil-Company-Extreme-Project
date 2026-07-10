<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\Event;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class EventTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * Test guest cannot access admin events management.
     */
    public function test_guest_cannot_access_events_management(): void
    {
        $response = $this->get('/admin/events');
        $response->assertRedirect('/admin/login');
    }

    /**
     * Test admin can create event and validation works.
     */
    public function test_validation_and_creation_of_event(): void
    {
        Storage::fake('public');
        $user = User::factory()->create();

        // 1. Invalid input: end_date before start_date
        $response = $this->actingAs($user)->post('/admin/events', [
            'name' => 'Wrong Dates Event',
            'discount_percentage' => 15,
            'start_date' => now()->addDays(2)->format('Y-m-d H:i'),
            'end_date' => now()->addDays(1)->format('Y-m-d H:i'),
            'is_active' => '1',
        ]);
        $response->assertSessionHasErrors(['end_date']);

        // 2. Valid input with image upload
        $image = UploadedFile::fake()->image('flyer.jpg');
        $response = $this->actingAs($user)->post('/admin/events', [
            'name' => 'Event Kemerdekaan',
            'discount_percentage' => 15,
            'start_date' => now()->subDay()->format('Y-m-d\TH:i'),
            'end_date' => now()->addDays(2)->format('Y-m-d\TH:i'),
            'is_active' => '1',
            'image' => $image,
        ]);
        $response->assertRedirect('/admin/events');
        
        $event = Event::where('name', 'Event Kemerdekaan')->first();
        $this->assertNotNull($event);
        $this->assertNotNull($event->image_path);
        
        // Assert storage has file
        $storedPath = str_replace('/storage/', '', $event->image_path);
        Storage::disk('public')->assertExists($storedPath);
    }

    /**
     * Test deactivating other events automatically when a new one is set active.
     */
    public function test_automatic_deactivation_of_previous_active_events(): void
    {
        // Create first active event
        $event1 = Event::create([
            'name' => 'Promo Awal',
            'discount_percentage' => 10,
            'start_date' => now()->subDay(),
            'end_date' => now()->addDay(),
            'is_active' => true,
        ]);

        $this->assertTrue($event1->fresh()->is_active);

        // Create second active event
        $event2 = Event::create([
            'name' => 'Promo Baru',
            'discount_percentage' => 20,
            'start_date' => now()->subDay(),
            'end_date' => now()->addDay(),
            'is_active' => true,
        ]);

        // Assert event 1 is now inactive, event 2 is active
        $this->assertFalse($event1->fresh()->is_active);
        $this->assertTrue($event2->fresh()->is_active);
    }

    /**
     * Test active event affects public landing page prices.
     */
    public function test_active_event_affects_public_landing_page_prices(): void
    {
        // 1. Create a product
        $product = Product::create([
            'title' => 'Test Coil Sweetness',
            'slug' => 'test-coil-sweetness',
            'category' => 'coil',
            'price' => 120000.00,
            'stock' => 10,
            'character_description' => 'Best coil ever created.',
            'specifications' => [
                'flavor' => 5,
                'sweetness' => 5,
                'throat_hit' => 3,
            ]
        ]);

        // 2. Create active event with 25% discount and current date range
        Event::create([
            'name' => 'Promo Hemat',
            'discount_percentage' => 25,
            'start_date' => now()->subDays(2),
            'end_date' => now()->addDays(2),
            'is_active' => true,
            'image_path' => '/storage/events/promo.jpg',
        ]);

        // 3. Request welcome page
        $response = $this->get('/');
        $response->assertStatus(200);

        // Assert that name of event and discounted price (Rp 90.000) are present in page
        $response->assertSee('Promo Hemat');
        $response->assertSee('25% OFF');
        $response->assertSee('Rp 90.000'); // Rp 120.000 - 25% = Rp 90.000
        $response->assertSee('/storage/events/promo.jpg'); // Modal popup image
    }

    /**
     * Test expired event does not affect landing page prices.
     */
    public function test_expired_event_does_not_affect_landing_page_prices(): void
    {
        // 1. Create a product
        $product = Product::create([
            'title' => 'Test Coil Sweetness',
            'slug' => 'test-coil-sweetness',
            'category' => 'coil',
            'price' => 120000.00,
            'stock' => 10,
            'character_description' => 'Best coil ever created.',
            'specifications' => [
                'flavor' => 5,
                'sweetness' => 5,
                'throat_hit' => 3,
            ]
        ]);

        // 2. Create active event with 25% discount but dates are in the past
        Event::create([
            'name' => 'Promo Kadaluarsa',
            'discount_percentage' => 25,
            'start_date' => now()->subDays(5),
            'end_date' => now()->subDays(2),
            'is_active' => true,
            'image_path' => '/storage/events/promo.jpg',
        ]);

        // 3. Request welcome page
        $response = $this->get('/');
        $response->assertStatus(200);

        // Assert that name of event and discount price are NOT present in page
        $response->assertDontSee('Promo Kadaluarsa');
        $response->assertDontSee('25% OFF');
        $response->assertDontSee('Rp 90.000');
        $response->assertSee('Rp 120.000');
    }
}
