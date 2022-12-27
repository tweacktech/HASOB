<?php

namespace Hasob\FoundationCore\Models;

use Hasob\FoundationCore\Traits\GuidId;
use Hasob\FoundationCore\Traits\Ledgerable;
use Hasob\FoundationCore\Traits\Artifactable;
use Hasob\FoundationCore\Traits\OrganizationalConstraint;

use Eloquent as Model;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Rating
 * @package Hasob\FoundationCore\Models
 * @version March 20, 2022, 10:07 am UTC
 *
 * @property \Hasob\FoundationCore\Models\User $user
 * @property string $id
 * @property string $organization_id
 * @property string $creator_user_id
 */
class Rating extends Model
{
    use GuidId;
    use OrganizationalConstraint;
    
    use SoftDeletes;

    use HasFactory;

    public $table = 'fc_ratings';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'id',
        'organization_id',
        'creator_user_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'status' => 'string',
        'ratable_type' => 'string',
        'description' => 'string',
        'score' => 'integer',
        'max_score' => 'integer'
    ];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     **/
    public function user()
    {
        return $this->hasOne(\Hasob\FoundationCore\Models\User::class, 'creator_user_id', 'id');
    }

}
