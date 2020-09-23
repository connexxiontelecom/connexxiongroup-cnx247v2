<?php

namespace App\Http\Controllers\CNX247\Backend\Accounting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use DB;
use Schema;

class ChartOfAccountController extends Controller
{
    public $coa_fields = array(
        [
            'account_name'=>'Asset',
            'account_type'=>1,
            'bank'=>'0',
            'glcode'=>1,
            'parent_account'=>0,
            'type'=>'General'
        ],
        [
            'account_name'=>'Liability',
            'account_type'=>2,
            'bank'=>'0',
            'glcode'=>2,
            'parent_account'=>0,
            'type'=>'General'
        ],
        [
            'account_name'=>'Equity',
            'account_type'=>3,
            'bank'=>'0',
            'glcode'=>3,
            'parent_account'=>0,
            'type'=>'General'
        ],
        [
            'account_name'=>'Revenue',
            'account_type'=>4,
            'glcode'=>4,
            'bank'=>'0',
            'parent_account'=>0,
            'type'=>'General'
        ],
        [
            'account_name'=>'Expenses',
            'account_type'=>5,
            'bank'=>'0',
            'glcode'=>5,
            'parent_account'=>0,
            'type'=>'General'
        ]
        );

    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        $exist = null;
        if(!Schema::connection('mysql')->hasTable(Auth::user()->tenant_id.'_coa')){
            $exist = 'no';
            return view('backend.accounting.setup.coa.index', ['exist'=>$exist]);
        }else{
            $exist = 'yes';
            $charts = DB::table(Auth::user()->tenant_id.'_coa')->orderBy('glcode', 'ASC')->get();
            return view('backend.accounting.setup.coa.index', ['exist'=>$exist, 'charts'=>$charts]);
        }
    }

    public function createCOA(){
        if(!Schema::connection('mysql')->hasTable(Auth::user()->tenant_id.'_coa') || !Schema::connection('mysql')->hasTable(Auth::user()->tenant_id.'_gl')){

            //Create table
            Schema::connection('mysql')->create(Auth::user()->tenant_id.'_coa', function($table)
            {
                $table->increments('id');
                $table->string('account_name');
                $table->tinyInteger('account_type');
                $table->integer('bank')->default(0);
                $table->unsignedBigInteger('glcode');
                $table->integer('parent_account')->nullable();
                $table->string('type')->default('General');
                $table->timestamps();
            });
            #Insert default records into table

                $default = DB::table(Auth::user()->tenant_id.'_coa')->insert($this->coa_fields);
            Schema::connection('mysql')->create(Auth::user()->tenant_id.'_gl', function($table)
            {
                $table->increments('id');
                $table->unsignedBigInteger('glcode');
                $table->unsignedBigInteger('posted_by');
                $table->string('narration')->nullable();
                $table->double('dr_amount')->default(0);
                $table->double('cr_amount')->default(0);
                $table->string('ref_no')->nullable();
                $table->integer('bank')->nullable();
                $table->double('ob')->default(0);
                $table->timestamps();
            });
        }
    }
    public function getParentAccount(Request $request){
        $this->validate($request,[
            'account_type'=>'required'
        ]);
        if($request->type == 'Detail'){
            $account = DB::table(Auth::user()->tenant_id.'_coa')->select('account_name', 'id', 'type', 'glcode')
                ->where('type','General')
                ->where('account_type',$request->account_type)
                ->get();
            return response()->json(['parents'=>$account],200);
        }else{
            $account = DB::table(Auth::user()->tenant_id.'_coa')->select('account_name', 'id', 'type', 'glcode')
                ->where('account_type',$request->account_type)
                ->get();
            return response()->json(['parents'=>$account],200);
        }
    }
    public function saveAccount(Request $request){
        $this->validate($request,[
            "glcode"=>"required|unique:".Auth::user()->tenant_id."_coa,glcode",
            //"account_name"=>"required|unique:".Auth::user()->tenant_id."_coa, account_name",
            "account_type"=>"required",
            "type"=>"required",
            "bank"=>"required",
            "parent_account"=>"required"
            ]);
        $coa = DB::table(Auth::user()->tenant_id.'_coa')->insert($request->all());
        return response()->json(['message'=>'Success! New account registered.'], 200);
    }
}
