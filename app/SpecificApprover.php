<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
class SpecificApprover extends Model
{
    //

	public function getFrom(){
		return $this->belongsTo(User::class, 'requester_id');
	}

	public function getTo(){
		return $this->belongsTo(User::class, 'processor_id');
	}
	public function getSetBy(){
		return $this->belongsTo(User::class, 'set_by');
	}

	/*
	 * Use-case methods
	 */
	public function getSpecificApproversByRequesterId($request_type){
		return SpecificApprover::where('request_type', $request_type)
			->where('requester_id', Auth::user()->id)
			->where('tenant_id', Auth::user()->tenant_id)
			->get();
	}
}
