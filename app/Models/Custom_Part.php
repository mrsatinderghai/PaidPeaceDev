<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Custom_Part extends Model
{
    protected $table = "custom_parts";
    protected $fillable = ['work_order_id', 'quantity', 'sale_price', 'line_cost', 'tax', 'name'];

    public function work_order()
    {
      return $this->belongsTo('App\Models\Work_Order', 'work_order_id', 'id');
    }
}
