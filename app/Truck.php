<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Trucks_Users_Day;

class Truck extends Model
{
    protected $fillable = ["name"];

    public function work_orders()
    {
      return $this->hasMany('App\Work_Order');
    }

    public function users_days()
    {
      return $this->belongsToMany('App\Trucks_Users_Day', 'trucks_users_days', 'truck_id', 'user_id')->withPivot('date');
    }

    public function user_by_date($date)
    {
      $tud = Trucks_Users_Day::where('truck_id', $this->id)->where('date', $date)->first();
      if ($tud) {
        return $tud->user_id;
      } else {
        return 0;
      }

    }
}
