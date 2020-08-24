<?php

namespace App\Http\Livewire\Frontend;
use App\User;
use Auth;

use Livewire\Component;

class ConfirmPassword extends Component
{   public $password;
    public $password_confirmation;
    public $error;
    public $success;

    public function render()
    {
        return view('livewire.frontend.confirm-password');
    }

    /*
    * Set new password
    */
    public function setNewPassword(){
        $this->validate([
            'password'=>'required|confirmed'
        ]);

    }
}
