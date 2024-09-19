<?php

namespace App\Repositories;

use App\Models\Company;

class CompanyRepository
{
    /**
     * Get all of the tasks for a given user.
     *
     * @param  User  $user
     * @return Collection
     */
    public function team_companies($team_id)
    {
        return Company::where('team_id', $team_id)
                ->orderBy('name', 'asc')
                ->get();
    }

    
}