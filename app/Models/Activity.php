<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
  protected $fillable = ['parent_id', 'parent_type', 'user_id', 'type', 'detail'];

  public function owner()
  {
    return $this->belongsTo('App\Models\User', 'user_id');
  }

  public function types()
  {
    return array(
      'Phone Call' => 'Phone Call',
      'Meeting' => 'Meeting',
      'Email' => 'Email',
    );
  }

}
