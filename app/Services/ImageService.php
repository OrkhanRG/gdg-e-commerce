<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ImageService
{
    public function singleUpload(UploadedFile $file, string $fileName, string $path)
    {
        $filePath = 'public/' . $path;
        $extension = $file->getClientOriginalExtension();
        $fileName = (Str::slug($fileName) . uniqid()). '.' . $extension;

        Storage::putFileAs($filePath,$file,$fileName);

        return 'storage/' . $path . '/' . $fileName;
    }

    public function deleteImage(string $path): void
    {
        Storage::delete($path);
    }
}
