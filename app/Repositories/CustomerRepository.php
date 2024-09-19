<?php

namespace App\Repositories;

use App\Models\Customer;

class CustomerRepository
{
    /**
     * Get all of the tasks for a given user.
     *
     * @param  User  $user
     * @return Collection
     */
    public function customers($team_id, $sort_by)
    {
        return Customer::where('team_id', $team_id)
                ->orderBy($sort_by, 'asc')
                ->get();
    }


}
