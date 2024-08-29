<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Work_Order_Service extends Model
{
  protected $table = 'work_order_service';
  protected $fillable = ['labor_hours', 'sale_price', 'line_cost', 'quantity'];

  public function work_order()
  {
    return $this->belongsTo('App\Work_Order');
  }

  public function service()
  {
    return $this->belongsTo('App\Service');
  }
}
