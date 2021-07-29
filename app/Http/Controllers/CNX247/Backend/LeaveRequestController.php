<?php

namespace App\Http\Controllers\CNX247\Backend;

use App\Http\Controllers\Controller;
use App\SpecificApprover;
use Illuminate\Http\Request;
use App\Notifications\NewPostNotification;
use App\BusinessLog;
use App\PostAttachment;
use App\RequestApprover;
use App\ResponsiblePerson;
use App\Post;
use App\User;
use Auth;
use Illuminate\Support\Str;

class LeaveRequestController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
			$this->post = new Post();
			$this->postattachment = new PostAttachment();
			$this->specificapprover = new SpecificApprover();
			$this->requestapprover = new RequestApprover();
			$this->responsibleperson = new ResponsiblePerson();
    }
    /*
    * Load Expense request index page
    */
    public function index(){

        return view('backend.workflow.leave.leave-request');
    }

    public function store(Request $request)
		{
			$this->validate($request, [
				'start_date' => 'required|date',
				'end_date' => 'required|date|after_or_equal:start_date',
				'absence_type' => 'required',
				'title' => 'required',
				'request_type'=>'required'
			], [
				'start_date.required' => 'Enter a start date',
				'end_date.required' => 'Enter an end date ',
				'absence_type.required' => 'Select absence type',
				'title.required' => 'Enter a title for this request'
			]);
			$specific_approvers = $this->specificapprover->getSpecificApproversByRequesterId($request->request_type);
			$normal_processors = $this->requestapprover->getNormalApproversByRequesTypeAndDepartment($request->request_type);
			if ($specific_approvers->count() > 0 || $normal_processors->count() > 0) {
				#Publish new workflow request
				$workflow = $this->setNewLeaveRequest($request);
				if (!empty($request->file('attachment'))) {
					$this->postattachment->uploadAttachment($request, $workflow->id);
				}
				#specific approvers has priority over normal processors
				if ($specific_approvers->count() > 0) {
					foreach ($specific_approvers as $specific_approver) {
						$this->responsibleperson->setNewResponsiblePersons($workflow->id, $request->request_type, $specific_approver->processor_id);
					}
					//$user->notify(new NewPostNotification($business));
					$this->responsibleperson->markFirstUnseenAsSeen($workflow->id);
					session()->flash("success", "<strong>Success!</strong> Your request was submitted successfully.");
					return back();
				}
				#Check if this person is not in the exception or special list
				if ($specific_approvers->count() <= 0) {
					if ($normal_processors->count() > 0) {
						foreach ($normal_processors as $normal_processor) {
							$this->responsibleperson->setNewResponsiblePersons($workflow->id, $request->request_type, $normal_processor->user_id);
						}
						$this->responsibleperson->markFirstUnseenAsSeen($workflow->id);
						session()->flash("success", "<strong>Success!</strong> Your request was submitted successfully.");
						return back();
					} else {
						session()->flash("error", "<strong>Whoops!</strong> There're no person(s) setup to process request for you.");
						return back();
					}
				}
			} else {
				session()->flash("error", "<strong>Whoops!</strong> There're no person(s) setup to process your request.");
				return back();
			}

		}

    public function setNewLeaveRequest(Request $request){
			$requisition = new Post;
			$requisition->post_title = $request->title ?? 'Leave request';
			$requisition->post_type = $request->request_type ?? '' ;
			$requisition->post_content = $request->description ?? '';
			$requisition->start_date = $request->start_date;
			$requisition->end_date = $request->end_date;
			$requisition->post_status = 'in-progress';
			$requisition->user_id = Auth::user()->id;
			$requisition->tenant_id = Auth::user()->tenant_id;
			$requisition->post_url = Str::slug($request->title);
			$requisition->save();
			return $requisition;
		}
}
