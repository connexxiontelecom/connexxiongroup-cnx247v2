<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConfirmationLog extends Model
{
    //

	public function getUser(){
		return $this->belongsTo(User::class, 'user_id');
	}

	public function getIssuedBy(){
		return $this->belongsTo(User::class, 'issued_by');
	}


	/*
	 * Use
	 */

	public function setNewConfirmation(Request $request){
		$confirmation = new ConfirmationLog();
		$confirmation->tenant_id = Auth::user()->tenant_id;
		$confirmation->user_id = $request->user;
		$confirmation->issued_by = Auth::user()->id;
		$confirmation->date_issued = now();
		$confirmation->confirmation_date = $request->confirmation_date;
		$confirmation->effective_date = $request->effective_date;
		$confirmation->position = $request->position;
		$confirmation->description = $request->description;
		$confirmation->slug = substr(sha1(time()),23,40);
		$confirmation->save();
		return $confirmation;
	}

	public function getAllConfirmationRequests(){
		return ConfirmationLog::orderBy('id', 'DESC')->get();
	}

	public function updateConfirmationStatus(Request $request, $confirmation_id){
		$confirmation = ConfirmationLog::find($confirmation_id);
		$confirmation->status = $request->status == 'approved' ? 1 : 2;
		$confirmation->save();
	}

	public function getConfirmationLogBySlug($slug){
		return ConfirmationLog::where('slug', $slug)->first();
	}
}
