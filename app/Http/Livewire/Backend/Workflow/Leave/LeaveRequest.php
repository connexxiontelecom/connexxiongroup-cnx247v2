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
    public $leaves ;

    public function render()
    {
        return view('livewire.backend.workflow.leave.leave-request');
    }
    public function mount(){
        $this->getContent();
    }

    public function getContent(){
        $this->leaves = Post::where('user_id', Auth::user()->id)
                                ->where('tenant_id', Auth::user()->tenant_id)
                                ->where('post_type', 'leave-request')
                                ->orderBy('id', 'DESC')
                                ->get();
    }

}
