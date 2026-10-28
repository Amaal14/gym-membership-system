<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

// Only the main app (Membership service) knows the key,
// so nobody else can call this service directly.
class CheckServiceKey
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->header('X-Service-Key') !== config('services.key')) {
            return response()->json(['message' => 'Wrong service key'], 401);
        }

        return $next($request);
    }
}
