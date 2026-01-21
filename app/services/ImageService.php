<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ImageService
{

    //Upload an image to the storage

    public static function upload(UploadedFile $file, string $path): string
    {
        if (!ImageService::isRealImage($file)) {
            throw new \Exception('The uploaded file is not a real image.');
        }

        $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();

        return $file->storeAs($path, $filename, 'public');
    }

    private static function isRealImage(UploadedFile $file): bool
    {
        return @getimagesize($file->getPathname()) !== false;
    }

    //Delete image from storage
    public static function delete($path)
    {
        if ($path && Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }
}
