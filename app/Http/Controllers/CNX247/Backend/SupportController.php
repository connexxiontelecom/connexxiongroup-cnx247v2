<?php

namespace App\Http\Controllers\CNX247\Backend;

use App\Department;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Ticket;
use App\TicketCategory;
use Auth;


class SupportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->supportticket = new Ticket();
    }

    public function ticket(){

        return view('backend.crm.support.ticket');
    }
    public function ticketHistory(){
        return view('backend.crm.support.ticket-index');
    }

    public function viewTicket($slug){
        return view('backend.crm.support.view-ticket');
    }

    public function adminTicketIndex(){
    	$departments = Department::where('tenant_id', Auth::user()->tenant_id)->get();
        return view('backend.crm.support.admin.index', ['departments'=>$departments]);
    }
    public function newTicketCategory(Request $request){
        $this->validate($request,[
            'category_name'=>'required'
        ]);
        $category = new TicketCategory;
        $category->name = $request->category_name;
        $category->department = $request->department ?? '';
        $category->save();
        return response()->json(['message'=>'Success! New category saved.'], 200);
    }

    public function supportTickets(){
			return view('backend.crm.support.admin.support-tickets',['tickets'=>$this->supportticket->getAllTickets()]);
		}
}
