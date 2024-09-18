<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

trait FileUploadTrait {

    /**
     * Handle file upload.
     *
     * @param UploadedFile $file
     * @param string $directory
     * @return string|null
     */
    public function uploadFile(UploadedFile $file, string $directory)
    {
        // Generate a unique filename
        $fileName = Str::uuid() . '_' . $file->getClientOriginalName(); 

        // Save the file to the specified directory
        $file->move(public_path($directory), $fileName); 

        // Return the path where the file is stored using string interpolation
        return "{$directory}/{$fileName}";
    }
}