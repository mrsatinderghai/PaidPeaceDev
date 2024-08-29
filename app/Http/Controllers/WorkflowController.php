<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Redirect;

use App\Workflow;
use App\Repositories\WorkflowRepository;

class WorkflowController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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

        $workflow = new Workflow;

        $workflow->name = $request->name;
        $workflow->assign_type = $request->assign_type;
        $workflow->assign_to = $request->assign_to;
        $workflow->assign_when = $request->assign_when;
        $workflow->priority = $request->priority;
        $workflow->due_date = $request->due_date;
        $workflow->parent_type = $request->parent_type;
        $workflow->parent_id = $request->parent_id;
        $workflow->team_id = $request->user()->team_id;
        $workflow->has_fired = 0;

        $workflow->save();

        return Redirect::back();
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Workflow $workflow)
    {
        $this->authorize('destroy', $workflow);
        $workflow->delete();
        return Redirect::back();
    }
}
