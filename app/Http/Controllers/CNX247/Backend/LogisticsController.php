<?php

namespace App\Http\Controllers\CNX247\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Driver;
use App\Relationship;
use App\DriverEmergency;
use App\DriverNextOfKin;
use App\DriverGuarantor;
use App\LogisticsCustomer;
use App\LogisticsVehicle;
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
            $relationships = Relationship::orderBy('name', 'ASC')->get();
            return view('backend.logistics.driver-profile', ['driver'=>$driver, 'relationships'=>$relationships]);
        }else{
            session()->flash("error", "<strong>Ooops!</strong> No record found.");
            return redirect()->back();
        }
    }

    public function driverEmergencyContact(Request $request){
        $this->validate($request,[
            'full_name'=>'required',
            'email_address'=>'required',
            'mobile_no'=>'required',
            'address'=>'required',
            'relationship'=>'required'
        ]);

        $emergency = new DriverEmergency;
        $emergency->full_name = $request->full_name;
        $emergency->email = $request->email_address;
        $emergency->mobile_no = $request->mobile_no;
        $emergency->address = $request->address;
        $emergency->relationship = $request->relationship;
        $emergency->tenant_id = Auth::user()->tenant_id;
        $emergency->added_by = Auth::user()->id;
        $emergency->driver_id = $request->driver;
        $emergency->save();
        if($emergency){
            return response()->json(['message'=>'Success! New driver emergency contact saved.'],200);
        }else{
            return response()->json(['error'=>'Ooops! Could not register emergency contact.'],400);

        }
    }
    public function driverKinContact(Request $request){
        $this->validate($request,[
            'full_name'=>'required',
            'email_address'=>'required',
            'mobile_no'=>'required',
            'address'=>'required',
            'relationship'=>'required'
        ]);

        $kin = new DriverNextOfKin;
        $kin->full_name = $request->full_name;
        $kin->email = $request->email_address;
        $kin->mobile_no = $request->mobile_no;
        $kin->address = $request->address;
        $kin->relationship = $request->relationship;
        $kin->tenant_id = Auth::user()->tenant_id;
        $kin->added_by = Auth::user()->id;
        $kin->driver_id = $request->driver;
        $kin->save();
        if($kin){
            return response()->json(['message'=>'Success! New next of kin contact saved.'],200);
        }else{
            return response()->json(['error'=>'Ooops! Could not register next of kin.'],400);

        }
    }
    public function driverGuarantorContact(Request $request){
        $this->validate($request,[
            'full_name'=>'required',
            'email_address'=>'required',
            'mobile_no'=>'required',
            'address'=>'required',
            'relationship'=>'required'
        ]);

        $kin = new DriverGuarantor;
        $kin->full_name = $request->full_name;
        $kin->email = $request->email_address;
        $kin->mobile_no = $request->mobile_no;
        $kin->address = $request->address;
        $kin->relationship = $request->relationship;
        $kin->tenant_id = Auth::user()->tenant_id;
        $kin->added_by = Auth::user()->id;
        $kin->driver_id = $request->driver;
        $kin->save();
        if($kin){
            return response()->json(['message'=>'Success! New guarantor save.'],200);
        }else{
            return response()->json(['error'=>'Ooops! Could not register guarantor.'],400);

        }
    }

    public function customers(){
        return view('backend.logistics.customers');
    }
    public function storeCustomer(Request $request){
        $this->validate($request,[
            'full_name'=>'required',
            'email'=>'required|email',
            'mobile_no'=>'required',
            'address'=>'required',
            'gender'=>'required'
        ]);
        $password = substr(sha1(time()), 32,40);
        $customer = new LogisticsCustomer;
        $customer->full_name = $request->full_name;
        $customer->email = $request->email;
        $customer->mobile_no = $request->mobile_no;
        $customer->address = $request->address;
        $customer->gender = $request->gender;
        $customer->tenant_id = Auth::user()->tenant_id;
        $customer->added_by = Auth::user()->id;
        $customer->save();
        session()->flash("success", "<strong>Success!</strong> Customer registered.");
        return redirect()->route('logistics-customers');
    }

    public function vehicles(){
        return view('backend.logistics.vehicles');
    }
    public function newVehicle(){
        return view('backend.logistics.add-new-vehicle');
    }
    public function storeVehicle(Request $request){
        //return dd($request->all());
        $this->validate($request,[
            'chassis_no'=>'required',
            'registration_no'=>'required',
            'registration_date'=>'required',
            'engine_no'=>'required',
            'owner_name'=>'required',
            'maker_model'=>'required'
        ]);
        if(!empty($request->file('image'))){
            $extension = $request->file('image');
            $extension = $request->file('image')->getClientOriginalExtension();
            $size = $request->file('image')->getSize();
            $dir = 'assets/uploads/logistics/vehicles/';
            $filename = uniqid().'_'.time().'_'.date('Ymd').'.'.$extension;
            $request->file('image')->move(public_path($dir), $filename);
        }else{
            $filename = '';
        }
        $vehicle = new LogisticsVehicle;
        $vehicle->chassis_no = $request->chassis_no;
        $vehicle->registration_no = $request->registration_no;
        $vehicle->registration_date = $request->registration_date;
        $vehicle->engine_no = $request->engine_no;
        $vehicle->owner_name = $request->owner_name;
        $vehicle->make_model = $request->maker_model;
        $vehicle->tenant_id = Auth::user()->tenant_id;
        $vehicle->added_by = Auth::user()->id;
        $vehicle->image = $filename;
        $vehicle->slug = substr(sha1(time()), 23,40);
        $vehicle->save();
        session()->flash("success", "<strong>Success!</strong> New vehicle saved.");
        return redirect()->route('logistics-vehicles');
    }
    public function viewVehicle($slug){
        $vehicle = LogisticsVehicle::where('slug', $slug)->where('tenant_id', Auth::user()->tenant_id)->first();
        if(!empty($vehicle)){
            return view('backend.logistics.vehicle-details', ['vehicle'=>$vehicle]);
        }else{
            session()->flash("error", "<strong>Ooops!</strong> Vehicle not found.");
            return redirect()->route('logistics-vehicles');
        }
        return view('backend.logistics.add-new-customer');
    }
    public function newCustomer(){
        return view('backend.logistics.add-new-customer');
    }
    public function shipping(){
        return view('backend.logistics.shipping');
    }

    public function newShipping(){
        return view('backend.logistics.add-new-shipping');
    }
}
