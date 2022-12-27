<?php

namespace Hasob\FoundationCore\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Hasob\FoundationCore\Traits\GuidId;

class Pageable extends Model
{
    use SoftDeletes;
    use GuidId;

    public $table = 'fc_pageables';
    
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public $fillable = [
        'pageable_type',
        'pageable_id',
        'page_id',
        'creator_user_id',
        'organization_id'
    ];

    protected $casts = [
        'id' => 'string',
        'pageable_type' => 'string',
        'pageable_id' => 'string',
        'page_id' => 'string',
        'creator_user_id' => 'string',
        'organization_id' => 'string'
    ];

    public function page(){
        return $this->hasOne(Page::class,'id','page_id');
    }

    public function pageable(){
        return $this->morphTo();
    }

    public function creator(){
        return $this->hasOne(User::class,'id','creator_user_id');
    }

    public function organization(){
        return $this->belongsTo(Organization::class);
    }
    
}
