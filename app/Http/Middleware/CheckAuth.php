<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Log;

class CheckAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        Log::warning($request);
        try {
            // Attempt to authenticate the user using the JWT token
            $user = JWTAuth::parseToken()->authenticate();
            // Check if authentication was successful
            if ($user) {
                return $next($request);
            }

            return response('Unauthorized.', 401);
        } catch (\Exception $e) {
            // Handle token not provided or invalid
            return response('Unauthorized.', 401);
        }
    }
}
