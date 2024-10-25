<?php

namespace App\Http\Middleware;

use Closure;
use Graphicode\Standard\Traits\ApiResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleCheck
{
    use ApiResponses;

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        $user = Auth::user();

        if (! $user ) {
            return $this->unauthorizedResponse([], "Unauthenticated");
        }

        if (! $user->role || ! in_array($user->role->name, $roles) ) {
            $names = implode(', ', $roles);
            return $this->unauthorizedResponse([], "You not have a role: $names");
        }

        return $next($request);
    }
}
