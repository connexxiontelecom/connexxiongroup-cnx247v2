<?php

namespace App\Http\Livewire\Backend\User;

use Livewire\Component;
use App\User;
use App\Notification;
use Auth;
use DB;
class Notifications extends Component
{
    public $notifications = [];
    public $read, $unread;
    public function render()
    {
        return view('livewire.backend.user.notifications');
    }

    public function mount(){
        if(Auth::check()){
            $this->read = Auth::user()->readNotifications;
            $this->unread = Auth::user()->unReadNotifications;
        }
    }

    /*
    * Mark as read
    */
     public function markNotificationAsRead(){
/*          $notification_id = $id;
        $Notification = Auth::user()->Notification->find($notification_id);
        if($Notification){
           $Notification->markAsRead();
        }  */
        //DB::table('notifications')->where('id',$id)->update(['read_at'=>Carbon::now()]);
/*         $notify =  Auth::user()->Notification::find($id);
       if(!empty($notify) ){
           Auth::user()->notify->markAsRead();
        }  */   
           Auth::user()->unreadNotifications()->update(['read_at' => now()]);
    }
}
