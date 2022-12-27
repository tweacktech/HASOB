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


class DisabledItem extends Model
{
    use SoftDeletes;
    use Artifactable;
    use GuidId;

    public $table = 'fc_disabled_items';
    
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public $fillable = [
        'disable_id',
        'disable_type',
        'is_disabled',
        'disable_reason',
        'disabled_at',
        'disabling_user_id',
        'organization_id'       
    ];

    protected $casts = [
        'id' => 'string',
        'disable_id' => 'string',
        'disable_type' => 'string',
        'is_disabled' => 'boolean',
        'disable_reason' => 'string',
        'disabled_at' => 'date',
        'disabling_user_id' => 'string',
        'organization_id' => 'string'
    ];

    public function disable(){
        return $this->morphTo();
    }

    public function disabling_user(){
        return $this->hasOne(User::class,'id','disabling_user_id');
    }

    public function organization(){
        return $this->belongsTo(Organization::class);
    }
    
}
