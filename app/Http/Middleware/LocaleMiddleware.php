<?php

namespace App\Http\Middleware;

use Closure;

class LocaleMiddleware
{
    /**
     * Handle an incoming request.
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->hasHeader('locale')) {
            if (in_array($request->header('locale'), ['ar','en'])) {
                app()->setlocale($request->header('locale'));
                }
        }
        return $next($request);
    }
}
