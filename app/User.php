<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','name', 'email', 'password', 'team_id'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function assigned_tasks()
    {
        return $this->hasMany('App\Task', 'assigned_to_user_id', 'id');
    }

    public function created_tasks()
    {
        return $this->hasMany('App\Task', 'created_by_user_id', 'id');
    }

    public function get_name($id)
    {
        return $this->name;
    }

    public function team() {
        return $this->belongsTo('App\Team', 'team_id');
    }

    public function notes()
    {
        return $this->hasMany('App\Note', 'user_id', 'id');
    }

    public function roles()
    {
      return $this->belongsToMany('App\Role', 'user_roles');
    }

    public function has_role($role)
    {
      return in_array($role, array_pluck($this->roles->toArray(), 'name'));
    }

    public function trucks_days()
    {
      return $this->belongsToMany('App\Trucks_Users_Day', 'trucks_users_days', 'user_id', 'truck_id')->withPivot('date');
    }

    public function isAdmin() 
    {
       return in_array(1, $this->roles()->pluck('role_id')->all());
    }

}
