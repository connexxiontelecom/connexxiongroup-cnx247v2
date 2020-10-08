<?php

namespace App\Http\Controllers\CNX247\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Notifications\NewPostNotification;
use App\Post;
use App\PostView;
use App\PostAttachment;
use App\ResponsiblePerson;
use App\Participant;
use App\Invitation;
use App\Clocker as ClockInOut;
use App\Observer;
use App\User;
use DB;
use Auth;

class ActivityStreamController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /*
    * Load activity stream index page
    */
    public function index(){

        return view('backend.activity-stream.index');
    }

    /*
    * Send message
    */
    public function sendMessage(Request $request){
        $this->validate($request,[
            'message'=>'required'
        ]);
        $message = new Post;
        $message->post_content = $request->message;
        $message->user_id = Auth::user()->id;
        $message->post_url = substr(sha1(time()),10,10);
        $message->post_type = 'message';
        $message->tenant_id = Auth::user()->tenant_id;
        $message->save();
        $message_id = $message->id;
        //notify
        $user = $message->user;
        $user->notify(new NewPostNotification($message));

        if(!empty($request->file('attachment'))){
            $extension = $request->file('attachment');
            $extension = $request->file('attachment')->getClientOriginalExtension(); // getting excel extension
            $dir = 'assets/uploads/attachments/';
            $filename = 'message_'.uniqid().'_'.time().'_'.date('Ymd').'.'.$extension;
            $request->file('attachment')->move(public_path($dir), $filename);
        }else{
            $filename = '';
        }
        if($request->target == 1){
            foreach(json_decode($request->message_persons) as $person){
                $receiver = new ResponsiblePerson;
                $receiver->user_id = $person;
                $receiver->post_id = $message_id;
                $receiver->post_type = 'message';
                $receiver->tenant_id = Auth::user()->tenant_id;
                $receiver->save();
                $user = User::find($person);
                $user->notify(new NewPostNotification($message));

            }
        }else if($request->target == 0){
            $receiver = new ResponsiblePerson;
            $receiver->user_id = 32; //a
            $receiver->post_id = $message_id;
            $receiver->post_type = 'message';
            $receiver->tenant_id = Auth::user()->tenant_id;
            $receiver->save();
        }
        if(!empty($request->file('attachment'))){
            $attach = new PostAttachment;
            $attach->post_id = $message_id;
            $attach->user_id = Auth::user()->id;
            $attach->attachment = $filename;
            $attach->tenant_id = Auth::user()->tenant_id;
            $attach->save();
        }
        if($message ){
            return response()->json(['message'=>'Success! Message sent.'], 200);
        }else{
            return response()->json(['error'=>'Ooops! Message sent.'], 400);
        }


    }

    public function postView(Request $request){
        $this->validate($request,[
            'live'=>'required'
        ]);
        $post = PostView::where('tenant_id', Auth::user()->tenant_id)
                        ->where('post_id', $request->live)
                        ->where('user_id', Auth::user()->id)
                        ->first();
        if(empty($post)){
            $view = new PostView;
            $view->user_id = Auth::user()->id;
            $view->tenant_id = Auth::user()->tenant_id;
            $view->post_id = $request->live;
            $view->save();
        }
    }

    public function viewPost($slug){
        return view('backend.activity-stream.view-post');
    }
    /*
    * Create task
    */


    /*
    * Create event
    */
    public function createEvent(Request $request){
        $this->validate($request, [
            'event_name'=>'required',
            'attendees'=>'required',
            'event_description'=>'required',
            'event_start_date'=>'required|date',
            'event_end_date'=>'required|date|after_or_equal:event_start_date'
        ]);
        $url = substr(sha1(time()), 10, 10);
        $event = new Post;
        $event->post_title = $request->event_name;
        $event->user_id = Auth::user()->id;
        $event->post_content = $request->event_description;
        $event->post_type = 'event';
        $event->post_url = $url;
        $event->tenant_id = Auth::user()->tenant_id;
        $event->start_date = $request->event_start_date ?? '';
        $event->end_date = $request->event_end_date ?? '';
        $event->save();
        $event_id = $event->id;
        //send notification
        $user = $event->user;
        $user->notify(new NewPostNotification($event));
        //responsible persons
        if($request->target == 0){
            $part = new ResponsiblePerson;
            $part->post_id = $event_id;
            $part->post_type = 'event';
            $part->user_id = 32;
            $part->tenant_id = Auth::user()->tenant_id;
            $part->save();
        }else{
            if(!empty(json_decode($request->attendees))){
                foreach(json_decode($request->attendees) as $attendee){

                   /*  $user = User::select('first_name', 'surname', 'email', 'id')->where('id', $participant)->first();
                    \Mail::to($user->email)->send(new MailTask($user, $request, $url)); */
                    $part = new ResponsiblePerson;
                    $part->post_id = $event_id;
                    $part->post_type = 'event';
                    $part->user_id = $attendee;
                    $part->tenant_id = Auth::user()->tenant_id;
                    $part->save();
                    //send notification
                    $user = User::find($attendee);
                    $user->notify(new NewPostNotification($event));
                }
            }
        }
        if($event){
            return response()->json(['message'=>'Success! Event registered.'], 200);
        }else{
            return response()->json(['error'=>'Success! Ooops! Something went wrong. Try again.'], 400);

        }
    }

    /*
    * Create announcement
    */
    public function createAnnouncement(Request $request){
        $this->validate($request, [
            'subject'=>'required',
            'content'=>'required'
        ]);
        if(!empty($request->file('attachment'))){
            $extension = $request->file('attachment');
            $extension = $request->file('attachment')->getClientOriginalExtension(); // getting excel extension
            $dir = 'assets/uploads/attachments/';
            $filename = 'announcement_'.uniqid().'_'.time().'_'.date('Ymd').'.'.$extension;
            $request->file('attachment')->move(public_path($dir), $filename);
        }else{
            $filename = '';
        }

        $url = substr(sha1(time()), 10, 10);
        $announcement = new Post;
        $announcement->post_title = $request->subject;
        $announcement->user_id = Auth::user()->id;
        $announcement->tenant_id = Auth::user()->tenant_id;
        $announcement->post_content = $request->content;
        $announcement->post_type = 'announcement';
        $announcement->post_url = $url;
        $announcement->save();
        $announcement_id = $announcement->id;
        //notify
        $user = $announcement->user;
        $user->notify(new NewPostNotification($announcement));
        //save attachment
        if(!empty($request->file('attachment'))){
            $attach = new PostAttachment;
            $attach->post_id = $announcement_id;
            $attach->user_id = Auth::user()->id;
            $attach->tenant_id = Auth::user()->tenant_id;
            $attach->attachment = $filename;
            $attach->save();
        }
        //responsible persons
        if($request->target == 0){
            $part = new ResponsiblePerson;
            $part->post_id = $announcement_id;
            $part->post_type = 'announcement';
            $part->user_id = 32;
            $part->tenant_id = Auth::user()->tenant_id;
            $part->save();
        }else{
            foreach(json_decode($request->to) as $person){

               /*  $user = User::select('first_name', 'surname', 'email', 'id')->where('id', $participant)->first();
                \Mail::to($user->email)->send(new MailTask($user, $request, $url)); */
                $part = new ResponsiblePerson;
                $part->post_id = $announcement_id;
                $part->post_type = 'announcement';
                $part->user_id = $person;
                $part->tenant_id = Auth::user()->tenant_id;
                $part->save();
                //send notification
                $user = User::find($person);
                $user->notify(new NewPostNotification($announcement));
            }
        }
        if($announcement){
            return response()->json(['message'=>'Success!'], 200);
        }else{
            return response()->json(['error'=>'Ooops! Something went wrong. Try again.'], 400);
        }
    }

    /*
    * Share file within the activity stream
    */
    public function shareFile(Request $request){
        $this->validate($request, [
            'attachment'=>'required'
        ]);
        if(!empty($request->file('attachment'))){
            $extension = $request->file('attachment');
            $extension = $request->file('attachment')->getClientOriginalExtension(); // getting excel extension
            $dir = 'assets/uploads/attachments/';
            $filename = 'file_'.uniqid().'_'.time().'_'.date('Ymd').'.'.$extension;
            $request->file('attachment')->move(public_path($dir), $filename);
        }else{
            $filename = '';
        }

        $url = substr(sha1(time()), 10, 10);
        $file = new Post;
        $file->post_title = $request->file_name;
        $file->user_id = Auth::user()->id;
        $file->tenant_id = Auth::user()->tenant_id;
        $file->post_content = Auth::user()->first_name.' '.Auth::user()->surname.' shared a file titled <strong>'.$request->file_name.' </strong>.';
        $file->post_type = 'file';
        $file->post_url = $url;
        $file->save();
        $file_id = $file->id;
        if(!empty($request->file('attachment'))){
            $attach = new PostAttachment;
            $attach->post_id = $file_id;
            $attach->user_id = Auth::user()->id;
            $attach->tenant_id = Auth::user()->tenant_id;
            $attach->attachment = $filename;
            $attach->save();
        }
        //responsible persons
        if($request->target == 0){
            $part = new ResponsiblePerson;
            $part->post_id = $file_id;
            $part->post_type = 'file';
            $part->user_id = 32;
            $part->tenant_id = Auth::user()->tenant_id;
            $part->save();
        }else{
            foreach(json_decode($request->share_with) as $person){

               /*  $user = User::select('first_name', 'surname', 'email', 'id')->where('id', $participant)->first();
                \Mail::to($user->email)->send(new MailTask($user, $request, $url)); */
                $part = new ResponsiblePerson;
                $part->post_id = $file_id;
                $part->post_type = 'file';
                $part->user_id = $person;
                $part->tenant_id = Auth::user()->tenant_id;
                $part->save();
                //send notification
                $user = User::find($person);
                $user->notify(new NewPostNotification($announcement));
            }
        }
        if($file){
            return response()->json(['message'=>'Success! File shared.'], 200);
        }else{
            return response()->json(['error'=>'Ooops! Something went wrong. Try again.'], 400);
        }
    }

    /*
    * Create appreciation
    */
    public function createAppreciation(Request $request){
        $this->validate($request, [
            'content'=>'required',
            'persons'=>'required'
        ]);

        $url = substr(sha1(time()), 10, 10);
        $app = new Post;
        $app->user_id = Auth::user()->id;
        $app->post_title = Auth::user()->first_name." ".Auth::user()->surname." sent in appreciation.";
        $app->post_content = $request->content;
        $app->post_type = 'appreciation';
        $app->post_url = $url;
        $app->tenant_id = Auth::user()->tenant_id;
        $app->save();
        $app_id = $app->id;
        if($request->target == 0){
            $part = new ResponsiblePerson;
            $part->post_id = $app_id;
            $part->post_type = 'appreciation';
            $part->user_id = 32;
            $part->tenant_id = Auth::user()->tenant_id;
            $part->save();
        }else{
            //responsible persons
            if(!empty(json_decode($request->persons))){
                foreach(json_decode($request->persons) as $person){
                    $part = new ResponsiblePerson;
                    $part->post_id = $app_id;
                    $part->post_type = 'appreciation';
                    $part->user_id = $person;
                    $part->tenant_id = Auth::user()->tenant_id;
                    $part->save();
                     //send notification
                     $user = User::find($person);
                     $user->notify(new NewPostNotification($app));
                }
            }
        }
        if($app){
            return response()->json(['message'=>'Success! Appreciation sent.'], 200);
        }else{
            return response()->json(['error'=>'Ooops! Something went wrong. Try again.'], 400);
        }
    }

    /*
    * Send invitation by email
    */
    public function inviteUser(Request $request){
        $this->validate($request,[
            'email'=>'required'
        ]);

            $invite = new Invitation;
            $invite->email = $request->email;
            $invite->first_name = $request->first_name;
            $invite->tenant_id = Auth::user()->tenant_id;
            $invite->url = config('app.url')."token/".sha1(time());
            $invite->status = 0;
            $invite->message = $request->message ?? "You're invited by ".Auth::user()->first_name." ".Auth::user()->surname." to join ".config('app.name');
            $invite->save();
            if($invite){
                return response()->json(['message'=>'Success! Invitation sent.'],200);
            }else{
                return response()->json(['error'=>'Ooops! Something went wrong.'],400);
            }
    }

    /*
    * View profile
    */
    public function viewProfile($url){

        $user = User::where('url', $url)->where('tenant_id', Auth::user()->tenant_id)->first();
      return view('backend.activity-stream.view-employee-profile', ['user'=>$user]);
    }

    public function clockin(){
        //register in DB
         $in = new ClockInOut;
        $in->user_id = Auth::user()->id;
        $in->clock_in = now();
        $in->tenant_id = Auth::user()->tenant_id;
        $in->status = 1; //in
        $in->save();
        return response()->json(['message'=>'Success! Clocked-in'], 200);
    }
    /*
    * Clock out method
    */
    public function clockout(){
        //register in DB
        $out = ClockInOut::where('user_id', Auth::user()->id)->orderBy('id', 'DESC')
                           ->where('tenant_id',Auth::user()->tenant_id)->first();
        $out->clock_out = now();
        $out->tenant_id = Auth::user()->tenant_id;
        $out->status = 2; //out
        $out->save();
        return response()->json(['message'=>'Success! Clocked-out'], 200);
    }
}
