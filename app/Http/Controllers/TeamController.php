<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\TeamRepository;
use App\Team;

class TeamController extends Controller
{

    /** The team repository instance:
    *
    * @var TeamRepository
    */
    protected $teams;


    public function __construct(TeamRepository $teams)
    {
        $this->middleware('admin');
        $this->teams = $teams;

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        return view('teams.index', ['teams' => Team::all()]);
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

        $team = new Team;
        $team->name = $request->name;

        if ($request->hasFile('logo'))
        {
          $extension = $request->file('logo')->getClientOriginalExtension();
          $file_name = uniqid().'.'.$extension;
          $file_path = public_path().'/img/team_logos';
          $request->file('logo')->move($file_path, $file_name);
          $team->logo = 'img/team_logos/'.$file_name;

        }

        $team->save();

        return redirect('/team');


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $team = Team::findOrFail($id);

        return view('teams.view', [
          'team' => $team,
          'team_members' => $team->members,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $team = Team::findOrFail($id);

        return view('teams.edit', ['team' => $team]);
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

      $team = Team::findOrFail($id);
      $team->name = $request->name;
      $team->address1 = $request->address1;
      $team->address2 = $request->address2;
      $team->city  = $request->city;
      $team->state = $request->state;
      $team->zip = $request->zip;
      $team->phone = $request->phone;
      if ($request->hasFile('logo'))
      {
        $extension = $request->file('logo')->getClientOriginalExtension();
        $file_name = uniqid().'.'.$extension;
        $file_path = public_path().'/img/team_logos';
        $request->file('logo')->move($file_path, $file_name);
        $team->logo = 'img/team_logos/'.$file_name;
      }



      $team->save();

      return redirect('team/'.$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
