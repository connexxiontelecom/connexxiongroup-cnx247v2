<?php

namespace App\Http\Controllers\CNX247\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\PurchaseOrder;
use App\PurchaseOrderDetail;
use Auth;
class ProcurementController extends Controller
{
    //
    public function __construct(){
        $this->middleware('auth:supplier');
    }

    public function myAccount(){
        return view('frontend.procurement.supplier.my-account');
    }
    public function myPurchaseOrders(){
        return view('frontend.procurement.supplier.purchase-orders');
    }

    public function viewMyPurchaseOrders($slug){
        $order = PurchaseOrder::where('slug', $slug)->first();
        if(!empty($order) ){
            $items = PurchaseOrderDetail::where('po_id', $order->id)
                                        ->get();
            return view('frontend.procurement.supplier.view-purchase-order', ['order'=>$order, 'items'=>$items]);
        }else{
            return back();
        }
    }

    public function takeAction(Request $request){
        $this->validate($request,[
            'order'=>'required',
            'status'=>'required'
        ]);
        if($request->status == 'delivered'){
            $order = PurchaseOrder::find($request->order);
            $order->status = $request->status;
            $order->date_delivered = now();
            $order->save();
            return response()->json(['message'=>'Success! Purchase order '.$request->status], 200);
        }else{
            $order = PurchaseOrder::find($request->order);
            $order->status = $request->status;
            $order->save();
            return response()->json(['message'=>'Success! Purchase order '.$request->status], 200);
        }
    }

    public function settings(){
        return view('frontend.procurement.supplier.settings');
    }
}
