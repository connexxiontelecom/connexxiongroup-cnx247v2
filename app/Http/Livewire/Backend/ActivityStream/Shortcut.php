<?php

namespace App\Http\Livewire\Backend\ActivityStream;
use Livewire\WithPagination;
use Livewire\Component;
//use App\Mail\RequisitionVerificationMail;
//use App\RequisitionVerification;
use App\Notifications\NewPostNotification;
use Carbon\Carbon;
use App\BusinessLog;
use App\Post;
use App\PostView;
use App\PostComment;
use App\PostLike;
use App\ResponsiblePerson;
use App\RequestApprover;
use App\User;
use Auth;
use Hash;

class Shortcut extends Component
{
    use WithPagination;
    //public $posts = [];
    public $ongoing, $following, $assisting, $set_by_me;
    public $birthdays;
    //public $events;
    public $verificationCode;
    public $actionStatus = 0;
    public $verificationPostId;
    //public $announcements = [];
    public $all_employees = true;
    public $compose_message;
    public $pId ;
    public $comment;
    public $likes;
    public $users = [];
    public $online;
    public $workforce;
    public $transactionPassword;
    public $userAction; //approved/declined
    public $onlineCounter = 0;
    public function render()
    {
        $now = Carbon::now();
        $events = Post::where('tenant_id', Auth::user()->tenant_id)
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
                                ->take(10)->get();
        $this->online = User::where('tenant_id', Auth::user()->tenant_id)->where('is_online', 1)->count();
        $this->workforce = User::where('tenant_id', Auth::user()->tenant_id)->count();
        return view('livewire.backend.activity-stream.shortcut',
                                ['posts'=> Post::where('tenant_id', Auth::user()->tenant_id)
                                ->orderBy('id', 'DESC')
                                ->paginate(10),
                    'announcements'=>Post::where('post_type', 'announcement')
                                ->where('tenant_id', Auth::user()->tenant_id)
                                ->orderBy('id', 'DESC')->take(5)->get(),
                                'events'=>$events
        ]);
    }

    public function mount(){
        $this->getContent();
    }
    /*
    * Get content
    */
    public function getContent(){
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
                $action = ResponsiblePerson::where('post_id', $id)->where('user_id', Auth::user()->id)->first();
                $action->status = $this->userAction;
                $action->save();
                //Register business process log
                $log = new BusinessLog;
                $log->request_id = $id;
                $log->user_id = Auth::user()->id;
                $log->name = $this->userAction;
                $log->note = str_replace('-', ' ',$details->post_type)." ".$this->userAction." by ".Auth::user()->first_name." ".Auth::user()->surname ?? " ";
                $log->save();
                $responsiblePersons = ResponsiblePerson::where('post_id', $id)
                                            ->get();
                $responsiblePersonIds = [];
                foreach($responsiblePersons as $per){
                   array_push($responsiblePersonIds, $per->user_id);
                }
                //search for processor
                $approvers = RequestApprover::where('request_type', $details->post_type)
                                            ->where('depart_id', $details->user->department_id)
                                            ->where('tenant_id', Auth::user()->tenant_id)
                                            ->get();
                $approverIds = [];
                if(!empty($approvers) ){
                    foreach($approvers as $approver){
                        array_push($approverIds, $approver->user_id);
                    }
                }
                $remainingProcessors = array_diff($approverIds,$responsiblePersonIds);
                //identify next supervisor
                $supervise = new BusinessLog;
                $supervise->request_id = $id;
                $supervise->user_id = Auth::user()->id;
                $supervise->name = 'Log entry';
                $supervise->note = "Identifying next processor for ".str_replace('-', ' ',$details->post_type).": ".$details->post_title;
                $supervise->save();
                //Assign next processor
                if(!empty($remainingProcessors) ){
                    $reset = array_values($remainingProcessors);
                    for($i = 0; $i<count($reset); $i++){
                        $next = new ResponsiblePerson;
                        $next->post_id = $id;
                        $next->post_type = $details->post_type;
                        $next->user_id = $reset[$i];
                        $next->tenant_id = Auth::user()->tenant_id;
                        $next->save();
                        $user = User::find($reset[$i]);
                        $user->notify(new NewPostNotification($details));
                    break;
                    }
                }else{
                    $status = Post::find($id);
                    $status->post_status = $this->userAction;
                    $status->save();
                    #Requisition to GL flow takes over from here
                }
                $this->actionStatus = 0;
                $this->verificationPostId = null;
                $this->getContent();
                session()->flash("done", "<p class='text-success text-center'>Request verified successfully.</p>");
            }else{
                $action = ResponsiblePerson::where('post_id', $id)->where('user_id', Auth::user()->id)->first();
                $action->status = $this->userAction;
                $action->save();
                //Register business process log
                $log = new BusinessLog;
                $log->request_id = $id;
                $log->user_id = Auth::user()->id;
                $log->name = $this->userAction;
                $log->note = str_replace('-', ' ',$details->post_type)." ".$this->userAction." by ".Auth::user()->first_name." ".Auth::user()->surname;
                $log->save();
                 //update request table finally
                 $status = Post::find($id);
                 $status->post_status = $this->userAction;
                 $status->save();
                    $this->actionStatus = 0;
                    $this->verificationPostId = null;
                    $this->getContent();
                    session()->flash("done", "<p class='text-success text-center'>Request verified successfully.</p>");
            }
        }else{
            session()->flash("error_code", "<strong>Ooops!</strong>  Mis-match transaction password. Try again. <small>You can set a new transaction password by following: Profile > Settings > Security.</small>");
        }

    }
}
