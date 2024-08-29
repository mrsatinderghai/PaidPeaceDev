<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{

	protected $fillable = ['amount', 'type', 'team_id', 'other_party', 'tender', 'invoice_id', 'paid_with_detail'];

    public function invoice()
    {
    	return $this->belongsTo('App\Invoice', 'invoice_id');
    }

    public function team()
    {
    	return $this->belongsTo('App\Team', 'team_id');
    }
}
