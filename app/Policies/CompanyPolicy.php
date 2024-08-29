<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\Company;
use App\User;

class CompanyPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function destroy(User $user, Company $company)
    {
        return $user->team_id == $company->team_id;
    }
}
