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
 * Class Address
 * @package Hasob\FoundationCore\Models
 * @version February 25, 2022, 12:29 pm UTC
 *
 * @property string $id
 * @property string $organization_id
 * @property string $label
 * @property string $contact_person
 * @property string $street
 * @property string $town
 * @property string $state
 * @property string $country
 * @property string $telephone
 */
class Address extends Model
{
    use GuidId;
    use OrganizationalConstraint;
    
    use SoftDeletes;

    use HasFactory;

    public $table = 'fc_addresses';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'id',
        'organization_id',
        'label',
        'contact_person',
        'street',
        'town',
        'state',
        'country',
        'telephone'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'is_preferred' => 'boolean',
        'label' => 'string',
        'contact_person' => 'string',
        'street' => 'string',
        'town' => 'string',
        'state' => 'string',
        'country' => 'string',
        'telephone' => 'string',
        'wf_status' => 'string',
        'wf_meta_data' => 'string',
        'addressable_type' => 'string'
    ];


    

}
