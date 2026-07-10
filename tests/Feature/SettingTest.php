<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\Setting;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class SettingTest extends TestCase
{
    use DatabaseTransactions;

    protected function setUp(): void
    {
        parent::setUp();
        Setting::firstOrCreate([], [
            'website_name' => 'Extreme Project',
            'meta_title' => 'Extreme Project - Why Choose Me',
        ]);
    }

    protected function createAdminUser(): User
    {
        return User::create([
            'name' => 'Admin Test',
            'email' => 'test@admin.com',
            'password' => bcrypt('password'),
        ]);
    }

    public function test_guest_cannot_access_settings(): void
    {
        $response = $this->get(route('admin.settings.edit'));
        $response->assertRedirect(route('login'));

        $response = $this->put(route('admin.settings.update'), []);
        $response->assertRedirect(route('login'));
    }

    public function test_admin_can_view_settings_form(): void
    {
        $admin = $this->createAdminUser();

        $response = $this->actingAs($admin)->get(route('admin.settings.edit'));
        $response->assertStatus(200);
        $response->assertSee('PENGATURAN IDENTITAS');
    }

    public function test_admin_can_update_settings_without_images(): void
    {
        $admin = $this->createAdminUser();

        $response = $this->actingAs($admin)->put(route('admin.settings.update'), [
            'website_name' => 'Extreme V2',
            'meta_title' => 'Extreme Title Custom',
            'meta_description' => 'Custom Desc',
            'meta_keywords' => 'keyword1, keyword2',
        ]);

        $response->assertRedirect(route('admin.settings.edit'));
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('settings', [
            'website_name' => 'Extreme V2',
            'meta_title' => 'Extreme Title Custom',
            'meta_description' => 'Custom Desc',
            'meta_keywords' => 'keyword1, keyword2',
        ]);
    }

    public function test_admin_can_upload_logo_and_favicon(): void
    {
        Storage::fake('public');
        $admin = $this->createAdminUser();

        $favicon = UploadedFile::fake()->image('favicon.png');
        $logo = UploadedFile::fake()->image('logo.png');

        $response = $this->actingAs($admin)->put(route('admin.settings.update'), [
            'website_name' => 'Extreme V2',
            'meta_title' => 'Extreme Title Custom',
            'meta_description' => 'Custom Desc',
            'meta_keywords' => 'keyword1, keyword2',
            'favicon' => $favicon,
            'logo' => $logo,
        ]);

        $response->assertRedirect(route('admin.settings.edit'));

        $setting = Setting::first();
        $this->assertNotNull($setting->favicon_path);
        $this->assertNotNull($setting->logo_path);

        $faviconFilename = str_replace('/storage/', '', $setting->favicon_path);
        $logoFilename = str_replace('/storage/', '', $setting->logo_path);

        Storage::disk('public')->assertExists($faviconFilename);
        Storage::disk('public')->assertExists($logoFilename);
    }
}
