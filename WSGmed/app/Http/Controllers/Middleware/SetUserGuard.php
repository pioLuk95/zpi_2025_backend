<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class SetUserGuard
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        foreach (['patient', 'staff', 'web'] as $guard) {
            if (Auth::guard($guard)->check()) {
                Auth::shouldUse($guard);
                break;
            }
        }
        return $next($request);
    }
}
