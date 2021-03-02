<?php

namespace App\Http\Middleware;

use Closure;

class GuestGet
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle(\Illuminate\Http\Request $request, Closure $next)
    {
        if ($request->method() === "GET" || (auth('api')->check() && auth('api')->user()->role > 7)) {
            return $next($request);
        }

        return response(null, 403);
    }
}
