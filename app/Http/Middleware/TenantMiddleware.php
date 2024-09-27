<?php


namespace App\Http\Middleware;

use Closure;
use App\Models\Tenant;
use Spatie\Multitenancy\Models\Concerns\UsesTenantModel;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class TenantMiddleware
{
    use UsesTenantModel;

    public function handle($request, Closure $next)
    {

        $host = $request->getHost();
        $isMainDomain = $host === env('MAIN_DOMAIN');

        if ($isMainDomain == 1) {
            if ($request->url('register') || $request->url('register.*') || $request->url('login') || $request->url('login.*')  ||  $request->url('password.*')) {
                return $next($request);
            }
        }

        $host = $request->getHost();

        // Extract the subdomain from the host
        $subdomain = explode('.', $host)[0];

        // Fetch the tenant based on the subdomain
        $tenant = Tenant::where('domain', $subdomain)->first();


        if ($tenant) {
            // Set tenant's database as the active connection
            Config::set('database.connections.tenant.database', $tenant->database);
            DB::purge('tenant');  // Reset the tenant connection

            // Set 'tenant' as the default database connection for this request
            DB::setDefaultConnection('tenant');
        } else {
            return response()->json([
                'error' => 'Tenant not found.',
                'message' => 'The requested tenant could not be located. Please check the subdomain or contact support.'
            ], 404);
        }


        return $next($request);
    }
}
