<?php

namespace Hasob\FoundationCore\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Hasob\FoundationCore\Traits\GuidId;

class Socialable extends Model
{
    use SoftDeletes;
    use GuidId;

    public $table = 'fc_socialables';
    
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public $fillable = [
        'type',
        'handle',
        'html_meta_snippet',
        'user_id',
        'socialable_id',
        'socialable_type'          
    ];

    protected $casts = [
        'id' => 'string',
        'type' => 'string',
        'handle' => 'string',
        'html_meta_snippet' => 'string',
        'user_id' => 'string',
        'socialable_id' => 'string',
        'socialable_type' => 'string'
    ];

    public function socialable(){
        return $this->morphTo();
    }

    public function user(){
        return $this->hasOne(User::class,'id','user_id');
    }

}
