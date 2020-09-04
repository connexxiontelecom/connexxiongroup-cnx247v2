<?php

namespace App\Http\Livewire\Backend\ActivityStream;
use Livewire\WithPagination;
use Livewire\Component;
use Carbon\Carbon;
use App\Post;
use App\PostComment;
use App\PostLike;
use App\ResponsiblePerson;
use App\User;
use Auth;

class Shortcut extends Component
{
    use WithPagination;
    //public $posts = [];
    public $ongoing, $following, $assisting, $set_by_me;
    public $birthdays;
    public $events;
    //public $announcements = [];
    public $all_employees = true;
    public $compose_message;
    public $pId ;
    public $comment;
    public $likes;
    public $users = [];

    public function render()
    {
        $now = Carbon::now();
        $this->events = Post::where('tenant_id', Auth::user()->tenant_id)
                                ->where('post_type', 'event')
                                ->orderBy('id', 'DESC')
                                ->take(5)
                                ->get();
        $this->ongoing = Post::where('post_status','in-progress')
                                ->where('tenant_id', Auth::user()->tenant_id)
                                ->where('post_type', 'task')
                                ->count();
        $this->set_by_me = Post::where('user_id',Auth::user()->id)
                                ->where('tenant_id', Auth::user()->tenant_id)
                                ->where('post_type', 'task')
                                ->count();
        $this->assisting = ResponsiblePerson::where('user_id',Auth::user()->id)
                                ->where('tenant_id', Auth::user()->tenant_id)
                                ->count();
        $this->birthdays = User::where('tenant_id', Auth::user()->tenant_id)
                                ->whereBetween('birth_date', [$now->startOfWeek()->format('Y-m-d H:i'), $now->addMonths(3)])
                                ->take(5)->get();
        return view('livewire.backend.activity-stream.shortcut',
        ['posts'=> Post::where('tenant_id', Auth::user()->tenant_id)->orderBy('id', 'DESC')->get(),
        'announcements'=>Post::where('post_type', 'announcement')
                                ->where('tenant_id', Auth::user()->tenant_id)
                                ->orderBy('id', 'DESC')->take(5)->get(),
        ]);
    }

    public function mount(){
        $this->getContent();
    }
    /*
    * Get content
    */
    public function getContent(){
        //$this->posts = Post::latest()->get();
        //$this->announcements = Post::where('post_type', 'announcement')->orderBy('id', 'DESC')->take(5)->get();
        $this->users = User::where('tenant_id', Auth::user()->tenant_id)->orderBy('first_name', 'ASC')->get();
    }

    /*
    * Send message
    */
    public function sendMessage(){

    }

    /*
    * Toggle choice
    */
    public function toAllEmployees(){
        !$this->all_employees;
    }

    /*
    * Comment on post
    */
    public function comment($id){
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
    }

    /*
    *Like post
    */
    public function addLike($id){
        $this->validate([
            'id'=>'required'
        ]);
        $like = new PostLike;
        $like->user_id = Auth::user()->id;
        $like->post_id = $id;
        $like->tenant_id = Auth::user()->tenant_id;
        $like->save();
    }
    /*
    *Unlike post
    */
    public function unLike($id){
        $this->validate([
            'id'=>'required'
        ]);
        $unlike = PostLike::where('post_id', $id)
                            ->where('user_id', Auth::user()->id)
                            ->where('tenant_id',Auth::user()->tenant_id)->first();
        $unlike->delete();
    }

            /*
    * Approve request
    */
    public function approveRequest($id){

        $approve = ResponsiblePerson::where('post_id', $id)
                    ->where('user_id', Auth::user()->id)
                    ->where('tenant_id', Auth::user()->tenant_id)
                    ->first();
        $approve->status = 'approve';
        $approve->save();
        session()->flash("success", "<strong>Success!</strong> Your reaction to this request is taken.");

    }

    /*
    * Decline request
    */
    public function declineRequest($id){
        $decline = ResponsiblePerson::where('post_id', $id)
                    ->where('user_id', Auth::user()->id)
                    ->where('tenant_id',Auth::user()->tenant_id)
                    ->first();
        $decline->status = 'decline';
        $decline->save();
        session()->flash("success", "<strong>Success!</strong> Your reaction to this request is taken.");
    }

}
