<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

class FileStorageService
{
    /**
     * Store a file in the specified sub-folder within storage/app/public.
     *
     * @param \Illuminate\Http\UploadedFile $file
     * @param string $subFolder
     * @return string|null
     */
    public function storeFile(UploadedFile $file, string $subFolder): ?string
    {
        // Validate the folder name if necessary
        $folderPath = trim($subFolder, '/'); // Ensure no leading/trailing slashes

        // Generate a unique filename
        $filename = uniqid() . '.' . $file->getClientOriginalExtension();

        // Store the file and get the path
        $path = $file->storeAs("public/{$folderPath}", $filename);

        // Return the URL to access the file
        return Storage::url($path);
    }
}
