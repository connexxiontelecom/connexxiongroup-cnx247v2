<?php

namespace App\Http\Livewire\Backend\Workflow;

use Livewire\Component;
use App\Post;
use Auth;

class Statistics extends Component
{
    public $overall;

    public function render()
    {
        return view('livewire.backend.workflow.statistics');
    }

    public function mount(){
        $this->getContent();
    }

    public function getContent(){
        $this->overall = Post::whereIn('post_type',
                            ['purchase-request', 'expense-request',
                            'leave-request', 'business-trip',
                            'general-request'])
                            ->where('tenant_id',Auth::user()->tenant_id)
                            ->where('post_status', 'approved')
                            ->sum('budget');

    }
}
