<?php

namespace App\Http\Livewire\Backend\ChatNCalls\View;

use Livewire\Component;
use App\Notifications\ChatNotification;
use Twilio\Exceptions\ConfigurationException;
use Twilio\Rest\Client;
use App\User;
use App\Message;
use Auth;

class ChatNCalls extends Component
{
    public $users;
    public $friend = null; //selected user
    public $messages = null;
    public $message = '';
    public $selectedUserId = null;
    public $phone_number = 2348032404359;
    public function render()
    {
        return view('livewire.backend.chat-n-calls.view.chat-n-calls');
    }
    public function mount(){
        $this->getUsers();
    }


    /*
    *
    */
    public function getUsers(){
        $this->users = User::where('account_status', 1)
                            ->where('verified', 1)
                            ->where('id', '!=', Auth::user()->id)
                            ->where('tenant_id', Auth::user()->tenant_id)
                            ->orderBy('first_name', 'ASC')
                            ->get();
    }

    /*
    * Select user
    */
    public function getConversation($id){
        /* $this->friend = User::select('first_name', 'surname', 'avatar', 'position')
                        ->where('id', $id)
                        ->where('tenant_id', Auth::user()->tenant_id)->first(); */
        $this->selectedUserId = $id;
         $this->messages = Message::where('from_id', Auth::id())->where('to_id', $id)
                ->orWhere('from_id', $id)->where('to_id', Auth::id())
                ->where('tenant_id', Auth::user()->tenant_id)
                ->get();
    }

    /*
    *Send message
    */
    public function sendMessage(){
        $this->validate([
            'message'=>'required'
        ]);
        $message = new Message;
        $message->to_id = $this->selectedUserId;
        $message->from_id = Auth::user()->id;
        $message->message = $this->message;
        $message->tenant_id = Auth::user()->tenant_id;
        $message->save();
        //notify this user
        $user = User::find($this->selectedUserId);
        $user->notify(new ChatNotification($message));
        $this->message = '';
        $this->getConversation($this->selectedUserId);
    }

    /*
    * Make call
    */
    public function makeCall(){
        try{
            $client = new Client(
                getenv('TWILIO_ACCOUNT_SID'),
                getenv('TWILIO_AUTH_TOKEN'),
            );
            try{
                $client->calls->create(
                    $this->phone_number,
                    getenv('TWILIO_NUMBER'),
                    array("url"=>"http://demo.twilio.com/docs/voice.xml")
                );
                session()->flash('stage', 'Ringing...');
            }catch(\Exception $e){
                //$this->call_button = $e->getMessage();
            }
        }catch(ConfigurationException $e){
            //$this->call_button = $e->getMessage();
        }
    }
}
