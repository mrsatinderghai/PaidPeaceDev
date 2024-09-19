<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = ['sale_id', 'team_id', 'amount', 'status', 'company_id', 'work_order_id'];

    public function sale()
    {
    	return $this->belongsTo('App\Models\Sale', 'sale_id');
    }

    public function work_order()
    {
      return $this->belongsTo('App\Models\Work_Order');
    }

    public function transactions()
    {
      return $this->hasMany('App\Models\Transaction');
    }
}
