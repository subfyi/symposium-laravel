<?php

namespace App\Http\Middleware;

use Closure;

class MakePutPost
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
        if ($request->method() === 'PUT') {
            $request->setMethod('POST');
        }
        
        return $next($request);
    }
}
