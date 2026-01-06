<?php

namespace App\Common;

class ApiErrorCodes
{
    public const AUTH_LOGIN_FAILED = 10001;
    public const AUTH_TOKEN_NOT_PROVIDED = 10002;
    public const AUTH_INVALID_OR_EXPIRED_TOKEN = 10003;
    public const AUTH_PASSWORD_RESET_TOKEN_INVALID = 10010;
    public const AUTH_PASSWORD_RESET_LINK_SEND_FAILED = 10011;
    public const AUTH_FORBIDDEN = 10030; 
    public const VALIDATION_FAILED = 11000; 
    public const USER_NOT_FOUND = 12001;
    public const USER_CREATION_FAILED = 12002;
    public const USER_UPDATE_FAILED = 12003;
    public const USER_DELETION_FAILED = 12004;
    public const USER_EMAIL_ALREADY_EXISTS = 12005;
    public const RESOURCE_NOT_FOUND = 13001; 
    public const VISIT_SLOT_UNAVAILABLE = 14001;
    public const CLIENT_TOO_MANY_REQUESTS = 15001; 
    public const SERVER_ERROR = 19001; 
    public const SERVICE_UNAVAILABLE = 19002; 

    private static array $messages = [
       
        self::AUTH_LOGIN_FAILED => 'Invalid email or password.',
        self::AUTH_TOKEN_NOT_PROVIDED => 'Authentication token not provided.',
        self::AUTH_INVALID_OR_EXPIRED_TOKEN => 'Invalid or expired authentication token.',
        self::AUTH_PASSWORD_RESET_TOKEN_INVALID => 'Invalid or expired password reset token, or email mismatch.',
        self::AUTH_PASSWORD_RESET_LINK_SEND_FAILED => 'Unable to send password reset link. Please try again later.',
        self::AUTH_FORBIDDEN => 'You do not have permission to perform this action.',
        self::VALIDATION_FAILED => 'The given data was invalid.',
        self::VISIT_SLOT_UNAVAILABLE => 'The selected specialist is unavailable at this time. Please choose a different time slot.',
        self::USER_NOT_FOUND => 'User not found.',
        self::USER_CREATION_FAILED => 'Failed to create user.',
        self::USER_UPDATE_FAILED => 'Failed to update user.',
        self::USER_DELETION_FAILED => 'Failed to delete user.',
        self::USER_EMAIL_ALREADY_EXISTS => 'The email address is already in use.',
        self::RESOURCE_NOT_FOUND => 'The requested resource was not found.',
        self::CLIENT_TOO_MANY_REQUESTS => 'You have made too many requests in a short period. Please try again later.',
        self::SERVER_ERROR => 'An unexpected error occurred on the server.',
        self::SERVICE_UNAVAILABLE => 'The service is temporarily unavailable. Please try again later.',
    ];

    public static function getMessage(int $code): string
    {
        return self::$messages[$code] ?? 'An unknown error occurred.';
    }
}