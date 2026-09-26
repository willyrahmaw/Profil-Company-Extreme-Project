<?php

declare(strict_types=1);

namespace App\Support;

use HTMLPurifier;
use HTMLPurifier_Config;
use Illuminate\Support\Facades\File;

/**
 * Strips scripts, event handlers and other unsafe markup from admin-authored
 * HTML while keeping formatting tags and (Tailwind) class attributes.
 */
class HtmlSanitizer
{
    private static ?HTMLPurifier $purifier = null;

    public static function clean(?string $html): string
    {
        if ($html === null || $html === '') {
            return '';
        }

        return self::purifier()->purify($html);
    }

    private static function purifier(): HTMLPurifier
    {
        if (self::$purifier === null) {
            $cachePath = storage_path('framework/cache/htmlpurifier');
            File::ensureDirectoryExists($cachePath);

            $config = HTMLPurifier_Config::createDefault();
            $config->set('Cache.SerializerPath', $cachePath);
            $config->set('HTML.TargetBlank', true);
            $config->set('URI.AllowedSchemes', ['http' => true, 'https' => true, 'mailto' => true, 'tel' => true]);

            self::$purifier = new HTMLPurifier($config);
        }

        return self::$purifier;
    }
}
