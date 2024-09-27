<?php

namespace App\Models;
use Illuminate\Support\Arr;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;



use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasRoles;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','name', 'email', 'password', 'team_id', 'is_admin'
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
        return $this->hasMany('App\Models\Task', 'assigned_to_user_id', 'id');
    }

    public function created_tasks()
    {
        return $this->hasMany('App\Models\Task', 'created_by_user_id', 'id');
    }

    public function get_name($id)
    {
        return $this->name;
    }

    public function team() {
        return $this->belongsTo('App\Models\Team', 'team_id');
    }

    public function notes()
    {
        return $this->hasMany('App\Models\Note', 'user_id', 'id');
    }

    public function roles()
    {
      return $this->belongsToMany('App\Models\Role', 'user_roles');
    }

    public function has_role($role)
    {
      return in_array($role, Arr::except($this->roles->toArray(), 'name'));
    }

    public function trucks_days()
    {
      return $this->belongsToMany('App\Models\Trucks_Users_Day', 'trucks_users_days', 'user_id', 'truck_id')->withPivot('date');
    }

    public function isAdmin() 
    {
       return in_array(1, $this->roles()->pluck('role_id')->all());
    }

}
