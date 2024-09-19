<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale_item extends Model
{
    protected $fillable = ['sale_id', 'type', 'product_id', 'price', 'quantity', 'total_price', 'invoiced'];

    public function sale()
    {
      return $this->belongsTo('App\Models\Sale', 'sale_id');
    }
}
