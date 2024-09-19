<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Date_Note extends Model
{
    protected $fillable = ['date', 'notes'];

    protected $table = 'date_notes';

}
