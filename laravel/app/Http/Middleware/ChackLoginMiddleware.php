<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ChackLoginMiddleware
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
        if (session()->has('username')){
            return $next($request);
        } else {
            return redirect('/login')->with('pesan', "Login");
        }
    }
}
