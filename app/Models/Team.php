<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $fillable = ['name', 'logo'];

    public function members()
    {
        return $this->hasMany('App\Models\User', 'team_id', 'id');
    }

    public function companies()
    {
    	return $this->hasMany('App\Models\Company', 'team_id', 'id');
    }

    public function contacts()
    {
    	return $this->hasMany('App\Models\Contact', 'team_id', 'id');
    }
}
