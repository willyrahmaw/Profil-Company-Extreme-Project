<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\User;
use App\Models\LearnGuide;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class LearnGuideTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * Test guest cannot access admin guides.
     */
    public function test_guest_cannot_access_guides(): void
    {
        $response = $this->get('/admin/guides');
        $response->assertRedirect('/admin/login');
    }

    /**
     * Test admin can view index and create.
     */
    public function test_admin_can_view_index_and_create(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/admin/guides');
        $response->assertStatus(200);
        $response->assertSee('KELOLA PANDUAN EDUKASI');

        $response = $this->actingAs($user)->get('/admin/guides/create');
        $response->assertStatus(200);
        $response->assertSee('BUAT PANDUAN BARU');
    }

    /**
     * Test admin can store learn guide.
     */
    public function test_admin_can_store_guide(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/admin/guides', [
            'title' => 'Cara Merawat Coil Baru',
            'content' => '<p>Bersihkan dengan ultrasonic cleaner.</p>',
            'order_position' => 1,
            'is_active' => '1',
        ]);

        $response->assertRedirect('/admin/guides');
        $this->assertDatabaseHas('learn_guides', [
            'title' => 'Cara Merawat Coil Baru',
            'slug' => 'cara-merawat-coil-baru',
            'content' => '<p>Bersihkan dengan ultrasonic cleaner.</p>',
            'order_position' => 1,
            'is_active' => true,
        ]);
    }

    /**
     * Test admin can edit and update learn guide.
     */
    public function test_admin_can_update_guide(): void
    {
        $user = User::factory()->create();
        $guide = LearnGuide::create([
            'title' => 'Cara Bersih',
            'slug' => 'cara-bersih',
            'content' => '<p>Konten asli.</p>',
            'order_position' => 2,
            'is_active' => true,
        ]);

        $response = $this->actingAs($user)->get("/admin/guides/{$guide->id}/edit");
        $response->assertStatus(200);
        $response->assertSee('UBAH PANDUAN EDUKASI');

        $response = $this->actingAs($user)->put("/admin/guides/{$guide->id}", [
            'title' => 'Cara Bersih Baru',
            'content' => '<p>Konten baru.</p>',
            'order_position' => 3,
        ]);

        $response->assertRedirect('/admin/guides');
        $this->assertDatabaseHas('learn_guides', [
            'id' => $guide->id,
            'title' => 'Cara Bersih Baru',
            'slug' => 'cara-bersih-baru',
            'content' => '<p>Konten baru.</p>',
            'order_position' => 3,
            'is_active' => false,
        ]);
    }

    /**
     * Test admin can delete learn guide.
     */
    public function test_admin_can_delete_guide(): void
    {
        $user = User::factory()->create();
        $guide = LearnGuide::create([
            'title' => 'Hapus Saya',
            'slug' => 'hapus-saya',
            'content' => '<p>Konten hapus.</p>',
            'order_position' => 1,
            'is_active' => true,
        ]);

        $response = $this->actingAs($user)->delete("/admin/guides/{$guide->id}");
        $response->assertRedirect('/admin/guides');
        $this->assertDatabaseMissing('learn_guides', [
            'id' => $guide->id,
        ]);
    }

    /**
     * Test public learn page loads guides successfully.
     */
    public function test_public_learn_page_loads_guides(): void
    {
        LearnGuide::create([
            'title' => 'Panduan Publik Unik',
            'slug' => 'panduan-publik-unik',
            'content' => 'Detail unik.',
            'order_position' => 10,
            'is_active' => true,
        ]);

        $response = $this->get('/learn');
        $response->assertStatus(200);
        $response->assertSee('CUSTOMER EDUCATION HUB');
        $response->assertSee('Panduan Publik Unik');
    }
}
