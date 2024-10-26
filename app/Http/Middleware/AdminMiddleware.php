<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // Check if the authenticated user has any of the required roles
        if (Auth::check() && Auth::user()->hasAnyRole($roles)) {
            return $next($request);
        }

        // If the user does not have the required roles, redirect them to the home page
        return redirect('/')->with('error', 'You do not have the required access.');
    }
}
