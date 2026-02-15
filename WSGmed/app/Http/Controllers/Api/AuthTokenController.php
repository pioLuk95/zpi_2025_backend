<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Password;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Common\ApiErrorCodes;
use App\Http\Traits\ApiResponseTrait;

/**
 * @OA\Tag(
 * name="Auth",
 * description="API Endpoints for authentication and token management!"
 * )
 */

/**
 * @OA\SecurityScheme(
 * securityScheme="bearerAuth",
 * type="http",
 * scheme="bearer",
 * bearerFormat="JWT"
 * )
 */
class AuthTokenController extends Controller
{
    use ApiResponseTrait; 

    /**
     * @OA\Post(
     * path="/api/login",
     * tags={"Auth"},
     * summary="Log in and get a JWT tokenn",
     * security={},
     * @OA\RequestBody(
     * required=true,
     * @OA\JsonContent(
     * required={"email", "password"},
     * @OA\Property(property="email", type="string", example="user@example.com"),
     * @OA\Property(property="password", type="string", example="password123")
     * )
     * ),
     * @OA\Response(
     * response=200,
     * description="Successful login",
     * @OA\JsonContent(
     * @OA\Property(property="access_token", type="string", example="eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9..."),
     * @OA\Property(property="token_type", type="string", example="bearer"),
     * @OA\Property(property="expires_in", type="integer", example=3600, description="Access token lifetime in seconds")
     * )
     * ),
     * @OA\Response(
     * response=401,
     * description="Unauthorized",
     * @OA\JsonContent(
     * @OA\Property(property="message", type="string", example="Unauthorized"),
     * @OA\Property(property="code", type="integer", example=10001)
     * )
     * )
     * )
     */
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (!$token = Auth::guard('api')->attempt($credentials)) {
            return $this->errorResponse(ApiErrorCodes::AUTH_LOGIN_FAILED);
        }

        $responseData = [
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => JWTAuth::factory()->getTTL() * 60 
        ];
        return $this->successResponse($responseData, 'Login successful');
    }

    /**
     * @OA\Post(
     * path="/api/logout",
     * tags={"Auth"},
     * summary="Log out the user",
     * security={{"bearerAuth":{}}},
     * @OA\Response(
     * response=200,
     * description="Successfully logged out",
     * @OA\JsonContent(
     * @OA\Property(property="message", type="string", example="Successfully logged out")
     * )
     * ),
     * @OA\Response(
     * response=401,
     * description="Unauthorized",
     * @OA\JsonContent(
     * @OA\Property(property="message", type="string", example="Unauthorized"),
     * @OA\Property(property="code", type="integer", example=10002)
     * )
     * )
     * )
     */
    public function logout(Request $request)
    {
        JWTAuth::invalidate(JWTAuth::getToken());
        return $this->successResponse([], 'Successfully logged out');
    }

    /**
     * @OA\Post(
     * path="/api/refresh",
     * tags={"Auth"},
     * summary="Refresh the JWT token",
     * description="Provides a new access token. Current token (valid or expired) must be sent in the Authorization header.",
     * security={{"bearerAuth":{}}},
     * @OA\Response(
     * response=200,
     * description="Token refreshed successfully",
     * @OA\JsonContent(
     * @OA\Property(property="access_token", type="string", example="eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9..."),
     * @OA\Property(property="token_type", type="string", example="bearer"),
     * @OA\Property(property="expires_in", type="integer", example=3600, description="New access token lifetime in seconds")
     * )
     * )
     * ),
     * @OA\Response(
     * response=401,
     * description="Refresh token not provided, invalid, or expired",
     * @OA\JsonContent(
     * @OA\Property(property="message", type="string", example="Unauthorized"),
     * @OA\Property(property="code", type="integer", example=10002)
     * )
     * )
     * )
     */
    public function refresh(Request $request)
    {
        try {
            $newToken = JWTAuth::refresh(JWTAuth::getToken());
            $responseData = [
                'access_token' => $newToken,
                'token_type' => 'bearer',
                'expires_in' => JWTAuth::factory()->getTTL() * 60
            ];
            return $this->successResponse($responseData, 'Token refreshed successfully');
        } catch (\Exception $e) {
            return $this->errorResponse(ApiErrorCodes::AUTH_INVALID_OR_EXPIRED_TOKEN);
        }
    }

    /**
     * @OA\Post(
     * path="/api/password/email",
     * tags={"Auth"},
     * summary="Send password reset email",
     * security={},
     * @OA\RequestBody(
     * required=true,
     * @OA\JsonContent(
     * required={"email"},
     * @OA\Property(property="email", type="string", example="user@example.com")
     * )
     * ),
     * @OA\Response(
     * response=200,
     * description="Password reset link sent",
     * @OA\JsonContent(
     * @OA\Property(property="message", type="string", example="Password reset link sent")
     * )
     * )
     * ),
     * @OA\Response(
     * response=422,
     * description="Validation error",
     * @OA\JsonContent(
     * @OA\Property(property="success", type="boolean", example=false),
     * @OA\Property(property="message", type="string", example="The given data was invalid."),
     * @OA\Property(property="code", type="integer", example=11000)
     * )
     * )
     * )
     */
    public function sendResetLinkEmail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'email', 'exists:patients'],
        ]);
        if ($validator->fails()) {
            return $this->errorResponse(ApiErrorCodes::VALIDATION_FAILED, $validator->errors());
        }

        $status = Password::broker('patients')->sendResetLink(
            ['email' => $request->input('email')]
        );
        
        if ($status === Password::RESET_LINK_SENT) {
            return $this->successResponse([], 'Password reset link sent');
        } else {
            
            return $this->errorResponse(ApiErrorCodes::AUTH_PASSWORD_RESET_LINK_SEND_FAILED);
        }
    }
}