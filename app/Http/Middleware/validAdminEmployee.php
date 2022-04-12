<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class validAdminEmployee
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
        if(session('role')=="Admin" or session('role')=="Employee"){
            return $next($request);
        }
        return redirect()->route('login');
    }
}
