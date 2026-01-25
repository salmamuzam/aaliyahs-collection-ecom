<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Cloudinary Configuration
    |--------------------------------------------------------------------------
    |
    | An array of services/configuration to be used by the Cloudinary package.
    |
    */

    'cloud_url' => env('CLOUDINARY_URL'),

    /**
     * Upload Preset Name
     */
    'upload_preset' => env('CLOUDINARY_UPLOAD_PRESET'),

    /**
     * Notification URL
     */
    'notification_url' => env('CLOUDINARY_NOTIFICATION_URL'),

    /**
     * Cloudinary Configuration
     */
    'cloud' => [
        'cloud_name' => env('CLOUDINARY_CLOUD_NAME', 'dhpirmjdb'),
        'api_key' => env('CLOUDINARY_API_KEY', '795574284513261'),
        'api_secret' => env('CLOUDINARY_API_SECRET', '-9yPCdHVRrnlx9EKDzBAIie6YYQ'),
    ],

];
