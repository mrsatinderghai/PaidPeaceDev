<?php

namespace App\Repositories;

use App\Role;
use Auth;

class RoleRepository
{
  /**
  * Get all of the tasks for a given user.
  *
  * @param  User  $user
  * @return Collection
  */
  public function get_all_roles()
  {
    return Role::all();
  }

}
