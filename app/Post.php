<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

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


}
