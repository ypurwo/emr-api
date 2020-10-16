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
        if (Auth::guard('sanctum')->check() && Auth::guard('sanctum')->user()->role == 'Admin') {
            return $next($request);
            }
            else {
                return redirect('/');
            }
            }
}
