<?php

namespace App\Http\Livewire\Backend\Workflow;

use Livewire\Component;
use App\Post;
use Auth;

class MyRequest extends Component
{
    public $my_requests;
    public function render()
    {
        return view('livewire.backend.workflow.my-request');
    }

    public function mount(){
        $this->getMyRequests();
    }

    /*
    * Get all my requests
    */
    public function getMyRequests(){
        $this->my_requests = Post::where('user_id', Auth::user()->id)
                                    ->whereIn('post_type',
                                    ['purchase-request', 'expense-request',
                                    'leave-request', 'business-trip',
                                    'general-request'])
                                    ->where('tenant_id',Auth::user()->tenant_id)
                                    ->orderBy('id', 'DESC')
                                    ->get();
    }
}
