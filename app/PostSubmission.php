<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostSubmission extends Model
{
    //
    public function submittedBy(){
        return $this->belongsTo(User::class, 'submitted_by');
    }
    public function getPostAttachment(){
        return $this->hasMany(PostSubmissionAttachment::class, 'post_id', 'post_id');
    }
}
