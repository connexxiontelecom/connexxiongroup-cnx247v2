<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Psy\Util\Str;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\Auth;

class Post extends Model
{
    use HasRoles;
    protected $guard_name = 'web';
    /*
    * One user may have many posts
    */
    public function user(){
        return $this->belongsTo(User::class); //user_id on post table
    }
/*
    * One post may have N number of attachments
    */
    public function postAttachment(){
        return $this->hasMany(PostAttachment::class); //attachment_id on post table
    }

    /*
    * One post could have N number of responsible persons
    */
    public function responsiblePersons(){
        return $this->hasMany(ResponsiblePerson::class, 'post_id');
    }

    /*
    * One post may have N number of comments
    */
    public function postComments(){
        return $this->hasMany(PostComment::class, 'post_id');
    }

    /*
    * One post may have N number of likes
    */
    public function postLikes(){
        return $this->hasMany(PostLike::class, 'post_id');
    }
    /*
    * One post may have N number of reviews
    */
    public function postReviews(){
        return $this->hasMany(PostRevision::class, 'post_id');
    }
    public function postViews(){
        return $this->hasMany(PostView::class, 'post_id');
    }

    /*
    * One post may have N number of participants
    */
    public function postParticipants(){
        return $this->hasMany(Participant::class, 'post_id');
    }
    /*
    * One post may have N number of observers
    */
    public function postObservers(){
        return $this->hasMany(Observer::class, 'post_id');
    }

    /*
    * Priority-post relationship
    */
    public function priority(){
        return $this->belongsTo(Priority::class, 'post_priority');
    }
    /*
    * Priority-post relationship
    */
    public function postStatus(){
        return $this->belongsTo(Status::class, 'status_id');
    }

    public function getPostSubmission(){
        return $this->hasMany(PostSubmission::class, 'post_id');
    }

    public function submittedBy(){
        return $this->belongsTo(User::class, 'submitted_by');
    }

    public function projectInvoices(){
        return $this->hasMany(Invoice::class, 'project_id');
    }
    public function projectBills(){
        return $this->hasMany(BillMaster::class, 'project_id');
    }
    public function projectReceipts(){
        return $this->hasMany(Invoice::class, 'project_id');
    }
    public function getProjectBudgetFinancials(){
        return $this->hasMany(BudgetFinancial::class, 'project_id');
		}




		/*
		 * Use-case methods
		 */

	public function setNewWorkflowRequest(Request $request){
		$workflow = new Post();
		$workflow->post_title = $request->title;
		$workflow->budget = $request->amount;
		$workflow->currency = $request->currency;
		$workflow->post_type = $request->request_type;
		$workflow->post_content = $request->description;
		$workflow->post_status = 'in-progress';
		$workflow->user_id = Auth::user()->id;
		$workflow->tenant_id = Auth::user()->tenant_id;
		$workflow->post_url = \Illuminate\Support\Str::slug($request->title)."-".substr(sha1(time()),32,40);
		$workflow->save();
		return $workflow;
	}

	public static function updatePostStatus($post_id, $status){
		$post = Post::find($post_id);
		$post->post_status = $status;
		$post->save();
	}


}
