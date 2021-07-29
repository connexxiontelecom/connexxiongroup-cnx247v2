<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostAttachment extends Model
{
    /*
    *An attachment may belong to one post
    */
    public function post(){
        return $this->hasMany(Post::class,'post_id');
    }

    /*
    * user-post attachment relationship
    */
    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }


    /*
     * Use-case methods
     */
		public function uploadAttachment(Request $request, $post_id){
			if ($request->hasFile('attachment')) {
				$extension = $request->file('attachment');
				$extension = $request->file('attachment')->getClientOriginalExtension();
				//$size = $request->file('attachment')->getSize();
				$dir = 'assets/uploads/requisition/';
				$filename = uniqid().'_'.time().'_'.date('Ymd').'.'.$extension;
				$request->file('attachment')->move(public_path($dir), $filename);
				$attachment = new PostAttachment;
				$attachment->post_id = $post_id;
				$attachment->user_id = Auth::user()->id;
				$attachment->tenant_id = Auth::user()->tenant_id;
				$attachment->attachment = $filename;
				$attachment->save();
			}
		}
}
