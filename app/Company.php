<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = ['name', 'address', 'city', 'state', 'zip', 'phone', 'team_id', 'website'];
    protected $table = 'companies';

    public function team()
    {
    	$this->belongsTo('App\Team', 'team_id');
    }

    public function contacts()
    {
    	$this->hasMany('App\Contact', 'company_id', 'id');
    }


}
