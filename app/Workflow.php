<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Workflow extends Model
{
    //
    protected $fillable = ['parent_id', 'parent_type'. 'assign_type', 'assign_to', 'assign_when', 'priority', 'due_date', 'name', 'team_id', 'has_fired'];

    public function parent()
    {
    	if ($this->parent_type == 'Task')
    	{
    		return $this->belongsTo('App\Task');
    	}
    	elseif ($this->parent_type == 'Sale')
    	{
    		return $this->belongsTo('App\Sale');
    	}
    	else
    	{
    		return 'Error finding parent...it is not a task or a sale!';
    	}
    	
    }

    public function sale()
    {
        return $this->belongsTo('App\Sale', 'parent_id');
    }

    public function task()
    {
        return $this->belongsTo('App\Task', 'parent_id');
    }

    
}
