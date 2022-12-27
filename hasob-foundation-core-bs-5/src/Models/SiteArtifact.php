<?php

namespace Hasob\FoundationCore\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Hasob\FoundationCore\Traits\GuidId;

class SiteArtifact extends Model
{
    use SoftDeletes;
    use GuidId;

    public $table = 'fc_site_artifacts';
    
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public $fillable = [
        'headline',
        'type',
        'content',
        'is_sticky',
        'is_flashing',
        'is_external_url',
        'external_url',   
        'display_start_date',
        'display_end_date',
        'specific_display_date',
        'page_id',
        'site_id',
        'creator_user_id',
        'organization_id'
    ];

    protected $casts = [
        'id' => 'string',
        'headline' => 'string',
        'type' => 'string',
        'content' => 'string',
        'is_sticky' => 'boolean',
        'is_flashing' => 'boolean',
        'is_external_url' => 'boolean',
        'external_url' => 'string',
        'display_start_date' => 'date',
        'display_end_date' => 'date',
        'specific_display_date' => 'date',
        'is_site_default_page' => 'boolean',
        'page_id' => 'string',
        'site_id' => 'string',
        'creator_user_id' => 'string',
        'organization_id' => 'string'
    ];

    public function site(){
        return $this->hasOne(Site::class,'id','site_id');
    }

    public function page(){
        return $this->hasOne(Page::class,'id','page_id');
    }

    public function creator(){
        return $this->hasOne(User::class,'id','creator_user_id');
    }

    public function organization(){
        return $this->belongsTo(Organization::class);
    }
    
}
