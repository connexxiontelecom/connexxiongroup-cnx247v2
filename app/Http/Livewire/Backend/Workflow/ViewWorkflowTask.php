<?php

namespace App\Http\Livewire\Backend\Workflow;

use App\SpecificApprover;
use Livewire\Component;
use App\Post;
use App\PostComment;
use App\PostAttachment;
use App\PostRevision;
use App\RequestApprover;
use App\ResponsiblePerson;
use App\BusinessLog;
use Carbon\Carbon;
use App\Notifications\NewPostNotification;
use App\User;
use Auth;
use Hash;

class ViewWorkflowTask extends Component
{
    public $link;
    public $comment;
    public $likes;
    public $review;
    public $request;
    public $attachments;

    public $transactionPassword;
    public $userAction; //approved/declined
    public $actionStatus = 0;
    public $verificationPostId;
		public $responsibleperson, $post;
   /* public function __construct($id)
		{
			$this->responsibleperson = new ResponsiblePerson();
			$this->post = new Post();
		}*/

	public function render()
    {
        return view('livewire.backend.workflow.view-workflow-task');
    }

    public function mount($url = ''){
        $this->link = request('url', $url);
        $this->getContent();
				/*$this->responsibleperson = new ResponsiblePerson();
				$this->post = new Post();*/
    }

    /*
    * Load content
    */
    public function getContent(){
        $this->request = Post::where('post_url', $this->link)->where('tenant_id',Auth::user()->tenant_id)->first();
        $this->attachments = PostAttachment::where('post_id', $this->request->id)
                            ->where('tenant_id',Auth::user()->tenant_id)
                            ->get();
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
        $this->actionStatus = 1;
        $this->verificationPostId = $id;
        $this->userAction = 'approved';
        session()->flash("success_code", "Kindly enter your transaction password to confirm this action. <small>You can set a new transaction password by following: Profile > Settings > Security.</small>");

    }

    /*
    * Decline request
    */
    public function declineRequest($id){
        $this->actionStatus = 1;
        $this->verificationPostId = $id;
        $this->userAction = 'declined';
        session()->flash("success_code", "Kindly enter your transaction password to confirm this action. <small>You can set a new transaction password by following: Profile > Settings > Security.</small>");
    }

    public function clockIn($id){

    }
    public function verifyCode($id){
        $this->validate([
            'transactionPassword'=>'required'
        ]);
        if (Hash::check($this->transactionPassword, Auth::user()->transaction_password)) {
            $details = Post::find($id);
            if($this->userAction == 'approved'){
            	ResponsiblePerson::updateStatus($details->id, $this->userAction);
            	$next = ResponsiblePerson::markFirstUnseenAsSeen($details->id);
            	if($next == 1){
								$this->actionStatus = 0;
								$this->verificationPostId = null;
								$this->getContent();
								session()->flash("done", "<p class='text-success text-center'>Request verified successfully.</p>");
							}else{
								#No more persons to process request
								Post::updatePostStatus($details->id, $this->userAction);
							}
						} else{
							#No more persons to process request
							Post::updatePostStatus($details->id, $this->userAction);
							$this->actionStatus = 0;
							$this->verificationPostId = null;
							$this->getContent();
							session()->flash("done", "<p class='text-success text-center'>Request verified successfully.</p>");
            }
        }else{
            session()->flash("error_code", "<strong>Ooops!</strong>  Mis-match transaction password. Try again. <small>You can set a new transaction password by following: Profile > Settings > Security.</small>");
        }

    }
/*
    public function publisNextProcessor($post_id, $post_type, $next_processor){
					$next = new ResponsiblePerson;
					$next->post_id = $post_id;
					$next->post_type = $post_type;
					$next->user_id = $next_processor;
					$next->tenant_id = Auth::user()->tenant_id;
					$next->save();
					$this->actionStatus = 0;
					$this->verificationPostId = null;
					$this->getContent();
					session()->flash("done", "<p class='text-success text-center'>Request verified successfully.</p>");
		}*/
}
