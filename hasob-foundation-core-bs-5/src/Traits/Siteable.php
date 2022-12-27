<?php
namespace Hasob\FoundationCore\Traits;


use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Hasob\FoundationCore\Models\User;
use Hasob\FoundationCore\Models\Site;
use Hasob\FoundationCore\Models\Attachment;
use Hasob\FoundationCore\Models\Department;
use Hasob\FoundationCore\Models\Organization;


trait Siteable
{

    public function sites(){
        return Site::where('siteable_id',$this->id)
                        ->where('siteable_type',self::class)
                        ->orderBy('created_at')
                        ->get();
    }

    public function create_site($name, array $properties){

        if ($name!=null && $properties != null){
            $properties['site_name'] = $name;
            $properties['siteable_id'] = $this->id;
            $properties['siteable_type'] = self::class;
            return Site::create($properties);
        }
        
        return null;
    }

}
