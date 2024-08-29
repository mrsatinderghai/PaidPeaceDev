<?php

namespace App\Repositories;

use App\Service;

class ServiceRepository
{
    /**
     * Get all of the tasks for a given user.
     *
     * @param  User  $user
     * @return Collection
     */

    public function team_services($team_id = 1)
    {
        return Service::where('team_id', $team_id)
                        ->where('is_retired', False)
                        ->orderBy('description')
                        ->get();
    }

}
