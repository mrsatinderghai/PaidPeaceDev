<?php

namespace App\Repositories;

use App\Models\Product;

class ProductRepository
{
    /**
     * Get all of the tasks for a given user.
     *
     * @param  User  $user
     * @return Collection
     */

    public function team_products($team_id = 1)
    {
        return Product::where('team_id', $team_id)
                        ->where('is_retired', False)
                        ->orderBy('description')
                        ->get();
    }

}
