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

/**
 * @OA\Tag(
 *     name="Auth",
 *     description="API Endpoints for authentication and token management"
 * )
 */

/**
 * @OA\SecurityScheme(
 *     securityScheme="bearerAuth",
 *     type="http",
 *     scheme="bearer",
 *     bearerFormat="JWT"
 * )
 */
class AuthTokenController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/login",
     *     tags={"Auth"},
     *     summary="Log in and get a JWT token",
     *     security={},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"email", "password"},
     *             @OA\Property(property="email", type="string", example="user@example.com"),
     *             @OA\Property(property="password", type="string", example="password123")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful login",
     *         @OA\JsonContent(
     *             @OA\Property(property="token", type="string", example="eyJhbGciOiJIUzI1...")
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized",
     *         @OA\JsonContent(
     *             @OA\Property(property="error", type="string", example="Unauthorized"),
     *             @OA\Property(property="code", type="integer", example=10001)
     *         )
     *     )
     * )
     */
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            $payload = [
                'iss' => "WSGmed",
                'sub' => $user->id,
                'iat' => time(),
                'exp' => time() + 60*60
            ];

            $jwt = JWT::encode($payload, env('JWT_SECRET'), 'HS256');

            return response()->json(['token' => $jwt], 200);
        }

        return response()->json(['error' => 'Unauthorized', 'code' => 10001], 401);
    }

    /**
     * @OA\Post(
     *     path="/api/logout",
     *     tags={"Auth"},
     *     summary="Log out the user",
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="Successfully logged out",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Successfully logged out")
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized",
     *         @OA\JsonContent(
     *             @OA\Property(property="error", type="string", example="Unauthorized"),
     *             @OA\Property(property="code", type="integer", example=10001)
     *         )
     *     )
     * )
     */
    public function logout(Request $request)
    {
        $token = $request->bearerToken();
        if (!$token) {
            return response()->json(['error' => 'Unauthorized', 'code' => 10001], 401);
        }
        
        try {
            JWT::decode($token, new Key(env('JWT_SECRET'), 'HS256'));
            Auth::logout();
            return response()->json(['message' => 'Successfully logged out'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Unauthorized', 'code' => 10001], 401);
        }
    }

    /**
     * @OA\Post(
     *     path="/api/refresh",
     *     tags={"Auth"},
     *     summary="Refresh the JWT token",
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="Token refreshed successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="token", type="string", example="eyJhbGciOiJIUzI1...")
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Token not provided or invalid",
     *         @OA\JsonContent(
     *             @OA\Property(property="error", type="string", example="Unauthorized"),
     *             @OA\Property(property="code", type="integer", example=10001)
     *         )
     *     )
     * )
     */
    public function refresh(Request $request)
    {
        $token = $request->bearerToken();

        if (!$token) {
            return response()->json(['error' => 'Token not provided', 'code' => 10001], 401);
        }

        try {
            $decoded = JWT::decode($token, new Key(env('JWT_SECRET'), 'HS256'));
            $userId = $decoded->sub;

            $payload = [
                'iss' => "WSGmed",
                'sub' => $userId,
                'iat' => time(),
                'exp' => time() + 60*60
            ];

            $newJwt = JWT::encode($payload, env('JWT_SECRET'), 'HS256');

            return response()->json(['token' => $newJwt], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Invalid token', 'code' => 10001], 401);
        }
    }

    /**
     * @OA\Post(
     *     path="/api/password/email",
     *     tags={"Auth"},
     *     summary="Send password reset email",
     *     security={},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"email"},
     *             @OA\Property(property="email", type="string", example="user@example.com")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Password reset link sent",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Password reset link sent")
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="The given data was invalid."),
     *             @OA\Property(property="errors", type="object",
     *                 example={
     *                     "email": {"The email field is required."}
     *                 }
     *             ),
     *             @OA\Property(property="code", type="integer", example=10022)
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Unable to send reset link",
     *         @OA\JsonContent(
     *             @OA\Property(property="error", type="string", example="Unable to send reset link"),
     *             @OA\Property(property="code", type="integer", example=10100)
     *         )
     *     )
     * )
     */
    public function sendResetLinkEmail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'email', 'exists:users,email'],
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => 'The given data was invalid.',
                'errors' => $validator->errors(),
                'code' => 10002,
            ], 422);
        }

        $status = Password::sendResetLink(
            ['email' => $request->input('email')]
        );

        if ($status === Password::RESET_LINK_SENT) {
            return response()->json(['message' => 'Password reset link sent'], 200);
        } else {
            return response()->json(['error' => 'Unable to send reset link', 'code' => 10100], 500);
        }
    }

    /**
     * @OA\Post(
     *     path="/api/password/reset",
     *     tags={"Auth"},
     *     summary="Reset password",
     *     security={},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"email", "password"},
     *             @OA\Property(property="email", type="string", example="user@example.com"),
     *             @OA\Property(property="password", type="string", example="newpassword123"),
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Password reset successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Password reset successfully")
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid token or email",
     *         @OA\JsonContent(
     *             @OA\Property(property="error", type="string", example="Invalid token or email"),
     *             @OA\Property(property="code", type="integer", example=10000)
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="The given data was invalid."),
     *             @OA\Property(property="errors", type="object",
     *                 example={
     *                     "password": {"The password confirmation does not match."}
     *                 }
     *             ),
     *             @OA\Property(property="code", type="integer", example=10022)
     *         )
     *     )
     * )
     */
    public function resetPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'email', 'exists:users,email'],
            'token' => ['required', 'string'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => 'The given data was invalid.',
                'errors' => $validator->errors(),
                'code' => 10022,
            ], 422);
        }

        $status = Password::reset(
            $request->only('email', 'password'),
            function ($user, $password) {
                $user->password = Hash::make($password);
                $user->save();
                event(new PasswordReset($user));
            }
        );

        if ($status === Password::PASSWORD_RESET) {
            return response()->json(['message' => 'Password reset successfully'], 200);
        } else {
            return response()->json(['error' => 'Invalid login or email', 'code' => 10000], 400);
        }
    }
}