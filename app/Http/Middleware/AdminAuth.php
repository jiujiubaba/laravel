<?php

namespace App\Http\Middleware;

use Closure;

class AdminAuth
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
        Config::set('auth.model', 'App\Admin');
        Config::set('auth.table', 'admins');

        if(!Auth::check()){
            return redirect()->guest('backend/login');
        }
        
        return $next($request);
    }
}
