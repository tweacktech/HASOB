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
 * Class Subscription
 * @package DMO\SavingsBond\Models
 * @version April 12, 2022, 7:27 pm UTC
 *
 * @property \DMO\SavingsBond\Models\Offer $offer
 * @property \DMO\SavingsBond\Models\User $user
 * @property \DMO\SavingsBond\Models\Broker $broker
 * @property string $organization_id
 * @property string $offer_id
 * @property string $user_id
 * @property string $broker_id
 * @property string $broker_code
 * @property string $broker_name
 * @property string $status
 * @property number $price_per_unit
 * @property number $total_price
 * @property number $interest_rate_pct
 * @property string $offer_start_date
 * @property string $offer_end_date
 * @property string $offer_settlement_date
 * @property string $offer_maturity_date
 * @property integer $tenor_years
 * @property string $investor_email
 * @property string $investor_telephone
 * @property string $first_name
 * @property string $middle_name
 * @property string $last_name
 * @property string $date_of_birth
 * @property string $origin_geo_zone
 * @property string $origin_lga
 * @property string $address_street
 * @property string $address_town
 * @property string $address_state
 * @property string $bank_account_name
 * @property string $bank_account_number
 * @property string $bank_name
 * @property string $bank_verification_number
 * @property string $national_id_number
 * @property string $cscs_id_number
 * @property string $chn_id_number
 */
class Subscription extends Model
{
    use GuidId;
    use OrganizationalConstraint;
    
    use SoftDeletes;

    use HasFactory;

    public $table = 'sb_subscriptions';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'organization_id',
        'offer_id',
        'user_id',
        'broker_id',
        'broker_code',
        'broker_name',
        'status',
        'price_per_unit',
        'total_price',
        'interest_rate_pct',
        'offer_start_date',
        'offer_end_date',
        'offer_settlement_date',
        'offer_maturity_date',
        'tenor_years',
        'investor_email',
        'investor_telephone',
        'first_name',
        'middle_name',
        'last_name',
        'date_of_birth',
        'origin_geo_zone',
        'origin_lga',
        'address_street',
        'address_town',
        'address_state',
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
        'broker_code' => 'string',
        'broker_name' => 'string',
        'is_broker_created' => 'boolean',
        'status' => 'string',
        'wf_status' => 'string',
        'wf_meta_data' => 'string',
        'units_requested' => 'integer',
        'price_per_unit' => 'decimal:2',
        'total_price' => 'decimal:2',
        'interest_rate_pct' => 'decimal:2',
        'tenor_years' => 'integer',
        'investor_email' => 'string',
        'investor_telephone' => 'string',
        'first_name' => 'string',
        'middle_name' => 'string',
        'last_name' => 'string',
        'origin_geo_zone' => 'string',
        'origin_lga' => 'string',
        'address_street' => 'string',
        'address_town' => 'string',
        'address_state' => 'string',
        'bank_account_name' => 'string',
        'bank_account_number' => 'string',
        'bank_name' => 'string',
        'bank_verification_number' => 'string',
        'national_id_number' => 'string',
        'cscs_id_number' => 'string',
        'chn_id_number' => 'string'
    ];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     **/
    public function offer()
    {
        return $this->hasOne(\DMO\SavingsBond\Models\Offer::class, 'offer_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     **/
    public function user()
    {
        return $this->hasOne(\DMO\SavingsBond\Models\User::class, 'user_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     **/
    public function broker()
    {
        return $this->hasOne(\DMO\SavingsBond\Models\Broker::class, 'broker_id', 'id');
    }

}
