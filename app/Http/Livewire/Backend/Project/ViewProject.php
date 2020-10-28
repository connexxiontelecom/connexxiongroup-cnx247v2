<?php

namespace App\Http\Livewire\Backend\Project;

use Livewire\Component;
use App\ResponsiblePerson;
use App\Observer;
use App\Participant;
use App\Post;
use App\PostLike;
use App\PostComment;
use App\PostRevision;
use App\PostAttachment;
use App\Milestone;
use App\User;
use Auth;

class ViewProject extends Component
{
    public $project;
    public $comment;
    public $likes;
    public $link;
    public $review;
    public $attachments;
    public $milestones;
    public $users;


    public function mount($url = ''){
        $this->link = request('url', $url);
        $this->getContent();
    }

    public function render()
    {
        return view('livewire.backend.project.view-project');
    }

        /*
    * Comment on post
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
    * Review task
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
    * Load content
    */
    public function getContent(){
        $this->project = Post::where('post_type', 'project')->where('post_url', $this->link)
                        ->where('tenant_id',Auth::user()->tenant_id)->first();
        $this->attachments = PostAttachment::where('post_id', $this->project['id'])
                                            ->where('tenant_id', Auth::user()->tenant_id)
                                            ->get();
        $this->milestones = Milestone::where('post_id', $this->project['id'])
                                    ->where('tenant_id', Auth::user()->tenant_id)
                                    ->orderBy('id', 'DESC')
                                    ->get();
        $this->users = User::select('first_name', 'surname', 'id')
        ->where('account_status',1)
        ->where('verified', 1)
        ->where('tenant_id',Auth::user()->tenant_id)->orderBy('first_name', 'ASC')->get();
    }

    public function markAsComplete($id){
        $task = Post::where('id', $id)->where('tenant_id', Auth::user()->tenant_id)->first();
        $task->post_status = 'completed';
        $task->save();
        session()->flash("success", "<strong>Success!</strong> Task marked as complete.");
        $this->getContent();
        return back();
    }

   /*  public function markAsComplete($id){
        $task = Post::where('id', $id)->where('tenant_id', Auth::user()->tenant_id)->first();
        $task->post_status = 'completed';
        $task->save();
        session()->flash("success", "<strong>Success!</strong> Task marked as completed.");
        $this->getContent();
        return back();
    } */
    public function markAsRisk($id){
        $task = Post::where('id', $id)->where('tenant_id', Auth::user()->tenant_id)->first();
        $task->post_status = 'at-risk';
        $task->save();
        session()->flash("success", "<strong>Success!</strong> Task marked as At-Risk.");
        $this->getContent();
        return back();
    }

    public function markAsHold($id){
        $task = Post::where('id', $id)->where('tenant_id', Auth::user()->tenant_id)->first();
        $task->post_status = 'on-hold';
        $task->save();
        session()->flash("success", "<strong>Success!</strong> Task marked as On-Hold.");
        $this->getContent();
        return back();
    }


    public function markAsResolved($id){
        $task = Post::where('id', $id)->where('tenant_id', Auth::user()->tenant_id)->first();
        $task->post_status = 'resolved';
        $task->save();
        session()->flash("success", "<strong>Success!</strong> Task marked as Resolved.");
        $this->getContent();
        return back();
    }


    public function markAsClosed($id){
        $task = Post::where('id', $id)->where('tenant_id', Auth::user()->tenant_id)->first();
        $task->post_status = 'closed';
        $task->save();
        session()->flash("success", "<strong>Success!</strong> Task marked as Closed.");
        $this->getContent();
        return back();
    }


    public function removeResponsiblePerson($participant)
    {
        $responsiblePerson =  ResponsiblePerson::where('tenant_id', Auth::user()->tenant_id)->where('user_id', $participant)->where('post_id', $this->project->id)->first();
        if(!empty($responsiblePerson)) {
        $responsiblePerson->delete();
        }
        $this->getContent();
        return back();
        //return redirect()->route('view-project', ["url" => $request->url]);
    }



    public function removeObserver($participant)
    {
        $responsiblePerson =  Observer::where('tenant_id', Auth::user()->tenant_id)->where('user_id', $participant)->where('post_id', $this->project->id)->first();
        if(!empty($responsiblePerson)) {
        $responsiblePerson->delete();
        }
        $this->getContent();
        return back();
        //return redirect()->route('view-project', ["url" => $request->url]);
    }



    public function removeParticipant($participant)
    {
        $responsiblePerson =  Participant::where('tenant_id', Auth::user()->tenant_id)->where('user_id', $participant)->where('post_id', $this->project->id)->first();
        if(!empty($responsiblePerson)) {
        $responsiblePerson->delete();
        }
        $this->getContent();
        return back();
        //return redirect()->route('view-project', ["url" => $request->url]);
    }
}
