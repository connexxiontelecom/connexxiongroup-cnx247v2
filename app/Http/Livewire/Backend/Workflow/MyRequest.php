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


    public function allWorkflows(){
        $this->getMyRequests();
    }
    public function inprogressWorkflows(){
        $this->my_requests = Post::whereIn('post_type',
                          ['purchase-request', 'expense-report',
                          'leave-request', 'business-trip',
                          'general-request'])
                          ->where('post_status', 'in-progress')
                          ->where('user_id', Auth::user()->id)
                          ->where('tenant_id',Auth::user()->tenant_id)
                          ->orderBy('id', 'DESC')
                          ->get();
    }
    public function approvedWorkflows(){
        $this->my_requests = Post::whereIn('post_type',
                          ['purchase-request', 'expense-report',
                          'leave-request', 'business-trip',
                          'general-request'])
                          ->where('post_status', 'approved')
                          ->where('user_id', Auth::user()->id)
                          ->where('tenant_id',Auth::user()->tenant_id)
                          ->orderBy('id', 'DESC')
                          ->get();
    }
    public function declinedWorkflows(){
        $this->my_requests = Post::whereIn('post_type',
                          ['purchase-request', 'expense-report',
                          'leave-request', 'business-trip',
                          'general-request'])
                          ->where('post_status', 'declined')
                          ->where('user_id', Auth::user()->id)
                          ->where('tenant_id',Auth::user()->tenant_id)
                          ->orderBy('id', 'DESC')
                          ->get();
    }
}
