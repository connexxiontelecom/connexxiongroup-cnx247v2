<?php

namespace App\Http\Livewire\Backend\Crm\Support;

use Livewire\Component;
use App\Ticket;
use Auth;

class ViewTicket extends Component
{
    public $link;
    public $ticket;

    public function render()
    {
        return view('livewire.backend.crm.support.view-ticket');
    }

    public function mount($slug = ''){
        $this->link = request('slug', $slug);
        $this->getContent();
    }

    /*
    * Get ticket details
    */
    public function getContent(){
        $this->ticket = Ticket::where('slug', $this->link)->where('tenant_id', Auth::user()->tenant_id)->first();
    }
}
