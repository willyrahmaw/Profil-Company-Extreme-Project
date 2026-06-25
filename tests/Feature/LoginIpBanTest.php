<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\User;
use App\Support\LoginIpBan;
use Carbon\CarbonImmutable;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Routing\Middleware\ThrottleRequests;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class LoginIpBanTest extends TestCase
{
    use DatabaseTransactions;

    protected function setUp(): void
    {
        parent::setUp();

        Cache::flush();
        CarbonImmutable::setTestNow(CarbonImmutable::parse('2026-06-25 12:00:00'));
        $this->withoutMiddleware(ThrottleRequests::class);
    }

    protected function tearDown(): void
    {
        CarbonImmutable::setTestNow();
        Cache::flush();

        parent::tearDown();
    }

    public function test_ip_is_banned_after_five_failed_password_attempts(): void
    {
        User::factory()->create([
            'email' => 'admin@example.com',
            'password' => Hash::make('password-benar'),
        ]);

        for ($attempt = 1; $attempt <= 4; $attempt++) {
            $this->post(route('login'), [
                'email' => 'admin@example.com',
                'password' => 'password-salah',
            ])->assertSessionHasErrors(['email']);
        }

        $this->post(route('login'), [
            'email' => 'admin@example.com',
            'password' => 'password-salah',
        ])->assertRedirect(route('banned'));

        $status = LoginIpBan::status(request());

        $this->assertNotNull($status);
        $this->assertSame(1, $status['level']);
        $this->assertSame(1800, $status['remaining_seconds']);
    }

    public function test_banned_ip_is_redirected_to_banned_page_for_web_access(): void
    {
        User::factory()->create([
            'email' => 'admin@example.com',
            'password' => Hash::make('password-benar'),
        ]);

        for ($attempt = 1; $attempt <= 5; $attempt++) {
            $this->post(route('login'), [
                'email' => 'admin@example.com',
                'password' => 'password-salah',
            ]);
        }

        $this->get(route('home'))->assertRedirect(route('banned'));
        $this->get(route('login'))->assertRedirect(route('banned'));
        $this->get(route('banned'))->assertOk()->assertSee('Akses Diblokir');
    }

    public function test_next_ban_duration_is_doubled_after_another_five_failures(): void
    {
        User::factory()->create([
            'email' => 'admin@example.com',
            'password' => Hash::make('password-benar'),
        ]);

        for ($attempt = 1; $attempt <= 5; $attempt++) {
            $this->post(route('login'), [
                'email' => 'admin@example.com',
                'password' => 'password-salah',
            ]);
        }

        CarbonImmutable::setTestNow(CarbonImmutable::parse('2026-06-25 12:31:00'));
        $this->get(route('home'))->assertOk();

        for ($attempt = 1; $attempt <= 4; $attempt++) {
            $this->post(route('login'), [
                'email' => 'admin@example.com',
                'password' => 'password-salah',
            ])->assertSessionHasErrors(['email']);
        }

        $this->post(route('login'), [
            'email' => 'admin@example.com',
            'password' => 'password-salah',
        ])->assertRedirect(route('banned'));

        $status = LoginIpBan::status(request());

        $this->assertNotNull($status);
        $this->assertSame(2, $status['level']);
        $this->assertSame(3600, $status['remaining_seconds']);
    }
}