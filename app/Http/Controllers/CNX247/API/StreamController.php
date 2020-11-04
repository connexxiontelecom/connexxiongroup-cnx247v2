<?php

namespace App\Http\Controllers\CNX247\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;
use App\ResponsiblePerson;
use App\User;
use App\PostAttachment;
class StreamController extends Controller
{
    //
    public function index(Request $request){

        $tenant_id = $request->input("tenant_id");

        $allposts = array();
        $posts = Post::where('posts.tenant_id', $tenant_id)->get();

        foreach($posts as $post)
        {
            $postArray = array();
            $user =  User::where('id', $post->user_id)->get();
            $responsible = ResponsiblePerson::where('post_id', $post->id)->join('users', 'responsible_people.user_id', '=', 'users.id')->get();
            $attachments = PostAttachment::where('post_id', $post->id)->get();
            $postArray["user"] = $user;
            $postArray['post'] = $post;
            $postArray['responsible'] = $responsible;
            $postArray['attachments'] = $attachments;
            $allposts[] = $postArray;
            //return response()->json(['posts' =>$post], 500);
        }

        return response()->json(['posts' =>$allposts
    ], 500);

   }
}
