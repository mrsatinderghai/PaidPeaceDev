<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trucks_Users_Day extends Model
{
    protected $fillable = ['user_id', 'truck_id', 'date'];
    protected $table = 'trucks_users_days';

    public function truck()
    {
      return $this->belongsTo('App\Models\Truck');
    }

    public function user()
    {
      return $this->belongsTo('App\Models\User');
    }

    public function is_blocked()
    {
      return $this->user_id == -1;
    }

}
