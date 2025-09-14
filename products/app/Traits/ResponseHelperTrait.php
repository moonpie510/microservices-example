<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait ResponseHelperTrait
{
    public function responseSuccess(array $data = [], string $message = 'success'): JsonResponse
    {
        return response()->json([
            'status' => true,
            'message' => $message,
            'data' => $data
        ]);
    }

    public function responseError(array $data = [], string $message = 'error'): JsonResponse
    {
        return response()->json([
            'status' => false,
            'message' => $message,
            'data' => $data
        ]);
    }
}
