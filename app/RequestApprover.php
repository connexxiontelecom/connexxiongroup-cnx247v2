<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequestApprover extends Model
{
    /*
    * 
    */
    public function processor(){
        return $this->belongsTo(User::class, 'user_id');
     }

     public function department(){
         return $this->belongsTo(Department::class, 'depart_id');
     }
}
