<?php

namespace Hasob\FoundationCore\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Hasob\FoundationCore\Traits\GuidId;
use Hasob\FoundationCore\Traits\Attachable;
use Hasob\FoundationCore\Traits\Commentable;
use Hasob\FoundationCore\Traits\Socialable;
use Hasob\FoundationCore\Traits\Taggable;
use Hasob\FoundationCore\Traits\Disable;
use Hasob\FoundationCore\Traits\Artifactable;


class Tag extends Model
{
    use SoftDeletes;
    use Disable;
    use GuidId;

    public $table = 'fc_tags';
    
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public $fillable = [
        'name',
        'meta_data',
        'user_id',
        'parent_id',
        'organization_id'          
    ];

    protected $casts = [
        'id' => 'string',
        'name' => 'string',
        'meta_data' => 'string',
        'user_id' => 'string',
        'parent_id' => 'string',
        'organization_id' => 'string'
    ];

    
    public function taggables(){
        return $this->morphMany(Taggable::class, 'taggable');
    }

    public function parent(){
        return $this->hasOne(Tag::class,'id','parent_id');
    }

    public function user(){
        return $this->hasOne(User::class,'id','user_id');
    }

    public function organization(){
        return $this->belongsTo(Organization::class);
    }
    
}
