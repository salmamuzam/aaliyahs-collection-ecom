<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Http;

class CloudinaryHelper
{
    /**
     * Upload a file to Cloudinary via REST API.
     * 
     * @param \Illuminate\Http\UploadedFile $file
     * @param string $folder
     * @return string|null
     */
    public static function upload($file, $folder = 'products')
    {
        $cloudName = env('CLOUDINARY_CLOUD_NAME', 'dhpirmjdb');
        $apiKey = env('CLOUDINARY_API_KEY', '795574284513261');
        $apiSecret = env('CLOUDINARY_API_SECRET', '-9yPCdHVRrnlx9EKDzBAIie6YYQ');

        // Cloudinary upload URL
        $url = "https://api.cloudinary.com/v1_1/{$cloudName}/image/upload";

        // Generate signature (required for signed uploads)
        $timestamp = time();
        $params = [
            'folder' => $folder,
            'timestamp' => $timestamp,
        ];

        // Generate signature correctly (alphabetical order, no URL encoding in the base string)
        ksort($params);
        $signatureString = "";
        foreach ($params as $key => $value) {
            $signatureString .= "$key=$value&";
        }
        $signatureString = rtrim($signatureString, '&') . $apiSecret;
        $signature = sha1($signatureString);

        // Perform the request
        $response = Http::attach(
            'file',
            fopen($file->getRealPath(), 'r'),
            $file->getClientOriginalName()
        )->post($url, array_merge($params, [
                        'api_key' => $apiKey,
                        'signature' => $signature,
                    ]));

        if ($response->successful()) {
            // Return the public_id or the full secure_url
            // We'll return the relative path (public_id) to stay consistent with your DB
            return $response->json()['public_id'];
        }

        \Illuminate\Support\Facades\Log::error('Cloudinary Upload Failed: ' . $response->body());
        return null;
    }
}
