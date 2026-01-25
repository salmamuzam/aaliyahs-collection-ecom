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

        // If it's already a full URL, return it
        if (filter_var($path, FILTER_VALIDATE_URL)) {
            return $path;
        }

        // Cloudinary Cloud Name
        $cloudName = 'dhpirmjdb';

        // Base Cloudinary URL
        // We use 'v1' as a version placeholder
        return "https://res.cloudinary.com/{$cloudName}/image/upload/v1/{$path}";
    }
}
