<?php

namespace App\Http\Controllers\CNX247\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Tenant;
use App\TransactionReference;
use Auth;
class TenantController extends Controller
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
        $tenants = Tenant::orderBy('id', 'DESC')->get();
/*         $tenantsOverall = Tenant::orderBy('id', 'DESC')->get();
        $tenantsThisMonth = Tenant::orderBy('id', 'DESC')->get();
        $tenantsLastMonth = Tenant::orderBy('id', 'DESC')->get();
        $tenantsThisWeek = Tenant::orderBy('id', 'DESC')->get(); */
        return view('backend.admin.tenants.index', ['tenants'=>$tenants]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    public function view($slug)
    {
        $tenant = Tenant::where('slug', $slug)->first();
        $transaction = TransactionReference::where('tenant_id', $tenant->tenant_id)->first();
        if(!empty($tenant) ){
            return view('backend.admin.tenants.view', ['tenant'=>$tenant, 'transaction'=>$transaction]);
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
