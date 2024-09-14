<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Log;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */ 
    public function handle($request, Closure $next, ...$roles)
    {
        $user = Auth::user();
        Log::info('User role:', ['role' => $user ? $user->type : 'Guest']);
        Log::info('Roles being checked:', ['roles' => $roles]);

        if (!$user || !in_array($user->type, $roles)) {
            abort(403, 'Access denied in role');
        }

        return $next($request);
    }
}