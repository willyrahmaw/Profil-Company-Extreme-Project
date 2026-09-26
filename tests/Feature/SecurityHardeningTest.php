<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\LearnGuide;
use App\Models\Product;
use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Js;
use Tests\TestCase;

class SecurityHardeningTest extends TestCase
{
    use DatabaseTransactions;

    public function test_login_page_does_not_reveal_default_credentials(): void
    {
        $response = $this->get(route('login'));

        $response->assertOk();
        $response->assertDontSee('admin@vape.com');
        $response->assertDontSee('KUNCI AKSES MASUK');
    }

    public function test_seeder_does_not_reset_existing_admin_password(): void
    {
        User::where('email', config('app.admin.email'))->delete();
        $admin = User::factory()->create([
            'email' => config('app.admin.email'),
            'password' => Hash::make('password-rahasia'),
        ]);

        $this->seed(DatabaseSeeder::class);

        $this->assertTrue(Hash::check('password-rahasia', $admin->fresh()->password));
    }

    public function test_seeder_never_creates_admin_with_default_password(): void
    {
        User::where('email', config('app.admin.email'))->delete();
        config(['app.admin.password' => null]);

        $this->seed(DatabaseSeeder::class);

        $admin = User::where('email', config('app.admin.email'))->firstOrFail();
        $this->assertFalse(Hash::check('password', $admin->password));
    }

    public function test_logout_via_get_request_is_not_allowed(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)->get('/admin/logout')->assertMethodNotAllowed();
        $this->assertAuthenticatedAs($user);
    }

    public function test_security_headers_include_csp(): void
    {
        $response = $this->get('http://localhost/');

        $csp = $response->headers->get('Content-Security-Policy');
        $this->assertNotNull($csp);
        $this->assertStringContainsString("object-src 'none'", $csp);
        $this->assertStringContainsString("frame-ancestors 'self'", $csp);
        $response->assertHeaderMissing('Strict-Transport-Security');
    }

    public function test_hsts_is_sent_over_https(): void
    {
        $this->get('https://localhost/')->assertHeader('Strict-Transport-Security', 'max-age=31536000');
    }

    public function test_guide_content_is_sanitized_on_public_page(): void
    {
        LearnGuide::create([
            'title' => 'Panduan XSS',
            'slug' => 'panduan-xss',
            'content' => '<p class="text-[11px] dark:text-zinc-400">Aman</p><script>alert("xss")</script><img src="x" onerror="alert(1)">',
            'order_position' => 0,
            'is_active' => true,
        ]);

        $response = $this->get(route('learn'));

        $response->assertOk();
        $response->assertSee('<p class="text-[11px] dark:text-zinc-400">Aman</p>', false);
        $response->assertDontSee('<script>alert("xss")</script>', false);
        $response->assertDontSee('onerror', false);
    }

    public function test_product_title_cannot_break_out_of_json_ld_or_cart_handler(): void
    {
        $product = Product::create([
            'title' => "Coil '</script><script>alert(1)</script>",
            'category' => 'coil',
            'price' => 50000,
            'stock' => 10,
            'character_description' => 'Produk untuk menguji escaping.',
            'specifications' => ['flavor' => 4, 'sweetness' => 4, 'throat_hit' => 3],
        ]);

        $response = $this->get(route('home'));

        $response->assertOk();
        $response->assertDontSee('</script><script>alert(1)</script>', false);
        // The cart handler receives the title as an escaped JS string literal.
        $response->assertSee(Js::from($product->title)->toHtml(), false);
    }

    public function test_svg_logo_upload_is_rejected(): void
    {
        Storage::fake('public');
        $admin = User::factory()->create();

        $response = $this->actingAs($admin)->put(route('admin.settings.update'), [
            'website_name' => 'Extreme',
            'meta_title' => 'Extreme',
            'logo' => UploadedFile::fake()->createWithContent('logo.svg', '<svg xmlns="http://www.w3.org/2000/svg"><script>alert(1)</script></svg>'),
        ]);

        $response->assertSessionHasErrors(['logo']);
    }

    public function test_survey_drops_unknown_answer_keys_and_rejects_invalid_options(): void
    {
        $response = $this->post(route('research.store'), [
            'answers' => ['Q1' => 'Pilihan palsu', 'Q99' => 'tambahan'],
        ]);

        $response->assertSessionHasErrors(['answers.Q1']);
    }

    public function test_changing_password_logs_out_other_sessions(): void
    {
        $user = User::factory()->create(['password' => Hash::make('password-lama')]);
        $oldHash = $user->password;

        $this->actingAs($user)->put(route('admin.profile.password.update'), [
            'current_password' => 'password-lama',
            'password' => 'password-baru',
            'password_confirmation' => 'password-baru',
        ])->assertRedirect(route('admin.profile.edit'));

        // Another device still carries the password hash from before the change.
        $this->app['auth']->forgetGuards();
        $this->actingAs($user->fresh())
            ->withSession(['password_hash_web' => $oldHash])
            ->get(route('admin.dashboard'))
            ->assertRedirect(route('login'));
    }
}
