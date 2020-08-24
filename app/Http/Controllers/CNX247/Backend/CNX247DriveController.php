<?php

namespace App\Http\Controllers\CNX247\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Folder;
use Auth;
use Storage;
use File;
class CNX247DriveController extends Controller
{
    //public $root = 'public/assets/uploads/cnx247drive';
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
        //return dd($files);
        return view('backend.cnx247drive.index', ['directories'=>$directories, 'files'=>$files]);
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
}
