<?php

namespace App\Helpers;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ImageHelper
{
    /**
     * Convert an uploaded image to WebP format and store it.
     * If the image is a .ico file, store it as-is without converting.
     *
     * @param UploadedFile $file
     * @param string $folder Destination folder inside 'public' disk
     * @param int $quality Quality (0-100)
     * @return string Relative storage path (e.g. 'products/filename.webp')
     */
    public static function storeAsWebp(UploadedFile $file, string $folder, int $quality = 85): string
    {
        $extension = strtolower($file->getClientOriginalExtension());

        // Skip conversion for .ico files
        if ($extension === 'ico') {
            return $file->store($folder, 'public');
        }

        // Generate clean webp filename
        $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $cleanName = preg_replace('/[^A-Za-z0-9\-]/', '_', $originalName);
        $fileName = time() . '_' . uniqid() . '_' . $cleanName . '.webp';

        $tempPath = $file->getRealPath();
        $image = null;

        // Try to load image based on extension
        try {
            switch ($extension) {
                case 'jpeg':
                case 'jpg':
                    if (function_exists('imagecreatefromjpeg')) {
                        $image = imagecreatefromjpeg($tempPath);
                    }
                    break;
                case 'png':
                    if (function_exists('imagecreatefrompng')) {
                        $image = imagecreatefrompng($tempPath);
                        if ($image) {
                            if (function_exists('imagepalettetotruecolor')) {
                                imagepalettetotruecolor($image);
                            }
                            imagealphablending($image, false);
                            imagesavealpha($image, true);
                        }
                    }
                    break;
                case 'gif':
                    if (function_exists('imagecreatefromgif')) {
                        $image = imagecreatefromgif($tempPath);
                    }
                    break;
                case 'webp':
                    // Already webp, just store it
                    return $file->storeAs($folder, $fileName, 'public');
            }
        } catch (\Throwable $e) {
            // Log or ignore to fallback
        }

        // Fallback if image resource could not be created or imagewebp function is not available
        if (!$image || !function_exists('imagewebp')) {
            if ($image) {
                imagedestroy($image);
            }
            return $file->store($folder, 'public');
        }

        // Capture WebP conversion via output buffer
        ob_start();
        $saved = imagewebp($image, null, $quality);
        $webpData = ob_get_clean();
        imagedestroy($image);

        $path = $folder . '/' . $fileName;

        if ($saved && $webpData !== false) {
            Storage::disk('public')->put($path, $webpData);
            return $path;
        }

        // If saving WebP failed for some reason, store the original file
        return $file->store($folder, 'public');
    }
}
