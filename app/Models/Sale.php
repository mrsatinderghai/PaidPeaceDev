<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    public function company()
    {
    	return $this->belongsTo('App\Models\Company', 'company_id');
    }

    public function contact()
    {
    	return $this->belongsTo('App\Models\Contact', 'contact_id');
    }

    public function invoices()
    {
    	return $this->hasMany('App\Models\Invoice', 'sale_id');
    }

    public function assigned_to()
    {
      return $this->belongsTo('App\Models\User', 'assigned_to_user_id');
    }

    public function status_options()
    {
      return array(
        'Pending' => 'Pending',
        'Awaiting Customer Response' => 'Awaiting Customer Response',
        'Proposal' => 'Proposal',
        'Accepted' => 'Accepted',
        'Rejected' => 'Rejected',
      );
    }
}
