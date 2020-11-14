<?php

namespace App\Http\Controllers\CNX247\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Notifications\NewPostNotification;
use App\Post;
use App\ResponsiblePerson;
use App\ProjectBudget;
use App\Invoice;
use App\InvoiceItem;
use App\Receipt;
use App\ReceiptItem;
use App\Participant;
use App\Observer;
use App\Priority;
use App\Milestone;
use App\Status;
use App\Link;
use App\User;
use App\Client;
use App\Budget;
use App\Supplier;
use App\BillMaster;
use App\BillDetail;
use App\Policy;
use Schema;
use Auth;
use DB;
class ProjectController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /*
    * project board
    */
    public function projectBoard(){
        return view('backend.project.project-board');
    }
    /*
    * New task
    */
    public function newProject(){
        $users = User::select('first_name', 'surname', 'id')
                            ->where('account_status',1)->where('verified', 1)
                            ->where('tenant_id',Auth::user()->tenant_id)
                            ->orderBy('first_name', 'ASC')->get();
        $budgets = Budget::where('tenant_id', Auth::user()->tenant_id)->get();
        return view('backend.project.new-project',['users'=>$users, 'budgets'=>$budgets]);
    }
    /*
    * store new task
    */
    public function storeProject(Request $request){

        $this->validate($request,[
            'project_name'=>'required',
            'responsible_persons'=>'required',
            'project_description'=>'required',
            'due_date'=>'required|date|after_or_equal:start_date',
            'start_date'=>'required|date',
            'project_sponsor'=>'required'
        ]);

        $url = substr(sha1(time()), 10, 10);
        $project = new Post;
        $project->post_title = $request->project_name;
        $project->user_id = Auth::user()->id;
        $project->post_content = $request->project_description;
        $project->post_color = $request->color;
        $project->project_manager_id = $request->project_manager;
        $project->post_type = 'project';
        $project->post_url = $url;
        $project->budget = $request->budget ?? '';
        $project->sponsor = $request->project_sponsor;
        $project->start_date = $request->start_date ?? '';
        $project->end_date = $request->due_date;
        $project->post_priority = $request->priority;
        $project->tenant_id = Auth::user()->tenant_id;
        //$task->attachment = $filename;
        $project->save();
        $project_id = $project->id;
        //responsible persons
        if(!empty($request->responsible_persons)){
            foreach($request->responsible_persons as $responsible){

               /*  $user = User::select('first_name', 'surname', 'email', 'id')->where('id', $participant)->first();
                \Mail::to($user->email)->send(new MailTask($user, $request, $url)); */
                $part = new ResponsiblePerson;
                $part->post_id = $project_id;
                $part->post_type = 'project';
                $part->user_id = $responsible;
                $part->tenant_id = Auth::user()->tenant_id;
                $part->save();
                //notify this user
                $user = User::find($responsible);
                $user->notify(new NewPostNotification($project));
            }
        }
        //participants
        if(!empty($request->participants)){
            foreach($request->participants as $participant){

               /*  $user = User::select('first_name', 'surname', 'email', 'id')->where('id', $participant)->first();
                \Mail::to($user->email)->send(new MailTask($user, $request, $url)); */
                $part = new Participant;
                $part->post_id = $project_id;
                $part->post_type = 'project';
                $part->user_id = $participant;
                $part->tenant_id = Auth::user()->tenant_id;
                $part->save();
            }
        }
        //observers
        if(!empty($request->observers)){
            foreach($request->observers as $observer){

               /*  $user = User::select('first_name', 'surname', 'email', 'id')->where('id', $participant)->first();
                \Mail::to($user->email)->send(new MailTask($user, $request, $url)); */
                $part = new Observer;
                $part->post_id = $project_id;
                $part->post_type = 'project';
                $part->user_id = $observer;
                $part->tenant_id = Auth::user()->tenant_id;
                $part->save();
            }
        }
        session()->flash("success", "<strong>Success! </strong> Project created.");
        return redirect()->route('project-board');
    }


    /*
    * New task
    */
    public function viewProject(){

        return view('backend.project.view-project');
    }
    public function projectBudget($url){

        $project = Post::where('post_url', $url)
                        ->where('tenant_id',Auth::user()->tenant_id)->first();
        if(!empty($project)){
            $budgets = ProjectBudget::where('project_id', $project->id)->get();
            return view('backend.project.budget',['project'=>$project, 'budgets'=>$budgets]);
        }else{
            session()->flash("error", "<strong>Ooops!</strong> Record not found.");
            return back();
        }
    }

    public function storeProjectBudget(Request $request){
        $this->validate($request,[
            'budget_head'=>'required',
            'amount'=>'required'
        ]);
        $budget = new ProjectBudget;
        $budget->budget_title = $request->budget_head;
        $budget->budget_amount = $request->amount;
        $budget->comment = $request->comment;
        $budget->created_by = Auth::user()->id;
        $budget->tenant_id = Auth::user()->tenant_id;
        $budget->project_id = $request->projectId;
        $budget->save();
        session()->flash("success", "<strong>Success!</strong> Budget saved.");
        return back();

    }
    /*
    * Project calendar
    */
    public function projectCalendar(){
        return view('backend.project.project-calendar');
    }

    /*
    * Project calendar
    */
    public function getProjectCalendarData(){
        $project = Post::select('post_title as title', 'start_date as start', 'end_date as end', 'post_color as color')
                    ->where('post_type', 'project')
                    ->where('tenant_id', Auth::user()->tenant_id)->get();
        return response($project);
    }
    /*
    * Project gantt chart [view]
    */
    public function projectGanttChart(){
        return view('backend.project.project-gantt-chart');
    }
    /*
    * Project Gantt Chart
    */
    public function getProjectGanttChartData(){
        $project = Post::select('post_title as text', 'start_date', 'end_date', 'post_color as color')
                    ->where('post_type', 'project')
                    ->where('tenant_id', Auth::user()->tenant_id)
                    ->orderBy('id', 'DESC')
                    ->get();
        $links = Link::all();
        return response()->json([
            'data'=>$project,
            'links'=>$links
             ]);
    }

    /*
    * Project analytics
    */
    public function projectAnalytics(){
        return view('backend.project.project-analytics');
    }

     /*
    * edit project
    */
    public function editProject($url){
        $users = User::select('first_name', 'surname', 'id')
                    ->where('account_status',1)->where('verified', 1)
                    ->where('tenant_id',Auth::user()->tenant_id)
                    ->orderBy('first_name', 'ASC')->get();
        $priorities = Priority::all();
        $statuses = Status::all();
        $project = Post::where('post_url', $url)->where('tenant_id', Auth::user()->tenant_id)->first();
        if(!empty($project) ){
            return view('backend.project.edit-project',[
                'users'=>$users,
                'priorities'=>$priorities,
                'statuses'=>$statuses,
                'project'=>$project
            ]);

        }else{
            return redirect()->route('404');
        }
    }

        /*
    * update project
    */
    public function updateProject(Request $request){
        //return dd($request->all());
        $this->validate($request,[
            'project_name'=>'required',
            'project_description'=>'required',
            'due_date'=>'required|date',
            'start_date'=>'required|after_or_equal:due_date',
            'project_sponsor'=>'required'
        ]);
        $project = Post::where('post_url', $request->url)->where('tenant_id', Auth::user()->tenant_id)->first();
        $project->post_title = $request->project_name;
        $project->user_id = Auth::user()->id;
        $project->post_content = $request->project_description;
        $project->post_color = $request->color;
        $project->project_manager_id = $request->project_manager;
        $project->post_type = 'project';
        $project->post_url = $request->url;
        $project->sponsor = $request->project_sponsor;
        $project->start_date = $request->start_date ?? '';
        $project->end_date = $request->due_date;
        $project->post_priority = $request->priority;
        $project->tenant_id = Auth::user()->tenant_id;
        $project->save();
        session()->flash("success", "<strong>Success!</strong> Project changes saved.");
        return redirect()->route('project-board');
    }

    public function createProjectMilestone(Request $request){
        $this->validate($request,[
            'title'=>'required',
            'due_date'=>'required|date'
        ]);
        $milestone = new Milestone;
        $milestone->title = $request->title;
        $milestone->due_date = $request->due_date;
        $milestone->description = $request->description;
        $milestone->tenant_id = Auth::user()->tenant_id;
        $milestone->user_id = Auth::user()->id;
        $milestone->post_id = $request->post_id;
        $milestone->save();
        return response()->json(['message'=>'Success! Project milestone created.'], 200);
    }

    public function deleteProject(Request $request){
        $this->validate($request,[
            'projectId'=>'required'
        ]);
        $task = Post::where('tenant_id', Auth::user()->tenant_id)
                    ->where('id', $request->projectId)->first();
        if(!empty($task) ){
            $task->delete();
            $responsible = ResponsiblePerson::where('post_id', $request->projectId)
                                            ->where('tenant_id', Auth::user()->tenant_id)
                                            ->get();
            if(!empty($responsible) ){
                foreach($responsible as $person){
                    $person->delete();
                }
            }
            #Observers
            $observers = Observer::where('post_id', $request->projectId)
                                            ->where('tenant_id', Auth::user()->tenant_id)
                                            ->get();
            if(!empty($observers) ){
                foreach($observers as $observer){
                    $observer->delete();
                }
            }
            #Participants
            $participants = Participant::where('post_id', $request->projectId)
                                            ->where('tenant_id', Auth::user()->tenant_id)
                                            ->get();
            if(!empty($participants) ){
                foreach($participants as $participant){
                    $participant->delete();
                }
            }
        }
        session()->flash("success", "<strong>Success!</strong> Task deleted.");
        return redirect()->back();
    }



    public function addResponsiblePerson(Request $request)
    {

        $this->validate($request, [
            'taskId' => 'required',
            'responsible_persons' => 'required',
        ]);

        $task = Post::where('tenant_id', Auth::user()->tenant_id)
            ->where('id', $request->taskId)->first();

        if (!empty($request->responsible_persons)) {
            foreach ($request->responsible_persons as $participant) {
                /*  $user = User::select('first_name', 'surname', 'email', 'id')->where('id', $participant)->first();
                \Mail::to($user->email)->send(new MailTask($user, $request, $url)); */
                $part = new ResponsiblePerson;

                $exists = ResponsiblePerson::where('tenant_id', Auth::user()->tenant_id)->where('user_id', $participant)->where('post_id', $request->taskId)->first();

                if (empty($exists) || is_null($exists)) {

                    $part->post_id = $request->taskId;
                    $part->post_type = 'project';
                    $part->user_id = $participant;
                    $part->tenant_id = Auth::user()->tenant_id;
                    $part->save();
                    $user = User::find($participant);
                    $user->notify(new NewPostNotification($task));

                }
            }
        }
        return redirect()->route('view-project', ["url" => $request->url]);
    }



    public function addParticipant(Request $request)
    {

        $this->validate($request, [
            'taskId' => 'required',
            'participants' => 'required',
        ]);

        $task = Post::where('tenant_id', Auth::user()->tenant_id)
            ->where('id', $request->taskId)->first();

        if (!empty($request->participants)) {
            foreach ($request->participants as $participant) {
                /*  $user = User::select('first_name', 'surname', 'email', 'id')->where('id', $participant)->first();
                \Mail::to($user->email)->send(new MailTask($user, $request, $url)); */
                $part = new Participant();

                $exists = Participant::where('tenant_id', Auth::user()->tenant_id)->where('user_id', $participant)->where('post_id', $request->taskId)->first();

                if (empty($exists) || is_null($exists)) {

                    $part->post_id = $request->taskId;
                    $part->post_type = 'project';
                    $part->user_id = $participant;
                    $part->tenant_id = Auth::user()->tenant_id;
                    $part->save();
                    $user = User::find($participant);
                    $user->notify(new NewPostNotification($task));

                }
            }
        }
        return redirect()->route('view-project', ["url" => $request->url]);
    }


    public function addObserver(Request $request)
    {

        $this->validate($request, [
            'taskId' => 'required',
            'observers' => 'required',
        ]);

        $task = Post::where('tenant_id', Auth::user()->tenant_id)
            ->where('id', $request->taskId)->first();

        if (!empty($request->observers)) {
            foreach ($request->observers as $participant) {
                /*  $user = User::select('first_name', 'surname', 'email', 'id')->where('id', $participant)->first();
                \Mail::to($user->email)->send(new MailTask($user, $request, $url)); */
                $part = new Observer();

                $exists = Observer::where('tenant_id', Auth::user()->tenant_id)->where('user_id', $participant)->where('post_id', $request->taskId)->first();

                if (empty($exists) || is_null($exists)) {

                    $part->post_id = $request->taskId;
                    $part->post_type = 'project';
                    $part->user_id = $participant;
                    $part->tenant_id = Auth::user()->tenant_id;
                    $part->save();
                    $user = User::find($participant);
                    $user->notify(new NewPostNotification($task));

                }
            }
        }
        return redirect()->route('view-project', ["url" => $request->url]);
    }

    public function projectInvoice($slug){
        $status = null;
        $project = Post::where('post_url', $slug)->where('tenant_id', Auth::user()->tenant_id)->first();
        $clients = Client::where('tenant_id', Auth::user()->tenant_id)->get();
        $invoice_no = null;
        $invoice = Invoice::where('tenant_id', Auth::user()->tenant_id)
                                ->where('project_id', $project->id)
                                ->orderBy('project_id', 'DESC')->first();
        if(Schema::connection('mysql')->hasTable(Auth::user()->tenant_id.'_coa')){
            $status = 1; //subscribed for accounting package
            if(!empty($invoice)){
                $invoice_no = $invoice->invoice_no + 1;
            }else{
                $invoice_no = 1000;
            }
            if(!empty($project)){
                $accounts = DB::table(Auth::user()->tenant_id.'_coa')->where('type', 'Detail')->select()->get();
                return view('backend.project.invoice', [
                    'project'=>$project,
                    'accounts'=>$accounts,
                    'status'=>$status,
                    'clients'=>$clients,
                    'invoice_no'=>$invoice_no
                    ]);
            }else{
                session()->flash("error", "<strong>Ooops!</strong> No record found.");
                return back();
            }
        }else{
            $accounts = DB::table(Auth::user()->tenant_id.'_coa')->where('type', 'Detail')->select()->get();
            return view('backend.project.invoice', [
                'project'=>$project,
                'accounts'=>$accounts,
                'status'=>0,
                'clients'=>$clients,
                'invoice_no'=>$invoice_no
                ]);
        }
    }

    public function storeProjectInvoice(Request $request){
        if($request->setAccount == 1){
            $this->validate($request,[
                'client'=>'required',
                'date'=>'required|date',
                'setAccount'=>'required',
                'accounts'=>'required|array',
                'amount'=>'required|array'
            ]);
        }else{
            $this->validate($request,[
                'client'=>'required',
                'date'=>'required|date',
                'accounts'=>'required|array',
                'amount'=>'required|array'
            ]);
        }
        #update client
        $updateClient = Client::where('tenant_id', Auth::user()->tenant_id)->where('id', $request->client)->first();
        if($request->setAccount == 1){
            $updateClient->glcode = $request->client_account;
            $updateClient->save();
        }
        if(count($request->accounts) > 0){
            $totalAmount = 0;
            for($i = 0;  $i<count($request->accounts); $i++){
                $totalAmount += $request->amount[$i];
            }
            $master = new Invoice;
            $master->invoice_no = $request->invoice_no;
            $master->client_id = $request->client;
            $master->project_id = $request->ref_no;
            $master->issue_date = $request->date;
            $master->due_date = $request->due_date;
            $master->total = $totalAmount;
            $master->issued_by = Auth::user()->id;
            $master->tenant_id = Auth::user()->tenant_id;
            $master->slug = substr(sha1(time()),32,40);
            $master->save();
            $invoiceId = $master->id;
                $project = Post::where('id',$request->ref_no)->where('tenant_id', Auth::user()->tenant_id)->first();
                for($i = 0; $i<count($request->accounts); $i++){
                    $invoice = new InvoiceItem;
                    $invoice->tenant_id = Auth::user()->tenant_id;
                    $invoice->description = $request->description[$i];
                    $invoice->glcode = $request->accounts[$i];
                    $invoice->total = $request->amount[$i];
                    $invoice->invoice_id = $invoiceId;
                    $invoice->client_id = $request->client;
                    $invoice->save();
                }

            #Check for accounting module
            if(Schema::connection('mysql')->hasTable(Auth::user()->tenant_id.'_coa')){
                $policy = Policy::where('tenant_id', Auth::user()->tenant_id)->first();
                $detail = InvoiceItem::where('invoice_id', $master->id)->where('tenant_id', Auth::user()->tenant_id)->get();
                # Post GL
                $invoicePost = [
                    'glcode' => $updateClient->glcode,
                    'posted_by' => Auth::user()->id,
                    'narration' => 'Invoice generation for ' . $updateClient->company_name ?? '',
                    'dr_amount' => $totalAmount + ($totalAmount*$policy->vat)/100,
                    'cr_amount' => 0,
                    'ref_no' => $master->invoice_no ?? '',
                    'bank' => 0,
                    'ob' => 0,
                    'transaction_date' => $master->created_at,
                    'created_at' => $master->created_at
                ];
                DB::table(Auth::user()->tenant_id . '_gl')->insert($invoicePost);
                $VATPost = [
                    'glcode' => $policy->glcode,
                    'posted_by' => Auth::user()->id,
                    'narration' => 'VAT on invoice no. '.$master->invoice_no.' for '.$updateClient->company_name,
                    'dr_amount' => 0,
                    'cr_amount' => ($totalAmount*$policy->vat)/100 ?? 0,
                    'ref_no' => $master->invoice_no ?? '',
                    'bank' => 0,
                    'ob' => 0,
                    'transaction_date' => $master->created_at,
                    'created_at' => $master->created_at
                ];
                DB::table(Auth::user()->tenant_id . '_gl')->insert($VATPost);
                foreach($detail as $d){
                    $receiptPost = [
                        'glcode' => $d->glcode,
                        'posted_by' => Auth::user()->id,
                        'narration' => 'Invoice generation for ' . $d->description,
                        'dr_amount' => 0,
                        'cr_amount' => $d->total ?? 0,
                        'ref_no' => $invoice->invoice_no ?? '',
                        'bank' => 0,
                        'ob' => 0,
                        'transaction_date' => $invoice->created_at,
                        'created_at' => $invoice->created_at
                    ];
                    DB::table(Auth::user()->tenant_id . '_gl')->insert($receiptPost);
                }

        }

            session()->flash("success", "<strong>Success! </strong> Invoice submitted.");
            return redirect()->route('view-project', $project->post_url);
        }else{
            session()->flash("error", "<strong>Ooops!</strong> Something went wrong. Try again.");
            return redirect()->route('view-project', $project->post_url);
        }
    }

    public function projectReceipt($slug){
        $status = null;
        $project = Post::where('post_url', $slug)->where('tenant_id', Auth::user()->tenant_id)->first();
        $invoice = Invoice::where('project_id', $project->id)->where('tenant_id', Auth::user()->tenant_id)->first();
        $receipt_no = null;
        $receipt = Receipt::where('tenant_id', Auth::user()->tenant_id)
                            ->orderBy('id', 'DESC')
                            ->first();
        $client = Client::where('tenant_id', Auth::user()->tenant_id)->where('id', $invoice->client_id)->first();
        $invoices = Invoice::where('tenant_id', Auth::user()->tenant_id)
                            ->where('status', 1)
                            ->where('project_id', $project->id)->get();
        if(Schema::connection('mysql')->hasTable(Auth::user()->tenant_id.'_coa')){
            $status = 1; //subscribed for accounting package
            if(!empty($receipt)){
                $receipt_no = $receipt->receipt_no + 1;
            }else{
                $receipt_no = 1000;
            }
            if(!empty($project)){
                $accounts = DB::table(Auth::user()->tenant_id.'_coa')->where('type', 'Detail')->select()->get();
                return view('backend.project.receipt', [
                    'project'=>$project,
                    'accounts'=>$accounts,
                    'status'=>$status,
                    'client'=>$client,
                    'receipt_no'=>$receipt_no,
                    'invoices'=>$invoices
                    ]);
            }else{
                session()->flash("error", "<strong>Ooops!</strong> No record found.");
                return back();
            }
        }else{
            $accounts = DB::table(Auth::user()->tenant_id.'_coa')->where('type', 'Detail')->select()->get();
            return view('backend.project.receipt', [
                'project'=>$project,
                'accounts'=>$accounts,
                'status'=>0,
                'client'=>$client,
                'invoice_no'=>$invoice_no,
                'invoices'=>$invoices
                ]);
        }
    }

    public function storeProjectReceipt(Request $request){
        //return dd($request->all());
        $this->validate($request,[
            'payment_date'=>'required|date',
            'payment_method'=>'required',
            'reference_no'=>'required'
        ]);
        if(count($request->amount) > 0){
            $totalAmount = 0;
            for($i = 0;  $i<count($request->amount); $i++){
                $totalAmount += $request->amount[$i];
            }
            $client = Client::where('tenant_id', Auth::user()->tenant_id)->where('id', $request->client)->first();
            $master = new Receipt;
            //$master->invoice_no = $request->invoice_no;
            $master->client_id = $request->client;
            $master->project_id = $request->ref_no;
            $master->issue_date = $request->payment_date;
            $master->payment_type = $request->payment_method;
            $master->ref_no = $request->ref_no;
            $master->amount = $totalAmount;
            $master->issued_by = Auth::user()->id;
            $master->tenant_id = Auth::user()->tenant_id;
            $master->slug = substr(sha1(time()),32,40);
            $master->save();
            $receiptId = $master->id;
                $project = Post::where('id',$request->ref_no)->where('tenant_id', Auth::user()->tenant_id)->first();
                for($i = 0; $i<count($request->accounts); $i++){
                    $invoice = new ReceiptItem;
                    $invoice->tenant_id = Auth::user()->tenant_id;
                    $invoice->receipt_id = $receiptId;
                    $invoice->invoice_id = $request->invoices[$i];
                    $invoice->glcode = $request->accounts[$i];
                    $invoice->payment = $request->payment[$i];
                    $invoice->save();
                }

            session()->flash("success", "<strong>Success! </strong> Invoice submitted.");
            return redirect()->route('view-project', $project->post_url);
        }else{
            session()->flash("error", "<strong>Ooops!</strong> Something went wrong. Try again.");
            return redirect()->route('view-project', $project->post_url);
        }
    }

    public function projectBill($slug){
        $status = null;
        $project = Post::where('post_url', $slug)->where('tenant_id', Auth::user()->tenant_id)->first();
        $vendors = Supplier::where('tenant_id', Auth::user()->tenant_id)->get();
        $clients = Client::where('tenant_id', Auth::user()->tenant_id)->get();
        $billNo = null;
        $bill = BillMaster::where('tenant_id', Auth::user()->tenant_id)->first();
        if(Schema::connection('mysql')->hasTable(Auth::user()->tenant_id.'_coa')){
            $status = 1; //subscribed for accounting package
            if(!empty($bill)){
                $billNo = $bill->bill_no + 1;
            }else{
                $billNo = 1000;
            }
            if(!empty($project)){
                $accounts = DB::table(Auth::user()->tenant_id.'_coa')->where('type', 'Detail')->select()->get();
                return view('backend.project.bill', [
                    'project'=>$project,
                    'accounts'=>$accounts,
                    'status'=>$status,
                    'clients'=>$clients,
                    'billNo'=>$billNo,
                    'vendors'=>$vendors
                    ]);
            }else{
                session()->flash("error", "<strong>Ooops!</strong> No record found.");
                return back();
            }
        }else{
            $accounts = DB::table(Auth::user()->tenant_id.'_coa')->where('type', 'Detail')->select()->get();
            return view('backend.project.invoice', [
                'project'=>$project,
                'accounts'=>$accounts,
                'status'=>0,
                'clients'=>$clients,
                'billNo'=>$billNo
                ]);
        }
    }

    public function storeProjectBill(Request $request)
    {
        $this->validate($request,[
            'vendor'=>'required',
            'bill_to'=>'required',
            'bill_no'=>'required',
            'issue_date'=>'required|date'
        ]);
        $trans_ref = strtoupper(substr(sha1(time()), 35,40));
        $totalAmount = 0;
         if(!empty($request->total)){
            for($i = 0; $i<count($request->total); $i++){
                $totalAmount += $request->total[$i];
            }
        }

        $policy = Policy::where('tenant_id', Auth::user()->tenant_id)->first();
        $bill = new BillMaster;
        $bill->tenant_id = Auth::user()->tenant_id;
        $bill->vendor_id = $request->vendor;
        $bill->bill_no = $request->bill_no;
        $bill->bill_date = $request->issue_date;
        $bill->bill_amount = $totalAmount;
        $bill->vat_amount = ($totalAmount * $policy->vat)/100;
        $bill->vat_charge = $policy->vat;
        $bill->billed_to = $request->vendor;
        $bill->instruction = $request->payment_instruction;
        $bill->user_id = Auth::user()->id;
        $bill->slug = substr(sha1(time()), 32,40);
        $bill->save();
        $billId = $bill->id;
        for($n = 0; $n<count($request->description); $n++){
            $details = new BillDetail;
            $details->tenant_id = Auth::user()->tenant_id;
            $details->bill_id = $billId;
            $details->description = $request->description[$n];
            $details->quantity = $request->quantity[$n];
            $details->glcode = $request->account[$n];
            $details->amount = $request->total[$n];
            $details->save();
        }
        #Vendor
        $vendor = Supplier::where('tenant_id', Auth::user()->tenant_id)->where('id', $request->vendor)->first();
        $vendorGl = [
            'glcode'=>$vendor->glcode,
            'posted_by'=>Auth::user()->id,
            'narration'=>'Bill raised for '.$vendor->vendor_name,
            'dr_amount'=>0,
            'cr_amount'=>$totalAmount,
            'ref_no'=>$trans_ref,
            'bank'=>0,
            'ob'=>0,
            'transaction_date'=>now(),
            'created_at'=>now() //$request->issue_date,
        ];
        #Register customer in GL table
        DB::table(Auth::user()->tenant_id.'_gl')->insert($vendorGl);
        #Vat
        $vatGl = [
            'glcode'=>$policy->glcode,
            'posted_by'=>Auth::user()->id,
            'narration'=>'VAT charged on bill no: '.$request->bill_no.' for vendor '.$vendor->company_name,
            'dr_amount'=>0,
            'cr_amount'=>($totalAmount * $policy->vat)/100,
            'ref_no'=>$trans_ref,
            'bank'=>0,
            'ob'=>0,
            'transaction_date'=>now(),
            'created_at'=>$request->issue_date,
        ];
        #Register VAT in GL table
        DB::table(Auth::user()->tenant_id.'_gl')->insert($vatGl);
        #Service
        $services = BillDetail::where('tenant_id', Auth::user()->tenant_id)->where('bill_id',$billId)->get();
        foreach($services as $serve){
            $serviceGl = [
                'glcode'=>$serve->glcode,
                'posted_by'=>Auth::user()->id,
                'narration'=>"Bill raised for ".$vendor->vendor_name." Service ID: ".$serve->description,
                'dr_amount'=>$serve->amount + (($serve->amount) * $policy->vat)/100,
                'cr_amount'=>0,
                'ref_no'=>$trans_ref,
                'bank'=>0,
                'ob'=>0,
                'transaction_date'=>now(),
                'created_at'=>$request->issue_date,
            ];
            #Register service in GL table
            DB::table(Auth::user()->tenant_id.'_gl')->insert($serviceGl);
        }
        session()->flash("success", "<strong>Success!</strong> New Bill registered.");
        return redirect()->route('vendor-bills');
    }

}
