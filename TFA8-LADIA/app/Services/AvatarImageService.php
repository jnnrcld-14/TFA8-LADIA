<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Encoders\JpegEncoder;
use Intervention\Image\ImageManager;

class AvatarImageService
{
    /**
     * Create a square, display-ready JPEG avatar and store it on the public disk.
     * The returned value is the relative path saved in users.avatar.
     */
    public function prepareAndStore(UploadedFile $file): string
    {
        $manager = new ImageManager(new Driver());

        $image = $manager->read($file->getRealPath())
            ->cover(300, 300);

        $encoded = $image->encode(new JpegEncoder(quality: 85));

        $path = 'avatars/' . Str::uuid() . '.jpg';

        Storage::disk('public')->put($path, (string) $encoded);

        return $path;
    }
}
