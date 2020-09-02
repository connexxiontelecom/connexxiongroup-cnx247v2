<?php

namespace App\Http\Livewire\Backend\User\Settings\Security;

use Livewire\Component;
use App\User;
use Auth;
use Hash;

class ChangePassword extends Component
{
    public $password, $current_password, $password_confirmation;
    public function render()
    {
        return view('livewire.backend.user.settings.security.change-password');
    }

    public function changePassword(){
        $this->validate([
            'current_password'=>'required',
            'password'=>'required|confirmed'
        ]);
        $user = User::find(Auth::user()->id);
        if (Hash::check($this->current_password, $user->password)) {
            $user->password = bcrypt($this->password);
            $user->save();
            $this->current_password = '';
            $this->password = '';
            $this->password_confirmation = '';
            session()->flash("success", "<strong>Success!</strong> Password changed.");
            return back();
        }else{
            session()->flash("warning", "<strong>Ooops!</strong> Current password does not match our record. Try again.");
            $this->current_password = '';
            $this->password = '';
            $this->password_confirmation = '';
            return back();
          }
    }
}
