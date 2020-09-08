<?php

namespace App\Http\Livewire\Backend\Workflow;

use Livewire\Component;
use App\Post;
use Auth;

class Statistics extends Component
{
    public $requests;

    public function render()
    {
        return view('livewire.backend.workflow.statistics');
    }

    public function getContent(){
        $this->requests = Post::where('user_id', Auth::user()->id)
                            ->whereIn('post_type',
                            ['purchase-request', 'expense-request',
                            'leave-request', 'business-trip',
                            'general-request'])
                            ->where('tenant_id',Auth::user()->tenant_id)
                            ->where('post_status', 'approved')
                            //->orderBy('id', 'DESC')
                            ->sum();
    }
}
