<?php

namespace App\Http\Livewire\Backend\Workflow\Purchase;

use Livewire\Component;
use App\RequestTable;
use App\BusinessLog;
use App\RequestActivityLog;
use App\RequestApprover;
use App\ResponsiblePerson;
use App\Post;
use Auth;
class Index extends Component
{
    public $title;
    public $description, $amount, $attachment, $currency;

    public function render()
    {
        return view('livewire.backend.workflow.purchase.index');
    }

        //submit expense report
        public function submitPurchaseRequest(){
            //return dd($this->attachment);
            $this->validate([
                'title'=>'required',
                'amount'=>'required',
                'currency'=>'required'
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
            $expense->post_title = $this->title;
            $expense->budget = $this->amount;
            $expense->currency = $this->currency;
            $expense->post_type = 'purchase-request';
            $expense->post_content = $this->description;
            $expense->post_status = 'in-progress';
            $expense->user_id = Auth::user()->id;
            $expense->post_url = $url;
            $expense->tenant_id = Auth::user()->tenant_id;
            //$expense->attachment = $filename ?? '';
            $expense->save();
            $id = $expense->id;
            //search for processors
            $processors = RequestApprover::select('user_id')
                                    ->where('request_type', 'purchase-request')
                                    ->where('depart_id', Auth::user()->department_id)
                                    ->get();
            foreach($processors as $process){
                $event = new ResponsiblePerson;
                $event->post_id = $id;
                $event->user_id = $process->user_id;
                $event->tenant_id = Auth::user()->tenant_id;
                $event->save();
            }
            //Register business process log
            $log = new BusinessLog;
            $log->request_id = $id;
            $log->user_id = Auth::user()->id;
            $log->note = "Approval for Purchase request ".$this->title;
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

            session()->flash("success", "Purchase request saved.");
         return response()->json(['message'=>'Success! Purchase request submitted.']);
        }
}
