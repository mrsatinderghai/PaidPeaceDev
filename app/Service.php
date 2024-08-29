<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
  protected $fillable = ['description', 'category', 'cost', 'sell_price', 'team_id'];

  public function team()
  {
    return $this->belongsTo('App\Team', 'team_id');
  }

  public function work_orders()
  {
    return $this->belongsToMany('App\Work_Order', 'work_order_service', 'service_id', 'work_order_id')->withPivot('quantity', 'labor_hours', 'sale_price', 'line_cost');
  }
}
