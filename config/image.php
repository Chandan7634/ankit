<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Image Driver
    |--------------------------------------------------------------------------
    |
    | You can choose between two image processing libraries that are
    | supported: GD Library and Imagick. The default is GD Library.
    |
    | Supported: "gd", "imagick"
    |
    */

    'driver' => 'gd', // 'gd' or 'imagick'


    /*
    |--------------------------------------------------------------------------
    | Image Cache
    |--------------------------------------------------------------------------
    |
    | Here you can configure the cache used for storing image files.
    | You can specify the cache lifetime and the cache directory.
    |
    | Default is the 'cache' directory under your storage path.
    |
    */

    'cache' => [
        'enabled' => true,            // Whether caching is enabled
        'lifetime' => 60,             // Cache lifetime in minutes
        'path' => storage_path('framework/cache/images'), // Cache path
    ],

    /*
    |--------------------------------------------------------------------------
    | Image Quality
    |--------------------------------------------------------------------------
    |
    | Here you can specify the default quality when saving images.
    |
    | The value must be between 0 and 100.
    | The higher the value, the better the quality and the larger the file size.
    |
    */

    'quality' => 90,  // Default quality for saving images


    /*
    |--------------------------------------------------------------------------
    | Image Manipulation
    |--------------------------------------------------------------------------
    |
    | In this section, you can configure various options for manipulating
    | images, such as resizing, cropping, or rotating.
    |
    */

    'resize' => [
        'quality' => 85,  // Default quality for resized images
    ],

    'crop' => [
        'background' => '#ffffff',  // Background color for cropped images
    ],

    'rotate' => [
        'background' => '#ffffff',  // Background color for rotated images
    ],


    /*
    |--------------------------------------------------------------------------
    | Image Compression
    |--------------------------------------------------------------------------
    |
    | Here you can set options related to image compression, including quality
    | settings and compression levels.
    |
    */

    'compression' => [
        'jpeg' => 85,  // JPEG compression quality
        'png'  => 8,    // PNG compression level (0-9)
    ],


    /*
    |--------------------------------------------------------------------------
    | Image Format
    |--------------------------------------------------------------------------
    |
    | The following setting allows you to define the default image format when
    | saving images (e.g., jpg, png, gif, etc.).
    |
    */

    'format' => 'jpeg',  // The default format when saving images (jpeg, png, gif)


    /*
    |--------------------------------------------------------------------------
    | Image Driver Configurations
    |--------------------------------------------------------------------------
    |
    | Here you can add configuration settings for each driver (GD or Imagick).
    | For instance, Imagick has options for additional features like quality.
    |
    | You can leave these values as default unless you need specific configurations.
    |
    */

    'gd' => [
        // GD driver-specific options (if necessary)
    ],

    'imagick' => [
        // Imagick driver-specific options (if necessary)
    ],
];
