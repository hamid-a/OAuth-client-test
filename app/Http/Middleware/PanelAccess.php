<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class PanelAccess
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
        // If request does not comes from logged in users
        // then he shall be redirected to Login page
        if (!Auth::user()->can('dashboard-access')) {
            return redirect('/login');
        }

        return $next($request);
    }
}
