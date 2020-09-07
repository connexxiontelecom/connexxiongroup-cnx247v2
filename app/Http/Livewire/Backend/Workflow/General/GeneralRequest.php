<?php

namespace App\Http\Livewire\Backend\Workflow\General;

use Livewire\Component;
use App\RequestTable;
use App\BusinessLog;
use App\RequestActivityLog;
use App\RequestApprover;
use App\Post;
use Auth;

class GeneralRequest extends Component
{
    public $general;

    public function render()
    {
        return view('livewire.backend.workflow.general.general-request');
    }
    public function mount(){
        $this->getContent();
    }

    public function getContent(){
        $this->general = Post::where('user_id', Auth::user()->id)
                                ->where('tenant_id', Auth::user()->tenant_id)
                                ->where('post_type', 'general-request')
                                ->orderBy('id', 'DESC')
                                ->get();
    }

            //submit expense report
           /*  public function submitGeneralRequest(){
                //return dd($this->attachment);
                $this->validate([
                    'title'=>'required',
                    'description'=>'required'
                ]);

                $url = substr(sha1(time()), 10,10);
                $general = new Post;
                $general->post_title = $this->title;
                $general->post_type = 'general-request';
                $general->post_content = $this->description;
                $general->post_status = 'in-progress';
                $general->user_id = Auth::user()->id;
                $general->post_url = $url;
                $general->tenant_id = Auth::user()->tenant_id;
                //$expense->attachment = $filename ?? '';
                $general->save();
                $id = $general->id;

                //Register business process log
                $log = new BusinessLog;
                $log->request_id = $id;
                $log->user_id = Auth::user()->id;
                $log->note = "Approval for General request ".$this->title;
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

                session()->flash("success", "General request saved.");
             return response()->json(['message'=>'Success! General request submitted.']);
            } */
}
