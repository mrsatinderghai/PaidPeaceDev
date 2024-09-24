<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Stancl\Tenancy\Contracts\Tenant as TenantContract;
use Stancl\Tenancy\Tenancy; // Import the Tenancy class

class IdentifyTenant
{
    protected $tenancy;

    public function __construct(Tenancy $tenancy)
    {
        $this->tenancy = $tenancy;
    }

    public function handle(Request $request, Closure $next)
    {
        $host = $request->getHost(); // Get the request host (domain/subdomain)

        // Check if the host matches a tenant domain
        $tenant = \App\Models\Tenant::whereHas('domains', function ($query) use ($host) {
            $query->where('domain', $host);
        })->first();

        // If tenant is not found, return a 404 response
        if (! $tenant) {
            return abort(404, 'Tenant not found');
        }

        // Initialize tenancy with the found tenant
        $this->tenancy->initialize($tenant);

        // Proceed with the request
        return $next($request);
    }
}