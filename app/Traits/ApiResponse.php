<?php

namespace app\Traits;

use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

trait ApiResponse
{

    public function successResponse(?object $payload = null, string $status = "success" ,?string $message = null, int $response_code = Response::HTTP_OK): JsonResponse
    {
        return response()->json([
            "message" => $message,
            "payload" => $payload,
            "status" => $status,
        ], $response_code);
    }

    public function failedResponse(string $status = "failed" ,?string $message = null, int $response_code = Response::HTTP_OK): JsonResponse
    {
        return response()->json([
            "message" => $message,
            "status" => $status,
        ], $response_code);
    }

}