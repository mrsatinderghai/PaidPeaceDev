<?php

namespace App\Http\Middleware;

use Closure;

class CheckTenantDomain
{
    public function handle($request, Closure $next)
    {
        $host = $request->getHost();
        $isMainDomain = $host === env('MAIN_DOMAIN');
        $request->attributes->set('isMainDomain', $isMainDomain);

        return $next($request);
    }
}
