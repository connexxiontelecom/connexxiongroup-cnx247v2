<?php

namespace App\Http\Controllers\CNX247\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Notifications\NewPostNotification;
use App\Post;
use App\ResponsiblePerson;
use App\Participant;
use App\Observer;
use App\Priority;
use App\Milestone;
use App\Status;
use App\Link;
use App\User;
use Auth;
class ProjectController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /*
    * project board
    */
    public function projectBoard(){
        return view('backend.project.project-board');
    }
    /*
    * New task
    */
    public function newProject(){
        $users = User::select('first_name', 'surname', 'id')
                            ->where('account_status',1)->where('verified', 1)
                            ->where('tenant_id',Auth::user()->tenant_id)
                            ->orderBy('first_name', 'ASC')->get();
        return view('backend.project.new-project',['users'=>$users]);
    }
    /*
    * store new task
    */
    public function storeProject(Request $request){

        $this->validate($request,[
            'project_name'=>'required',
            'responsible_persons'=>'required',
            'project_description'=>'required',
            'due_date'=>'required|date|after_or_equal:start_date',
            'start_date'=>'required|date',
            'project_sponsor'=>'required'
        ]);

        $url = substr(sha1(time()), 10, 10);
        $project = new Post;
        $project->post_title = $request->project_name;
        $project->user_id = Auth::user()->id;
        $project->post_content = $request->project_description;
        $project->post_color = $request->color;
        $project->project_manager_id = $request->project_manager;
        $project->post_type = 'project';
        $project->post_url = $url;
        $project->sponsor = $request->project_sponsor;
        $project->start_date = $request->start_date ?? '';
        $project->end_date = $request->due_date;
        $project->post_priority = $request->priority;
        $project->tenant_id = Auth::user()->tenant_id;
        //$task->attachment = $filename;
        $project->save();
        $project_id = $project->id;
        //responsible persons
        if(!empty($request->responsible_persons)){
            foreach($request->responsible_persons as $responsible){

               /*  $user = User::select('first_name', 'surname', 'email', 'id')->where('id', $participant)->first();
                \Mail::to($user->email)->send(new MailTask($user, $request, $url)); */
                $part = new ResponsiblePerson;
                $part->post_id = $project_id;
                $part->post_type = 'project';
                $part->user_id = $responsible;
                $part->tenant_id = Auth::user()->tenant_id;
                $part->save();
                //notify this user
                $user = User::find($responsible);
                $user->notify(new NewPostNotification($project));
            }
        }
        //participants
        if(!empty($request->participants)){
            foreach($request->participants as $participant){

               /*  $user = User::select('first_name', 'surname', 'email', 'id')->where('id', $participant)->first();
                \Mail::to($user->email)->send(new MailTask($user, $request, $url)); */
                $part = new Participant;
                $part->post_id = $project_id;
                $part->post_type = 'project';
                $part->user_id = $participant;
                $part->tenant_id = Auth::user()->tenant_id;
                $part->save();
            }
        }
        //observers
        if(!empty($request->observers)){
            foreach($request->observers as $observer){

               /*  $user = User::select('first_name', 'surname', 'email', 'id')->where('id', $participant)->first();
                \Mail::to($user->email)->send(new MailTask($user, $request, $url)); */
                $part = new Observer;
                $part->post_id = $project_id;
                $part->post_type = 'project';
                $part->user_id = $observer;
                $part->tenant_id = Auth::user()->tenant_id;
                $part->save();
            }
        }
        session()->flash("success", "<strong>Success! </strong> Project created.");
        return redirect()->route('project-board');
    }


    /*
    * New task
    */
    public function viewProject(){
        return view('backend.project.view-project');
    }
    /*
    * Project calendar
    */
    public function projectCalendar(){
        return view('backend.project.project-calendar');
    }

    /*
    * Project calendar
    */
    public function getProjectCalendarData(){
        $project = Post::select('post_title as title', 'start_date as start', 'end_date as end', 'post_color as color')
                    ->where('post_type', 'project')
                    ->where('tenant_id', Auth::user()->tenant_id)->get();
        return response($project);
    }
    /*
    * Project gantt chart [view]
    */
    public function projectGanttChart(){
        return view('backend.project.project-gantt-chart');
    }
    /*
    * Project Gantt Chart
    */
    public function getProjectGanttChartData(){
        $project = Post::select('post_title as text', 'start_date', 'end_date', 'post_color as color')
                    ->where('post_type', 'project')
                    ->where('tenant_id', Auth::user()->tenant_id)
                    ->orderBy('id', 'DESC')
                    ->get();
        $links = Link::all();
        return response()->json([
            'data'=>$project,
            'links'=>$links
             ]);
    }

    /*
    * Project analytics
    */
    public function projectAnalytics(){
        return view('backend.project.project-analytics');
    }

     /*
    * edit project
    */
    public function editProject($url){
        $users = User::select('first_name', 'surname', 'id')
                    ->where('account_status',1)->where('verified', 1)
                    ->where('tenant_id',Auth::user()->tenant_id)
                    ->orderBy('first_name', 'ASC')->get();
        $priorities = Priority::all();
        $statuses = Status::all();
        $project = Post::where('post_url', $url)->where('tenant_id', Auth::user()->tenant_id)->first();
        if(!empty($project) ){
            return view('backend.project.edit-project',[
                'users'=>$users,
                'priorities'=>$priorities,
                'statuses'=>$statuses,
                'project'=>$project
            ]);

        }else{
            return redirect()->route('404');
        }
    }

        /*
    * update project
    */
    public function updateProject(Request $request){
        //return dd($request->all());
        $this->validate($request,[
            'project_name'=>'required',
            'project_description'=>'required',
            'due_date'=>'required|date',
            'start_date'=>'required|after_or_equal:due_date',
            'project_sponsor'=>'required'
        ]);
        $project = Post::where('post_url', $request->url)->where('tenant_id', Auth::user()->tenant_id)->first();
        $project->post_title = $request->project_name;
        $project->user_id = Auth::user()->id;
        $project->post_content = $request->project_description;
        $project->post_color = $request->color;
        $project->project_manager_id = $request->project_manager;
        $project->post_type = 'project';
        $project->post_url = $request->url;
        $project->sponsor = $request->project_sponsor;
        $project->start_date = $request->start_date ?? '';
        $project->end_date = $request->due_date;
        $project->post_priority = $request->priority;
        $project->tenant_id = Auth::user()->tenant_id;
        $project->save();
        session()->flash("success", "<strong>Success!</strong> Project changes saved.");
        return redirect()->route('project-board');
    }

    public function createProjectMilestone(Request $request){
        $this->validate($request,[
            'title'=>'required',
            'due_date'=>'required|date'
        ]);
        $milestone = new Milestone;
        $milestone->title = $request->title;
        $milestone->due_date = $request->due_date;
        $milestone->description = $request->description;
        $milestone->tenant_id = Auth::user()->tenant_id;
        $milestone->user_id = Auth::user()->id;
        $milestone->post_id = $request->post_id;
        $milestone->save();
        return response()->json(['message'=>'Success! Project milestone created.'], 200);
    }

    public function deleteProject(Request $request){
        $this->validate($request,[
            'projectId'=>'required'
        ]);
        $task = Post::where('tenant_id', Auth::user()->tenant_id)
                    ->where('id', $request->projectId)->first();
        if(!empty($task) ){
            $task->delete();
            $responsible = ResponsiblePerson::where('post_id', $request->projectId)
                                            ->where('tenant_id', Auth::user()->tenant_id)
                                            ->get();
            if(!empty($responsible) ){
                foreach($responsible as $person){
                    $person->delete();
                }
            }
            #Observers
            $observers = Observer::where('post_id', $request->projectId)
                                            ->where('tenant_id', Auth::user()->tenant_id)
                                            ->get();
            if(!empty($observers) ){
                foreach($observers as $observer){
                    $observer->delete();
                }
            }
            #Participants
            $participants = Participant::where('post_id', $request->projectId)
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
