<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;


class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
public function handle($request, Closure $next, $role)
{
    if (Auth::check()) {
        $userRole = Auth::user()->id_level;

        if (
            ($role === 'admin' && $userRole == 1) ||
            ($role === 'kader' && $userRole == 2) ||
            ($role === 'ortu' && $userRole == 3)
        ) {
            return $next($request);
        }
    }

    abort(403); 
}

}
