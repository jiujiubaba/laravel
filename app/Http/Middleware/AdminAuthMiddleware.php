<?php

namespace App\Http\Middleware;

use Closure, Auth;

class AdminAuthMiddleware
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
        if ($request->ajax()) {
            return response('Unauthorized.', 401);
        }
        
        $user = Auth::user();
        if (!$user) {
            return redirect()->guest('/backend/login');
        }
        if ($user->category != 1) {
            return redirect()->guest('/backend/login');
        }

        return $next($request);
    }
}
