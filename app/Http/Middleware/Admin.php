<?php

namespace App\Http\Middleware;

use Closure;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (auth('api')->check() && auth('api')->user()->yetki > 7) {
            return $next($request);
        }

        return response(null, 403);
    }
}
