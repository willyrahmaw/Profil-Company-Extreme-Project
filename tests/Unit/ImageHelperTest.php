<?php

namespace Tests\Unit;

use App\Helpers\ImageHelper;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ImageHelperTest extends TestCase
{
    /**
     * Test JPG images are converted to WebP.
     */
    public function test_jpg_is_converted_to_webp(): void
    {
        Storage::fake('public');

        $file = UploadedFile::fake()->image('test_product.jpg', 100, 100);

        $path = ImageHelper::storeAsWebp($file, 'products');

        $this->assertStringEndsWith('.webp', $path);
        $this->assertTrue(Storage::disk('public')->exists($path));
    }

    /**
     * Test PNG images are converted to WebP.
     */
    public function test_png_is_converted_to_webp(): void
    {
        Storage::fake('public');

        $file = UploadedFile::fake()->image('logo.png', 100, 100);

        $path = ImageHelper::storeAsWebp($file, 'settings');

        $this->assertStringEndsWith('.webp', $path);
        $this->assertTrue(Storage::disk('public')->exists($path));
    }

    /**
     * Test ICO files bypass WebP conversion and keep original extension.
     */
    public function test_ico_files_bypass_conversion(): void
    {
        Storage::fake('public');

        $file = UploadedFile::fake()->create('favicon.ico', 5, 'image/x-icon');

        $path = ImageHelper::storeAsWebp($file, 'settings');

        $this->assertStringEndsWith('.ico', $path);
        $this->assertTrue(Storage::disk('public')->exists($path));
    }
}
