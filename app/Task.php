<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{

	protected $fillable = ['name', 'created_by_user_id', 'assigned_by_user_id', 'assigned_at', 'assigned_to_user_id', 'due_date', 'status', 'priority', 'parent_id', 'parent_type', 'team_id'];


    public function parent()
    {
    	return $this->belongsTo('App\Task', 'parent_id');
    }

    public function assigned_to()
    {
    	return $this->belongsTo('App\User', 'assigned_to_user_id');
    }

    public function created_by()
    {
    	return $this->belongsTo('App\User', 'created_by_user_id');
    }

    public function notes()
    {
        return $this->hasMany('App\Note', 'parent_id', 'id');
    }
    
}
