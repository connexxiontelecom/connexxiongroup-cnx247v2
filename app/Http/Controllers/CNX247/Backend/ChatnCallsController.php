<?php

namespace App\Http\Controllers\CNX247\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Message;
use Auth;

class ChatnCallsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /*
    * Load conversations with this user
    */
    public function getConversation($id){
        $active_user =  User::select('first_name', 'surname', 'avatar','mobile', 'id')->where('id', $id)->first();
        $conversations = Message::where('from_id', Auth::user()->id)->where('to_id', $id)
                                ->orWhere('from_id', $id)->where('to_id',Auth::user()->id)
                                ->get();
        return view('backend.chat.common._conversations', ['conversations'=>$conversations, 'active_user'=>$active_user]);
    }
    /*
    * Send message
    */
    public function sendChat(Request $request){
        $this->validate($request, [
            'message'=>'required',
            'to'=>'required'
        ]);
        $send = new Message;
        $send->message = $request->message;
        $send->to_id = $request->to;
        $send->from_id = Auth::user()->id;
        $send->tenant_id = Auth::user()->tenant_id;
        $send->save();

/*         'options' => [
            'cluster' => 'eu',
            'useTLS' => true
          ], */

    }
    /*
    *
    */
    public function sendAttachment(Request $request){
        $this->validate($request,[
            'attachment'=>'required'
        ]);
        #share attachment
        if(!empty($request->file('attachment'))){
            $extension = $request->file('attachment');
            $extension = $request->file('attachment')->getClientOriginalExtension(); // getting excel extension
            $dir = 'assets/uploads/attachments/';
            $filename = 'chat_'.uniqid().'_'.time().'_'.date('Ymd').'.'.$extension;
            $request->file('attachment')->move(public_path($dir), $filename);
        }

/*         if($request->attachment){
            $filename = 'chat_'.time().'.'.explode('/', explode(':', substr($request->attachment, 0, strpos($request->attachment, ';')))[1])[1];
            //share attachment
            //$file->move(base_path('\modo\images'),$file->getClientOriginalName());
            \Image::make($request->attachment)->resize(52, 82)->save(public_path('assets/uploads/attachments/').$filename);
        } */
        $message = new Message;
        $message->to_id = $request->to;
        $message->from_id = Auth::user()->id;
        $message->attachment = $filename;
        $message->tenant_id = Auth::user()->tenant_id;
        $message->save();
    }
    /*
    * Chat-n-calls view
    */
    public function showChatnCallsView(){
        return view('backend.chat.view.chat-n-calls');
    }


}
