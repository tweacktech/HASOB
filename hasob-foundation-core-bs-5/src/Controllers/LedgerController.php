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

use Hasob\FoundationCore\Requests\CreateLedgerRequest;

use Hasob\FoundationCore\Models\User;
use Hasob\FoundationCore\Models\Ledger;
use Hasob\FoundationCore\Models\Comment;
use Hasob\FoundationCore\Models\Department;
use Hasob\FoundationCore\Models\Organization;

class LedgerController extends BaseController
{

    //Display all ledgers
    public function index(Organization $org, Request $request){

        return view('hasob-foundation-core::ledgers.index')
                ->with('ledgers', Ledger::all_ledgers($org));

    }

    //Display the specific resource
    public function show(Organization $org, Request $request, $id){

        $current_user = Auth::user();

        $ledger = null;
        if (empty($id) == false){
            $ledger = Ledger::find($id);
        }

        if ($ledger == null){
            abort(404);
        }

        if ($request->expectsJson()){
			return $ledger;
		}

        return view('hasob-foundation-core::ledgers.ledger')
                    ->with('ledger', $ledger)
                    ->with('organization', $org)
                    ->with('current_user', $current_user);
    }


    //Destroy the specific resource
    public function destroy(Organization $org, Request $request, $id){

        $item = null;
        if (empty($id) == false){
            $item = Ledger::find($id);
        }

        if ($item == null){
            abort(404);
        }
        
        $item->destroy();
    }


    //Display creation of a new resource
    public function create(Organization $org, Request $request){}


    //Update a specific resource
    public function update(Organization $org, Request $request, $id){}


    //Store a newly created resource
    public function store(Organization $org, CreateLedgerRequest $request){

        $current_user = Auth::user();

        $ledger = new Ledger();
        $ledger->name = $request->name;
        $ledger->organization_id = $org->id;
        $ledger->creator_user_id = $current_user->id;

        if (empty($request->ledger_department) != false){
            $ledger->department_id = $request->ledger_department;
        }
        
        $ledger->save();

        return self::createJSONResponse("ok","success",$ledger,200);
    }

}
