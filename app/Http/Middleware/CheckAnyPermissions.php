<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use Illuminate\Support\Facades\Auth;
class CheckAnyPermissions
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next, ...$permissions)
    {
        // Flatten the permissions array
        $permissions = is_array($permissions[0]) ? $permissions[0] : $permissions;

        if (!Auth::check() || !Auth::user()->canAny($permissions)) {
            abort(404); // Or return any other response, e.g., redirect to a specific page
        }

        return $next($request);
    }
}
