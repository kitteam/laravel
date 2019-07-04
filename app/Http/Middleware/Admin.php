<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (($auth = Auth::user()) && in_array($auth->id, [1,2,3])) {
            return $next($request);
        }
        
        return redirect('/user');
    }
}
