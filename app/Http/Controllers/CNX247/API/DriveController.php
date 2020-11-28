<?php

namespace App\Http\Controllers\CNX247\API;

use App\Driver;
use App\FileModel;
use App\Folder;
use App\Http\Controllers\Controller;
use App\PostAttachment;
use App\SharedFile;
use App\SharedFolder;
use App\Tenant;
use App\WorkgroupAttachment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DriveController extends Controller
{
    //
    public $root = 'assets/uploads/cnxdrive/';

    public function getDriveContents(Request $request)
    {

        $me = $request->user_id;
        $tenant = $request->tenant_id;

        $myFiles = FileModel::where('tenant_id', $tenant)
            ->where('uploaded_by', $me)
            ->where('folder_id', null)->get();

        $myFiles = $this->parseUrl($myFiles, "filename");

        $sharedFiles = SharedFile::where('shared_files.tenant_id', $tenant)
            ->join('users', 'shared_files.owner', '=', 'users.id')
            ->where('shared_with', $me)->join('file_models', 'shared_files.file_id', '=', 'file_models.id')->get();

        $sharedFiles = $this->parseUrl($sharedFiles, "filename");

        $shardFolders = SharedFolder::where('shared_folders.tenant_id', $tenant)
            ->join('folders', 'shared_folders.folder_id', '=', 'folders.id')
            ->join('users', 'shared_folders.owner', '=', 'users.id')
            ->where('shared_with', $me)->get();

        $myFolders = Folder::where('tenant_id', $tenant)
            ->where('created_by', $me)
            ->where('parent_id', 0)->get();

        $publicFolders = Folder::where('tenant_id', $tenant)
            ->where('permission', 1)->get();

        //$ResponseArray["folders"] = $directories;

        return response()->json(["myfiles" => $myFiles, "myfolders" => $myFolders, "sharedfiles" => $sharedFiles, "sharedfolders" => $shardFolders, "public" => $publicFolders], 200);
    }

    public function getContents(Request $request)
    {
        $tenant = $request->tenant_id;
        $folder = $request->folder_id;
        $folders = Folder::where('tenant_id', $tenant)->where('parent_id', $folder)->get();
        $files = FileModel::where('tenant_id', $tenant)->where('folder_id', $folder)->get();
        $files = $this->parseUrl($files, "filename");
        return response()->json(["files" => $files, "folders" => $folders], 200);
    }

    public function getSize(Request $request)
    {

        $tenant = Tenant::where("tenant_id", $request->tenant_id)->get();
        $planId = $tenant[0]['plan_id'];

        $plan_details = DB::table('plan_features')
            ->where('plan_id', '=', $planId)->first();

        //    return response()->json(["details"=>$plan_details,], 200);

        $storage_size = $plan_details->storage_size;

        $size = FileModel::where('tenant_id', $request->tenant_id)
            ->where('uploaded_by', $request->user_id)->sum('size');

        $postAttachments = PostAttachment::where('tenant_id', $request->tenant_id)->get();
        //print_r($postAttachments);

        $sum_post_attachment = 0;
        foreach ($postAttachments as $postAttachment){
            if (file_exists(public_path('assets\uploads\attachments\\' . $postAttachment->attachment))){
                $fileSize = \File::size(public_path('assets\uploads\attachments\\' . $postAttachment->attachment));
                //echo $fileSize;
                $sum_post_attachment = $sum_post_attachment + $fileSize;
						}



						if(file_exists(public_path('assets\uploads\requisition\\'.$postAttachment->attachment))){
							$fileSize = \File::size(public_path('assets\uploads\requisition\\'.$postAttachment->attachment));
							//echo $fileSize;
							$sum_post_attachment = $sum_post_attachment + $fileSize;
						}

					}

        $workgroupAttachments = WorkgroupAttachment::where('tenant_id', $request->tenant_id)->get();

        $sum_workgroup_attachment = 0;
        foreach ($workgroupAttachments as $workgroupAttachment){
            if (file_exists(public_path('assets\uploads\attachments\\' . $workgroupAttachment->attachment))){
                $fileSize = \File::size(public_path('assets\uploads\attachments\\' . $workgroupAttachment->attachment));

                $sum_workgroup_attachment = $sum_workgroup_attachment + $fileSize;
						}

					}

        $drivers = Driver::where('tenant_id', $request->tenant_id)->get();

        $sum_driver_attachment = 0;

        foreach ($drivers as $driver):
            if (file_exists(public_path('assets\uploads\logistics\\' . $driver->attachment))):
                $fileSize = \File::size(public_path('assets\uploads\logistics\\' . $driver->attachment));
                //echo $fileSize;
                $sum_driver_attachment = $sum_driver_attachment + $fileSize;
            endif;
        endforeach;

				$size = ($sum_post_attachment + $sum_driver_attachment + $sum_workgroup_attachment + $size); /// 1000000000;

		//$size = 	number_format(ceil($size/1024));
		$size = ceil(($size)/1024 / 1024);

        return response()->json(["used" => $size, "size" => $storage_size, "formated"=>number_format($size)], 200);

    }

    public function parseUrl($collection, $key)
    {
        foreach ($collection as $item) {
            $item[$key] = url("/assets/uploads/cnxdrive/" . $item[$key]);
        }
        return $collection;
		}



		public function newFolder(Request $request){

        $check = Folder::where('name', $request->name_of_folder)->where('parent_id', $request->parent_folder)->get();

        if(count($check) == 0){
        $folder = new Folder;
        $folder->parent_id = $request->parent_folder;
        $folder->tenant_id = $request->tenant_id;
        $folder->created_by = $request->user_id;
        $folder->name = $request->name_of_folder;
        $folder->permission = $request->visibility;
        $folder->save();

        if($folder){
            return response()->json(['Response'=>'success'],200);
        }else{
            return response()->json(['Response'=>"error"],400);
				}
			}
        else{

					return response()->json(['Response'=>'exists'],200);
				}

		}



		public function UploadFile(Request $request)
		{
			$check = FileModel::Where('name', $request->filename)
			->where('folder_id', $request->folder_id)
			->get();

		if(count($check) == 0){
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

			$folder_id = $request->folder_id;

			$file = new FileModel;
			$file->tenant_id = $request->tenant_id;
			$file->uploaded_by = $request->user_id;
			$file->filename = $filename;
			$file->name = $request->filename;
			$file->folder_id = $folder_id;
			$file->size = $size;
			$file->save();
		  if($file){
				return response()->json(['Response'=>'success'],200);
		}else{
				return response()->json(['Response'=>"error"],400);
		}
	}
		else{

			return response()->json(['Response'=>'exists'],200);
		}
	}





}
