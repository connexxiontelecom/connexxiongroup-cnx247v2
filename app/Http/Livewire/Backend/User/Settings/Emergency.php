<?php

namespace App\Http\Livewire\Backend\User\Settings;

use Livewire\Component;
use Auth;

class Emergency extends Component
{
    public $btn_text = "Submit";
    public function render()
    {
        return view('livewire.backend.user.settings.emergency');
    }
}
