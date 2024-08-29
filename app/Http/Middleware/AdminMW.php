<?php

namespace App\Http\Middleware;

use Closure;

class AdminMW
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
        if ($request->user()->has_role('Global Admin') OR $request->user()->has_role('Admin') OR $request->user()->is_admin)
        {
            return $next($request);
        }
        return redirect('/access_denied');

    }
}
