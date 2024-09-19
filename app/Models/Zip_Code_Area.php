<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Zip_Code_Area extends Model
{
    protected $table = 'zipcodeareas';
    protected $fillable = ['zip_code', 'area'];
    public $timestamps = False;

    public function customers()
    {
      $this->hasMany('App\Models\Customer', 'zip_code', 'zip');
    }

    

}
