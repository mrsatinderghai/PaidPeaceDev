<?php

namespace App\Providers;

use App\Model;
use App\Note;
use App\Policies\NotePolicy;

use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;



class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
        'App\Task' => 'App\Policies\TaskPolicy',
        'App\Company' => 'App\Policies\CompanyPolicy',
        'App\Sale' => 'App\Policies\SalePolicy',
        'App\Contact' => 'App\Policies\ContactPolicy',
        Note::class => NotePolicy::class,
        'App\Transaction' => 'App\Policies\TransactionPolicy',
        'App\Invoice' => 'App\Policies\InvoicePolicy',
        'App\Workflow' => 'App\Policies\WorkflowPolicy',
        'App\User' => 'App\Policies\UserPolicy',
        
    ];

    /**
     * Register any application authentication / authorization services.
     *
     * @param  \Illuminate\Contracts\Auth\Access\Gate  $gate
     * @return void
     */
    public function boot(GateContract $gate)
    {
        $this->registerPolicies($gate);

        //
    }
}
