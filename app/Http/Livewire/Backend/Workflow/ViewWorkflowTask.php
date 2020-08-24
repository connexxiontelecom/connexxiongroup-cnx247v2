<?php

namespace App\Http\Livewire\Backend\Workflow;

use Livewire\Component;
use App\Post;
use App\PostComment;
use App\PostRevision;
use App\ResponsiblePerson;
use Auth;

class ViewWorkflowTask extends Component
{
    public $link;
    public $comment;
    public $likes;
    public $review;
    public $request;

    public function render()
    {
        return view('livewire.backend.workflow.view-workflow-task');
    }

    public function mount($url = ''){
        $this->link = request('url', $url);
        $this->getContent();
    }

    /*
    * Load content
    */
    public function getContent(){
        $this->request = Post::where('post_url', $this->link)->where('tenant_id',Auth::user()->tenant_id)->first();
    }

    /*
    * Comment on request
    */
    public function leaveCommentBtn($id){
        $this->validate([
            'id'=>'required',
            'comment'=>'required'
        ]);
        $com = new PostComment;
        $com->user_id = Auth::user()->id;
        $com->post_id = $id;
        $com->comment = $this->comment;
        $com->tenant_id = Auth::user()->tenant_id;
        $com->save();
        $this->comment = '';
        $this->getContent();
    }
    /*
    * Review request
    */
    public function leaveReviewBtn($id){
        $this->validate([
            'id'=>'required',
            'review'=>'required'
        ]);
        $com = new PostRevision;
        $com->user_id = Auth::user()->id;
        $com->post_id = $id;
        $com->content = $this->review;
        $com->tenant_id = Auth::user()->tenant_id;
        $com->save();
        $this->review = '';
        $this->getContent();
    }

        /*
    * Approve request
    */
    public function approveRequest($id){

        $approve = ResponsiblePerson::where('post_id', $id)->where('user_id', Auth::user()->id)
                    ->where('tenant_id',Auth::user()->tenant_id)->first();
        $approve->status = 'approve';
        $approve->save();
        session()->flash("success", "<strong>Success!</strong> Your reaction to this request is taken.");
        $this->getContent();
    }

    /*
    * Decline request
    */
    public function declineRequest($id){
        $decline = ResponsiblePerson::where('post_id', $id)->where('user_id', Auth::user()->id)
                    ->where('tenant_id',Auth::user()->tenant_id)->first();
        $decline->status = 'decline';
        $decline->save();
        session()->flash("success", "<strong>Success!</strong> Your reaction to this request is taken.");
        $this->getContent();
    }
}
