<?php
namespace Hasob\FoundationCore\Traits;

use File;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Hasob\FoundationCore\Models\User;
use Hasob\FoundationCore\Models\Attachment;
use Hasob\FoundationCore\Models\Attachable as EloquentAttachable;
use Hasob\FoundationCore\Models\Department;
use Hasob\FoundationCore\Models\Organization;


trait Attachable
{


    public function get_attachment($name){
        $attachables = EloquentAttachable::where('attachable_id', $this->id)
                                            ->where('attachable_type', self::class)    
                                            ->orderBy('created_at','desc')
                                            ->get();

        $attachments = [];
        foreach ($attachables as $attachable){
            if ($attachable->attachment != null && $attachable->attachment->label == $name){
                return $attachable->attachment;
            }
        }
        return null;
    }

    public function get_attachments($file_types = null){
        $attachables_query = EloquentAttachable::where('attachable_id', $this->id)
                                            ->where('attachable_type', self::class)    
                                            ->orderBy('created_at','desc');

        $attachables = $attachables_query->get();

        $attachments = [];
        foreach ($attachables as $attachable){
            if ($file_types != null){
                
                $attachment = $attachable->attachment;
                if (str_contains(strtolower($file_types), strtolower($attachment->file_type))){
                    $attachments []= $attachable->attachment;
                }

            } else {
                $attachments []= $attachable->attachment;
            }
        }
        return $attachments;
    }

    public function create_attachment(User $user, $name, $comments, $file){

        $rndFileName = time() . '.' . $file->getClientOriginalExtension();
        $path = $file->move(public_path('uploads'), $rndFileName);

        $attach = new Attachment();
        $attach->path = "public/uploads/{$rndFileName}";
        $attach->label = $name;
        $attach->organization_id = $user->organization_id;
        $attach->uploader_user_id = $user->id;
        $attach->description = $comments;
        $attach->file_type = $file->getClientOriginalExtension();
        $attach->save();

        return $attach;
    }

    public function create_attachable(User $user, Attachment $attachment){

        $attachable = new EloquentAttachable();
        $attachable->user_id = $user->id;
        $attachable->attachment_id = $attachment->id;
        $attachable->attachable_id = $this->id;
        $attachable->attachable_type = self::class;
        $attachable->save();

        return $attachable;
    }

    public function attach(User $user, $name, $comments, $file){

        $rndFileName = time() . '.' . $file->getClientOriginalExtension();
        $path = $file->copy(public_path('uploads'), $rndFileName);

        $attach = new Attachment();
        $attach->path = "public/uploads/{$rndFileName}";
        $attach->label = $name;
        $attach->organization_id = $user->organization_id;
        $attach->uploader_user_id = $user->id;
        $attach->description = $comments;
        $attach->file_type = $file->getClientOriginalExtension();
        $attach->save();

        $attachable = new EloquentAttachable();
        $attachable->user_id = $user->id;
        $attachable->attachment_id = $attach->id;
        $attachable->attachable_id = $this->id;
        $attachable->attachable_type = self::class;
        $attachable->save();

        return $attachable;
    }
    
    public function save_file(User $user, $name, $comments, $file_path){

        $file_extension = pathinfo($file_path, PATHINFO_EXTENSION);

        $rndFileName = time() . '.' . $file_extension;
        $path = File::copy($file_path, public_path('uploads').'/'.$rndFileName);

        $attach = new Attachment();
        $attach->path = "public/uploads/{$rndFileName}";
        $attach->label = $name;
        $attach->organization_id = $user->organization_id;
        $attach->uploader_user_id = $user->id;
        $attach->description = $comments;
        $attach->file_type = $file_extension;
        $attach->save();

        $attachable = new EloquentAttachable();
        $attachable->user_id = $user->id;
        $attachable->attachment_id = $attach->id;
        $attachable->attachable_id = $this->id;
        $attachable->attachable_type = self::class;
        $attachable->save();

        return $attachable;
    }

}
