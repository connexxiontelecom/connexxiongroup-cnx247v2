<?php

namespace App;

use App\Department as DepartmentModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Department extends Model
{
    //

	public function setNewDepartmentName(Request $request){
		$depart = new DepartmentModel;
		$depart->department_name = $request->department;
		$depart->tenant_id = Auth::user()->tenant_id;
		$depart->save();
	}

	public function updateDepartmentName(Request $request){
		$depart = DepartmentModel::where('tenant_id', Auth::user()->tenant_id)->where('id', $request->department_id)->first();
		$depart->department_name = $request->department;
		$depart->tenant_id = Auth::user()->tenant_id;
		$depart->save();
	}

	public function getAllDepartments(){
		return DepartmentModel::where('tenant_id', Auth::user()->tenant_id)->orderBy('department_name', 'ASC')->get();
	}
}
