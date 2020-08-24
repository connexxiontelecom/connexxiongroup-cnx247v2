<?php

namespace App\Http\Controllers\CNX247\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;
use App\Link;
use Auth;
class ProjectController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /*
    * Task board
    */
    public function projectBoard(){
        return view('backend.project.project-board');
    }
    /*
    * New task
    */
    public function newProject(){
        return view('backend.project.new-project');
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

}
