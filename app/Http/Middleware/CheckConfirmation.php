<?php

namespace Sleighdogs\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckConfirmation
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
        if (Auth::user()->confirmed === 0) {
            return redirect()->route('confirmation.view');
        }
        
        return $next($request);
    }
}
