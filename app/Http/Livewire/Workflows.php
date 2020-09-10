<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Carbon\Carbon;
use App\Mail\RequisitionVerificationMail;
use App\RequisitionVerification;
use App\Post;
use App\ResponsiblePerson;
use App\BusinessLog;
use App\User;
use Auth;

class Workflows extends Component
{
    public $requests;
    public $verificationCode;
    public $actionStatus = 0;
    public $verificationPostId;
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
        $now = Carbon::now()->format('Y-m-d H:i');
        $approve = ResponsiblePerson::where('post_id', $id)
                    ->where('user_id', Auth::user()->id)
                    ->where('tenant_id', Auth::user()->tenant_id)
                    ->first();
        $request = Post::where('tenant_id', Auth::user()->tenant_id)
                        ->where('id', $id)
                        ->first();
        if(!empty($approve) ){
            $code = strtoupper(substr(sha1(time()),32,40));
            $verify = new RequisitionVerification;
            $verify->post_id = $id;
            $verify->tenant_id = Auth::user()->tenant_id;
            $verify->processor_id = Auth::user()->id;
            $verify->expires = now(); //$now->addHours(2);
            $verify->code = $code;
            $verify->action = 'approved';
            $verify->save();
            #mail
            \Mail::to($approve->user->email)->send(new RequisitionVerificationMail($approve->user, $request, $code));
        }
        $this->actionStatus = 1;
        $this->verificationPostId = $id;
        session()->flash("success_code", "<strong>Success!</strong> We just sent verification code to your registered email.");

    }

    /*
    * Decline request
    */
    public function declineRequest($id){
            $now = Carbon::now()->format('Y-m-d H:i');
            $decline = ResponsiblePerson::where('post_id', $id)
                        ->where('user_id', Auth::user()->id)
                        ->where('tenant_id', Auth::user()->tenant_id)
                        ->first();
            $request = Post::where('tenant_id', Auth::user()->tenant_id)
                        ->where('id', $id)
                        ->first();
            if(!empty($decline) ){
                $code = strtoupper(substr(sha1(time()),32,40));
                $verify = new RequisitionVerification;
                $verify->post_id = $id;
                $verify->tenant_id = Auth::user()->tenant_id;
                $verify->processor_id = Auth::user()->id;
                $verify->expires = now(); //$now->addHours(2);
                $verify->code = $code;
                $verify->action = 'declined';
                $verify->save();
            }
            \Mail::to($decline->user->email)->send(new RequisitionVerificationMail($decline->user, $request, $code));
            $this->actionStatus = 1;
            $this->verificationPostId = $id;
            session()->flash("success_code", "<strong>Success!</strong> We just sent verification code to your registered email.");
    }

    public function verifyCode($id){
        $verify = RequisitionVerification::where('post_id', $id)
                    ->where('processor_id', Auth::user()->id)
                    ->where('tenant_id', Auth::user()->tenant_id)
                    ->where('status', 0)//in-progress
                    ->where('code', $this->verificationCode)//in-progress
                    ->first();
        if(!empty($verify) ){
            if($verify->code === $this->verificationCode){
                $details = Post::find($id);
                $verifyStatus = $verify->action;
                if($verifyStatus == 'approved'){
                    $action = ResponsiblePerson::where('post_id', $id)->where('user_id', Auth::user()->id)->first();
                    $action->status = $verifyStatus;
                    $action->save();
                    //Register business process log
                    $log = new BusinessLog;
                    $log->request_id = $id;
                    $log->user_id = Auth::user()->id;
                    $log->name = $verifyStatus;
                    $log->note = str_replace('-', ' ',$details->post_type)." ".$verifyStatus." by ".Auth::user()->first_name." ".Auth::user()->surname;
                    $log->save();
                    //search for supervisor
                    $find = ResponsiblePerson::select('user_id')
                                            ->where('post_id', $id)
                                            ->where('status','in-progress')
                                            ->first();
                    //identify next supervisor
                    $supervise = new BusinessLog;
                    $supervise->request_id = $id;
                    $supervise->user_id = Auth::user()->id;
                    $supervise->name = 'Log entry';
                    $supervise->note = "Identifying next supervisor for ".str_replace('-', ' ',$details->post_type).": ".$details->post_title;
                    $supervise->save();
                        if(!empty($find)){
                            //identify supervisor
                            $supervise = new BusinessLog;
                            $supervise->request_id = $id;
                            $supervise->user_id = Auth::user()->id;
                            $supervise->name = 'Log entry';
                            $supervise->note = "New supervisor identified for ".str_replace('-', ' ',$details->post_type)." ".$details->post_title;
                            $supervise->save();
                        }else{
                            //there's no more supervisor
                            $supervise = new BusinessLog;
                            $supervise->request_id = $id;
                            $supervise->user_id = Auth::user()->id;
                            $supervise->name = 'Log entry';
                            $supervise->note = "There're no more supervisors for ".str_replace('-', ' ',$details->post_type)." ".$details->post_title;
                            $supervise->save();
                            //update request table finally
                            $status = Post::find($id);
                            $status->post_status = $verifyStatus;
                            $status->save();
                        }
                        $this->actionStatus = 0;
                        $this->verificationPostId = null;
                        $this->getContent();
                        session()->flash("done", "<p class='text-success text-center'>Request verified successfully.</p>");
                }else{
                    $action = ResponsiblePerson::where('post_id', $id)->where('user_id', Auth::user()->id)->first();
                    $action->status = $verifyStatus;
                    $action->save();
                    //Register business process log
                    $log = new BusinessLog;
                    $log->request_id = $id;
                    $log->user_id = Auth::user()->id;
                    $log->name = $verifyStatus;
                    $log->note = str_replace('-', ' ',$details->post_type)." ".$verifyStatus." by ".Auth::user()->first_name." ".Auth::user()->surname;
                    $log->save();
                     //update request table finally
                     $status = Post::find($id);
                     $status->post_status = $verifyStatus;
                     $status->save();
                        $this->actionStatus = 0;
                        $this->verificationPostId = null;
                        $this->getContent();
                        session()->flash("done", "<p class='text-success text-center'>Request verified successfully.</p>");
                }
            }else{
                session()->flash("error_code", "<strong>Ooops! Authentication code mis-match. Try again.</strong>");
            }
        }else{
            session()->flash("error_code", "<strong>Ooops! There's no authentication code for this request.</strong>");
        }

    }
}
