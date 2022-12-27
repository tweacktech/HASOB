<?php

namespace Hasob\FoundationCore\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Hasob\FoundationCore\Events\PageCreatedEvent;
use Hasob\FoundationCore\Events\PageUpdatedEvent;
use Hasob\FoundationCore\Events\PageDeletedEvent;

use Hasob\FoundationCore\Traits\GuidId;
use Hasob\FoundationCore\Traits\Attachable;
use Hasob\FoundationCore\Traits\Commentable;
use Hasob\FoundationCore\Traits\Socialable;
use Hasob\FoundationCore\Traits\Taggable;
use Hasob\FoundationCore\Traits\Disable;
use Hasob\FoundationCore\Traits\Artifactable;

class Page extends Model
{
    use SoftDeletes;
    use Attachable;
    use Commentable;
    use Socialable;
    use Taggable;
    use Disable;
    use Artifactable;
    use GuidId;

    public $table = 'fc_pages';
    
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public $fillable = [
        'page_name',
        'page_path',
        'content',
        'is_hidden',
        'is_published',
        'allow_comments',
        'home_department',   
        'is_view_restricted',
        'view_allowed_roles',
        'view_allowed_user_ids',
        'is_site_default_page',
        'is_blade_rendered',
        'blade_file_path',   
        'is_external_page',
        'external_page_key',
        'external_page_url',
        'site_id',
        'department_id',
        'creator_user_id',
        'organization_id'
    ];

    protected $casts = [
        'id' => 'string',
        'page_name' => 'string',
        'page_path' => 'string',
        'content' => 'string',
        'is_hidden' => 'boolean',
        'is_published' => 'boolean',
        'allow_comments' => 'boolean',
        'home_department' => 'string',
        'is_view_restricted' => 'boolean',
        'view_allowed_roles' => 'string',
        'view_allowed_user_ids' => 'string',
        'is_site_default_page' => 'boolean',
        'is_blade_rendered' => 'boolean',
        'blade_file_path' => 'string',
        'is_external_page' => 'boolean',
        'external_page_key' => 'string',
        'external_page_url' => 'string',
        'site_id' => 'string',
        'department_id' => 'string',
        'creator_user_id' => 'string',
        'organization_id' => 'string'
    ];

    public function pageables(){
        return $this->morphMany(Pageable::class, 'pageable');
    }

    public function site(){
        return $this->hasOne(Site::class,'id','site_id');
    }

    public function creator(){
        return $this->hasOne(User::class,'id','creator_user_id');
    }

    public function department(){
        return $this->hasOne(Department::class,'id','department_id');
    }

    public function organization(){
        return $this->belongsTo(Organization::class);
    }

    public function save(array $options = []){

        $exists = $this->exists;
        parent::save($options);

        if ($exists){
            PageUpdatedEvent::dispatch($this);
        } else {
            PageCreatedEvent::dispatch($this);
        }

    }

    public function delete(){
        parent::delete();
        PageDeletedEvent::dispatch($this);
    }
    
}
