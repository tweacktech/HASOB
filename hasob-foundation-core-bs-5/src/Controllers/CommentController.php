<?php

namespace Hasob\FoundationCore\Controllers;

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

use Hasob\FoundationCore\Models\User;
use Hasob\FoundationCore\Models\Comment;
use Hasob\FoundationCore\Models\Department;
use Hasob\FoundationCore\Models\Organization;

class CommentController extends BaseController
{

    public function index(Organization $org, Request $request){}
    public function show(Organization $org, Request $request, $id){}
    public function delete(Organization $org, Request $request, $id){}
    public function edit(Organization $org, Request $request, $id){}


    public function update(Organization $org, Request $request){

        $options = json_decode($request->options, true);
        if (empty($options['comments'])) {
            $err_msg = ['No comments entered.'];
            return self::createJSONResponse("fail", "error", $err_msg, 200);
        }
        if (empty($options['commentable_id']) || empty($options['commentable_type'])) {
            $err_msg = ['Invalid comment request.'];
            return self::createJSONResponse("fail", "error", $err_msg, 200);
        }
        if (class_exists($options['commentable_type']) == false) {
            $err_msg = ['Invalid comment request.'];
            return self::createJSONResponse("fail", "error", $err_msg, 200);
        }

        $commentable_type = $options['commentable_type']::find($options['commentable_id']);
        if ($commentable_type == null) {
            $err_msg = ['Invalid comment request.'];
            return self::createJSONResponse("fail", "error", $err_msg, 200);
        }

        if(isset($options['id'])){
            $comm = Comment::find($options['id']);
            if($comm != null){
                $comment = $commentable_type->update_comment(
                    Auth::guard()->user(),
                    $options['comments'],
                    $options['id']
                );
            }else{

                $err_msg = ['Invalid comment request.'];
                return self::createJSONResponse("fail", "error", $err_msg, 200);
            }
           
        }else{
            $comment = $commentable_type->create_comment(
                Auth::guard()->user(),
                $options['comments']
            );
        }
 
        return self::createJSONResponse("ok", "success", null, 200);

    }

}
