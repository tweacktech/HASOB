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
 * Class BatchItem
 * @package Hasob\FoundationCore\Models
 * @version February 25, 2022, 12:29 pm UTC
 *
 * @property string $id
 * @property string $organization_id
 */
class BatchItem extends Model
{
    use GuidId;
    use OrganizationalConstraint;
    
    use SoftDeletes;

    use HasFactory;

    public $table = 'fc_batch_items';
    

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
        'wf_status' => 'string',
        'wf_meta_data' => 'string',
        'batchable_type' => 'string'
    ];


    

}
