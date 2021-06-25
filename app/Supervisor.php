<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Supervisor extends Model
{
    //user-supervisor relationship
    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
    //department-supervisor relationship
    public function department(){
        return $this->belongsTo(Department::class, 'department_id');
    }


    /*
     * Use-case methods
     */

	public function getAllSupervisors(){
		return Supervisor::where('tenant_id', Auth::user()->tenant_id)->get();
	}

	public function setNewSupervisor(Request $request){
		$supervisor = new Supervisor();
		$supervisor->department_id = $request->department;
		$supervisor->user_id = $request->supervisor;
		$supervisor->tenant_id = Auth::user()->tenant_id;
		$supervisor->save();
	}
	public function updateSupervisor(Request $request){
		$supervisor = Supervisor::where('tenant_id', Auth::user()->tenant_id)->where('user_id', $request->supervisor_id)->first();
		$supervisor->department_id = $request->department;
		$supervisor->user_id = $request->supervisor;
		$supervisor->save();
	}

}
