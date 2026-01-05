<?php

namespace App\Helpers;

class ResponseHelper
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    // Common function to display success response
    public static function success($status = 'success', $message = null, $data = [], $statusCode = 200)
    {
        $response = [
            'status' => $status,
            'message' => $message,
        ];

        if (!empty($data)) {
            $response['data'] = $data;
        }

        return response()->json($response, $statusCode);
    }

    // Common function to display error response
    public static function error($status = 'error', $message = null, $statusCode = 400)
    {
        return response()->json([
            'status' => $status,
            'message' => $message,
        ], $statusCode);
    }
}
