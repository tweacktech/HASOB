<?php

namespace DMO\SavingsBond\Models;

use Hasob\FoundationCore\Traits\GuidId;
use Hasob\FoundationCore\Traits\Ledgerable;
use Hasob\FoundationCore\Traits\Artifactable;
use Hasob\FoundationCore\Traits\OrganizationalConstraint;

use Eloquent as Model;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Broker
 * @package DMO\SavingsBond\Models
 * @version April 12, 2022, 7:27 pm UTC
 *
 * @property string $organization_id
 * @property string $status
 * @property string $broker_code
 * @property string $full_name
 * @property string $short_name
 */
class Broker extends Model
{
    use GuidId;
    use OrganizationalConstraint;
    
    use SoftDeletes;

    use HasFactory;

    public $table = 'sb_brokers';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'organization_id',
        'status',
        'broker_code',
        'full_name',
        'short_name'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'display_ordinal' => 'integer',
        'status' => 'string',
        'wf_status' => 'string',
        'wf_meta_data' => 'string',
        'broker_code' => 'string',
        'full_name' => 'string',
        'short_name' => 'string'
    ];


    

}
