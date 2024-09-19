<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Time_Slot_Lock extends Model
{
    protected $table = 'time_slot_locks';

    protected $fillable = ['date', 'time_slot', 'is_locked', 'truck_id'];

}
