<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale_item extends Model
{
    protected $fillable = ['sale_id', 'type', 'product_id', 'price', 'quantity', 'total_price', 'invoiced'];

    public function sale()
    {
      return $this->belongsTo('App\Sale', 'sale_id');
    }
}
