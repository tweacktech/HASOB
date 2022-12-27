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
 * Class BrokerStaff
 * @package DMO\SavingsBond\Models
 * @version April 12, 2022, 7:27 pm UTC
 *
 * @property \DMO\SavingsBond\Models\Broker $broker
 * @property \DMO\SavingsBond\Models\User $user
 * @property string $organization_id
 * @property string $broker_id
 * @property string $user_id
 * @property string $status
 */
class BrokerStaff extends Model
{
    use GuidId;
    use OrganizationalConstraint;
    
    use SoftDeletes;

    use HasFactory;

    public $table = 'sb_broker_staff';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'organization_id',
        'broker_id',
        'user_id',
        'status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'display_ordinal' => 'integer',
        'status' => 'string',
        'role' => 'string'
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
