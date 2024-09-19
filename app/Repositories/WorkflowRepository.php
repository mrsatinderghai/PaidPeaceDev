<?php

namespace App\Repositories;

use App\Models\Workflow;
use App\Models\User;
use App\Models\Task;
use Auth;

class WorkflowRepository
{
    /**
     * Get all of the tasks for a given user.
     *
     * @param  User  $user
     * @return Collection
     */
    public function get_workflows($id, $type)
    {
        return Workflow::where('parent_id', $id)
            ->where('parent_type', $type)
            ->orderBy('created_at', 'asc')
            ->get();
    }

    public function fire_workflows($workflows, $parent_type, $parent)
    {
        foreach ($workflows as $workflow) {
            if ($workflow->has_fired == 1) {
                continue;
            }
            if ($parent_type == 'Task')
            {
                if ($parent->status == $workflow->assign_when) {
                    $task = new Task;
                    $task->assigned_to_user_id = $workflow->assign_to;
                    $task->priority = $workflow->priority;
                    $task->name = $workflow->name;
                    $task->created_by_user_id = Auth::user()->id;
                    $task->assigned_by_user_id = Auth::user()->id;
                    
                    //WILL NEED TO CHANGE THIS STUFF AS THIS GETS MORE COMPLEX
                    $due_date = strtotime("+14 day");
                    $task->due_date = date('Y-m-d', $due_date);
                    $task->team_id = $workflow->team_id;
                    
                    //NOW CREATE THE NEW ITEM
                    $task->save();
                    $workflow->has_fired = 1;
                    $workflow->save();
                    
                }
            }
        }
    }

   
}