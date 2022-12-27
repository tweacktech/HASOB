<?php

namespace Hasob\FoundationCore\Controllers\API;

use Carbon;
use Session;
use Validator;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;

use Hasob\FoundationCore\Models\User;
use Hasob\FoundationCore\Models\Comment;
use Hasob\FoundationCore\Models\Attachment;
use Hasob\FoundationCore\Models\Attachable;
use Hasob\FoundationCore\Models\Department;
use Hasob\FoundationCore\Models\Organization;

use Hasob\FoundationCore\Controllers\BaseController;

class AttachmentAPIController extends BaseController
{

    public function index(Organization $org, Request $request){
        $attachments = Attachment::all();
        $attach = [];
        if(!empty($attachments)){
            foreach ($attachments as $key => $value) {
                # code...
                $path = str_replace('public/','',$value->path);
                //array_push($attach,asset($path));
                $record = [
                    'id' => $value->id,
                    'uploader_user_id' =>$value->uploader_user_id,
                    'path' => $value->path,
                    'asset_path' => asset($path),
                    'label' => $value->label,
                    'description' => $value->description,
                    'file_type' => $value->file_type,
                    'file_number' =>  $value->file_number,
                    'storage_driver' => $value->storage_driver,
                    'allowed_user_ids' => $value->allowed_user_ids,
                    'allowed_viewer_user_roles' => $value->allowed_viewer_user_roles,
                    'organization_id' =>$value->organization_id,
                    'created_at' => $value->created_at,
                    'updated_at' => $value->updated_at,
                    'deleted_at' => $value->deleted_at
                ];
                array_push($attach,$record);
            }
        }
        
        return $this->sendResponse($attach,"Attachments retrieved successfully");
    }

    public function destroy(Organization $org,Request $request, $id){
        $attach = Attachment::find($id);
        if(empty($attach)){
            $err_msg = ['Attachment not found'];
            return self::createJSONResponse("fail", "error", $err_msg, 404);
        }
        $path = str_replace('public/','',$attach->path);
        File::delete($path);
        Attachable::where('attachment_id',$attach->id)->delete();
        $attach->delete();

        $msg = ['Attachment deleted successfully'];

        
        return $this->sendResponse("ok", $msg);

    }
    public function edit(Organization $org, Request $request, $id){
        return $this->show($org, $request, $id);
    }

    public function show(Organization $org, Request $request, $id){

        $attach = Attachment::find($id);
        if ($attach != null) {

            if ($attach->storage_driver == 'azure') {
                return Storage::disk('azure')->download(
                    $attach->path,
                    $attach->label,
                    ['Content-Disposition' => 'inline; filename="' . $attach->label . '"']
                );
            }

            if ($attach->file_type == 'pdf') {
                ob_end_clean();
                return response()->file(
                    base_path($attach->path),
                    [
                        'Content-Type' => 'application/pdf',
                        'Content-Disposition' => 'inline; filename="' . $attach->label . '"'
                    ]
                );
            } else if ($attach->file_type == 'docx' || $attach->file_type == 'doc') {
                ob_end_clean();
                return response()->file(
                    base_path($attach->path),
                    [
                        'Content-Type: application/vnd.ms-word',
                        'Content-Disposition' => 'attachment; filename="' . $attach->label . "." . $attach->file_type . '"'
                    ]
                );
            } else if ($attach->file_type == 'pptx' || $attach->file_type == 'ppt') {
                ob_end_clean();
                return response()->file(
                    base_path($attach->path),
                    [
                        'Content-Type: application/vnd.ms-powerpoint',
                        'Content-Disposition' => 'attachment; filename="' . $attach->label . "." . $attach->file_type . '"'
                    ]
                );
            } else if ($attach->file_type == 'xlsx' || $attach->file_type == 'xls') {
                ob_end_clean();
                return response()->file(
                    base_path($attach->path),
                    [
                        'Content-Type: application/vnd.ms-excel',
                        'Content-Disposition' => 'attachment; filename="' . $attach->label . "." . $attach->file_type . '"'
                    ]
                );
            }
            $path = str_replace('public/','',$attach->path);
            $asset = array_merge($attach->toArray(),['asset_path' => asset($path)]);

            return $this->sendResponse($asset,"Asset retrieved successfully");
            //return response()->file(base_path($attach->path));
        }        
    }

    public function update(Organization $org, Request $request){

        $options = json_decode($request->options, true);
        if (isset($options['name'])==false || $options['name'] == null || empty($options['name'])) {
            $err_msg = ['The name must be provided.'];
            return self::createJSONResponse("fail", "error", $err_msg, 200);
        }
        if (isset($options['attachable_id'])==false || empty($options['attachable_id'])) {
            $err_msg = ['Invalid upload request.'];
            return self::createJSONResponse("fail", "error", $err_msg, 200);
        }
        if (isset($options['attachable_type'])==false || empty($options['attachable_type']) || class_exists($options['attachable_type']) == false) {
            $err_msg = ['Invalid upload request.'];
            return self::createJSONResponse("fail", "error", $err_msg, 200);
        }

        $attachable_type = $options['attachable_type']::find($options['attachable_id']);
        if ($attachable_type == null) {
            $err_msg = ['Invalid upload request.'];
            return self::createJSONResponse("fail", "error", $err_msg, 200);
        }

        if ($request->file == null) {
            $err_msg = ['The file must be provided.'];
            return self::createJSONResponse("fail", "error", $err_msg, 200);
        }

        $attachment = $attachable_type->create_attachment(
            Auth::guard()->user(),
            isset($options['name']) ? $options['name'] : 'Unnamed File {{ time() }}',
            isset($options['comments']) ? $options['comments'] : "",
            $request->file
        );
        if ($attachment == null) {
            $err_msg = ['Unable to upload attachment.'];
            return self::createJSONResponse("fail", "error", $err_msg, 200);
        }

        $attachable = $attachable_type->create_attachable(
            Auth::guard()->user(),
            $attachment
        );

        return self::createJSONResponse("ok", "success", $attachment->path, 200);
    }


}
