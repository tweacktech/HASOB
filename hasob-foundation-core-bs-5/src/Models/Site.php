<?php

namespace Hasob\FoundationCore\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Hasob\FoundationCore\Events\SiteCreatedEvent;
use Hasob\FoundationCore\Events\SiteUpdatedEvent;
use Hasob\FoundationCore\Events\SiteDeletedEvent;

use Hasob\FoundationCore\Traits\GuidId;
use Hasob\FoundationCore\Traits\Attachable;
use Hasob\FoundationCore\Traits\Commentable;
use Hasob\FoundationCore\Traits\Socialable;
use Hasob\FoundationCore\Traits\Taggable;
use Hasob\FoundationCore\Traits\Disable;
use Hasob\FoundationCore\Traits\Artifactable;


class Site extends Model
{
    use SoftDeletes;
    use Artifactable;
    use Attachable;
    use Commentable;
    use Socialable;
    use Taggable;
    use Disable;
    use GuidId;

    public $table = 'fc_sites';
    
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public $fillable = [
        'site_name',
        'site_path',
        'description',
        'department_id',
        'home_department',
        'is_view_restricted',
        'view_allowed_roles',
        'view_allowed_user_ids',
        'is_blade_rendered',
        'blade_file_path',
        'creator_user_id',
        'organization_id' 
    ];

    protected $casts = [
        'id' => 'string',
        'site_name' => 'string',
        'site_path' => 'string',
        'home_department' => 'string',
        'description' => 'string',
        'is_view_restricted' => 'boolean',
        'view_allowed_roles' => 'string',
        'view_allowed_user_ids' => 'string',
        'is_blade_rendered' => 'boolean',
        'blade_file_path' => 'string',
        'department_id' => 'string',
        'creator_user_id' => 'string',
        'organization_id' => 'string'
    ];

    public static function all_sites(Organization $org = null){

        $model = new Site();
        $query = $model->newQuery();

        if ($org!=null){
            $query->where('organization_id', $org->id);
        }

        return $query->get();
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
    
    public function pages(){
        return $this->hasMany(Page::class);
    }

    public function site_artifacts(){
        return $this->hasMany(SiteArtifact::class);
    }

    public function save(array $options = []){

        $exists = $this->exists;
        parent::save($options);

        if ($exists){
            SiteUpdatedEvent::dispatch($this);
        } else {
            SiteCreatedEvent::dispatch($this);
        }

    }

    public function delete(){
        parent::delete();
        SiteDeletedEvent::dispatch($this);
    }
}
