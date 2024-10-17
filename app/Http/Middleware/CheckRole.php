<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next,  $role): Response
    {
        // Check if the user is authenticated
        if (!Auth::check()) {
            return redirect('/login');
        }

        // Get the currently authenticated user
        $user = Auth::user();

        // Check if the user's role matches the required role
        if ($user->role != $role) {
            // If not, abort with a 403 Unauthorized response
            return abort(403, 'Unauthorized action.');
        }

        // Proceed with the request
        return $next($request);
     
    }
}
