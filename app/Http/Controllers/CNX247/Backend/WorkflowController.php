<?php

namespace App\Http\Controllers\CNX247\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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

/*     public function statistics(){
        return view('backend.workflow.statistics');
    } */
}
