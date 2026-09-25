<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AdminProfileTest extends TestCase
{
    use DatabaseTransactions;

    public function test_admin_can_open_profile_page(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('admin.profile.edit'));

        $response->assertOk();
        $response->assertSee('Ganti Email');
        $response->assertSee('Ganti Password');
        $response->assertSee($user->email);
    }

    public function test_old_password_url_redirects_to_profile(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/admin/password');

        $response->assertRedirect('/admin/profile');
    }

    public function test_guest_cannot_access_profile(): void
    {
        $this->get(route('admin.profile.edit'))->assertRedirect(route('login'));
        $this->put(route('admin.profile.email.update'), ['email' => 'x@example.com'])->assertRedirect(route('login'));
    }

    public function test_admin_can_update_email(): void
    {
        $user = User::factory()->create([
            'email' => 'lama@example.com',
            'password' => Hash::make('password-lama'),
        ]);

        $response = $this->actingAs($user)->put(route('admin.profile.email.update'), [
            'email' => 'baru@example.com',
            'current_password' => 'password-lama',
        ]);

        $response->assertRedirect(route('admin.profile.edit'));
        $response->assertSessionHas('success');
        $this->assertSame('baru@example.com', $user->fresh()->email);
    }

    public function test_admin_must_enter_current_password_to_update_email(): void
    {
        $user = User::factory()->create([
            'email' => 'lama@example.com',
            'password' => Hash::make('password-lama'),
        ]);

        $response = $this->actingAs($user)->put(route('admin.profile.email.update'), [
            'email' => 'baru@example.com',
            'current_password' => 'password-salah',
        ]);

        $response->assertSessionHasErrorsIn('updateEmail', ['current_password']);
        $this->assertSame('lama@example.com', $user->fresh()->email);
    }

    public function test_admin_cannot_use_email_taken_by_another_user(): void
    {
        User::factory()->create(['email' => 'terpakai@example.com']);
        $user = User::factory()->create([
            'email' => 'lama@example.com',
            'password' => Hash::make('password-lama'),
        ]);

        $response = $this->actingAs($user)->put(route('admin.profile.email.update'), [
            'email' => 'terpakai@example.com',
            'current_password' => 'password-lama',
        ]);

        $response->assertSessionHasErrorsIn('updateEmail', ['email']);
        $this->assertSame('lama@example.com', $user->fresh()->email);
    }

    public function test_admin_can_keep_the_same_email(): void
    {
        $user = User::factory()->create([
            'email' => 'lama@example.com',
            'password' => Hash::make('password-lama'),
        ]);

        $response = $this->actingAs($user)->put(route('admin.profile.email.update'), [
            'email' => 'lama@example.com',
            'current_password' => 'password-lama',
        ]);

        $response->assertSessionHasNoErrors();
        $this->assertSame('lama@example.com', $user->fresh()->email);
    }

    public function test_admin_must_enter_current_password_to_update_password(): void
    {
        $user = User::factory()->create([
            'password' => Hash::make('password-lama'),
        ]);

        $response = $this->actingAs($user)->put(route('admin.profile.password.update'), [
            'current_password' => 'password-salah',
            'password' => 'password-baru',
            'password_confirmation' => 'password-baru',
        ]);

        $response->assertSessionHasErrorsIn('updatePassword', ['current_password']);
        $this->assertTrue(Hash::check('password-lama', $user->fresh()->password));
    }

    public function test_admin_can_update_password(): void
    {
        $user = User::factory()->create([
            'password' => Hash::make('password-lama'),
        ]);

        $response = $this->actingAs($user)->put(route('admin.profile.password.update'), [
            'current_password' => 'password-lama',
            'password' => 'password-baru',
            'password_confirmation' => 'password-baru',
        ]);

        $response->assertRedirect(route('admin.profile.edit'));
        $response->assertSessionHas('success');
        $this->assertTrue(Hash::check('password-baru', $user->fresh()->password));
    }
}
