<?php

namespace Hasob\FoundationCore\Controllers;

use Flash;
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
use Hasob\FoundationCore\Models\Setting;
use Hasob\FoundationCore\Models\Department;
use Hasob\FoundationCore\Models\Organization;

use Hasob\FoundationCore\Events\SettingCreated;
use Hasob\FoundationCore\Events\SettingUpdated;
use Hasob\FoundationCore\Events\SettingDeleted;

use Hasob\FoundationCore\Requests\CreateSettingRequest;
use Hasob\FoundationCore\Requests\UpdateSettingRequest;

use Hasob\FoundationCore\Controllers\BaseController;

class SettingController extends BaseController
{

    public function index(Organization $org, SettingDataTable $settingDataTable)
    {
        $current_user = Auth()->user();

        $cdv_settings = new \Hasob\FoundationCore\View\Components\CardDataView(Setting::class, "hasob-foundation-core::pages.settings.card_view_item");
        $cdv_settings->setDataQuery(['organization_id'=>$org->id])
                        //->addDataGroup('label','field','value')
                        //->setSearchFields(['field_to_search1','field_to_search2'])
                        //->addDataOrder('display_ordinal','DESC')
                        //->addDataOrder('id','DESC')
                        ->enableSearch(true)
                        ->enablePagination(true)
                        ->setPaginationLimit(20)
                        ->setSearchPlaceholder('Search Setting');

        if (request()->expectsJson()){
            return $cdv_settings->render();
        }

        return view('hasob-foundation-core::pages.settings.card_view_index')
                    ->with('current_user', $current_user)
                    ->with('months_list', BaseController::monthsList())
                    ->with('states_list', BaseController::statesList())
                    ->with('cdv_settings', $cdv_settings);

        /*
        return $settingDataTable->render('hasob-foundation-core::pages.settings.index',[
            'current_user'=>$current_user,
            'months_list'=>BaseController::monthsList(),
            'states_list'=>BaseController::statesList()
        ]);
        */
    }

    public function create(Organization $org)
    {
        return view('hasob-foundation-core::pages.settings.create');
    }

    public function store(Organization $org, CreateSettingRequest $request)
    {
        $input = $request->all();

        /** @var Setting $setting */
        $setting = Setting::create($input);

        Flash::success('Setting saved successfully.');

        SettingCreated::dispatch($setting);
        return redirect(route('fc.settings.index'));
    }

    public function show(Organization $org, Request $request, $id)
    {
        $item = null;
        if (empty($id) == false){
            $item = Setting::find($id);
        }
        if ($item == null){
            abort(404);
        }
        if ($request->expectsJson()){
            return self::createJSONResponse("ok","success",$item,200);
        }   
        return $item;
    }

    public function edit(Organization $org, $id)
    {
        /** @var Setting $setting */
        $setting = Setting::find($id);

        if (empty($setting)) {
            Flash::error('Setting not found');

            return redirect(route('fc.settings.index'));
        }

        return view('hasob-foundation-core::pages.settings.edit')->with('setting', $setting);
    }

    public function update(Organization $org, $id, UpdateSettingRequest $request)
    {
        $item = null;
        if (empty($id) == false){
            $item = Setting::find($id);
        }

        if ($item == null){
            abort(404);
        }

        if ($item->display_type == "file-select"){

            $attachment = $item->create_attachment(
                Auth::guard()->user(),$item->key,"",$request->value
            );
            if ($attachment == null) {
                $err_msg = ['Unable to upload attachment.'];
                return self::createJSONResponse("fail", "error", $err_msg, 200);
            }
            $item->value = $attachment->id;

        } else {
            $item->value = $request->value;
        }
        
        $item->save();
        return self::createJSONResponse("ok","success",$item,200);
    }

    public function destroy(Organization $org, $id)
    {
        /** @var Setting $setting */
        $setting = Setting::find($id);

        if (empty($setting)) {
            Flash::error('Setting not found');

            return redirect(route('fc.settings.index'));
        }

        $setting->delete();

        Flash::success('Setting deleted successfully.');
        SettingDeleted::dispatch($setting);
        return redirect(route('fc.settings.index'));
    }

}
