<?php

namespace App\Http\Controllers\CNX247\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Supplier;
use App\Industry;
use App\PurchaseOrderDetail;
use App\PurchaseOrder;
use Auth;

class SupplierController extends Controller
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
        $suppliers = Supplier::where('tenant_id', Auth::user()->tenant_id)->orderBy('id', 'DESC')->get();
        return view('backend.procurement.supplier.index', ['suppliers'=>$suppliers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $industries = Industry::orderBy('industry', 'ASC')->get();
        return view('backend.procurement.supplier.create',['industries'=>$industries]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'company_name'=>'required',
            'company_email' =>'required',
            'company_phone' =>'required',
            'company_address' =>'required',
            'industry' =>'required',
            'first_name' =>'required',
            'email_address' =>'required',
            'mobile_no' =>'required'
        ]);
        Supplier::create(array_merge($request->all(),
        [
        'added_by'=>Auth::user()->id,
        'tenant_id'=>Auth::user()->tenant_id,
        'slug'=>substr(sha1(time()), 26,40)
        ]));
        session()->flash("success", "<strong>Success!</strong> New supplier registered.");
        return redirect()->route('suppliers');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function view($slug)
    {
        $supplier = Supplier::where('tenant_id', Auth::user()->tenant_id)->where('slug', $slug)->first();
        if(!empty($supplier) ){
            return view('backend.procurement.supplier.view', ['supplier'=>$supplier]);
        }else{
            return redirect()->route('404');
        }
    }

    public function purchaseOrder($slug){
        $supplier = Supplier::where('tenant_id', Auth::user()->tenant_id)->where('slug', $slug)->first();
        $po = PurchaseOrder::where('tenant_id', Auth::user()->tenant_id)->first();
        $poNumber = null;
        if(!empty($po) ){
            $poNumber = $po->purchase_order_no + 1;
        }else{
            $poNumber = 100000;
        }
        if(!empty($supplier) ){
            return view('backend.procurement.supplier.new-purchase-order', ['supplier'=>$supplier, 'poNumber'=>$poNumber]);
        }else{
            return redirect()->route('404');
        }
    }

    public function storePurchaseOrder(Request $request){
        //return dd($request->all());
        $this->validate($request,[
            'purchase_order_no'=>'required',
            'issue_date'=>'required',
            'supplier'=>'required',
            'totalAmount'=>'required'
        ]);
        $purchaseOrder = new PurchaseOrder;
        $purchaseOrder->purchase_order_no = $request->purchase_order_no;
        $purchaseOrder->requested_by = Auth::user()->id;
        $purchaseOrder->tenant_id = Auth::user()->tenant_id;
        $purchaseOrder->supplier_id = $request->supplier;
        $purchaseOrder->total = $request->totalAmount;
        $purchaseOrder->instruction = $request->instruction;
        $purchaseOrder->slug = substr(sha1(time()), 21,40);
        $purchaseOrder->save();
        $poId = $purchaseOrder->id;
        for($i = 0; $i<count($request->item_name); $i++){
            $item = new PurchaseOrderDetail;
            $item->product = $request->item_name[$i];
            $item->quantity = $request->quantity[$i];
            $item->unit_price = $request->unit_price[$i];
            $item->total = ($request->quantity[$i] * $request->unit_price[$i]);
            $item->po_id = $poId;
            $item->tenant_id = Auth::user()->tenant_id;
            $item->save();
        }
        session()->flash("success", "<strong>Success!</strong> New purchase order submitted.");
        return back();

    }

    public function viewPurchaseOrder($slug){

        $purchase = PurchaseOrder::where('slug', $slug)->where('tenant_id', Auth::user()->tenant_id)->first();
        if(!empty($purchase) ){
            $items = PurchaseOrderDetail::where('po_id', $purchase->id)
                                        ->where('tenant_id', Auth::user()->tenant_id)
                                        ->get();
            return view('backend.procurement.supplier.view-purchase-order', ['purchase'=>$purchase, 'items'=>$items]);
        }else{
            return redirect()->route('404');
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
