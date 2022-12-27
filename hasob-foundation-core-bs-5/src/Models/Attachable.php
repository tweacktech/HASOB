<?php

namespace Hasob\FoundationCore\Models;

use Carbon\Carbon;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Hasob\FoundationCore\Traits\GuidId;
use Hasob\FoundationCore\Traits\Commentable;
use Hasob\FoundationCore\Traits\Socialable;
use Hasob\FoundationCore\Traits\Taggable;
use Hasob\FoundationCore\Traits\Disable;
use Hasob\FoundationCore\Traits\Artifactable;

class Attachable extends Model
{
    use SoftDeletes;
    use Artifactable;
    use Disable;
    use GuidId;
    use Taggable;

    public $table = 'fc_attachables';
    
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public $fillable = [
        'attachment_id',
        'user_id',
        'attachable_id',
        'attachable_type'
    ];

    protected $casts = [
        'id' => 'string',
        'user_id' => 'string',
        'attachment_id' => 'string',
        'attachable_type' => 'string',
        'attachable_id' => 'string'
    ];

    
    public function attachable(){
        return $this->morphTo();
    }
    
    public function attachment(){
        return $this->hasOne(Attachment::class,'id','attachment_id');
    }
    
    public function user(){
        return $this->hasOne(User::class,'id','user_id');
    }
    
}
