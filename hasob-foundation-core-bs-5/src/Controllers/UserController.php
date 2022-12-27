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
use Hasob\FoundationCore\Models\Department;
use Hasob\FoundationCore\Models\Organization;

use Hasob\FoundationCore\DataTables\UserDataTable;

class UserController extends BaseController
{

    public function index(Organization $org, Request $request){

        $usersDataTable = new UserDataTable($org);

        if ($request->expectsJson()) {
            return $usersDataTable->ajax();
        }

        return view('hasob-foundation-core::users.index')
                    ->with('dataTable', $usersDataTable->html());
    }

    public function show(Organization $org, Request $request, $id){

        $edited_user = null;
        if (!empty($id)){
            $edited_user = User::find($id);
        }

        $is_edit = ($edited_user != null);
        $departments = Department::where('organization_id',$org->id)->get();

        if ($request->expectsJson()) {
            if ($edited_user != null){
                $edited_user->getRoleNames();
            }
            return $edited_user;
        }

        return view('hasob-foundation-core::users.edit')
                ->with("organization", $org)
                ->with("is_edit", $is_edit)
                ->with("edited_user", $edited_user)
                ->with("all_roles", Role::all())
                ->with("departments", $departments);
    }

    public function edit(Organization $org, Request $request, $id){

        return $this->show($org, $request, $id);
    }

    public function update(Organization $org, Request $request, $id){

        $zUser = User::find($id);
        if ($zUser==null){
            $zUser = new User();
            $zUser->organization_id = $org->id;
        }

        $validator = $this->validateUserDetailsForm($request);
        if ($validator->fails()){

            if ($request->expectsJson()) {
                return self::createJSONResponse("fail","error",$validator->errors(),200);
            }

            return redirect()->back()->withErrors($validator)->withInput();
        }

        $zUser->telephone = $request->phoneNumber;
        $zUser->email = $request->emailAddress;
        $zUser->department_id = $request->department;
        $zUser->job_title = $request->jobTitle;
        $zUser->title = $request->userTitle;
        $zUser->first_name = $request->firstName;
        $zUser->middle_name = $request->middleName;
        $zUser->last_name = $request->lastName;

        if (isset($request->availability_status)){
            $zUser->presence_status = $request->availability_status;
        }

        if (isset($request->presence_comments)){
            $zUser->leave_delegation_notes = $request->presence_comments;
        }

        $zUser->is_disabled = isset($request->cbx_is_disabled)&&$request->cbx_is_disabled="1";
        if ($zUser->is_disabled){
            $zUser->disable_reason = $request->disable_reason;
            $zUser->disabling_user_id = Auth::guard('web')->user()->id;
            $zUser->disabled_at = Carbon\Carbon::now()->format('Y-m-d H:i:s');
        }

        if (isset($request->cbx_is_ad_import)){
            $zUser->is_ad_import = isset($request->cbx_is_ad_import)&&$request->cbx_is_ad_import="1";
            $zUser->ad_type = $request->txt_ad_type;
            $zUser->ad_key = $request->txt_ad_key;
            $zUser->ad_data = $request->txt_ad_data;
        }

        if (isset($request->txt_user_code)){
            $zUser->user_code = $request->txt_user_code;
        }

        if (isset($request->txt_preferred_name)){
            $zUser->preferred_name = $request->txt_preferred_name;   
        }

        if (isset($request->txt_ranking_ordinal)){
            $zUser->ranking_ordinal = $request->txt_ranking_ordinal;   
        }

        if ($request->file('file_profile_image')!=null){
            $temp = file_get_contents($request->file('file_profile_image'));
            $zUser->profile_image = $temp;
        }

        if (empty($request->password1) == false){
            $zUser->password = bcrypt($request->password1);
        }

        $selectedRoles = [];
        $roleChangeDetected = false;
        $allRoles = Role::where('guard_name','web')->pluck('name');
        foreach($allRoles as $role){
            $role_key = "userRole_{$role}";
            if (isset($request->$role_key) && $request->$role_key=="1"){
                $roleChangeDetected = true;
                $selectedRoles []= $role;
            }
        }

        if ($roleChangeDetected){
            $zUser->syncRoles($selectedRoles);
        }

        $zUser->save();

        if ($request->expectsJson()) {
            return self::createJSONResponse("ok", "success", $zUser ,200);
        }

        $request->session()->flash('success','The user record has been updated.');
        return redirect()->route('fc.user.show', $zUser->id);
    }

    public function delete(Organization $org, Request $request, $id){

        return view('hasob-foundation-core::users.index');
    }

    public function profile(Organization $org, Request $request){

        $edit_mode = (isset($request->edit));
        $logged_in = Auth::user();

        return view('hasob-foundation-core::users.profile')
                ->with("edit_mode", $edit_mode)
                ->with("departments", Department::where('organization_id',$org->id)->get());
    }

    public function disable(Organization $org, Request $request, $id){
        $user = User::find($id);
        if (empty($user)) {
            return self::createJSONResponse("ok", "failed", "User Not found" ,404);
        }
        $input = array_merge($request->all(), ['disabling_user_id' => Auth::user()->id,'disabled_at' => Carbon\Carbon::now()->format('Y-m-d H:i:s')]);
        $user->fill($input);
        $user->save();

        return self::createJSONResponse("ok", "success", $user ,200);

    }


    public function validateUserDetailsForm(Request $request){

        $validation_rules = array(
            'emailAddress'=>"required|email|unique:fc_users,email,{$request->id}",
            'phoneNumber'=>"required|numeric|digits:11|unique:fc_users,telephone,{$request->id}",
            'password1'=>'nullable|string|min:8|confirmed|regex:/^(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
            'firstName' =>'required|string|max:50',
            'department' =>'nullable|string|max:50',
            'middleName' =>'nullable|string|max:50',
            'lastName' =>'required|string|max:50',
            'txt_ranking_ordinal' =>'nullable|numeric|max:10000000',
            'txt_website' =>'nullable|url|max:100'
        );

        $validation_messages = array(
            'required' => 'The :attribute field is required.'
        );

        $attributes = array(
            'firstName' => 'First Name',
            'middleName' => 'Middle Name',
            'lastName' => 'Last Name',
            'password1' => 'Password',
            'department' => 'Department',
            'phoneNumber' => 'Phone Number',
            'emailAddress' => 'Email Address',
            'txt_ranking_ordinal' => 'Ranking Ordinal',
            'txt_website' => 'Website'
        );

        //Create a validator for the data in the request
        $validator = Validator::make($request->all(), $validation_rules, $validation_messages, $attributes);
        $validator->after(function ($validator) {});

        return $validator;
    }

    public function uploadProfilePicture(Request $request){
    
        $file = $request->file;
        if ($file==null || $file->getSize()>= (20 * 1024) ){
            $err_msg = ['The file uploaded is too large. File should not exceed 20kb.'];
            return self::createJSONResponse("fail","error",$err_msg,200);
        }

        $contents = $file->openFile()->fread($file->getSize());
        Auth::guard('web')->user()->profile_image = $contents;
        Auth::guard('web')->user()->save();
        
        return self::createJSONResponse("ok","success",'',200);
    }

    public function modifyUserAvailability(Request $request){

        Auth::guard('web')->user()->presence_status = $request->status;
        Auth::guard('web')->user()->leave_delegation_notes = $request->comments;
        Auth::guard('web')->user()->save();
        return self::createJSONResponse("ok","success",'',200);
    }

    public function updateRole(Request $request){
        
        $zRole = null;
        $editMode = true;

        if ($request->roleId == -1){
            $editMode = false;
            $zRole = new Role();
        } else {
            $zRole = Role::find($request->roleId);
            if ($zRole == null){
                return self::createJSONResponse("fail","error","Invalid Role",200);
            }
        }

        $validator = $this->validateSystemRoleInput($request, $editMode);
        if ($validator->fails() == false){
            //$zRole->syncPermissions($request->selectedPermissions);
            $zRole->name = $request->roleName;
            $zRole->save();

            return self::createJSONResponse("ok","success",$zRole,200);
        }

        return self::createJSONResponse("fail","error",$validator->errors(),200);
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

    public function validateSystemUserInput(Request $request, $editMode=false){

        $validation_rules = array(
            //'firstName'=>'required|string|between:1,30',
            //'lastName' =>'required|string|between:1,30',
        );

        if ($editMode == false){
            //$validation_rules['emailAddress']="required|email|unique:users,email";
            $validation_rules['phoneNumber']="required|numeric|digits:11|unique:fc_users,telephone";
            $validation_rules['password1']='required|string|min:8|confirmed|regex:/^(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/';
        }else{
            //$validation_rules['emailAddress']="required|email|unique:users,email,{$request->userId}";
            $validation_rules['phoneNumber']="required|numeric|digits:11|unique:fc_users,telephone,{$request->userId}";
            $validation_rules['password1']='required|string|min:8|confirmed|regex:/^(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/';
        }

        $validation_messages = array(
            'required' => 'The :attribute field is required.',
            'unique' => 'The :attribute you entered is already in use, please enter another :attribute.',
            'regex' => 'The password you entered must be a strong password comprised of at least one number and one symbol, minimum of 8 characters.',
        );

        //Create a validator for the data in the request
        return Validator::make($request->all(), $validation_rules, $validation_messages);
    }

}
