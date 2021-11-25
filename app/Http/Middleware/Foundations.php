<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Foundations
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        
        // dd(explode("/",$request->url())[2]);
        if (!str_contains(explode("/", $request->url())[2],'foundation')) {
            abort(404);
        }
        return $next($request);
    }
}
