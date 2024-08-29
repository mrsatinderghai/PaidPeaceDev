<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $fillable = ['name', 'logo'];

    public function members()
    {
        return $this->hasMany('App\User', 'team_id', 'id');
    }

    public function companies()
    {
    	return $this->hasMany('App\Company', 'team_id', 'id');
    }

    public function contacts()
    {
    	return $this->hasMany('App\Contact', 'team_id', 'id');
    }
}
