<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Firebase\JWT\ExpiredException;
use Firebase\JWT\SignatureInvalidException;
use Symfony\Component\HttpFoundation\Response;

class AuthenticateJwt
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->bearerToken();

        if (!$token) {
            return response()->json(['error' => 'Token not provided', 'code' => 10001], Response::HTTP_UNAUTHORIZED);
        }

        try {
            $decoded = JWT::decode($token, new Key(env('JWT_SECRET'), 'HS256'));

           
            if (!isset($decoded->sub)) {
                return response()->json(['error' => 'Invalid token structure', 'code' => 10001], Response::HTTP_UNAUTHORIZED);
            }

            $user = User::find($decoded->sub);

            if (!$user) {
                return response()->json(['error' => 'User not found for token', 'code' => 10001], Response::HTTP_UNAUTHORIZED);
            }

            Auth::setUser($user);
        } catch (ExpiredException $e) {
            return response()->json(['error' => 'Token has expired', 'code' => 10001], Response::HTTP_UNAUTHORIZED);
        } catch (SignatureInvalidException $e) {
            return response()->json(['error' => 'Invalid token signature', 'code' => 10001], Response::HTTP_UNAUTHORIZED);
        } catch (\Throwable $e) { 
            return response()->json(['error' => 'Invalid token', 'code' => 10001], Response::HTTP_UNAUTHORIZED);
        }

        return $next($request);
    }
}