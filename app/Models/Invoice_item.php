<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice_item extends Model
{
  protected $fillable = ['invoice_id', 'sale_item_id', 'type', 'product_id', 'price', 'quantity', 'total_price'];

  public function invoice()
  {
    return $this->belongsTo('App\Models\Invoice');
  }

  public function sale_item()
  {
    return $this->belongsTo('App\Models\Sale_item');
  }

}
