<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Client extends Model
{
        //lead-client relationship
        public function lead(){
            return $this->hasOne(Lead::class, 'id');
        }

        public function addedBy(){
            return $this->belongsTo(User::class, 'owner');
        }



        /*
         * Use-case methods
         */
		public function getAllClients(){
			return Client::where('tenant_id', Auth::user()->tenant_id)->orderBy('id', 'DESC')->get();
		}

}
