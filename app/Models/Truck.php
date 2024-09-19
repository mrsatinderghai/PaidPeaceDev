<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Trucks_Users_Day;

class Truck extends Model
{
    protected $fillable = ["name"];

    public function work_orders()
    {
      return $this->hasMany('App\Models\Work_Order');
    }

    public function users_days()
    {
      return $this->belongsToMany('App\Models\Trucks_Users_Day', 'trucks_users_days', 'truck_id', 'user_id')->withPivot('date');
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
