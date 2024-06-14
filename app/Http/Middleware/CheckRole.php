<?php

namespace App\Http\Middleware;

use App\Models\enums\Roles;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Log;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        try {
            // Get the authenticated user
            $user = Auth::user();

            // Check if the 'role' claim exists and has the specified role

            if ($user && $user->role == $role) {
                return $next($request);
            }

            return response('Unauthorized.', 401);
        } catch (\Exception $e) {
            // Handle token not provided or invalid
            return response('Unauthorized.', 401);
        }
    }
}
