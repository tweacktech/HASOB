<?php
namespace Hasob\FoundationCore\Traits;


use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

use Hasob\FoundationCore\Models\User;
use Hasob\FoundationCore\Models\Ledger;
use Hasob\FoundationCore\Models\LedgerItem;
use Hasob\FoundationCore\Models\Department;
use Hasob\FoundationCore\Models\Organization;


trait Ledgerable
{
    
    public function ledger(){
        return Ledger::where('ledgerable_id',$this->id)
                        ->where('ledgerable_type',self::class)
                        ->orderBy('created_at')
                        ->first();
    }

    public function create_ledger($name, Organization $org=null, array $properties=[]){

        $current_user = Auth::user();

        $properties['name'] = $name;
        $properties['ledgerable_id'] = $this->id;
        $properties['ledgerable_type'] = self::class;

        if ($current_user != null){
            $properties['creator_user_id'] = $current_user->id;
        }
        
        $properties['organization_id'] = $org!=null ? $org->id : ($this->organization_id!=null ? $this->organization_id : null);

        return Ledger::create($properties);
    }

    public function credit_ledger($amount, $description, $route_name=null, $reference_id=null, $reference_controller=null){

        //Get the ledger
        $ledger = $this->ledger();

        //create the ledger if it doesn't exist
        if ($ledger == null){

            $type_name = self::class;

            if (strpos($type_name, '\\')!=false){
                $type_name_parts = explode("\\", self::class);
            }
            if (is_array($type_name_parts)){
                $type_name = array_pop($type_name_parts);
            }
            
            $item_name = ucwords($type_name);
            $ledger = $this->create_ledger("{$item_name} Account");

        }

        if ($ledger != null){

            //Make the entry
            $entry = new LedgerItem();
            $entry->name = $description;
            $entry->entry_type = "credit";
            $entry->entry_amount = $amount;
            $entry->ledger_id = $ledger->id;

            if ($reference_id!=null){
                $entry->referenced_item_id = $reference_id;
            }

            if ($route_name!=null){
                $entry->referenced_item_route_name = $route_name;
            }
            
            if ($reference_controller!=null){
                $entry->referenced_item_controller_class = $reference_controller;
            }

            $entry->save();
            return $entry;
        }

        Log::info("Unable to create ledger entry as ledger does not exist");

    }

    public function debit_ledger($amount, $description, $route_name=null, $reference_id=null, $reference_controller=null){

        //Get the ledger
        $ledger = $this->ledger();
        
        //create the ledger if it doesn't exist
        if ($ledger == null){
            $item_name = ucwords(array_pop(explode("\\", self::class)));
            $ledger = $this->create_ledger("{$item_name} Account");
        }

        if ($ledger != null){

            //Make the entry
            $entry = new LedgerItem();
            $entry->name = $description;
            $entry->entry_type = "debit";
            $entry->entry_amount = $amount;
            $entry->ledger_id = $ledger->id;

            if ($reference_id!=null){
                $entry->referenced_item_id = $reference_id;
            }

            if ($route_name!=null){
                $entry->referenced_item_route_name = $route_name;
            }
            
            if ($reference_controller!=null){
                $entry->referenced_item_controller_class = $reference_controller;
            }

            $entry->save();
            return $entry;
        }

        Log::info("Unable to create ledger entry as ledger does not exist");

    }

}
