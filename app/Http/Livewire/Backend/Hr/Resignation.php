<?php

namespace App\Http\Livewire\Backend\Hr;

use Livewire\Component;
use App\User;
use App\Resignation as ResignationModel;
use Auth;

class Resignation extends Component
{   public $approved, $declined, $inProgress;
    public $resignations;

    public function render()
    {
        return view('livewire.backend.hr.resignation');
    }

    public function mount(){
        $this->approved = ResignationModel::where('status', 'approved')->where('tenant_id',Auth::user()->tenant_id)->count();
        $this->declined = ResignationModel::where('status', 'declined')->where('tenant_id',Auth::user()->tenant_id)->count();
        $this->inProgress = ResignationModel::where('status', 'in-progress')->where('tenant_id',Auth::user()->tenant_id)->count();
        $this->resignations = ResignationModel::where('user_id', Auth::user()->id)->where('tenant_id',Auth::user()->tenant_id)->get();
    }
}
