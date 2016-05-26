<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class Error
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $roles)
    {
        if (!Auth::check() || !$request->user()->hasRole(explode('|', $roles))) {
            return redirect('error');
		}

		return $next($request);
    }
}
