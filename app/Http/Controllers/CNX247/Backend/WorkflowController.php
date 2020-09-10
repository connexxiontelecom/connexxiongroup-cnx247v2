<?php

namespace App\Http\Controllers\CNX247\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\RequestApprover;
use App\Department;
use App\User;
use Auth;

class WorkflowController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /*
    * Load index page [my assignments]
    */
    public function index(){
        return view('backend.workflow.index');
    }

    /*
    * Workflow task
    */
    public function viewWorkflowTask($url){
        return view('backend.workflow.view');
    }

    public function businessProcess(){
        $approvers = RequestApprover::where('tenant_id',Auth::user()->tenant_id)->get();
        $departments = Department::where('tenant_id',Auth::user()->tenant_id)->get();
        $employees = User::where('tenant_id',Auth::user()->tenant_id)->get();
        return view('backend.workflow.business-process',
        ['approvers'=>$approvers,
        'departments'=>$departments,
        'employees'=>$employees
        ]);
    }
    public function setBusinessProcess(Request $request){
        $this->validate($request,[
            'department'=>'required',
            'processor'=>'required',
            'request_type'=>'required'
        ]);
        $p = new RequestApprover;
        $p->user_id =  $request->processor;
        $p->request_type =  $request->request_type;
        $p->depart_id =  $request->department;
        $p->set_by =  Auth::user()->id;
        $p->approver_stage =  'undefined';
        $p->tenant_id =  Auth::user()->tenant_id;
        $p->save();
        if($p){
            return response()->json(['message'=>'Success! New request processor set.'],200);
        }else{
            return response()->json(['message'=>'Ooops! We could not registere new processor'],400);
        }
    }

}
