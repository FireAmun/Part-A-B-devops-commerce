<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
class RedirectIfAuthenticated
{
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                // Debugging: Log the current route
                Log::info('RedirectIfAuthenticated triggered for route: ' . $request->path());
                // Redirect authenticated users to the home page
                return redirect()->route('home');
            }
        }

        return $next($request);
    }
}
