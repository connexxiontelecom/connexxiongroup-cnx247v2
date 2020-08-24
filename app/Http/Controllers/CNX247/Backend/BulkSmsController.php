<?php

namespace App\Http\Controllers\CNX247\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Client;
use App\BulkSms;
use Auth;

class BulkSmsController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sms = BulkSms::where('tenant_id', Auth::user()->tenant_id)->orderBy('id', 'DESC')->get();
        $clients = Client::where('tenant_id', Auth::user()->tenant_id)->orderBy('first_name', 'ASC')->get();
        return view('backend.crm.bulk-sms.index', ['clients'=>$clients, 'sms'=>$sms]);
    }

    /*
    * Process SMS
    */
    public function processSMS(Request $request){
        $this->validate($request,[
            'mobileNumbers'=>'required',
            'message'=>'required'
            ]);
            $numbers = preg_split ("/\,/", $request->mobileNumbers);  
            for($i=0; $i<count($numbers); $i++){
                $sms = new BulkSms;
                $sms->tenant_id = Auth::user()->tenant_id;
                $sms->mobile_no = $numbers[$i];
                $sms->message = $request->message;
                $sms->status = 0; //pending
                $sms->save();
            }
        return response()->json(['message'=>'Success! SMS scheduled.']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
