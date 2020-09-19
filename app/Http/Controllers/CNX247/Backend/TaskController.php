<?php

namespace App\Http\Controllers\CNX247\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;
use App\Link;
use App\User;
use App\Status;
use App\Priority;
use App\ResponsiblePerson;
use App\Participant;
use App\Observer;
use App\PostAttachment;
use Auth;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /*
    * Task board
    */
    public function taskBoard(){
        return view('backend.tasks.task-board');
    }
    /*
    * New task
    */
    public function newTask(){
        $users = User::select('first_name', 'surname', 'id')
                    ->where('account_status',1)->where('verified', 1)
                    ->where('tenant_id',Auth::user()->tenant_id)
                    ->orderBy('first_name', 'ASC')->get();
        $priorities = Priority::all();
        $statuses = Status::all();
        return view('backend.tasks.new-task',[
            'users'=>$users,
            'priorities'=>$priorities,
            'statuses'=>$statuses
        ]);
    }
    /*
    * edit task
    */
    public function editTask($url){
        $users = User::select('first_name', 'surname', 'id')
                    ->where('account_status',1)->where('verified', 1)
                    ->where('tenant_id',Auth::user()->tenant_id)
                    ->orderBy('first_name', 'ASC')->get();
        $priorities = Priority::all();
        $statuses = Status::all();
        $task = Post::where('post_url', $url)->where('tenant_id', Auth::user()->tenant_id)->first();
        return view('backend.tasks.edit-task',[
            'users'=>$users,
            'priorities'=>$priorities,
            'statuses'=>$statuses,
            'task'=>$task
        ]);
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
        $task->start_date = $request->start_date ?? '';
        $task->end_date = $request->due_date;
        $task->post_priority = $request->priority;
        $task->tenant_id = Auth::user()->tenant_id;
        $task->save();
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
        if(!empty($request->responsible_persons)){
            foreach(json_decode($request->responsible_persons) as $participant){
               /*  $user = User::select('first_name', 'surname', 'email', 'id')->where('id', $participant)->first();
                \Mail::to($user->email)->send(new MailTask($user, $request, $url)); */
                $part = new ResponsiblePerson;
                $part->post_id = $task_id;
                $part->user_id = $participant;
                $part->tenant_id = Auth::user()->tenant_id;
                $part->save();
            }
        }
        //participants
        if(!empty($request->participants)){
            foreach(json_decode($request->participants) as $person){
               /*  $user = User::select('first_name', 'surname', 'email', 'id')->where('id', $participant)->first();
                \Mail::to($user->email)->send(new MailTask($user, $request, $url)); */
                $part = new Participant;
                $part->post_id = $task_id;
                $part->user_id = $person;
                $part->tenant_id = Auth::user()->tenant_id;
                $part->save();
            }
        }
        //observers
        if(!empty($request->observers)){
            foreach(json_decode($request->observers) as $observe){
               /*  $user = User::select('first_name', 'surname', 'email', 'id')->where('id', $participant)->first();
                \Mail::to($user->email)->send(new MailTask($user, $request, $url)); */
                $part = new Observer;
                $part->post_id = $task_id;
                $part->user_id = $observe;
                $part->tenant_id = Auth::user()->tenant_id;
                $part->save();
            }
        }
        return redirect()->route('task-board');
    }
    /*
    * update task
    */
    public function updateTask(Request $request){

        $this->validate($request, [
            'task_title'=>'required',
            'task_description'=>'required',
            'start_date'=>'required|date',
            'due_date'=>'required|date|after_or_equal:start_date'
        ]);
        $task = Post::where('post_url', $request->url)->where('tenant_id', Auth::user()->tenant_id)->first();
        $task->post_title = $request->task_title;
        $task->user_id = Auth::user()->id;
        $task->post_content = $request->task_description;
        $task->post_color = $request->color;
        $task->post_type = 'task';
        $task->post_url = $request->url;
        $task->start_date = $request->start_date ?? '';
        $task->end_date = $request->due_date;
        $task->tenant_id = Auth::user()->tenant_id;
        //$task->attachment = $filename;
        $task->save();
        session()->flash("success", "<strong>Success!</strong> Task changes saved.");
        return redirect()->route('task-board');
    }

    /*
    * New task
    */
    public function viewTask(){
        return view('backend.tasks.view-task');
    }

    /*
    * Task calendar
    */
    public function taskCalendar(){
        return view('backend.tasks.task-calendar');
    }

    /*
    * Task calendar
    */
    public function getTaskCalendarData(){
        $task = Post::select('post_title as title', 'start_date as start', 'end_date as end', 'post_color as color')
                    ->where('post_type', 'task')
                    ->where('tenant_id', Auth::user()->tenant_id)->get();
        return response($task);
    }
    /*
    * Task gantt chart [view]
    */
    public function taskGanttChart(){
        return view('backend.tasks.task-gantt-chart');
    }
    /*
    * Task Gantt Chart
    */
    public function getTaskGanttChartData(){
        $task = Post::select('post_title as text', 'start_date', 'end_date', 'post_color as color')
                    ->where('post_type', 'task')
                    ->where('tenant_id', Auth::user()->tenant_id)
                    ->orderBy('id', 'DESC')
                    ->get();
        $links = Link::all();
        return response()->json([
            'data'=>$task,
            'links'=>$links
             ]);
    }

    /*
    * Task analytics
    */
    public function taskAnalytics(){
        return view('backend.tasks.task-analytics');
    }

    public function deleteTask(Request $request){
        $this->validate($request,[
            'taskId'=>'required'
        ]);
        $task = Post::where('tenant_id', Auth::user()->tenant_id)
                    ->where('id', $request->taskId)->first();
        if(!empty($task) ){
            $task->delete();
            $responsible = ResponsiblePerson::where('post_id', $request->taskId)
                                            ->where('tenant_id', Auth::user()->tenant_id)
                                            ->get();
            if(!empty($responsible) ){
                foreach($responsible as $person){
                    $person->delete();
                }
            }
            #Observers
            $observers = Observer::where('post_id', $request->taskId)
                                            ->where('tenant_id', Auth::user()->tenant_id)
                                            ->get();
            if(!empty($observers) ){
                foreach($observers as $observer){
                    $observer->delete();
                }
            }
            #Participants
            $participants = Participant::where('post_id', $request->taskId)
                                            ->where('tenant_id', Auth::user()->tenant_id)
                                            ->get();
            if(!empty($participants) ){
                foreach($participants as $participant){
                    $participant->delete();
                }
            }
        }
        session()->flash("success", "<strong>Success!</strong> Task deleted.");
        return redirect()->back();
    }
}
