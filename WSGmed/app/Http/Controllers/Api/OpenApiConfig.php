<?php
// filepath: c:\Users\Administrator\Documents\GitHub\zpi_2025_backend\WSGmed\app\Http\Controllers\Api\OpenApiConfig.php


namespace App\Http\Controllers\Api;

/**
 * @OA\Info(
 *     title="API Documentation",
 *     version="1.0.0",
 *     description="API for managing medical appointments with doctors, nurses, and physiotherapists. All endpoints require JWT authentication."
 * )
 * 
 * @OA\Server(
 *     url="/api/v1",
 *     description="Medical Visit API Server"
 * )
 */
class OpenApiConfig
{
    // This class is only for OpenAPI annotations
}