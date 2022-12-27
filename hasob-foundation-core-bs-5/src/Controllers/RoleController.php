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
use Hasob\FoundationCore\Models\Organization;

use Hasob\FoundationCore\DataTables\RoleDataTable;

class RoleController extends BaseController
{

    public function index(Organization $org, Request $request){

        $rolesDataTable = new RoleDataTable($org);

        if ($request->expectsJson()) {
            return $rolesDataTable->ajax();
        }

        return view('hasob-foundation-core::roles.index')
                    ->with('dataTable', $rolesDataTable->html())
                    ->with("allRoles", Role::all())
                    ->with("allPerms", Permission::all());
    }

    public function show(Organization $org, Request $request, $id){

        $edited_role = $id == 0 ? null : Role::find($id);
        if ($request->expectsJson()) {
            return $edited_role;
        }

    }

    public function update(Organization $org, Request $request, $id){

        $zRole = null;
        $editMode = true;

        if ($request->roleId == -1){
            $editMode = false;
            $zRole = new Role();

        } else {
            $zRole = Role::find($request->roleId);
            if ($zRole == null){
                return $this->createJSONResponse("fail","error","Invalid Role",200);
            }
        }

        $validator = $this->validateSystemRoleInput($request, $editMode);
        if ($validator->fails() == false){
            $zRole->name = $request->roleName;
            $zRole->save();

            return $this->createJSONResponse("ok","success",$zRole,200);
        }

        return $this->createJSONResponse("fail","error",$validator->errors(),200);
    }


    public function delete(Organization $org, Request $request, $id){

        return view('hasob-foundation-core::roles.index');

    }
    
    public function validateSystemRoleInput(Request $request, $editMode=false){

        $validation_rules = array(
            //'selectedPermissions'=>'required|array'
        );

        if (!$editMode){
            $validation_rules['roleName']="required|string|unique:roles,name";
        }else{
            $validation_rules['roleName']="required|string|unique:roles,name,{$request->roleId}";
        }

        $validation_messages = array(
            'gt' => 'You must select more than one permission for this role.',
            'required' => 'The :attribute field is required.',
            'unique' => 'The :attribute you entered is already in use, please enter another :attribute.'
        );

        //Create a validator for the data in the request
        return Validator::make($request->all(), $validation_rules, $validation_messages);
    }


}