<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\User;
use App\Models\Testimonial;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class TestimonialTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * Test guest cannot access testimonials index.
     */
    public function test_guest_cannot_access_testimonials(): void
    {
        $response = $this->get('/admin/testimonials');
        $response->assertRedirect('/admin/login');
    }

    /**
     * Test admin can view index and create.
     */
    public function test_admin_can_view_index_and_create(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/admin/testimonials');
        $response->assertStatus(200);
        $response->assertSee('KELOLA TESTIMONI');

        $response = $this->actingAs($user)->get('/admin/testimonials/create');
        $response->assertStatus(200);
        $response->assertSee('BUAT TESTIMONI BARU');
    }

    /**
     * Test admin can store testimonial.
     */
    public function test_admin_can_store_testimonial(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/admin/testimonials', [
            'name' => 'Fulan',
            'content' => 'Rasa liquidnya mantap nendang abis.',
            'stars' => 5,
            'avatar_initial' => 'F',
            'is_active' => '1',
        ]);

        $response->assertRedirect('/admin/testimonials');
        $this->assertDatabaseHas('testimonials', [
            'name' => 'Fulan',
            'content' => 'Rasa liquidnya mantap nendang abis.',
            'stars' => 5,
            'avatar_initial' => 'F',
            'is_active' => true,
        ]);
    }

    /**
     * Test avatar initial auto fill when empty.
     */
    public function test_testimonial_autofills_avatar_initial(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/admin/testimonials', [
            'name' => 'Gerry',
            'content' => 'Sangat awet.',
            'stars' => 4,
            'avatar_initial' => '',
            'is_active' => '1',
        ]);

        $response->assertRedirect('/admin/testimonials');
        $this->assertDatabaseHas('testimonials', [
            'name' => 'Gerry',
            'avatar_initial' => 'G',
        ]);
    }

    /**
     * Test admin can edit and update testimonial.
     */
    public function test_admin_can_update_testimonial(): void
    {
        $user = User::factory()->create();
        $testimonial = Testimonial::create([
            'name' => 'Budi',
            'content' => 'Koilnya jos.',
            'stars' => 5,
            'avatar_initial' => 'B',
            'is_active' => true,
        ]);

        $response = $this->actingAs($user)->get("/admin/testimonials/{$testimonial->id}/edit");
        $response->assertStatus(200);
        $response->assertSee('UBAH TESTIMONI PELANGGAN');

        $response = $this->actingAs($user)->put("/admin/testimonials/{$testimonial->id}", [
            'name' => 'Budi Baru',
            'content' => 'Koilnya luar biasa jos.',
            'stars' => 4,
            'avatar_initial' => 'BB',
        ]);

        $response->assertRedirect('/admin/testimonials');
        $this->assertDatabaseHas('testimonials', [
            'id' => $testimonial->id,
            'name' => 'Budi Baru',
            'content' => 'Koilnya luar biasa jos.',
            'stars' => 4,
            'avatar_initial' => 'BB',
            'is_active' => false,
        ]);
    }

    /**
     * Test admin can delete testimonial.
     */
    public function test_admin_can_delete_testimonial(): void
    {
        $user = User::factory()->create();
        $testimonial = Testimonial::create([
            'name' => 'Budi',
            'content' => 'Koilnya jos.',
            'stars' => 5,
            'avatar_initial' => 'B',
            'is_active' => true,
        ]);

        $response = $this->actingAs($user)->delete("/admin/testimonials/{$testimonial->id}");
        $response->assertRedirect('/admin/testimonials');
        $this->assertDatabaseMissing('testimonials', [
            'id' => $testimonial->id,
        ]);
    }
}
