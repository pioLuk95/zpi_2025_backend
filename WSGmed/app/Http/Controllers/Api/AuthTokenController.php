<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\PasswordReset;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use App\Common\ApiErrorCodes;
use App\Http\Traits\ApiResponseTrait;

/**
 * @OA\Tag(
 * name="Auth",
 * description="API Endpoints for authentication and token management"
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

    private function generateAccessToken(User $user): string
    {
        $payload = [
            'iss' => "WSGmed", 
            'sub' => $user->id, 
            'type' => 'access',
            'iat' => time(), 
            'exp' => time() + env('JWT_ACCESS_TOKEN_TTL', 3600) 
        ];
        return JWT::encode($payload, env('JWT_SECRET'), 'HS256');
    }

    private function generateRefreshToken(User $user): string
    {
        $payload = [
            'iss' => "WSGmed", 
            'sub' => $user->id, 
            'type' => 'refresh', 
            'jti' => Str::random(32), 
            'iat' => time(), 
            'exp' => time() + env('JWT_REFRESH_TOKEN_TTL', 604800) 
        ];
        return JWT::encode($payload, env('JWT_SECRET'), 'HS256');
    }

    /**
     * @OA\Post(
     * path="/api/login",
     * tags={"Auth"},
     * summary="Log in and get a JWT token",
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
     * @OA\Property(property="refresh_token", type="string", example="eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9..."),
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

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $accessToken = $this->generateAccessToken($user);
            $refreshToken = $this->generateRefreshToken($user);

            $responseData = [
                'access_token' => $accessToken,
                'refresh_token' => $refreshToken,
                'token_type' => 'bearer',
                'expires_in' => env('JWT_ACCESS_TOKEN_TTL', 3600)
            ];
            return $this->successResponse($responseData, 'Login successful');
        }

        return $this->errorResponse(ApiErrorCodes::AUTH_LOGIN_FAILED);
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
      
       
        $token = $request->bearerToken();
        if (!$token) {
            return $this->errorResponse(ApiErrorCodes::AUTH_TOKEN_NOT_PROVIDED);
        }
        
        try {
            JWT::decode($token, new Key(env('JWT_SECRET'), 'HS256'));
       
            Auth::logout();
            return $this->successResponse([], 'Successfully logged out');
        } catch (\Exception $e) {
            return $this->errorResponse(ApiErrorCodes::AUTH_INVALID_OR_EXPIRED_TOKEN);
        }
    }

    /**
     * @OA\Post(
     * path="/api/refresh",
     * tags={"Auth"},
     * summary="Refresh the JWT token",
     * description="Provides a new access token and a new refresh token in exchange for a valid refresh token.",
     * security={},
     * @OA\RequestBody(
     * required=true,
     * description="Requires a valid refresh_token.",
     * @OA\JsonContent(
     * required={"refresh_token"},
     * @OA\Property(property="refresh_token", type="string", example="eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...")
     * )
     * ),
     * @OA\Response(
     * response=200,
     * description="Token refreshed successfully",
     * @OA\JsonContent(
     * @OA\Property(property="access_token", type="string", example="eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9..."),
     * @OA\Property(property="refresh_token", type="string", example="eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9..."),
     * @OA\Property(property="token_type", type="string", example="bearer"),
     * @OA\Property(property="expires_in", type="integer", example=3600, description="New access token lifetime in seconds")
     * )
     * ),
     * @OA\Response(
     * response=401,
     * description="Refresh token not provided, invalid, or expired",
     * @OA\JsonContent(
     * @OA\Property(property="messagee", type="string", example="Unauthorized"),
     * @OA\Property(property="code", type="integer", example=10002)
     * )
     * )
     * )
     */
    public function refresh(Request $request)
    {        
        $refreshToken = $request->input('refresh_token');

        if (!$refreshToken) {
            return $this->errorResponse(ApiErrorCodes::AUTH_TOKEN_NOT_PROVIDED);
        }

        try {
            $decodedRefreshToken = JWT::decode($refreshToken, new Key(env('JWT_SECRET'), 'HS256'));

           
            if (!isset($decodedRefreshToken->type) || $decodedRefreshToken->type !== 'refresh') {
                return $this->errorResponse(ApiErrorCodes::AUTH_INVALID_OR_EXPIRED_TOKEN, 'Invalid token type provided for refresh.');
            }

            $user = User::find($decodedRefreshToken->sub);
            if (!$user) {
                
                return $this->errorResponse(ApiErrorCodes::AUTH_INVALID_OR_EXPIRED_TOKEN, 'User not found for refresh token.');
            }

            $newAccessToken = $this->generateAccessToken($user);
            $newRefreshToken = $this->generateRefreshToken($user); 

            $responseData = [
                'access_token' => $newAccessToken,
                'refresh_token' => $newRefreshToken,
                'token_type' => 'bearer',
                'expires_in' => env('JWT_ACCESS_TOKEN_TTL', 3600)
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
            'email' => ['required', 'email', 'exists:users,email'],
        ]);
        if ($validator->fails()) {
            return $this->errorResponse(ApiErrorCodes::VALIDATION_FAILED, $validator->errors());
        }

        $status = Password::sendResetLink(
            ['email' => $request->input('email')]
        );
        
        if ($status === Password::RESET_LINK_SENT) {
            return $this->successResponse([], 'Password reset link sent');
        } else {
            
            return $this->errorResponse(ApiErrorCodes::AUTH_PASSWORD_RESET_LINK_SEND_FAILED);
        }
    }
}