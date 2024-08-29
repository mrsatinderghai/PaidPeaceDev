<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Custom_Service extends Model
{
  protected $table = "custom_services";
  protected $fillable = ['work_order_id', 'quantity', 'sale_price', 'line_cost', 'name'];

  public function work_order()
  {
    return $this->belongsTo('App\Work_Order', 'work_order_id', 'id');
  }
}
