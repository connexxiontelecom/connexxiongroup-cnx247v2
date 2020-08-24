<?php

namespace App\Http\Livewire\Backend;

use Livewire\Component;
use App\Clocker as ClockInOut;
use Carbon\Carbon;
use Auth;

class Clocker extends Component
{
    public $clocked_in ;
    public $clock_out = null;
    public $duration = null;
    public $status; // not clocked in
    public function render()
    {
        return view('livewire.backend.clocker');
    }

    /*
    * Clock in method
    */
    public function clockinBtn(){
        //register in DB
         $in = new ClockInOut;
        $in->user_id = Auth::user()->id;
        $in->clock_in = now();
        $in->tenant_id = Auth::user()->tenant_id;
        $in->status = 1; //in
        $in->save();
        return redirect()->back();
    }
    /*
    * Clock out method
    */
    public function clockoutBtn(){
        //register in DB
        $out = ClockInOut::where('user_id', Auth::user()->id)->orderBy('id', 'DESC')
                           ->where('tenant_id',Auth::user()->tenant_id)->first();
        $out->clock_out = now();
        $out->tenant_id = Auth::user()->tenant_id;
        $out->status = 0; //out
        $out->save();
        return redirect()->back();
    }

    public function mount(){
        $this->latestTimer();

    }

    /*
    * Update clocked in timer
    */
    public function updateTimer(){
        $this->latestTimer();
    }

    /*
    * Get latest timing
    */
    public function latestTimer(){
        $this->clocked_in = ClockInOut::where('user_id', Auth::user()->id)
                            ->whereDate('created_at', Carbon::today())
                            ->where('tenant_id',Auth::user()->tenant_id)
                            ->orderBy('id', 'DESC')->first();
/*         if(empty($this->clocked_in)){
            $this->status = false;
        }else{
            if(empty($this->clocked_in->clock_out)){
                $this->status = false;
            }else{
                $this->status = true;
            }
        } */
    }

}
