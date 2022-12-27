<?php

namespace Hasob\FoundationCore\Models;

use Carbon\Carbon;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Hasob\FoundationCore\Events\CommentCreatedEvent;
use Hasob\FoundationCore\Events\CommentUpdatedEvent;
use Hasob\FoundationCore\Events\CommentDeletedEvent;

use Hasob\FoundationCore\Traits\GuidId;
use Hasob\FoundationCore\Traits\Attachable;
use Hasob\FoundationCore\Traits\Commentable;
use Hasob\FoundationCore\Traits\Socialable;
use Hasob\FoundationCore\Traits\Taggable;
use Hasob\FoundationCore\Traits\Disable;
use Hasob\FoundationCore\Traits\Artifactable;


class Comment extends Model
{
    use SoftDeletes;
    use Disable;
    use Artifactable;
    use GuidId;

    public $table = 'fc_comments';
    
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public $fillable = [
        'parent_id',
        'user_id',
        'content',
        'status',
        'type',
        'commentable_id',
        'commentable_type',
        'organization_id'
    ];

    protected $casts = [
        'id' => 'string',
        'parent_id' => 'string',
        'user_id' => 'string',
        'content' => 'string',
        'status' => 'string',
        'type' => 'string',
        'commentable_id' => 'string',
        'commentable_type' => 'string',
        'organization_id' => 'string'
    ];

    
    public function commentable(){
        return $this->morphTo();
    }

    public function parent(){
        return $this->hasOne(Comment::class,'id','parent_id');
    }

    public function user(){
        return $this->hasOne(User::class,'id','user_id');
    }

    public function organization(){
        return $this->belongsTo(Organization::class);
    }

    public function getCommentedDateString(){
        return Carbon::parse($this->created_at)->format("M d @ g:i a");
    }
    
    public function save(array $options = []){

        $exists = $this->exists;
        parent::save($options);

        if ($exists){
            CommentUpdatedEvent::dispatch($this);
        } else {
            CommentCreatedEvent::dispatch($this);
        }

    }

    public function delete(){
        parent::delete();
        CommentDeletedEvent::dispatch($this);
    }
    
}
