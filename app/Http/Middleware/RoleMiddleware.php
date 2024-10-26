<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  ...$roles
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // Check if the authenticated user has one of the roles
        if (!Auth::check() || !Auth::user()->hasAnyRole($roles)) {
            // Redirect or show a 403 error if the user doesn't have the required role
            abort(403, 'Unauthorized action.');
        }
        return $next($request);
    }
}
