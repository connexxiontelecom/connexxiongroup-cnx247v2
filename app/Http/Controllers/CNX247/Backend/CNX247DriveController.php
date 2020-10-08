<?php

namespace App\Http\Controllers\CNX247\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Folder;
use App\FileModel;
use App\SharedFile;
use App\User;
use Auth;
use Storage;
use File;
use Response;
class CNX247DriveController extends Controller
{
    public $root = 'assets/uploads/cnxdrive/';
    public function __construct()
    {
        $this->middleware('auth');
    }

    #Tutorial
    public function show(){
        # return Storage::files('public'); // return all files in a directory
        #Show file url by file name
        #return Storage::url($this->root.'/'.'cus_15967230642020.jpeg');
        $url =  Storage::url($this->root.'/'.'cus_15967230642020.jpeg');
        # return "<img src='".$url."' />";
        #Get file size
        $size = Storage::size($this->root.'/'.'cus_15967230642020.jpeg');
        return $size;
    }

    /*
    * Load activity stream index page
    */
    public function index(){

        //$directory = Storage::allDirectories(public_path());
        $files = Storage::allFiles($this->root);
        $directories = Storage::allDirectories($this->root);
        $myFiles = FileModel::where('tenant_id', Auth::user()->tenant_id)
                            ->where('uploaded_by', Auth::user()->id)->get();
        $sharedFiles = SharedFile::where('tenant_id', Auth::user()->tenant_id)
                            ->where('shared_with', Auth::user()->id)->get();
        $size = FileModel::where('tenant_id', Auth::user()->tenant_id)
                            ->where('uploaded_by', Auth::user()->id)->sum('size');
        $employees = User::where('tenant_id', Auth::user()->tenant_id)->get();
        //return dd($files);
        return view('backend.cnx247drive.index',
        ['directories'=>$directories,
        'files'=>$files,
        'myFiles'=>$myFiles,
        'size'=>$size,
        'employees'=>$employees,
        'sharedFiles'=>$sharedFiles
        ]);
    }

    /*
    * Make directory
    */
    public function createDirectory(Request $request){
        $this->validate($request,[
            'folder_name'=>'required'
        ]);
        $folder = new Folder;
        $folder->folder = $request->folder_name;
        $folder->created_by = Auth::user()->id;
        $folder->tenant_id = Auth::user()->tenant_id;
        $folder->password = !empty($request->password)  ? bcrypt($request->password) : '';
        $folder->location = $this->root;
        $folder->save();
        Storage::makeDirectory($this->root.'/'.$request->folder_name); //create directory
        #Storage::deleteDirectory($this->root.'/'.$request->folder_name); //delete directory
        session()->flash("success", "<strong>Success!</strong> Folder created");
        return redirect()->back();
    }

    /*
    * Upload file to directory
    */
    public function uploadFile(Request $request){
        if($request->hasFile('attachment')){
            //$request->file('attachment');

        if(!empty($request->attachment)){
            $extension = $request->file('attachment');
            $extension = $request->file('attachment')->getClientOriginalExtension();
            $filename = Auth::user()->tenant->company_name.'_'.uniqid().'_'.time().'_'.date('Ymd').'.'.$extension;
            $dir = 'assets/uploads/cnxdrive/';
            $request->file('attachment')->move(public_path($this->root), $filename);
            //$request->share_file->storeAs('workgroup', $filename);
/*             $post_attachment = new WorkgroupAttachment;
            $post_attachment->attachment = $filename;
            $post_attachment->tenant_id = Auth::user()->tenant_id;
            $post_attachment->workgroup_id = $request->fileGroupId;
            $post_attachment->post_id = $postId;
            $post_attachment->user_id = Auth::user()->id;
            $post_attachment->save(); */
        }

           // $request->attachment->storeAs('workgroup', Auth::user()->tenant->company_name.'_'.time().date('Y').'.'.$request->attachment->extension());
            #Path
                //$request->attachment->path();
            #extension
                //$request->attachment->extension();
            #Store file
               //1.  $request->attachment->store('public');
               //2.  Storage::putFile('public', $request->file('attachment')); //use storage function
        }else{
            return 'No file selected.';
        }
    }

    public function uploadAttachment(Request $request){
         $this->validate($request,[
            'attachment'=>'required'
        ]);
        $consumption = FileModel::where('tenant_id', Auth::user()->tenant_id)
                                ->where('uploaded_by', Auth::user()->id)->sum('size');
        if($consumption > 50000048){
            return response()->json(["error"=>"Ooops! You've reached your maximum storage space. Upgrade. ".$consumption], 400);
        }else{
            if(!empty($request->file('attachment'))){
                $extension = $request->file('attachment');
                $extension = $request->file('attachment')->getClientOriginalExtension();
                $size = $request->file('attachment')->getSize();
                $dir = 'assets/uploads/cnxdrive/';
                $filename = uniqid().'_'.time().'_'.date('Ymd').'.'.$extension;
                $request->file('attachment')->move(public_path($dir), $filename);
            }else{
                $filename = '';
            }
            $file = new FileModel;
            $file->tenant_id = Auth::user()->tenant_id;
            $file->uploaded_by = Auth::user()->id;
            $file->filename = $filename;
            $file->name = $request->filename;
            $file->size = $size;
            $file->save();
            return response()->json(['message', 'Success! File uploaded.'], 200);
        }
    }

    public function downloadAttachment(Request $request){
        $this->validate($request,[
            'attachment'=>'required'
        ]);

        $file = public_path("assets/uploads/cnxdrive/".$request->attachment);
        $headers = array(
            "Content-Type: application/".$request->extension
        );
        return Response::download($file, 'Hello.pdf', $headers);
    }

    public function shareAttachment(Request $request){
        $this->validate($request,[
            //'employees'=>'required',
            'id'=>'required'
        ]);
        if($request->all == 32){
            $users = User::where('tenant_id', Auth::user()->tenant_id)->where('id', '!=', Auth::user()->id)->get();
            foreach($users as $user){
                $share = new SharedFile;
                $share->owner = Auth::user()->id;
                $share->file_id = $request->id;
                $share->tenant_id = Auth::user()->tenant_id;
                $share->shared_with = $user->id;
                $share->save();
            }
        }else{
            foreach($request->employees as $employee){
                $share = new SharedFile;
                $share->owner = Auth::user()->id;
                $share->file_id = $request->id;
                $share->tenant_id = Auth::user()->tenant_id;
                $share->shared_with = $employee;
                $share->save();
            }
        }
        if($share){
            return response()->json(['message'=>'Success! File shared.'],200);
        }else{
            return response()->json(['error'=>'Ooops File shareing failed.'],400);
        }

    }
    public function deleteAttachment(Request $request){
        $this->validate($request,[
            'directory'=>'required',
            'id'=>'required'
        ]);
        $file = FileModel::where('tenant_id', Auth::user()->tenant_id)->where('id', $request->id)->first();
        if(!empty($file) ){
            $file->delete();
            unlink(public_path("assets/uploads/cnxdrive/".$request->directory));
            $shared = SharedFile::where('tenant_id', Auth::user()->tenant_id)
                                ->where('file_id', $request->id)
                                ->get();
            if(!empty($shared) ){
                foreach($shared as $sh){
                    $sh->delete();
                }
            }
            return response()->json(['message'=>'Success! File deleted.'], 200);
        }else{
            return response()->json(['error'=>'Ooops! File does not exist'], 400);
        }
        foreach($request->employees as $employee){
            $share = new SharedFile;
            $share->owner = Auth::user()->id;
            $share->file_id = $request->id;
            $share->tenant_id = Auth::user()->tenant_id;
            $share->shared_with = $employee;
            $share->save();
        }
        if($share){
            return response()->json(['message'=>'Success! File shared.'],200);
        }else{
            return response()->json(['error'=>'Ooops File shareing failed.'],400);
        }

    }
}
