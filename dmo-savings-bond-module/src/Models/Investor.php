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
 * Class Investor
 * @package DMO\SavingsBond\Models
 * @version April 12, 2022, 7:27 pm UTC
 *
 * @property \DMO\SavingsBond\Models\Broker $broker
 * @property \DMO\SavingsBond\Models\User $user
 * @property string $organization_id
 * @property string $broker_id
 * @property string $user_id
 * @property string $date_of_birth
 * @property string $origin_geo_zone
 * @property string $origin_lga
 * @property string $address_street
 * @property string $address_town
 * @property string $address_state
 * @property string $status
 * @property string $bank_account_name
 * @property string $bank_account_number
 * @property string $bank_name
 * @property string $bank_verification_number
 * @property string $national_id_number
 * @property string $cscs_id_number
 * @property string $chn_id_number
 */
class Investor extends Model
{
    use GuidId;
    use OrganizationalConstraint;
    
    use SoftDeletes;

    use HasFactory;

    public $table = 'sb_investors';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'organization_id',
        'broker_id',
        'user_id',
        'date_of_birth',
        'origin_geo_zone',
        'origin_lga',
        'address_street',
        'address_town',
        'address_state',
        'status',
        'bank_account_name',
        'bank_account_number',
        'bank_name',
        'bank_verification_number',
        'national_id_number',
        'cscs_id_number',
        'chn_id_number'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'display_ordinal' => 'integer',
        'is_broker_created' => 'boolean',
        'origin_geo_zone' => 'string',
        'origin_lga' => 'string',
        'address_street' => 'string',
        'address_town' => 'string',
        'address_state' => 'string',
        'status' => 'string',
        'wf_status' => 'string',
        'wf_meta_data' => 'string',
        'bank_account_name' => 'string',
        'bank_account_number' => 'string',
        'bank_name' => 'string',
        'is_bank_account_verified' => 'boolean',
        'bank_account_meta_data' => 'string',
        'bank_verification_number' => 'string',
        'is_bvn_verified' => 'boolean',
        'bvn_meta_data' => 'string',
        'national_id_number' => 'string',
        'is_nin_verified' => 'boolean',
        'nin_meta_data' => 'string',
        'cscs_id_number' => 'string',
        'is_cscs_id_verified' => 'boolean',
        'cscs_meta_data' => 'string',
        'chn_id_number' => 'string',
        'is_chn_id_verified' => 'boolean',
        'chn_meta_data' => 'string'
    ];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     **/
    public function broker()
    {
        return $this->hasOne(\DMO\SavingsBond\Models\Broker::class, 'broker_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     **/
    public function user()
    {
        return $this->hasOne(\DMO\SavingsBond\Models\User::class, 'user_id', 'id');
    }

}
