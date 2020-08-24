<?php

namespace App\Http\Controllers\CNX247\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GeneralRequestController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /*
    * General request index page
    */
    public function index(){
        return view('backend.workflow.general.general-request');
    }
}
