<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = ['name', 'email', 'phone', 'cell_phone', 'title', 'team_id', 'company_id'];

    public function company()
    {
    	$this->belongsTo('App\Company', 'company_id');
    }

    public function team()
    {
    	$this->belongs('App\Team', 'team_id');
    }

   
}
