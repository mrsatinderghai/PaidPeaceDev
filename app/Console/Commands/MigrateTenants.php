<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Multitenancy\Models\Tenant;

class MigrateTenants extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tenants:migrate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run migrations for all tenants';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // Fetch all tenants
        Tenant::all()->each(function (Tenant $tenant) {
            // Set tenant as the current tenant
            $tenant->makeCurrent();

            $this->info('Running migrations for tenant: ' . $tenant->name);

            // Run the migrations on the tenant's database connection
            try {
                \Artisan::call('migrate', [
                    '--database' => 'tenant', // Use the tenant connection
                    '--path' => '/database/migrations/tenant', // Optional: Path to tenant-specific migrations
                    '--force' => true,
                ]);

                $this->info('Migrations ran successfully for tenant: ' . $tenant->name);
            } catch (\Exception $e) {
                $this->error('Failed to run migrations for tenant: ' . $tenant->name);
                $this->error($e->getMessage());
            }

            // Forget current tenant to avoid connection conflicts
            $tenant->forgetCurrent();
        });

        return Command::SUCCESS;
    }
}
