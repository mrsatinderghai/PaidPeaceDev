<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $fillable = ['parent_id', 'parent_type', 'user_id', 'text'];

    public function author()
    {
    	return $this->belongsTo('App\Models\User', 'user_id');
    }

    /*public function parent($type) 
    {
    	if ($type == 'task')
    	{
    		return $this->belongsTo('App\Models\Task', 'parent_id');
    	}
    }*/

}
