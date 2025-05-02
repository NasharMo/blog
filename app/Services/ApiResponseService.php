<?php

namespace App\Services;

class ApiResponseService
{
    public static function create(string $status, string $message, $data = null, int $code = 200)
    {
        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $data,
        ], $code);
    }
}