<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

class ResponsiblePerson extends Model
{
    use Notifiable;
    public function user(){
        return $this->belongsTo(User::class);
    }

    /*
     * Use-case methods
     */
	public function setNewResponsiblePersons($post_id, $request_type, $processor_id){
		$event = new ResponsiblePerson;
		$event->post_id = $post_id;
		$event->post_type = $request_type;
		$event->user_id = $processor_id;
		$event->tenant_id = Auth::user()->tenant_id;
		$event->save();
	}

	public static function markFirstUnseenAsSeen($post_id){
		$person = ResponsiblePerson::where('post_id', $post_id)->where('is_seen',0)->first();
		if(!empty($person)){
			$person->is_seen = 1;
			$person->save();
			return 1;// record updated
		}else{
			return 0; //no more responsible person
		}
	}

	public static function updateStatus($post_id, $action){
		$update = ResponsiblePerson::where('post_id', $post_id)->where('user_id', Auth::user()->id)->first();
		$update->status = $action;
		$update->save();
	}
}

