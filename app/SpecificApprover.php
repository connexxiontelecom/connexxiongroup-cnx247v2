<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
}
