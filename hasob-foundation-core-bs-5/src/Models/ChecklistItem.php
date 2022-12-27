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

class ChecklistItem extends Model
{
    use SoftDeletes;
    use Disable;
    use Attachable;
    use Artifactable;
    use GuidId;

    public $table = 'fc_checklist_items';
    
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public $fillable = [
        'list_name',
        'item_label',
        'item_description',
        'item_passed',
        'item_failed',
        'item_checked',
        'item_failed_notes',
        'ordinal',
        'requires_attachment',
        'is_yes_no',
        'item_na',
        'owner_type_id',
        'owner_type',
        'checking_user_id',
        'organization_id'
    ];

    protected $casts = [
        'id' => 'string',
        'list_name' => 'string',
        'item_label' => 'string',
        'item_description' => 'string',
        'item_passed' => 'string',
        'item_failed' => 'string',
        'item_checked' => 'boolean',
        'item_failed_notes' => 'string',
        'ordinal' => 'integer',
        'status' => 'string',
        'requires_attachment' => 'string',
        'is_yes_no' => 'boolean',
        'item_na' => 'string',
        'owner_type_id' => 'string',
        'owner_type' => 'string',
        'checking_user_id' => 'string',
        'organization_id' => 'string'
    ];

    public function checking_user(){
        return $this->hasOne(User::class,'id','checking_user_id');
    }

    public function organization(){
        return $this->belongsTo(Organization::class);
    }
    
}
