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
class PurchaseRequestController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /*
    * Load Expense request index page
    */
    public function index(){
        return view('backend.workflow.purchase.index');
    }

    public function store(Request $request){
        $this->validate($request,[
            'title'=>'required',
            'amount'=>'required',
            'description'=>'required'
        ]);
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
        $requisition = new Post;
        $requisition->post_title = $request->title;
        $requisition->budget = $request->amount;
        $requisition->currency = $request->currency;
        $requisition->post_type = 'purchase-request';
        $requisition->post_content = $request->description;
        $requisition->post_status = 'in-progress';
        $requisition->user_id = Auth::user()->id;
        $requisition->tenant_id = Auth::user()->tenant_id;
        $requisition->post_url = $url;
        //$expense->attachment = $filename ?? '';
        $requisition->save();
        $id = $requisition->id;
        $attachment = new PostAttachment;
        $attachment->post_id = $id;
        $attachment->user_id = Auth::user()->id;
        $attachment->tenant_id = Auth::user()->tenant_id;
        $attachment->attachment = $filename;
        $attachment->save();

        $processors = RequestApprover::select('user_id')
                        ->where('request_type', 'purchase-request')
                        ->where('depart_id', Auth::user()->department_id)
                        ->where('tenant_id', Auth::user()->tenant_id)
                        ->get();
        foreach($processors as $process){
            $event = new ResponsiblePerson;
            $event->post_id = $id;
            $event->user_id = $process->user_id;
            $event->tenant_id = Auth::user()->tenant_id;
            $event->save();
            $user = User::find($process->user_id);
                $user->notify(new NewPostNotification($requisition));
        }

        //Register business process log
        $log = new BusinessLog;
        $log->request_id = $id;
        $log->user_id = Auth::user()->id;
        $log->note = "Approval for purchase request ".$request->title." registered.";
        $log->name = "Registering purchase request";
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

        session()->flash("success", "Purchase request saved.");
     return response()->json(['message'=>'Success! Purchase request  submitted.']);
    }
}
