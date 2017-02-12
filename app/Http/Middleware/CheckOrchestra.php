<?php

namespace Sleighdogs\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckOrchestra
{
    /**
     * Handle an incoming request.
     * if not Orchestra redirect to home
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::user()->current_role != 0) {
            return redirect()->route('home');
        }
        return $next($request);
    }
}
