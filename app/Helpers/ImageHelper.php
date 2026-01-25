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

        // CORRECTION: Legacy images in DB might be "categories/xyz.jpg"
        // But we synced them to "uploads/categories/xyz.jpg" in Cloudinary.
        // So we fix the path here.
        $cleanPath = $path;
        if ((str_starts_with($path, 'categories/') || str_starts_with($path, 'products/')) && !str_starts_with($path, 'uploads/')) {
            $cleanPath = 'uploads/' . $path;
        }

        return "https://res.cloudinary.com/{$cloudName}/image/upload/v1/{$cleanPath}";
    }
}
