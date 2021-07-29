<?php

namespace App\Http\Controllers\CNX247\Backend;

use App\Driver;
use App\FileModel;
use App\Http\Controllers\Controller;
use App\SpecificApprover;
use App\WorkgroupAttachment;
use Illuminate\Http\Request;
use App\Notifications\NewPostNotification;
use App\BusinessLog;
use App\PostAttachment;
use App\RequestApprover;
use App\ResponsiblePerson;
use App\Post;
use App\User;
use Auth;
use Illuminate\Support\Facades\DB;

class PurchaseRequestController extends Controller
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
			$plan_details = DB::table('plan_features')
				->where('plan_id', '=', Auth::user()->tenant->plan_id)
				->first();

			$storage_size = $plan_details->storage_size;

			$size = FileModel::where('tenant_id', Auth::user()->tenant_id)
				->where('uploaded_by', Auth::user()->id)->sum('size');

			$postAttachments = PostAttachment::where('tenant_id', Auth::user()->tenant_id)->get();

			$sum_post_attachment = 0;
			foreach ($postAttachments as $postAttachment):
				if(file_exists(public_path('assets\uploads\attachments\\'.$postAttachment->attachment))):
					$fileSize = \File::size(public_path('assets\uploads\attachments\\'.$postAttachment->attachment));
					//echo $fileSize;
					$sum_post_attachment = $sum_post_attachment + $fileSize;
				endif;
			endforeach;

			$workgroupAttachments = WorkgroupAttachment::where('tenant_id', Auth::user()->tenant_id)->get();

			$sum_workgroup_attachment = 0;
			foreach ($workgroupAttachments as $workgroupAttachment):
				if(file_exists(public_path('assets\uploads\attachments\\'.$workgroupAttachment->attachment))):
					$fileSize = \File::size(public_path('assets\uploads\attachments\\'.$workgroupAttachment->attachment));

					$sum_workgroup_attachment = $sum_workgroup_attachment + $fileSize;
				endif;

			endforeach;

			$drivers = Driver::where('tenant_id', Auth::user()->tenant_id)->get();

			$sum_driver_attachment = 0;

			foreach($drivers as $driver):
				if(file_exists(public_path('assets\uploads\logistics\\'.$driver->attachment))):
					$fileSize = \File::size(public_path('assets\uploads\logistics\\'.$driver->attachment));
					//echo $fileSize;
					$sum_driver_attachment = $sum_driver_attachment + $fileSize;
				endif;
			endforeach;


			$size = ($sum_post_attachment + $sum_driver_attachment + $sum_workgroup_attachment + $size)/1000000000;

			if($size >= $storage_size):

				$storage = 0;

			else:

				$storage = 1;

			endif;
        return view('backend.workflow.purchase.index', ['storage_capacity' => $storage]);
    }

    public function store(Request $request){
        $this->validate($request,[
            'title'=>'required',
            'amount'=>'required',
					  'request_type'=>'required',
        ],[
        	'title.required'=>'Enter a title for your request',
					'amount.required'=>'Enter an amount for this request'
				]);
				$specific_approvers = $this->specificapprover->getSpecificApproversByRequesterId($request->request_type);

        /*$specific = SpecificApprover::where('request_type', 'purchase-request')
                                    ->where('requester_id', Auth::user()->id)
                                    ->where('tenant_id', Auth::user()->tenant_id)
                                    ->first();*/
				$normal_processors = $this->requestapprover->getNormalApproversByRequesTypeAndDepartment($request->request_type);
				/*
        $processor = RequestApprover::select('user_id')
                                    ->where('request_type', 'purchase-request')
                                    ->where('depart_id', Auth::user()->department_id)
                                    ->where('tenant_id', Auth::user()->tenant_id)
                                    ->first();*/
			if($specific_approvers->count() > 0 || $normal_processors->count() > 0){
				#Publish new workflow request
				$workflow = $this->post->setNewWorkflowRequest($request);
				if(!empty($request->file('attachment'))){
					$this->postattachment->uploadAttachment($request, $workflow->id);
				}
					#specific approvers has priority over normal processors
					if($specific_approvers->count() > 0){
						foreach($specific_approvers as $specific_approver){
							$this->responsibleperson->setNewResponsiblePersons($workflow->id, $request->request_type, $specific_approver->processor_id);
						}
						$this->responsibleperson->markFirstUnseenAsSeen($workflow->id);
						session()->flash("success", "<strong>Success!</strong> Your request was submitted successfully.");
						return back();
					}
					#Check if this person is not in the exception or special list
				if($specific_approvers->count() <= 0){
					if($normal_processors->count() > 0){
						foreach($normal_processors as $normal_processor){
							$this->responsibleperson->setNewResponsiblePersons($workflow->id, $request->request_type, $normal_processor->user_id);
						}
						$this->responsibleperson->markFirstUnseenAsSeen($workflow->id);
						session()->flash("success", "<strong>Success!</strong> Your request was submitted successfully.");
						return back();
					}else{
						session()->flash("error", "<strong>Whoops!</strong> There're no person(s) setup to process request for you.");
						return back();
					}
				}
			}else{
				session()->flash("error", "<strong>Whoops!</strong> There're no person(s) setup to process request for you.");
				return back();
			}
      /*  if(empty($processor) && empty($specific)){
            return response()->json(["error"=>"Error! Could not submit. No processor found."],400);
        }else{*/

           /* #Publish new workflow request
						$workflow = $this->post->setNewWorkflowRequest($request);

						//specific approvers has priority over normal processors
						if($specific_approvers->count() > 0){
							foreach($specific_approvers as $specific_approver){
								$this->responsibleperson->setNewResponsiblePersons($workflow->id, $request->request_type, $specific_approver->processor_id);
							}
						}*/

            /*$url = substr(sha1(time()), 10,10);
            $requisition = new Post;
            $requisition->post_title = $request->title;
            $requisition->budget = $request->amount;
            $requisition->currency = $request->currency;
            $requisition->post_type = 'purchase-request';
            $requisition->post_content = $request->description;
            $requisition->post_status = 'in-progress';
            $requisition->user_id = Auth::user()->id;
            $requisition->tenant_id = Auth::user()->tenant_id;
            $requisition->post_url = $url;
            $requisition->save();*/
           /* if(!empty($request->file('attachment'))){
            	$this->postattachment->uploadAttachment($request, $workflow->id);
            }*/
            /*if(!empty($specific)){
							$event = new ResponsiblePerson;
							$event->post_id = $id;
							$event->post_type = 'purchase-request';
							$event->user_id = $specific->processor_id;
							$event->tenant_id = Auth::user()->tenant_id;
							$event->save();
							$user = User::find($specific->processor_id);
							$user->notify(new NewPostNotification($requisition));

						}else{
							$event = new ResponsiblePerson;
							$event->post_id = $id;
							$event->post_type = 'purchase-request';
							$event->user_id = $processor->user_id;
							$event->tenant_id = Auth::user()->tenant_id;
							$event->save();
							$user = User::find($processor->user_id);
							$user->notify(new NewPostNotification($requisition));
						}*/


            //Register business process log
            /*$log = new BusinessLog;
            $log->request_id = $id;
            $log->user_id = Auth::user()->id;
            $log->note = "Approval for purchase request ".$request->title." registered.";
            $log->name = "Registering purchase request";
            $log->tenant_id = Auth::user()->tenant_id;
            $log->save();

            //identify supervisor
            $supervise = new BusinessLog;
            $supervise->request_id = $id;
            $supervise->user_id = Auth::user()->id;
            $supervise->name = "Log entry";
            $supervise->note = "Identifying processor for ".Auth::user()->first_name." ".Auth::user()->surname;
            $supervise->tenant_id = Auth::user()->tenant_id;
            $supervise->save();

            session()->flash("success", "Purchase request saved.");
         return response()->json(['message'=>'Success! Purchase request  submitted.']);*/

        //}
    }
}
