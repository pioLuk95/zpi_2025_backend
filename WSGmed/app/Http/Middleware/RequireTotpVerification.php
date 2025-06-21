<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Session;

class RequireTotpVerification
{
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();
        if (!$user->is2FAEnabled()) {
            return redirect()->route('2fa.setup')->with('error', 'You have to set up 2FA first'); // TODO ? Przekierowujemy dod razu do ustawienia 2FA - można ew. zostawaić na bieżącej stronie
        }

        if (Session::get('2fa_passed')) {
            return $next($request);
        }

        return redirect()->guest(route('2fa.prompt'));
    }
}
