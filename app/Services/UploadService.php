<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use League\CommonMark\Extension\CommonMark\Node\Inline\Strong;

class UploadService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public static function upload(UploadedFile $file, string $folder, $disk = 'public'): string
    {
        // fielname withouth extension
        $filename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);

        // extension
        $exension = $file->getClientOriginalExtension();

        $filename = $filename . '-' . time() . '.' . $exension;

        return $file->store($folder, $filename, $disk);
    }


    public static function delete(string $path, $disk = 'public'): bool
    {
        if (!Storage::disk($disk)->exists($path)) {
            return false;
        }

        return Storage::disk($disk)->delete($path);
    }

    public static function url(string $path, string $disk = 'public'): string
    {
        return Storage::disk($disk)->url($path);
    }
}
