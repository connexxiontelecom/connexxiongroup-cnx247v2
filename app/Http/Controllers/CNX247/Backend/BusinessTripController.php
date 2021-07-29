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
use DateTime;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BusinessTripController extends Controller
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
        return view('backend.workflow.business.business-trip', ['storage_capacity' => $storage]);
    }

    public function store(Request $request)
		{
			$this->validate($request, [
				'title' => 'required',
				'description' => 'required',
				'start_date' => 'required|date',
				'end_date' => 'required|date|after_or_equal:start_date',
				'request_type'=>'required'
			],[
				'title.required'=>'Enter a title for this request',
				'description.required'=>'Give a brief description of this request',
				'start_date.required'=>'Select start date',
				'end_date.required'=>'Select end date'
			]);
			$specific_approvers = $this->specificapprover->getSpecificApproversByRequesterId($request->request_type);
			$normal_processors = $this->requestapprover->getNormalApproversByRequesTypeAndDepartment($request->request_type);
			if($specific_approvers->count() > 0 || $normal_processors->count() > 0){
				#Publish new workflow request
				$workflow = $this->setNewBusinessTrip($request);
				if(!empty($request->file('attachment'))){
					$this->postattachment->uploadAttachment($request, $workflow->id);
				}
				#specific approvers has priority over normal processors
				if($specific_approvers->count() > 0){
					foreach($specific_approvers as $specific_approver){
						$this->responsibleperson->setNewResponsiblePersons($workflow->id, $request->request_type, $specific_approver->processor_id);
					}
					//$user->notify(new NewPostNotification($business));
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

    }

    public function setNewBusinessTrip(Request $request){
			$business = new Post;
			$business->post_title = $request->title;
			$business->budget = $request->amount;
			$business->currency = $request->currency;
			$business->post_type = 'business-trip';
			$business->post_content = $request->description ?? '';
			$business->location = $request->destination;

			$startDateInstance = new DateTime($request->start_date);
			$business->start_date = $startDateInstance->format('Y-m-d H:i:s');
			$dueDateInstance = new DateTime($request->end_date);
			$business->end_date = $dueDateInstance->format('Y-m-d H:i:s');

			$business->post_status = 'in-progress';
			$business->user_id = Auth::user()->id;
			$business->tenant_id = Auth::user()->tenant_id;
			$business->post_url = Str::slug($request->title).'-'.substr(sha1(time()),32,40);
			$business->save();

			return $business;
		}
}
