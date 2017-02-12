<?php

namespace Sleighdogs\Http\Middleware;

use Closure;

class CheckRole
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
        if (session('user_role') == null) {
            return redirect()->route('role.select');
        }
        return $next($request);
    }
}
