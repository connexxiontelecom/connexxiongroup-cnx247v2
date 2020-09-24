<?php

namespace App\Http\Controllers\CNX247\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Notifications\NewPostNotification;
use App\BusinessLog;
use App\PostAttachment;
use App\RequestApprover;
use App\ResponsiblePerson;
use App\Post;
use App\User;
use Auth;
class ExpenseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /*
    * Load Expense request index page
    */
    public function index(){
        return view('backend.workflow.expense.index');
    }
    public function store(Request $request){
        $this->validate($request,[
            'title'=>'required',
            'amount'=>'required'
        ]);
        $processor = RequestApprover::select('user_id')
                                    ->where('request_type', 'expense-report')
                                    ->where('depart_id', Auth::user()->department_id)
                                    ->where('tenant_id', Auth::user()->tenant_id)
                                    ->first();
        if(empty($processor)){
            return response()->json(["error"=>"Error! Could not submit. No processor found."],400);
        }else{
            if(!empty($request->file('attachment'))){
                $extension = $request->file('attachment');
                $extension = $request->file('attachment')->getClientOriginalExtension();
                $size = $request->file('attachment')->getSize();
                $dir = 'assets/uploads/requisition/';
                $filename = uniqid().'_'.time().'_'.date('Ymd').'.'.$extension;
                $request->file('attachment')->move(public_path($dir), $filename);
            }else{
                $filename = '';
            }

            $url = substr(sha1(time()), 10,10);
            $expense = new Post;
            $expense->post_title = $request->title;
            $expense->budget = $request->amount;
            $expense->currency = $request->currency;
            $expense->post_type = 'expense-report';
            $expense->post_content = $request->description;
            $expense->post_status = 'in-progress';
            $expense->user_id = Auth::user()->id;
            $expense->tenant_id = Auth::user()->tenant_id;
            $expense->post_url = $url;
            //$expense->attachment = $filename ?? '';
            $expense->save();
            $id = $expense->id;
            if(!empty($request->file('attachment'))){
                $attachment = new PostAttachment;
                $attachment->post_id = $id;
                $attachment->user_id = Auth::user()->id;
                $attachment->tenant_id = Auth::user()->tenant_id;
                $attachment->attachment = $filename;
                $attachment->save();
            }

            $event = new ResponsiblePerson;
            $event->post_id = $id;
            $event->user_id = $processor->user_id;
            $event->tenant_id = Auth::user()->tenant_id;
            $event->save();
            $user = User::find($processor->user_id);
            $user->notify(new NewPostNotification($expense));

            //Register business process log
            $log = new BusinessLog;
            $log->request_id = $id;
            $log->user_id = Auth::user()->id;
            $log->note = "Approval for expense report ".$request->title." registered.";
            $log->name = "Registering expense report";
            $log->tenant_id = Auth::user()->tenant_id;
            $log->save();

            //identify supervisor
            $supervise = new BusinessLog;
            $supervise->request_id = $id;
            $supervise->user_id = Auth::user()->id;
            $supervise->name = "Log entry";
            $supervise->note = "Identifying processor for ".Auth::user()->first_name." ".Auth::user()->surname;
            $supervise->tenant_id = Auth::user()->tenant_id;
            $supervise->save();

            session()->flash("success", "Expense report saved.");
         return response()->json(['message'=>'Success! Expense report submitted.']);

        }
    }
}
