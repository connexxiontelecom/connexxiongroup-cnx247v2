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
    * store new task
    */
    public function storeTask(Request $request){

        $this->validate($request, [
            'task_title'=>'required',
            'responsible_persons'=>'required',
            'task_description'=>'required',
            'due_date'=>'required'
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
        //$task->attachment = $filename;
        $task->save();
        $task_id = $task->id;
        if(!empty($request->attachment)){
            $filename = Auth::user()->tenant->company_name.'_'.time().date('Y').'.'.$request->attachment->extension();
            $request->attachment->storeAs('task', $filename);
            $post_attachment = new PostAttachment;
            $post_attachment->attachment = $filename;
            $post_attachment->tenant_id = Auth::user()->tenant_id;
            $post_attachment->post_id = $task_id;
            $post_attachment->user_id = Auth::user()->id;
            $post_attachment->save();
        }
        //responsible persons
        if(!empty($request->responsible_persons)){
            foreach($request->responsible_persons as $participant){
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
            foreach($request->participants as $person){
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
            foreach($request->observers as $observe){
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
}
