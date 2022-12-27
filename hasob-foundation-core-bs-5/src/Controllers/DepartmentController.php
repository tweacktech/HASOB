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
use Hasob\FoundationCore\Requests\CreateDepartmentRequest;
use Hasob\FoundationCore\Requests\UpdateDepartmentRequest;

use Hasob\FoundationCore\Models\User;
use Hasob\FoundationCore\Models\Comment;
use Hasob\FoundationCore\Models\Department;
use Hasob\FoundationCore\Models\Organization;

class DepartmentController extends BaseController
{

    public function index(Organization $org, Request $request){

        return view('hasob-foundation-core::departments.index')
                    ->with('departments', Department::all_departments($org, Auth()->user()));

    }

    //Display the specific resource
    public function show(Organization $org, Request $request, $id){
        $current_user = Auth::user();
        
        $item = null;
        if (empty($id) == false){
            $item = Department::find($id);
        }

        if ($item == null){
            abort(404);
        }
        
        if ($request->expectsJson()){
            return self::createJSONResponse("ok","success",$item,200);
        }
        
        return view('hasob-foundation-core::departments.view')
                    ->with('department', $item)
                    ->with('organization', $org)
                    ->with('current_user', $current_user);
    }

    //Display creation of a new resource
    public function create(Organization $org, Request $request){
    
        return view('hasob-foundation-core::.index')
                ->with('organization', $org)
                ->with('current_user', $current_user);
    }

    //Destroy the specific resource
    public function destroy(Organization $org, Request $request, $id){
        
        $item = null;
        if (empty($id) == false){
            $item = Department::find($id);
        }

        if ($item == null){
            abort(404);
        }
        
        $item->delete();
        return self::createJSONResponse("ok","success",$item,200);
    }

    //Update a specific resource
    public function update(Organization $org, UpdateDepartmentRequest $request, $id){
    
        $item = null;
        if (empty($id) == false){
            $item = Department::find($id);
        }

        if ($item == null){
            abort(404);
        }

        $item->email = $request->email;
        $item->is_unit = false;
        $item->long_name = $request->long_name;
        $item->telephone = $request->telephone;
        $item->parent_id = $request->parent_id;
        $item->physical_location = $request->physical_location;
        $item->save();

        return self::createJSONResponse("ok","success",$item,200);
    }

    //Store a newly created resource
    public function store(Organization $org, CreateDepartmentRequest $request){

        
        $current_user = Auth::user();

        $department = new Department();
        $department->email = $request->email;
        $department->is_unit = false;
        $department->key = self::generateRandomCode(8);
        $department->long_name = $request->long_name;
        $department->telephone = $request->telephone;
        $department->parent_id = $request->parent_id;
        $department->physical_location = $request->physical_location;
        $department->organization_id = $org->id;
        $department->save();

        return self::createJSONResponse("ok","success",$department,200);

    }

}
