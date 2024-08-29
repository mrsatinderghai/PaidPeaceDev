<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Work_Order_Product extends Model
{
  protected $table = 'work_order_product';
  protected $fillable = ['sale_price', 'tax', 'line_cost', 'quantity'];

  public function work_order()
  {
    return $this->belongsTo('App\Work_Order');
  }

  public function product()
  {
    return $this->belongsTo('App\Product');
  }
}
