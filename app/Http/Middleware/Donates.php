<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Donates
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
        // dd("TES");
        if(!str_contains(explode("/", $request->url())[2], 'donate')){
            abort(404);
        }
        return $next($request);
    }
}
