<?php
namespace Hasob\FoundationCore\Traits;


use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Hasob\FoundationCore\Models\User;
use Hasob\FoundationCore\Models\Page;
use Hasob\FoundationCore\Models\Department;
use Hasob\FoundationCore\Models\Relationship;
use Hasob\FoundationCore\Models\Organization;


trait Relatable
{
    public function relationships(){
        $relationships = Relationship::where('primary_item_id',$this->id)
                                    ->where('primary_item_type',self::class)
                                    ->orderBy('created_at')
                                    ->get();
        return $relationships;
    }

    public function create_relationship($related_item, $type, $weight=5){

        //create relationship
        $relationship = new Relationship();
        $relationship->creator_user_id = $user->id;
        $relationship->organization_id = $user->organization_id;
        $relationship->primary_item_type = self::class;
        $relationship->primary_item_id = $this->id;
        $relationship->related_item_type = get_class($related_item);
        $relationship->related_item_id = $related_item->id;

        $relationship->relation_type = $type;
        $relationship->weight = $weight;
        $relationship->save();

        return $relationship;
    }
}
