<?php

namespace App\Helpers;

class ResponseHelper
{
    /**
     * Standardized Success Response
     */
    public static function success($message = null, $data = [], $statusCode = 200)
    {
        $response = [
            'status' => 'success',
            'message' => $message,
        ];

        if (!empty($data)) {
            $response['data'] = $data;
        }

        return response()->json($response, $statusCode);
    }

    /**
     * Standardized Error Response (Supports Validation Errors)
     */
    public static function error($message = null, $data = [], $statusCode = 400)
    {
        $response = [
            'status' => 'error',
            'message' => $message,
        ];

        if (!empty($data)) {
            $response['data'] = $data;
        }

        return response()->json($response, $statusCode);
    }
}
