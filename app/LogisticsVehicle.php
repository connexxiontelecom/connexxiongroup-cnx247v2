<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LogisticsVehicle extends Model
{
    //
    public function addedBy(){
        return $this->belongsTo(User::class, 'added_by');
    }
}
