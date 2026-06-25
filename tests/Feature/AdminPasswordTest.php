<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AdminPasswordTest extends TestCase
{
    use DatabaseTransactions;

    public function test_admin_can_open_change_password_page(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('admin.password.edit'));

        $response->assertOk();
        $response->assertSee('Ganti Password');
    }

    public function test_admin_must_enter_current_password_to_update_password(): void
    {
        $user = User::factory()->create([
            'password' => Hash::make('password-lama'),
        ]);

        $response = $this->actingAs($user)->put(route('admin.password.update'), [
            'current_password' => 'password-salah',
            'password' => 'password-baru',
            'password_confirmation' => 'password-baru',
        ]);

        $response->assertSessionHasErrors(['current_password']);
        $this->assertTrue(Hash::check('password-lama', $user->fresh()->password));
    }

    public function test_admin_can_update_password(): void
    {
        $user = User::factory()->create([
            'password' => Hash::make('password-lama'),
        ]);

        $response = $this->actingAs($user)->put(route('admin.password.update'), [
            'current_password' => 'password-lama',
            'password' => 'password-baru',
            'password_confirmation' => 'password-baru',
        ]);

        $response->assertRedirect(route('admin.password.edit'));
        $response->assertSessionHas('success');
        $this->assertTrue(Hash::check('password-baru', $user->fresh()->password));
    }
}