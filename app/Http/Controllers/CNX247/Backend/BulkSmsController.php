<?php

namespace App\Http\Controllers\CNX247\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Client;
use App\BulkSms;
use App\PhoneGroup;
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

    public function create(){
        return view('backend.crm.bulk-sms.compose');
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
    public function phoneGroups()
    {
        $groups = PhoneGroup::where('tenant_id', Auth::user()->tenant_id)->get();
        return view('backend.crm.bulk-sms.phone-groups', ['groups'=>$groups]);
    }
    public function storePhoneGroup(Request $request)
    {
        $this->validate($request,[
            'phone_group_name'=>'required',
            'phone_numbers'=>'required'
        ]);
        $phone_numbers = preg_split("/,\s*/",$request->phone_numbers); 
        $unique = array_unique($phone_numbers);
        $group = new PhoneGroup;
        $group->phone_group_name = $request->phone_group_name;
        $group->phone_numbers = implode(', ', $unique);
        $group->tenant_id = Auth::user()->tenant_id;
        $group->added_by = Auth::user()->id;
        $group->slug = substr(sha1(time()), 12,40);
        $group->save();
        session()->flash("success", "<strong>Success!</strong> Phone group created.");
        return redirect()->route('phone-groups');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showPhoneGroup($slug)
    {
        $group = PhoneGroup::where('tenant_id', Auth::user()->tenant_id)->where('slug', $slug)->first();
        if(!empty($group)){
            return view('backend.crm.bulk-sms.view-phone-group', ['group'=>$group]);
        }
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
