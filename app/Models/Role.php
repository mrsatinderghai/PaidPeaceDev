<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ['name'];

    public function user_roles()
    {
      return $this->belongsToMany('App\Models\User', 'user_roles');
    }
}
