<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Zip_Code_Area extends Model
{
    protected $table = 'ZipCodeAreas';
    protected $fillable = ['zip_code', 'area'];
    public $timestamps = False;

    public function customers()
    {
      $this->hasMany('App\Customer', 'zip_code', 'zip');
    }

    

}
