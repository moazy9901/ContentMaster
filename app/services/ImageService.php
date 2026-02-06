<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Exception;

class ImageService
{
    public static function upload(UploadedFile $file, string $path): string
    {
        try {
            if (!$file->isValid()) {
                throw new Exception('Uploaded file is not valid.');
            }
            if (!self::isRealImage($file)) {
                throw new Exception('The uploaded file is not a real image.');
            }
            $allowedExtensions = ['jpg', 'jpeg', 'png', 'webp'];
            if (!in_array($file->extension(), $allowedExtensions)) {
                throw new Exception('Invalid image extension.');
            }
            $filename = Str::uuid() . '.' . $file->extension();
            $storedPath = $file->storeAs($path, $filename, 'public');
            if (!$storedPath || !Storage::disk('public')->exists($storedPath)) {
                throw new Exception('Image upload failed.');
            }
            return $storedPath;

        } catch (Exception $e) {
            Log::error('Image upload error', ['message' => $e->getMessage()]);
            throw $e;
        }
    }

    public static function delete(?string $path): void
    {
        try {
            if ($path && Storage::disk('public')->exists($path)) {
                Storage::disk('public')->delete($path);
            }
        } catch (Exception $e) {
            Log::error('Image delete error', [
                'path' => $path,
                'message' => $e->getMessage(),
            ]);
        }
    }

    private static function isRealImage(UploadedFile $file): bool
    {
        return @getimagesize($file->getPathname()) !== false;
    }
}
