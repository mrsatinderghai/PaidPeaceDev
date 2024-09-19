<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['description', 'category', 'cost', 'sell_price', 'team_id', 'on_hand', 'on_order'];

    public function team()
    {
    	$this->belongsTo('App\Models\Team', 'team_id');
    }

    public function work_orders()
    {
      return $this->belongsToMany('App\Models\Work_Order', 'work_order_service', 'product_id', 'work_order_id')->withPivot('tax', 'sale_price', 'line_cost', 'quantity');
    }
}
