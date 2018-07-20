<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminAccess
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
        // If request does not comes from logged in users with admin access
        // then he shall be redirected to Login page
        if (!Auth::user()->can('admin-access')) {
            return redirect('/login');
        }

        return $next($request);
    }
}
