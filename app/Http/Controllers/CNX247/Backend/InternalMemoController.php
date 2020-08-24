<?php

namespace App\Http\Controllers\CNX247\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InternalMemoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /*
    * Get list of all employees
    */
    public function index(){
        return view('backend.workflow.memo.internal-memo');
    }
}
