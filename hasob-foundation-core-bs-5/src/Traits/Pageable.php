<?php
namespace Hasob\FoundationCore\Traits;


use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Hasob\FoundationCore\Models\User;
use Hasob\FoundationCore\Models\Page;
use Hasob\FoundationCore\Models\Pageable as PageableModel;
use Hasob\FoundationCore\Models\Department;
use Hasob\FoundationCore\Models\Organization;


trait Pageable
{
    public function pages(){
        $pageables = PageableModel::where('pageable_id',$this->id)
                                    ->where('pageable_type',self::class)
                                    ->orderBy('created_at')
                                    ->get();
        $pages = [];
        foreach($pageables as $pageable){
            $pages[] = $pageable->page;
        }

        return $pages;
    }

    public function create_page(User $user, $site_id, array $template=[]){

        //create page
        $template['site_id'] = $site_id;
        $template['creator_user_id'] = $user->id;
        $template['organization_id'] = $user->organization_id;
        $page = Page::create($template);

        //create pageable
        $pageable = new PageableModel();
        $pageable->creator_user_id = $user->id;
        $pageable->organization_id = $user->organization_id;
        $pageable->pageable_type = self::class;
        $pageable->pageable_id = $this->id;
        $pageable->page_id = $page->id;
        $pageable->save();

        return $page;
    }
}
