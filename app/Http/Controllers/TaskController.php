<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Task;
use App\Team;
use App\User;
use App\Note;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\TaskRepository;
use App\Repositories\NoteRepository;
use App\Repositories\WorkflowRepository;
use Illuminate\Support\Facades\Redirect;
use Session;
use Mail;
use Auth;


class TaskController extends Controller
{

    /** The task repository instance:
    *
    * @var TaskRepository
    */
    protected $tasks, $notes;
    /**
    * Instantiate a new TasksController instance.
    *
    * @return void
    */

    public function __construct(TaskRepository $tasks, NoteRepository $notes, WorkflowRepository $workflows)
    {
        $this->middleware('auth');

        $this->tasks = $tasks;
        $this->notes = $notes;
        $this->workflows = $workflows;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request->session()->put('return_url', $request->path());
        $team_members = $request->user()->team->members;
        $team_member_options = array();

        foreach($team_members as $member) {
            $team_member_options[$member->id] = $member->name;
        }

        return view('tasks.index', [
            'tasks' => $this->tasks->assigned_to_user($request->user()),
            'team_tasks' => $this->tasks->team_tasks(),
            'hot_tasks' => $this->tasks->due_in_days(7),
            'team_members' => $team_member_options,
            'title' => 'My Tasks'
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $team_members = $request->user()->team->members;
        $team_member_options = array();

        foreach($team_members as $member) {
            $team_member_options[$member->id] = $member->name;
        } 
        return view('tasks.add', [
            'tasks' => $this->tasks->assigned_to_user($request->user()),
            'team_tasks' => $this->tasks->team_tasks(),
            'hot_tasks' => $this->tasks->due_in_days(7),
            'team_members' => $team_member_options,
            'title' => 'My Tasks'
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255'
        ]);

        $new_task = new Task;

        if ($request->has('parent_id'))
        {

            $new_task->parent_id = $request->parent_id;
            $new_task->parent_type = $request->parent_type;
        }

        $new_task->name = $request->name;
        $new_task->created_by_user_id = $request->user()->id;
        $new_task->assigned_to_user_id = $request->assigned_to_user_id;
        $new_task->assigned_at = date("Y-m-d H:i:s", time());
        $new_task->due_date = $request->due_date;
        $new_task->priority = $request->priority;
        $new_task->status = 'Pending';
        $new_task->team_id = $request->user()->team_id;

        $new_task->save();

        $user = User::findOrFail($request->assigned_to_user_id);


        // Mail::send('emails.update', ['item' => $new_task, 'notes' => array()], function ($m) use ($user, $new_task) {

        //     $m->from('noreply@jexly.net', 'Jexly');

        //     $m->to($user->email, $user->name)->subject('Jexly - New Task - '.$new_task->name);
        // });

        // return Redirect::back();
        return redirect('task');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $task = Task::findOrFail($id);
        $user = User::findOrFail($task->assigned_to_user_id);
        $notes = $this->notes->get_notes($id, 'Task');
        $subtasks = $this->tasks->sub_tasks($id, 'Task');
        $workflows = $this->workflows->get_workflows($id, 'Task');

        $team_members = $user->team->members;
        $team_member_options = array();

        foreach($team_members as $member) {
            $team_member_options[$member->id] = $member->name;
        }

        return view('tasks.edit',[
            'task' => $task,
            'team_members' => $team_member_options,
            'notes' => $notes,
            'subtasks' => $subtasks,
            'parent' => $task,
            'parent_type' => 'Task',
            'workflows' => $workflows,
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|max:255'
        ]);

        $task = Task::findOrFail($id);

        $task->name = $request->name;
        $task->assigned_to_user_id = $request->assigned_to_user_id;
        $task->assigned_by_user_id = $request->user()->id;
        $task->assigned_at = date("Y-m-d H:i:s", time());
        $task->due_date = $request->due_date;
        $task->priority = $request->priority;
        $task->status = $request->status;

        if ( $request->completed )
        {
            $task->completed = 1;
            $task->completed_at = date("Y-m-d H:i:s", time());
            $task->status = 'Completed';
        }

        $task->save();

        $workflows = $this->workflows->get_workflows($id, 'Task');

        if ($workflows)
        {
            $this->workflows->fire_workflows($workflows, 'Task', $task);
        }

        if ($request->send_update)
        {
            $user = Auth::user();
            $team_members = $user->team->members;
            $to = array();
            foreach ($team_members as $member)
            {
                array_push($to, $member->email);
            }

            $notes = $this->notes->get_notes($id, 'Task');

            $task->assigned_to_name = User::findOrFail($task->assigned_to_user_id)->name;

            Mail::send('emails.update',
                    [
                        'item' => $task,
                        'notes' => $notes,
                    ],
                    function ($m) use ($to, $task) {
                        $m->from('noreply@jexly.net', 'Jexly');

                        $m->to($to)->subject('Jexly - '.$task->name. ' - '.$task->status);
                    });
        }

        return redirect($request->session()->get('return_url'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Task $task)
    {
        $this->authorize('destroy', $task);
        $task->delete();
        return Redirect::back();
    }

    public function project(Request $request)
    {
        return view('tasks.project', [
            'tasks' => $this->tasks->project_view(),
            'title' => 'Project View',
            ]);
    }

    public function team(Request $request)
    {
        $team_members = $request->user()->team->members;
        $team_member_options = array();

        foreach($team_members as $member) {
            $team_member_options[$member->id] = $member->name;
        }

        return view('tasks.index', [
            'tasks' => $this->tasks->team_tasks(),
            'team_members' => $team_member_options,
            'title' => 'Team Tasks',
            ]);
    }

    public function hot(Request $request)
    {
      $team_members = $request->user()->team->members;
      $team_member_options = array();

      foreach($team_members as $member) {
          $team_member_options[$member->id] = $member->name;
      }

      return view('tasks.index', [
          'tasks' => $this->tasks->due_in_days(7),
          'team_members' => $team_member_options,
          'title' => 'Hot Tasks',
          ]);
    }


}
