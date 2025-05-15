<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
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
     * Register a new user
     *
     * Creates a new user account and returns a JWT token upon successful registration.
     *
     * @OA\Post(
     *     path="/api/register",
     *     tags={"Auth"},
     *     summary="Register a new user",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name", "email", "password", "password_confirmation"},
     *             @OA\Property(property="name", type="string", example="John Doe"),
     *             @OA\Property(property="email", type="string", example="user@example.com"),
     *             @OA\Property(property="password", type="string", example="password123"),
     *             @OA\Property(property="password_confirmation", type="string", example="password123")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="User registered successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="User registered successfully"),
     *             @OA\Property(property="token", type="string", example="eyJhbGciOiJIUzI1...")
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="The given data was invalid."),
     *             @OA\Property(property="errors", type="object",
     *                 example={
     *                     "email": {"The email has already been taken."},
     *                     "password": {"The password confirmation does not match."}
     *                 }
     *             )
     *         )
     *     )
     * )
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'The given data was invalid.',
                'errors' => $validator->errors(),
            ], 422);
        }

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);

        $payload = [
            'iss' => "WSGmed",
            'sub' => $user->id,
            'iat' => time(),
            'exp' => time() + 60*60
        ];

        $jwt = JWT::encode($payload, env('JWT_SECRET'), 'HS256');

        return response()->json([
            'message' => 'User registered successfully',
            'token' => $jwt,
        ], 201);
    }

    /**
     * Log in and get a JWT token
     *
     * Authenticates the user and returns a JWT token if credentials are valid.
     *
     * @OA\Post(
     *     path="/api/login",
     *     tags={"Auth"},
     *     summary="Log in and get a JWT token",
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
     *         description="Unauthorized"
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

        return response()->json(['error' => 'Unauthorized'], 401);
    }

    /**
     * Log out the user
     *
     * Logs out the currently authenticated user.
     *
     * @OA\Post(
     *     path="/api/logout",
     *     tags={"Auth"},
     *     summary="Log out the user",
     *     @OA\Response(
     *         response=200,
     *         description="Successfully logged out",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Successfully logged out")
     *         )
     *     )
     * )
     */
    public function logout(Request $request)
    {
        Auth::logout();
        return response()->json(['message' => 'Successfully logged out'], 200);
    }

    /**
     * Refresh the JWT token
     *
     * Generates a new JWT token based on the provided valid token.
     *
     * @OA\Post(
     *     path="/api/refresh",
     *     tags={"Auth"},
     *     summary="Refresh the JWT token",
     *     @OA\Response(
     *         response=200,
     *         description="Token refreshed successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="token", type="string", example="eyJhbGciOiJIUzI1...")
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Token not provided or invalid"
     *     )
     * )
     */
    public function refresh(Request $request)
    {
        $token = $request->bearerToken();

        if (!$token) {
            return response()->json(['error' => 'Token not provided'], 401);
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
            return response()->json(['error' => 'Invalid token'], 401);
        }
    }

    /**
     * Confirm user's password
     *
     * Checks if the provided password matches the authenticated user's password.
     *
     * @OA\Post(
     *     path="/api/confirm-password",
     *     tags={"Auth"},
     *     summary="Confirm user's password",
     *     security={{"bearerAuth":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"password"},
     *             @OA\Property(property="password", type="string", example="password123")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Password confirmed successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Password confirmed successfully")
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized or invalid token",
     *         @OA\JsonContent(
     *             @OA\Property(property="error", type="string", example="Unauthorized")
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="The given data was invalid."),
     *             @OA\Property(property="errors", type="object",
     *                 example={
     *                     "password": {"The password field is required."}
     *                 }
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=403,
     *         description="Password does not match",
     *         @OA\JsonContent(
     *             @OA\Property(property="error", type="string", example="Password does not match")
     *         )
     *     )
     * )
     */
    public function confirmPassword(Request $request)
    {
        $token = $request->bearerToken();
        if (!$token) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        try {
            $decoded = JWT::decode($token, new Key(env('JWT_SECRET'), 'HS256'));
            $userId = $decoded->sub;
            $user = User::find($userId);
            if (!$user) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $validator = Validator::make($request->all(), [
            'password' => ['required', 'string'],
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => 'The given data was invalid.',
                'errors' => $validator->errors(),
            ], 422);
        }

        if (!Hash::check($request->input('password'), $user->password)) {
            return response()->json(['error' => 'Password does not match'], 403);
        }

        return response()->json(['message' => 'Password confirmed successfully'], 200);
    }

    /**
     * Send password reset email
     *
     * Sends a password reset link to the user's email.
     *
     * @OA\Post(
     *     path="/api/password/email",
     *     tags={"Auth"},
     *     summary="Send password reset email",
     *     security={{"bearerAuth":{}}},
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
     *         response=401,
     *         description="Unauthorized",
     *         @OA\JsonContent(
     *             @OA\Property(property="error", type="string", example="Unauthorized")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="User not found",
     *         @OA\JsonContent(
     *             @OA\Property(property="error", type="string", example="User not found")
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
     *             )
     *         )
     *     )
     * )
     */
    public function sendResetLinkEmail(Request $request)
    {
        // JWT auth
        $token = $request->bearerToken();
        if (!$token) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        try {
            $decoded = JWT::decode($token, new Key(env('JWT_SECRET'), 'HS256'));
        } catch (\Exception $e) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $validator = Validator::make($request->all(), [
            'email' => ['required', 'email', 'exists:users,email'],
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => 'The given data was invalid.',
                'errors' => $validator->errors(),
            ], 422);
        }

        $user = User::where('email', $request->input('email'))->first();
        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }
 $status = Password::sendResetLink(
            ['email' => $request->input('email')]
        );

        if ($status === Password::RESET_LINK_SENT) {
            return response()->json(['message' => 'Password reset link sent'], 200);
        } else {
            return response()->json(['error' => 'Unable to send reset link'], 500);
        }
    }

    /**
     * Reset password
     *
     * Resets the user's password using a valid token.
     *
     * @OA\Post(
     *     path="/api/password/reset",
     *     tags={"Auth"},
     *     summary="Reset password",
     *     security={{"bearerAuth":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"email", "token", "password", "password_confirmation"},
     *             @OA\Property(property="email", type="string", example="user@example.com"),
     *             @OA\Property(property="token", type="string", example="reset-token"),
     *             @OA\Property(property="password", type="string", example="newpassword123"),
     *             @OA\Property(property="password_confirmation", type="string", example="newpassword123")
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
     *         response=401,
     *         description="Unauthorized",
     *         @OA\JsonContent(
     *             @OA\Property(property="error", type="string", example="Unauthorized")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="User not found",
     *         @OA\JsonContent(
     *             @OA\Property(property="error", type="string", example="User not found")
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
     *             )
     *         )
     *     )
     * )
     */
    public function resetPassword(Request $request)
    {
        // JWT auth
        $token = $request->bearerToken();
        if (!$token) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        try {
            $decoded = JWT::decode($token, new Key(env('JWT_SECRET'), 'HS256'));
        } catch (\Exception $e) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $validator = Validator::make($request->all(), [
            'email' => ['required', 'email', 'exists:users,email'],
            'token' => ['required', 'string'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => 'The given data was invalid.',
                'errors' => $validator->errors(),
            ], 422);
        }

        $user = User::where('email', $request->input('email'))->first();
        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

       $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->password = Hash::make($password);
                $user->setRememberToken(Str::random(60));
                $user->save();
                event(new PasswordReset($user));
            }
        );

        if ($status === Password::PASSWORD_RESET) {
            return response()->json(['message' => 'Password reset successfully'], 200);
        } else {
            return response()->json(['error' => 'Invalid token or email'], 400);
        }
    }

    /**
     * Verify user's email
     *
     * Verifies the user's email using a verification token.
     *
     * @OA\Post(
     *     path="/api/email/verify",
     *     tags={"Auth"},
     *     summary="Verify user's email",
     *     security={{"bearerAuth":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"id", "hash"},
     *             @OA\Property(property="id", type="integer", example=1),
     *             @OA\Property(property="hash", type="string", example="verification-hash")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Email verified successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Email verified successfully")
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized",
     *         @OA\JsonContent(
     *             @OA\Property(property="error", type="string", example="Unauthorized")
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid verification data",
     *         @OA\JsonContent(
     *             @OA\Property(property="error", type="string", example="Invalid verification data")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="User not found",
     *         @OA\JsonContent(
     *             @OA\Property(property="error", type="string", example="User not found")
     *         )
     *     )
     * )
     */
    public function verifyEmail(Request $request)
    {
        // JWT auth
        $token = $request->bearerToken();
        if (!$token) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        try {
            $decoded = JWT::decode($token, new Key(env('JWT_SECRET'), 'HS256'));
        } catch (\Exception $e) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $validator = Validator::make($request->all(), [
            'id' => ['required', 'integer', 'exists:users,id'],
            'hash' => ['required', 'string'],
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => 'The given data was invalid.',
                'errors' => $validator->errors(),
            ], 400);
        }

        $user = User::find($request->input('id'));
        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        $expectedHash = sha1($user->getEmailForVerification());
        if ($request->input('hash') !== $expectedHash) {
            return response()->json(['error' => 'Invalid verification data'], 400);
        }

        if ($user->hasVerifiedEmail()) {
            return response()->json(['message' => 'Email already verified'], 200);
        }

        $user->markEmailAsVerified();

        return response()->json(['message' => 'Email verified successfully'], 200);
    }
}