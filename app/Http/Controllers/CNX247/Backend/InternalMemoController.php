<?php

namespace App\Http\Controllers\CNX247\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Notifications\NewPostNotification;
use App\BusinessLog;
use App\PostAttachment;
use App\RequestApprover;
use App\ResponsiblePerson;
use App\Post;
use App\User;
use Auth;

class InternalMemoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /*
    * Get list of all employees
    */
    public function index(){
        return view('backend.workflow.memo.internal-memo');
    }

    public function store(Request $request){
            $this->validate($request, [
                'subject'=>'required',
                'content'=>'required',
                'to'=>'required'
            ]);

        if(!empty($request->file('attachment'))){
            $extension = $request->file('attachment');
            $extension = $request->file('attachment')->getClientOriginalExtension();
            $size = $request->file('attachment')->getSize();
            $dir = 'assets/uploads/requisition/';
            $filename = uniqid().'_'.time().'_'.date('Ymd').'.'.$extension;
            $request->file('attachment')->move(public_path($dir), $filename);
        }else{
            $filename = '';
        }
        $message = null;
        $url = substr(sha1(time()), 10,10);
        $memo = new Post;
        $memo->post_title = $request->subject;
        $memo->post_type = 'memo';
        $memo->post_content = $request->content;
        $memo->post_status = 'in-progress';
        $memo->user_id = Auth::user()->id;
        $memo->tenant_id = Auth::user()->tenant_id;
        $memo->post_url = $url;
        $memo->save();
        $id = $memo->id;
        if(!empty($request->file('attachment'))){
            $attachment = new PostAttachment;
            $attachment->post_id = $id;
            $attachment->user_id = Auth::user()->id;
            $attachment->tenant_id = Auth::user()->tenant_id;
            $attachment->attachment = $filename;
            $attachment->save();
        }
        if($request->to == 0){
            $resp = new ResponsiblePerson;
            $resp->user_id = 32;
            $resp->post_id = $id;
            $resp->tenant_id = Auth::user()->tenant_id;
            $resp->save();
        }else{
            $users = User::where('department_id', $request->department)
                            ->where('tenant_id', Auth::user()->tenant_id)
                            ->get();

            if(!empty($users) ){
                foreach($users as $user){
                    $send = new ResponsiblePerson;
                    $send->post_id = $id;
                    $send->user_id = $user->id;
                    $send->tenant_id = Auth::user()->tenant_id;
                    $send->save();
                    $person = User::find($user->id);
                    $person->notify(new NewPostNotification($memo));
                }
                $message = "<strong>Success!</strong> Internal memo sent to department members..";
            }else{
                $resp = new ResponsiblePerson;
                $resp->user_id = 32;
                $resp->post_id = $id;
                $resp->tenant_id = Auth::user()->tenant_id;
                $resp->save();
                $message = "<strong>Success!</strong> There're no employees in this department. Memo sent to all employees instead";
            }
        }
        session()->flash("success", $message);
        return back();
    }

    public function view($url){
        $memo = Post::where('tenant_id', Auth::user()->tenant_id)->where('post_url', $url)->first();
        if(!empty($memo)){
            return view('backend.workflow.memo.view-memo',['memo'=>$memo]);
        }else{
            return redirect()->route('404');
        }
    }
}
