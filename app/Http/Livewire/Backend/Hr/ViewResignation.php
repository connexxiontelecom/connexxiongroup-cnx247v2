<?php

namespace App\Http\Livewire\Backend\Hr;

use Livewire\Component;
use App\Resignation;
use Auth;
class ViewResignation extends Component
{
    public $slug;
    public $resign;
    public $link;
    public $replies;
    public $query_reply;

    public function render()
    {
        return view('livewire.backend.hr.view-resignation');
    }

    public function mount($url = ''){
        $this->link = request('url', $url);
        $this->getContent();

    }

    public function getContent(){
            $this->resign = Resignation::where('tenant_id', Auth::user()->tenant_id)->where('slug', $this->link)->first();

    }

    public function cancel($id){
        $resign = Resignation::where('tenant_id', Auth::user()->tenant_id)->where('id', $id)->first();
        if(!empty($resign) ){
            $resign->status = 'cancelled';
            $resign->save();
            $this->getContent();
        }
    }
    public function approve($id){
        $resign = Resignation::where('tenant_id', Auth::user()->tenant_id)->where('id', $id)->first();
        if(!empty($resign) ){
            $resign->status = 'approved';
            $resign->save();
            $this->getContent();
        }
    }
    public function decline($id){
        $resign = Resignation::where('tenant_id', Auth::user()->tenant_id)->where('id', $id)->first();
        if(!empty($resign) ){
            $resign->status = 'declined';
            $resign->save();
            $this->getContent();
        }
    }
}
