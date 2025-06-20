<?php

namespace App\Http\Traits;

use App\Common\ApiErrorCodes;
use Illuminate\Http\JsonResponse;

trait ApiResponseTrait
{
    protected function successResponse($data = [], string $message = "Success", int $statusCode = 200): JsonResponse
    {
        $response = [
            'success' => true,
            'message' => $message,
        ];
        if (!empty($data)) {
           
            if (is_object($data) && method_exists($data, 'toArray')) {
                 $response['data'] = $data->toArray(request());
            } elseif (is_array($data) || is_object($data)) {
                $response['data'] = $data;
            } else {
                 $response['data'] = $data; 
            }
        }
        return response()->json($response, $statusCode);
    }

    protected function errorResponse(int $errorCode, $errors = null, ?int $overrideStatusCode = null): JsonResponse
    {
        $message = ApiErrorCodes::getMessage($errorCode);
        $statusCode = $overrideStatusCode ?? $this->determineStatusCodeFromErrorCode($errorCode);

        $responsePayload = [
            'success' => false,
            'code' => $errorCode,
        ];


        if ($errorCode === ApiErrorCodes::VALIDATION_FAILED) {
            $responsePayload['message'] = $message; 
            if ($errors) {
                $responsePayload['errors'] = $errors; 
            }
        } else {
            $responsePayload['error'] = $message; 
        }

        return response()->json($responsePayload, $statusCode);
    }

    private function determineStatusCodeFromErrorCode(int $errorCode): int
    {
        return match ($errorCode) {
            ApiErrorCodes::AUTH_LOGIN_FAILED, ApiErrorCodes::AUTH_TOKEN_NOT_PROVIDED, ApiErrorCodes::AUTH_INVALID_OR_EXPIRED_TOKEN => 401,
            ApiErrorCodes::AUTH_FORBIDDEN => 403,
            ApiErrorCodes::VALIDATION_FAILED => 422,
            ApiErrorCodes::RESOURCE_NOT_FOUND => 404,
            ApiErrorCodes::VISIT_SLOT_UNAVAILABLE => 409,
            ApiErrorCodes::AUTH_PASSWORD_RESET_TOKEN_INVALID => 400,
            ApiErrorCodes::CLIENT_TOO_MANY_REQUESTS => 429,            
            ApiErrorCodes::AUTH_PASSWORD_RESET_LINK_SEND_FAILED, ApiErrorCodes::SERVER_ERROR => 500,
            ApiErrorCodes::SERVICE_UNAVAILABLE => 503,
            default => 400, 
        };
    }
}