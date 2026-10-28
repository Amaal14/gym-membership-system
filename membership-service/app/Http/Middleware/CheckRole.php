<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    // usage in routes: ->middleware('role:admin') or ->middleware('role:admin,trainer')
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (! in_array($request->user()->role, $roles)) {
            abort(403);
        }

        return $next($request);
    }
}
