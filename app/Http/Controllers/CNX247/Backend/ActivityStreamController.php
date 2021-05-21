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
use App\ApplicationLog;
use DateTime;
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
					#Log
					$message = Auth::user()->first_name." ".Auth::user()->surname." sent a message.";
					$log = new ApplicationLog;
					$log->tenant_id = Auth::user()->tenant_id;
					$log->activity = $message;
					$log->user_id = Auth::user()->id;
					$log->save();

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
                $rec = User::find($person);
								$rec->notify(new NewPostNotification($message));
								$body = "New Message";
								$title = "You have a new Message";
								$this->ToSpecificUser(Auth::user()->tenant_id, $title, $body,$person);

            }
        }else if($request->target == 0){
            $receiver = new ResponsiblePerson;
            $receiver->user_id = 32; //a
            $receiver->post_id = $message_id;
            $receiver->post_type = 'message';
            $receiver->tenant_id = Auth::user()->tenant_id;
						$receiver->save();

						$body = "New Message";
						$title = "You have a new Message";
						$this->ToAllUsers( Auth::user()->tenant_id, $title, $body);
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
						#Log
						$message = Auth::user()->first_name." ".Auth::user()->surname." viewed a post on activity stream.";
						$log = new ApplicationLog;
						$log->tenant_id = Auth::user()->tenant_id;
						$log->activity = $message;
						$log->user_id = Auth::user()->id;
						$log->save();
        }
    }

    public function viewPost($slug){
				#log
				$message = Auth::user()->first_name." ".Auth::user()->surname." opened a post on activity stream.";
				$log = new ApplicationLog;
				$log->tenant_id = Auth::user()->tenant_id;
				$log->activity = $message;
				$log->user_id = Auth::user()->id;
				$log->save();
        return view('backend.activity-stream.view-post');
    }

/*
    * store new task
    */
    public function storeTask(Request $request){

        $this->validate($request, [
            'task_title'=>'required',
            'responsible_persons'=>'required',
            'task_description'=>'required',
            'start_date'=>'required|date',
            'due_date'=>'required|date|after_or_equal:start_date'
        ]);

        $url = substr(sha1(time()), 10, 10);
        $task = new Post;
        $task->post_title = $request->task_title;
        $task->user_id = Auth::user()->id;
        $task->post_content = $request->task_description;
        $task->post_color = $request->color;
        $task->post_type = 'task';
				$task->post_url = $url;

				$startDateInstance = new DateTime($request->start_date);
				$task->start_date = $startDateInstance->format('Y-m-d H:i:s');

					$dueDateInstance = new DateTime($request->due_date);
				$task->end_date = $dueDateInstance->format('Y-m-d H:i:s');


        $task->post_priority = $request->priority;
        $task->tenant_id = Auth::user()->tenant_id;
				$task->save();
				#log
				$message = Auth::user()->first_name." ".Auth::user()->surname." created a task.";
				$log = new ApplicationLog;
				$log->tenant_id = Auth::user()->tenant_id;
				$log->activity = $message;
				$log->user_id = Auth::user()->id;
				$log->save();

        $task_id = $task->id;
        if(!empty($request->file('attachment'))){
            $extension = $request->file('attachment');
            $extension = $request->file('attachment')->getClientOriginalExtension(); // getting excel extension
            $dir = 'assets/uploads/attachments/';
            $filename = 'task_'.uniqid().'_'.time().'_'.date('Ymd').'.'.$extension;
            $request->file('attachment')->move(public_path($dir), $filename);
        }else{
            $filename = '';
        }
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
            foreach(json_decode($request->responsible_persons) as $participant){
               /*  $user = User::select('first_name', 'surname', 'email', 'id')->where('id', $participant)->first();
                \Mail::to($user->email)->send(new MailTask($user, $request, $url)); */
                $part = new ResponsiblePerson;
                $part->post_id = $task_id;
                $part->post_type = 'task';
                $part->user_id = $participant;
                $part->tenant_id = Auth::user()->tenant_id;
                $part->save();
                $user = User::find($participant);
								$user->notify(new NewPostNotification($task));

								$body = "New Task";
								$title = "You have a new Task";
								$this->ToSpecificUser(Auth::user()->tenant_id, $title, $body,$participant);
            }
        }
        //participants
        if(!empty(json_decode($request->participants))){
            foreach(json_decode($request->participants) as $person){
               /*  $user = User::select('first_name', 'surname', 'email', 'id')->where('id', $participant)->first();
                \Mail::to($user->email)->send(new MailTask($user, $request, $url)); */
                $part = new Participant;
                $part->post_id = $task_id;
                $part->post_type = 'task';
                $part->user_id = $person;
                $part->tenant_id = Auth::user()->tenant_id;
                $part->save();
            }
        }
        //observers
        if(!empty(json_decode($request->observers))){
            foreach(json_decode($request->observers) as $observe){
               /*  $user = User::select('first_name', 'surname', 'email', 'id')->where('id', $participant)->first();
                \Mail::to($user->email)->send(new MailTask($user, $request, $url)); */
                $part = new Observer;
                $part->post_id = $task_id;
                $part->post_type = 'task';
                $part->user_id = $observe;
                $part->tenant_id = Auth::user()->tenant_id;
                $part->save();
            }
        }
        return response()->json(['message'=>'Success! Task created.'], 200);
    }
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

				$startDateInstance = new DateTime($request->event_start_date);
				$event->start_date = $startDateInstance->format('Y-m-d H:i:s');

					$dueDateInstance = new DateTime($request->event_end_date);
				$event->end_date = $dueDateInstance->format('Y-m-d H:i:s');

				$event->save();
				#log
				$message = Auth::user()->first_name." ".Auth::user()->surname." created an event.";
				$log = new ApplicationLog;
				$log->tenant_id = Auth::user()->tenant_id;
				$log->activity = $message;
				$log->user_id = Auth::user()->id;
				$log->save();
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

						$body = "New Event";
						$title = "You have a new Event";
						$this->ToAllUsers( Auth::user()->tenant_id, $title, $body);

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
										$body = "New Event";
										$title = "You have a new Event";
										$this->ToSpecificUser(Auth::user()->tenant_id, $title, $body,$attendee);
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
				#log
				$message = Auth::user()->first_name." ".Auth::user()->surname." created an announcement.";
				$log = new ApplicationLog;
				$log->tenant_id = Auth::user()->tenant_id;
				$log->activity = $message;
				$log->user_id = Auth::user()->id;
				$log->save();

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

						$body = "New Announcement";
						$title = "You have a new Announcement";
						$this->ToAllUsers( Auth::user()->tenant_id, $title, $body);
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

								$body = "New Announcement";
								$title = "You have a new Announcement";
								$this->ToSpecificUser(Auth::user()->tenant_id, $title, $body,$person);
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
				#log
				$message = Auth::user()->first_name." ".Auth::user()->surname." shared file.";
				$log = new ApplicationLog;
				$log->tenant_id = Auth::user()->tenant_id;
				$log->activity = $message;
				$log->user_id = Auth::user()->id;
				$log->save();

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

						$body = "New Shared File";
						$title = "You have a new Shared File";
						$this->ToAllUsers( Auth::user()->tenant_id, $title, $body);

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
								$user->notify(new NewPostNotification($file));
								$body = "New Shared File";
								$title = "You have a new Shared File";
								$this->ToSpecificUser(Auth::user()->tenant_id, $title, $body,$person);


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
				#log
				$message = Auth::user()->first_name." ".Auth::user()->surname." sent out an appreciation.";
				$log = new ApplicationLog;
				$log->tenant_id = Auth::user()->tenant_id;
				$log->activity = $message;
				$log->user_id = Auth::user()->id;
				$log->save();

        $app_id = $app->id;
        if($request->target == 0){
            $part = new ResponsiblePerson;
            $part->post_id = $app_id;
            $part->post_type = 'appreciation';
            $part->user_id = 32;
            $part->tenant_id = Auth::user()->tenant_id;
						$part->save();

						$body = "New Appreciation";
						$title = Auth::user()->first_name." ".Auth::user()->surname." sent in appreciation.";
						$this->ToAllUsers( Auth::user()->tenant_id, $title, $body);

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

										 $body = "New Appreciation";
										 $title = Auth::user()->first_name." ".Auth::user()->surname." sent in appreciation.";
										 $this->ToSpecificUser(Auth::user()->tenant_id, $title, $body,$person);
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
        if(!empty($user)){
					#log
						$message = Auth::user()->first_name." ".Auth::user()->surname." viewed ".$user->first_name." ".$user->surname."'s profile.";
						$log = new ApplicationLog;
						$log->tenant_id = Auth::user()->tenant_id;
						$log->activity = $message;
						$log->user_id = Auth::user()->id;
						$log->save();
            return view('backend.activity-stream.view-employee-profile', ['user'=>$user]);
        }else{
            return back();
        }
    }

    public function clockin(){
        //register in DB
         $in = new ClockInOut;
        $in->user_id = Auth::user()->id;
        $in->clock_in = now();
        $in->tenant_id = Auth::user()->tenant_id;
        $in->status = 1; //in
				$in->save();
				#log
				$message = Auth::user()->first_name." ".Auth::user()->surname." clocked in";
				$log = new ApplicationLog;
				$log->tenant_id = Auth::user()->tenant_id;
				$log->activity = $message;
				$log->user_id = Auth::user()->id;
				$log->save();
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
				#log
				$message = Auth::user()->first_name." ".Auth::user()->surname." logged out.";
				$log = new ApplicationLog;
				$log->tenant_id = Auth::user()->tenant_id;
				$log->activity = $message;
				$log->user_id = Auth::user()->id;
				$log->save();
        return response()->json(['message'=>'Success! Clocked-out'], 200);
		}










		public function pushtoToken($token, $title, $body, $userId, $tenantId)
    {
        //$token, $title, $body, $userId, $tenantId

        $ch = curl_init("https://fcm.googleapis.com/fcm/send");

        $data = array("clickaction" => "FLUTTERNOTIFICATIONCLICK", "user" => $userId, "tenant_id" => $tenantId);

        //Creating the notification array.
        $notification = array('title' => $title, 'body' => $body);

        //This array contains, the token and the notification. The 'to' attribute stores the token.
        $arrayToSend = array('to' =>$token, 'notification' => $notification, 'data' => $data);

        //Generating JSON encoded string form the above array.
        $json = json_encode($arrayToSend);

        $url = "https://fcm.googleapis.com/fcm/send";
        //Setup headers:
        $headers = array();
        $headers[] = 'Content-Type: application/json';
        $headers[] = 'Authorization: key=AAAAFdgO3BA:APA91bEWv7uF_TktP1XVFW3NRBm9mHJCfuSuatUJcocjJzt1cpkaiPKzpE5yq_s6wq5i6rye8an2FP2fFqEWqBGgYTCYaH6cK0nvNw9EohAASh5kB_qfCtCYVMCVQOQ97imHG3tpiaD2';

        //Setup curl, add headers and post parameters.
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($ch);
       // print($result);

        //Send the request
        //curl_exec($ch);

        //Close request
        curl_close($ch);
		}



		public function ToAllUsers($tenant_id, $title, $body, $userId="32")
		{
		/* 	$token = "/topics/all";
			$this->pushtoToken($token, $title, $body, $userId, $tenant_id); */
			$users = User::where('users.tenant_id', $tenant_id)->get();
			foreach($users as $user)
			{
					 $token= $user['device_token'];
					 if($token !=null && !empty($token))
						{
							$this->pushtoToken($token, $title, $body, $userId, $tenant_id);
						}
			}

		}


		public function ToSpecificUser($tenant_id, $title, $body, $userId)
		{
			$users = User::where('users.tenant_id', $tenant_id)->where('users.id', $userId)->get();
			foreach($users as $user)
			{
					 $token= $user['device_token'];
					 if($token !=null && !empty($token))
						{
							$this->pushtoToken($token, $title, $body, $userId, $tenant_id);
						}
			}
		}

	public function searchCNX247(Request $request){
			$posts = Post::where('post_title', 'LIKE', '%'.$request->search_phrase.'%')
										->orWhere('post_content', 'LIKE', '%'.$request->search_phrase.'%')->get();
			return view('backend.activity-stream.search-result',['posts'=>$posts,'search_phrase'=>$request->search_phrase]);
		}

}
