<?php

namespace App\Http\Livewire\Backend\Hr;

use Livewire\Component;
use App\Mail\onBoardEmployee;
use App\User;
use App\Department;
use Auth;

class OnBoarding extends Component
{
    public $first_name, $surname, $email_address, $mobile_no, $position, $department;
    public $hire_date, $birth_date, $start_date;
    public function render()
    {
        return view('livewire.backend.hr.on-boarding', ['departments'=>Department::where('tenant_id', Auth::user()->tenant_id)->get()]);
    }

    public function onBoardStaff(){
        $this->validate([
            'first_name'=>'required',
            'surname'=>'required',
            'email_address'=>'required|email|unique:users,email',
            'hire_date'=>'required',
            'birth_date'=>'required',
            'mobile_no'=>'required',
            'position'=>'required'
        ]);
        $password = substr(sha1(time()), 32,40);
        $user = new User;
        $user->first_name = $this->first_name;
        $user->surname = $this->surname;
        $user->email = $this->email_address;
        $user->hire_date = $this->hire_date;
        $user->start_date = $this->start_date;
        $user->birth_date = $this->birth_date;
        $user->mobile = $this->mobile_no;
        $user->position = $this->position;
        $user->tenant_id = Auth::user()->tenant->tenant_id;
        $user->password = bcrypt($password);//random password
        $user->verification_link = substr(sha1(time()), 5,15);
        $user->url = substr(sha1(time()), 29,40);
        $user->save();
        \Mail::to($user)->send(new onBoardEmployee($user, $password));
        session()->flash("success", "<strong>Success!</strong> Onboarding process done.");
        return redirect()->back();
    }
}
