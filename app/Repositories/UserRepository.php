<?php

namespace App\Repositories;

use App\User;
use Auth;

class UserRepository
{
  /**
  * Get all of the tasks for a given user.
  *
  * @param  User  $user
  * @return Collection
  */
  public function get_all_users()
  {
//     return User::all();
    return User::where('is_active' , 1)->get(); 
  }

}
