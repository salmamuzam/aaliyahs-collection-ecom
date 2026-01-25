<?php

namespace App\Helpers;

class ImageHelper
{
    /**
     * Generate a Cloudinary URL for a given path.
     * 
     * @param string|null $path
     * @return string
     */
    public static function getUrl($path)
    {
        if (!$path) {
            return asset('images/placeholder.jpg');
        }

        // 1. If it's already a full URL (like Google profile pics), return it
        if (filter_var($path, FILTER_VALIDATE_URL)) {
            return $path;
        }

        // 2. SMART CHECK: Does this file exist in your local storage? (Old images)
        if (file_exists(public_path('storage/' . $path))) {
            return asset('storage/' . $path);
        }

        // 3. Otherwise, it's a Cloudinary image (New images)
        $cloudName = 'dhpirmjdb';

        // CORRECTION: Normalize path for Cloudinary
        // 1. Remove 'storage/' prefix if accidentally saved in DB
        $cleanPath = preg_replace('/^storage\//', '', $path);

        // 2. Ensure 'uploads/' prefix for categories/products if missing
        // (Legacy files were synced to 'uploads/categories' and 'uploads/products')
        if (!str_starts_with($cleanPath, 'uploads/')) {
            if (str_starts_with($cleanPath, 'categories/') || str_starts_with($cleanPath, 'products/')) {
                $cleanPath = 'uploads/' . $cleanPath;
            }
        }

        return "https://res.cloudinary.com/{$cloudName}/image/upload/v1/{$cleanPath}";
    }
}
