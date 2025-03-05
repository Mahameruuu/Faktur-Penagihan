<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        $allowed_roles = explode('|', $role);
        
        if (!Auth::check() || !in_array(Auth::user()->role, $allowed_roles)) {
            return back();
        }

        return $next($request);
    }
}
