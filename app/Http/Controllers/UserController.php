<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Repositories\UserRepository;
use App\Repositories\TeamRepository;
use App\Repositories\RoleRepository;
use App\User;
use Auth;
use Illuminate\Support\Facades\Redirect;
use Hash;

class UserController extends Controller
{
  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function __construct(UserRepository $users, TeamRepository $teams, RoleRepository $roles)
  {
    $this->middleware('admin');
    $this->users = $users;
    $this->teams = $teams;
    $this->roles = $roles;
  }

  public function index(Request $request)
  {
    $users = $this->users->get_all_users();
    $teams = $this->teams->all();
    $team_options = array();
    foreach ($teams as $team)
    {
      $team_options[$team->id] =  $team->name;
    }
    return view('users.index', [
      'users' => $users,
      'team_options' => $team_options,
    ]);
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
    $user = new User;
    $this->validate($request, [
      'name' => 'required|max:255',
      'email' => 'required|email|max:255|unique:users',
      'password' => 'required|min:6',
//       'password' => 'required|confirmed|min:6',
    ]);

    $user->name = $request->name;
    $user->email = $request->email;
    $user->team_id = 1;
    $user->password = bcrypt($request->password);

    $user->save();

    return redirect('/user');
  }

  /**
  * Display the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function show($id)
  {
    $user = User::findOrFail($id);
    $roles = $this->roles->get_all_roles();

    return view('users.view',[
      'user' => $user,
      'roles' => $roles,
    ]);
  }

  public function test($id)
  {
    return User::findOrFail($id);
  }

  /**
  * Show the form for editing the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function edit($id)
  {
    $user = User::findOrFail($id);
    $this->authorize('edit', $user);
    return view('users.edit', ['user' => $user]);
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
    $user = User::findOrFail($id);
    $this->authorize('edit', $user);
    $this->validate($request, [
      'name' => 'required|max:255',
      'email' => 'required|email|max:255',
//       'current_password' => 'required|min:6',
      'password' => 'required|confirmed|min:6',
    ]);
    $user = User::findOrFail($id);
//     if (Hash::check($request->password, $request->password_confirmation))
//     {
    $user->name = $request->name;
    $user->email = $request->email;
    if ($request->has('password'))
    {
      $user->password = bcrypt($request->password);
    }
    $user->save();
    return Redirect::back();
//     }
//     else
//     {
//       return redirect('/access_denied');
//     }
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
    $user = User::findOrFail($id);
    $user->is_active = 0;
    $user->save();
    return Redirect::back();
  }

  public function update_roles(Request $request)
  {
    $user = User::findOrFail($request->user_id);
    $roles = $request->roles;
    $user->roles()->detach();
    if ($roles)
    {
      foreach($roles as $role)
      {
        $user->roles()->attach($role);
      }
    }


    return redirect('/user');
  }
}
