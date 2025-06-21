<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if user is authenticated and has admin role
        if (!auth()->check() || auth()->user()->role !== 'admin') {
            // Redirect to home page with error message
            return redirect()->route('home')->with('error', 'Brak uprawnień. Tylko administratorzy mogą uzyskać dostęp do tej strony.');
        }

        return $next($request);
    }
}
