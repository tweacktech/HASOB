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
use Hasob\FoundationCore\Models\Setting;
use Hasob\FoundationCore\Models\Department;
use Hasob\FoundationCore\Models\Organization;
use Hasob\FoundationCore\Requests\CreateOrganizationRequest;
use Hasob\FoundationCore\Requests\UpdateOrganizationRequest;

class OrganizationController extends BaseController
{

    public function detect(Organization $org, Request $request){
        return self::createJSONResponse("ok","success",$org,200);
    }

    public function app_settings(Organization $org, Request $request){
        $settings = Setting::all_settings($org);
        return self::createJSONResponse("ok","success",$settings,200);
    }

    public function displayDomains(Organization $org, Request $request){

        $current_user = Auth::user();
        $domains = Organization::all_organizations();

        return view('hasob-foundation-core::organization.domains')
                    ->with('domains', $domains)
                    ->with('organization', $org)
                    ->with('current_user', $current_user);
    }

    public function displaySettings(Organization $org, Request $request){
        
        $current_user = Auth::user();

        $groups = Setting::all_groups($org);
        $settings = Setting::all_settings($org);

        return view('hasob-foundation-core::organization.settings')
                    ->with('organization', $org)
                    ->with('groups', $groups)
                    ->with('settings', $settings)
                    ->with('current_user', $current_user);
    }

    public function displayFeatures(Organization $org, Request $request){
        
        $current_user = Auth::user();

        $features = [];
        if ($org != null){
            $features = $org->get_features();
        }
        
        return view('hasob-foundation-core::organization.features')
                    ->with('organization', $org)
                    ->with('features', $features)
                    ->with('current_user', $current_user);
    }

    public function processFeatures(Organization $org, Request $request){

        $current_user = Auth::user();

        $features = [];
        if ($org != null){
            $features = $org->get_features();
        }

        $features_state = [];

        foreach ($features as $item=>$value){
            $property_name = "chk_{$item}";
            if (isset($request->$property_name)){
                $features_state[$item] = true;
            } else {
                $features_state[$item] = false;
            }
        }

        $org->store_artifact([
            'key'=>'features',
            'value'=>json_encode($features_state)
        ]);

        return redirect()->route('fc.org-features');
    }

    //Display the specific resource
    public function show(Organization $org, Request $request, $id){
        $current_user = Auth::user();
        
        $item = null;
        if (empty($id) == false){
            $item = Organization::find($id);
        }

        if ($item == null){
            abort(404);
        }
        
        if ($request->expectsJson()){
            return self::createJSONResponse("ok","success",$item,200);
        }
        
        return $item;
    }

    //Destroy the specific resource
    public function destroy(Organization $org, Request $request, $id){
        
        $item = null;
        if (empty($id) == false){
            $item = Organization::find($id);
        }

        if ($item == null){
            abort(404);
        }
        
        $item->delete();
        return self::createJSONResponse("ok","success",$item,200);
    }

    //Update a specific resource
    public function update(Organization $org, UpdateOrganizationRequest $request, $id){
    
        $item = null;
        if (empty($id) == false){
            $item = Organization::find($id);
        }

        if ($item == null){
            abort(404);
        }

        $item->org = $request->org;
        $item->domain = $request->domain;
        $item->full_url = $request->full_url;
        $item->subdomain = $request->subdomain;
        $item->shut_down_reason = $request->shut_down_reason;
        $item->is_shut_down = $request->is_shut_down;
        $item->is_local_default_organization = $request->is_local_default_organization;
        $item->save();

        return self::createJSONResponse("ok","success",$item,200);
    }

    //Store a newly created resource
    public function store(Organization $org, CreateOrganizationRequest $request){

        $current_user = Auth::user();

        $item = new Organization();
        $item->org = $request->org;
        $item->domain = $request->domain;
        $item->full_url = $request->full_url;
        $item->subdomain = $request->subdomain;
        $item->shut_down_reason = $request->shut_down_reason;
        $item->is_shut_down = $request->is_shut_down;
        $item->is_local_default_organization = $request->is_local_default_organization;
        $item->save();

        return self::createJSONResponse("ok","success",$item,200);
    }


}
