<?php

declare(strict_types=1);

namespace App\Support;

use Carbon\CarbonImmutable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class LoginIpBan
{
    public const MAX_FAILED_ATTEMPTS = 5;
    public const BASE_BAN_MINUTES = 30;
    public const FAILURE_WINDOW_MINUTES = 30;

    /**
     * @return array{ip: string, banned_until: CarbonImmutable, remaining_seconds: int, level: int}|null
     */
    public static function status(Request $request): ?array
    {
        $ip = self::ip($request);
        $timestamp = Cache::get(self::banKey($ip));

        if (! is_numeric($timestamp)) {
            return null;
        }

        $bannedUntil = CarbonImmutable::createFromTimestamp((int) $timestamp);

        if ($bannedUntil->isPast()) {
            Cache::forget(self::banKey($ip));

            return null;
        }

        return [
            'ip' => $ip,
            'banned_until' => $bannedUntil,
            'remaining_seconds' => (int) now()->diffInSeconds($bannedUntil, false),
            'level' => (int) Cache::get(self::levelKey($ip), 1),
        ];
    }

    /**
     * @return array{ip: string, banned_until: CarbonImmutable, remaining_seconds: int, level: int, minutes: int}|null
     */
    public static function recordFailedAttempt(Request $request): ?array
    {
        $ip = self::ip($request);
        $failedAttempts = ((int) Cache::get(self::failedKey($ip), 0)) + 1;

        if ($failedAttempts < self::MAX_FAILED_ATTEMPTS) {
            Cache::put(self::failedKey($ip), $failedAttempts, now()->addMinutes(self::FAILURE_WINDOW_MINUTES));

            return null;
        }

        $level = ((int) Cache::get(self::levelKey($ip), 0)) + 1;
        $minutes = self::BASE_BAN_MINUTES * (2 ** ($level - 1));
        $bannedUntil = CarbonImmutable::now()->addMinutes($minutes);

        Cache::put(self::banKey($ip), $bannedUntil->timestamp, $bannedUntil);
        Cache::forever(self::levelKey($ip), $level);
        Cache::forget(self::failedKey($ip));

        return [
            'ip' => $ip,
            'banned_until' => $bannedUntil,
            'remaining_seconds' => (int) now()->diffInSeconds($bannedUntil, false),
            'level' => $level,
            'minutes' => $minutes,
        ];
    }

    public static function clearSuccessfulAttempt(Request $request): void
    {
        $ip = self::ip($request);

        Cache::forget(self::failedKey($ip));
        Cache::forget(self::levelKey($ip));
        Cache::forget(self::banKey($ip));
    }

    public static function failedAttempts(Request $request): int
    {
        return (int) Cache::get(self::failedKey(self::ip($request)), 0);
    }

    private static function ip(Request $request): string
    {
        return $request->ip() ?: 'unknown';
    }

    private static function failedKey(string $ip): string
    {
        return 'security:login_failed:'.$ip;
    }

    private static function banKey(string $ip): string
    {
        return 'security:ip_banned_until:'.$ip;
    }

    private static function levelKey(string $ip): string
    {
        return 'security:ip_ban_level:'.$ip;
    }
}