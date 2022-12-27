<?php
namespace Hasob\FoundationCore\Traits;


use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Hasob\FoundationCore\Models\User;
use Hasob\FoundationCore\Models\Attachment;
use Hasob\FoundationCore\Models\Department;
use Hasob\FoundationCore\Models\Organization;
use Hasob\FoundationCore\Models\ModelArtifact;


trait Artifactable
{

    public function artifacts(){
        return ModelArtifact::where('model_primary_id',$this->id)
                        ->where('model_name',self::class)
                        ->orderBy('created_at')
                        ->get();
    }

    public function artifact($key){
        return ModelArtifact::where('model_primary_id',$this->id)
                        ->where('key', $key)                
                        ->where('model_name', self::class)
                        ->orderBy('created_at')
                        ->first();
    }

    public function store_artifact(array $properties){
        
        if ($properties != null){

            $previous = null;

            //check if the key already exists
            if (isset($properties['key'])){
                $previous = $this->artifact($properties['key']);
            }

            if ($previous != null){
                $previous->value = $properties['value'];
                $previous->save();
                
                return $previous;

            } else {
                $properties['model_name'] = self::class;
                $properties['model_primary_id'] = $this->id;
                
                return ModelArtifact::create($properties);
            }
        }

    }

}
