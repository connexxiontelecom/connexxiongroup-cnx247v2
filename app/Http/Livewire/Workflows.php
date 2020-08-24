<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Post;
use App\ResponsiblePerson;
use Auth;

class Workflows extends Component
{
    public $requests;
    //public $message;
    public function render()
    {
        return view('livewire.workflows');
    }

    public function mount(){
        $this->getContent();
    }

    /*
    * Get content 
    */
    public function getContent(){
        $this->requests = Post::whereIn('post_type', 
                          ['purchase-request', 'expense-request', 
                          'leave-request', 'business-trip',
                          'general-request'])
                          ->orderBy('id', 'DESC')
                          ->get();
    }

    /*
    * Approve request
    */
    public function approveRequest($id){
     
        $approve = ResponsiblePerson::where('post_id', $id)->where('user_id', Auth::user()->id)->first();
        $approve->status = 'approve';
        $approve->save();
        session()->flash("success", "<strong>Success!</strong> Your reaction to this request is taken.");
        $this->getContent();
    }

    /*
    * Decline request
    */
    public function declineRequest($id){
        $decline = ResponsiblePerson::where('post_id', $id)->where('user_id', Auth::user()->id)->first();
        $decline->status = 'decline';
        $decline->save();
        session()->flash("success", "<strong>Success!</strong> Your reaction to this request is taken.");
        $this->getContent();
    }
}
