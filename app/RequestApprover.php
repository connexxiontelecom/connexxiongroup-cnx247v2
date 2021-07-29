<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

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

     public function setBy(){
         return $this->belongsTo(User::class, 'set_by');
     }

     public function getNormalApproversByRequesTypeAndDepartment($request_type){
			 return RequestApprover::select('user_id')
				 ->where('request_type', $request_type)
				 ->where('depart_id', Auth::user()->department_id)
				 ->where('tenant_id', Auth::user()->tenant_id)
				 ->get();
		 }
}
