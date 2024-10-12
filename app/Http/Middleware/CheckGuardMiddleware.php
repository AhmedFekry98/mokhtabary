<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckGuardMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
            $guard = $request->route('guard');
            
           // Check if the guard is 'family' and the user is not authenticated
           if ($guard === 'family' && !auth('sanctum')->check()) {
          
            return response()->json(['message' => 'Unauthorized'], 401); // Respond with 401 Unauthorized
        }

        return $next($request);
    }
}
