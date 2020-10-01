<?php

namespace App\Http\Controllers\CNX247\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Driver;
use Auth;

class LogisticsController extends Controller
{
    //
    public function __construct(){
        $this->middleware('auth');
    }

    public function drivers(){
        return view('backend.logistics.drivers');
    }

    public function addNewDriver(){
        return view('backend.logistics.add-new-driver');
    }

    public function storeDriver(Request $request){
        //return dd($request->all());
        $this->validate($request,[
            'first_name'=>'required',
            'surname'=>'required',
            'mobile_no'=>'required',
            'email'=>'required|email|unique:drivers,email',
            'gender'=>'required',
            'driver_no'=>'required',
            'means_of_identification'=>'required',
            'moi_attachment'=>'required'
            ]);
            
        if(!empty($request->file('moi_attachment'))){
            $extension = $request->file('moi_attachment');
            $extension = $request->file('moi_attachment')->getClientOriginalExtension();
            $size = $request->file('moi_attachment')->getSize();
            $dir = 'assets/uploads/logistics/';
            $filename = uniqid().'_'.time().'_'.date('Ymd').'.'.$extension;
            $request->file('moi_attachment')->move(public_path($dir), $filename);
        }else{
            $filename = '';
        }
        $password = substr(sha1(time()),32,40);
        $driver = new Driver;
        $driver->first_name = $request->first_name;
        $driver->registered_by = Auth::user()->id;
        $driver->tenant_id = Auth::user()->tenant_id;
        $driver->surname = $request->surname;
        $driver->mobile_no = $request->mobile_no;
        $driver->email = $request->email;
        $driver->gender = $request->gender;
        $driver->driver_id = $request->driver_no;
        $driver->type_of_identification = $request->means_of_identification;
        $driver->attachment = $filename;
        $driver->url = substr(sha1(time()), 21,40);
        $driver->password = bcrypt($password);
        $driver->save();
        session()->flash("success", "<strong>Success!</strong> New driver registered.");
        return redirect()->route('logistics-drivers');
    }

    public function driverProfile($url){
        $driver = Driver::where('url', $url)->where('tenant_id', Auth::user()->tenant_id)->first();
        if(!empty($driver)){
            return view('backend.logistics.driver-profile', ['driver'=>$driver]);
        }else{
            session()->flash("error", "<strong>Ooops!</strong> No record found.");
            return redirect()->back();
        }
    }

    public function driverEmergencyContact(Request $request){
        $this->validate($request,[
            'full_name'=>'required',
            'email'=>'required',
            'mobile_no'=>'required',
            'address'=>'required',
            'relationship'=>'required'
        ]);
    }
}
