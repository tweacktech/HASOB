<?php
namespace Hasob\FoundationCore\Traits;


use Illuminate\Http\Request;
use Illuminate\Http\Response;


use Hasob\FoundationCore\Models\User;
use Hasob\FoundationCore\Models\Socialable as SocialableModel;
use Hasob\FoundationCore\Models\Department;
use Hasob\FoundationCore\Models\Organization;


trait Socialable
{

    public function socials(){
        return SocialableModel::where('socialable_id',$this->id)
                        ->where('socialable_type',self::class)
                        ->orderBy('created_at')
                        ->get();
    }

    public function create_social(array $properties){

        if ($properties != null){
            $properties['socialable_id'] = $this->id;
            $properties['socialable_type'] = self::class;
            return SocialableModel::create($properties);
        }
        
        return null;
    }
}
