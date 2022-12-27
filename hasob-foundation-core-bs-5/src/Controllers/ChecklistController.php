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
use Hasob\FoundationCore\Models\Ledger;
use Hasob\FoundationCore\Models\Comment;
use Hasob\FoundationCore\Models\Department;
use Hasob\FoundationCore\Models\Organization;
use Hasob\FoundationCore\Models\ChecklistTemplate;

class ChecklistController extends BaseController
{

    public function index(Organization $org, Request $request){

        $checklists = ChecklistTemplate::where('organization_id',$org->id)->groupBy('list_name')->pluck('list_name');

        $selected_template_items = [];
        $selected_name = $request->name;
        if ($selected_name!=null){
            $selected_template_items = ChecklistTemplate::where('list_name',$selected_name)
                                                            ->orderBy('ordinal')
                                                            ->get();
        }

        return view('hasob-foundation-core::checklists.index')
                    ->with('checklists', $checklists)
                    ->with('selected_checklist_name', $selected_name)
                    ->with('selected_idx_max', count($selected_template_items))
                    ->with('selected_checklist_items', $selected_template_items);

    }

    public function updateTemplate(Organization $org, Request $request){

        $options = json_decode($request->options, true);

        if ($options['new_checklist_name']==null || empty($options['new_checklist_name'])){
            $err_msg = ['The checklist name must be provided.'];
            return self::createJSONResponse("fail","error",$err_msg,200);
        }

        $cbx = new ChecklistTemplate();
        $cbx->list_name = $options['new_checklist_name'];
        $cbx->ordinal = 0;
        $cbx->item_label = "Item 1";
        $cbx->item_description = "Item 1";
        $cbx->organization_id = $org->id;
        $cbx->save();

        return self::createJSONResponse("ok","success","Checklist Created",200);
    }
    
    public function updateTemplateItem(Organization $org, Request $request){

        $options = json_decode($request->options, true);
        if ($options['cbx_desc']==null || empty($options['cbx_desc'])){
            $err_msg = ['The checklist description must be provided.'];
            return self::createJSONResponse("fail","error",$err_msg,200);
        }
    
        if ($options['cbx_item_id']==0){
            
            $cbx = new ChecklistTemplate();
            $cbx->list_name = $options['cbx_list_name'];

        }else{

            $cbx = ChecklistTemplate::find($options['cbx_item_id']);
            if ($cbx==null){
                $err_msg = ['The checklist item is not valid.'];
                return self::createJSONResponse("fail","error",$err_msg,200);
            }
        }

        $cbx->ordinal = 1;
        if (isset($options['cbx_idx']) && empty($options['cbx_idx'])==false){
            $cbx->ordinal = $options['cbx_idx'];
        }
        
        $cbx->item_label = $options['cbx_desc'];
        $cbx->item_description = $options['cbx_desc'];
        $cbx->requires_attachment = $options['cbx_requires_attachment'];
        $cbx->required_attachment_mime_type = $options['cbx_required_attachment_mime_type'];

        $cbx->requires_input = $options['cbx_requires_input'];
        $cbx->required_input_type = $options['cbx_required_input_type'];
        $cbx->required_input_validation = $options['cbx_required_input_validation'];
        $cbx->organization_id = $org->id;

        $cbx->save();

        return self::createJSONResponse("ok","success","Checklist Item Created",200);
    }
    
    public function update(Organization $org, Request $request){}
    public function edit(Organization $org, Request $request, $id){}
    public function show(Organization $org, Request $request, $id){}
    public function delete(Organization $org, Request $request, $id){
        $checklist = ChecklistTemplate::find($id);

        if(empty($checklist)){
            return self::createJSONResponse("ok","failed","Checklist Item Not found",404);
        }

        $checklist->delete();
        return self::createJSONResponse("ok","success","Checklist Item Deleted Successfully",200);
    }

}
