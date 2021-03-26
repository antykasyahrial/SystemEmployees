<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class StaffMiddleware
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
        if(session()->get('creds')){
            if(session()->get('creds')->hasRole('staff')){
                return $next($request);
            }
        }
        return redirect(route('login'))->with('message',"Unauthorized");
    }
}
