<?php

namespace Hasob\FoundationCore\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Hasob\FoundationCore\Traits\GuidId;
use Hasob\FoundationCore\Traits\Attachable;
use Hasob\FoundationCore\Traits\Commentable;
use Hasob\FoundationCore\Traits\Socialable;
use Hasob\FoundationCore\Traits\Disable;
use Hasob\FoundationCore\Traits\Artifactable;

class Taggable extends Model
{
    use SoftDeletes;
    use Disable;
    use GuidId;

    public $table = 'fc_taggables';
    
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public $fillable = [
        'user_id',
        'tag_id',
        'taggable_id',
        'taggable_type'        
    ];

    protected $casts = [
        'id' => 'string',
        'user_id' => 'string',
        'tag_id' => 'string',
        'taggable_id' => 'string',
        'taggable_type' => 'string'
    ];

    public function taggable(){
        return $this->morphTo();
    }

    public function tag(){
        return $this->hasOne(Tag::class,'id','tag_id');
    }
    
    public function user(){
        return $this->hasOne(User::class,'id','user_id');
    }
    
}
