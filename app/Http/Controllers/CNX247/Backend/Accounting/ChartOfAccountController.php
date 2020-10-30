<?php

namespace App\Http\Controllers\CNX247\Backend\Accounting;

use Illuminate\Validation\ValidationException;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Policy;
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
            'type'=>'1'
        ],
        [
            'account_name'=>'Liability',
            'account_type'=>2,
            'bank'=>'0',
            'glcode'=>2,
            'parent_account'=>0,
            'type'=>'1'
        ],
        [
            'account_name'=>'Equity',
            'account_type'=>3,
            'bank'=>'0',
            'glcode'=>3,
            'parent_account'=>0,
            'type'=>'1'
        ],
        [
            'account_name'=>'Revenue',
            'account_type'=>4,
            'glcode'=>4,
            'bank'=>'0',
            'parent_account'=>0,
            'type'=>'1'
        ],
        [
            'account_name'=>'Expenses',
            'account_type'=>5,
            'bank'=>'0',
            'glcode'=>5,
            'parent_account'=>0,
            'type'=>'1'
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
                $table->tinyInteger('type')->default(1)->comment('0=Detail, 1=General');
                $table->timestamps();
            });
            #Insert default records into table

                $default = DB::table(Auth::user()->tenant_id.'_coa')->insert($this->coa_fields);
            Schema::connection('mysql')->create(Auth::user()->tenant_id.'_gl', function($table)
            {
                $table->increments('id');
                $table->unsignedBigInteger('glcode');
                $table->string('posted_by');
                $table->string('narration')->nullable();
                $table->double('dr_amount')->default(0);
                $table->double('cr_amount')->default(0);
                $table->string('ref_no')->nullable();
                $table->integer('bank')->nullable();
                $table->double('ob')->default(0);
                $table->dateTime('transaction_date')->default(0);
                $table->tinyInteger('posted')->default(0)->nullable();
                $table->timestamps();
            });
        }
        session()->flash("success", "<strong>Success!</strong> Chart of Accounts created.");
        return back();
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

    public function vat(){
        $accounts = DB::table(Auth::user()->tenant_id.'_coa')->where('type', 'Detail')->select()->get();
        $policy = Policy::where('tenant_id', Auth::user()->tenant_id)->first();
        return view('backend.accounting.setup.vat.index',['accounts'=>$accounts,'policy'=>$policy]);
    }
    public function postVat(Request $request){
        $request->validate([
            'vat'=>'required',
            'account'=>'required'
        ]);
        $policy = Policy::where('tenant_id', Auth::user()->tenant_id)->first();
        if(!empty($policy)){
            $policy->vat = $request->vat;
            $policy->glcode = $request->account;
            $policy->tenant_id = Auth::user()->tenant_id;
            $policy->save();
            return response()->json(['message'=>'Success! VAT and account set.'], 200);
        }else{
            $new = new Policy;
            $new->vat = $request->vat;
            $new->glcode = $request->account;
            $new->tenant_id = Auth::user()->tenant_id;
            $new->save();
            return response()->json(['message'=>'Success! VAT and account set.'], 200);
        }
    }

    public function openingBalance(){
        $accounts = DB::table(Auth::user()->tenant_id.'_coa')->where('type', 'Detail')->select()->get();
        $opening_balances = DB::table(Auth::user()->tenant_id.'_gl as g')
                            ->join(Auth::user()->tenant_id.'_coa as c', 'g.glcode', '=', 'c.glcode')
                            ->select('g.glcode as gcode', 'c.glcode as ccode', 'c.account_name as account',
                            'g.narration', 'g.ref_no', 'g.bank', 'g.dr_amount', 'g.cr_amount',
                            'g.transaction_date', 'g.posted_by')
                            ->where('g.ob',1)
                            ->get();
        return view('backend.accounting.setup.ob.index',['accounts'=>$accounts, 'opening_balances'=>$opening_balances]);
    }

    public function postOpeningBalance(Request $request){
        try{
            $request->validate([
                'debit'=>'required',
                'credit'=>'required',
                'account_name'=>'required',
                'date'=>'required|date',
                'transaction_type'=>'required'
            ]);

        }catch(ValidationException $ex){
            return response()->json([
                'status' => 'error',
                'msg'    => 'Submission failed. Try again.',
                'errors' => $ex->errors(),
            ], 422);
        }
        $tenant_id = Auth::user()->tenant_id;
        $account = DB::table($tenant_id.'_coa')->select()->where('glcode', $request->account_name)->first();
        $posted_by = Auth::user()->first_name.' '.Auth::user()->surname;
        if($request->transaction_type == 1){ //debit
            $dr_trans = [
                'glcode'=>$request->account_name,
                'posted_by'=>$posted_by,
                'narration'=>'Opening Balance',
                'dr_amount'=>$request->debit,
                'cr_amount'=>0,
                'ref_no'=>strtoupper(substr(sha1(time()),34,60)),
                'bank'=>$account->bank,
                'ob'=>1,
                'created_at'=>now(),
                'transaction_date'=>$request->date,
                'updated_at'=>now()
            ];
            DB::table($tenant_id.'_gl')->insert($dr_trans);
        }else{
            $cr_trans = [
                'glcode'=>$request->account_name,
                'posted_by'=>$posted_by,
                'narration'=>'Opening Balance',
                'cr_amount'=>$request->credit,
                'dr_amount'=>0,
                'ref_no'=>strtoupper(substr(sha1(time()),34,60)),
                'bank'=>$account->bank,
                'ob'=>1,
                'created_at'=>now(),
                'transaction_date'=>$request->date,
                'updated_at'=>now()
            ];
            DB::table($tenant_id.'_gl')->insert($cr_trans);
        }
        return response()->json(['message'=>'Success! Opening balance saved.'], 200);
    }
}
