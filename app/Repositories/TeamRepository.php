<?php

namespace App\Repositories;

use App\Models\Team;
use App\Models\User;

class TeamRepository
{
    /**
     * Get all of the tasks for a given user.
     *
     * @param  User  $user
     * @return Collection
     */
    public function all()
    {
        return Team::all();
    }

    public function members($id)
    {
        return User::where('team_id', $id)
            ->orderBy('name', 'asc')
            ->get();
    }
}