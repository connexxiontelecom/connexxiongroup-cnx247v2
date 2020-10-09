<?php

namespace App\Http\Livewire\Backend\Crm\Clients;

use Livewire\Component;
use App\Client;
use App\Country;
use Auth;

class Create extends Component
{
    public $title, $first_name, $surname, $suffix, $mobile_no, $email, $website, $street_1, $street_2;
    public $country, $state, $city, $postal_code, $note;

    public function render()
    {
        return view('livewire.backend.crm.clients.create', ['countries'=>Country::orderBy('name', 'ASC')->get()]);
    }

    public function addNewClient(){
        $this->validate([
            'title'=>'required',
            'first_name'=>'required',
            'surname'=>'required',
            'mobile_no'=>'required',
            'street_1'=>'required',
            'email'=>'required|email',
            'country'=>'required',
            'state'=>'required',
            'city'=>'required'
        ]);
        $client = new Client;
        $client->owner = Auth::user()->id;
        $client->assigned_to = Auth::user()->id;
        $client->title = $this->title;
        $client->first_name = $this->first_name;
        $client->surname = $this->surname;
        $client->mobile_no = $this->mobile_no;
        $client->suffix = $this->suffix ?? '';
        $client->website = $this->website ?? '';
        $client->street_1 = $this->street_1;
        $client->street_2 = $this->street_2 ?? '';
        $client->email = $this->email;
        $client->country_id = $this->country;
        $client->state_id = $this->state;
        $client->city = $this->city;
        $client->postal_code = $this->postal_code;
        $client->note = $this->note ?? '';
        $client->tenant_id = Auth::user()->tenant_id ?? 0;
        $client->slug = substr(sha1(time()), 13,40);
        $client->save();
        session()->flash("success", "<strong>Success!</strong> New client registered.");
        return redirect()->route('clients');
    }
}
