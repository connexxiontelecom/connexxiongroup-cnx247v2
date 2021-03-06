<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{





    //category-ticket relationship
    public function ticketCategory(){
        return $this->belongsTo(TicketCategory::class, 'category');
    }

    public function getUser(){
    	return $this->belongsTo(User::class, 'user_id');
		}


		public function getAllTickets(){
    	return Ticket::orderBy('id', 'DESC')->get();
		}
}
