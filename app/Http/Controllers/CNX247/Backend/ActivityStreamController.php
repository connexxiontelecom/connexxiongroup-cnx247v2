<?php

namespace App\Http\Controllers\CNX247\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Notifications\NewPostNotification;
use App\Post;
use App\PostAttachment;
use App\ResponsiblePerson;
use App\Participant;
use App\Invitation;
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
        //return response()->json($request->message_persons);
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

/*      $files = null;
        $paths = [];
        if(!empty($request->file('attachment')) ){
            $files = $request->file('attachment');
            foreach($files as $file){
                $extension = $file->getClientOriginalExtension();
                $file_name = 'message_'.time().'.'.$extension;
                $paths[] = $file->storeAs('post-attachments', $file_name);
                //database record
                $attach = new PostAttachment;
                $attach->post_id = $message_id;
                $attach->user_id = Auth::user()->id;
                $attach->file_name = $filename;
                $attach->save();
            }

        } */
            foreach(json_decode($request->message_persons) as $person){
                $receiver = new ResponsiblePerson;
                $receiver->user_id = $person;
                $receiver->post_id = $message_id;
                $receiver->tenant_id = Auth::user()->tenant_id;
                $receiver->save();
                //notification
                $user = User::find($person);
                $user->notify(new NewPostNotification($message));

            }
            /* foreach($message->responsiblePersons as $per){
                $per
            } */
            //save attachment
            if(!empty($request->file('attachment'))){
                $attach = new PostAttachment;
                $attach->post_id = $message_id;
                $attach->user_id = Auth::user()->id;
                $attach->attachment = $filename;
                $attach->tenant_id = Auth::user()->tenant_id;
                $attach->save();
            }

        return response()->json(['message'=>'Success! Message sent.']);
    }



        /*
    * Create task
    */
    public function createTask(Request $request){
        //return dd($this->responsible_persons);
        $this->validate($request, [
            'task_title'=>'required',
            'responsible_persons'=>'required',
            'task_description'=>'required',
            'due_date'=>'required'
        ]);

         if(!empty($request->file('attachment'))){
            $extension = $request->file('attachment');
            $extension = $request->file('attachment')->getClientOriginalExtension(); // getting excel extension
            $dir = 'assets/uploads/attachments/';
            $filename = 'task_'.uniqid().'_'.time().'_'.date('Ymd').'.'.$extension;
            $request->file('attachment')->move(public_path($dir), $filename);
        }else{
            $filename = '';
        }
        $url = substr(sha1(time()), 10, 10);
        $task = new Post;
        $task->post_title = $request->task_title;
        $task->user_id = Auth::user()->id;
        $task->post_content = $request->task_description;
        $task->post_color = $request->color;
        $task->post_type = 'task';
        $task->post_url = $url;
        $task->start_date = $request->start_date ?? '';
        $task->end_date = $request->due_date;
        $task->post_priority = $request->priority;
        $task->tenant_id = Auth::user()->tenant_id;
        $task->save();
        $task_id = $task->id;
        //notify
        $user = $task->user;
        $user->notify(new NewPostNotification($task));
          //save attachment
          if(!empty($request->file('attachment'))){
            $attach = new PostAttachment;
            $attach->post_id = $task_id;
            $attach->user_id = Auth::user()->id;
            $attach->attachment = $filename;
            $attach->tenant_id = Auth::user()->tenant_id;
            $attach->save();
        }

        //responsible persons
        if(!empty(json_decode($request->responsible_persons))){
            foreach(json_decode($request->responsible_persons) as $person){

               /*  $user = User::select('first_name', 'surname', 'email', 'id')->where('id', $participant)->first();
                \Mail::to($user->email)->send(new MailTask($user, $request, $url)); */
                $part = new ResponsiblePerson;
                $part->post_id = $task_id;
                $part->user_id = $person;
                $part->tenant_id = Auth::user()->tenant_id;
                $part->save();
                //send notification
                $user = User::find($person);
                $user->notify(new NewPostNotification($task));
            }
        }
        //participants
        if(!empty(json_decode($request->participants))){
            foreach(json_decode($request->participants) as $participant){

               /*  $user = User::select('first_name', 'surname', 'email', 'id')->where('id', $participant)->first();
                \Mail::to($user->email)->send(new MailTask($user, $request, $url)); */
                $part = new Participant;
                $part->post_id = $task_id;
                $part->user_id = $participant;
                $part->tenant_id = Auth::user()->tenant_id;
                $part->save();
            }
        }
        //observers
        if(!empty(json_decode($request->observers))){
            foreach(json_decode($request->observers) as $observer){

               /*  $user = User::select('first_name', 'surname', 'email', 'id')->where('id', $participant)->first();
                \Mail::to($user->email)->send(new MailTask($user, $request, $url)); */
                $part = new Observer;
                $part->post_id = $task_id;
                $part->user_id = $observer;
                $part->tenant_id = Auth::user()->tenant_id;
                $part->save();
            }
        }
        return response()->json(['message'=>'Success!'], 200);
    }

    /*
    * Create event
    */
    public function createEvent(Request $request){
        //return dd($this->responsible_persons);
        $this->validate($request, [
            'event_name'=>'required',
            'attendees'=>'required',
            'event_description'=>'required',
            'event_start_date'=>'required'
        ]);
        $url = substr(sha1(time()), 10, 10);
        $event = new Post;
        $event->post_title = $request->event_name;
        $event->user_id = Auth::user()->id;
        $event->post_content = $request->event_description;
        $event->post_type = 'event';
        $event->post_url = $url;
        $event->start_date = $request->event_start_date ?? '';
        $event->end_date = $request->event_end_date ?? '';
        $event->save();
        $event_id = $event->id;
        //send notification
        $user = $event->user;
        $user->notify(new NewPostNotification($event));
        //responsible persons
        if(!empty(json_decode($request->attendees))){
            foreach(json_decode($request->attendees) as $attendee){

               /*  $user = User::select('first_name', 'surname', 'email', 'id')->where('id', $participant)->first();
                \Mail::to($user->email)->send(new MailTask($user, $request, $url)); */
                $part = new ResponsiblePerson;
                $part->post_id = $event_id;
                $part->user_id = $attendee;
                $part->save();
                //send notification
                $user = User::find($attendee);
                $user->notify(new NewPostNotification($event));
            }
        }
        return response()->json(['message'=>'Success!'], 200);
    }

    /*
    * Create announcement
    */
    public function createAnnouncement(Request $request){
        //return dd($this->responsible_persons);
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
            $attach->attachment = $filename;
            $attach->save();
        }
        //responsible persons
        if(!empty(json_decode($request->to))){
            foreach(json_decode($request->to) as $person){

               /*  $user = User::select('first_name', 'surname', 'email', 'id')->where('id', $participant)->first();
                \Mail::to($user->email)->send(new MailTask($user, $request, $url)); */
                $part = new ResponsiblePerson;
                $part->post_id = $announcement_id;
                $part->user_id = $person;
                $part->save();
                //send notification
                $user = User::find($person);
                $user->notify(new NewPostNotification($announcement));
            }
        }
        return response()->json(['message'=>'Success!'], 200);
    }

    /*
    * Share file within the activity stream
    */
    public function shareFile(Request $request){
        $this->validate($request,[
            'attachment.*'=>'required'
        ]);
        if(!empty($request->file('attachment'))){
            foreach ($request->file('attachment') as $file) {
                dump($file);
               /*  $extension = $file;
                $extension = $file->getClientOriginalExtension();
                $dir = 'assets/uploads/attachments/';
                $filename = 'file_'.uniqid().'_'.time().'_'.date('Ymd').'.'.$extension;
                $file->move(public_path($dir), $filename); */
            }
        }
        /* if(!empty($request->file('attachment'))){
            $extension = $request->file('attachment');
            $extension = $request->file('attachment')->getClientOriginalExtension(); // getting excel extension
            $dir = 'assets/uploads/attachments/';
            $filename = 'announcement_'.uniqid().'_'.time().'_'.date('Ymd').'.'.$extension;
            $request->file('attachment')->move(public_path($dir), $filename);
        }else{
            $filename = '';
        }  */
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
        $app->post_content = $request->content;
        $app->post_type = 'appreciation';
        $app->post_url = $url;
        $app->save();
        $app_id = $app->id;
        //notify
        $user = $app->user;
        $user->notify(new NewPostNotification($app));
        //responsible persons
        if(!empty(json_decode($request->persons))){
            foreach(json_decode($request->persons) as $person){
                $part = new ResponsiblePerson;
                $part->post_id = $app_id;
                $part->user_id = $person;
                $part->save();
                 //send notification
                 $user = User::find($person);
                 $user->notify(new NewPostNotification($app));
            }
        }
        return response()->json(['message'=>'Success!'], 200);
    }

    /*
    * Send invitation by email
    */
    public function sendInvitationByEmail(Request $request){
        $this->validate($request,[
            'emails'=>'required'
        ]);
        $emails = explode(",", $request->emails);
        //return response()->json(['message'=>$emails]);
        foreach ($emails as $mail) {
            $invite = new Invitation;
            $invite->email = $mail;
            $invite->url = config('app.url')."token/".sha1(time());
            $invite->status = 0;
            $invite->message = $request->message ?? "You're invited by ".Auth::user()->first_name." ".Auth::user()->surname." to join ".config('app.name');
            $invite->save();
        }
        return response()->json(['message'=>'Success!']);
    }

    /*
    * View profile
    */
    public function viewProfile($url){
        $user = User::where('url', $url)->where('tenant_id', Auth::user()->tenant_id)->first();
      return view('backend.activity-stream.view-employee-profile', ['user'=>$user]);
    }
}
