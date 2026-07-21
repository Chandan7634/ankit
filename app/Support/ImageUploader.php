<?php

namespace App\Support;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

/**
 * Central place for all admin image uploads. Every image is cropped/resized
 * server-side to a fixed dimension, so uploads of any size come out uniform.
 */
class ImageUploader
{
    public const PRODUCT  = [800, 800];   // square product shots — equal card heights
    public const CATEGORY = [600, 600];
    public const ICON     = [300, 300];   // round category icons
    public const BANNER   = [1920, 640];  // home slider

    /**
     * Crop-cover the upload to exactly $width x $height and store it on the
     * public disk. Returns the stored relative path.
     */
    public static function store(UploadedFile $file, string $dir, int $width, int $height): string
    {
        $path = trim($dir, '/') . '/' . Str::random(30) . '.jpg';

        $image = (new ImageManager(new Driver()))
            ->read($file->getRealPath())
            ->cover($width, $height);

        Storage::disk('public')->put($path, (string) $image->toJpeg(85));

        return $path;
    }

    /** @param  array<UploadedFile>  $files */
    public static function storeMany(array $files, string $dir, int $width, int $height): array
    {
        return array_map(
            fn (UploadedFile $file) => self::store($file, $dir, $width, $height),
            $files
        );
    }
}
