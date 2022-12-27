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


class ChecklistTemplate extends Model
{
    use SoftDeletes;
    use Artifactable;
    use GuidId;

    public $table = 'fc_checklist_templates';
    
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public $fillable = [
        'list_name',
        'item_label',
        'item_description',
        'requires_attachment',
        'ordinal',
        'organization_id'
    ];

    protected $casts = [
        'id' => 'string',
        'ordinal' => 'integer',
        'list_name' => 'string',
        'item_label' => 'string',
        'item_description' => 'string',
        'requires_attachment' => 'boolean',
        'organization_id' => 'string'
    ];

    
    public function organization(){
        return $this->belongsTo(Organization::class);
    }
    
}
