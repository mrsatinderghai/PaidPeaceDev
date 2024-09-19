<?php

namespace App\Repositories;

use App\Models\Contact;

class ContactRepository
{
    /**
     * Get all of the tasks for a given user.
     *
     * @param  User  $user
     * @return Collection
     */
    public function company_contacts($company_id)
    {
        return Contact::where('company_id', $company_id)
                ->orderBy('name', 'asc')
                ->get();
    }

    public function team_contacts($team_id)
    {
        return Contact::where('team_id', $team_id)
            ->orderBy('name', 'asc')
            ->get();
    }

    
}