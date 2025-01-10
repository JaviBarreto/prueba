<?php

namespace App\Services\Utilities;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class ImageService
{
    public function storeImage($folder, $images)
    {
        $uploadedImages = [];

        if (!Storage::disk('public')->exists($folder)) {
            Storage::disk('public')->makeDirectory($folder);
        }

        if (is_array($images) && !empty($images)) {
            foreach ($images as $index => $image) {
                if ($image instanceof UploadedFile && $image->isValid()) {
                    
                    $filename = now()->timestamp . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
                    
                    $path = $image->storeAs($folder, $filename, 'public');

                    $uploadedImages[] = $path;
                }
            }
        }

        return $uploadedImages;
    }

    public function deleteImage($path)
    {
        if (Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }
    
    public function loadImage($filename, $categoryCode, $productCode)
    {
        $folder = 'products/' . $categoryCode . '/' . $productCode;
        return Storage::disk('public')->url($folder . '/' . $filename);
    }

    // public function loadImage($filename, $folder = 'images')
    // {
    //     return Storage::disk('public')->url($folder . '/' . $filename);
    // }

}