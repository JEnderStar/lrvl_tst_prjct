<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Laratrust;

class RoleBasedAccessMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next, $role)
    {
        if (!Auth::check() || !Laratrust::hasRole($role)) {
            // Return 404 Page Not Found
            abort(404);

            // Or return 403 Forbidden
            // abort(403);
        }

        return $next($request);
    }
}
