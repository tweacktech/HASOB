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
 * Class Relationship
 * @package Hasob\FoundationCore\Models
 * @version March 20, 2022, 10:07 am UTC
 *
 * @property string $id
 * @property string $organization_id
 */
class Relationship extends Model
{
    use GuidId;
    use OrganizationalConstraint;
    
    use SoftDeletes;

    use HasFactory;

    public $table = 'fc_relationships';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'id',
        'organization_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'status' => 'string',
        'primary_item_type' => 'string',
        'related_item_type' => 'string',
        'relation_type' => 'string',
        'weight' => 'integer'
    ];


    

}
