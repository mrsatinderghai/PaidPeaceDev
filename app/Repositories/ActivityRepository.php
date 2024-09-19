<?php

namespace App\Repositories;

use App\Models\Activity;

class ActivityRepository
{
    /**
     * Get all of the tasks for a given user.
     *
     * @param  User  $user
     * @return Collection
     */

    public function get_activities($id, $parent_type)
    {
        return Activity::where(['parent_id' => $id, 'parent_type' => $parent_type])
            ->orderBy('created_at', 'desc')
            ->get();
    }

}
