<?php

namespace App\Services;

use Illuminate\Support\Facades\App;

class ErrorFormatter
{
    /**
     * Format an error response with real HTTP status and anonymized error code.
     */
    public static function format(int $code, string $developerMessage = null, int $realStatus = 400)
    {
        $response = [
            'error_code' => $code,
            'message' => self::getUserMessage($code),
        ];

        if (App::environment(['local', 'staging'])) {
            $response['debug'] = $developerMessage;
        }

        return response()->json($response, $realStatus);
    }

    /**
     * Return user-friendly message based on code.
     */
    protected static function getUserMessage(int $code): string
    {
        return match($code) {
            10001 => 'Unauthorized access.',
            10002 => 'Invalid input data.',
            10003 => 'You do not have permission to perform this action.',
            10004 => 'Medication not found.',
            10005 => 'Unexpected system error.',
            10006 => 'Resource not found.',
            10007 => 'Validation failed.',
            10008 => 'Request conflict.',
            10009 => 'Rate limit exceeded.',
            10010 => 'Service unavailable.',
            default => 'An unknown error occurred.'
        };
    }

    // Common REST error responses

    public static function unauthorized(string $debug = null)
    {
        return self::format(10001, $debug, 401);
    }

    public static function forbidden(string $debug = null)
    {
        return self::format(10003, $debug, 403);
    }

    public static function notFound(string $debug = null)
    {
        return self::format(10006, $debug, 404);
    }

    public static function validationError(string $debug = null)
    {
        return self::format(10007, $debug, 422);
    }

    public static function conflict(string $debug = null)
    {
        return self::format(10008, $debug, 409);
    }

    public static function rateLimited(string $debug = null)
    {
        return self::format(10009, $debug, 429);
    }

    public static function serviceUnavailable(string $debug = null)
    {
        return self::format(10010, $debug, 503);
    }

    public static function internal(string $debug = null)
    {
        return self::format(10005, $debug, 500);
    }
}
