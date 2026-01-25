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

        // 1. If it's already a full URL
        if (filter_var($path, FILTER_VALIDATE_URL)) {
            // Exception: If it's a localhost URL, treat it as local path and fix it
            if (str_contains($path, 'localhost') || str_contains($path, '127.0.0.1')) {
                $path = parse_url($path, PHP_URL_PATH); // /storage/categories/xyz.jpg
                $path = ltrim($path, '/'); // storage/categories/xyz.jpg
            } else {
                return $path;
            }
        }

        // 2. SMART CHECK: Does this file exist in your local storage? (Old images)
        if (file_exists(public_path('storage/' . $path))) {
            return asset('storage/' . $path);
        }

        // 3. Otherwise, it's a Cloudinary image (New images)
        $cloudName = 'dhpirmjdb';

        // CORRECTION: Normalize path for Cloudinary
        $cleanPath = $path;

        // A. Remove 'storage/' prefix if accidentally saved in DB
        $cleanPath = preg_replace('/^storage\//', '', $cleanPath);

        // B. Ensure 'uploads/' prefix for categories/products if missing
        // (Legacy files were synced to 'uploads/categories' and 'uploads/products')
        // BUT also handle the case where files ARE in 'uploads/' root (like the ones we just synced)
        // logic: if it starts with 'categories/' or 'products/', force uploads/
        if (!str_starts_with($cleanPath, 'uploads/')) {
            if (str_starts_with($cleanPath, 'categories/') || str_starts_with($cleanPath, 'products/')) {
                $cleanPath = 'uploads/' . $cleanPath;
            }
        }

        return "https://res.cloudinary.com/{$cloudName}/image/upload/v1/{$cleanPath}";
    }
}
