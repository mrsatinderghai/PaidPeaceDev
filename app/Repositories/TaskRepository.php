<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\Task;
use App\Models\Sale;
use Auth;

class TaskRepository
{
  /**
  * Get all of the tasks for a given user.
  *
  * @param  User  $user
  * @return Collection
  */
  public function assigned_to_user(User $user)
  {
    return Task::where('assigned_to_user_id', $user->id)
    ->where('status', '<>', 'Completed')
    ->orderBy('created_at', 'asc')
    ->get();
  }

  public function sub_tasks($id, $parent_type)
  {
    return Task::where(['parent_id' => $id, 'parent_type' => $parent_type])
    ->where('completed', 0)
    ->orderBy('due_date', 'asc')
    ->get();
  }

  public function project_view()
  {
    /*
    *
    *  This needs to be re-worked and re-thought...is it even needed?
    *  If so, how?  Continue the way below, or start to grab tasks with no parent or with parent <> task and then take subtasks of them?
    *
    */
    $team_id = Auth::user()->team_id;
    $tasks = Task::where('team_id', $team_id)
    ->orderBy('due_date', 'asc')
    ->get();

    $project_view = array();

    foreach($tasks as &$task)
    {
      $task->subtasks = array();
      if (is_null($task->parent_id) OR $task->parent_id == 0)
      {
        $project_view['t'.$task->id] = $task;
        continue;
      }

      if ($task->parent_type == 'Task')
      {
        if (! array_key_exists('t'.$task->parent_id, $project_view))
        {
          $project_view['t'.$task->parent_id] = $task;
        }
        else
        {
          $project_view['t'.$task->parent_id]->subtasks[] = $task;
        }
      }
      else if ($task->parent_type == 'Sale')
      {
        if (! array_key_exists('s'.$task->parent_id, $project_view))
        {
          $project_view['s'.$task->parent_id] = Sale::findOrFail($task->parent_id);
        }
        else
        {
          array_push($project_view['s'.$task->parent_id]->subtasks, $task);
        }
      }
    }

    return $project_view;
  }

  public function team_tasks()
  {
    $team_id = Auth::user()->team_id;
    return Task::where('team_id', $team_id)
    ->where('completed', '0')
    ->orderBy('due_date', 'asc')
    ->get();
  }

  public function due_in_days($num_days)
  {
    $today = new \DateTime();
    return Task::where('assigned_to_user_id', Auth::user()->id)
    ->where('completed', 0)
    ->where('due_date', '<', $today->modify('+7 days'))
    ->orWhere(function($query)
    {
      $query->where('priority', 'Emergency')
      ->where('completed', 0);
    })
    ->orderBy('due_date', 'asc')
    ->get();

  }


}
