<?php

namespace App\Http\Controllers\CNX247\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Tenant;
use Carbon\Carbon;
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
        $now = Carbon::now();
        $overall = Tenant::count();
        $thisYear = Tenant::whereYear('created_at', date('Y'))
                        ->count();
        $thisMonth = Tenant::whereMonth('created_at', date('m'))
                        ->whereYear('created_at', date('Y'))
                        ->count();
        $thisWeek = Tenant::whereBetween('created_at', [$now->startOfWeek()->format('Y-m-d H:i'), $now->endOfWeek()->format('Y-m-d H:i')])
                        ->count();
        $lastMonth = Tenant::whereMonth('created_at', '=', $now->subMonth()->month)
                        ->count();
        #Par
        $previous_week = strtotime("-1 week +1 day");
        $start_week = strtotime("last sunday midnight",$previous_week);
        $end_week = strtotime("next saturday",$start_week);
        $start_week = date("Y-m-d",$start_week);
        $end_week = date("Y-m-d",$end_week);

        $lastWeek = Tenant::whereBetween('created_at', [$start_week, $end_week])
                        ->count();
        $yesterday = Tenant::whereDay('created_at', $now->yesterday())
                        ->count();
        $today = Tenant::whereDay('created_at', $now->today())
                        ->count();

        return view('backend.admin.tenants.index',
        ['tenants'=>$tenants,
        'overall'=>$overall,
        'thisYear'=>$thisYear,
        'thisMonth'=>$thisMonth,
        'thisWeek'=>$thisWeek,
        'lastMonth'=>$lastMonth
        ]);
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
