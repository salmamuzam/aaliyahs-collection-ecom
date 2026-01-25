<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Http;

class CloudinaryHelper
{
    /**
     * Upload a file to Cloudinary via REST API.
     * 
     * @param \Illuminate\Http\UploadedFile|string $file
     * @param string $folder
     * @param string|null $publicId
     * @return string|null
     */
    public static function upload($file, $folder = 'products', $publicId = null)
    {
        $cloudName = env('CLOUDINARY_CLOUD_NAME', 'dhpirmjdb');
        $apiKey = env('CLOUDINARY_API_KEY', '795574284513261');
        $apiSecret = env('CLOUDINARY_API_SECRET', '-9yPCdHVRrnlx9EKDzBAIie6YYQ');

        // Cloudinary upload URL
        $url = "https://api.cloudinary.com/v1_1/{$cloudName}/image/upload";

        // Generate signature (required for signed uploads)
        $timestamp = time();
        $params = [
            'timestamp' => $timestamp,
        ];

        if ($folder) {
            $params['folder'] = $folder;
        }

        if ($publicId) {
            // Cloudinary public_id should NOT have an extension
            $params['public_id'] = preg_replace('/\.[^.]+$/', '', $publicId);
        }

        // Generate signature correctly (alphabetical order, no URL encoding in the base string)
        ksort($params);
        $signatureString = "";
        foreach ($params as $key => $value) {
            $signatureString .= "$key=$value&";
        }
        $signatureString = rtrim($signatureString, '&') . $apiSecret;
        $signature = sha1($signatureString);

        // Prepare the file payload
        $fileSource = ($file instanceof \Illuminate\Http\UploadedFile)
            ? fopen($file->getRealPath(), 'r')
            : fopen($file, 'r');

        $fileName = ($file instanceof \Illuminate\Http\UploadedFile)
            ? $file->getClientOriginalName()
            : basename($file);

        // Perform the request
        $response = Http::attach(
            'file',
            $fileSource,
            $fileName
        )->post($url, array_merge($params, [
                        'api_key' => $apiKey,
                        'signature' => $signature,
                    ]));

        if ($response->successful()) {
            return $response->json()['secure_url'];
        }

        \Illuminate\Support\Facades\Log::error('Cloudinary Upload Failed: ' . $response->body());
        return null;
    }
}
