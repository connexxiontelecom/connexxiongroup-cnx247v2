<?php

namespace App\Http\Livewire\Backend\Workflow\Leave;

use Livewire\Component;
use App\RequestTable;
use App\BusinessLog;
use App\RequestActivityLog;
use App\RequestApprover;
use App\Post;
use App\LeaveWallet;
use App\LeaveType;
use Auth;

class LeaveRequest extends Component
{
    public $due_date, $absence_type;
    public $reason, $start_date, $attachment, $currency;
    public $wallet, $balance, $leaves ;

    public function render()
    {
        return view('livewire.backend.workflow.leave.leave-request');
    }

    public function mount(){
        $this->wallet = LeaveWallet::select('balance')->where('user_id', Auth::user()->id)
                        ->where('tenant_id',Auth::user()->tenant_id)->first();
        $this->leaves = LeaveType::orderBy('leave_name', 'ASC')
                        ->where('tenant_id',Auth::user()->tenant_id)->get();
        if(!empty($this->wallet) ){
            $this->balance = $this->wallet->balance;
            if($this->balance <= 0 ){
                session()->flash("error", "<strong>Ooops!</strong>  It appears you've exhausted all your leave requests or you're not entitled to one. Please contact <strong>HR</strong> or <strong>Admin</strong>.");
            }
        }else{
            session()->flash("error", "<strong>Ooops!</strong>  It appears you're not entitled to leave. Please contact <strong>HR</strong> or <strong>Admin</strong>.");
            $this->balance = 0;
        }
    }

    //submit leave request
    public function submitLeaveRequest(){
                //return dd($this->attachment);
                $this->validate([
                    'start_date'=>'required|date',
                    'due_date'=>'required|date|after_or_equal:start_date',
                    'absence_type'=>'required',
                    'reason'=>'required'
                ]);

            /*if(!empty($request->file('attachment'))){
                    $extension = $request->file('attachment');
                    $extension = $request->file('attachment')->getClientOriginalExtension(); // getting excel extension
                    $dir = 'assets/request-attachments/';
                    $filename = uniqid().'_'.time().'_'.date('Ymd').'.'.$extension;
                    $request->file('attachment')->move(public_path($dir), $filename);
                }else{
                    $filename = '';
                } */
                $url = substr(sha1(time()), 10,10);
                $expense = new Post;
                $expense->post_title = 'Leave request';
                $expense->post_content = $this->reason;
                $expense->start_date = $this->start_date;
                $expense->end_date = $this->due_date;
                $expense->post_type = 'leave-request';
                $expense->post_status = 'in-progress';
                $expense->user_id = Auth::user()->id;
                $expense->post_url = $url;
                $expense->tenant_id = Auth::user()->tenant_id;
                //$expense->attachment = $filename ?? '';
                $expense->save();
                $id = $expense->id;

                //Register business process log
                $log = new BusinessLog;
                $log->request_id = $id;
                $log->user_id = Auth::user()->id;
                $log->note = "Approval for Leave request ".$this->reason;
                $log->name = "Approval";
                $log->tenant_id = Auth::user()->tenant_id;
                $log->save();

                //identify supervisor
                $supervise = new BusinessLog;
                $supervise->request_id = $id;
                $supervise->user_id = Auth::user()->id;
                $supervise->name = "Log entry";
                $supervise->note = "Identifying supervisor for ".Auth::user()->first_name." ".Auth::user()->surname;
                $supervise->tenant_id = Auth::user()->tenant_id;
                $supervise->save();

                session()->flash("success", "Leave request saved.");
             return response()->json(['message'=>'Success! Leave request submitted.']);
            }
}
