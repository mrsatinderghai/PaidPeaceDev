<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trucks_Users_Day extends Model
{
    protected $fillable = ['user_id', 'truck_id', 'date'];
    protected $table = 'trucks_users_days';

    public function truck()
    {
      return $this->belongsTo('App\Truck');
    }

    public function user()
    {
      return $this->belongsTo('App\User');
    }

    public function is_blocked()
    {
      return $this->user_id == -1;
    }

}
