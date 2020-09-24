<?php

namespace App\Http\Livewire\Backend\Workflow\Expense;

use Livewire\Component;
use App\RequestTable;
use App\BusinessLog;
use App\RequestActivityLog;
use App\RequestApprover;
use App\Post;
use Auth;
class Index extends Component
{
    public $expenses;

    public function render()
    {
        return view('livewire.backend.workflow.expense.index');
    }

    public function mount(){
        $this->getContent();
    }

    public function getContent(){
        $this->expenses = Post::where('user_id', Auth::user()->id)
                                ->where('tenant_id', Auth::user()->tenant_id)
                                ->where('post_type', 'expense-report')
                                ->orderBy('id', 'DESC')
                                ->get();
    }

    //submit expense report
   /*  public function submitExpenseReport(){
        $this->validate([
            'title'=>'required',
            'amount'=>'required',
            'currency'=>'required'
        ]);

        $url = substr(sha1(time()), 10,10);
        $expense = new Post;
        $expense->post_title = $this->title;
        $expense->budget = $this->amount;
        $expense->currency = $this->currency;
        $expense->post_type = 'expense-request';
        $expense->post_content = $this->description;
        $expense->post_status = 'in-progress';
        $expense->user_id = Auth::user()->id;
        $expense->tenant_id = Auth::user()->tenant_id;
        $expense->post_url = $url;
        //$expense->attachment = $filename ?? '';
        $expense->save();
        $id = $expense->id;

        //Register business process log
        $log = new BusinessLog;
        $log->request_id = $id;
        $log->user_id = Auth::user()->id;
        $log->note = "Approval for expense request ".$this->title;
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

        session()->flash("success", "Expense report saved.");
     return response()->json(['message'=>'Success! Expense request submitted.']);
    } */
}
