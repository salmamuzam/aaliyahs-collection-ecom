<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Helpers\CloudinaryHelper;
use Illuminate\Support\Facades\File;

class SyncImagesToCloudinary extends Command
{
    protected $signature = 'cloudinary:sync-local';
    protected $description = 'Upload local images from storage/app/public/uploads to Cloudinary properly';

    public function handle()
    {
        $this->info("Starting PROFILE PHOTOS Cloudinary Sync...");

        $basePath = storage_path('app/public');
        // Scanning profile-photos this time
        $folders = ['profile-photos'];

        $count = 0;
        $errors = 0;

        foreach ($folders as $folder) {
            $path = str_replace(['/', '\\'], DIRECTORY_SEPARATOR, "$basePath/$folder");

            if (!File::exists($path)) {
                $this->warn("Folder not found: $path, skipping...");
                continue;
            }

            $files = File::files($path);
            $this->info("Found " . count($files) . " files in $folder.");

            foreach ($files as $file) {
                $filename = $file->getFilename();
                $nameWithoutExt = pathinfo($filename, PATHINFO_FILENAME);

                // For profile photos, we keep the folder structure 'profile-photos/filename'
                $publicId = $folder . '/' . $nameWithoutExt;

                $this->info("Uploading $folder/$filename as $publicId...");

                try {
                    $result = CloudinaryHelper::upload($file->getPathname(), "", $publicId);

                    if ($result) {
                        $this->info("✔ Uploaded: $result");
                        $count++;
                    } else {
                        $this->error("✘ Failed to upload: $filename");
                        $errors++;
                    }
                } catch (\Exception $e) {
                    sleep(1);
                    $this->error("Exception: " . $e->getMessage());
                    $errors++;
                }
            }
        }

        $this->info("Sync Complete. Uploaded: $count. Errors: $errors.");
    }
}
