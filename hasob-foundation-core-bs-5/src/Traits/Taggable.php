<?php
namespace Hasob\FoundationCore\Traits;


use Illuminate\Http\Request;
use Illuminate\Http\Response;


use Hasob\FoundationCore\Models\Tag;
use Hasob\FoundationCore\Models\Taggable as TaggableModel;
use Hasob\FoundationCore\Models\Department;
use Hasob\FoundationCore\Models\Organization;


trait Taggable
{
    
    public function tags(){
        $taggables = TaggableModel::where('taggable_id',$this->id)
                                    ->where('taggable_type',self::class)
                                    ->orderBy('created_at')
                                    ->get();

        $tags = [];
        foreach($taggables as $taggable){
            $tags[] = $taggable->tag;
        }

        return $tags;
    }

    private function create_tag(User $user, $name, $meta_data=null, $parent_id=null){
        $tag = new Tag();
        $tag->name = $name;
        $tag->user_id = $user->id;
        $tag->meta_data = $meta_data;
        $tag->parent_id = $parent_id;
        $tag->organization_id = $user->organization_id;
        $tag->save();

        return $tag;
    }

    public function tag($name, $user=null, $parent_id=null, $meta_data=null){

        if ($user == null){
            $user = Auth()->user();
        }

        $tag = Tag::where('name', $name)
                    ->where('parent_id', $parent_id)
                    ->where('organization_id', $user->organization_id)
                    ->first();

        if ($tag == null){
            $tag = $this->create_tag($user, $name, $meta_data, $parent_id);
        }

        $taggable = new TaggableModel();
        $taggable->taggable_id = $this->id;
        $taggable->taggable_type = self::class;
        $taggable->user_id = $user->id;
        $taggable->tag_id = $tag->id;
        $taggable->save();
        return $taggable;
    }
}
