<?php

namespace App\Http\Controllers\CNX247\API;

use App\Http\Controllers\Controller;
use App\Notifications\NewPostNotification;
use App\Observer;
use App\Participant;
use App\Post;
use App\PostAttachment;
use App\PostComment;
use App\PostLike;
use App\Priority;
use App\ResponsiblePerson;
use App\User;
use Illuminate\Http\Request;

class StreamController extends Controller
{
    //
    public function index(Request $request)
    {

        $tenant_id = $request->input("tenant_id");

        $allposts = array();
        $posts = Post::where('posts.tenant_id', $tenant_id)->orderBy('id', 'DESC')->get();

        foreach ($posts as $post) {
            $postArray = array();
            $user = User::where('id', $post->user_id)->get();

            /* parse profile picture */
            $user[0]["avatar"] = url("/assets/images/avatars/thumbnails/" . $user[0]["avatar"]);

            /* parse comments */
            //$comments =
            //$post->postComments;//
            $comments = PostComment::where('post_id', $post->id)->join('users', 'users.id', 'post_comments.user_id')->orderBy('post_comments.id', 'DESC')->get();
            foreach ($comments as $comment) {
                $comment['avatar'] = url("/assets/images/avatars/thumbnails/" . $comment['avatar']);
            }
            $post['comments'] = $comments;

            /* parse post likes */

            $postLikes = PostLike::where("post_id", $post->id)->join('users', 'post_likes.user_id', '=', 'users.id')->get();
            $post['likes'] = count($postLikes);
            $post['post_likes'] = $postLikes;
            $post['posted'] = date('M j , Y', strtotime($post->created_at));
            $responsible = ResponsiblePerson::where('post_id', $post->id)->join('users', 'responsible_people.user_id', '=', 'users.id')->get();
            $attachments = PostAttachment::where('post_id', $post->id)->get();

            /* Parse Attachments */
            foreach ($attachments as $attachment) {
                $attachment["attachment"] = url("/assets/uploads/attachments/" . $attachment['attachment']);
            }

            $postArray["user"] = $user;
            $postArray['post'] = $post;
            $postArray['responsible'] = $responsible;
            $postArray['attachments'] = $attachments;
            $allposts[] = $postArray;
            //return response()->json(['posts' =>$post], 500);
        }

        return response()->json(['posts' => $allposts,
        ], 500);

    }

    public function StreamPost(Request $request)
    {

        $tenant_id = $request->input("tenant_id");
        $post_id = $request->input("post_id");

        $allposts = array();
        $posts = Post::where('posts.tenant_id', $tenant_id)->where('posts.id', $post_id)->get();

        foreach ($posts as $post) {
            $postArray = array();
            $user = User::where('id', $post->user_id)->get();

            /* parse profile picture */
            $user[0]["avatar"] = url("/assets/images/avatars/thumbnails/" . $user[0]["avatar"]);

            /* parse comments */
            //$comments =
            //$post->postComments;//
            $comments = PostComment::where('post_id', $post->id)->join('users', 'users.id', 'post_comments.user_id')->orderBy('post_comments.id', 'DESC')->get();
            foreach ($comments as $comment) {
                $comment['avatar'] = url("/assets/images/avatars/thumbnails/" . $comment['avatar']);
            }
            $post['comments'] = $comments;

            /* parse post likes */

            $postLikes = PostLike::where("post_id", $post->id)->join('users', 'post_likes.user_id', '=', 'users.id')->get();
            $post['likes'] = count($postLikes);
            $post['post_likes'] = $postLikes;
            $post['posted'] = date('M j , Y', strtotime($post->created_at));
            $responsible = ResponsiblePerson::where('post_id', $post->id)->join('users', 'responsible_people.user_id', '=', 'users.id')->get();
            $attachments = PostAttachment::where('post_id', $post->id)->get();

            /* Parse Attachments */
            foreach ($attachments as $attachment) {
                $attachment["attachment"] = url("/assets/uploads/attachments/" . $attachment['attachment']);
            }

            $postArray["user"] = $user;
            $postArray['post'] = $post;
            $postArray['responsible'] = $responsible;
            $postArray['attachments'] = $attachments;
            $allposts[] = $postArray;
            //return response()->json(['posts' =>$post], 500);
        }

        return response()->json(['posts' => $allposts,
        ], 500);

    }

    public function like(Request $request)
    {
        $user_id = $request->input("user_id");
        $tenant_id = $request->input("tenant_id");
        $post_id = $request->input("post_id");

        $like = new PostLike();
        $like->post_id = $post_id;
        $like->user_id = $user_id;
        $like->tenant_id = $tenant_id;
        $like->save();
        return response()->json(['status' => 200]);
    }

    public function comment(Request $request)
    {
        $user_id = $request->input("user_id");
        $tenant_id = $request->input("tenant_id");
        $post_id = $request->input("post_id");
        $comment = $request->input("comment");

        $com = new PostComment;
        $com->user_id = $user_id;
        $com->post_id = $post_id;
        $com->comment = $comment;
        $com->tenant_id = $tenant_id;
        $com->save();
        return response()->json(['status' => 200]);
    }

    public function storeTask(Request $request)
    {
        $darray = array();
        $url = substr(sha1(time()), 10, 10);
        $task = new Post;
        $task->post_title = $request->task_title;
        $task->user_id = $request->user_id;
        $task->post_content = $request->task_description;
        //$task->post_color = $request->color;
        $task->post_type = 'task';
        $task->post_url = $url;
        $task->start_date = $request->start_date ?? '';
        $task->end_date = $request->due_date;
        $task->post_priority = $request->priority;
        $task->tenant_id = $request->tenant_id;
        $task->save();
        $task_id = $task->id;

        //Attachment
        if (!empty($request->attachment)) {
            $attach = new PostAttachment;
            $attach->post_id = $task_id;
            $attach->user_id = $request->user_id;
            $attach->attachment = $request->attachment;
            $attach->tenant_id = $request->tenant_id;
            $attach->save();
        }

        //responsible persons
        if (!empty($request->persons)) {
            foreach ($request->persons as $person) {

                $part = new ResponsiblePerson;
                $part->post_id = $task_id;
                $part->post_type = 'task';
                $part->user_id = $person["id"];
                $part->tenant_id = $request->tenant_id;
                $part->save();
                $darray["persons"][] = $person["id"];
                $user = User::find($person);
                //$user->notify(new NewPostNotification($task));
            }
        }
        //participants
        if (!empty($request->participants)) {
            foreach ($request->participants as $participant) {
                /*  $user = User::select('first_name', 'surname', 'email', 'id')->where('id', $participant)->first();
                \Mail::to($user->email)->send(new MailTask($user, $request, $url)); */
                $part = new Participant;
                $part->post_id = $task_id;
                $part->post_type = 'task';
                $part->user_id = $participant["id"];
                $part->tenant_id = $request->tenant_id;
                $part->save();
                $darray["participants"][] = $participant["id"];
            }
        }
        //observers
        if (!empty($request->observers)) {
            foreach ($request->observers as $observer) {
                /*  $user = User::select('first_name', 'surname', 'email', 'id')->where('id', $participant)->first();
                \Mail::to($user->email)->send(new MailTask($user, $request, $url)); */
                $part = new Observer;
                $part->post_id = $task_id;
                $part->post_type = 'task';
                $part->user_id = $observer["id"];
                $part->tenant_id = $request->tenant_id;
                $part->save();
                $darray["observes"][] = $observer["id"];

            }
        }
        return response()->json(['message' => 'Success! Task created.', "parsed" => $darray], 200);
    }

    public function storeProject(Request $request)
    {
        $url = substr(sha1(time()), 10, 10);
        $project = new Post;
        $project->post_title = $request->project_title;
        $project->user_id = $request->user_id;
        $project->post_content = $request->project_description;
        $project->post_color = $request->color;
        $project->project_manager_id = $request->project_manager;
        $project->post_type = 'project';
        $project->post_url = $url;
        $project->budget = $request->budget ?? '';
        $project->sponsor = $request->project_sponsor;
        $project->start_date = $request->start_date ?? '';
        $project->end_date = $request->due_date;
        $project->post_priority = $request->priority;
        $project->tenant_id = $request->tenant_id;
        //$task->attachment = $filename;
        $project->save();
        $project_id = $project->id;

        //Attachment
        if (!empty($request->attachment)) {
            $attach = new PostAttachment;
            $attach->post_id = $project_id;
            $attach->user_id = $request->user_id;
            $attach->attachment = $request->attachment;
            $attach->tenant_id = $request->tenant_id;
            $attach->save();
        }

        //responsible persons
        if (!empty($request->responsible_persons)) {
            foreach ($request->responsible_persons as $responsible) {

                $part = new ResponsiblePerson;
                $part->post_id = $project_id;
                $part->post_type = 'project';
                $part->user_id = $responsible;
                $part->tenant_id = $request->tenant_id;
                $part->save();
                //notify this user
                $user = User::find($responsible);
                $user->notify(new NewPostNotification($project));
            }
        }
        //participants
        if (!empty($request->participants)) {
            foreach ($request->participants as $participant) {
                $part = new Participant;
                $part->post_id = $project_id;
                $part->post_type = 'project';
                $part->user_id = $participant;
                $part->tenant_id = $request->tenant_id;
                $part->save();
            }
        }
        //observers
        if (!empty($request->observers)) {
            foreach ($request->observers as $observer) {

                $part = new Observer;
                $part->post_id = $project_id;
                $part->post_type = 'project';
                $part->user_id = $observer;
                $part->tenant_id = $request->tenant_id;
                $part->save();
            }
        }

        return response()->json(['message' => 'Success! Task created.'], 200);
    }



    public function priorities()
    {
        $priorites = Priority::all();
        return response()->json(['priorities' => $priorites], 500);
		}


    public function upload(Request $request)
    {
        if (!empty($request->file('attachment'))) {
            $extension = $request->file('attachment');
            $extension = $request->file('attachment')->getClientOriginalExtension(); // getting excel extension
            $dir = 'assets/uploads/attachments/';
            $filename = 'task_' . uniqid() . '_' . time() . '_' . date('Ymd') . '.' . $extension;
            $request->file('attachment')->move(public_path($dir), $filename);
            return response()->json(['Response' => $filename], 200);
        } else {
            $filename = '';
            return response()->json(['Response' => ""], 204);
        }

		}




		public function projectUpload(Request $request)
    {
        if (!empty($request->file('attachment'))) {
            $extension = $request->file('attachment');
            $extension = $request->file('attachment')->getClientOriginalExtension(); // getting excel extension
            $dir = 'assets/uploads/attachments/';
            $filename = 'task_' . uniqid() . '_' . time() . '_' . date('Ymd') . '.' . $extension;
            $request->file('attachment')->move(public_path($dir), $filename);
            return response()->json(['Response' => $filename], 200);
        } else {
            $filename = '';
            return response()->json(['Response' => ""], 204);
        }

    }




}
