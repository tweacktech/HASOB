<?php

namespace Hasob\FoundationCore\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Hasob\FoundationCore\Events\DepartmentCreatedEvent;
use Hasob\FoundationCore\Events\DepartmentUpdatedEvent;
use Hasob\FoundationCore\Events\DepartmentDeletedEvent;

use Hasob\FoundationCore\Traits\GuidId;
use Hasob\FoundationCore\Traits\Siteable;
use Hasob\FoundationCore\Traits\Pageable;
use Hasob\FoundationCore\Traits\Attachable;
use Hasob\FoundationCore\Traits\Commentable;
use Hasob\FoundationCore\Traits\Socialable;
use Hasob\FoundationCore\Traits\Taggable;
use Hasob\FoundationCore\Traits\Disable;
use Hasob\FoundationCore\Traits\Artifactable;

class Department extends Model
{
    use SoftDeletes;
    use Artifactable;
    use Pageable;
    use Attachable;
    use Commentable;
    use Socialable;
    use Taggable;
    use Disable;
    use Siteable;
    use GuidId;

    public $table = 'fc_departments';
    
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public $fillable = [
        'key',
        'long_name',
        'is_unit',
        'email',
        'telephone',
        'long_name',
        'physical_location',
        'parent_id',
        'organization_id'       
    ];

    protected $casts = [
        'id' => 'string',
        'key' => 'string',
        'long_name' => 'string',
        'is_unit' => 'boolean',
        'email' => 'string',
        'telephone' => 'string',
        'physical_location' => 'string',
        'parent_id' => 'string',
        'organization_id' => 'string'
    ];

    public function parent(){
        return $this->hasOne(Department::class,'id','parent_id');
    }

    public function organization(){
        return $this->belongsTo(Organization::class);
    }
   
    public function members(){
        return $this->hasMany(User::class);
    }

    public static function all_departments(Organization $org = null){

        $model = new Department();
        $query = $model->newQuery();

        if ($org!=null){
            $query->where('organization_id', $org->id);
        }

        return $query->get();
    }
    
    public function save(array $options = []){

        $exists = $this->exists;
        parent::save($options);

        if ($exists){
            DepartmentUpdatedEvent::dispatch($this);
        } else {
            DepartmentCreatedEvent::dispatch($this);
        }

    }

    public function delete(){
        parent::delete();
        DepartmentDeletedEvent::dispatch($this);
    }

}
